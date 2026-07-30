<?php

declare(strict_types=1);

namespace Rimba\Lms\Services;

use Rimba\Lms\Models\Certificate;

class TrainingValidityService
{
    public function isExpired(Certificate $certificate): bool
    {
        return filled($certificate->expires_at) && $certificate->expires_at->isPast();
    }
}
