@extends('layouts.college')

@section('title', 'Add Student')

@section('content')
<div class="page-header">
    <h1 class="page-title">Add New Student</h1>
    <a href="{{ route('college.students.index') }}" class="btn btn-outline">Back to List</a>
</div>

<div class="card" style="max-width: 600px;">
    <form method="POST" action="{{ route('college.students.store') }}">
        @csrf

        @if ($errors->any())
            <div class="alert" style="background-color: #fef2f2; color: #9b1c1c; border: 1px solid #fee2e2; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                <ul style="list-style: disc; margin-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="margin-bottom: 20px;">
            <label for="student_unique_id" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Student ID / Unique Identifier</label>
            <input type="text" id="student_unique_id" name="student_unique_id" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;" value="{{ old('student_unique_id', $suggestedId) }}" required autofocus placeholder="e.g. STU12345">
            <p style="font-size: 12px; color: var(--text-muted); margin-top: 4px;"><strong>Auto-suggested based on college sequence.</strong> This will also be the default password if not specified.</p>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="name" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Full Name</label>
            <input type="text" id="name" name="name" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;" value="{{ old('name') }}" required>
        </div>

        <!-- <div style="margin-bottom: 20px;">
            <label for="email" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Email Address (Optional)</label>
            <input type="email" id="email" name="email" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;" value="{{ old('email') }}">
        </div> -->

        <div style="margin-bottom: 20px;">
            <label for="phone" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Phone Number (Optional)</label>
            <input type="text" id="phone" name="phone" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;" value="{{ old('phone') }}">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px;">
            <div>
                <label for="password" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Password (Optional)</label>
                <input type="password" id="password" name="password" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;">
            </div>
            <div>
                <label for="password_confirmation" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;">
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px;">Add Student</button>
    </form>
</div>
@endsection
