<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Live Class Monitor - Premium Access</title>
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
            }

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                font-family: 'Outfit', sans-serif;
                background-color: var(--bg-color);
                color: var(--text-main);
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                overflow-x: hidden;
                position: relative;
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
                top: 10%;
                left: 20%;
                width: 400px;
                height: 400px;
                background: radial-gradient(circle, var(--primary) 0%, transparent 70%);
            }
            .blob-2 {
                bottom: 10%;
                right: 15%;
                width: 500px;
                height: 500px;
                background: radial-gradient(circle, var(--secondary) 0%, transparent 70%);
                animation-delay: -10s;
            }

            @keyframes float {
                0% { transform: translate(0, 0) scale(1); }
                50% { transform: translate(50px, 30px) scale(1.1); }
                100% { transform: translate(-30px, -50px) scale(0.9); }
            }

            .container {
                max-width: 1000px;
                width: 90%;
                padding: 40px 20px;
                z-index: 1;
                animation: fade-in 1s cubic-bezier(0.16, 1, 0.3, 1);
            }

            @keyframes fade-in {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .header {
                text-align: center;
                margin-bottom: 60px;
            }

            .logo-icon {
                width: 64px;
                height: 64px;
                margin: 0 auto 20px;
                background: linear-gradient(135deg, var(--primary), var(--secondary));
                border-radius: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 10px 30px -10px var(--primary-glow);
            }

            .logo-icon svg {
                width: 32px;
                height: 32px;
                color: white;
            }

            h1 {
                font-size: 42px;
                font-weight: 700;
                margin-bottom: 12px;
                background: linear-gradient(to right, #fff, #cbd5e1);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                letter-spacing: -0.5px;
            }

            p.subtitle {
                font-size: 18px;
                color: var(--text-muted);
                font-weight: 300;
                max-width: 600px;
                margin: 0 auto;
                line-height: 1.6;
            }

            .grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 30px;
            }

            @media (min-width: 768px) {
                .grid {
                    grid-template-columns: 1fr 1fr;
                }
            }

            .card {
                background: var(--card-bg);
                border: 1px solid var(--card-border);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border-radius: 24px;
                padding: 40px;
                text-align: center;
                transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
                position: relative;
                overflow: hidden;
            }

            .card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 2px;
                background: linear-gradient(90deg, transparent, var(--primary), transparent);
                opacity: 0;
                transition: opacity 0.4s;
            }

            .card:hover {
                transform: translateY(-8px);
                background: rgba(255, 255, 255, 0.05);
                border-color: rgba(255, 255, 255, 0.15);
                box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.5);
            }

            .card:hover::before {
                opacity: 1;
            }

            .card-icon {
                width: 48px;
                height: 48px;
                background: rgba(6, 182, 212, 0.1);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 20px;
                color: var(--primary);
                transition: transform 0.3s;
            }

            .card:hover .card-icon {
                transform: scale(1.1) rotate(5deg);
                background: var(--primary);
                color: white;
            }

            .card-title {
                font-size: 24px;
                font-weight: 600;
                margin-bottom: 12px;
                color: #fff;
            }

            .card-desc {
                font-size: 15px;
                color: var(--text-muted);
                margin-bottom: 30px;
                line-height: 1.5;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                padding: 14px 24px;
                border-radius: 12px;
                font-size: 16px;
                font-weight: 500;
                text-decoration: none;
                margin-bottom: 12px;
                transition: all 0.3s ease;
                border: 1px solid transparent;
                cursor: pointer;
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--primary), var(--secondary));
                color: white;
                box-shadow: 0 4px 15px -3px var(--primary-glow);
            }

            .btn-primary:hover {
                box-shadow: 0 8px 25px -5px var(--primary-glow);
                transform: translateY(-2px);
                filter: brightness(1.1);
            }

            .btn-outline {
                background: rgba(255, 255, 255, 0.03);
                color: #e2e8f0;
                border-color: rgba(255, 255, 255, 0.1);
            }

            .btn-outline:hover {
                background: rgba(255, 255, 255, 0.08);
                border-color: rgba(255, 255, 255, 0.2);
                transform: translateY(-2px);
            }

            .admin-link {
                display: inline-block;
                margin-top: 50px;
                color: var(--text-muted);
                font-size: 14px;
                text-decoration: none;
                transition: color 0.2s;
                padding: 8px 16px;
                border-radius: 20px;
                background: rgba(255, 255, 255, 0.02);
            }

            .admin-link:hover {
                color: #fff;
                background: rgba(255, 255, 255, 0.05);
            }
        </style>
    </head>
    <body>
        <!-- Animated Background -->
        <div class="glow-blob blob-1"></div>
        <div class="glow-blob blob-2"></div>

        <div class="container">
            <div class="header">
                <div class="logo-icon">
                    <img src="{{ url('assets/images/logo.png') }}" height="66px">
                    <!-- <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14v-4z"></path>
                        <rect x="3" y="6" width="12" height="12" rx="2" ry="2"></rect>
                    </svg> -->
                </div>
                <h1>Live Class Monitor</h1>
                <p class="subtitle">Experience next-generation attendance tracking and seamless live class monitoring designed for modern educational institutions.</p>
            </div>

            <div class="grid">
                <!-- Student Portal -->
                <div class="card">
                    <div class="card-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="card-title">Student Portal</div>
                    <p class="card-desc">Join interactive live sessions, track your real-time attendance, and manage your academic profile effortlessly.</p>
                    <a href="{{ route('student.login') }}" class="btn btn-primary">Sign In to Dashboard</a>
                    <a href="{{ route('student.register') }}" class="btn btn-outline">Create Student Account</a>
                </div>

                <!-- College Portal -->
                <div class="card">
                    <div class="card-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </div>
                    <div class="card-title">College Portal</div>
                    <p class="card-desc">Approve student registrations, monitor live class engagement, and access comprehensive attendance reports.</p>
                    <a href="{{ route('college.login') }}" class="btn btn-primary">Access Admin Panel</a>
                    <a href="{{ route('college.register') }}" class="btn btn-outline">Register Institution</a>
                </div>
            </div>
            
            <div style="text-align: center;">
                <a href="{{ route('admin.login') }}" class="admin-link">System Administrator Login</a>
            </div>
        </div>
    </body>
</html>
