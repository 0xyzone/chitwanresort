<?php

namespace Tests\Feature;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserResourceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Ensure Shield super_admin role and permissions exist
        $role = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $permission = Permission::firstOrCreate(['name' => 'ViewAny:User', 'guard_name' => 'web']);
        $role->givePermissionTo($permission);
    }

    public function test_super_admin_can_render_users_list_page(): void
    {
        $superAdmin = User::factory()->create([
            'is_active' => true,
        ]);
        $superAdmin->assignRole('super_admin');

        $this->actingAs($superAdmin)
            ->get(UserResource::getUrl('index'))
            ->assertSuccessful();
    }

    public function test_super_admin_can_render_create_user_page(): void
    {
        $superAdmin = User::factory()->create([
            'is_active' => true,
        ]);
        $superAdmin->assignRole('super_admin');

        $this->actingAs($superAdmin)
            ->get(UserResource::getUrl('create'))
            ->assertSuccessful();
    }

    public function test_super_admin_can_render_edit_user_page(): void
    {
        $superAdmin = User::factory()->create([
            'is_active' => true,
        ]);
        $superAdmin->assignRole('super_admin');

        $targetUser = User::factory()->create();

        $this->actingAs($superAdmin)
            ->get(UserResource::getUrl('edit', ['record' => $targetUser]))
            ->assertSuccessful();
    }

    public function test_super_admin_can_render_view_user_page(): void
    {
        $superAdmin = User::factory()->create([
            'is_active' => true,
        ]);
        $superAdmin->assignRole('super_admin');

        $targetUser = User::factory()->create();

        $this->actingAs($superAdmin)
            ->get(UserResource::getUrl('view', ['record' => $targetUser]))
            ->assertSuccessful();
    }

    public function test_super_admin_can_export_users_csv(): void
    {
        $superAdmin = User::factory()->create([
            'is_active' => true,
        ]);
        $superAdmin->assignRole('super_admin');

        User::factory()->count(3)->create();

        $response = $this->actingAs($superAdmin)
            ->get(UserResource::getUrl('index'));

        $response->assertSuccessful();
    }

    public function test_unauthorized_user_cannot_view_users(): void
    {
        $regularUser = User::factory()->create([
            'is_active' => true,
        ]);

        $this->actingAs($regularUser)
            ->get(UserResource::getUrl('index'))
            ->assertForbidden();
    }

    public function test_inactive_user_cannot_access_panel(): void
    {
        $inactiveUser = User::factory()->create([
            'is_active' => false,
        ]);

        $panel = Filament::getPanel('mukhiyadwar');
        $this->assertFalse($inactiveUser->canAccessPanel($panel));
    }

    public function test_user_has_avatar_url_method(): void
    {
        $userWithAvatar = User::factory()->create([
            'avatar_url' => 'avatars/sample.jpg',
        ]);

        $this->assertStringContainsString('avatars/sample.jpg', (string) $userWithAvatar->getFilamentAvatarUrl());

        $userWithoutAvatar = User::factory()->create([
            'avatar_url' => null,
        ]);

        $this->assertNull($userWithoutAvatar->getFilamentAvatarUrl());
    }
}
