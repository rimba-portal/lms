<?php

declare(strict_types=1);

namespace Rimba\Lms\Policies;

use Illuminate\Foundation\Auth\User;
use Rimba\Lms\Models\Quiz;

class QuizPolicy
{
    public function take(User $user, Quiz $quiz): bool
    {
        return true; // $user->can('lms.quiz.take');
    }

    public function manage(User $user, Quiz $quiz): bool
    {
        return $user->can('lms.quiz.manage');
    }
}
