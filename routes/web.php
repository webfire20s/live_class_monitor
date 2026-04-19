<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\CollegeLoginController;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CollegeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Auth Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login']);
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::post('colleges/{id}/approve', [CollegeController::class, 'approve'])->name('colleges.approve');
        Route::resource('colleges', CollegeController::class)->except(['show']);
        
        Route::get('settings', [SettingController::class, 'index'])->name('settings');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

        Route::get('reports', [AdminReportController::class, 'index'])->name('reports');
        Route::get('reports/export', [AdminReportController::class, 'export'])->name('reports.export');
    });
});

use App\Http\Controllers\College\DashboardController as CollegeDashboardController;
use App\Http\Controllers\College\StudentController;
use App\Http\Controllers\College\ReportController as CollegeReportController;
use App\Http\Controllers\Auth\CollegeRegisterController;

// College Auth Routes
Route::prefix('college')->name('college.')->group(function () {
    Route::get('login', [CollegeLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [CollegeLoginController::class, 'login']);
    Route::post('logout', [CollegeLoginController::class, 'logout'])->name('logout');
    
    Route::get('register', [CollegeRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [CollegeRegisterController::class, 'register'])->name('register.post');

    Route::middleware(['role:college'])->group(function () {
        Route::get('dashboard', [CollegeDashboardController::class, 'index'])->name('dashboard');
        
        Route::get('students/upload', [StudentController::class, 'showUploadForm'])->name('students.upload');
        Route::post('students/upload', [StudentController::class, 'import']);
        Route::post('students/{id}/approve', [StudentController::class, 'approve'])->name('students.approve');
        Route::resource('students', StudentController::class)->except(['show']);

        Route::get('reports', [CollegeReportController::class, 'index'])->name('reports');
        Route::get('reports/export', [CollegeReportController::class, 'export'])->name('reports.export');
    });
});

use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\AttendanceController;
use App\Http\Controllers\Auth\StudentRegisterController;

// Student Auth Routes
Route::prefix('student')->name('student.')->group(function () {
    Route::get('login', [StudentLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [StudentLoginController::class, 'login']);
    Route::post('logout', [StudentLoginController::class, 'logout'])->name('logout');
    
    Route::get('register', [StudentRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [StudentRegisterController::class, 'register'])->name('register.post');

    Route::middleware(['role:student'])->group(function () {
        Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        
        // Attendance API
        Route::post('attendance/join', [AttendanceController::class, 'join'])->name('attendance.join');
        Route::post('attendance/heartbeat', [AttendanceController::class, 'heartbeat'])->name('attendance.heartbeat');
        Route::post('attendance/exit', [AttendanceController::class, 'exit'])->name('attendance.exit');
    });
});
