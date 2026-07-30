<?php

declare(strict_types=1);

namespace Rimba\Lms\Observers;

use Rimba\Lms\Models\QuizAttempt;

class QuizAttemptObserver
{
    public function created(QuizAttempt $attempt): void
    {
        // Hook point for rimba/jejak audit trail.
    }

    public function updated(QuizAttempt $attempt): void
    {
        // Hook point for reporting and notifications.
    }
}
