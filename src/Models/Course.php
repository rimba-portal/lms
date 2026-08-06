<?php

declare(strict_types=1);

namespace Rimba\Lms\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Rimba\Lms\Builders\CourseBuilder;
use Rimba\Lms\Policies\CoursePolicy;

#[Table('lms_courses')]
#[UsePolicy(CoursePolicy::class)]
#[Fillable(['org_team_id', 'code', 'title', 'category', 'description', 'is_active', 'attributes'])]
class Course extends Model
{
    public function newEloquentBuilder($query): CourseBuilder
    {
        return new CourseBuilder($query);
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(CourseGroup::class, 'lms-course_group_assignments')->withTimestamps();
    }

    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'lms-course_modules')->withPivot(['sequence', 'is_required', 'attributes'])->withTimestamps();
    }

    public function courseModules(): HasMany
    {
        return $this->hasMany(CourseModule::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    protected function casts(): array
    {
        return ['is_active' => 'boolean', 'attributes' => 'array'];
    }
}
