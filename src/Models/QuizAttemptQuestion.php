<?php

declare(strict_types=1);

namespace Rimba\Lms\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Rimba\Dms\Models\Document;
use Rimba\Versioning\Models\Version;

#[Table('lms_quiz_attempt_questions')]
#[Fillable(['quiz_attempt_id', 'document_id', 'version_id', 'question_key', 'question_snapshot', 'answer', 'is_correct', 'points_awarded', 'points_available'])]
class QuizAttemptQuestion extends Model
{
    public function attempt(): BelongsTo
    {
        return $this->belongsTo(QuizAttempt::class, 'quiz_attempt_id');
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function version(): BelongsTo
    {
        return $this->belongsTo(Version::class);
    }

    protected function casts(): array
    {
        return ['question_snapshot' => 'array', 'answer' => 'array', 'is_correct' => 'boolean'];
    }
}
