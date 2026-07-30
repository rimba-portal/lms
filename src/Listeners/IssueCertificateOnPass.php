<?php

declare(strict_types=1);

namespace Rimba\Lms\Listeners;

use Rimba\Lms\Actions\IssueCertificate;
use Rimba\Lms\Enums\QuizResult;
use Rimba\Lms\Events\QuizAttemptGraded;

class IssueCertificateOnPass
{
    public function __construct(protected IssueCertificate $issueCertificate) {}

    public function handle(QuizAttemptGraded $event): void
    {
        if ($event->attempt->result === QuizResult::Pass) {
            $this->issueCertificate->execute($event->attempt);
        }
    }
}
