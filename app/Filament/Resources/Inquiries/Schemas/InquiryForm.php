<?php

namespace App\Filament\Resources\Inquiries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class InquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Guest Contact Details')
                    ->icon(Heroicon::OutlinedUser)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 3,
                        ])->schema([
                            TextInput::make('name')
                                ->label('Sender Name')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('email')
                                ->label('Email Address')
                                ->email()
                                ->required()
                                ->maxLength(255),

                            TextInput::make('phone')
                                ->label('Contact Phone')
                                ->tel()
                                ->maxLength(30),
                        ]),
                    ]),

                Section::make('Message & Follow-up')
                    ->icon(Heroicon::OutlinedChatBubbleLeftRight)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 2,
                        ])->schema([
                            TextInput::make('subject')
                                ->label('Inquiry Subject')
                                ->placeholder('e.g. Wedding Reception Inquiry')
                                ->columnSpanFull(),

                            Textarea::make('message')
                                ->label('Message Content')
                                ->rows(4)
                                ->required()
                                ->columnSpanFull(),

                            Select::make('status')
                                ->label('Inquiry Status')
                                ->options([
                                    'unread' => 'Unread / New',
                                    'contacted' => 'Contacted / Followed Up',
                                    'closed' => 'Closed / Resolved',
                                ])
                                ->default('unread')
                                ->required(),

                            Textarea::make('admin_notes')
                                ->label('Internal Follow-up Notes')
                                ->rows(3)
                                ->placeholder('Call notes or quoted package details.'),
                        ]),
                    ]),
            ]);
    }
}
