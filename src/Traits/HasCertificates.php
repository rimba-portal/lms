<?php

declare(strict_types=1);

namespace Rimba\Lms\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Rimba\Lms\Models\Certificate;

trait HasCertificates
{
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class, 'staff_id');
    }
}
