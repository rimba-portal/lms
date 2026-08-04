<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Pages;

use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Rimba\Lms\Actions\BuildQuizAttempt;
use Rimba\Lms\Actions\GradeQuizAttempt;
use Rimba\Lms\Actions\SubmitQuizAttempt;
use Rimba\Lms\Enums\QuizAttemptStatus;
use Rimba\Lms\Models\Quiz;
use Rimba\Lms\Models\QuizAttempt;
use Rimba\Lms\Models\QuizAttemptQuestion;

class TakeQuiz extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQuestionMarkCircle;

    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'lms::staff.pages.take-quiz';

    protected static ?string $slug = 'lms/quizzes/{quiz}/take';

    public Quiz $quiz;

    public QuizAttempt $attempt;

    public array $questions = [];

    public array $answers = [];

    public function mount(int|string $quiz): void
    {
        $this->quiz = Quiz::query()
            ->with('module.documents.currentVersion')
            ->findOrFail($quiz);

        $staffId = Auth::user()?->staff?->id;

        if (! $staffId) {
            abort(403, 'Unable to resolve staff record.');
        }

        $this->attempt = $this->findOrCreateAttempt($staffId);

        $this->loadQuestions();
    }

    protected function findOrCreateAttempt(int $staffId): QuizAttempt
    {
        $existingAttempt = QuizAttempt::query()
            ->where('quiz_id', $this->quiz->id)
            ->where('staff_id', $staffId)
            ->where('status', QuizAttemptStatus::InProgress->value)
            ->latest('id')
            ->first();

        if ($existingAttempt instanceof QuizAttempt) {
            return $existingAttempt;
        }

        return app(BuildQuizAttempt::class)
            ->execute($this->quiz, $staffId);
    }

    protected function loadQuestions(): void
    {
        $this->questions = $this->attempt
            ->questions()
            ->get()
            ->map(fn (QuizAttemptQuestion $attemptQuestion): array => [
                'id' => $attemptQuestion->id,
                'question_key' => $attemptQuestion->question_key,
                'document_id' => $attemptQuestion->document_id,
                'version_id' => $attemptQuestion->version_id,
                'points_available' => $attemptQuestion->points_available,
                'snapshot' => $attemptQuestion->question_snapshot,
            ])
            ->values()
            ->all();

        foreach ($this->questions as $question) {
            $type = $question['snapshot']['type'] ?? 'single_choice';

            $this->answers[$question['id']] ??= match ($type) {
                'multiple_choice' => [],
                default => null,
            };
        }
    }

    public function submit(): void
    {
        if ($this->attempt->status !== QuizAttemptStatus::InProgress) {
            Notification::make()
                ->title('Quiz already submitted')
                ->warning()
                ->send();

            return;
        }

        $answersByQuestionKey = $this->mapAnswersByQuestionKey();

        app(SubmitQuizAttempt::class)
            ->execute($this->attempt, $answersByQuestionKey);

        app(GradeQuizAttempt::class)
            ->execute($this->attempt->refresh());

        Notification::make()
            ->title('Quiz submitted')
            ->body('Your quiz has been submitted and graded.')
            ->success()
            ->send();

        $this->redirect(static::getUrl([
            'quiz' => $this->quiz->id,
        ]));
    }

    protected function mapAnswersByQuestionKey(): array
    {
        return collect($this->questions)
            ->mapWithKeys(function (array $question): array {
                return [
                    $question['question_key'] => $this->answers[$question['id']] ?? null,
                ];
            })
            ->all();
    }

    public function getTitle(): string
    {
        return 'Attempting '.$this->quiz->name;
    }

    public function getBreadcrumb(): string
    {
        return '';
    }
}
