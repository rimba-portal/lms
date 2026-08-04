<?php

declare(strict_types=1);

namespace Rimba\Lms\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Rimba\Lms\Policies\QuizPolicy;

#[Table('lms_quizzes')]
#[UsePolicy(QuizPolicy::class)]
#[Fillable(['module_id', 'name', 'description', 'pass_score', 'max_attempts', 'randomize_questions', 'question_limit', 'rules', 'attributes'])]
class Quiz extends Model
{
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }

    protected function casts(): array
    {
        return ['randomize_questions' => 'boolean', 'rules' => 'array', 'attributes' => 'array'];
    }

    public static function seedMappings(): array
    {
        return [

            'course_code' => function (string $code): array {
                return [
                    'course_id' => Course::query()
                        ->where('code', $code)
                        ->value('id'),
                ];
            },

            'module_code' => function (string $code): array {
                return [
                    'module_id' => Module::query()
                        ->where('code', $code)
                        ->value('id'),
                ];
            },

        ];
    }
}
