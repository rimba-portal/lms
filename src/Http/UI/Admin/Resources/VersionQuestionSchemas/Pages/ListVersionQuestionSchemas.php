<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\VersionQuestionSchemas\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Lms\Http\UI\Admin\Resources\VersionQuestionSchemas\VersionQuestionSchemaResource;

class ListVersionQuestionSchemas extends ListRecords
{
    protected static string $resource = VersionQuestionSchemaResource::class;

    protected static ?string $title = 'Question Version Schemas';

    protected ?string $subheading = 'Maintain underlying quiz layouts matching target revision levels.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
