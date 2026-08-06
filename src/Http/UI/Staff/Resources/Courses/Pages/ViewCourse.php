<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Courses\Pages;

use Filament\Resources\Pages\ViewRecord;
use Rimba\Lms\Http\UI\Staff\Resources\Courses\CourseResource;

class ViewCourse extends ViewRecord
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
