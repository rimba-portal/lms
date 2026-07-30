<?php

declare(strict_types=1);

namespace Rimba\Lms\Services;

use Rimba\Dms\Models\Document;
use Rimba\Lms\Actions\StoreVersionQuestionSchema;

class QuestionSchemaImportService
{
    public function __construct(
        protected QuestionSchemaValidationService $validator,
        protected StoreVersionQuestionSchema $storeVersionQuestionSchema,
    ) {}

    public function importFromArray(array $payload): void
    {
        foreach ($payload['documents'] ?? [] as $documentPayload) {
            $document = Document::query()
                ->where('doc_number', $documentPayload['doc_number'])
                ->first();

            if (! $document) {
                continue;
            }

            foreach ($documentPayload['question_schemas'] ?? [] as $schemaPayload) {
                $version = $document->versions()
                    ->where('version', $schemaPayload['version'])
                    ->first();

                if (! $version) {
                    continue;
                }

                $schema = $schemaPayload['schema'];
                $this->validator->validate($schema);

                $this->storeVersionQuestionSchema->execute(
                    version: $version,
                    schema: $schema,
                    key: $schemaPayload['schema_key'] ?? 'default',
                    deactivatePrevious: (bool) ($schemaPayload['deactivate_previous'] ?? true),
                );
            }
        }
    }
}
