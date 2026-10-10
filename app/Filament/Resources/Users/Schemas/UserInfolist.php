<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profile Overview')
                    ->icon(Heroicon::OutlinedUserCircle)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 3,
                        ])->schema([
                            ImageEntry::make('avatar_url')
                                ->label('Profile Photo')
                                ->circular()
                                ->defaultImageUrl(fn ($record): string => 'https://ui-avatars.com/api/?name='.urlencode($record->name).'&color=F97316&background=FFEDD5')
                                ->columnSpan(1),

                            Grid::make(1)->schema([
                                TextEntry::make('name')
                                    ->label('Full Name')
                                    ->size('lg')
                                    ->weight('bold'),

                                TextEntry::make('email')
                                    ->label('Email Address')
                                    ->icon(Heroicon::OutlinedEnvelope)
                                    ->copyable(),

                                TextEntry::make('phone')
                                    ->label('Phone Number')
                                    ->icon(Heroicon::OutlinedPhone)
                                    ->placeholder('Not provided'),
                            ])->columnSpan(2),
                        ]),
                    ]),

                Section::make('Access & Role Permissions')
                    ->icon(Heroicon::OutlinedShieldCheck)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 2,
                        ])->schema([
                            TextEntry::make('roles.name')
                                ->label('Assigned Roles')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'super_admin' => 'danger',
                                    'admin' => 'warning',
                                    default => 'info',
                                })
                                ->placeholder('No roles assigned'),

                            TextEntry::make('is_active')
                                ->label('Account Status')
                                ->badge()
                                ->formatStateUsing(fn (bool $state): string => $state ? 'Active' : 'Inactive')
                                ->color(fn (bool $state): string => $state ? 'success' : 'danger'),

                            TextEntry::make('email_verified_at')
                                ->label('Email Verification')
                                ->dateTime('M d, Y H:i')
                                ->placeholder('Unverified')
                                ->badge()
                                ->color(fn ($state): string => $state ? 'success' : 'gray'),

                            TextEntry::make('created_at')
                                ->label('Account Created')
                                ->dateTime('M d, Y H:i')
                                ->icon(Heroicon::OutlinedCalendar),
                        ]),
                    ]),
            ]);
    }
}
