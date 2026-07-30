<?php

declare(strict_types=1);

namespace Rimba\Lms\Actions;

use Rimba\Lms\Enums\CertificateStatus;
use Rimba\Lms\Models\Certificate;

class ExpireCertificate
{
    public function execute(Certificate $certificate): Certificate
    {
        $certificate->update(['status' => CertificateStatus::Expired]);

        return $certificate->refresh();
    }
}
