<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\Courses\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Lms\Http\UI\Admin\Resources\Courses\CourseResource;

class ListCourses extends ListRecords
{
    protected static string $resource = CourseResource::class;

    protected static ?string $title = 'Course Catalog';

    protected ?string $subheading = 'Author core titles, categorization groups, and code descriptions.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
