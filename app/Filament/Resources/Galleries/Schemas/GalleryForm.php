<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Photo & Media Showcase')
                    ->icon(Heroicon::OutlinedPhoto)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 2,
                        ])->schema([
                            TextInput::make('title')
                                ->label('Media Title')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('e.g. Sunset on Narayani River'),

                            Select::make('category')
                                ->label('Album Category')
                                ->options([
                                    'rooms' => 'Rooms & Suites',
                                    'wildlife_safari' => 'Wildlife & Safari',
                                    'resort_grounds' => 'Resort Grounds & Serenity',
                                    'dining' => 'Restaurant & Bar',
                                    'events' => 'Events & Gatherings',
                                ])
                                ->default('resort_grounds')
                                ->required(),

                            TextInput::make('image_path')
                                ->label('Image URL or Path')
                                ->placeholder('https://... or upload file below'),

                            TextInput::make('video_url')
                                ->label('Optional Video URL (YouTube / Vimeo)')
                                ->placeholder('https://www.youtube.com/watch?v=...'),
                        ]),

                        FileUpload::make('image_upload')
                            ->label('Or Upload Photo')
                            ->image()
                            ->disk('public')
                            ->directory('gallery')
                            ->visibility('public')
                            ->dehydrated(false)
                            ->afterStateHydrated(function ($component, $state, $record) {
                                if ($record && $record->image_path && ! str_starts_with($record->image_path, 'http')) {
                                    $component->state($record->image_path);
                                }
                            })
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $set('image_path', $state);
                                }
                            }),

                        Textarea::make('caption')
                            ->label('Caption / Story')
                            ->rows(2)
                            ->placeholder('Short description or location context.'),

                        Grid::make([
                            'default' => 1,
                            'md' => 2,
                        ])->schema([
                            Toggle::make('is_published')
                                ->label('Published on Website')
                                ->default(true),

                            TextInput::make('sort_order')
                                ->label('Sort Order')
                                ->numeric()
                                ->default(0),
                        ]),
                    ]),
            ]);
    }
}
