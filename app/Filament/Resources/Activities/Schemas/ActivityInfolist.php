<?php

namespace App\Filament\Resources\Activities\Schemas;

use App\Models\Activity;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ActivityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Activity Details')
                    ->icon(Heroicon::OutlinedSparkles)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 3,
                        ])->schema([
                            ImageEntry::make('featured_image')
                                ->label('Main Photo')
                                ->defaultImageUrl(fn (Activity $record): string => $record->featured_image_url)
                                ->columnSpan(1),

                            Grid::make(1)->schema([
                                TextEntry::make('title')
                                    ->label('Title')
                                    ->size('lg')
                                    ->weight('bold'),

                                TextEntry::make('duration')
                                    ->label('Duration')
                                    ->badge()
                                    ->color('info'),

                                TextEntry::make('difficulty')
                                    ->label('Type / Level')
                                    ->badge(),

                                TextEntry::make('price_per_person')
                                    ->label('Price Per Person')
                                    ->money('NPR')
                                    ->placeholder('Included in package / Custom rate'),
                            ])->columnSpan(2),

                            TextEntry::make('excerpt')
                                ->label('Short Summary')
                                ->columnSpanFull(),

                            TextEntry::make('description')
                                ->label('Full Itinerary & Details')
                                ->html()
                                ->columnSpanFull(),
                        ]),
                    ]),
            ]);
    }
}
