<?php

namespace App\Filament\Resources\Users\Actions;

use App\Models\User;
use App\Services\UserReactivationOtpService;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ReactivateUserAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'reactivate';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Reactivate');
        $this->icon(Heroicon::OutlinedShieldCheck);
        $this->color('success');

        $this->visible(fn (?User $record): bool => (bool) (
            $record && ! $record->is_active && (auth()->user()?->can('ToggleActive:User') ?? true)
        ));

        $this->modalHeading(fn (User $record): string => "Reactivate User: {$record->name}");
        $this->modalIcon(Heroicon::OutlinedShieldCheck);
        $this->modalSubmitActionLabel('Verify OTP & Reactivate');

        $this->modalDescription(function (User $record, UserReactivationOtpService $otpService): string {
            return "A 6-digit OTP code has been dispatched to {$otpService->getMaskedConfiguredEmail()}. Please enter the verification code below to reactivate {$record->name}'s account.";
        });

        $this->mountUsing(function (Action $action, ?User $record, UserReactivationOtpService $otpService, ?Schema $schema = null): void {
            $schema?->fill();

            $target = $record ?? $action->getRecord();

            if ($target instanceof User) {
                $otpService->sendOtp($target, auth()->user());

                Notification::make()
                    ->title('Verification OTP Dispatched')
                    ->body("A 6-digit OTP code has been sent to {$otpService->getMaskedConfiguredEmail()}.")
                    ->info()
                    ->send();
            }
        });

        $this->schema([
            TextInput::make('otp')
                ->label('6-Digit OTP Code')
                ->placeholder('e.g. 123456')
                ->required()
                ->length(6)
                ->autofocus()
                ->prefixIcon(Heroicon::OutlinedKey)
                ->helperText('Check the configured Super Admin email inbox for the code. Code expires in 10 minutes.')
                ->rule(function (Action $action, ?User $record, UserReactivationOtpService $otpService) {
                    return function (string $attribute, mixed $value, \Closure $fail) use ($action, $record, $otpService): void {
                        $target = $record ?? $action->getRecord();

                        if (! ($target instanceof User) || ! $otpService->verifyOtp($target, (string) $value)) {
                            $fail('The OTP code is invalid, incorrect, or has expired.');
                        }
                    };
                })
                ->hintAction(
                    Action::make('resendOtp')
                        ->label('Resend Code')
                        ->icon(Heroicon::OutlinedArrowPath)
                        ->color('primary')
                        ->action(function (Action $action, ?User $record, UserReactivationOtpService $otpService): void {
                            $target = $record ?? $action->getRecord();

                            if ($target instanceof User) {
                                $otpService->sendOtp($target, auth()->user());

                                Notification::make()
                                    ->title('New OTP Sent')
                                    ->body("A fresh 6-digit OTP code has been dispatched to {$otpService->getMaskedConfiguredEmail()}.")
                                    ->success()
                                    ->send();
                            }
                        })
                ),
        ]);

        $this->action(function (Action $action, ?User $record, array $data, UserReactivationOtpService $otpService): void {
            $target = $record ?? $action->getRecord();

            if (! ($target instanceof User)) {
                return;
            }

            $otp = trim((string) ($data['otp'] ?? ''));

            if (! $otpService->verifyAndReactivate($target, $otp)) {
                $action->halt();
            }

            Notification::make()
                ->title('User Reactivated Successfully')
                ->body("{$target->name}'s account is now active and can access system panels.")
                ->success()
                ->send();
        });
    }
}
