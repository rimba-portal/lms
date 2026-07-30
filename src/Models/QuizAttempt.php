<?php

declare(strict_types=1);

namespace Rimba\Lms\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Rimba\Lms\Builders\QuizAttemptBuilder;
use Rimba\Lms\Enums\QuizAttemptStatus;
use Rimba\Lms\Enums\QuizResult;
use Rimba\Lms\Observers\QuizAttemptObserver;

#[Table('lms_quiz_attempts')]
#[ObservedBy([QuizAttemptObserver::class])]
#[Fillable(['quiz_id', 'staff_id', 'status', 'result', 'score', 'started_at', 'submitted_at', 'graded_at', 'attributes'])]
class QuizAttempt extends Model
{
    public function newEloquentBuilder($query): QuizAttemptBuilder
    {
        return new QuizAttemptBuilder($query);
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(QuizAttemptQuestion::class);
    }

    protected function casts(): array
    {
        return ['status' => QuizAttemptStatus::class, 'result' => QuizResult::class, 'started_at' => 'datetime', 'submitted_at' => 'datetime', 'graded_at' => 'datetime', 'attributes' => 'array'];
    }
}
