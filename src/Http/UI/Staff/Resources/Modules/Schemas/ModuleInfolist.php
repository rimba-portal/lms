<?php

declare(strict_types=1);

namespace Rimba\Lms\Http\UI\Staff\Resources\Modules\Schemas;

use Filament\Schemas\Schema;

class ModuleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }
}
