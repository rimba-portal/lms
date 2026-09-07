<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Modules;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Rimba\Lms\Http\UI\Staff\Resources\Modules\Pages\ListModules;
use Rimba\Lms\Http\UI\Staff\Resources\Modules\Pages\ViewModule;
use Rimba\Lms\Http\UI\Staff\Resources\Modules\Schemas\ModuleForm;
use Rimba\Lms\Http\UI\Staff\Resources\Modules\Schemas\ModuleInfolist;
use Rimba\Lms\Models\Module;
use UnitEnum;

class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;

    protected static string|BackedEnum|null $navigationIcon = 'bites-lms-module';

    protected static string|UnitEnum|null $navigationGroup = 'Learning';

    protected static ?int $navigationSort = 26;

    // protected static ?string $recordTitleAttribute = 'name';
    public static function getRecordRouteKeyName(): ?string
    {
        return 'code';
    }

    public static function form(Schema $schema): Schema
    {
        return ModuleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ModuleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            // 🌟 Make the entire row clickable to navigate using the 'code' column
            ->recordUrl(fn (Module $record): string => ModuleResource::getUrl('view', ['record' => $record->code]))

            // 🌟 Enables Filament's built-in compact styling (tighter padding/spacing)
            ->striped()

            ->columns([
                TextColumn::make('code')
                    ->label('Code')
                    ->fontFamily('mono')
                    ->weight(FontWeight::SemiBold)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('duration_minutes')
                    ->label('Duration')
                    ->numeric()
                    ->suffix(' mins')
                    ->alignEnd()
                    ->sortable(),

                TextColumn::make('validity_days')
                    ->label('Validity')
                    ->numeric()
                    ->suffix(' days')
                    ->alignEnd()
                    ->placeholder('-')
                    ->sortable(),

                // Compact boolean flags represented as clean icons
                IconColumn::make('requires_quiz')
                    ->label('Quiz')
                    ->boolean()
                    ->alignCenter(),

                IconColumn::make('requires_evaluation')
                    ->label('Eval')
                    ->boolean()
                    ->alignCenter(),
            ])
            ->defaultSort('code', 'asc');
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
            'index' => ListModules::route('/'),
            'view' => ViewModule::route('/{record}'),
        ];
    }
}
