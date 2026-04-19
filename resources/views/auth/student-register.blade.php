@extends('layouts.auth')

@section('title', 'Student Registration')
@section('container_class', 'wide')

@section('content')
<div class="auth-header">
    <h2>Student Registration</h2>
    <p>Create your student account to access live sessions. Approval from your college administrator is required.</p>
</div>

@if ($errors->any())
    <div class="alert-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('student.register.post') }}">
    @csrf

    <div class="form-group">
        <label for="college_id" class="form-label">Select Your College</label>
        <select id="college_id" name="college_id" class="form-control" required autofocus>
            <option value="" disabled selected>-- Choose your Institution --</option>
            @foreach($colleges as $college)
                <option value="{{ $college->id }}" {{ old('college_id') == $college->id ? 'selected' : '' }}>{{ $college->name }} ({{ $college->college_code }})</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required placeholder="e.g. John Doe">
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="father_name" class="form-label">Father's Name</label>
            <input type="text" id="father_name" name="father_name" class="form-control" value="{{ old('father_name') }}" required placeholder="e.g. Richard Doe">
        </div>
        <div class="form-group">
            <label for="mother_name" class="form-label">Mother's Name</label>
            <input type="text" id="mother_name" name="mother_name" class="form-control" value="{{ old('mother_name') }}" required placeholder="e.g. Jane Doe">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="class_name" class="form-label">Class / Grade</label>
            <input type="text" id="class_name" name="class_name" class="form-control" value="{{ old('class_name') }}" required placeholder="e.g. 10th Grade, Sec A">
        </div>
        <div class="form-group">
            <label for="student_unique_id" class="form-label">Student ID / Username</label>
            <input type="text" id="student_unique_id" name="student_unique_id" class="form-control" value="{{ old('student_unique_id') }}" required placeholder="e.g. STU-2026-001">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required placeholder="Min. 8 characters">
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="Repeat password">
        </div>
    </div>

    <button type="submit" class="btn-primary">Register as Student</button>

    <div class="auth-links">
        <p>Already registered? <a href="{{ route('student.login') }}">Sign In</a></p>
        <a href="{{ url('/') }}" class="back-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Return to Portal
        </a>
    </div>
</form>
@endsection
