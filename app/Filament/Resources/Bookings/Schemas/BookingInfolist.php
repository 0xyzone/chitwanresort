<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Models\Booking;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class BookingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Reservation Overview')
                    ->icon(Heroicon::OutlinedCalendarDays)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 4,
                        ])->schema([
                            TextEntry::make('booking_code')
                                ->label('Reference Code')
                                ->size('lg')
                                ->weight('bold')
                                ->copyable(),

                            TextEntry::make('status')
                                ->label('Booking Status')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'confirmed' => 'info',
                                    'checked_in' => 'primary',
                                    'completed' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'warning',
                                })
                                ->formatStateUsing(fn (string $state): string => ucfirst(str_replace('_', ' ', $state))),

                            TextEntry::make('payment_status')
                                ->label('Payment Status')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'paid' => 'success',
                                    'partial' => 'warning',
                                    default => 'danger',
                                })
                                ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                            TextEntry::make('total_amount')
                                ->label('Total Payable')
                                ->money('NPR')
                                ->size('lg')
                                ->weight('bold')
                                ->color('warning'),
                        ]),
                    ]),

                Section::make('Guest & Room Information')
                    ->icon(Heroicon::OutlinedUser)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 3,
                        ])->schema([
                            TextEntry::make('guest_name')
                                ->label('Guest Name')
                                ->weight('bold'),

                            TextEntry::make('guest_phone')
                                ->label('Phone Number')
                                ->icon(Heroicon::OutlinedPhone)
                                ->copyable(),

                            TextEntry::make('guest_email')
                                ->label('Email Address')
                                ->icon(Heroicon::OutlinedEnvelope)
                                ->copyable(),

                            TextEntry::make('room.name')
                                ->label('Reserved Room')
                                ->badge()
                                ->color('primary'),

                            TextEntry::make('stay_dates')
                                ->label('Stay Dates')
                                ->state(fn (Booking $record): string => $record->check_in_date->format('M d, Y').' to '.$record->check_out_date->format('M d, Y')." ({$record->nights} nights)"),

                            TextEntry::make('guests')
                                ->label('Occupancy')
                                ->state(fn (Booking $record): string => "{$record->adults} Adults, {$record->children} Children"),

                            TextEntry::make('special_requests')
                                ->label('Guest Requests')
                                ->placeholder('None provided')
                                ->columnSpanFull(),

                            TextEntry::make('admin_notes')
                                ->label('Internal Reception Notes')
                                ->placeholder('None')
                                ->columnSpanFull(),
                        ]),
                    ]),
            ]);
    }
}
