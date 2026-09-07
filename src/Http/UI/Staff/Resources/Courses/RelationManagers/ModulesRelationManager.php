<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Courses\RelationManagers;

use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Rimba\Lms\Http\UI\Staff\Resources\Modules\ModuleResource;

class ModulesRelationManager extends RelationManager
{
    protected static string $relationship = 'modules'; // Course::modules()

    protected static ?string $relatedResource = ModuleResource::class;

    public function table(Table $table): Table
    {

        return $table
            ->modifyQueryUsing(function ($query) {
                return $this->ownerRecord
                    ->modules()
                    ->getQuery(); // 🔥 FORCE correct query
            })
            ->headerActions([
                CreateAction::make(),
            ])

            ->recordActions([
                Actions\ViewAction::make(),
            ]);
    }
}
