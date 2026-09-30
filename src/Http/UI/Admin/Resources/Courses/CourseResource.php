<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\Courses;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Lms\Http\UI\Admin\Resources\Courses\Pages\ListCourses;
use Rimba\Lms\Models\Course;
use UnitEnum;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static string|UnitEnum|null $navigationGroup = 'Lms';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 83;

    protected static ?string $recordTitleAttribute = 'title';

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
            'index' => ListCourses::route('/'),
            // 'create' => \Rimba\Lms\Http\UI\Admin\Resources\Courses\Pages\CreateCourse::route('/create'),
            // 'view' => \Rimba\Lms\Http\UI\Admin\Resources\Courses\Pages\ViewCourse::route('/{record}'),
            // 'edit' => \Rimba\Lms\Http\UI\Admin\Resources\Courses\Pages\EditCourse::route('/{record}/edit'),
            //
        ];
    }
}
