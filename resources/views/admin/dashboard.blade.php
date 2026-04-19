@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1 class="page-title">Dashboard Overview</h1>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px;">
    <!-- Total Colleges -->
    <div class="card">
        <h3 style="font-size: 14px; color: var(--text-muted); margin-bottom: 8px;">Total Colleges</h3>
        <p style="font-size: 32px; font-weight: 700;">{{ $stats['total_colleges'] }}</p>
    </div>

    <!-- Total Students -->
    <div class="card">
        <h3 style="font-size: 14px; color: var(--text-muted); margin-bottom: 8px;">Total Students</h3>
        <p style="font-size: 32px; font-weight: 700;">{{ $stats['total_students'] }}</p>
    </div>

    <!-- Active Sessions -->
    <div class="card" style="border-left: 4px solid var(--success-color);">
        <h3 style="font-size: 14px; color: var(--text-muted); margin-bottom: 8px;">Active Live Sessions</h3>
        <p style="font-size: 32px; font-weight: 700; color: var(--success-color);">{{ $stats['active_sessions'] }}</p>
    </div>

    <!-- Active Viewers -->
    <div class="card" style="border-left: 4px solid #ef4444;">
        <h3 style="font-size: 14px; color: var(--text-muted); margin-bottom: 8px;">Active Viewers</h3>
        <p style="font-size: 32px; font-weight: 700; color: #ef4444;">{{ $stats['active_viewers'] }}</p>
    </div>
</div>

<div class="card" style="margin-top: 32px;">
    <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 16px;">Quick Actions</h3>
    <div style="display: flex; gap: 16px;">
        <a href="{{ route('admin.colleges.create') }}" class="btn btn-primary">Add New College</a>
        <a href="{{ route('admin.settings') }}" class="btn btn-outline">System Settings</a>
    </div>
</div>
@endsection
