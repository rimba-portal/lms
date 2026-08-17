# Rimba LMS
Learning Management System (LMS) designed for controlled training, competency evidence, quiz assessment, certification, and retraining based on controlled document versions.
The package focuses on course structure, module assignment, document-based learning materials, version-controlled question schemas, quiz attempts, evaluations, certificates, expiry, and audit traceability.

---
# Purpose
The LMS package provides a structured training and competency layer for the Rimba ecosystem.
It manages:
- Courses
- Course Groups
- Learning Modules
- Controlled Training Documents
- Version-Based Question Schemas
- Quizzes
- Quiz Attempts
- Evaluation Records
- Certificates
- Training Validity
- Retraining Requirements
The key design principle is that training content and quiz questions should come from controlled document versions, not from uncontrolled LMS attributes.

---
# Design Principle
Course and Module define the learning structure.
DMS Document and Version define the controlled learning content.
Question Schema belongs to a controlled Version.
Quiz Attempt stores a snapshot of selected questions.
```text
Course
    └── Modules
            ├── DMS Documents
            │       └── Current Released Version
            │               └── Question Schema
            └── Quiz
                    └── Quiz Attempt
                            └── Attempt Question Snapshot
```
This ensures that when a document is revised and a new version is released, future quiz launches automatically use the revised question schema.
Historical quiz attempts remain auditable because they keep their own question snapshots.

---
# Package Dependencies
The LMS package is intended to integrate with existing Rimba packages.
## Core Dependencies
- rimba/dms (Controlled Training Documents)
- rimba/versi (Document Version Control)
- rimba/orang (Staff / Learners)
- rimba/pihak (Organization / Teams)
- rimba/boleh (Authorization)
- rimba/jejak (Audit Trail)
## Optional Dependencies
- rimba/kerja (Training Tasks / Retraining Assignments)
- rimba/jalan (Approval / Assessment Workflows)
- rimba/waktu (Validity, Expiry, Scheduling)

---
# Why Materials Are Removed
The original LMS design had:
```text
materials
material_modules
```
This is removed because training materials should be controlled documents.
Instead of storing material records separately, LMS links modules to DMS documents.
```text
modules
    └── module_documents
            └── documents
                    └── versions
```
This avoids duplication and keeps the DMS package as the single source of truth for learning content.

---
# Document-Based Learning Content
Each learning module may reference one or more controlled DMS documents.
Examples:
```text
Module: Forklift Safety Basics
    ├── DOC-SAF-001 Forklift Safety SOP
    ├── WI-SAF-003 Daily Inspection Work Instruction
    └── FORM-SAF-010 Forklift Checklist
```
The learner sees the current released version of each document.
The quiz uses the question schema from the current released version at the time the quiz attempt is launched.

---
# Version-Based Question Schema
Questions should not be stored inside `quizzes.attributes`.
Instead, questions belong to document versions.
```text
Document
    └── Version 1.0.0
            └── Question Schema
    └── Version 2.0.0
            └── Revised Question Schema
```
This means:
- Revised documents can have revised questions
- New quiz attempts use the latest released document version
- Old attempts remain linked to the exact version used
- Audit history remains clear

---
# Important Quiz Rule
Use current document versions only when the quiz attempt starts.
After the attempt starts, never re-read live question schemas.
Correct pattern:
```text
Before attempt:
Use latest released document version
During attempt:
Use quiz_attempt_questions snapshot
After attempt:
Use quiz_attempt_questions snapshot for audit
```
This prevents a quiz from changing while a learner is already taking it.

---
# Core Models
## Course
Represents a training program or learning path.
Example:
```text
COURSE-SAF-001
Forklift Safety Training
```
Suggested fields:
```text
id
org_team_id
code
title
description
is_active
attributes
created_at
updated_at
```

---
## CourseGroup
Groups courses into categories or training catalog sections.
Example:
```text
Safety Training
Quality Training
Machine Operation
New Hire Orientation
```
Suggested fields:
```text
id
parent_id
name
description
attributes
created_at
updated_at
```

---
## CourseGroupAssignment
Links a course to one or more course groups.
Suggested fields:
```text
id
course_id
course_group_id
attributes
created_at
updated_at
```

---
## Module
Represents a learning unit that belongs to one or more courses.
Example:
```text
MOD-SAF-001
Personal Protective Equipment Basics
```
Suggested fields:
```text
id
code
name
description
duration_minutes
validity_days
requires_quiz
requires_evaluation
attributes
created_at
updated_at
```

---
## CourseModule
Defines the ordered sequence of modules inside a course.
Suggested fields:
```text
id
course_id
module_id
sequence
is_required
attributes
created_at
updated_at
```

---
## ModuleDocument
Links modules to controlled DMS documents.
This replaces `materials` and `material_modules`.
Suggested fields:
```text
id
module_id
document_id
sequence
is_required
attributes
created_at
updated_at
```
Example:
```text
Module: Incoming Inspection Training
    ├── SOP-QA-001 Incoming Inspection Procedure
    ├── WI-QA-001 Visual Inspection Work Instruction
    └── FORM-QA-001 Inspection Checklist
```

