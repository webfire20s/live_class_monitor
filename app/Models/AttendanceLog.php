<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendanceLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'session_id',
        'join_time',
        'exit_time',
        'duration_minutes',
    ];

    protected $casts = [
        'join_time' => 'datetime',
        'exit_time' => 'datetime',
    ];

    /**
     * Get the student associated with the log.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the session associated with the log.
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(LiveSession::class);
    }
}
