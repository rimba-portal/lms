<?php

declare(strict_types=1);

namespace Rimba\Lms\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Rimba\Lms\Models\CourseEnrollment;

class SendTrainingReminder implements ShouldQueue
{
    use Queueable;

    public function __construct(public CourseEnrollment $enrollment) {}

    public function handle(): void
    { /* Send learner training reminder. */
    }
}
