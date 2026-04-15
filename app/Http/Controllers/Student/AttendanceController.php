<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\AttendanceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * The attendance service instance.
     *
     * @var AttendanceService
     */
    protected $attendanceService;

    /**
     * AttendanceController constructor.
     *
     * @param AttendanceService $attendanceService
     */
    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    /**
     * Record student joining the live session.
     */
    public function join()
    {
        $studentId = Auth::guard('student')->id();
        $this->attendanceService->logEntry($studentId);

        return response()->json(['status' => 'success', 'message' => 'Join recorded']);
    }

    /**
     * Record student heartbeat to keep the session alive.
     */
    public function heartbeat()
    {
        $studentId = Auth::guard('student')->id();
        $this->attendanceService->logHeartbeat($studentId);

        return response()->json(['status' => 'success', 'message' => 'Heartbeat updated']);
    }

    /**
     * Record student exiting the live session.
     */
    public function exit()
    {
        $studentId = Auth::guard('student')->id();
        $this->attendanceService->logExit($studentId);

        return response()->json(['status' => 'success', 'message' => 'Exit recorded']);
    }
}
