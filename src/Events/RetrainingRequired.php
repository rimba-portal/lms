<?php

declare(strict_types=1);

namespace Rimba\Lms\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Rimba\Lms\Models\RetrainingRequirement;

class RetrainingRequired
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public RetrainingRequirement $requirement) {}
}
