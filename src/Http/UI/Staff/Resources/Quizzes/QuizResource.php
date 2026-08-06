<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Quizzes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Lms\Http\UI\Staff\Resources\Quizzes\Pages\CreateQuiz;
use Rimba\Lms\Http\UI\Staff\Resources\Quizzes\Pages\EditQuiz;
use Rimba\Lms\Http\UI\Staff\Resources\Quizzes\Pages\ListQuizzes;
use Rimba\Lms\Http\UI\Staff\Resources\Quizzes\Schemas\QuizForm;
use Rimba\Lms\Http\UI\Staff\Resources\Quizzes\Tables\QuizzesTable;
use Rimba\Lms\Models\Quiz;
use UnitEnum;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static string|BackedEnum|null $navigationIcon = 'rimba-lms-quiz';

    protected static string|UnitEnum|null $navigationGroup = 'Learning';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return QuizForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuizzesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQuizzes::route('/'),
            'create' => CreateQuiz::route('/create'),
            'edit' => EditQuiz::route('/{record}/edit'),
        ];
    }
}
