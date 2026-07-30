<?php

declare(strict_types=1);

namespace Rimba\Lms\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Rimba\Lms\Enums\CertificateStatus;
use Rimba\Lms\Models\Certificate;
use Rimba\Lms\Models\CourseEnrollment;
use Rimba\Lms\Models\RetrainingRequirement;

#[Description('Show high-level LMS compliance counts.')]
#[Signature('lms:compliance-report')]
class LmsComplianceReportCommand extends Command
{
    public function handle(): int
    {
        $this->table(['Metric', 'Count'], [
            ['Valid certificates', Certificate::query()->where('status', CertificateStatus::Valid->value)->count()],
            ['Expired certificates', Certificate::query()->where('status', CertificateStatus::Expired->value)->count()],
            ['Open retraining', RetrainingRequirement::query()->where('status', 'open')->count()],
            ['Incomplete enrollments', CourseEnrollment::query()->whereNull('completed_at')->count()],
        ]);

        return self::SUCCESS;
    }
}
