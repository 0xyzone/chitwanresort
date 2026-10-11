<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Resources\Users\Actions\ReactivateUserAction;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar_url')
                    ->label('Avatar')
                    ->circular()
                    ->defaultImageUrl(fn (User $record): string => 'https://ui-avatars.com/api/?name='.urlencode($record->name).'&color=F97316&background=FFEDD5'),

                TextColumn::make('name')
                    ->label('Full Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('email')
                    ->label('Email Address')
                    ->searchable()
                    ->sortable()
                    ->icon(Heroicon::OutlinedEnvelope)
                    ->copyable(),

                TextColumn::make('phone')
                    ->label('Phone Number')
                    ->searchable()
                    ->icon(Heroicon::OutlinedPhone)
                    ->placeholder('—')
                    ->toggleable(),

                TextColumn::make('roles.name')
                    ->label('Roles')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'super_admin' => 'danger',
                        'admin' => 'warning',
                        default => 'info',
                    })
                    ->searchable(),

                ToggleColumn::make('is_active')
                    ->label('Active')
                    ->sortable()
                    ->disabled(fn (?User $record): bool => ! ($record?->is_active) || $record?->id === auth()->id() || ! (auth()->user()?->can('ToggleActive:User') ?? true))
                    ->tooltip(fn (?User $record): ?string => (! $record?->is_active) ? 'Reactivation requires Super Admin OTP verification. Use the Reactivate action.' : 'Click to deactivate account.'),

                IconColumn::make('email_verified_at')
                    ->label('Verified')
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedCheckCircle)
                    ->falseIcon(Heroicon::OutlinedXCircle)
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Registered')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Account Status')
                    ->placeholder('All accounts')
                    ->trueLabel('Active accounts')
                    ->falseLabel('Inactive accounts'),

                TernaryFilter::make('email_verified_at')
                    ->label('Email Verification')
                    ->nullable()
                    ->placeholder('All accounts')
                    ->trueLabel('Verified')
                    ->falseLabel('Unverified'),

                SelectFilter::make('roles')
                    ->label('Filter by Role')
                    ->relationship('roles', 'name')
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                ReactivateUserAction::make(),
                Action::make('deactivate')
                    ->label('Deactivate')
                    ->icon(Heroicon::OutlinedNoSymbol)
                    ->color('danger')
                    ->visible(fn (User $record): bool => (bool) ($record->is_active && $record->id !== auth()->id() && (auth()->user()?->can('ToggleActive:User') ?? true)))
                    ->requiresConfirmation()
                    ->modalHeading(fn (User $record): string => "Deactivate User: {$record->name}")
                    ->modalDescription('Are you sure you want to deactivate this account? System panel access will be immediately blocked. Reactivating this user will strictly require Super Admin OTP verification.')
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
                    ->modalDescription('Enter a new password for this user. They will immediately use this to log in.')
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
                DeleteAction::make()
                    ->hidden(fn (User $record): bool => $record->id === auth()->id()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->action(function (Collection $records): void {
                            $filtered = $records->reject(fn (User $user): bool => $user->id === auth()->id());
                            $filtered->each->delete();

                            Notification::make()
                                ->title('Selected users deleted')
                                ->body('Users were deleted successfully. Your own account was protected.')
                                ->success()
                                ->send();
                        }),
                ]),
            ]);
    }
}
