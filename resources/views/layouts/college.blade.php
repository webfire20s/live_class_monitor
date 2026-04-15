<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - College Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #0891b2; /* Cyan theme for Colleges */
            --primary-hover: #0e7490;
            --bg-color: #f8fafc;
            --sidebar-bg: #1e293b;
            --sidebar-text: #cbd5e1;
            --sidebar-hover: #334155;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --success-color: #10b981;
            --danger-color: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
        }

        .sidebar-brand {
            padding: 24px;
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            border-bottom: 1px solid var(--sidebar-hover);
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 0;
        }

        .nav-item {
            padding: 12px 24px;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--sidebar-text);
            transition: background-color 0.2s, color 0.2s;
            font-size: 14px;
            font-weight: 500;
        }

        .nav-item:hover {
            background-color: var(--sidebar-hover);
            color: #ffffff;
        }

        .nav-item.active {
            background-color: var(--primary-color);
            color: #ffffff;
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid var(--sidebar-hover);
        }

        .logout-btn {
            width: 100%;
            padding: 10px;
            background: transparent;
            border: 1px solid var(--sidebar-hover);
            color: var(--sidebar-text);
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            height: 64px;
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 32px;
        }

        .user-info {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-muted);
        }

        .page-content {
            padding: 32px;
        }

        .page-header {
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
        }

        /* Utility Components */
        .card {
            background-color: var(--card-bg);
            border-radius: 8px;
            border: 1px solid var(--border-color);
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-main);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #d1fae5;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            LiveMonitor
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('college.dashboard') }}" class="nav-item {{ Request::routeIs('college.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('college.students.index') }}" class="nav-item {{ Request::routeIs('college.students.*') ? 'active' : '' }}">My Students</a>
            <a href="{{ route('college.reports') }}" class="nav-item {{ Request::routeIs('college.reports') ? 'active' : '' }}">Attendance Reports</a>
        </nav>
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('college.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <header class="topbar">
            <div class="user-info">
                {{ Auth::guard('college')->user()->name }} (College Panel)
            </div>
        </header>

        <main class="page-content">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert" style="background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca;">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
