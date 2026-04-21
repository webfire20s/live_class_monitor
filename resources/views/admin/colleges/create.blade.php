@extends('layouts.admin')

@section('title', 'Add New College')

@section('content')
<div class="page-header">
    <h1 class="page-title">Add New College</h1>
    <a href="{{ route('admin.colleges.index') }}" class="btn btn-outline">Back to List</a>
</div>

<div class="card" style="max-width: 600px;">
    <form method="POST" action="{{ route('admin.colleges.store') }}">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger" style="background-color: #fef2f2; color: #9b1c1c; border: 1px solid #fee2e2; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                <ul style="list-style: disc; margin-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="margin-bottom: 20px;">
            <label for="name" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">College Name</label>
            <input type="text" id="name" name="name" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;" value="{{ old('name') }}" required autofocus>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="college_code" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">College Code (Optional)</label>
            <input type="text" id="college_code" name="college_code" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;" value="{{ old('college_code') }}" placeholder="Leave blank to auto-generate">
            <p style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">If left blank, a code will be generated from the name.</p>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="username" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Login Username (Optional)</label>
            <input type="text" id="username" name="username" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;" value="{{ old('username') }}" placeholder="Leave blank to generate from email">
            <p style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">Used for college login. If blank, it will be generated from the email.</p>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="email" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Email Address</label>
            <input type="email" id="email" name="email" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;" value="{{ old('email') }}" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px;">
            <div>
                <label for="password" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Password</label>
                <input type="password" id="password" name="password" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;" required>
            </div>
            <div>
                <label for="password_confirmation" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px;">Create College</button>
    </form>
</div>
@endsection
