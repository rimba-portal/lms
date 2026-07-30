<?php

declare(strict_types=1);

namespace Rimba\Lms\Actions;

use Rimba\Lms\Enums\QuizAttemptStatus;
use Rimba\Lms\Events\QuizAttemptSubmitted;
use Rimba\Lms\Models\QuizAttempt;

class SubmitQuizAttempt
{
    public function execute(QuizAttempt $attempt, array $answers): QuizAttempt
    {
        $attempt->questions->each(function ($question) use ($answers): void {
            if (array_key_exists($question->question_key, $answers)) {
                $question->update(['answer' => $answers[$question->question_key]]);
            }
        });

        $attempt->update([
            'status' => QuizAttemptStatus::Submitted,
            'submitted_at' => now(),
        ]);

        event(new QuizAttemptSubmitted($attempt));

        return $attempt->refresh();
    }
}
