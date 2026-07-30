<?php

declare(strict_types=1);

namespace Rimba\Lms\Observers;

use Rimba\Lms\Models\Certificate;

class CertificateObserver
{
    public function creating(Certificate $certificate): void
    {
        $certificate->status ??= config('rimba_lms.defaults.certificate_status', 'valid');
    }

    public function updated(Certificate $certificate): void
    {
        // Hook point for certificate expiry / revoke audit trail.
    }
}
