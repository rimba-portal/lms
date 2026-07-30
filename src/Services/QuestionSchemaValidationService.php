<?php

declare(strict_types=1);

namespace Rimba\Lms\Services;

class QuestionSchemaValidationService
{
    public function validate(array $schema): void
    {
        if (! isset($schema['questions']) || ! is_array($schema['questions'])) {
            throw new \InvalidArgumentException('Question schema must contain a questions array.');
        }

        $keys = [];

        foreach ($schema['questions'] as $question) {
            $key = $question['key'] ?? null;
            $type = $question['type'] ?? null;

            if (! is_string($key) || trim($key) === '') {
                throw new \InvalidArgumentException('Each question must have a non-empty key.');
            }

            if (in_array($key, $keys, true)) {
                throw new \InvalidArgumentException(sprintf('Duplicate question key [%s].', $key));
            }

            $keys[] = $key;

            if (! in_array($type, ['single_choice', 'multiple_choice', 'true_false', 'short_answer', 'text'], true)) {
                throw new \InvalidArgumentException(sprintf('Unsupported question type for [%s].', $key));
            }

            if (($question['points'] ?? 1) < 1) {
                throw new \InvalidArgumentException(sprintf('Question [%s] must have at least 1 point.', $key));
            }

            if (in_array($type, ['single_choice', 'multiple_choice'], true)) {
                $this->validateOptions($question);
            }
        }
    }

    protected function validateOptions(array $question): void
    {
        $key = $question['key'];
        $options = $question['options'] ?? null;

        if (! is_array($options) || $options === []) {
            throw new \InvalidArgumentException(sprintf('Question [%s] requires options.', $key));
        }

        $optionKeys = collect($options)->pluck('key')->filter()->values()->all();
        $answer = $question['answer'] ?? null;

        if (($question['type'] ?? null) === 'single_choice' && ! in_array($answer, $optionKeys, true)) {
            throw new \InvalidArgumentException(sprintf('Question [%s] answer must match one option key.', $key));
        }

        if (($question['type'] ?? null) === 'multiple_choice') {
            foreach ((array) $answer as $answerKey) {
                if (! in_array($answerKey, $optionKeys, true)) {
                    throw new \InvalidArgumentException(sprintf('Question [%s] answer contains an invalid option key.', $key));
                }
            }
        }
    }
}
