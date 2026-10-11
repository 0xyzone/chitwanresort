<?php

namespace App\Filament\Resources\Galleries\Tables;

use App\Models\Gallery;
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

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Preview')
                    ->circular()
                    ->defaultImageUrl(fn (Gallery $record): string => $record->image_url),

                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'wildlife_safari' => 'warning',
                        'rooms' => 'primary',
                        'dining' => 'success',
                        'events' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state)))
                    ->sortable(),

                ToggleColumn::make('is_published')
                    ->label('Published')
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Sort')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Album Category')
                    ->options([
                        'rooms' => 'Rooms & Suites',
                        'wildlife_safari' => 'Wildlife & Safari',
                        'resort_grounds' => 'Resort Grounds',
                        'dining' => 'Restaurant & Bar',
                        'events' => 'Events',
                    ]),

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
