@extends('layouts.college')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1 class="page-title">College Dashboard</h1>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px;">
    <!-- Total Students -->
    <div class="card">
        <h3 style="font-size: 14px; color: var(--text-muted); margin-bottom: 8px;">My Registered Students</h3>
        <p style="font-size: 32px; font-weight: 700;">{{ $stats['total_students'] }}</p>
    </div>

    <!-- Active Students -->
    <div class="card" style="border-left: 4px solid var(--success-color);">
        <h3 style="font-size: 14px; color: var(--text-muted); margin-bottom: 8px;">Students Currently in Class</h3>
        <p style="font-size: 32px; font-weight: 700; color: var(--success-color);">{{ $stats['active_students'] }}</p>
    </div>
</div>

<div class="card" style="margin-top: 32px;">
    <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 16px;">Student Management</h3>
    <div style="display: flex; gap: 16px;">
        <a href="{{ route('college.students.index') }}" class="btn btn-primary">View Student List</a>
        <a href="{{ route('college.students.create') }}" class="btn btn-outline">Add Single Student</a>
    </div>
</div>
@endsection
