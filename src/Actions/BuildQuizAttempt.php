<?php

declare(strict_types=1);

namespace Rimba\Lms\Actions;

use Illuminate\Support\Facades\DB;
use Rimba\Lms\Enums\QuizAttemptStatus;
use Rimba\Lms\Events\QuizAttemptStarted;
use Rimba\Lms\Models\Quiz;
use Rimba\Lms\Models\QuizAttempt;
use Rimba\Lms\Services\QuestionSchemaResolverService;

class BuildQuizAttempt
{
    public function __construct(protected QuestionSchemaResolverService $resolver) {}

    public function execute(Quiz $quiz, int $staffId): QuizAttempt
    {
        return DB::transaction(function () use ($quiz, $staffId): QuizAttempt {
            $questions = $this->resolver->resolveForModule($quiz->module);

            if ($quiz->randomize_questions) {
                $questions = $questions->shuffle();
            }

            if ($quiz->question_limit) {
                $questions = $questions->take((int) $quiz->question_limit);
            }

            $model = $quiz->attempts()->create([
                'staff_id' => $staffId,
                'status' => QuizAttemptStatus::InProgress,
                'started_at' => now(),
            ]);

            $questions->each(function (array $question) use ($model): void {
                $snapshot = $this->prepareQuestionSnapshot($question);

                $model->questions()->create([
                    'document_id' => $snapshot['_document_id'],
                    'version_id' => $snapshot['_version_id'],
                    'question_key' => $snapshot['key'],
                    'question_snapshot' => $snapshot,
                    'points_available' => (int) ($snapshot['points'] ?? 1),
                ]);
            });

            event(new QuizAttemptStarted($model));

            return $model->refresh();
        });
    }

    protected function prepareQuestionSnapshot(array $question): array
    {
        if (
            in_array($question['type'] ?? null, ['single_choice', 'multiple_choice'], true)
            && isset($question['options'])
            && is_array($question['options'])
        ) {
            $question['options'] = collect($question['options'])
                ->shuffle()
                ->values()
                ->all();
        }

        return $question;
    }
}
