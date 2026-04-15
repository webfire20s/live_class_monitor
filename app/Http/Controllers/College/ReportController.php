<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\LiveSession;
use App\Repositories\AttendanceRepository;
use App\Exports\AttendanceExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * @var AttendanceRepository
     */
    protected $attendanceRepository;

    public function __construct(AttendanceRepository $attendanceRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
    }

    /**
     * Display the college-specific reports.
     */
    public function index(Request $request)
    {
        $collegeId = Auth::guard('college')->id();

        $filters = array_merge([
            'session_id' => null,
            'start_date' => null,
            'end_date'   => null,
        ], $request->only(['session_id', 'start_date', 'end_date']));
        
        $filters['college_id'] = $collegeId; // Ensure strict isolation
        
        $logs = $this->attendanceRepository->getFilteredLogs($filters);
        $sessions = LiveSession::orderBy('id', 'desc')->take(20)->get();

        return view('college.reports.index', compact('logs', 'sessions', 'filters'));
    }

    /**
     * Export college-specific reports to Excel.
     */
    public function export(Request $request)
    {
        $collegeId = Auth::guard('college')->id();
        
        $filters = array_merge([
            'session_id' => null,
            'start_date' => null,
            'end_date'   => null,
        ], $request->only(['session_id', 'start_date', 'end_date']));
        
        $filters['college_id'] = $collegeId; // Ensure strict isolation
        
        return Excel::download(new AttendanceExport($filters), 'college_attendance_report.xlsx');
    }
}
