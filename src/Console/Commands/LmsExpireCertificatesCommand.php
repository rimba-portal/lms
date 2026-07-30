<?php

declare(strict_types=1);

namespace Rimba\Lms\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Rimba\Lms\Enums\CertificateStatus;
use Rimba\Lms\Jobs\ExpireCertificates;
use Rimba\Lms\Models\Certificate;

#[Description('Expire certificates where expires_at is already past.')]
#[Signature('lms:expire-certificates {--dispatch : Dispatch expiry job}')]
class LmsExpireCertificatesCommand extends Command
{
    public function handle(): int
    {
        if ($this->option('dispatch')) {
            ExpireCertificates::dispatch();
            $this->info('Certificate expiry job dispatched.');

            return self::SUCCESS;
        }

        $count = Certificate::query()
            ->where('status', CertificateStatus::Valid->value)
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', now())
            ->update(['status' => CertificateStatus::Expired->value]);

        $this->info(sprintf('Expired %d certificate(s).', $count));

        return self::SUCCESS;
    }
}
