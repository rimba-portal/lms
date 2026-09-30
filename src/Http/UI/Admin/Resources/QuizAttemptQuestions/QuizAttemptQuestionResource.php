<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\QuizAttemptQuestions;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Lms\Http\UI\Admin\Resources\QuizAttemptQuestions\Pages\ListQuizAttemptQuestions;
use Rimba\Lms\Models\QuizAttemptQuestion;
use UnitEnum;

class QuizAttemptQuestionResource extends Resource
{
    protected static ?string $model = QuizAttemptQuestion::class;

    protected static string|UnitEnum|null $navigationGroup = 'Lms';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 93;

    protected static ?string $recordTitleAttribute = 'question_key';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([]);
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
            'index' => ListQuizAttemptQuestions::route('/'),
            // 'create' => \Rimba\Lms\Http\UI\Admin\Resources\QuizAttemptQuestions\Pages\CreateQuizAttemptQuestion::route('/create'),
            // 'view' => \Rimba\Lms\Http\UI\Admin\Resources\QuizAttemptQuestions\Pages\ViewQuizAttemptQuestion::route('/{record}'),
            // 'edit' => \Rimba\Lms\Http\UI\Admin\Resources\QuizAttemptQuestions\Pages\EditQuizAttemptQuestion::route('/{record}/edit'),
            //
        ];
    }
}
