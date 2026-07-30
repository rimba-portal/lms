<?php

declare(strict_types=1);

namespace Rimba\Lms\Builders;

use Illuminate\Database\Eloquent\Builder;
use Rimba\Lms\Enums\QuizAttemptStatus;
use Rimba\Lms\Enums\QuizResult;

class QuizAttemptBuilder extends Builder
{
    public function inProgress(): static
    {
        return $this->where('status', QuizAttemptStatus::InProgress->value);
    }

    public function submitted(): static
    {
        return $this->where('status', QuizAttemptStatus::Submitted->value);
    }

    public function passed(): static
    {
        return $this->where('result', QuizResult::Pass->value);
    }

    public function failed(): static
    {
        return $this->where('result', QuizResult::Fail->value);
    }
}
