# Database Planning (MySQL)

This document outlines the proposed schema for the Live Class Monitoring System using MySQL.

## Tables

### 1. `admins`
Stores Super Admin credentials and profile.
- `id` (INT, PK)
- `name` (VARCHAR)
- `email` (VARCHAR, Unique)
- `password` (VARCHAR, Hashed)
- `created_at`, `updated_at`

### 2. `colleges`
Stores institutional data.
- `id` (INT, PK)
- `name` (VARCHAR)
- `email` (VARCHAR, Unique)
- `password` (VARCHAR, Hashed)
- `phone` (VARCHAR)
- `address` (TEXT)
- `is_active` (BOOLEAN)
- `created_at`, `updated_at`

### 3. `students`
Stores student records tied to a specific college.
- `id` (INT, PK)
- `college_id` (INT, FK -> colleges.id)
- `student_unique_id` (VARCHAR, Unique - Used for login)
- `name` (VARCHAR)
- `password` (VARCHAR, Hashed)
- `phone` (VARCHAR, Nullable)
- `other_metadata` (JSON - optional extra fields)
- `created_at`, `updated_at`

### 4. `live_sessions` (Optional/Future)
If multiple classes are held, this table manages the sessions. For MVP, we can assume a single active global session.
- `id` (INT, PK)
- `title` (VARCHAR)
- `youtube_video_id` (VARCHAR)
- `start_time` (DATETIME)
- `end_time` (DATETIME)
- `status` (ENUM: active, inactive, completed)

### 5. `attendance_logs`
The core tracking table.
- `id` (BIGINT, PK)
- `student_id` (INT, FK -> students.id)
- `session_id` (INT, FK -> live_sessions.id)
- `join_time` (DATETIME)
- `exit_time` (DATETIME, Nullable)
- `ip_address` (VARCHAR) - For audit/logging only.
- `user_agent` (TEXT) - Device info.

---

## Relationships
- **College -> Students:** One-to-Many (A college has many students).
- **Student -> Attendance Logs:** One-to-Many (A student has many log entries).
- **Session -> Attendance Logs:** One-to-Many (A session tracks many log entries).

## Future Scalability Considerations
- **Indexing:** Ensure `student_unique_id`, `college_id`, and `join_time` are indexed for fast lookups.
- **Partitioning:** If the `attendance_logs` table grows very large (millions of records), consider date-based partitioning.
- **Redis Integration:** For the "Real-time Active Count", consider using Redis to store current active student IDs for sub-millisecond querying without hitting MySQL continuously.
