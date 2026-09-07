<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Modules\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ModuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Module Information')
                    ->description('Manage the primary identity and settings of this learning module.')
                    // ->aside() // Pushes the description to the left, keeping form fields cleanly stacked on the right
                    ->schema([

                        Grid::make(2) // 2-column layout for top identifiers
                            ->schema([
                                TextInput::make('code')
                                    ->label('Module Code')
                                    ->required()
                                    // ->uppercase()
                                    ->disabledOn('edit') // Keeps structural URLs steady by locking codes on edit
                                    ->unique(ignoreRecord: true)
                                    ->placeholder('e.g., MOD-101'),

                                TextInput::make('name')
                                    ->label('Module Name')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('e.g., Introduction to Safety Compliance'),
                            ]),

                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->nullable()
                            ->placeholder('Provide a brief overview of what this module covers...'),

                        Grid::make(2) // 2-column layout for time-based tracking metrics
                            ->schema([
                                TextInput::make('duration_minutes')
                                    ->label('Estimated Duration')
                                    ->numeric()
                                    ->minValue(1)
                                    ->suffix('minutes')
                                    ->placeholder('e.g., 45'),

                                TextInput::make('validity_days')
                                    ->label('Validity Period')
                                    ->numeric()
                                    ->minValue(1)
                                    ->suffix('days')
                                    ->placeholder('e.g., 365 (Leave blank for lifetime)'),
                            ]),

                        Fieldset::make('Requirements')
                            ->columns(2) // Places toggle options side-by-side inside a compact grouped border
                            ->schema([
                                Toggle::make('requires_quiz')
                                    ->label('Requires Quiz Assessment')
                                    ->default(false),

                                Toggle::make('requires_evaluation')
                                    ->label('Requires Practical Evaluation')
                                    ->default(false),
                            ]),
                    ]),
            ])->columns(1);
    }
}
