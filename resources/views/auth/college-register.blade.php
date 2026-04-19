@extends('layouts.auth')

@section('title', 'College Registration')
@section('container_class', 'wide')

@section('content')
<div class="auth-header">
    <h2>College Registration</h2>
    <p>Register your institution for the Live Class Monitor platform. Your account will require administrator approval.</p>
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

<form method="POST" action="{{ route('college.register.post') }}">
    @csrf

    <div class="form-row">
        <div class="form-group">
            <label for="name" class="form-label">College Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus placeholder="e.g. Oxford University">
        </div>
        <div class="form-group">
            <label for="college_code" class="form-label">College Code</label>
            <input type="text" id="college_code" name="college_code" class="form-control" value="{{ old('college_code') }}" required placeholder="e.g. OXF-001">
        </div>
    </div>

    <div class="form-group">
        <label for="address" class="form-label">Complete Address</label>
        <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}" required placeholder="e.g. 123 University Blvd">
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" id="contact_number" name="contact_number" class="form-control" value="{{ old('contact_number') }}" required placeholder="+1 234 567 8900">
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="admin@college.edu">
        </div>
    </div>

    <div class="form-group">
        <label for="username" class="form-label">Administrator Username</label>
        <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" required placeholder="Choose a username">
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

    <button type="submit" class="btn-primary">Register Institution</button>

    <div class="auth-links">
        <p>Already registered? <a href="{{ route('college.login') }}">Sign In</a></p>
        <a href="{{ url('/') }}" class="back-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Return to Portal
        </a>
    </div>
</form>
@endsection
