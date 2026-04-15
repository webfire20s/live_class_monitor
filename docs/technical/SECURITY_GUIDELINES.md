# Security Guidelines

This document outlines the security strategy for protecting user data and ensuring the integrity of the tracking system.

## Authentication Security
- **Hashed Passwords:** Use Laravel's default `Bcrypt` or `Argon2` for all user passwords.
- **Role-Based Access Control (RBAC):** Strictly enforce role checks at the middleware level. No front-end only hiding of buttons; backend must check permissions for every request.

## Session & Token Security
- **Secure Sessions:** Use secure, HTTP-only cookies for session management.
- **CSRF Protection:** Laravel's standard CSRF middleware must be enabled for all POST/PUT/DELETE requests in the web browser.

## Student Login & Integrity
- **Unique Student IDs:** IDs must be complex enough to prevent simple brute-forcing of credentials.
- **Duplicate Login Prevention:**
  - Logic: When a student logs in, check if they have an active session in the `sessions` table (if using database driver) or flag their student record.
  - Action: Automatically invalidate the previous session or prevent the new login if an active session exists.
- **IP Sensitivity:** While tracking is IP-independent for students (to support shared networks), the system should log IP ranges for audit purposes to detect suspicious geographically disparate logins.

## API Protection Strategy
- **Signed Tracking Events:** Every tracking request (`join`, `exit`, `heartbeat`) must include a one-time session-bound CSRF token or a signed payload to prevent students from manually hitting endpoints via Postman/Curl.
- **Rate Limiting:** Implement strict rate limiting on the `heartbeat` endpoint to prevent DoS (Denial of Service) attacks.

## Admin Authorization Strategy
- **Multi-Factor Authentication (MFA):** (Future recommended) Add MFA for the Super Admin account.
- **Activity Logging:** Log all administrative actions (creating colleges, changing settings) in a `system_logs` table for audit trails.

## YouTube Embed Protection
- **Video Privacy:** The YouTube video should be set as "Unlisted".
- **Restricted Access:** The URL of the video is only rendered inside the student's authenticated session. The logic should prevent the IFrame source from being easily copied or shared outside the platform.
