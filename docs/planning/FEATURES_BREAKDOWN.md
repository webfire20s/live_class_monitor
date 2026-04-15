# Features Breakdown

This document outlines the features and functional modules of the Live Class Monitoring System, categorized by user role and priority.

## Mandatory Features (MVP)

### 1. Super Admin Module (Priority: High)
- **Dashboard:** Overview of total colleges, total students, and real-time active student counts.
- **College Management:** CRUD operations for college entities (Name, Contact, Location).
- **Global Reports:** Access to attendance reports across all colleges.
- **System Settings:** Manage global parameters and configuration.

### 2. College Admin Module (Priority: High)
- **Student Management:** Bulk upload students via Excel (Fields: Name, unique ID, Password).
- **Student ID Generation:** Automatically generate or manage credentials.
- **College Dashboard:** View stats specific to their students and active participation.
- **Attendance Reports:** Downloadable (PDF/Excel) reports filtered by date and student.

### 3. Student Module (Priority: High)
- **Secure Login:** Access restricted to unique ID and password.
- **Student Dashboard:** View scheduled/live class status.
- **Live Class Interface:** Embedded YouTube player.
- **Automated Tracking:** System automatically logs entry (on join) and exit (on logout/tab close).

### 4. Core Tracking System (Priority: High)
- **Entry/Exit Logging:** Precise timestamping of when a student joins and leaves.
- **IP Independence:** Usage of session tokens instead of IP-based tracking to handle NAT/Shared campus networks.
- **Concurrent Session Handling:** Manage 2500+ active sessions efficiently.

---

## Optional Features

### 1. Enhanced Security (Priority: Medium)
- **Single Device Login:** Prevent one set of credentials from being used on multiple devices simultaneously.
- **Session Timeout:** Automatically logout inactive users.

### 2. Notifications (Priority: Low)
- **SMS/Email Alerts:** Notify students of upcoming live classes.
- **Bulk Messaging:** Send announcements from Super Admin or College Admin.

### 3. UI/UX Customization (Priority: Medium)
- **Custom Branding:** Ability for colleges to have their own logo/colors on their dashboard.
- **Mobile Responsiveness:** Optimized views for smartphones and tablets.

---

## Future Enhancements
- **Multi-Class Handling:** Ability to run different live streams for different branches/years within the same college.
- **Activity Polling:** Simple "Are you watching?" popups to confirm student presence.
- **Automated Attendance Summary:** Weekly automated emails to college admins with attendance trends.
- **Advanced Analytics:** Heatmaps of student join times and dropout rates.
