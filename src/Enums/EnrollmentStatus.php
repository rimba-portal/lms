<?php

declare(strict_types=1);

namespace Rimba\Lms\Enums;

enum EnrollmentStatus: string
{
    case Assigned = 'assigned';
    case Started = 'started';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return ucwords($this->value);
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $case): array => [$case->value => $case->label()])->all();
    }
}
