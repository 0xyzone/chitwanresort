<?php

namespace App\Filament\Resources\Activities\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class ActivityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Activity & Safari Details')
                    ->icon(Heroicon::OutlinedSparkles)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 2,
                        ])->schema([
                            TextInput::make('title')
                                ->label('Activity Title')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                                ->placeholder('e.g. Chitwan Jeep Safari Exploration'),

                            TextInput::make('slug')
                                ->label('URL Slug')
                                ->required()
                                ->maxLength(255)
                                ->unique(ignoreRecord: true),

                            TextInput::make('duration')
                                ->label('Duration')
                                ->placeholder('e.g. 4 Hours (Half Day)'),

                            Select::make('difficulty')
                                ->label('Experience Level / Type')
                                ->options([
                                    'Easy' => 'Easy / Family Friendly',
                                    'Moderate' => 'Moderate Walk',
                                    'Relaxing' => 'Relaxing River Drift',
                                    'Cultural Evening' => 'Cultural Evening',
                                ])
                                ->default('Easy'),

                            TextInput::make('price_per_person')
                                ->label('Price Per Person (NPR)')
                                ->numeric()
                                ->prefix('NPR')
                                ->placeholder('e.g. 2500'),

                            TextInput::make('featured_image')
                                ->label('Photo URL or Path')
                                ->placeholder('https://... or upload below'),
                        ]),

                        FileUpload::make('featured_image_upload')
                            ->label('Or Upload Photo')
                            ->image()
                            ->disk('public')
                            ->directory('activities')
                            ->visibility('public')
                            ->dehydrated(false)
                            ->afterStateHydrated(function ($component, $state, $record) {
                                if ($record && $record->featured_image && ! str_starts_with($record->featured_image, 'http')) {
                                    $component->state($record->featured_image);
                                }
                            })
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $set('featured_image', $state);
                                }
                            }),

                        Textarea::make('excerpt')
                            ->label('Short Summary Excerpt')
                            ->rows(2)
                            ->columnSpanFull()
                            ->placeholder('Brief hook shown on cards and highlights.'),

                        RichEditor::make('description')
                            ->label('Detailed Itinerary & Information')
                            ->columnSpanFull()
                            ->placeholder('Full itinerary, wildlife expectations, safety briefings, and timings.'),

                        Grid::make([
                            'default' => 1,
                            'md' => 3,
                        ])->schema([
                            Toggle::make('is_featured')
                                ->label('Feature on Homepage')
                                ->default(false),

                            Toggle::make('is_active')
                                ->label('Available Activity')
                                ->default(true),

                            TextInput::make('sort_order')
                                ->label('Display Order')
                                ->numeric()
                                ->default(0),
                        ]),
                    ]),
            ]);
    }
}