---
## VersionQuestionSchema
Stores quiz question schema for a document version.
Suggested fields:
```text
id
version_id
schema_key
schema
is_active
created_at
updated_at
```
Example schema:
```json
{
  "questions": [
    {
      "key": "ppe_required_area",
      "type": "single_choice",
      "question": "What PPE is required before entering the production area?",
      "options": [
        {
          "key": "a",
          "label": "Safety shoes only"
        },
        {
          "key": "b",
          "label": "Safety shoes, hairnet, and ESD coat"
        },
        {
          "key": "c",
          "label": "No PPE required"
        }
      ],
      "answer": "b",
      "points": 1,
      "tags": ["safety", "ppe"],
      "difficulty": "easy"
    }
  ]
}
```
Question keys should be stable.
Do not depend on array index because question order can change when a document is revised.

---
## Quiz
Defines how a module quiz should run.
The quiz does not own the questions.
It only owns quiz rules.
Suggested fields:
```text
id
module_id
name
description
pass_score
max_attempts
randomize_questions
question_limit
rules
attributes
created_at
updated_at
```
Example rules:
```text
pass_score = 80
max_attempts = 3
randomize_questions = true
question_limit = 10
```

---
## QuizAttempt
Represents one learner attempt.
Suggested fields:
```text
id
quiz_id
staff_id
status
result
score
started_at
submitted_at
attempted_at
attributes
created_at
updated_at
```
Recommended statuses:
```text
in_progress
submitted
graded
cancelled
```
Recommended results:
```text
pass
fail
```

---
## QuizAttemptQuestion
Stores the exact question snapshot used during an attempt.
This is critical for audit evidence.
Suggested fields:
```text
id
quiz_attempt_id
document_id
version_id
question_key
question_snapshot
answer
is_correct
points_awarded
points_available
created_at
updated_at
```
This proves:
```text
Which document was used
Which version was used
Which question was asked
Which answer was submitted
How marks were awarded
```

---
## Evaluation
Represents practical or supervisor assessment.
Example:
```text
Machine Setup Practical Evaluation
Forklift Driving Practical Evaluation
Visual Inspection Competency Evaluation
```
Suggested fields:
```text
id
module_id
staff_id
evaluator_id
result
evaluated_at
attributes
created_at
updated_at
```

---
## Certificate
Represents issued competency or training evidence.
Suggested fields:
```text
id
certificate_number
certificate_hash
module_id
staff_id
quiz_attempt_id
evaluation_id
issued_by
status
issued_at
expires_at
attributes
created_at
updated_at
```
Recommended statuses:
```text
valid
expired
revoked
```

---
# Quiz Launch Flow
When a learner starts a quiz:
```text
1. Get quiz module
2. Get all required module documents
3. Resolve current released version for each document
4. Read active question schema from each version
5. Consolidate all questions
6. Apply quiz rules
7. Randomize or limit questions if configured
8. Create quiz_attempt record
9. Snapshot selected questions into quiz_attempt_questions
10. Launch quiz
```
This is handled by:
```text
BuildQuizAttempt
QuestionSchemaResolverService
```

---
# Quiz Submission Flow
When a learner submits a quiz:
```text
1. Read quiz_attempt_questions snapshot
2. Compare learner answers to the snapshot answers
3. Calculate score
4. Mark each question as correct or incorrect
5. Update quiz_attempt result
6. Issue certificate if pass criteria are met
7. Log audit trail
```
This is handled by:
```text
SubmitQuizAttempt
GradeQuizAttempt
QuizGradingService
IssueCertificate
```

---
# Retraining Flow
When a controlled document is revised:
```text
Document Version Released
        ↓
Find modules using the document
        ↓
Find courses using those modules
        ↓
Find staff with active certificates or prior completions
        ↓
Create retraining requirement
        ↓
Learner completes revised quiz
        ↓
New certificate or training record issued
```  
This provides strong traceability between document revision and competency renewal.

---
# Training Validity
Modules may define validity.
Example:
```text
Forklift Safety Module       365 days
ESD Awareness Module         730 days
Quality System Overview      No expiry
```
The certificate expiry date can be calculated from:
```text
certificate.issued_at + module.validity_days
```

---

# LMS Lifecycle
Recommended learner lifecycle:
```text
Assigned
    ↓
Started
    ↓
In Progress
    ↓
Quiz Submitted
    ↓
Evaluated
    ↓
Completed
    ↓
Certified
    ↓
Expired / Retraining Required
```

---
# Audit Trail
All learning events should be logged through `rimba/jejak`.
Tracked events:
```text
Course Created
Module Added
Document Attached To Module
Question Schema Added To Version
Quiz Attempt Started
Quiz Attempt Submitted
Quiz Attempt Graded
Evaluation Completed
Certificate Issued
Certificate Expired
Certificate Revoked
Retraining Required
```

