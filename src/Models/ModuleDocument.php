<?php

declare(strict_types=1);

namespace Rimba\Lms\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Rimba\Dms\Models\Document;

#[Table('lms_module_documents')]
#[Fillable(['module_id', 'document_id', 'sequence', 'is_required', 'attributes'])]
class ModuleDocument extends Model
{
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    protected function casts(): array
    {
        return ['is_required' => 'boolean', 'attributes' => 'array'];
    }
}
