<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Live Class Monitor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #020617;
            --card-bg: rgba(255, 255, 255, 0.03);
            --card-border: rgba(255, 255, 255, 0.08);
            --primary: #06b6d4;
            --primary-glow: rgba(6, 182, 212, 0.4);
            --secondary: #10b981;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --error-color: #f87171;
            --error-bg: rgba(239, 68, 68, 0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
            padding: 20px;
        }

        /* Animated Background Blobs */
        .glow-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            z-index: -1;
            opacity: 0.6;
            animation: float 20s infinite alternate ease-in-out;
        }
        .blob-1 {
            top: -10%; left: -10%; width: 500px; height: 500px;
            background: radial-gradient(circle, var(--primary) 0%, transparent 70%);
        }
        .blob-2 {
            bottom: -10%; right: -10%; width: 600px; height: 600px;
            background: radial-gradient(circle, var(--secondary) 0%, transparent 70%);
            animation-delay: -10s;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(50px, 30px) scale(1.1); }
            100% { transform: translate(-30px, -50px) scale(0.9); }
        }

        .auth-container {
            width: 100%;
            max-width: 450px;
            z-index: 1;
            animation: fade-in 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        .auth-container.wide {
            max-width: 650px;
        }

        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .auth-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .auth-logo { text-align: center; margin-bottom: 30px; }
        
        .logo-icon {
            width: 48px; height: 48px;
            margin: 0 auto 16px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 10px 20px -10px var(--primary-glow);
        }
        .logo-icon svg { width: 24px; height: 24px; color: white; }

        .auth-logo h1 {
            font-size: 24px; font-weight: 700;
            background: linear-gradient(to right, #fff, #cbd5e1);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }

        .auth-header { text-align: center; margin-bottom: 32px; }
        .auth-header h2 { font-size: 22px; font-weight: 600; margin-bottom: 8px; color: #fff; }
        .auth-header p { font-size: 15px; color: var(--text-muted); line-height: 1.5; }

        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px; color: #e2e8f0; }
        
        .form-control {
            width: 100%; padding: 12px 16px; font-size: 15px;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px; color: white;
            transition: all 0.3s ease;
            font-family: 'Outfit', sans-serif;
            box-sizing: border-box;
        }
        
        .form-control::placeholder { color: rgba(255, 255, 255, 0.3); }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(0, 0, 0, 0.3);
            box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.15);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='rgba(255,255,255,0.5)'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
        }
        
        select.form-control option { background-color: #1e293b; color: white; }

        .form-footer { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
        .remember-me { display: flex; align-items: center; font-size: 14px; color: var(--text-muted); cursor: pointer; }
        .remember-me input { margin-right: 8px; cursor: pointer; accent-color: var(--primary); }

        .btn-primary {
            width: 100%; padding: 14px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white; border: none; border-radius: 10px;
            font-size: 16px; font-weight: 600; cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px -3px var(--primary-glow);
            font-family: 'Outfit', sans-serif;
            box-sizing: border-box;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px -5px var(--primary-glow);
            filter: brightness(1.1);
        }

        .alert-error {
            background-color: var(--error-bg);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: var(--error-color);
            padding: 14px; border-radius: 10px;
            font-size: 14px; margin-bottom: 24px;
        }
        
        .alert-error ul { padding-left: 20px; margin-top: 5px; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px; }
        
        .auth-links { text-align: center; margin-top: 24px; }
        .auth-links p { font-size: 14px; color: var(--text-muted); margin-bottom: 8px; }
        .auth-links a { color: var(--primary); text-decoration: none; font-weight: 500; transition: color 0.2s; }
        .auth-links a:hover { color: #67e8f9; }
        
        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            color: var(--text-muted); text-decoration: none; font-size: 14px;
            transition: color 0.2s; margin-top: 16px;
        }
        .back-link:hover { color: white; }
    </style>
</head>
<body>
    <div class="glow-blob blob-1"></div>
    <div class="glow-blob blob-2"></div>

    <div class="auth-container @yield('container_class')">
        <div class="auth-card">
            <div class="auth-logo">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14v-4z"></path>
                        <rect x="3" y="6" width="12" height="12" rx="2" ry="2"></rect>
                    </svg>
                </div>
                <h1>Live Class Monitor</h1>
            </div>
            @yield('content')
        </div>
    </div>
</body>
</html>
