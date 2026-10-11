<?php

namespace App\Filament\Resources\Galleries\Schemas;

use App\Models\Gallery;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Photo & Media Details')
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 3,
                        ])->schema([
                            ImageEntry::make('image_path')
                                ->label('Photo')
                                ->defaultImageUrl(fn (Gallery $record): string => $record->image_url)
                                ->columnSpan(1),

                            Grid::make(1)->schema([
                                TextEntry::make('title')
                                    ->label('Title')
                                    ->size('lg')
                                    ->weight('bold'),

                                TextEntry::make('category')
                                    ->label('Category')
                                    ->badge()
                                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state))),

                                IconEntry::make('is_published')
                                    ->label('Published on Website')
                                    ->boolean(),

                                TextEntry::make('caption')
                                    ->label('Caption')
                                    ->placeholder('No caption entered'),
                            ])->columnSpan(2),
                        ]),
                    ]),
            ]);
    }
}
