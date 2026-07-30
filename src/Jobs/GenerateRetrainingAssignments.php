<?php

declare(strict_types=1);

namespace Rimba\Lms\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GenerateRetrainingAssignments implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    { /* Generate retraining assignments from revised documents. */
    }
}
