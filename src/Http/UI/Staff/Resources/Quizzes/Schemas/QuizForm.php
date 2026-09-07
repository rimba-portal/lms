<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Quizzes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Rimba\Lms\Enums\CourseGroup;

class QuizForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Course Details')
                    ->description('Primary identifiers and classification settings for this learning course.')
                    ->aside()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('code')
                                    ->label('Course Code')
                                    ->required()
                                    ->disabledOn('edit') // Lock on update to preserve routing slugs stable
                                    ->unique(ignoreRecord: true)
                                    ->placeholder('e.g., LRN-MGMT-01'),

                                TextInput::make('title')
                                    ->label('Course Title')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('e.g., Executive Management Core'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Select::make('category')
                                    ->label('Group Category')
                                    ->required()
                                    ->options(CourseGroup::class) // Automatically pairs with your CourseGroup backed enum
                                    ->native(false),
                            ]),

                        Textarea::make('description')
                            ->label('Course Overview')
                            ->rows(3)
                            ->nullable()
                            ->placeholder('Brief overview summary of syllabus goals...'),

                        Toggle::make('is_active')
                            ->label('Active Availability')
                            ->helperText('Turn off to hide this course from active enrollment directories.')
                            ->default(true),
                    ]),
            ]);
    }
}
