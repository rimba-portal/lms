<?php

declare(strict_types=1);

namespace Rimba\Lms\Policies;

use Illuminate\Foundation\Auth\User;
use Rimba\Lms\Models\Certificate;

class CertificatePolicy
{
    public function view(User $user, Certificate $certificate): bool
    {
        return $user->can('lms.certificate.view');
    }

    public function revoke(User $user, Certificate $certificate): bool
    {
        return $user->can('lms.certificate.revoke');
    }
}
