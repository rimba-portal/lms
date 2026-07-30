<?php

declare(strict_types=1);

namespace Rimba\Lms\Builders;

use Illuminate\Database\Eloquent\Builder;
use Rimba\Lms\Enums\CertificateStatus;

class CertificateBuilder extends Builder
{
    public function valid(): static
    {
        return $this->where('status', CertificateStatus::Valid->value);
    }

    public function expired(): static
    {
        return $this->where('status', CertificateStatus::Expired->value);
    }

    public function expiringWithin(int $days): static
    {
        return $this->valid()->whereNotNull('expires_at')->where('expires_at', '<=', now()->addDays($days));
    }
}
