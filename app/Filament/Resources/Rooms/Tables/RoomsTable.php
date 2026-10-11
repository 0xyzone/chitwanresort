<?php

namespace App\Filament\Resources\Rooms\Tables;

use App\Models\Room;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class RoomsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl(fn (Room $record): string => $record->featured_image_url),

                TextColumn::make('name')
                    ->label('Room Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                TextColumn::make('base_price')
                    ->label('Rate (NPR)')
                    ->money('NPR')
                    ->sortable()
                    ->weight('semibold')
                    ->color('warning'),

                TextColumn::make('view_type')
                    ->label('View')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'River & Forest View' => 'info',
                        'Garden & Park View' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('capacity_adults')
                    ->label('Capacity')
                    ->formatStateUsing(fn (Room $record): string => "{$record->capacity_adults} Adults, {$record->capacity_children} Ch.")
                    ->color('gray'),

                ToggleColumn::make('is_featured')
                    ->label('Featured')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Active')
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Sort')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('room_category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->preload(),

                SelectFilter::make('view_type')
                    ->label('View Type')
                    ->options([
                        'River & Forest View' => 'River & Forest View',
                        'Garden & Park View' => 'Garden & Park View',
                        'Garden View' => 'Garden View',
                    ]),

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
