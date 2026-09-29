<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Certificates\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Rimba\Lms\Enums\CertificateStatus;

class CertificatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('module.name')
                    ->label('Module')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('certificate_number')
                    ->label('Certificate No.')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('quizAttempt.quiz.name')
                    ->label('Assessment')
                    ->placeholder('-'),

                TextColumn::make('issued_at')
                    ->label('Issued')
                    ->date()
                    ->sortable(),

                TextColumn::make('expires_at')
                    ->label('Valid Until')
                    ->date()
                    ->placeholder('Lifetime')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(
                        fn (
                            CertificateStatus|string|null $state
                        ): string => $state instanceof CertificateStatus
                            ? $state->label()
                            : ucfirst((string) $state)
                    )
                    ->color(
                        fn (
                            CertificateStatus|string|null $state
                        ): string => $state instanceof CertificateStatus
                            ? $state->color()
                            : CertificateStatus::tryFrom((string) $state)?->color()
                                ?? 'gray'
                    ),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->defaultSort('issued_at', 'desc');
    }
}
