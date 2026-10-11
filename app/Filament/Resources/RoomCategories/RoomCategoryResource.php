<?php

namespace App\Filament\Resources\RoomCategories;

use Agroezinger\FilamentShieldEnhanced\Traits\HasResourceShield;
use App\Filament\Resources\RoomCategories\Pages\CreateRoomCategory;
use App\Filament\Resources\RoomCategories\Pages\EditRoomCategory;
use App\Filament\Resources\RoomCategories\Pages\ListRoomCategories;
use App\Filament\Resources\RoomCategories\Pages\ViewRoomCategory;
use App\Filament\Resources\RoomCategories\Schemas\RoomCategoryForm;
use App\Filament\Resources\RoomCategories\Schemas\RoomCategoryInfolist;
use App\Filament\Resources\RoomCategories\Tables\RoomCategoriesTable;
use App\Models\RoomCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RoomCategoryResource extends Resource
{
    use HasResourceShield;

    protected static ?string $model = RoomCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Accommodations';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return RoomCategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RoomCategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RoomCategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoomCategories::route('/'),
            'create' => CreateRoomCategory::route('/create'),
            'view' => ViewRoomCategory::route('/{record}'),
            'edit' => EditRoomCategory::route('/{record}/edit'),
        ];
    }
}
