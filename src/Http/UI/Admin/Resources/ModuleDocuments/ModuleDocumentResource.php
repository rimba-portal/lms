<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\ModuleDocuments;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Lms\Http\UI\Admin\Resources\ModuleDocuments\Pages\ListModuleDocuments;
use Rimba\Lms\Models\ModuleDocument;
use UnitEnum;

class ModuleDocumentResource extends Resource
{
    protected static ?string $model = ModuleDocument::class;

    protected static string|UnitEnum|null $navigationGroup = 'Lms';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 90;

    protected static ?string $recordTitleAttribute = 'id';

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
            'index' => ListModuleDocuments::route('/'),
            // 'create' => \Rimba\Lms\Http\UI\Admin\Resources\ModuleDocuments\Pages\CreateModuleDocument::route('/create'),
            // 'view' => \Rimba\Lms\Http\UI\Admin\Resources\ModuleDocuments\Pages\ViewModuleDocument::route('/{record}'),
            // 'edit' => \Rimba\Lms\Http\UI\Admin\Resources\ModuleDocuments\Pages\EditModuleDocument::route('/{record}/edit'),
            //
        ];
    }
}
