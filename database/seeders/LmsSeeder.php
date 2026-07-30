<?php

declare(strict_types=1);

namespace Rimba\Lms\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Rimba\Lms\Services\QuestionSchemaImportService;

class LmsSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        foreach ([
            'New Hire Orientation',
            'Safety Training',
            'Quality Training',
            'Machine Operation',
            'Compliance Training',
        ] as $name) {
            DB::table('course_groups')->updateOrInsert(
                ['name' => $name],
                ['description' => null, 'created_at' => $now, 'updated_at' => $now],
            );
        }

        $path = __DIR__.'/../../resources/data/lms/question-schemas.json';

        if (! file_exists($path)) {
            return;
        }

        $payload = json_decode(
            file_get_contents($path),
            true,
            flags: JSON_THROW_ON_ERROR,
        );

        app(QuestionSchemaImportService::class)
            ->importFromArray($payload);
    }
}
