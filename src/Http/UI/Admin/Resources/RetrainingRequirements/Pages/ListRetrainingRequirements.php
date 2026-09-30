<?php

namespace Rimba\Lms\Http\UI\Admin\Resources\RetrainingRequirements\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRetrainingRequirements extends ListRecords
{
    protected static string $resource = \Rimba\Lms\Http\UI\Admin\Resources\RetrainingRequirements\RetrainingRequirementResource::class;

    protected static ?string $title = 'Retraining Demands';

    protected ?string $subheading = 'Manage recurring retraining dates triggered by updated guidelines.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
