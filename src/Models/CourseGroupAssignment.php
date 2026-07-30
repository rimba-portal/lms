<?php

declare(strict_types=1);

namespace Rimba\Lms\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table('lms_course_group_assignments')]
#[Fillable(['course_id', 'course_group_id', 'attributes'])]
class CourseGroupAssignment extends Model
{
    protected function casts(): array
    {
        return ['attributes' => 'array'];
    }
}
