<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\AttendanceLog;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the college dashboard.
     */
    public function index()
    {
        $collegeId = Auth::guard('college')->id();

        $stats = [
            'total_students' => Student::where('college_id', $collegeId)->count(),
            'active_students' => AttendanceLog::whereHas('student', function($query) use ($collegeId) {
                $query->where('college_id', $collegeId);
            })->whereNull('exit_time')->count(),
        ];

        return view('college.dashboard', compact('stats'));
    }
}
