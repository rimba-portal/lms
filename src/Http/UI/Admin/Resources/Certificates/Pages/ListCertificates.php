<?php

namespace Rimba\Lms\Http\UI\Admin\Resources\Certificates\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCertificates extends ListRecords
{
    protected static string $resource = \Rimba\Lms\Http\UI\Admin\Resources\Certificates\CertificateResource::class;

    protected static ?string $title = 'Training Certificates';

    protected ?string $subheading = 'Search historical passing scores, verification hashes, and expiration status.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
