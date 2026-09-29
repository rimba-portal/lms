<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Certificates\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Rimba\Lms\Http\UI\Staff\Pages\TakeQuiz;
use Rimba\Lms\Http\UI\Staff\Resources\Certificates\CertificateResource;
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
                    $quizId = $certificate->quizAttempt?->quiz_id;

                    return $quizId
                        ? TakeQuiz::getUrl(['quiz' => $quizId], panel: 'staff')
                        : null;
                })
                ->openUrlInNewTab(true),
        ];
    }
}
