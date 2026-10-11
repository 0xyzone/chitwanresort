<?php

namespace App\Filament\Resources\Testimonials\Tables;

use App\Models\Testimonial;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Guest')
                    ->circular()
                    ->defaultImageUrl(fn (Testimonial $record): string => $record->avatar_url),

                TextColumn::make('guest_name')
                    ->label('Guest Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('guest_country')
                    ->label('Country / City')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn (int $state): string => str_repeat('★', $state).str_repeat('☆', 5 - $state))
                    ->color('warning')
                    ->weight('bold')
                    ->sortable(),

                TextColumn::make('review_text')
                    ->label('Review')
                    ->limit(50),

                ToggleColumn::make('is_featured')
                    ->label('Featured')
                    ->sortable(),

                ToggleColumn::make('is_published')
                    ->label('Published')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_featured')
                    ->label('Featured Status'),

                TernaryFilter::make('is_published')
                    ->label('Published Status'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
