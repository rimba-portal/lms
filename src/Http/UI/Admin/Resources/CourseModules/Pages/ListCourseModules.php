<?php

namespace Rimba\Lms\Http\UI\Admin\Resources\CourseModules\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCourseModules extends ListRecords
{
    protected static string $resource = \Rimba\Lms\Http\UI\Admin\Resources\CourseModules\CourseModuleResource::class;

    protected static ?string $title = 'Course Module Layouts';

    protected ?string $subheading = 'Outline sequential pacing rules and required steps inside courses.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
