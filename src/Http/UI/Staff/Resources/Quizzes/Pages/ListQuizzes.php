<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Quizzes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Lms\Http\UI\Staff\Resources\Quizzes\QuizResource;

class ListQuizzes extends ListRecords
{
    protected static string $resource = QuizResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
