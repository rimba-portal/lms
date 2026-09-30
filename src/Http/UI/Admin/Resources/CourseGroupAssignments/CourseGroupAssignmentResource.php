<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\CourseGroupAssignments;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Lms\Http\UI\Admin\Resources\CourseGroupAssignments\Pages\ListCourseGroupAssignments;
use Rimba\Lms\Models\CourseGroupAssignment;
use UnitEnum;

class CourseGroupAssignmentResource extends Resource
{
    protected static ?string $model = CourseGroupAssignment::class;

    protected static string|UnitEnum|null $navigationGroup = 'Lms';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 86;

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
            'index' => ListCourseGroupAssignments::route('/'),
            // 'create' => \Rimba\Lms\Http\UI\Admin\Resources\CourseGroupAssignments\Pages\CreateCourseGroupAssignment::route('/create'),
            // 'view' => \Rimba\Lms\Http\UI\Admin\Resources\CourseGroupAssignments\Pages\ViewCourseGroupAssignment::route('/{record}'),
            // 'edit' => \Rimba\Lms\Http\UI\Admin\Resources\CourseGroupAssignments\Pages\EditCourseGroupAssignment::route('/{record}/edit'),
            //
        ];
    }
}
