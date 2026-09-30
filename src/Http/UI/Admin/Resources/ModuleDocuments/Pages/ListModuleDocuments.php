<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\ModuleDocuments\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Lms\Http\UI\Admin\Resources\ModuleDocuments\ModuleDocumentResource;

class ListModuleDocuments extends ListRecords
{
    protected static string $resource = ModuleDocumentResource::class;

    protected static ?string $title = 'Module Study Materials';

    protected ?string $subheading = 'Map target controlled file items and resources to learning paths.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
