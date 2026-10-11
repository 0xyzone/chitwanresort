<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use App\Models\Testimonial;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Guest Review')
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 3,
                        ])->schema([
                            ImageEntry::make('avatar')
                                ->label('Guest Avatar')
                                ->circular()
                                ->defaultImageUrl(fn (Testimonial $record): string => $record->avatar_url)
                                ->columnSpan(1),

                            Grid::make(1)->schema([
                                TextEntry::make('guest_name')
                                    ->label('Guest Name')
                                    ->size('lg')
                                    ->weight('bold'),

                                TextEntry::make('guest_country')
                                    ->label('Origin / Country')
                                    ->badge(),

                                TextEntry::make('rating')
                                    ->label('Rating')
                                    ->formatStateUsing(fn (int $state): string => str_repeat('★', $state)." ({$state} / 5 Stars)")
                                    ->color('warning'),

                                TextEntry::make('review_text')
                                    ->label('Review Quote')
                                    ->columnSpanFull(),
                            ])->columnSpan(2),
                        ]),
                    ]),
            ]);
    }
}
