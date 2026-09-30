<?php

namespace Rimba\Lms\Http\UI\Admin\Resources\VersionQuestionSchemas;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VersionQuestionSchemaResource extends Resource
{
    protected static ?string $model = \Rimba\Lms\Models\VersionQuestionSchema::class;

    protected static string|UnitEnum|null $navigationGroup = 'Lms';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 95;

    protected static ?string $recordTitleAttribute = 'schema_key';

    public static function form(Schema $schema): Schema { return $schema->components([]); }

    public static function infolist(Schema $schema): Schema { return $schema->components([]); }

    public static function table(Table $table): Table { return $table->columns([]); }

    public static function getRelations(): array 
    { 
        return [ 
            // 
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Rimba\Lms\Http\UI\Admin\Resources\VersionQuestionSchemas\Pages\ListVersionQuestionSchemas::route('/'),
            // 'create' => \Rimba\Lms\Http\UI\Admin\Resources\VersionQuestionSchemas\Pages\CreateVersionQuestionSchema::route('/create'),
            // 'view' => \Rimba\Lms\Http\UI\Admin\Resources\VersionQuestionSchemas\Pages\ViewVersionQuestionSchema::route('/{record}'),
            // 'edit' => \Rimba\Lms\Http\UI\Admin\Resources\VersionQuestionSchemas\Pages\EditVersionQuestionSchema::route('/{record}/edit'),
            //
        ];
    }
}
