<?php

declare(strict_types=1);

namespace Rimba\Lms\Services;

use Illuminate\Support\Collection;
use Rimba\Lms\Models\Module;
use Rimba\Lms\Models\VersionQuestionSchema;
use Rimba\Versioning\Models\Version;

class QuestionSchemaResolverService
{
    public function resolveForModule(Module $module): Collection
    {
        return $module->documents()
            ->with('currentVersion')
            ->get()
            ->flatMap(function ($document): Collection {
                $version = $document->currentVersion;

                if (! $version instanceof Version) {
                    return collect();
                }

                $schemas = VersionQuestionSchema::query()
                    ->where('version_id', $version->getKey())
                    ->where('is_active', true)
                    ->get();

                return $schemas->flatMap(fn ($schema) => collect($schema->schema['questions'] ?? [])
                    ->filter(fn (array $question): bool => filled($question['key'] ?? null))
                    ->map(fn (array $question): array => [
                        ...$question,
                        '_document_id' => $document->getKey(),
                        '_version_id' => $version->getKey(),
                        '_version' => $version->version,
                    ]));
            })
            ->values();
    }
}
