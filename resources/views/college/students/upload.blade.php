@extends('layouts.college')

@section('title', 'Bulk Upload Students')

@section('content')
<div class="page-header">
    <h1 class="page-title">Bulk Upload Students</h1>
    <a href="{{ route('college.students.index') }}" class="btn btn-outline">Back to List</a>
</div>

<div class="card" style="max-width: 600px;">
    <div style="margin-bottom: 24px;">
        <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 12px;">Instructions</h3>
        <ul style="font-size: 14px; color: var(--text-muted); line-height: 1.6; list-style: disc; margin-left: 20px;">
            <li>Upload an Excel (`.xlsx`, `.xls`) or CSV file.</li>
            <li>The first row must be the header row with: <strong>student_id</strong>, <strong>name</strong>, and <strong>email</strong>.</li>
            <li>The <strong>student_id</strong> must be unique across the system.</li>
            <li>Students will be automatically assigned their <strong>student_id</strong> as their initial password.</li>
        </ul>
    </div>

    <form method="POST" action="{{ route('college.students.upload') }}" enctype="multipart/form-data">
        @csrf

        <div style="border: 2px dashed var(--border-color); padding: 40px; border-radius: 8px; text-align: center; margin-bottom: 24px;">
            <input type="file" name="file" id="file" required style="margin-bottom: 16px;">
            <p style="font-size: 12px; color: var(--text-muted);">Max file size: 2MB</p>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px;">Start Import</button>
    </form>
</div>

<div class="card" style="margin-top: 32px; max-width: 600px; border-color: #e2e8f0; background-color: #f8fafc;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h4 style="font-size: 14px; font-weight: 600;">Download Sample Template</h4>
            <p style="font-size: 12px; color: var(--text-muted);">Use this template to ensure your data is formatted correctly.</p>
        </div>
        <a href="#" class="btn btn-outline" style="font-size: 12px;">Download .xlsx</a>
    </div>
</div>
@endsection
