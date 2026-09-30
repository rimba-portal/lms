<?php

namespace Rimba\Lms\Http\UI\Admin\Resources\CourseGroups\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCourseGroups extends ListRecords
{
    protected static string $resource = \Rimba\Lms\Http\UI\Admin\Resources\CourseGroups\CourseGroupResource::class;

    protected static ?string $title = 'Course Curriculums';

    protected ?string $subheading = 'Group standard course structures by corporate track or level parameters.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
