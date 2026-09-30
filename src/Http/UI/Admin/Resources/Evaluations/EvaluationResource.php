<?php

namespace Rimba\Lms\Http\UI\Admin\Resources\Evaluations;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EvaluationResource extends Resource
{
    protected static ?string $model = \Rimba\Lms\Models\Evaluation::class;

    protected static string|UnitEnum|null $navigationGroup = 'Lms';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 88;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema { return $schema->components([]); }

    public static function infolist(Schema $schema): Schema { return $schema->components([]); }

    public static function table(Table $table): Table { return $table->columns([]); }

    public static function getRelations(): array 
    { 
        return [ 
            // 
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Rimba\Lms\Http\UI\Admin\Resources\Evaluations\Pages\ListEvaluations::route('/'),
            // 'create' => \Rimba\Lms\Http\UI\Admin\Resources\Evaluations\Pages\CreateEvaluation::route('/create'),
            // 'view' => \Rimba\Lms\Http\UI\Admin\Resources\Evaluations\Pages\ViewEvaluation::route('/{record}'),
            // 'edit' => \Rimba\Lms\Http\UI\Admin\Resources\Evaluations\Pages\EditEvaluation::route('/{record}/edit'),
            //
        ];
    }
}
