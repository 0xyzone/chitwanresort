<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Models\Room;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Guest Information')
                    ->icon(Heroicon::OutlinedUser)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 3,
                        ])->schema([
                            TextInput::make('guest_name')
                                ->label('Full Name')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('e.g. Ramesh Poudel'),

                            TextInput::make('guest_phone')
                                ->label('Contact Phone / WhatsApp')
                                ->tel()
                                ->required()
                                ->maxLength(25)
                                ->placeholder('e.g. 9841234567'),

                            TextInput::make('guest_email')
                                ->label('Email Address')
                                ->email()
                                ->required()
                                ->maxLength(255)
                                ->placeholder('e.g. ramesh@example.com'),
                        ]),
                    ]),

                Section::make('Stay & Room Selection')
                    ->icon(Heroicon::OutlinedCalendarDays)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 3,
                        ])->schema([
                            Select::make('room_id')
                                ->label('Reserved Room')
                                ->relationship('room', 'name')
                                ->preload()
                                ->searchable()
                                ->required()
                                ->live()
                                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                    static::recalculateTotal($set, $get);
                                }),

                            DatePicker::make('check_in_date')
                                ->label('Check-In Date')
                                ->native(false)
                                ->required()
                                ->live()
                                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                    static::recalculateTotal($set, $get);
                                }),

                            DatePicker::make('check_out_date')
                                ->label('Check-Out Date')
                                ->native(false)
                                ->required()
                                ->live()
                                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                    static::recalculateTotal($set, $get);
                                }),

                            TextInput::make('adults')
                                ->label('Adults')
                                ->numeric()
                                ->default(1)
                                ->minValue(1)
                                ->required(),

                            TextInput::make('children')
                                ->label('Children')
                                ->numeric()
                                ->default(0)
                                ->minValue(0),

                            TextInput::make('total_amount')
                                ->label('Total Payable (NPR)')
                                ->numeric()
                                ->prefix('NPR')
                                ->required(),
                        ]),
                    ]),

                Section::make('Reservation Status & Notes')
                    ->icon(Heroicon::OutlinedClipboardDocumentCheck)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 2,
                        ])->schema([
                            Select::make('status')
                                ->label('Booking Status')
                                ->options([
                                    'pending' => 'Pending Confirmation',
                                    'confirmed' => 'Confirmed',
                                    'checked_in' => 'Checked In',
                                    'completed' => 'Completed / Checked Out',
                                    'cancelled' => 'Cancelled',
                                ])
                                ->default('pending')
                                ->required(),

                            Select::make('payment_status')
                                ->label('Payment Status')
                                ->options([
                                    'unpaid' => 'Unpaid',
                                    'partial' => 'Partially Paid / Advance',
                                    'paid' => 'Fully Paid',
                                ])
                                ->default('unpaid')
                                ->required(),

                            Textarea::make('special_requests')
                                ->label('Guest Special Requests')
                                ->rows(3)
                                ->placeholder('Safari timing, dietary preferences, airport pickup details...'),

                            Textarea::make('admin_notes')
                                ->label('Internal Reception Notes')
                                ->rows(3)
                                ->placeholder('Advance payment receipt number, room keys handed over, etc.'),
                        ]),
                    ]),
            ]);
    }

    protected static function recalculateTotal(callable $set, callable $get): void
    {
        $roomId = $get('room_id');
        $checkIn = $get('check_in_date');
        $checkOut = $get('check_out_date');

        if ($roomId && $checkIn && $checkOut) {
            $room = Room::find($roomId);
            if ($room) {
                $cIn = Carbon::parse($checkIn);
                $cOut = Carbon::parse($checkOut);
                $nights = max(1, $cIn->diffInDays($cOut));
                $set('total_amount', (float) $room->base_price * $nights);
            }
        }
    }
}
