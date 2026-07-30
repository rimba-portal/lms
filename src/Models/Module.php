<?php

declare(strict_types=1);

namespace Rimba\Lms\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Rimba\Dms\Models\Document;
use Rimba\Lms\Builders\ModuleBuilder;
use Rimba\Lms\Policies\ModulePolicy;

#[Table('lms_modules')]
#[UsePolicy(ModulePolicy::class)]
#[Fillable(['code', 'name', 'description', 'duration_minutes', 'validity_days', 'requires_quiz', 'requires_evaluation', 'attributes'])]
class Module extends Model
{
    public function newEloquentBuilder($query): ModuleBuilder
    {
        return new ModuleBuilder($query);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_modules')->withPivot(['sequence', 'is_required', 'attributes'])->withTimestamps();
    }

    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, 'module_documents')->withPivot(['sequence', 'is_required', 'attributes'])->withTimestamps();
    }

    public function moduleDocuments(): HasMany
    {
        return $this->hasMany(ModuleDocument::class);
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    public function evaluations(): HasMany
    {
        return $this->hasMany(Evaluation::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    protected function casts(): array
    {
        return ['requires_quiz' => 'boolean', 'requires_evaluation' => 'boolean', 'attributes' => 'array'];
    }
}
