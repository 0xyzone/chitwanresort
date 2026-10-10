<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('User Details')
                    ->contained()
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Account Details')
                            ->icon(Heroicon::OutlinedUser)
                            ->schema([
                                Section::make('Profile Information')
                                    ->description('Manage primary identity and basic profile credentials.')
                                    ->icon(Heroicon::OutlinedIdentification)
                                    ->schema([
                                        FileUpload::make('avatar_url')
                                            ->label('Profile Avatar')
                                            ->avatar()
                                            ->image()
                                            ->disk('public')
                                            ->directory('avatars')
                                            ->visibility('public')
                                            ->maxSize(2048)
                                            ->helperText('Upload a clean square image (JPG, PNG or WebP, up to 2MB).')
                                            ->columnSpanFull(),

                                        Grid::make([
                                            'default' => 1,
                                            'md' => 2,
                                        ])->schema([
                                            TextInput::make('name')
                                                ->label('Full Name')
                                                ->placeholder('e.g. Aarav Sharma')
                                                ->required()
                                                ->maxLength(255)
                                                ->prefixIcon(Heroicon::OutlinedUser),

                                            TextInput::make('email')
                                                ->label('Email Address')
                                                ->placeholder('e.g. user@chitwanresort.com')
                                                ->email()
                                                ->required()
                                                ->maxLength(255)
                                                ->unique(ignoreRecord: true)
                                                ->prefixIcon(Heroicon::OutlinedEnvelope),

                                            TextInput::make('phone')
                                                ->label('Contact Phone Number')
                                                ->placeholder('e.g. +977-9801234567')
                                                ->tel()
                                                ->maxLength(30)
                                                ->prefixIcon(Heroicon::OutlinedPhone),

                                            Toggle::make('is_active')
                                                ->label('Account Status (Active)')
                                                ->helperText('Active accounts can log into panels. Turn off to immediately block system access.')
                                                ->default(true)
                                                ->inline(false),
                                        ]),
                                    ]),
                            ]),

                        Tab::make('Security & Credentials')
                            ->icon(Heroicon::OutlinedKey)
                            ->schema([
                                Section::make('Password & Verification')
                                    ->description('Set password requirements and email verification timestamp.')
                                    ->icon(Heroicon::OutlinedLockClosed)
                                    ->schema([
                                        Grid::make([
                                            'default' => 1,
                                            'md' => 2,
                                        ])->schema([
                                            TextInput::make('password')
                                                ->label('Password')
                                                ->password()
                                                ->revealable()
                                                ->required(fn (string $operation): bool => $operation === 'create')
                                                ->dehydrated(fn (?string $state): bool => filled($state))
                                                ->rule(Password::default())
                                                ->prefixIcon(Heroicon::OutlinedKey)
                                                ->helperText(fn (string $operation): string => $operation === 'edit'
                                                    ? 'Leave blank to preserve existing password.'
                                                    : 'Must contain at least 8 characters.'),

                                            TextInput::make('password_confirmation')
                                                ->label('Confirm Password')
                                                ->password()
                                                ->revealable()
                                                ->required(fn (string $operation): bool => $operation === 'create')
                                                ->same('password')
                                                ->dehydrated(false)
                                                ->prefixIcon(Heroicon::OutlinedKey),
                                        ]),

                                        DateTimePicker::make('email_verified_at')
                                            ->label('Email Verified Date & Time')
                                            ->native(false)
                                            ->prefixIcon(Heroicon::OutlinedCheckCircle)
                                            ->helperText('Specify when the email was verified, or clear to leave unverified.')
                                            ->default(now()),
                                    ]),
                            ]),

                        Tab::make('Roles & Access')
                            ->icon(Heroicon::OutlinedShieldCheck)
                            ->schema([
                                Section::make('Assigned Roles & Panel Access')
                                    ->description('Grant panel permissions through predefined system roles configured in Shield.')
                                    ->icon(Heroicon::OutlinedShieldCheck)
                                    ->schema([
                                        CheckboxList::make('roles')
                                            ->label('System Roles')
                                            ->relationship('roles', 'name')
                                            ->columns([
                                                'default' => 1,
                                                'sm' => 2,
                                                'lg' => 3,
                                            ])
                                            ->gridDirection('row')
                                            ->bulkToggleable()
                                            ->searchable()
                                            ->descriptions(fn () => Role::pluck('name', 'name')->map(fn (string $name): string => match ($name) {
                                                'super_admin' => 'Unrestricted administrator with full access to all panels and settings.',
                                                'panel_user' => 'Standard panel user with baseline access to resort dashboard.',
                                                default => 'Custom role with specific permissions.',
                                            })->toArray()),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
