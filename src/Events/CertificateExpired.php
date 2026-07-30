<?php

declare(strict_types=1);

namespace Rimba\Lms\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Rimba\Lms\Models\Certificate;

class CertificateExpired
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public Certificate $certificate) {}
}
