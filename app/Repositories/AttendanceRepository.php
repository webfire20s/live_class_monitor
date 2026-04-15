<?php

namespace App\Repositories;

use App\Models\AttendanceLog;
use Carbon\Carbon;

class AttendanceRepository extends BaseRepository
{
    /**
     * AttendanceRepository constructor.
     *
     * @param AttendanceLog $model
     */
    public function __construct(AttendanceLog $model)
    {
        parent::__construct($model);
    }

    /**
     * Find an active log for a student and session.
     */
    public function findActiveLog(int $studentId, int $sessionId)
    {
        return $this->model->where('student_id', $studentId)
            ->where('session_id', $sessionId)
            ->whereNull('exit_time')
            ->orderBy('id', 'desc')
            ->first();
    }

    /**
     * Close all active logs for a student (for cleanup).
     */
    public function closeActiveLogs(int $studentId)
    {
        return $this->model->where('student_id', $studentId)
            ->whereNull('exit_time')
            ->update(['exit_time' => Carbon::now()]);
    }

    /**
     * Get filtered attendance logs.
     */
    public function getFilteredLogs(array $filters)
    {
        $query = $this->model->with(['student.college', 'session']);

        if (!empty($filters['college_id'])) {
            $query->whereHas('student', function($q) use ($filters) {
                $q->where('college_id', $filters['college_id']);
            });
        }

        if (!empty($filters['session_id'])) {
            $query->where('session_id', $filters['session_id']);
        }

        if (!empty($filters['start_date'])) {
            $query->whereDate('join_time', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->whereDate('join_time', '<=', $filters['end_date']);
        }

        return $query->orderBy('join_time', 'desc')->paginate(20);
    }
}
