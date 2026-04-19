@extends('layouts.admin')

@section('title', 'System Settings')

@section('content')
<div class="page-header">
    <h1 class="page-title">System Settings</h1>
</div>

<div class="card" style="max-width: 600px;">
    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf

        <div style="margin-bottom: 24px;">
            <label for="current_youtube_video_id" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Current YouTube Video ID</label>
            <input type="text" id="current_youtube_video_id" name="current_youtube_video_id" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;" value="{{ old('current_youtube_video_id', $settings['current_youtube_video_id']) }}" placeholder="e.g. dQw4w9WgXcQ">
            <p style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">This ID will be used for the live class stream.</p>
            
            <div style="margin-top: 12px; padding: 12px; background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px;">
                <h4 style="font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #475569;">How to find your YouTube Video ID:</h4>
                <ul style="margin: 0; padding-left: 16px; font-size: 12px; color: #64748b; line-height: 1.5;">
                    <li>Go to your YouTube Live Stream or Video.</li>
                    <li>Look at the URL in your browser.</li>
                    <li>If the URL is <code>https://www.youtube.com/watch?v=<strong>dQw4w9WgXcQ</strong></code>, the ID is the bold part after <code>v=</code>.</li>
                    <li>If the URL is <code>https://youtu.be/<strong>dQw4w9WgXcQ</strong></code>, the ID is the part after the slash.</li>
                </ul>
            </div>
        </div>

        <div style="margin-bottom: 32px;">
            <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 12px;">Live Class Status</label>
            <div style="display: flex; gap: 24px;">
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input type="radio" name="active_class_status" value="true" {{ $settings['active_class_status'] ? 'checked' : '' }} style="margin-right: 8px;">
                    <span style="font-size: 14px;">Active (Show video to students)</span>
                </label>
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input type="radio" name="active_class_status" value="false" {{ !$settings['active_class_status'] ? 'checked' : '' }} style="margin-right: 8px;">
                    <span style="font-size: 14px;">Inactive (Hide video)</span>
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="padding: 12px 24px;">Save Settings</button>
    </form>
</div>

<div class="card" style="margin-top: 32px; background-color: #fefce8; border-color: #fef08a; max-width: 600px;">
    <h3 style="font-size: 14px; font-weight: 600; color: #854d0e; margin-bottom: 8px;">Important Note</h3>
    <p style="font-size: 13px; color: #854d0e;">Toggling the status to "Active" will instantly make the YouTube player visible on all authenticated student dashboards.</p>
</div>
@endsection
