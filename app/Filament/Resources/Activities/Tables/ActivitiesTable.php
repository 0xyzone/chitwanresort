<?php

namespace App\Filament\Resources\Activities\Tables;

use App\Models\Activity;
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

class ActivitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl(fn (Activity $record): string => $record->featured_image_url),

                TextColumn::make('title')
                    ->label('Activity Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('duration')
                    ->label('Duration')
                    ->badge()
                    ->color('info'),

                TextColumn::make('difficulty')
                    ->label('Type')
                    ->badge(),

                TextColumn::make('price_per_person')
                    ->label('Price / Person')
                    ->money('NPR')
                    ->color('warning')
                    ->placeholder('Included / Variable'),

                ToggleColumn::make('is_featured')
                    ->label('Featured')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Active')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active Status'),

                TernaryFilter::make('is_featured')
                    ->label('Featured Status'),
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
