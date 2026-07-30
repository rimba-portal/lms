<?php

declare(strict_types=1);

namespace Rimba\Lms\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table('lms_course_enrollments')]
#[Fillable(['course_id', 'staff_id', 'status', 'assigned_at', 'started_at', 'completed_at', 'attributes'])]
class CourseEnrollment extends Model
{
    protected function casts(): array
    {
        return ['assigned_at' => 'datetime', 'started_at' => 'datetime', 'completed_at' => 'datetime', 'attributes' => 'array'];
    }
}
