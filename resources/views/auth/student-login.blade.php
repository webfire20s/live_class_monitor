@extends('layouts.auth')

@section('title', 'Student Login')

@section('content')
<div class="auth-header">
    <h2>Student Login</h2>
    <p>Sign in to join your live class sessions</p>
</div>

<form method="POST" action="{{ route('student.login') }}">
    @csrf

    @if ($errors->any())
        <div class="alert-error">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="form-group">
        <label for="student_unique_id" class="form-label">Student ID / Unique Identifier</label>
        <input type="text" id="student_unique_id" name="student_unique_id" class="form-control" value="{{ old('student_unique_id') }}" required autofocus placeholder="Enter your unique ID">
    </div>

    <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" required>
    </div>

    <div class="form-footer">
        <label class="remember-me">
            <input type="checkbox" name="remember">
            <span>Remember me</span>
        </label>
    </div>

    <button type="submit" class="btn-primary">
        Sign In
    </button>
    
    <div class="auth-links">
        <p>Don't have an account? <a href="{{ route('student.register') }}">Register Now</a></p>
        <a href="{{ url('/') }}" class="back-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Return to Portal
        </a>
    </div>
</form>
@endsection
