<?php

declare(strict_types=1);

namespace Rimba\Lms\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Rimba\Lms\Enums\EvaluationResult;

#[Table('lms_evaluations')]
#[Fillable(['module_id', 'staff_id', 'evaluator_id', 'result', 'evaluated_at', 'attributes'])]
class Evaluation extends Model
{
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    protected function casts(): array
    {
        return ['result' => EvaluationResult::class, 'evaluated_at' => 'datetime', 'attributes' => 'array'];
    }
}
