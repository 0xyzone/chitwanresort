<?php

namespace Tests\Feature;

use App\Filament\Resources\Users\Pages\ListUsers;
use App\Mail\UserReactivationOtpMail;
use App\Models\User;
use App\Services\UserReactivationOtpService;
use DomainException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserReactivationOtpTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $role = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $permission = Permission::firstOrCreate(['name' => 'ViewAny:User', 'guard_name' => 'web']);
        $togglePermission = Permission::firstOrCreate(['name' => 'ToggleActive:User', 'guard_name' => 'web']);
        $role->givePermissionTo([$permission, $togglePermission]);
    }

    public function test_inactive_user_cannot_be_activated_directly_without_otp(): void
    {
        $inactiveUser = User::factory()->create([
            'is_active' => false,
        ]);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Inactive user cannot be reactivated without Super Admin OTP verification.');

        $inactiveUser->update([
            'is_active' => true,
        ]);

        $this->assertFalse($inactiveUser->fresh()->is_active);
    }

    public function test_active_user_can_be_deactivated_normally(): void
    {
        $activeUser = User::factory()->create([
            'is_active' => true,
        ]);

        $activeUser->update([
            'is_active' => false,
        ]);

        $this->assertFalse($activeUser->fresh()->is_active);
    }

    public function test_otp_is_sent_to_configured_super_admin_email(): void
    {
        Mail::fake();

        config(['auth.reactivation.super_admin_email' => 'custom-admin@chitwanresort.com']);

        $service = app(UserReactivationOtpService::class);
        $this->assertSame('custom-admin@chitwanresort.com', $service->getConfiguredEmail());

        $inactiveUser = User::factory()->create([
            'is_active' => false,
        ]);

        $otp = $service->sendOtp($inactiveUser);

        $this->assertMatchesRegularExpression('/^\d{6}$/', $otp);

        Mail::assertSent(UserReactivationOtpMail::class, function (UserReactivationOtpMail $mail) use ($inactiveUser, $otp): bool {
            return $mail->hasTo('custom-admin@chitwanresort.com')
                && $mail->targetUser->id === $inactiveUser->id
                && $mail->otp === $otp;
        });
    }

    public function test_invalid_otp_fails_and_does_not_reactivate_user(): void
    {
        Mail::fake();

        config(['auth.reactivation.super_admin_email' => 'admin@admin.com']);

        $service = app(UserReactivationOtpService::class);
        $inactiveUser = User::factory()->create([
            'is_active' => false,
        ]);

        $service->sendOtp($inactiveUser);

        $reactivated = $service->verifyAndReactivate($inactiveUser, '000000');

        $this->assertFalse($reactivated);
        $this->assertFalse($inactiveUser->fresh()->is_active);
    }

    public function test_valid_otp_successfully_reactivates_inactive_user(): void
    {
        Mail::fake();

        config(['auth.reactivation.super_admin_email' => 'admin@admin.com']);

        $service = app(UserReactivationOtpService::class);
        $inactiveUser = User::factory()->create([
            'is_active' => false,
        ]);

        $otp = $service->sendOtp($inactiveUser);

        $reactivated = $service->verifyAndReactivate($inactiveUser, $otp);

        $this->assertTrue($reactivated);
        $this->assertTrue($inactiveUser->fresh()->is_active);
    }

    public function test_otp_cannot_be_reused_after_successful_reactivation(): void
    {
        Mail::fake();

        config(['auth.reactivation.super_admin_email' => 'admin@admin.com']);

        $service = app(UserReactivationOtpService::class);
        $inactiveUser = User::factory()->create([
            'is_active' => false,
        ]);

        $otp = $service->sendOtp($inactiveUser);
        $this->assertTrue($service->verifyAndReactivate($inactiveUser, $otp));

        // Now deactivate user again
        $inactiveUser->update(['is_active' => false]);
        $this->assertFalse($inactiveUser->fresh()->is_active);

        // Attempting to reuse the old OTP should fail
        $secondReactivate = $service->verifyAndReactivate($inactiveUser, $otp);
        $this->assertFalse($secondReactivate);
        $this->assertFalse($inactiveUser->fresh()->is_active);
    }

    public function test_otp_fails_after_exceeding_max_attempts(): void
    {
        Mail::fake();

        config([
            'auth.reactivation.super_admin_email' => 'admin@admin.com',
            'auth.reactivation.max_attempts' => 3,
        ]);

        $service = app(UserReactivationOtpService::class);
        $inactiveUser = User::factory()->create([
            'is_active' => false,
        ]);

        $validOtp = $service->sendOtp($inactiveUser);

        // Fail 3 times
        $this->assertFalse($service->verifyOtp($inactiveUser, '111111'));
        $this->assertFalse($service->verifyOtp($inactiveUser, '222222'));
        $this->assertFalse($service->verifyOtp($inactiveUser, '333333'));

        // 4th attempt exceeds max attempts, invalidating OTP
        $this->assertFalse($service->verifyOtp($inactiveUser, $validOtp));
        $this->assertFalse($inactiveUser->fresh()->is_active);
    }

    public function test_super_admin_can_reactivate_user_via_filament_table_action(): void
    {
        Mail::fake();

        config(['auth.reactivation.super_admin_email' => 'admin@admin.com']);

        $superAdmin = User::factory()->create([
            'email' => 'admin@admin.com',
            'is_active' => true,
        ]);
        $superAdmin->assignRole('super_admin');

        $inactiveUser = User::factory()->create([
            'name' => 'Dinesh Sharma',
            'is_active' => false,
        ]);

        $service = app(UserReactivationOtpService::class);

        // Mounting the action sends OTP via email
        $livewire = Livewire::actingAs($superAdmin)
            ->test(ListUsers::class)
            ->mountTableAction('reactivate', $inactiveUser);

        // Verify mail was sent and get dispatched OTP code
        Mail::assertSent(UserReactivationOtpMail::class);
        $sentMails = Mail::sent(UserReactivationOtpMail::class);
        $this->assertNotEmpty($sentMails);
        $otp = $sentMails->last()->otp;

        // Set action form data and execute mounted action
        $livewire->setTableActionData([
            'otp' => $otp,
        ])
            ->callMountedTableAction()
            ->assertHasNoTableActionErrors();

        $this->assertTrue($inactiveUser->fresh()->is_active);
    }

    public function test_filament_reactivate_action_fails_with_invalid_otp(): void
    {
        Mail::fake();

        config(['auth.reactivation.super_admin_email' => 'admin@admin.com']);

        $superAdmin = User::factory()->create([
            'email' => 'admin@admin.com',
            'is_active' => true,
        ]);
        $superAdmin->assignRole('super_admin');

        $inactiveUser = User::factory()->create([
            'is_active' => false,
        ]);

        Livewire::actingAs($superAdmin)
            ->test(ListUsers::class)
            ->callTableAction('reactivate', $inactiveUser, data: [
                'otp' => '999999',
            ])
            ->assertHasTableActionErrors(['otp']);

        $this->assertFalse($inactiveUser->fresh()->is_active);
    }
}
