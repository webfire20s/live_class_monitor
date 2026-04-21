@extends('layouts.college')

@section('title', 'My Students')

@section('styles')
<style>
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .data-table th, .data-table td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
        font-size: 14px;
    }
    .data-table th {
        background-color: #f8fafc;
        font-weight: 600;
        color: var(--text-muted);
    }
    .actions {
        display: flex;
        gap: 8px;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">My Registered Students</h1>
    <div style="display: flex; gap: 12px;">
        <a href="{{ route('college.students.upload') }}" class="btn btn-outline">Bulk Upload (Excel)</a>
        <a href="{{ route('college.students.create') }}" class="btn btn-primary">Add Single Student</a>
    </div>
</div>

@if (session('import_failures'))
    <div class="card" style="margin-bottom: 24px; border-color: #fecaca; background-color: #fef2f2;">
        <h3 style="font-size: 14px; font-weight: 600; color: #991b1b; margin-bottom: 12px;">Import Failures</h3>
        <table style="width: 100%; font-size: 12px; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; border-bottom: 1px solid #fecaca;">
                    <th style="padding: 8px;">Row</th>
                    <th style="padding: 8px;">Attributes</th>
                    <th style="padding: 8px;">Errors</th>
                </tr>
            </thead>
            <tbody>
                @foreach (session('import_failures') as $failure)
                    <tr>
                        <td style="padding: 8px;">{{ $failure['row'] }}</td>
                        <td style="padding: 8px;"><code>{{ json_encode($failure['values']) }}</code></td>
                        <td style="padding: 8px; color: #991b1b;">{{ implode(', ', $failure['errors']) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<div class="card">
    <table class="data-table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Full Name</th>
                <!-- <th>Email Address</th> -->
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
            <tr>
                <td><code>{{ $student->student_unique_id }}</code></td>
                <td style="font-weight: 500;">{{ $student->name }}</td>
                <!-- <td>{{ $student->email }}</td> -->
                <td>
                    <span class="status-badge {{ $student->is_approved ? 'status-active' : 'status-inactive' }}" style="padding: 2px 8px; border-radius: 9999px; font-size: 12px; font-weight: 500; {{ $student->is_approved ? 'background-color: #def7ec; color: #03543f;' : 'background-color: #fde2e1; color: #9b1c1c;' }}">
                        {{ $student->is_approved ? 'Approved' : 'Pending' }}
                    </span>
                </td>
                <td class="actions">
                    @if(!$student->is_approved)
                        <form action="{{ route('college.students.approve', $student->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="padding: 4px 8px; font-size: 13px;">Approve</button>
                        </form>
                    @endif
                    <a href="{{ route('college.students.edit', $student->id) }}" class="btn btn-outline" style="padding: 4px 8px;">Edit</a>
                    <form action="{{ route('college.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline" style="padding: 4px 8px; color: var(--danger-color); border-color: #fee2e2;">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 32px;">No students registered yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
