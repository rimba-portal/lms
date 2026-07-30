<?php

declare(strict_types=1);

namespace Rimba\Lms\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasLearningProgress
{
    public function completedCourses(): HasMany
    {
        return $this->courseEnrollments()->whereNotNull('completed_at');
    }
}
