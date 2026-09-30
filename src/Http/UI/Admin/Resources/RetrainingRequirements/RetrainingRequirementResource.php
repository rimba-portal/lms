<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\RetrainingRequirements;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Lms\Http\UI\Admin\Resources\RetrainingRequirements\Pages\ListRetrainingRequirements;
use Rimba\Lms\Models\RetrainingRequirement;
use UnitEnum;

class RetrainingRequirementResource extends Resource
{
    protected static ?string $model = RetrainingRequirement::class;

    protected static string|UnitEnum|null $navigationGroup = 'Lms';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 94;

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
            'index' => ListRetrainingRequirements::route('/'),
            // 'create' => \Rimba\Lms\Http\UI\Admin\Resources\RetrainingRequirements\Pages\CreateRetrainingRequirement::route('/create'),
            // 'view' => \Rimba\Lms\Http\UI\Admin\Resources\RetrainingRequirements\Pages\ViewRetrainingRequirement::route('/{record}'),
            // 'edit' => \Rimba\Lms\Http\UI\Admin\Resources\RetrainingRequirements\Pages\EditRetrainingRequirement::route('/{record}/edit'),
            //
        ];
    }
}
