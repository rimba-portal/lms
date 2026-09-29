<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Certificates;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rimba\Lms\Http\UI\Staff\Resources\Certificates\Pages\ListCertificates;
use Rimba\Lms\Http\UI\Staff\Resources\Certificates\Pages\ViewCertificate;
use Rimba\Lms\Http\UI\Staff\Resources\Certificates\Schemas\CertificateInfolist;
use Rimba\Lms\Http\UI\Staff\Resources\Certificates\Tables\CertificatesTable;
use Rimba\Lms\Models\Certificate;
use UnitEnum;

class CertificateResource extends Resource
{
    protected static ?string $model = Certificate::class;

    protected static string|BackedEnum|null $navigationIcon = 'bites-lms-certificate';

    protected static string|UnitEnum|null $navigationGroup = 'Learning';

    protected static ?int $navigationSort = 24;

    protected static ?string $recordTitleAttribute = 'certificate_number';

    public static function infolist(Schema $schema): Schema
    {
        return CertificateInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CertificatesTable::configure($table);
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
            'index' => ListCertificates::route('/'),
            'view' => ViewCertificate::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $staffId = Auth::user()?->staff?->getKey();

        return parent::getEloquentQuery()
            ->when(
                $staffId,
                fn (Builder $query, int|string $staffId): Builder => $query->where('staff_id', $staffId),
                fn (Builder $query): Builder => $query->whereRaw('1 = 0'),
            )
            ->with([
                'module',
                'quizAttempt.quiz',
            ]);
    }
}
