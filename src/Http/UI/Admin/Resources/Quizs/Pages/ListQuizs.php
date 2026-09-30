<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\Quizs\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Lms\Http\UI\Admin\Resources\Quizs\QuizResource;

class ListQuizs extends ListRecords
{
    protected static string $resource = QuizResource::class;

    protected static ?string $title = 'Quiz Configurations';

    protected ?string $subheading = 'Manage scoring rules, maximum attempt limits, and test structures.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
