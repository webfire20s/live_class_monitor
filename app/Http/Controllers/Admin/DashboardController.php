<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\Student;
use App\Models\LiveSession;
use App\Models\AttendanceLog;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'total_colleges' => College::count(),
            'total_students' => Student::count(),
            'active_sessions' => LiveSession::where('is_active', true)->count(),
            'active_viewers' => AttendanceLog::whereNotNull('join_time')->whereNull('exit_time')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
