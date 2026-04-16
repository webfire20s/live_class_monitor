<?php

namespace App\Services;

use App\Models\LiveSession;
use Carbon\Carbon;

class LiveSessionService
{
    /**
     * Start a new live session if one isn't already active.
     */
    public function startNewSession(int $adminId, string $youtubeVideoId)
    {
        $activeSession = LiveSession::where('is_active', true)->first();
        
        if ($activeSession) {
            return $activeSession;
        }

        return LiveSession::create([
            'admin_id'         => $adminId,
            'title'            => 'Live Class Session - ' . Carbon::now()->format('Y-M-d H:i'),
            'youtube_video_id' => $youtubeVideoId,
            'is_active'        => true,
            'scheduled_at'     => Carbon::now(),
        ]);
    }

    /**
     * Close all active sessions and their associated logs.
     */
    public function closeActiveSessions()
    {
        $now = Carbon::now();
        
        // Find active sessions
        $activeSessionIds = LiveSession::where('is_active', true)->pluck('id');

        if ($activeSessionIds->isEmpty()) {
            return 0;
        }

        // Close all open logs for these sessions
        \App\Models\AttendanceLog::whereIn('session_id', $activeSessionIds)
            ->whereNull('exit_time')
            ->each(function($log) use ($now) {
                $duration = $log->join_time->diffInMinutes($now);
                $log->update([
                    'exit_time' => $now,
                    'duration_minutes' => $duration
                ]);
            });

        // Close sessions
        return LiveSession::whereIn('id', $activeSessionIds)->update([
            'is_active' => false,
            'ended_at' => $now,
        ]);
    }
}
