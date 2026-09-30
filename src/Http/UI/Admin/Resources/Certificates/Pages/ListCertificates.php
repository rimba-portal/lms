<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\Certificates\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Lms\Http\UI\Admin\Resources\Certificates\CertificateResource;

class ListCertificates extends ListRecords
{
    protected static string $resource = CertificateResource::class;

    protected static ?string $title = 'Training Certificates';

    protected ?string $subheading = 'Search historical passing scores, verification hashes, and expiration status.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
