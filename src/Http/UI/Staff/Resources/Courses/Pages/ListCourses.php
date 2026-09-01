<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Courses\Pages;

use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Rimba\Lms\Enums\CourseGroup;
use Rimba\Lms\Http\UI\Staff\Resources\Courses\CourseResource;
use Rimba\Lms\Models\Course;

class ListCourses extends ListRecords
{
    protected static string $resource = CourseResource::class;

    protected int|string|array $columnSpan = 'full';

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        $hasOnboarding = Course::query()
            ->where('is_active', true)
            ->where('category', CourseGroup::ONBOARDING)
            ->exists();

        return $hasOnboarding
            ? CourseGroup::ONBOARDING->value
            : 'all';
    }

    public function getTabs(): array
    {
        $counts = Course::query()
            ->where('is_active', true)
            ->get()
            ->groupBy(fn (Course $course) => $course->category?->value)
            ->map->count();

        $tabs = [
            'all' => Tab::make('All')
                ->badge($counts->sum())
                ->badgeColor('primary')
                ->icon('heroicon-o-rectangle-stack')
                ->modifyQueryUsing(
                    fn (Builder $query) => $query
                        ->where('is_active', true)
                ),
        ];

        foreach (CourseGroup::cases() as $group) {
            $count = $counts[$group->value] ?? 0;

            $tabs[$group->value] = Tab::make($group->getLabel())
                ->icon($group->getIcon())
                ->badge($count > 0 ? $count : null)
                ->badgeColor($group->getColor())
                ->modifyQueryUsing(
                    fn (Builder $query) => $query
                        ->where('is_active', true)
                        ->where('category', $group)
                );
        }

        return $tabs;
    }
}
