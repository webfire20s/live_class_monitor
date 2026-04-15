# Development Standards

This document establishes the coding conventions and quality standards for the Live Class Monitoring System project.

## Coding Conventions
- **PHP:** Follow **PSR-12** Coding Style Guide.
- **JavaScript:** Follow **ESLint** airbnb-base configuration.
- **CSS:** Use **Tailwind CSS** utility classes; avoid custom CSS unless necessary.

## Naming Standards
- **Variables/Functions:** `camelCase` (e.g., `$studentId`, `getAttendance()`).
- **Classes/Models:** `PascalCase` (e.g., `AttendanceLog`, `StudentService`).
- **Database Tables/Columns:** `snake_case` (e.g., `attendance_logs`, `join_time`).
- **Routes:** `kebab-case` (e.g., `/admin/college-management`).

## API Response Format
All internal API responses must follow a consistent JSON structure:
```json
{
    "status": "success",
    "message": "Human readable message",
    "data": { ... },
    "errors": null
}
```
Error codes should follow standard HTTP status codes:
- `200`: Success
- `201`: Created
- `400`: Bad Request (Validation failed)
- `401`: Unauthorized
- `403`: Forbidden
- `500`: Server Error

## Validation & Error Handling
- **Backend Validation:** Always use **FormRequests** for validating incoming data.
- **Error Handling:** Use a global Exception Handler to catch errors and return the standard JSON format.
- **Logging:** Log critical errors or security events using Laravel's `Log` facade with appropriate levels (`error`, `warning`, `info`).

## Git Commit Conventions
Follow **Conventional Commits** for commit messages:
- `feat:` for new features.
- `fix:` for bug fixes.
- `docs:` for documentation updates.
- `refactor:` for code restructuring.
- `style:` for formatting changes.

*Example:* `feat: implement student bulk upload via excel`

## Documentation & Commenting
- **Docblocks:** Each class and method should have a short summary and `@param`/`@return` tags.
- **Inline Comments:** Use sparingly to explain "why" something is done, not "what" the code is doing.
- **Self-Documenting Code:** Prioritize expressive variable and method names over comments.
