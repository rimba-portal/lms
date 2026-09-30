<?php

namespace Rimba\Lms\Http\UI\Admin\Resources\CourseEnrollments\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCourseEnrollments extends ListRecords
{
    protected static string $resource = \Rimba\Lms\Http\UI\Admin\Resources\CourseEnrollments\CourseEnrollmentResource::class;

    protected static ?string $title = 'Course Enrollments';

    protected ?string $subheading = 'Track completion history, enrollment dates, and learner milestones.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
