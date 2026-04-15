# Implementation Order

This document defines the exact step-by-step development roadmap for coding the Live Class Monitoring System.

1.  **Laravel Setup**
    - Install Laravel framework.
    - Setup `.env` and database connection.
    - Install necessary packages (e.g., `maatwebsite/excel`).

2.  **Database Migrations**
    - Create and run migrations according to `MIGRATION_PLAN.md`.

3.  **Roles & Permissions (Auth Module)**
    - Setup Authentication Guards for `admin`, `college`, and `student`.
    - Create Login controllers and views.
    - Implement the `RoleMiddleware`.

4.  **Super Admin Panel**
    - Create the core dashboard view.
    - Implement College Management (Add/Edit/List).
    - Implement Global Settings (Setting the YouTube Video ID).

5.  **College Management Panel**
    - Create the college-specific dashboard.
    - Implement Student Management UI.

6.  **Student Management (Bulk Upload)**
    - Implement the Excel import service.
    - Add validation and error reporting for bulk uploads.

7.  **Live Class Module**
    - Create the student dashboard.
    - Implement the YouTube IFrame player integration.
    - Toggle visibility based on the active class setting.

8.  **Tracking & Attendance APIs**
    - Create the `join-class`, `heartbeat`, and `exit-class` endpoints.
    - Implement client-side JS triggers (`tracking.js`).

9.  **Reporting Dashboard**
    - Build UI filters for date and college in the admin panels.
    - Generate on-screen attendance tables.

10. **Exports (PDF/Excel)**
    - Integrate `dompdf` or similar for PDF exports.
    - Finalize Excel export formatting.

11. **Testing**
    - Unit tests for Services (Attendance/Excel).
    - Manual UI testing across mobile/tablet/desktop.

12. **Deployment Prep**
    - Environment hardening.
    - Final security audit.
    - Production deployment.
