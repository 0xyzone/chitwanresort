<?php

namespace App\Services;

use App\Mail\UserReactivationOtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RuntimeException;

class UserReactivationOtpService
{
    /**
     * Cache key prefix for reactivation OTPs.
     */
    protected const CACHE_PREFIX = 'user_reactivation_otp:';

    /**
     * Resolve the email configured to receive the super admin OTP code.
     *
     * @throws RuntimeException
     */
    public function getConfiguredEmail(): string
    {
        $configured = config('auth.reactivation.super_admin_email');

        if (filled($configured) && filter_var($configured, FILTER_VALIDATE_EMAIL)) {
            return (string) $configured;
        }

        $superAdminEmail = User::role('super_admin')
            ->where('is_active', true)
            ->value('email');

        if (filled($superAdminEmail)) {
            return (string) $superAdminEmail;
        }

        if (auth()->check() && auth()->user()->hasRole('super_admin') && filled(auth()->user()->email)) {
            return (string) auth()->user()->email;
        }

        throw new RuntimeException('No Super Admin email is configured for OTP delivery. Please configure SUPER_ADMIN_OTP_EMAIL in your environment file.');
    }

    /**
     * Get a masked representation of the recipient email for display in UI notices.
     */
    public function getMaskedConfiguredEmail(): string
    {
        try {
            $email = $this->getConfiguredEmail();
        } catch (RuntimeException) {
            return 'configured super admin email';
        }

        $parts = explode('@', $email, 2);

        if (count($parts) !== 2) {
            return $email;
        }

        $name = $parts[0];
        $domain = $parts[1];

        if (strlen($name) <= 2) {
            $maskedName = substr($name, 0, 1).'*';
        } else {
            $maskedName = substr($name, 0, 2).str_repeat('*', max(1, strlen($name) - 3)).substr($name, -1);
        }

        return "{$maskedName}@{$domain}";
    }

    /**
     * Generate and dispatch a fresh OTP to the configured Super Admin email.
     */
    public function sendOtp(User $targetUser, ?User $requestedBy = null): string
    {
        $recipientEmail = $this->getConfiguredEmail();
        $timeoutMinutes = (int) config('auth.reactivation.otp_timeout_minutes', 10);
        $otp = sprintf('%06d', random_int(100000, 999999));

        Cache::put(
            $this->getCacheKey($targetUser->id),
            [
                'hash' => Hash::make($otp),
                'email' => $recipientEmail,
                'requested_by' => $requestedBy?->id,
                'attempts' => 0,
                'expires_at' => now()->addMinutes($timeoutMinutes),
            ],
            now()->addMinutes($timeoutMinutes)
        );

        Mail::to($recipientEmail)->send(
            new UserReactivationOtpMail($targetUser, $otp, $requestedBy, $timeoutMinutes)
        );

        return $otp;
    }

    /**
     * Verify whether a provided OTP code is valid for the target user.
     */
    public function verifyOtp(User $targetUser, string $otp): bool
    {
        $key = $this->getCacheKey($targetUser->id);
        $cached = Cache::get($key);

        if (! is_array($cached) || ! isset($cached['hash'])) {
            return false;
        }

        $maxAttempts = (int) config('auth.reactivation.max_attempts', 5);
        $attempts = ((int) ($cached['attempts'] ?? 0)) + 1;

        if ($attempts > $maxAttempts) {
            Cache::forget($key);

            return false;
        }

        $cached['attempts'] = $attempts;
        Cache::put($key, $cached, $cached['expires_at'] ?? now()->addMinutes(5));

        return Hash::check(trim($otp), $cached['hash']);
    }

    /**
     * Verify the OTP and reactivate the target user.
     */
    public function verifyAndReactivate(User $targetUser, string $otp): bool
    {
        if (! $this->verifyOtp($targetUser, $otp)) {
            return false;
        }

        Cache::forget($this->getCacheKey($targetUser->id));

        $targetUser->allowReactivationWithOtp();
        $targetUser->is_active = true;
        $targetUser->save();

        return true;
    }

    /**
     * Invalidate any existing OTP for the target user.
     */
    public function clearOtp(User $targetUser): void
    {
        Cache::forget($this->getCacheKey($targetUser->id));
    }

    /**
     * Build the cache key for a given user identifier.
     */
    protected function getCacheKey(int|string $userId): string
    {
        return self::CACHE_PREFIX.$userId;
    }
}
