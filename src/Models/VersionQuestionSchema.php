<?php

declare(strict_types=1);

namespace Rimba\Lms\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Rimba\Versioning\Models\Version;

#[Table('lms_version_question_schemas')]
#[Fillable(['version_id', 'schema_key', 'schema', 'is_active'])]
class VersionQuestionSchema extends Model
{
    public function version(): BelongsTo
    {
        return $this->belongsTo(Version::class);
    }

    protected function casts(): array
    {
        return ['schema' => 'array', 'is_active' => 'boolean'];
    }
}
