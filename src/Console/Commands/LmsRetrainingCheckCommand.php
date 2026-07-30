<?php

declare(strict_types=1);

namespace Rimba\Lms\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Rimba\Lms\Models\RetrainingRequirement;

#[Description('List open retraining requirements.')]
#[Signature('lms:retraining-check')]
class LmsRetrainingCheckCommand extends Command
{
    public function handle(): int
    {
        $rows = RetrainingRequirement::query()
            ->where('status', 'open')
            ->get(['id', 'document_id', 'version_id', 'module_id', 'course_id', 'staff_id', 'due_date'])
            ->map(fn ($row): array => [$row->id, $row->document_id, $row->version_id, $row->module_id, $row->course_id, $row->staff_id, optional($row->due_date)->toDateString()]);

        $this->table(['ID', 'Document', 'Version', 'Module', 'Course', 'Staff', 'Due'], $rows);

        return self::SUCCESS;
    }
}
