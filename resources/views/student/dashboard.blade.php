@extends('layouts.student')

@section('title', 'Ready to Learn')

@section('styles')
<style>
    .video-container {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
        height: 0;
        overflow: hidden;
        border-radius: 12px;
        background-color: #000;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
    .empty-state {
        text-align: center;
        padding: 80px 40px;
        background-color: #ffffff;
        border-radius: 12px;
        border: 2px dashed var(--border-color);
    }
    .empty-state h2 {
        font-size: 20px;
        color: var(--text-main);
        margin-bottom: 12px;
    }
    .empty-state p {
        color: var(--text-muted);
        font-size: 14px;
        max-width: 400px;
        margin: 0 auto;
    }
    .profile-summary {
        margin-top: 32px;
        display: flex;
        gap: 20px;
    }
    .info-tag {
        font-size: 12px;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 9999px;
        background-color: var(--bg-color);
        color: var(--primary-color);
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">Live Class Session</h1>
</div>

@if($sessionData['is_active'] && !empty($sessionData['video_id']))
    <div class="video-container">
        <iframe 
            src="https://www.youtube.com/embed/{{ $sessionData['video_id'] }}?autoplay=1&rel=0" 
            title="Live Stream" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
            allowfullscreen>
        </iframe>
    </div>
@else
    <div class="empty-state">
        <div style="font-size: 48px; margin-bottom: 20px;">📺</div>
        <h2>No Active Session</h2>
        <p>There is currently no live class being broadcasted. Please wait for your instructor to start the session.</p>
    </div>
@endif

<div class="profile-summary">
    <div class="card" style="flex: 1;">
        <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">My Profile</h3>
        <p style="font-size: 14px; margin-bottom: 12px;"><strong>Name:</strong> {{ $student->name }}</p>
        <p style="font-size: 14px; margin-bottom: 12px;"><strong>Student ID:</strong> {{ $student->student_unique_id }}</p>
        <div style="display: flex; gap: 8px;">
            <span class="info-tag">{{ $student->college->name }}</span>
            <span class="info-tag">Status: Registered</span>
        </div>
    </div>
    
    <div class="card" style="width: 300px; background-color: #6366f1; color: #ffffff;">
        <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 12px;">Need Help?</h3>
        <p style="font-size: 13px; line-height: 1.5; opacity: 0.9;">If you're having trouble viewing the video, please refresh your page or contact your college administrator.</p>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Configuration
    const JOIN_URL = "{{ route('student.attendance.join') }}";
    const HEARTBEAT_URL = "{{ route('student.attendance.heartbeat') }}";
    const EXIT_URL = "{{ route('student.attendance.exit') }}";
    const CSRF_TOKEN = "{{ csrf_token() }}";

    // Attendance Watcher Class
    class AttendanceWatcher {
        constructor() {
            this.interval = null;
            this.init();
        }

        async init() {
            // 1. Log Entry
            await this.post(JOIN_URL);

            // 2. Start Heartbeat (every 2 minutes)
            this.interval = setInterval(() => this.post(HEARTBEAT_URL), 120000);

            // 3. Setup Exit Handlers (Beacon API)
            window.addEventListener('beforeunload', () => {
                const formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                navigator.sendBeacon(EXIT_URL, formData);
            });
        }

        async post(url) {
            try {
                await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({})
                });
            } catch (err) {
                console.error('Attendance Error:', err);
            }
        }
    }

    // Activate if session is active
    @if($sessionData['is_active'])
        document.addEventListener('DOMContentLoaded', () => {
            new AttendanceWatcher();
        });
    @endif
</script>
@endsection
