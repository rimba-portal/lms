<?php

declare(strict_types=1);

namespace Rimba\Lms\Actions;

use Illuminate\Support\Collection;
use Rimba\Dms\Models\Document;
use Rimba\Versioning\Models\Version;

class CreateRetrainingRequirement
{
    public function execute(Document $document, Version $version): Collection
    {
        return $document->modules
        ?? collect();
    }
}
