<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\Modules;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Lms\Http\UI\Admin\Resources\Modules\Pages\ListModules;
use Rimba\Lms\Models\Module;
use UnitEnum;

class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;

    protected static string|UnitEnum|null $navigationGroup = 'Lms';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 89;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListModules::route('/'),
            // 'create' => \Rimba\Lms\Http\UI\Admin\Resources\Modules\Pages\CreateModule::route('/create'),
            // 'view' => \Rimba\Lms\Http\UI\Admin\Resources\Modules\Pages\ViewModule::route('/{record}'),
            // 'edit' => \Rimba\Lms\Http\UI\Admin\Resources\Modules\Pages\EditModule::route('/{record}/edit'),
            //
        ];
    }
}
