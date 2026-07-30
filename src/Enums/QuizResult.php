<?php

declare(strict_types=1);

namespace Rimba\Lms\Enums;

enum QuizResult: string
{
    case Pass = 'pass';
    case Fail = 'fail';

    public function label(): string
    {
        return ucfirst($this->value);
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $case): array => [$case->value => $case->label()])->all();
    }
}
