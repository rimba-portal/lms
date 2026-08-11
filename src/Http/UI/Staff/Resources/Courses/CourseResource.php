<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Courses;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Lms\Http\UI\Staff\Resources\Courses\Pages\ListCourses;
use Rimba\Lms\Http\UI\Staff\Resources\Courses\Pages\ViewCourse;
use Rimba\Lms\Http\UI\Staff\Resources\Courses\Schemas\CourseInfolist;
use Rimba\Lms\Http\UI\Staff\Resources\Courses\Tables\CoursesTable;
use Rimba\Lms\Models\Course;
use UnitEnum;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static string|BackedEnum|null $navigationIcon = 'bites-lms-course';

    protected static string|UnitEnum|null $navigationGroup = 'Learning';

    protected static ?int $navigationSort = 25;

    public static function infolist(Schema $schema): Schema
    {
        return CourseInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CoursesTable::configure($table);
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
            'index' => ListCourses::route('/'),
            'view' => ViewCourse::route('/{record}'),
        ];
    }
}
