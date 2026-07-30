<?php

declare(strict_types=1);

namespace Rimba\Lms\Services;

use Rimba\Lms\Enums\QuizAttemptStatus;
use Rimba\Lms\Enums\QuizResult;
use Rimba\Lms\Models\QuizAttempt;

class QuizGradingService
{
    public function grade(QuizAttempt $attempt): QuizAttempt
    {
        $available = 0;
        $awarded = 0;

        $attempt->questions()->get()->each(function ($question) use (&$available, &$awarded): void {
            $snapshot = $question->question_snapshot;
            $expected = $snapshot['answer'] ?? null;
            $actual = $question->answer;
            $pointsAvailable = (int) ($question->points_available ?: ($snapshot['points'] ?? 1));
            $isCorrect = $expected !== null && $this->answersMatch($expected, $actual);
            $pointsAwarded = $isCorrect ? $pointsAvailable : 0;

            $question->update([
                'is_correct' => $isCorrect,
                'points_awarded' => $pointsAwarded,
                'points_available' => $pointsAvailable,
            ]);

            $available += $pointsAvailable;
            $awarded += $pointsAwarded;
        });

        $score = $available > 0 ? (int) round(($awarded / $available) * 100) : 0;
        $result = $score >= (int) $attempt->quiz->pass_score ? QuizResult::Pass : QuizResult::Fail;

        $attempt->update([
            'status' => QuizAttemptStatus::Graded,
            'result' => $result,
            'score' => $score,
            'graded_at' => now(),
        ]);

        return $attempt->refresh();
    }

    protected function answersMatch(mixed $expected, mixed $actual): bool
    {
        if (is_array($expected) || is_array($actual)) {
            $expected = collect((array) $expected)->map(fn ($value): string => (string) $value)->sort()->values()->all();
            $actual = collect((array) $actual)->map(fn ($value): string => (string) $value)->sort()->values()->all();

            return $expected === $actual;
        }

        return (string) $expected === (string) $actual;
    }
}
