<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\CourseModules\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Lms\Http\UI\Admin\Resources\CourseModules\CourseModuleResource;

class ListCourseModules extends ListRecords
{
    protected static string $resource = CourseModuleResource::class;

    protected static ?string $title = 'Course Module Layouts';

    protected ?string $subheading = 'Outline sequential pacing rules and required steps inside courses.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
