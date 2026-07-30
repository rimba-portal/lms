<?php

declare(strict_types=1);

namespace Rimba\Lms\Actions;

use Rimba\Dms\Models\Document;
use Rimba\Lms\Models\Module;

class AttachDocumentToModule
{
    public function execute(Module $module, Document $document, int $sequence = 1, bool $required = true): void
    {
        $module->documents()->syncWithoutDetaching([
            $document->getKey() => ['sequence' => $sequence, 'is_required' => $required],
        ]);
    }
}
