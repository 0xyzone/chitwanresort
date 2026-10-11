<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password', 'avatar_url', 'phone', 'is_active', 'email_verified_at'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Track whether OTP was verified for reactivating an inactive account.
     */
    protected bool $otpVerifiedForReactivation = false;

    /**
     * Mark the model instance as verified via Super Admin OTP for reactivation.
     */
    public function allowReactivationWithOtp(): static
    {
        $this->otpVerifiedForReactivation = true;

        return $this;
    }

    /**
     * Check whether OTP has been verified for reactivating this user.
     */
    public function isOtpVerifiedForReactivation(): bool
    {
        return $this->otpVerifiedForReactivation;
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::updating(function (User $user): void {
            // Strictly prevent reactivating an inactive user without Super Admin OTP verification
            if ($user->exists && ! (bool) $user->getOriginal('is_active') && (bool) $user->is_active) {
                if (! $user->isOtpVerifiedForReactivation()) {
                    throw new \DomainException('Inactive user cannot be reactivated without Super Admin OTP verification.');
                }
            }
        });
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return (bool) $this->is_active;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? asset('storage/'.$this->avatar_url) : null;
    }
}
