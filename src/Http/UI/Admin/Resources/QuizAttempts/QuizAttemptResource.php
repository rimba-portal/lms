<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\QuizAttempts;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Lms\Http\UI\Admin\Resources\QuizAttempts\Pages\ListQuizAttempts;
use Rimba\Lms\Models\QuizAttempt;
use UnitEnum;

class QuizAttemptResource extends Resource
{
    protected static ?string $model = QuizAttempt::class;

    protected static string|UnitEnum|null $navigationGroup = 'Lms';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 92;

    protected static ?string $recordTitleAttribute = 'id';

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
            'index' => ListQuizAttempts::route('/'),
            // 'create' => \Rimba\Lms\Http\UI\Admin\Resources\QuizAttempts\Pages\CreateQuizAttempt::route('/create'),
            // 'view' => \Rimba\Lms\Http\UI\Admin\Resources\QuizAttempts\Pages\ViewQuizAttempt::route('/{record}'),
            // 'edit' => \Rimba\Lms\Http\UI\Admin\Resources\QuizAttempts\Pages\EditQuizAttempt::route('/{record}/edit'),
            //
        ];
    }
}
