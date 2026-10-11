<?php

namespace App\Filament\Resources\Inquiries\Tables;

use App\Models\Inquiry;
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

class InquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Guest Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('subject')
                    ->label('Subject')
                    ->searchable()
                    ->placeholder('General Inquiry')
                    ->limit(40),

                TextColumn::make('email')
                    ->label('Email')
                    ->icon(Heroicon::OutlinedEnvelope)
                    ->copyable()
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->icon(Heroicon::OutlinedPhone)
                    ->copyable()
                    ->placeholder('—'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'unread' => 'danger',
                        'contacted' => 'info',
                        'closed' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'unread' => 'Unread',
                        'contacted' => 'Contacted',
                        'closed' => 'Closed',
                    ]),
            ])
            ->recordActions([
                Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon(Heroicon::OutlinedChatBubbleLeftRight)
                    ->color('success')
                    ->visible(fn (Inquiry $record): bool => filled($record->phone))
                    ->url(fn (Inquiry $record): string => (string) $record->whatsapp_url)
                    ->openUrlInNewTab(),

                Action::make('mark_contacted')
                    ->label('Mark Contacted')
                    ->icon(Heroicon::OutlinedCheck)
                    ->color('info')
                    ->visible(fn (Inquiry $record): bool => $record->status === 'unread')
                    ->action(function (Inquiry $record): void {
                        $record->update(['status' => 'contacted']);
                        Notification::make()
                            ->title('Inquiry Updated')
                            ->body("Marked inquiry from {$record->name} as contacted.")
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
