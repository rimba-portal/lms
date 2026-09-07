<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Courses;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Enums;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Rimba\Lms\Enums\CourseGroup;
use Rimba\Lms\Http\UI\Staff\Resources\Courses\Pages\ListCourses;
use Rimba\Lms\Http\UI\Staff\Resources\Courses\Pages\ViewCourse;
use Rimba\Lms\Http\UI\Staff\Resources\Courses\RelationManagers\ModulesRelationManager;
use Rimba\Lms\Http\UI\Staff\Resources\Courses\Schemas\CourseInfolist;
use Rimba\Lms\Models\Course;
use UnitEnum;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static string|BackedEnum|null $navigationIcon = 'bites-lms-course';

    protected static string|UnitEnum|null $navigationGroup = 'Learning';

    protected static ?int $navigationSort = 25;

    public static function getRecordRouteKeyName(): ?string
    {
        return 'code';
    }

    public static function infolist(Schema $schema): Schema
    {
        return CourseInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // return CoursesTable::configure($table);
        return $table
            ->query(
                // Course::query()->where('is_active', true)->withCount('modules') // ->visibleTo(Auth::user())
                Course::query()->withCount('modules') // ->visibleTo(Auth::user())
            )
            ->recordUrl(function (Course $record): string {
                return CourseResource::getUrl('view', ['record' => $record->code]);
            })
            ->columns([
                TextColumn::make('category')
                    ->label('Group')
                    ->badge()
                    ->alignEnd()
                    ->formatStateUsing(function (?CourseGroup $state, $record): string|Htmlable {
                        $label = $state?->getLabel() ?? '-';
                        $count = $record->modules_count ?? 0;
                        if ($count === 0) {
                            return $label;
                        }

                        return "{$label} · {$count} ".str('module')->plural($count);
                    })
                    ->color(fn (?CourseGroup $state): string|array|null => $state?->getColor())
                    ->tooltip(fn (?CourseGroup $state): string|\Illuminate\Contracts\Support\Htmlable|null => $state?->getDescription()),
                Split::make([
                    IconColumn::make('category')
                        ->label('')
                        ->icon(fn (?CourseGroup $state): string|\BackedEnum|\Illuminate\Contracts\Support\Htmlable => $state?->getIcon() ?? 'heroicon-o-tag')
                        ->color(fn (?CourseGroup $state): string|array|null => $state?->getColor())
                        ->tooltip(fn (?CourseGroup $state): string|\Illuminate\Contracts\Support\Htmlable|null => $state?->getDescription())
                        ->sortable(false)
                        ->grow(false),
                    Stack::make([
                        TextColumn::make('title')
                            ->label('Title')
                            ->searchable()
                            ->weight(Enums\FontWeight::SemiBold)
                            ->color(fn ($record) => $record->category?->getColor())
                            ->tooltip(fn ($record) => $record->category?->getDescription()),
                        TextColumn::make('description')
                            ->size(Enums\TextSize::ExtraSmall)
                            ->searchable()
                            ->wrap(),
                    ]),
                ]),

            ])
            ->paginated(false)
            ->contentGrid([
                'md' => 1,
                'xl' => 4,
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ModulesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCourses::route('/'),
            'view' => ViewCourse::route('/{record}'),
        ];
    }
}
