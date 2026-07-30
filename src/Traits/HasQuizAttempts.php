<?php

declare(strict_types=1);

namespace Rimba\Lms\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Rimba\Lms\Models\QuizAttempt;

trait HasQuizAttempts
{
    public function quizAttempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class, 'staff_id');
    }
}
