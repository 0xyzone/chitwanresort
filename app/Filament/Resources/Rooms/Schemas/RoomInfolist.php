<?php

namespace App\Filament\Resources\Rooms\Schemas;

use App\Models\Room;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class RoomInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Room Showcase')
                    ->icon(Heroicon::OutlinedHomeModern)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 3,
                        ])->schema([
                            ImageEntry::make('featured_image')
                                ->label('Main Photo')
                                ->defaultImageUrl(fn (Room $record): string => $record->featured_image_url)
                                ->columnSpan(1),

                            Grid::make(1)->schema([
                                TextEntry::make('name')
                                    ->label('Room Name')
                                    ->size('lg')
                                    ->weight('bold'),

                                TextEntry::make('category.name')
                                    ->label('Category')
                                    ->badge()
                                    ->color('primary'),

                                TextEntry::make('base_price')
                                    ->label('Nightly Rate')
                                    ->money('NPR')
                                    ->size('lg')
                                    ->weight('bold')
                                    ->color('warning'),

                                TextEntry::make('view_type')
                                    ->label('View')
                                    ->badge(),
                            ])->columnSpan(2),
                        ]),
                    ]),

                Section::make('Specifications & Amenities')
                    ->icon(Heroicon::OutlinedSparkles)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 3,
                        ])->schema([
                            TextEntry::make('bed_type')
                                ->label('Bedding'),

                            TextEntry::make('room_size')
                                ->label('Floor Size')
                                ->placeholder('Standard layout'),

                            TextEntry::make('capacity')
                                ->label('Capacity')
                                ->state(fn (Room $record): string => "{$record->capacity_adults} Adults + {$record->capacity_children} Children"),

                            IconEntry::make('is_featured')
                                ->label('Featured on Website')
                                ->boolean(),

                            IconEntry::make('is_active')
                                ->label('Active Booking Status')
                                ->boolean(),

                            TextEntry::make('amenities')
                                ->label('Included Amenities')
                                ->badge()
                                ->color('success')
                                ->columnSpanFull(),

                            TextEntry::make('description')
                                ->label('Full Story / Description')
                                ->html()
                                ->columnSpanFull(),
                        ]),
                    ]),
            ]);
    }
}
