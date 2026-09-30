<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\Quizs;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Lms\Http\UI\Admin\Resources\Quizs\Pages\ListQuizs;
use Rimba\Lms\Models\Quiz;
use UnitEnum;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static string|UnitEnum|null $navigationGroup = 'Lms';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 91;

    protected static ?string $recordTitleAttribute = 'name';

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
            'index' => ListQuizs::route('/'),
            // 'create' => \Rimba\Lms\Http\UI\Admin\Resources\Quizs\Pages\CreateQuiz::route('/create'),
            // 'view' => \Rimba\Lms\Http\UI\Admin\Resources\Quizs\Pages\ViewQuiz::route('/{record}'),
            // 'edit' => \Rimba\Lms\Http\UI\Admin\Resources\Quizs\Pages\EditQuiz::route('/{record}/edit'),
            //
        ];
    }
}
