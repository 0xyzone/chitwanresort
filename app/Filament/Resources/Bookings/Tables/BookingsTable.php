<?php

namespace App\Filament\Resources\Bookings\Tables;

use App\Models\Booking;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking_code')
                    ->label('Reference')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable(),

                TextColumn::make('guest_name')
                    ->label('Guest Name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Booking $record): string => $record->guest_email),

                TextColumn::make('guest_phone')
                    ->label('Phone / WhatsApp')
                    ->searchable()
                    ->icon(Heroicon::OutlinedPhone)
                    ->copyable(),

                TextColumn::make('room.name')
                    ->label('Room')
                    ->badge()
                    ->color('primary')
                    ->searchable(),

                TextColumn::make('check_in_date')
                    ->label('Dates')
                    ->formatStateUsing(fn (Booking $record): string => $record->check_in_date->format('M d').' → '.$record->check_out_date->format('M d, Y'))
                    ->description(fn (Booking $record): string => "{$record->nights} Night(s)"),

                TextColumn::make('total_amount')
                    ->label('Total (NPR)')
                    ->money('NPR')
                    ->weight('bold')
                    ->color('warning')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'info',
                        'checked_in' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst(str_replace('_', ' ', $state)))
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->label('Payment')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'partial' => 'warning',
                        default => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Booked On')
                    ->dateTime('M d, Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending Confirmation',
                        'confirmed' => 'Confirmed',
                        'checked_in' => 'Checked In',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),

                SelectFilter::make('payment_status')
                    ->label('Payment')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'partial' => 'Partial / Advance',
                        'paid' => 'Paid',
                    ]),

                SelectFilter::make('room_id')
                    ->label('Room')
                    ->relationship('room', 'name')
                    ->preload(),
            ])
            ->recordActions([
                Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon(Heroicon::OutlinedChatBubbleLeftRight)
                    ->color('success')
                    ->url(fn (Booking $record): string => $record->whatsapp_url)
                    ->openUrlInNewTab(),

                Action::make('confirm')
                    ->label('Confirm')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('info')
                    ->visible(fn (Booking $record): bool => $record->status === 'pending')
                    ->action(function (Booking $record): void {
                        $record->update(['status' => 'confirmed']);
                        Notification::make()
                            ->title('Reservation Confirmed')
                            ->body("Booking #{$record->booking_code} has been marked as confirmed.")
                            ->success()
                            ->send();
                    }),

                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
