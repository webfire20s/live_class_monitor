<?php

namespace App\Exports;

use App\Models\AttendanceLog;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class AttendanceExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = AttendanceLog::with(['student.college', 'session']);

        if (!empty($this->filters['college_id'])) {
            $query->whereHas('student', function($q) {
                $q->where('college_id', $this->filters['college_id']);
            });
        }

        if (!empty($this->filters['session_id'])) {
            $query->where('session_id', $this->filters['session_id']);
        }

        if (!empty($this->filters['start_date'])) {
            $query->whereDate('join_time', '>=', $this->filters['start_date']);
        }

        if (!empty($this->filters['end_date'])) {
            $query->whereDate('join_time', '<=', $this->filters['end_date']);
        }

        return $query->orderBy('join_time', 'desc');
    }

    public function headings(): array
    {
        return [
            'Student Name',
            'Student ID',
            'College',
            'Session ID',
            'Join Time',
            'Exit Time',
            'Duration (Min)',
        ];
    }

    public function map($log): array
    {
        return [
            $log->student->name,
            $log->student->student_unique_id,
            $log->student->college->name,
            $log->session_id,
            $log->join_time->format('Y-m-d H:i:s'),
            $log->exit_time ? $log->exit_time->format('Y-m-d H:i:s') : 'N/A',
            $log->duration_minutes ?? 0,
        ];
    }
}
