<?php

declare(strict_types=1);

namespace Rimba\Lms\Actions;

use Rimba\Lms\Events\CertificateIssued;
use Rimba\Lms\Models\Certificate;
use Rimba\Lms\Models\QuizAttempt;
use Rimba\Lms\Services\CertificateService;

class IssueCertificate
{
    public function __construct(protected CertificateService $certificateService) {}

    public function execute(QuizAttempt $attempt, ?int $issuedBy = null): Certificate
    {
        $certificate = $this->certificateService->issueFromAttempt($attempt, $issuedBy);
        event(new CertificateIssued($certificate));

        return $certificate;
    }
}
