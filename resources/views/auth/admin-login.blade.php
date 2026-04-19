@extends('layouts.auth')

@section('title', 'Admin Login')

@section('content')
<div class="auth-header">
    <h2>Admin Login</h2>
    <p>Sign in to access the super admin dashboard</p>
</div>

<form method="POST" action="{{ route('admin.login') }}">
    @csrf

    @if ($errors->any())
        <div class="alert-error">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="form-group">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
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
        <a href="{{ url('/') }}" class="back-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Return to Portal
        </a>
    </div>
</form>
@endsection
