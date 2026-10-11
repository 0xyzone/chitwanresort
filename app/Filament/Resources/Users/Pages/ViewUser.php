<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\Actions\ReactivateUserAction;
use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->icon(Heroicon::OutlinedPencilSquare),
            ReactivateUserAction::make(),
            Action::make('deactivate')
                ->label('Deactivate')
                ->icon(Heroicon::OutlinedNoSymbol)
                ->color('danger')
                ->visible(fn (User $record): bool => (bool) ($record->is_active && $record->id !== auth()->id() && (auth()->user()?->can('ToggleActive:User') ?? true)))
                ->requiresConfirmation()
                ->modalHeading(fn (User $record): string => "Deactivate User: {$record->name}")
                ->modalDescription('Are you sure you want to deactivate this account? System panel access will be blocked immediately. Reactivation will strictly require Super Admin OTP verification.')
                ->modalSubmitActionLabel('Deactivate User')
                ->action(function (User $record): void {
                    $record->update(['is_active' => false]);

                    Notification::make()
                        ->title('User Deactivated')
                        ->body("{$record->name}'s account has been deactivated.")
                        ->warning()
                        ->send();
                }),
            Action::make('reset_password')
                ->label('Reset Password')
                ->icon(Heroicon::OutlinedKey)
                ->color('warning')
                ->visible(fn (): bool => auth()->user()?->can('ResetPassword:User') ?? true)
                ->modalHeading(fn (User $record): string => "Reset Password for {$record->name}")
                ->modalDescription('Enter a new password for this user.')
                ->modalIcon(Heroicon::OutlinedKey)
                ->schema([
                    TextInput::make('new_password')
                        ->label('New Password')
                        ->password()
                        ->revealable()
                        ->required()
                        ->rule(Password::default()),
                    TextInput::make('new_password_confirmation')
                        ->label('Confirm New Password')
                        ->password()
                        ->revealable()
                        ->required()
                        ->same('new_password'),
                ])
                ->action(function (User $record, array $data): void {
                    $record->update([
                        'password' => Hash::make($data['new_password']),
                    ]);

                    Notification::make()
                        ->title('Password Reset Successful')
                        ->body("The password for {$record->name} has been updated.")
                        ->success()
                        ->send();
                }),
        ];
    }
}
