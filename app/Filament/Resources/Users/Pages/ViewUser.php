<?php

namespace App\Filament\Resources\Users\Pages;

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
