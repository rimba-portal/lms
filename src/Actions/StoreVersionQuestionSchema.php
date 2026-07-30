<?php

declare(strict_types=1);

namespace Rimba\Lms\Actions;

use Rimba\Lms\Models\VersionQuestionSchema;
use Rimba\Lms\Services\QuestionSchemaValidationService;
use Rimba\Versioning\Models\Version;

class StoreVersionQuestionSchema
{
    public function execute(
        Version $version,
        array $schema,
        ?string $key = null,
        bool $deactivatePrevious = true,
    ): VersionQuestionSchema {
        app(QuestionSchemaValidationService::class)
            ->validate($schema);

        if ($deactivatePrevious) {
            VersionQuestionSchema::query()
                ->where('version_id', $version->getKey())
                ->when($key, fn ($query) => $query->where('schema_key', $key))
                ->update(['is_active' => false]);
        }

        return VersionQuestionSchema::query()->create([
            'version_id' => $version->getKey(),
            'schema_key' => $key,
            'schema' => $schema,
            'is_active' => true,
        ]);
    }
}
