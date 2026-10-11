<?php

namespace App\Filament\Resources\RoomCategories\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RoomCategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category Overview')
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 3,
                        ])->schema([
                            TextEntry::make('name')
                                ->label('Name')
                                ->size('lg')
                                ->weight('bold'),

                            TextEntry::make('slug')
                                ->label('Slug')
                                ->badge()
                                ->color('gray'),

                            IconEntry::make('is_active')
                                ->label('Status')
                                ->boolean(),

                            TextEntry::make('rooms_count')
                                ->label('Total Rooms in Category')
                                ->state(fn ($record) => $record->rooms()->count())
                                ->badge()
                                ->color('primary'),

                            TextEntry::make('description')
                                ->label('Description')
                                ->columnSpanFull(),
                        ]),
                    ]),
            ]);
    }
}
