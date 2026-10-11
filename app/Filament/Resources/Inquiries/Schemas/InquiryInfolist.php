<?php

namespace App\Filament\Resources\Inquiries\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class InquiryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Inquiry Details')
                    ->icon(Heroicon::OutlinedChatBubbleLeftRight)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 3,
                        ])->schema([
                            TextEntry::make('name')
                                ->label('Sender Name')
                                ->weight('bold'),

                            TextEntry::make('email')
                                ->label('Email Address')
                                ->icon(Heroicon::OutlinedEnvelope)
                                ->copyable(),

                            TextEntry::make('phone')
                                ->label('Phone Number')
                                ->icon(Heroicon::OutlinedPhone)
                                ->copyable()
                                ->placeholder('Not provided'),

                            TextEntry::make('status')
                                ->label('Status')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'unread' => 'danger',
                                    'contacted' => 'info',
                                    'closed' => 'success',
                                    default => 'gray',
                                })
                                ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                            TextEntry::make('subject')
                                ->label('Subject')
                                ->columnSpan(2),

                            TextEntry::make('message')
                                ->label('Message')
                                ->columnSpanFull(),

                            TextEntry::make('admin_notes')
                                ->label('Follow-up Notes')
                                ->placeholder('No internal notes added')
                                ->columnSpanFull(),
                        ]),
                    ]),
            ]);
    }
}
