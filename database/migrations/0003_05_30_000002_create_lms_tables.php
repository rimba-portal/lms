<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lms_courses', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('org_team_id')->nullable()->constrained('org_teams')->nullOnDelete();
            $table->string('code')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('attributes')->nullable();
            $table->timestamps();
        });

        Schema::create('lms_course_groups', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('lms_course_groups')->nullOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('attributes')->nullable();
            $table->timestamps();
        });

        Schema::create('lms_course_group_assignments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('course_id')->constrained('lms_courses')->cascadeOnDelete();
            $table->foreignId('course_group_id')->constrained('lms_course_groups')->cascadeOnDelete();
            $table->json('attributes')->nullable();
            $table->timestamps();

            $table->unique(['course_id', 'course_group_id']);
        });

        Schema::create('lms_modules', function (Blueprint $table): void {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('duration_minutes')->nullable();
            $table->unsignedInteger('validity_days')->nullable();
            $table->boolean('requires_quiz')->default(false);
            $table->boolean('requires_evaluation')->default(false);
            $table->json('attributes')->nullable();
            $table->timestamps();
        });

        Schema::create('lms_course_modules', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('course_id')->constrained('lms_courses')->cascadeOnDelete();
            $table->foreignId('module_id')->constrained('lms_modules')->cascadeOnDelete();
            $table->unsignedInteger('sequence')->default(1);
            $table->boolean('is_required')->default(true);
            $table->json('attributes')->nullable();
            $table->timestamps();

            $table->unique(['course_id', 'module_id']);
        });

        Schema::create('lms_module_documents', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('module_id')->constrained('lms_modules')->cascadeOnDelete();
            $table->foreignId('document_id')->constrained('dms_documents')->cascadeOnDelete();
            $table->unsignedInteger('sequence')->default(1);
            $table->boolean('is_required')->default(true);
            $table->json('attributes')->nullable();
            $table->timestamps();

            $table->unique(['module_id', 'document_id']);
        });

        Schema::create('lms_version_question_schemas', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('version_id')->constrained('versions')->cascadeOnDelete();
            $table->string('schema_key')->nullable();
            $table->json('schema');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['version_id', 'is_active']);
        });

        Schema::create('lms_quizzes', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('module_id')->constrained('lms_modules')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('pass_score')->default(80);
            $table->unsignedInteger('max_attempts')->nullable();
            $table->boolean('randomize_questions')->default(false);
            $table->unsignedInteger('question_limit')->nullable();
            $table->json('rules')->nullable();
            $table->json('attributes')->nullable();
            $table->timestamps();
        });

        Schema::create('lms_quiz_attempts', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('quiz_id')->constrained('lms_quizzes')->cascadeOnDelete();
            $table->foreignId('staff_id')->constrained('staff')->cascadeOnDelete();
            $table->string('status', 30)->default('in_progress')->index();
            $table->string('result', 30)->nullable()->index();
            $table->unsignedInteger('score')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('graded_at')->nullable();
            $table->json('attributes')->nullable();
            $table->timestamps();
        });

        Schema::create('lms_quiz_attempt_questions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('quiz_attempt_id')->constrained('lms_quiz_attempts')->cascadeOnDelete();
            $table->foreignId('document_id')->constrained('dms_documents')->cascadeOnDelete();
            $table->foreignId('version_id')->constrained('versions')->cascadeOnDelete();
            $table->string('question_key');
            $table->json('question_snapshot');
            $table->json('answer')->nullable();
            $table->boolean('is_correct')->nullable();
            $table->integer('points_awarded')->default(0);
            $table->integer('points_available')->default(1);
            $table->timestamps();

            $table->index(['version_id', 'question_key']);
        });

        Schema::create('lms_evaluations', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('module_id')->nullable()->constrained('lms_modules')->nullOnDelete();
            $table->foreignId('staff_id')->constrained('staff')->cascadeOnDelete();
            $table->foreignId('evaluator_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('result', 30)->nullable()->index();
            $table->timestamp('evaluated_at')->nullable();
            $table->json('attributes')->nullable();
            $table->timestamps();
        });

        Schema::create('lms_certificates', function (Blueprint $table): void {
            $table->id();
            $table->string('certificate_number')->unique();
            $table->string('certificate_hash', 64)->nullable();
            $table->foreignId('module_id')->constrained('lms_modules')->cascadeOnDelete();
            $table->foreignId('staff_id')->constrained('staff')->cascadeOnDelete();
            $table->foreignId('quiz_attempt_id')->nullable()->constrained('lms_quiz_attempts')->nullOnDelete();
            $table->foreignId('evaluation_id')->nullable()->constrained('lms_evaluations')->nullOnDelete();
            $table->foreignId('issued_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status', 30)->default('valid')->index();
            $table->timestamp('issued_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->json('attributes')->nullable();
            $table->timestamps();

            $table->index(['staff_id', 'status']);
            $table->index(['expires_at', 'status']);
        });

        Schema::create('lms_course_enrollments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('course_id')->constrained('lms_courses')->cascadeOnDelete();
            $table->foreignId('staff_id')->constrained('staff')->cascadeOnDelete();
            $table->string('status', 30)->default('assigned')->index();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->json('attributes')->nullable();
            $table->timestamps();

            $table->unique(['course_id', 'staff_id']);
        });

        Schema::create('lms_retraining_requirements', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('document_id')->constrained('dms_documents')->cascadeOnDelete();
            $table->foreignId('version_id')->constrained('versions')->cascadeOnDelete();
            $table->foreignId('module_id')->nullable()->constrained('lms_modules')->nullOnDelete();
            $table->foreignId('course_id')->nullable()->constrained('lms_courses')->nullOnDelete();
            $table->foreignId('staff_id')->nullable()->constrained('staff')->nullOnDelete();
            $table->string('status', 30)->default('open')->index();
            $table->date('due_date')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->json('attributes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lms_retraining_requirements');
        Schema::dropIfExists('lms_course_enrollments');
        Schema::dropIfExists('lms_certificates');
        Schema::dropIfExists('lms_evaluations');
        Schema::dropIfExists('lms_quiz_attempt_questions');
        Schema::dropIfExists('lms_quiz_attempts');
        Schema::dropIfExists('lms_quizzes');
        Schema::dropIfExists('lms_version_question_schemas');
        Schema::dropIfExists('lms_module_documents');
        Schema::dropIfExists('lms_course_modules');
        Schema::dropIfExists('lms_modules');
        Schema::dropIfExists('lms_course_group_assignments');
        Schema::dropIfExists('lms_course_groups');
        Schema::dropIfExists('lms_courses');
    }
};
