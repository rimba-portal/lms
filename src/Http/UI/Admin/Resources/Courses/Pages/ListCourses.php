<?php

namespace Rimba\Lms\Http\UI\Admin\Resources\Courses\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCourses extends ListRecords
{
    protected static string $resource = \Rimba\Lms\Http\UI\Admin\Resources\Courses\CourseResource::class;

    protected static ?string $title = 'Course Catalog';

    protected ?string $subheading = 'Author core titles, categorization groups, and code descriptions.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
