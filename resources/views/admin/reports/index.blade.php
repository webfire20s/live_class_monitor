@extends('layouts.admin')

@section('title', 'Attendance Reports')

@section('styles')
<style>
    .filter-bar {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        margin-bottom: 24px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        align-items: end;
    }
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    .data-table th, .data-table td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
        font-size: 13px;
    }
    .data-table th {
        background-color: #f9fafb;
        font-weight: 600;
        color: var(--text-muted);
    }
    .pagination-container {
        margin-top: 24px;
        display: flex;
        justify-content: center;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">Attendance Monitoring</h1>
    <form action="{{ route('admin.reports.export') }}" method="GET">
        @foreach($filters as $key => $value)
            @if($value) <input type="hidden" name="{{ $key }}" value="{{ $value }}"> @endif
        @endforeach
        <button type="submit" class="btn btn-primary">Export to Excel</button>
    </form>
</div>

<div class="card">
    <form action="{{ route('admin.reports') }}" method="GET" class="filter-bar">
        <div>
            <label style="display: block; font-size: 12px; font-weight: 600; margin-bottom: 6px;">College</label>
            <select name="college_id" style="width: 100%; padding: 8px; border: 1px solid var(--border-color); border-radius: 6px;">
                <option value="">All Colleges</option>
                @foreach($colleges as $college)
                    <option value="{{ $college->id }}" {{ $filters['college_id'] == $college->id ? 'selected' : '' }}>{{ $college->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label style="display: block; font-size: 12px; font-weight: 600; margin-bottom: 6px;">Session</label>
            <select name="session_id" style="width: 100%; padding: 8px; border: 1px solid var(--border-color); border-radius: 6px;">
                <option value="">All Sessions</option>
                @foreach($sessions as $session)
                    <option value="{{ $session->id }}" {{ $filters['session_id'] == $session->id ? 'selected' : '' }}>Session #{{ $session->id }} ({{ $session->created_at->format('M d') }})</option>
                @endforeach
            </select>
        </div>
        <div>
            <label style="display: block; font-size: 12px; font-weight: 600; margin-bottom: 6px;">Start Date</label>
            <input type="date" name="start_date" value="{{ $filters['start_date'] ?? '' }}" style="width: 100%; padding: 8px; border: 1px solid var(--border-color); border-radius: 6px;">
        </div>
        <div>
            <label style="display: block; font-size: 12px; font-weight: 600; margin-bottom: 6px;">End Date</label>
            <input type="date" name="end_date" value="{{ $filters['end_date'] ?? '' }}" style="width: 100%; padding: 8px; border: 1px solid var(--border-color); border-radius: 6px;">
        </div>
        <div>
            <button type="submit" class="btn btn-outline" style="width: 100%;">Apply Filters</button>
        </div>
    </form>

    <div style="overflow-x: auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <th>College</th>
                    <th>Join Time</th>
                    <th>Exit Time</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td style="font-weight: 600;">{{ $log->student->name }}</td>
                    <td><code>{{ $log->student->student_unique_id }}</code></td>
                    <td>{{ $log->student->college->name }}</td>
                    <td>{{ $log->join_time->format('M d, H:i') }}</td>
                    <td>{{ $log->exit_time ? $log->exit_time->format('H:i') : 'Active' }}</td>
                    <td>
                        @if($log->duration_minutes)
                            {{ $log->duration_minutes }} min
                        @else
                            <span style="color: var(--success-color); font-weight: 600;">Live</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-muted);">No logs matching the filters.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        {{ $logs->links() }}
    </div>
</div>
@endsection
