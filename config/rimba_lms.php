<?php

declare(strict_types=1);

use Rimba\Lms\Enums\CertificateStatus;
use Rimba\Lms\Enums\QuizAttemptStatus;

return [
    'tables' => [
        'courses' => 'courses',
        'course_groups' => 'course_groups',
        'course_group_assignments' => 'course_group_assignments',
        'modules' => 'modules',
        'course_modules' => 'course_modules',
        'module_documents' => 'module_documents',
        'version_question_schemas' => 'version_question_schemas',
        'quizzes' => 'quizzes',
        'quiz_attempts' => 'quiz_attempts',
        'quiz_attempt_questions' => 'quiz_attempt_questions',
        'evaluations' => 'evaluations',
        'certificates' => 'certificates',
        'course_enrollments' => 'course_enrollments',
        'retraining_requirements' => 'retraining_requirements',
    ],

    'defaults' => [
        'course_active' => true,
        'pass_score' => 80,
        'max_attempts' => 3,
        'randomize_questions' => false,
        'quiz_attempt_status' => QuizAttemptStatus::InProgress->value,
        'certificate_status' => CertificateStatus::Valid->value,
    ],

    'question_types' => [
        'single_choice' => 'Single Choice',
        'multiple_choice' => 'Multiple Choice',
        'true_false' => 'True / False',
        'short_answer' => 'Short Answer',
        'text' => 'Long Text',
    ],
];
