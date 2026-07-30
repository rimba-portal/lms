<?php

declare(strict_types=1);

namespace Rimba\Lms\Policies;

use Illuminate\Foundation\Auth\User;
use Rimba\Lms\Models\Module;

class ModulePolicy
{
    public function view(User $user, Module $module): bool
    {
        return $user->can('lms.module.view');
    }

    public function update(User $user, Module $module): bool
    {
        return $user->can('lms.module.update');
    }
}
