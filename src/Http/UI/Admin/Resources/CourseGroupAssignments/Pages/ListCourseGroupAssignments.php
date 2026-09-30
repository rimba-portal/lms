<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\CourseGroupAssignments\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Lms\Http\UI\Admin\Resources\CourseGroupAssignments\CourseGroupAssignmentResource;

class ListCourseGroupAssignments extends ListRecords
{
    protected static string $resource = CourseGroupAssignmentResource::class;

    protected static ?string $title = 'Curriculum Assignments';

    protected ?string $subheading = 'Assign precise package frameworks to target course structures.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
