<?php

namespace Rimba\Lms\Http\UI\Admin\Resources\QuizAttemptQuestions\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuizAttemptQuestions extends ListRecords
{
    protected static string $resource = \Rimba\Lms\Http\UI\Admin\Resources\QuizAttemptQuestions\QuizAttemptQuestionResource::class;

    protected static ?string $title = 'Quiz Question Items';

    protected ?string $subheading = 'Review specific responses, award points, and auto-correct details.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
