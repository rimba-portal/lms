<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Modules;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Lms\Http\UI\Staff\Resources\Modules\Pages\CreateModule;
use Rimba\Lms\Http\UI\Staff\Resources\Modules\Pages\EditModule;
use Rimba\Lms\Http\UI\Staff\Resources\Modules\Pages\ListModules;
use Rimba\Lms\Http\UI\Staff\Resources\Modules\Pages\ViewModule;
use Rimba\Lms\Http\UI\Staff\Resources\Modules\Schemas\ModuleForm;
use Rimba\Lms\Http\UI\Staff\Resources\Modules\Schemas\ModuleInfolist;
use Rimba\Lms\Http\UI\Staff\Resources\Modules\Tables\ModulesTable;
use Rimba\Lms\Models\Module;
use UnitEnum;

class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;

    protected static string|BackedEnum|null $navigationIcon = 'bites-lms-module';

    protected static string|UnitEnum|null $navigationGroup = 'Learning';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ModuleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ModuleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModulesTable::configure($table);
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
            'create' => CreateModule::route('/create'),
            'view' => ViewModule::route('/{record}'),
            'edit' => EditModule::route('/{record}/edit'),
        ];
    }
}
