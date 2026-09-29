<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Certificates\Pages;

use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Rimba\Lms\Enums\CertificateStatus;
use Rimba\Lms\Http\UI\Staff\Resources\Certificates\CertificateResource;

class ListCertificates extends ListRecords
{
    protected static string $resource = CertificateResource::class;

    protected function getHeaderActions(): array
    {
        // Certificates should normally be issued by the LMS,
        // not manually created by staff.
        return [];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 'all';
    }

    public function getTabs(): array
    {
        $counts = CertificateResource::getEloquentQuery()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return [
            'all' => Tab::make(__('All'))
                ->icon('heroicon-o-rectangle-stack')
                ->badge($counts->sum())
                ->badgeColor('primary'),

            CertificateStatus::Valid->value => Tab::make(
                CertificateStatus::Valid->label()
            )
                ->icon('heroicon-o-check-badge')
                ->badge($counts[CertificateStatus::Valid->value] ?? null)
                ->badgeColor(
                    CertificateStatus::Valid->color()
                )
                ->modifyQueryUsing(
                    fn (Builder $query): Builder => $query->where(
                        'status',
                        CertificateStatus::Valid->value,
                    )
                ),

            CertificateStatus::Expired->value => Tab::make(
                CertificateStatus::Expired->label()
            )
                ->icon('heroicon-o-clock')
                ->badge($counts[CertificateStatus::Expired->value] ?? null)
                ->badgeColor(
                    CertificateStatus::Expired->color()
                )
                ->modifyQueryUsing(
                    fn (Builder $query): Builder => $query->where(
                        'status',
                        CertificateStatus::Expired->value,
                    )
                ),

            CertificateStatus::Revoked->value => Tab::make(
                CertificateStatus::Revoked->label()
            )
                ->icon('heroicon-o-x-circle')
                ->badge($counts[CertificateStatus::Revoked->value] ?? null)
                ->badgeColor(
                    CertificateStatus::Revoked->color()
                )
                ->modifyQueryUsing(
                    fn (Builder $query): Builder => $query->where(
                        'status',
                        CertificateStatus::Revoked->value,
                    )
                ),
        ];
    }
}