---
# Recommended LMS Structure
```text
rimba/lms
Learning
├── Courses
├── Course Groups
├── Modules
├── Course Modules
├── Module Documents
└── Version Question Schemas
Assessment
├── Quizzes
├── Quiz Attempts
├── Quiz Attempt Questions
└── Evaluations
Certification
├── Certificates
├── Training Validity
└── Retraining Requirements
Integrations
├── dms
├── versi
├── jejak
├── kerja
├── boleh
├── orang
├── pihak
└── waktu
```

---
# Recommended Package Files
```text
rimba/lms
│
├── config
│   └── lms.php
│
├── database
│   ├── migrations
│   │   └── create_lms_tables.php
│   │
│   └── seeders
│       └── LmsSeeder.php
│
├── resources
│   ├── views
│   └── lms.md
│
└── src
    │
    ├── LmsServiceProvider.php
    │
    ├── Models
    │   ├── Course.php
    │   ├── CourseGroup.php
    │   ├── CourseGroupAssignment.php
    │   ├── Module.php
    │   ├── CourseModule.php
    │   ├── ModuleDocument.php
    │   ├── VersionQuestionSchema.php
    │   ├── Quiz.php
    │   ├── QuizAttempt.php
    │   ├── QuizAttemptQuestion.php
    │   ├── Evaluation.php
    │   └── Certificate.php
    │
    ├── Enums
    │   ├── QuizAttemptStatus.php
    │   ├── QuizResult.php
    │   ├── EvaluationResult.php
    │   └── CertificateStatus.php
    │
    ├── Actions
    │   ├── CreateCourse.php
    │   ├── AttachDocumentToModule.php
    │   ├── StoreVersionQuestionSchema.php
    │   ├── BuildQuizAttempt.php
    │   ├── SubmitQuizAttempt.php
    │   ├── GradeQuizAttempt.php
    │   ├── IssueCertificate.php
    │   ├── ExpireCertificate.php
    │   └── CreateRetrainingRequirement.php
    │
    ├── Services
    │   ├── QuestionSchemaResolverService.php
    │   ├── QuizGradingService.php
    │   ├── CertificateService.php
    │   └── TrainingValidityService.php
    │
    ├── Policies
    │   ├── CoursePolicy.php
    │   ├── ModulePolicy.php
    │   ├── QuizPolicy.php
    │   └── CertificatePolicy.php
    │
    ├── Observers
    │   ├── QuizAttemptObserver.php
    │   └── CertificateObserver.php
    │
    ├── Jobs
    │   ├── ExpireCertificates.php
    │   ├── SendTrainingReminder.php
    │   └── GenerateRetrainingAssignments.php
    │
    ├── Events
    │   ├── QuizAttemptStarted.php
    │   ├── QuizAttemptSubmitted.php
    │   ├── QuizAttemptGraded.php
    │   ├── CertificateIssued.php
    │   ├── CertificateExpired.php
    │   └── RetrainingRequired.php
    │
    ├── Listeners
    │   ├── CreateAuditTrail.php
    │   ├── IssueCertificateOnPass.php
    │   ├── NotifyLearner.php
    │   └── GenerateRetrainingOnDocumentRelease.php
    │
    ├── Builders
    │   ├── CourseBuilder.php
    │   ├── ModuleBuilder.php
    │   ├── QuizAttemptBuilder.php
    │   └── CertificateBuilder.php
    │
    ├── Traits
    │   ├── HasCourses.php
    │   ├── HasModules.php
    │   ├── HasQuizAttempts.php
    │   └── HasCertificates.php
    │
    ├── Http
    │   └── UI
    │       ├── Admin
    │       │   ├── Resources
    │       │   │   ├── Courses
    │       │   │   ├── Modules
    │       │   │   ├── Quizzes
    │       │   │   └── Certificates
    │       │   │
    │       │   ├── Pages
    │       │   │   ├── LmsDashboard.php
    │       │   │   ├── TrainingMatrix.php
    │       │   │   └── ExpiringCertificates.php
    │       │   │
    │       │   └── Widgets
    │       │       ├── PendingTrainingWidget.php
    │       │       ├── ExpiringCertificatesWidget.php
    │       │       └── QuizPassRateWidget.php
    │       │
    │       └── Staff
    │           ├── Pages
    │           │   ├── MyCourses.php
    │           │   ├── MyQuizzes.php
    │           │   └── MyCertificates.php
    │           │
    │           └── Widgets
    │               ├── MyPendingTrainingWidget.php
    │               └── MyExpiringCertificatesWidget.php
    │
    └── Console
        └── Commands
            ├── lms:expire-certificates
            ├── lms:training-reminders
            ├── lms:retraining-check
            └── lms:compliance-report
```

---
# Final Recommendation
The LMS should not duplicate document storage.  
Use DMS for content.  
Use Version for controlled revisions.  
Use VersionQuestionSchema for controlled quiz questions.  
Use QuizAttemptQuestion snapshots for audit-safe quiz history.  
This gives Rimba LMS a strong compliance foundation for training, competency, certification, and document-change-driven retraining.
