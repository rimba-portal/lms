<?php

declare(strict_types=1);

namespace Rimba\Lms\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Rimba\Lms\Models\CourseEnrollment;

#[Description('List assigned or started course enrollments that are not completed.')]
#[Signature('lms:training-reminders')]
class LmsTrainingRemindersCommand extends Command
{
    public function handle(): int
    {
        $rows = CourseEnrollment::query()
            ->whereNull('completed_at')
            ->get(['id', 'course_id', 'staff_id', 'status', 'assigned_at'])
            ->map(fn ($row): array => [$row->id, $row->course_id, $row->staff_id, $row->status, optional($row->assigned_at)->toDateTimeString()]);

        $this->table(['ID', 'Course', 'Staff', 'Status', 'Assigned'], $rows);

        return self::SUCCESS;
    }
}
