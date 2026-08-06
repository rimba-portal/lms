<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Certificates\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Rimba\Lms\Http\UI\Staff\Resources\Certificates\CertificateResource;
use Rimba\Lms\Http\UI\Staff\Resources\Quizzes\QuizResource;
use Rimba\Lms\Models\Certificate;

class ViewCertificate extends ViewRecord
{
    protected static string $resource = CertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('viewAttempt')
                ->label('Recertify')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->visible(fn (Certificate $certificate): bool => (bool) $certificate->quiz_attempt_id)
                ->url(function (Certificate $certificate): ?string {
                    $attempt = $certificate->attempt->quiz_id; // or resolve via model: QuizAttempt::find($record->quiz_attempt_id)
                    if (! $attempt) {
                        return null;
                    }

                    return QuizResource::getUrl(
                        'view',
                        ['record' => $attempt], // can pass model or route key (id/uuid)
                        panel: 'lms',
                    );
                })
                ->openUrlInNewTab(true),
        ];
    }
}
