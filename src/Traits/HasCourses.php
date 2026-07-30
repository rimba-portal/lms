<?php

declare(strict_types=1);

namespace Rimba\Lms\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Rimba\Lms\Models\CourseEnrollment;

trait HasCourses
{
    public function courseEnrollments(): HasMany
    {
        return $this->hasMany(CourseEnrollment::class, 'staff_id');
    }
}
