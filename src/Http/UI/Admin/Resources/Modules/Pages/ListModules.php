<?php

namespace Rimba\Lms\Http\UI\Admin\Resources\Modules\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListModules extends ListRecords
{
    protected static string $resource = \Rimba\Lms\Http\UI\Admin\Resources\Modules\ModuleResource::class;

    protected static ?string $title = 'Learning Modules';

    protected ?string $subheading = 'Configure time tracking requirements, quiz limits, and core materials.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
