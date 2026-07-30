<?php

declare(strict_types=1);

namespace Rimba\Lms\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table('lms_course_modules')]
#[Fillable(['course_id', 'module_id', 'sequence', 'is_required', 'attributes'])]
class CourseModule extends Model
{
    protected function casts(): array
    {
        return ['is_required' => 'boolean', 'attributes' => 'array'];
    }
}
