# API Structure (Laravel)

This document suggests the internal API structures for the Live Class Monitoring System panels.

## Authentication APIs
| Endpoint | Method | Description |
| :--- | :--- | :--- |
| `/api/login` | POST | General login for all users. |
| `/api/logout` | POST | Destroy session and log exit time. |
| `/api/user` | GET | Current logged-in user profile. |

## Admin APIs (Super Admin)
| Endpoint | Method | Description |
| :--- | :--- | :--- |
| `/api/admin/colleges` | GET | List all colleges with stats. |
| `/api/admin/colleges` | POST | Create a new college. |
| `/api/admin/reports/summary` | GET | Get aggregate attendance stats. |
| `/api/admin/settings` | PATCH | Update global system settings. |

## College APIs
| Endpoint | Method | Description |
| :--- | :--- | :--- |
| `/api/college/students` | GET | List students of the logged-in college. |
| `/api/college/students/upload` | POST | Bulk upload students via Excel. |
| `/api/college/reports/attendance` | GET | Fetch attendance logs with filters. |

## Tracking APIs (Student)
| Endpoint | Method | Description |
| :--- | :--- | :--- |
| `/api/student/join-class` | POST | Log the entry event when joining class. |
| `/api/student/heartbeat` | POST | (Optional) Periodic ping to verify student is still active. |
| `/api/student/exit-class` | POST | Log the exit event when manually leaving. |

## Report APIs
| Endpoint | Method | Description |
| :--- | :--- | :--- |
| `/api/reports/download/pdf` | GET | Generate and download PDF report. |
| `/api/reports/download/excel` | GET | Generate and download Excel report. |

---

## Technical Notes
- **Middleware:** Use `auth:sanctum` or standard Laravel Session middleware.
- **Roles:** Use a Custom Middleware or Spatie Permissions to restrict access to `/admin` and `/college` routes.
- **Rate Limiting:** Implement rate limiting on the `/api/student/heartbeat` endpoint to handle high concurrency.
