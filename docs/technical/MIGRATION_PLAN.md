# Migration Plan

This document outlines the ordered creation and execution of database migrations for the Live Class Monitoring System.

## Migration Sequence (Execution Order)

### 1. Core Users Table
- `migrations/2026_04_12_000001_create_admins_table.php`
- `migrations/2026_04_12_000002_create_colleges_table.php`

### 2. Entities (Dependent on Colleges)
- `migrations/2026_04_12_000003_create_students_table.php`
  - *Constraint:* `college_id` FK references `colleges.id`.

### 3. Sessions (Dependent on Admins)
- `migrations/2026_04_12_000004_create_live_sessions_table.php`

### 4. Tracking (Dependent on Students and Sessions)
- `migrations/2026_04_12_000005_create_attendance_logs_table.php`
  - *Constraint:* `student_id` FK references `students.id`.
  - *Constraint:* `session_id` FK references `live_sessions.id`.

### 5. Meta/Logs
- `migrations/2026_04_12_000006_create_system_settings_table.php`

---

## Seeder Planning
- **`AdminSeeder`:** Creates one Super Admin account.
- **`CollegeSeeder`:** (Optional) Creates one demo college for testing.
- **`StudentSeeder`:** (Optional) Creates 10–20 test students tied to the demo college.
- **`DatabaseSeeder`:** Orchestrates the execution of all above seeders.

## Default Data Requirements
- Default system settings (e.g., active class status = false, default YouTube video ID = null).

## Indexing Recommendations
| Table | Indexed Columns | Rationale |
| :--- | :--- | :--- |
| `students` | `student_unique_id` | Fast login lookups. |
| `students` | `college_id` | Efficient filtering of students per college. |
| `attendance_logs` | `student_id`, `session_id` | Core tracking relationships. |
| `attendance_logs` | `join_time` | High-frequency date-based reporting. |
