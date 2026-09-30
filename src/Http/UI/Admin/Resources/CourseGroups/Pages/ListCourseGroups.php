<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\CourseGroups\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Lms\Http\UI\Admin\Resources\CourseGroups\CourseGroupResource;

class ListCourseGroups extends ListRecords
{
    protected static string $resource = CourseGroupResource::class;

    protected static ?string $title = 'Course Curriculums';

    protected ?string $subheading = 'Group standard course structures by corporate track or level parameters.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
