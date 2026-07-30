<?php

declare(strict_types=1);

namespace Rimba\Lms\Actions;

use Rimba\Lms\Events\QuizAttemptGraded;
use Rimba\Lms\Models\QuizAttempt;
use Rimba\Lms\Services\QuizGradingService;

class GradeQuizAttempt
{
    public function __construct(protected QuizGradingService $gradingService) {}

    public function execute(QuizAttempt $attempt): QuizAttempt
    {
        $attempt = $this->gradingService->grade($attempt);
        event(new QuizAttemptGraded($attempt));

        return $attempt;
    }
}
