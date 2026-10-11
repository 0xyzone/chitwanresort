<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Guest Review & Feedback')
                    ->icon(Heroicon::OutlinedStar)
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 3,
                        ])->schema([
                            TextInput::make('guest_name')
                                ->label('Guest Name')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('e.g. Elena Rostova'),

                            TextInput::make('guest_country')
                                ->label('Location / Country')
                                ->default('Nepal')
                                ->placeholder('e.g. Germany or Kathmandu'),

                            Select::make('rating')
                                ->label('Star Rating')
                                ->options([
                                    5 => '★★★★★ (5 Stars)',
                                    4 => '★★★★☆ (4 Stars)',
                                    3 => '★★★☆☆ (3 Stars)',
                                    2 => '★★☆☆☆ (2 Stars)',
                                    1 => '★☆☆☆☆ (1 Star)',
                                ])
                                ->default(5)
                                ->required(),
                        ]),

                        Textarea::make('review_text')
                            ->label('Guest Review Text')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull()
                            ->placeholder('Quote the guest review or feedback.'),

                        Grid::make([
                            'default' => 1,
                            'md' => 2,
                        ])->schema([
                            TextInput::make('avatar')
                                ->label('Guest Photo URL (or leave blank for auto-avatar)')
                                ->placeholder('https://...'),

                            FileUpload::make('avatar_upload')
                                ->label('Or Upload Photo')
                                ->image()
                                ->avatar()
                                ->disk('public')
                                ->directory('testimonials')
                                ->visibility('public')
                                ->dehydrated(false)
                                ->afterStateHydrated(function ($component, $state, $record) {
                                    if ($record && $record->avatar && ! str_starts_with($record->avatar, 'http')) {
                                        $component->state($record->avatar);
                                    }
                                })
                                ->afterStateUpdated(function ($state, callable $set) {
                                    if ($state) {
                                        $set('avatar', $state);
                                    }
                                }),
                        ]),

                        Grid::make([
                            'default' => 1,
                            'md' => 3,
                        ])->schema([
                            Toggle::make('is_featured')
                                ->label('Show on Homepage Slider')
                                ->default(true),

                            Toggle::make('is_published')
                                ->label('Published')
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
