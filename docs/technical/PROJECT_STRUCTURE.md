# Project Structure

The project follows a modular Laravel organization, emphasizing separation of concerns via the **Service-Repository** pattern.

## Directory Layout

### Backend (`/app`)
- **`Http/Controllers`**: Thin controllers that delegate to Services.
  - `Admin/`: Super Admin panel controllers.
  - `College/`: College panel controllers.
  - `Student/`: Student panel/dashboard controllers.
- **`Http/Middleware`**:
  - `RoleMiddleware.php`: Handles multi-role redirection.
  - `EnsureSingleSession.php`: Prevents duplicate logins.
- **`Services`**: Contains business logic.
  - `AttendanceService.php`: Logic for entry/exit/heartbeat.
  - `ExcelImportService.php`: Logic for Maatwebsite Excel processing.
- **`Repositories`**: Pure Eloquent queries.
  - `StudentRepository.php`
  - `CollegeRepository.php`
- **`Models`**: Eloquent models with defined relationships.

### Database (`/database`)
- **`migrations/`**: Ordered schema files.
- **`seeders/`**: Initial Super Admin and test college data.
- **`factories/`**: For generating test student/attendance data.

### Frontend (`/resources`)
- **`views/`**:
  - `layouts/`: Shared layouts for admin/college/student.
  - `components/`: Reusable UI elements (cards, buttons, alerts).
  - `pages/`: Individual view files organized by role.
- **`js/`**:
  - `tracking.js`: Client-side logic for YouTube API and Heartbeats.
- **`css/`**: Tailwind CSS configuration.

---

## Service-Repository Pattern
The workflow for a typical feature (e.g., Joining a class):
1. **Route** -> `StudentController@joinClass`
2. **Controller** -> Calls `AttendanceService->logJoinEvent($studentId)`
3. **Service** -> Validates student status, calls `AttendanceRepository->createLog(...)`.
4. **Repository** -> Executes `Attendance::create(...)`.

## Helper/Utility Organization
- **`app/Helpers`**: Custom PHP helper functions (e.g., date formatting, unique ID generation).
- **`app/Traits`**: Shared attributes like `HasUUID` or `LogsActivity`.

## Frontend Asset Organization
- Use **Vite** for asset bundling.
- Components should be modularized in `resources/js/components`.
- Shared CSS variables/themes should reside in `resources/css/app.css`.
