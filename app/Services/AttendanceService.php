<?php

namespace App\Services;

use App\Repositories\AttendanceRepository;
use App\Models\LiveSession;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AttendanceService
{
    /**
     * The attendance repository instance.
     *
     * @var AttendanceRepository
     */
    protected $attendanceRepository;

    /**
     * AttendanceService constructor.
     *
     * @param AttendanceRepository $attendanceRepository
     */
    public function __construct(AttendanceRepository $attendanceRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
    }

    /**
     * Log a student's entry into a live session.
     */
    public function logEntry(int $studentId)
    {
        $session = LiveSession::where('is_active', true)->latest()->first();
        
        if (!$session) {
            return null;
        }

        // Check if there is already an active log for this student/session
        $existingLog = $this->attendanceRepository->findActiveLog($studentId, $session->id);
        
        if ($existingLog) {
            // Update timestamp to show activity
            $existingLog->touch();
            return $existingLog;
        }

        // Create new log entry
        return $this->attendanceRepository->create([
            'student_id' => $studentId,
            'session_id' => $session->id,
            'join_time'  => Carbon::now(),
        ]);
    }

    /**
     * Log a student's heartbeat (keeping the session alive).
     */
    public function logHeartbeat(int $studentId)
    {
        $session = LiveSession::where('is_active', true)->latest()->first();
        
        if (!$session) {
            return false;
        }

        $log = $this->attendanceRepository->findActiveLog($studentId, $session->id);
        
        if ($log) {
            $log->touch(); // Updated_at tracks the last heartbeat
            return true;
        }

        // If no active log found but session is active, maybe tab was refreshed
        return $this->logEntry($studentId);
    }

    /**
     * Log a student's exit from a session.
     */
    public function logExit(int $studentId)
    {
        $session = LiveSession::where('is_active', true)->latest()->first();
        
        if (!$session) {
            // If session is ended globally, just close all open logs for this student
            return $this->attendanceRepository->closeActiveLogs($studentId);
        }

        $log = $this->attendanceRepository->findActiveLog($studentId, $session->id);
        
        if ($log) {
            $exitTime = Carbon::now();
            $joinTime = $log->join_time;
            $durationTotal = $joinTime->diffInMinutes($exitTime);

            return $log->update([
                'exit_time'        => $exitTime,
                'duration_minutes' => $durationTotal,
            ]);
        }

        return false;
    }
}
