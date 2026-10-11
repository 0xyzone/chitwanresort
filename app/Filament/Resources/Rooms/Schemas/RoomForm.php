<?php

namespace App\Filament\Resources\Rooms\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class RoomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Room Details')
                    ->contained()
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Basic & Pricing')
                            ->icon(Heroicon::OutlinedCurrencyDollar)
                            ->schema([
                                Section::make('Room Identity & Rates')
                                    ->schema([
                                        Grid::make([
                                            'default' => 1,
                                            'md' => 2,
                                        ])->schema([
                                            TextInput::make('name')
                                                ->label('Room Title')
                                                ->required()
                                                ->maxLength(255)
                                                ->live(onBlur: true)
                                                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                                                ->placeholder('e.g. Deluxe King Room with Balcony'),

                                            TextInput::make('slug')
                                                ->label('URL Slug')
                                                ->required()
                                                ->maxLength(255)
                                                ->unique(ignoreRecord: true),

                                            Select::make('room_category_id')
                                                ->label('Category')
                                                ->relationship('category', 'name')
                                                ->preload()
                                                ->searchable()
                                                ->required(),

                                            TextInput::make('base_price')
                                                ->label('Base Price (NPR per night)')
                                                ->numeric()
                                                ->prefix('NPR')
                                                ->required()
                                                ->helperText('Standard rack rate per night.'),

                                            TextInput::make('bed_type')
                                                ->label('Bedding Configuration')
                                                ->default('King Size Bed')
                                                ->placeholder('e.g. 1 King Size Bed or 2 Twin Beds')
                                                ->required(),

                                            TextInput::make('room_size')
                                                ->label('Floor Area')
                                                ->placeholder('e.g. 380 sq.ft'),
                                        ]),
                                    ]),
                            ]),

                        Tab::make('Capacity, Views & Amenities')
                            ->icon(Heroicon::OutlinedSparkles)
                            ->schema([
                                Section::make('Guest Capacity & Features')
                                    ->schema([
                                        Grid::make([
                                            'default' => 1,
                                            'md' => 3,
                                        ])->schema([
                                            TextInput::make('capacity_adults')
                                                ->label('Adults Capacity')
                                                ->numeric()
                                                ->default(2)
                                                ->required(),

                                            TextInput::make('capacity_children')
                                                ->label('Children Capacity')
                                                ->numeric()
                                                ->default(1)
                                                ->required(),

                                            Select::make('view_type')
                                                ->label('Window / Balcony View')
                                                ->options([
                                                    'River & Forest View' => 'River & Forest View (Narayani)',
                                                    'Garden & Park View' => 'Garden & Park View',
                                                    'Garden View' => 'Garden View',
                                                    'Courtyard View' => 'Courtyard View',
                                                ])
                                                ->default('Garden View')
                                                ->required(),
                                        ]),

                                        TagsInput::make('amenities')
                                            ->label('Included Amenities & Services')
                                            ->placeholder('Type amenity and hit Enter')
                                            ->suggestions([
                                                'Complimentary Breakfast',
                                                'High-speed Free Wi-Fi',
                                                'Private Scenic Balcony',
                                                'Air Conditioning',
                                                'Smart LED TV',
                                                'Mini-Bar Refrigerator',
                                                '24/7 Hot & Cold Running Water',
                                                'Attached Modern Bathroom',
                                                'Electric Kettle with Tea/Coffee',
                                                'Daily Housekeeping',
                                                'Room Service',
                                                'Pickup & Drop Available',
                                            ])
                                            ->columnSpanFull(),

                                        Grid::make([
                                            'default' => 1,
                                            'md' => 3,
                                        ])->schema([
                                            Toggle::make('is_featured')
                                                ->label('Feature on Homepage')
                                                ->default(false),

                                            Toggle::make('is_active')
                                                ->label('Available for Booking')
                                                ->default(true),

                                            TextInput::make('sort_order')
                                                ->label('Display Order')
                                                ->numeric()
                                                ->default(0),
                                        ]),
                                    ]),
                            ]),

                        Tab::make('Photos & Description')
                            ->icon(Heroicon::OutlinedPhoto)
                            ->schema([
                                Section::make('Visual Showcase & Story')
                                    ->schema([
                                        TextInput::make('featured_image')
                                            ->label('Featured Image URL or Storage Path')
                                            ->placeholder('https://... or upload below')
                                            ->helperText('Paste a direct high-res image URL or use file uploader below.'),

                                        FileUpload::make('featured_image_upload')
                                            ->label('Or Upload Main Photo')
                                            ->image()
                                            ->disk('public')
                                            ->directory('rooms')
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

                                        RichEditor::make('description')
                                            ->label('Room Description & Experience')
                                            ->columnSpanFull()
                                            ->placeholder('Highlight unique resort atmosphere, river serenity, and comfort.'),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
