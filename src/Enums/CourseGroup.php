<?php

declare(strict_types=1);

namespace Rimba\Lms\Enums;

use BackedEnum;
use Filament\Support\Colors\Color;
use Illuminate\Contracts\Support\Htmlable;

enum CourseGroup: string
{
    case INDUCTION = 'Induction';
    case ONBOARDING = 'Onboarding';
    case QUALIFICATION = 'Qualification';
    case COMPLIANCE = 'Compliance';
    case REFRESHER = 'Refresher';
    case RECERTIFICATION = 'Recertification';
    case TRANSITION = 'Transition';
    case CROSS_TRAINING = 'CrossTraining';
    case DEVELOPMENT = 'Development';

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::INDUCTION => __('Induction'),
            self::ONBOARDING => __('Onboarding'),
            self::QUALIFICATION => __('Qualification'),
            self::COMPLIANCE => __('Compliance'),
            self::REFRESHER => __('Refresher'),
            self::RECERTIFICATION => __('Recertification'),
            self::TRANSITION => __('Transition'),
            self::CROSS_TRAINING => __('Cross-Training'),
            self::DEVELOPMENT => __('Development'),
        };
    }

    public function getIcon(): string|BackedEnum|Htmlable|null
    {
        return match ($this) {
            self::INDUCTION => 'heroicon-o-building-office',
            self::ONBOARDING => 'heroicon-o-user-plus',
            self::QUALIFICATION => 'heroicon-o-academic-cap',
            self::COMPLIANCE => 'heroicon-o-clipboard-document-check',
            self::REFRESHER => 'heroicon-o-arrow-path',
            self::RECERTIFICATION => 'heroicon-o-shield-check',
            self::TRANSITION => 'heroicon-o-arrows-right-left',
            self::CROSS_TRAINING => 'heroicon-o-arrows-pointing-out',
            self::DEVELOPMENT => 'heroicon-o-arrow-trending-up',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::INDUCTION => Color::Sky,
            self::ONBOARDING => Color::Blue,
            self::QUALIFICATION => Color::Green,
            self::COMPLIANCE => Color::Amber,
            self::REFRESHER => Color::Cyan,
            self::RECERTIFICATION => Color::Violet,
            self::TRANSITION => Color::Orange,
            self::CROSS_TRAINING => Color::Teal,
            self::DEVELOPMENT => Color::Indigo,
        };
    }

    public function getDescription(): string|Htmlable|null
    {
        return match ($this) {
            self::INDUCTION => 'Entry learning required to understand the workplace, site, and organization.',

            self::ONBOARDING => 'Team-specific learning for Staff joining a particular organizational or functional area.',

            self::QUALIFICATION => 'Role-based learning required to qualify Staff to perform the work expected by a JobPosition.',

            self::COMPLIANCE => 'Mandatory learning required to satisfy organizational, regulatory, safety, quality, or security obligations.',

            self::REFRESHER => 'Periodic learning used to reinforce previously completed knowledge and practices.',

            self::RECERTIFICATION => 'Learning and assessment used to renew a time-limited qualification or certificate.',

            self::TRANSITION => 'Learning that bridges competency gaps when Staff moves from one role or JobPosition to another.',

            self::CROSS_TRAINING => 'Learning that extends an existing qualification into another product, process, equipment, or inspection scope.',

            self::DEVELOPMENT => 'Learning intended to increase Staff capability beyond the minimum requirements of the current JobPosition.',
        };
    }

    /**
     * Prefix normally used by seeded course codes.
     */
    public function prefix(): string
    {
        return match ($this) {
            self::INDUCTION => 'IND',
            self::ONBOARDING => 'ONB',
            self::QUALIFICATION => 'QLF',
            self::COMPLIANCE => 'CMP',
            self::REFRESHER => 'REF',
            self::RECERTIFICATION => 'RCT',
            self::TRANSITION => 'TRN',
            self::CROSS_TRAINING => 'XTR',
            self::DEVELOPMENT => 'DEV',
        };
    }

    public static function options(): array
    {
        $options = [];

        foreach (self::cases() as $case) {
            $options[$case->value] = $case->getLabel();
        }

        return $options;
    }

    public static function meta(): array
    {
        $meta = [];

        foreach (self::cases() as $case) {
            $meta[$case->value] = [
                'label' => $case->getLabel(),
                'icon' => $case->getIcon(),
                'color' => $case->getColor(),
                'description' => $case->getDescription(),
                'prefix' => $case->prefix(),
            ];
        }

        return $meta;
    }
}
