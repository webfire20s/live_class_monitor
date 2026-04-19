@extends('layouts.admin')

@section('title', 'Manage Colleges')

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
        background-color: #f9fafb;
        font-weight: 600;
        color: var(--text-muted);
    }
    .status-badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 500;
    }
    .status-active {
        background-color: #def7ec;
        color: #03543f;
    }
    .status-inactive {
        background-color: #fde2e1;
        color: #9b1c1c;
    }
    .actions {
        display: flex;
        gap: 8px;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">Manage Colleges</h1>
    <a href="{{ route('admin.colleges.create') }}" class="btn btn-primary">Add New College</a>
</div>

<div class="card">
    <table class="data-table">
        <thead>
            <tr>
                <th>College Name</th>
                <th>College Code</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($colleges as $college)
            <tr>
                <td style="font-weight: 500;">{{ $college->name }}</td>
                <td><code>{{ $college->college_code }}</code></td>
                <td>{{ $college->email }}</td>
                <td>
                    <span class="status-badge {{ $college->is_active ? 'status-active' : 'status-inactive' }}">
                        {{ $college->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="actions">
                    @if(!$college->is_active)
                        <form action="{{ route('admin.colleges.approve', $college->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="padding: 4px 8px; font-size: 13px;">Approve</button>
                        </form>
                    @endif
                    <a href="{{ route('admin.colleges.edit', $college->id) }}" class="btn btn-outline" style="padding: 4px 8px;">Edit</a>
                    <form action="{{ route('admin.colleges.destroy', $college->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this college?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline" style="padding: 4px 8px; color: var(--danger-color); border-color: #fee2e2;">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 32px;">No colleges found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
