<?php

declare(strict_types=1);

namespace Rimba\Lms\Policies;

use Illuminate\Foundation\Auth\User;
use Rimba\Lms\Models\Course;

class CoursePolicy
{
    public function viewAny(User $user): bool
    {
        return true; // $user->can('lms.course.view');
    }

    public function view(User $user, Course $course): bool
    {
        return true; // $user->can('lms.course.view');
    }

    public function create(User $user): bool
    {
        return $user->can('lms.course.create');
    }

    public function update(User $user, Course $course): bool
    {
        return $user->can('lms.course.update');
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->can('lms.course.delete');
    }
}
