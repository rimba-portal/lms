<?php

declare(strict_types=1);

namespace Rimba\Lms\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Rimba\Lms\Builders\CertificateBuilder;
use Rimba\Lms\Enums\CertificateStatus;
use Rimba\Lms\Observers\CertificateObserver;
use Rimba\Lms\Policies\CertificatePolicy;

#[Table('lms_certificates')]
#[UsePolicy(CertificatePolicy::class)]
#[ObservedBy([CertificateObserver::class])]
#[Fillable(['certificate_number', 'certificate_hash', 'module_id', 'staff_id', 'quiz_attempt_id', 'evaluation_id', 'issued_by', 'status', 'issued_at', 'expires_at', 'attributes'])]
class Certificate extends Model
{
    public function newEloquentBuilder($query): CertificateBuilder
    {
        return new CertificateBuilder($query);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function quizAttempt(): BelongsTo
    {
        return $this->belongsTo(QuizAttempt::class);
    }

    public function evaluation(): BelongsTo
    {
        return $this->belongsTo(Evaluation::class);
    }

    protected function casts(): array
    {
        return ['status' => CertificateStatus::class, 'issued_at' => 'datetime', 'expires_at' => 'datetime', 'attributes' => 'array'];
    }
}
