<?php

declare(strict_types=1);

namespace Rimba\Lms\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table('lms_retraining_requirements')]
#[Fillable(['document_id', 'version_id', 'module_id', 'course_id', 'staff_id', 'status', 'due_date', 'completed_at', 'attributes'])]
class RetrainingRequirement extends Model
{
    protected function casts(): array
    {
        return ['due_date' => 'date', 'completed_at' => 'datetime', 'attributes' => 'array'];
    }
}
