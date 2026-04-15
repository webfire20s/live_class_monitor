<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\LiveSession;
use App\Repositories\AttendanceRepository;
use App\Exports\AttendanceExport;
use Illuminate\Http\Request;
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
     * Display the global reports list.
     */
    public function index(Request $request)
    {
        $filters = array_merge([
            'college_id' => null,
            'session_id' => null,
            'start_date' => null,
            'end_date'   => null,
        ], $request->only(['college_id', 'session_id', 'start_date', 'end_date']));
        
        $logs = $this->attendanceRepository->getFilteredLogs($filters);
        $colleges = College::all();
        $sessions = LiveSession::orderBy('id', 'desc')->take(20)->get();

        return view('admin.reports.index', compact('logs', 'colleges', 'sessions', 'filters'));
    }

    /**
     * Export reports to Excel.
     */
    public function export(Request $request)
    {
        $filters = array_merge([
            'college_id' => null,
            'session_id' => null,
            'start_date' => null,
            'end_date'   => null,
        ], $request->only(['college_id', 'session_id', 'start_date', 'end_date']));
        
        return Excel::download(new AttendanceExport($filters), 'master_attendance_report.xlsx');
    }
}
