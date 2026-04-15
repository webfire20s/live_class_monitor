<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LiveSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'title',
        'youtube_video_id',
        'is_active',
        'scheduled_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'scheduled_at' => 'datetime',
    ];

    /**
     * Get the admin that created the session.
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the attendance logs for the session.
     */
    public function attendanceLogs(): HasMany
    {
        return $this->hasMany(AttendanceLog::class);
    }
}
