<?php

declare(strict_types=1);

namespace Rimba\Lms\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Rimba\Lms\Enums\CertificateStatus;
use Rimba\Lms\Models\Certificate;

class ExpireCertificates implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        Certificate::query()
            ->where('status', CertificateStatus::Valid->value)
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', now())
            ->update(['status' => CertificateStatus::Expired->value]);
    }
}
