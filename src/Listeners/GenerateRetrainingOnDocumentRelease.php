<?php

declare(strict_types=1);

namespace Rimba\Lms\Listeners;

class GenerateRetrainingOnDocumentRelease
{
    public function handle(object $event): void
    {
        // Listen to rimba/dms DocumentReleased event and generate retraining requirement.
    }
}
