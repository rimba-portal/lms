<?php

namespace Rimba\Lms\Http\UI\Admin\Resources\QuizAttempts\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuizAttempts extends ListRecords
{
    protected static string $resource = \Rimba\Lms\Http\UI\Admin\Resources\QuizAttempts\QuizAttemptResource::class;

    protected static ?string $title = 'Quiz Activity Logs';

    protected ?string $subheading = 'Track test scores, grading timestamps, and active learner paths.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
