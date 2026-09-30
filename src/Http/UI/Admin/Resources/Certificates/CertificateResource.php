<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Admin\Resources\Certificates;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Lms\Http\UI\Admin\Resources\Certificates\Pages\ListCertificates;
use Rimba\Lms\Models\Certificate;
use UnitEnum;

class CertificateResource extends Resource
{
    protected static ?string $model = Certificate::class;

    protected static string|UnitEnum|null $navigationGroup = 'Lms';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 82;

    protected static ?string $recordTitleAttribute = 'certificate_number';

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
            'index' => ListCertificates::route('/'),
            // 'create' => \Rimba\Lms\Http\UI\Admin\Resources\Certificates\Pages\CreateCertificate::route('/create'),
            // 'view' => \Rimba\Lms\Http\UI\Admin\Resources\Certificates\Pages\ViewCertificate::route('/{record}'),
            // 'edit' => \Rimba\Lms\Http\UI\Admin\Resources\Certificates\Pages\EditCertificate::route('/{record}/edit'),
            //
        ];
    }
}
