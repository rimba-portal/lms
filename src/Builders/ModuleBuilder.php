<?php

declare(strict_types=1);

namespace Rimba\Lms\Builders;

use Illuminate\Database\Eloquent\Builder;

class ModuleBuilder extends Builder
{
    public function requiresQuiz(): static
    {
        return $this->where('requires_quiz', true);
    }

    public function requiresEvaluation(): static
    {
        return $this->where('requires_evaluation', true);
    }
}
