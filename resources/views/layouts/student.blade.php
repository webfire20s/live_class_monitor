<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Student Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
            --bg-color: #f1f5f9;
            --header-bg: #ffffff;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --accent-color: #8b5cf6;
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navigation */
        .navbar {
            height: 64px;
            background-color: var(--header-bg);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 5%;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
        }

        .navbar-nav {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-main);
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .logout-link {
            color: #ef4444;
            font-weight: 600;
            cursor: pointer;
            background: none;
            border: none;
            font-size: 14px;
        }

        /* Main Content */
        .main-container {
            flex: 1;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 5%;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
        }

        /* Components */
        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-info {
            background-color: #eff6ff;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('student.dashboard') }}" class="navbar-brand">
            LiveMonitor <span style="font-weight: 400; font-size: 14px; color: var(--text-muted);">| Student</span>
        </a>
        <div class="navbar-nav">
            <span class="nav-link" style="color: var(--text-muted);">Welcome, {{ Auth::guard('student')->user()->name }}</span>
            <form method="POST" action="{{ route('student.logout') }}">
                @csrf
                <button type="submit" class="logout-link">Logout</button>
            </form>
        </div>
    </nav>

    <main class="main-container">
        @if (session('success'))
            <div class="alert alert-success" style="background-color: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer style="padding: 32px 0; text-align: center; color: var(--text-muted); font-size: 12px;">
        &copy; {{ date('Y') }} {{ config('app.name') }} - Secure Live Class Monitoring
    </footer>

    @yield('scripts')
</body>
</html>
