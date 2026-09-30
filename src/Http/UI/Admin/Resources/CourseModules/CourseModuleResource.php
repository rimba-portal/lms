<?php

namespace Rimba\Lms\Http\UI\Admin\Resources\CourseModules;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CourseModuleResource extends Resource
{
    protected static ?string $model = \Rimba\Lms\Models\CourseModule::class;

    protected static string|UnitEnum|null $navigationGroup = 'Lms';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 87;

    protected static ?string $recordTitleAttribute = 'id';

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
            'index' => \Rimba\Lms\Http\UI\Admin\Resources\CourseModules\Pages\ListCourseModules::route('/'),
            // 'create' => \Rimba\Lms\Http\UI\Admin\Resources\CourseModules\Pages\CreateCourseModule::route('/create'),
            // 'view' => \Rimba\Lms\Http\UI\Admin\Resources\CourseModules\Pages\ViewCourseModule::route('/{record}'),
            // 'edit' => \Rimba\Lms\Http\UI\Admin\Resources\CourseModules\Pages\EditCourseModule::route('/{record}/edit'),
            //
        ];
    }
}
