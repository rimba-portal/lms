<?php

declare(strict_types=1);

namespace Rimba\Lms\Services;

use Rimba\Lms\Enums\CertificateStatus;
use Rimba\Lms\Models\Certificate;
use Rimba\Lms\Models\QuizAttempt;

class CertificateService
{
    public function issueFromAttempt(QuizAttempt $attempt, ?int $issuedBy = null): Certificate
    {
        $module = $attempt->quiz->module;
        $issuedAt = now();
        $expiresAt = $module->validity_days ? $issuedAt->copy()->addDays((int) $module->validity_days) : null;
        $number = $this->nextNumber($module->code);

        return Certificate::query()->create([
            'certificate_number' => $number,
            'certificate_hash' => hash('sha256', $number.'|'.$attempt->getKey().'|'.$issuedAt->toISOString()),
            'module_id' => $module->getKey(),
            'staff_id' => $attempt->staff_id,
            'quiz_attempt_id' => $attempt->getKey(),
            'issued_by' => $issuedBy,
            'status' => CertificateStatus::Valid,
            'issued_at' => $issuedAt,
            'expires_at' => $expiresAt,
        ]);
    }

    public function nextNumber(string $prefix): string
    {
        return sprintf('%s-CERT-%s', strtoupper($prefix), now()->format('YmdHis'));
    }
}
