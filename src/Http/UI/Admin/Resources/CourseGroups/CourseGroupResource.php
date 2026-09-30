<?php

namespace Rimba\Lms\Http\UI\Admin\Resources\CourseGroups;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CourseGroupResource extends Resource
{
    protected static ?string $model = \Rimba\Lms\Models\CourseGroup::class;

    protected static string|UnitEnum|null $navigationGroup = 'Lms';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 85;

    protected static ?string $recordTitleAttribute = 'name';

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
            'index' => \Rimba\Lms\Http\UI\Admin\Resources\CourseGroups\Pages\ListCourseGroups::route('/'),
            // 'create' => \Rimba\Lms\Http\UI\Admin\Resources\CourseGroups\Pages\CreateCourseGroup::route('/create'),
            // 'view' => \Rimba\Lms\Http\UI\Admin\Resources\CourseGroups\Pages\ViewCourseGroup::route('/{record}'),
            // 'edit' => \Rimba\Lms\Http\UI\Admin\Resources\CourseGroups\Pages\EditCourseGroup::route('/{record}/edit'),
            //
        ];
    }
}
