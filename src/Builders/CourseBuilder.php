<?php

declare(strict_types=1);

namespace Rimba\Lms\Builders;

use Illuminate\Database\Eloquent\Builder;

class CourseBuilder extends Builder
{
    public function active(): static
    {
        return $this->where('is_active', true);
    }

    public function code(string $code): static
    {
        return $this->where('code', $code);
    }
}
