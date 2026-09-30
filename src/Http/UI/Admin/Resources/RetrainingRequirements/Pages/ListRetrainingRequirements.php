<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\RetrainingRequirements\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Lms\Http\UI\Admin\Resources\RetrainingRequirements\RetrainingRequirementResource;

class ListRetrainingRequirements extends ListRecords
{
    protected static string $resource = RetrainingRequirementResource::class;

    protected static ?string $title = 'Retraining Demands';

    protected ?string $subheading = 'Manage recurring retraining dates triggered by updated guidelines.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
