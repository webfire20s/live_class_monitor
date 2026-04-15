@extends('layouts.auth')

@section('title', 'College Login')

@section('content')
<div class="auth-header">
    <h2>College Login</h2>
    <p>Sign in to manage your students and view reports</p>
</div>

<form method="POST" action="{{ route('college.login') }}">
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
</form>
@endsection
