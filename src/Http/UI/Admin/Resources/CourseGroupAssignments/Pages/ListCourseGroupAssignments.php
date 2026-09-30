<?php

namespace Rimba\Lms\Http\UI\Admin\Resources\CourseGroupAssignments\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCourseGroupAssignments extends ListRecords
{
    protected static string $resource = \Rimba\Lms\Http\UI\Admin\Resources\CourseGroupAssignments\CourseGroupAssignmentResource::class;

    protected static ?string $title = 'Curriculum Assignments';

    protected ?string $subheading = 'Assign precise package frameworks to target course structures.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
