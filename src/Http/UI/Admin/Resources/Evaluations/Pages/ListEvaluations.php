<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\Evaluations\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Lms\Http\UI\Admin\Resources\Evaluations\EvaluationResource;

class ListEvaluations extends ListRecords
{
    protected static string $resource = EvaluationResource::class;

    protected static ?string $title = 'Practical Assessments';

    protected ?string $subheading = 'Review expert evaluator comments, testing dates, and student records.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
