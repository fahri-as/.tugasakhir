<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Track Your Application | JIWARAGA Careers</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                /* Professional Corporate Colors with Orange Theme */
                --primary-color: #1a1f36;
                --secondary-color: #4a5568;
                --accent-color: #f97316;
                --accent-gradient: linear-gradient(135deg, #fb923c 0%, #f97316 50%, #ea580c 100%);
                --accent-light: #fed7aa;
                --accent-dark: #c2410c;
                --success-color: #10b981;
                --warning-color: #f59e0b;
                --danger-color: #ef4444;
                --dark-bg: #0f172a;
                --light-bg: #f8fafc;
                --card-bg: #ffffff;
                --text-primary: #1e293b;
                --text-secondary: #64748b;
                --border-color: #e2e8f0;
                --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', sans-serif;
                overflow-x: hidden;
                background-color: var(--light-bg);
                color: var(--text-primary);
                line-height: 1.6;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            h1, h2, h3, h4, h5, h6 {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-weight: 700;
                color: var(--primary-color);
            }

            /* Enhanced Loading Animation */
            .page-loader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .loader-content {
                text-align: center;
                position: relative;
            }

            .loader-circles {
                display: flex;
                gap: 8px;
                margin-bottom: 2rem;
                justify-content: center;
            }

            .loader-circle {
                width: 12px;
                height: 12px;
                background: var(--accent-color);
                border-radius: 50%;
                animation: loaderPulse 1.5s ease-in-out infinite;
            }

            .loader-circle:nth-child(2) { animation-delay: 0.2s; }
            .loader-circle:nth-child(3) { animation-delay: 0.4s; }

            @keyframes loaderPulse {
                0%, 100% { transform: scale(0.8); opacity: 0.5; }
                50% { transform: scale(1.2); opacity: 1; }
            }

            /* Modern Navbar with Glassmorphism */
            .navbar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1000;
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .navbar.scrolled {
                background: rgba(255, 255, 255, 0.95);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            }

            .navbar-content {
                max-width: 1400px;
                margin: 0 auto;
                padding: 1rem 2rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .navbar-brand {
                font-size: 1.75rem;
                font-weight: 800;
                background: var(--accent-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                letter-spacing: -0.02em;
            }

            .navbar-menu {
                display: flex;
                align-items: center;
                gap: 2.5rem;
            }

            .navbar-link {
                color: var(--text-secondary);
                text-decoration: none;
                font-weight: 500;
                position: relative;
                transition: color 0.3s ease;
                font-size: 0.95rem;
            }

            .navbar-link::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 0;
                width: 0;
                height: 2px;
                background: var(--accent-gradient);
                transition: width 0.3s ease;
            }

            .navbar-link:hover {
                color: var(--accent-color);
            }

            .navbar-link:hover::after {
                width: 100%;
            }

            /* Hero Section */
            .hero-section {
                min-height: 50vh;
                padding-top: 80px;
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
                position: relative;
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Animated Background Grid */
            .hero-grid {
                position: absolute;
                width: 100%;
                height: 100%;
                background-image:
                    linear-gradient(rgba(249, 115, 22, 0.1) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(249, 115, 22, 0.1) 1px, transparent 1px);
                background-size: 50px 50px;
                animation: gridMove 20s linear infinite;
            }

            @keyframes gridMove {
                0% { transform: translate(0, 0); }
                100% { transform: translate(50px, 50px); }
            }

            /* Floating Gradient Orbs */
            .gradient-orb {
                position: absolute;
                border-radius: 50%;
                filter: blur(80px);
                opacity: 0.6;
                animation: orbFloat 20s ease-in-out infinite;
            }

            .orb-1 {
                width: 300px;
                height: 300px;
                background: radial-gradient(circle, rgba(249, 115, 22, 0.4) 0%, transparent 70%);
                top: -100px;
                right: -100px;
            }

            .orb-2 {
                width: 250px;
                height: 250px;
                background: radial-gradient(circle, rgba(251, 146, 60, 0.4) 0%, transparent 70%);
                bottom: -80px;
                left: -80px;
                animation-delay: -10s;
            }

            @keyframes orbFloat {
                0%, 100% { transform: translate(0, 0) scale(1); }
                25% { transform: translate(50px, -50px) scale(1.1); }
                50% { transform: translate(-30px, 30px) scale(0.9); }
                75% { transform: translate(30px, 50px) scale(1.05); }
            }

            .hero-content {
                position: relative;
                z-index: 10;
                text-align: center;
                max-width: 1000px;
                padding: 0 2rem;
                animation: heroFadeIn 1.2s cubic-bezier(0.4, 0, 0.2, 1);
            }

            @keyframes heroFadeIn {
                from {
                    opacity: 0;
                    transform: translateY(40px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                background: rgba(249, 115, 22, 0.1);
                border: 1px solid rgba(249, 115, 22, 0.2);
                padding: 0.5rem 1.5rem;
                border-radius: 50px;
                margin-bottom: 2rem;
                animation: pulse 3s ease-in-out infinite;
            }

            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }

            .hero-badge-text {
                color: #fed7aa;
                font-size: 0.875rem;
                font-weight: 600;
                letter-spacing: 0.5px;
            }

            .hero-title {
                font-size: clamp(2rem, 3vw, 2.5rem);
                font-weight: 900;
                color: white;
                line-height: 1.1;
                margin-bottom: 1rem;
                letter-spacing: -0.03em;
            }

            .hero-gradient-text {
                background: linear-gradient(135deg, #fed7aa 0%, #fb923c 50%, #f97316 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .hero-subtitle {
                font-size: clamp(1rem, 1.5vw, 1.125rem);
                color: #94a3b8;
                line-height: 1.6;
                font-weight: 400;
                max-width: 600px;
                margin: 0 auto 2rem;
            }

            .period-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                padding: 0.5rem 1.25rem;
                border-radius: 50px;
                font-size: 0.875rem;
                font-weight: 600;
                color: white;
            }

            /* Main Content */
            .main-content {
                flex-grow: 1;
                padding: 4rem 0;
                position: relative;
                background: white;
            }

            /* Search Card */
            .search-card {
                background: var(--card-bg);
                border: 1px solid var(--border-color);
                border-radius: 24px;
                padding: 3rem;
                max-width: 600px;
                margin: 0 auto;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
                position: relative;
                overflow: hidden;
                animation: fadeInUp 0.8s ease-out;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .search-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: var(--accent-gradient);
            }

            .search-icon-wrapper {
                width: 80px;
                height: 80px;
                margin: 0 auto 2rem;
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .search-icon-bg {
                position: absolute;
                width: 100%;
                height: 100%;
                background: var(--accent-gradient);
                border-radius: 20px;
                opacity: 0.1;
                transform: rotate(10deg);
            }

            .search-icon {
                position: relative;
                font-size: 2rem;
                background: var(--accent-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .period-info {
                text-align: center;
                margin-bottom: 3rem;
            }

            .period-name {
                font-size: 1.5rem;
                font-weight: 700;
                color: var(--primary-color);
                margin-bottom: 1rem;
            }

            .period-dates {
                display: flex;
                justify-content: center;
                gap: 2rem;
                color: var(--text-secondary);
                font-size: 0.95rem;
            }

            .date-item {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .date-icon {
                color: var(--accent-color);
            }

            /* Form Styling */
            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-label {
                display: block;
                margin-bottom: 0.75rem;
                font-weight: 600;
                color: var(--primary-color);
                font-size: 0.875rem;
                letter-spacing: 0.025em;
                text-align: center;
            }

            .input-wrapper {
                position: relative;
                max-width: 400px;
                margin: 0 auto;
            }

            .input-icon {
                position: absolute;
                left: 1rem;
                top: 50%;
                transform: translateY(-50%);
                color: var(--text-secondary);
                transition: color 0.3s ease;
                font-size: 1.125rem;
            }

            .form-control {
                width: 100%;
                padding: 0.875rem 3rem 0.875rem 3rem;
                background: white;
                border: 2px solid var(--border-color);
                border-radius: 12px;
                color: var(--text-primary);
                transition: all 0.3s ease;
                font-size: 1rem;
                font-weight: 500;
                text-align: center;
            }

            .form-control:focus {
                outline: none;
                border-color: var(--accent-color);
                box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
            }

            .input-wrapper:focus-within .input-icon {
                color: var(--accent-color);
            }

            .form-control::placeholder {
                color: #94a3b8;
                font-weight: 400;
            }

            .form-hint {
                text-align: center;
                color: var(--text-secondary);
                font-size: 0.875rem;
                margin-top: 0.75rem;
            }

            .form-error {
                text-align: center;
                color: var(--danger-color);
                font-size: 0.875rem;
                margin-top: 0.5rem;
            }

            /* Submit Button */
            .submit-btn {
                width: 100%;
                max-width: 400px;
                margin: 2rem auto 0;
                display: block;
                padding: 1rem 2.5rem;
                background: var(--accent-gradient);
                color: white;
                border: none;
                border-radius: 12px;
                font-weight: 600;
                font-size: 1rem;
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
            }

            .submit-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(249, 115, 22, 0.3);
            }

            .submit-btn:active {
                transform: translateY(0);
            }

            .btn-content {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
            }

            /* Help Text */
            .help-text {
                text-align: center;
                margin-top: 3rem;
                color: var(--text-secondary);
                font-size: 0.875rem;
            }

            .help-link {
                color: var(--accent-color);
                text-decoration: none;
                font-weight: 600;
                transition: color 0.3s ease;
            }

            .help-link:hover {
                color: var(--accent-dark);
                text-decoration: underline;
            }

            /* Modern Alerts */
            .alert {
                padding: 1rem 1.5rem;
                border-radius: 16px;
                margin-bottom: 2rem;
                display: flex;
                align-items: center;
                gap: 1rem;
                animation: slideDown 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                backdrop-filter: blur(10px);
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .alert-success {
                background: rgba(16, 185, 129, 0.1);
                border: 1px solid rgba(16, 185, 129, 0.2);
                color: #059669;
            }

            .alert-error {
                background: rgba(239, 68, 68, 0.1);
                border: 1px solid rgba(239, 68, 68, 0.2);
                color: #dc2626;
            }

            .alert-icon {
                font-size: 1.25rem;
            }

            /* Modern Footer */
            .footer {
                background: var(--primary-color);
                color: white;
                padding: 5rem 0 2rem;
                position: relative;
                overflow: hidden;
                margin-top: auto;
            }

            .footer::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 1px;
                background: linear-gradient(90deg, transparent, rgba(249, 115, 22, 0.5), transparent);
            }

            .footer-content {
                max-width: 1200px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 3rem;
                padding: 0 2rem;
                margin-bottom: 3rem;
            }

            .footer-brand h3 {
                font-size: 2rem;
                margin-bottom: 1rem;
                background: var(--accent-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .footer-description {
                color: #94a3b8;
                line-height: 1.8;
            }

            .footer-section h4 {
                color: white;
                font-size: 1rem;
                font-weight: 600;
                margin-bottom: 1.5rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }

            .footer-links {
                list-style: none;
            }

            .footer-link {
                color: #94a3b8;
                text-decoration: none;
                display: block;
                padding: 0.5rem 0;
                transition: all 0.3s ease;
                position: relative;
            }

            .footer-link:hover {
                color: white;
                transform: translateX(5px);
            }

            .social-links {
                display: flex;
                gap: 1rem;
                margin-top: 2rem;
            }

            .social-link {
                width: 44px;
                height: 44px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 12px;
                color: #94a3b8;
                transition: all 0.3s ease;
                font-size: 1.125rem;
            }

            .social-link:hover {
                background: var(--accent-gradient);
                border-color: transparent;
                color: white;
                transform: translateY(-3px);
            }

            .footer-bottom {
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                padding-top: 2rem;
                text-align: center;
                color: #64748b;
            }

            /* Modern CTA Buttons */
            .btn {
                padding: 0.875rem 2rem;
                border-radius: 12px;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                font-size: 0.95rem;
                border: none;
                cursor: pointer;
            }

            .btn-secondary {
                background: rgba(255, 255, 255, 0.1);
                color: var(--text-secondary);
                border: 1px solid var(--border-color);
                backdrop-filter: blur(10px);
            }

            .btn-secondary:hover {
                background: rgba(255, 255, 255, 0.15);
                border-color: var(--accent-color);
                color: var(--accent-color);
                transform: translateY(-2px);
            }

            /* Mobile Menu */
            .mobile-menu-toggle {
                display: none;
                background: none;
                border: none;
                color: var(--text-primary);
                font-size: 1.5rem;
                cursor: pointer;
                padding: 0.5rem;
            }

            .mobile-menu {
                position: fixed;
                top: 0;
                right: -100%;
                width: 80%;
                max-width: 400px;
                height: 100vh;
                background: white;
                box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1);
                transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 1001;
                padding: 2rem;
                overflow-y: auto;
            }

            .mobile-menu.active {
                right: 0;
            }

            .mobile-menu-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 2rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid var(--border-color);
            }

            .mobile-menu-close {
                background: none;
                border: none;
                font-size: 1.5rem;
                color: var(--text-secondary);
                cursor: pointer;
            }

            .mobile-menu-links {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .mobile-menu-link {
                color: var(--text-primary);
                text-decoration: none;
                padding: 1rem;
                border-radius: 12px;
                transition: all 0.3s ease;
                font-weight: 500;
            }

            .mobile-menu-link:hover {
                background: var(--light-bg);
                color: var(--accent-color);
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .navbar-menu {
                    display: none;
                }

                .mobile-menu-toggle {
                    display: block;
                }

                .hero-title {
                    font-size: clamp(1.75rem, 5vw, 2rem);
                }

                .search-card {
                    margin: 0 1rem;
                    padding: 2rem 1.5rem;
                }

                .period-dates {
                    flex-direction: column;
                    gap: 0.5rem;
                }
            }

            /* Smooth Scrollbar */
            ::-webkit-scrollbar {
                width: 10px;
            }

            ::-webkit-scrollbar-track {
                background: var(--light-bg);
            }

            ::-webkit-scrollbar-thumb {
                background: linear-gradient(180deg, var(--accent-color), #ea580c);
                border-radius: 5px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(180deg, #ea580c, #c2410c);
            }

            /* Smooth scroll behavior */
            html {
                scroll-behavior: smooth;
            }

            /* Loading States */
            .loading {
                pointer-events: none;
                opacity: 0.6;
            }

            .spinner {
                display: inline-block;
                width: 20px;
                height: 20px;
                border: 3px solid rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                border-top-color: white;
                animation: spin 0.8s ease-in-out infinite;
            }

            @keyframes spin {
                to { transform: rotate(360deg); }
            }
        </style>
    </head>
    <body>
        <!-- Enhanced Page Loader -->
        <div class="page-loader" id="pageLoader">
            <div class="loader-content">
                <div class="loader-circles">
                    <div class="loader-circle"></div>
                    <div class="loader-circle"></div>
                    <div class="loader-circle"></div>
                </div>
                <h3 style="color: white; font-weight: 600;">JIWARAGA</h3>
                <p style="color: #94a3b8; font-size: 0.875rem; margin-top: 0.5rem;">Loading application tracker...</p>
            </div>
        </div>

        <!-- Modern Navbar -->
        <nav class="navbar" id="navbar">
            <div class="navbar-content">
                <div class="navbar-brand">JIWARAGA</div>

                <div class="navbar-menu">
                    <a href="{{ route('applicant.progress.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Back to Periods
                    </a>
                </div>

                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobileMenu">
            <div class="mobile-menu-header">
                <div class="navbar-brand">JIWARAGA</div>
                <button class="mobile-menu-close" id="mobileMenuClose">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mobile-menu-links">
                <a href="/" class="mobile-menu-link">Home</a>
                <a href="{{ route('applicant.progress.index') }}" class="mobile-menu-link">Back to Periods</a>
            </div>
        </div>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-grid"></div>
            <div class="gradient-orb orb-1"></div>
            <div class="gradient-orb orb-2"></div>

            <div class="hero-content">
                <div class="hero-badge">
                    <span class="hero-badge-text">🔍 TRACK APPLICATION</span>
                </div>

                <h1 class="hero-title">
                    Enter Your <span class="hero-gradient-text">Application ID</span>
                </h1>

                <p class="hero-subtitle">
                    Track your progress through our recruitment process
                </p>

                <div class="period-badge">
                    <i class="fas fa-calendar-check"></i>
                    {{ $periode->nama_periode }}
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="main-content">
            <div class="container mx-auto px-6">
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle alert-icon"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle alert-icon"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <div class="search-card">
                    <div class="search-icon-wrapper">
                        <div class="search-icon-bg"></div>
                        <i class="fas fa-search search-icon"></i>
                    </div>

                    <div class="period-info">
                        <h2 class="period-name">{{ $periode->nama_periode }}</h2>
                        <div class="period-dates">
                            <div class="date-item">
                                <i class="fas fa-calendar-day date-icon"></i>
                                <span>Start: {{ $periode->tanggal_mulai->format('d M Y') }}</span>
                            </div>
                            <div class="date-item">
                                <i class="fas fa-calendar-check date-icon"></i>
                                <span>End: {{ $periode->tanggal_selesai->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('applicant.progress.track', $periode->periode_id) }}" method="POST" id="trackingForm">
                        @csrf
                        <div class="form-group">
                            <label for="pelamar_id" class="form-label">
                                Enter Your Application ID
                            </label>
                            <div class="input-wrapper">
                                <i class="fas fa-id-card input-icon"></i>
                                <input
                                    type="text"
                                    name="pelamar_id"
                                    id="pelamar_id"
                                    placeholder="e.g., PL001"
                                    class="form-control"
                                    required
                                    autofocus
                                />
                            </div>
                            <p class="form-hint">
                                Enter the Application ID you received when you submitted your application
                            </p>
                            @error('pelamar_id')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="submit-btn" id="submitBtn">
                            <span class="btn-content">
                                <i class="fas fa-search-location"></i>
                                Track Application
                            </span>
                        </button>
                    </form>
                </div>

                <p class="help-text">
                    Don't have an Application ID?
                    <a href="/" class="help-link">Apply now</a>
                </p>
            </div>
        </section>

        <!-- Modern Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-brand">
                    <h3>JIWARAGA</h3>
                    <p class="footer-description">Building careers in culinary excellence. Join Indonesia's premier dining establishment and shape the future of gastronomy.</p>
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="/" class="footer-link">Home</a></li>
                        <li><a href="/#features" class="footer-link">Why Join Us</a></li>
                        <li><a href="/#process" class="footer-link">Hiring Process</a></li>
                        <li><a href="/#application-form" class="footer-link">Apply Now</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Resources</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('applicant.progress.index') }}" class="footer-link">Track Application</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Contact</h4>
                    <ul class="footer-links">
                        <li class="flex items-center gap-2">
                            <i class="fas fa-envelope text-sm"></i>
                            jiwaragacareers@gmail.com
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-phone text-sm"></i>
                            +62 812-6778-8628
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-sm"></i>
                            Jl. Veteran No.15, Purus, Kec. Padang Bar., Kota Padang, Sumatera Barat 25115
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} JIWARAGA. All rights reserved. | Privacy Policy | Terms of Service</p>
            </div>
        </footer>

        <script>
            // Enhanced Page Loader
            window.addEventListener('load', () => {
                setTimeout(() => {
                    const loader = document.getElementById('pageLoader');
                    loader.style.opacity = '0';
                    setTimeout(() => {
                        loader.style.display = 'none';
                    }, 600);
                }, 800);
            });

            // Navbar Scroll Effect
            window.addEventListener('scroll', () => {
                const navbar = document.getElementById('navbar');
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Mobile Menu
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuClose = document.getElementById('mobileMenuClose');

            mobileMenuToggle.addEventListener('click', () => {
                mobileMenu.classList.add('active');
                document.body.style.overflow = 'hidden';
            });

            mobileMenuClose.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            });

            // Form Submission
            const form = document.getElementById('trackingForm');
            const submitBtn = document.getElementById('submitBtn');

            form.addEventListener('submit', function(e) {
                const btnContent = submitBtn.querySelector('.btn-content');
                btnContent.innerHTML = '<span class="spinner"></span> Searching...';
                submitBtn.disabled = true;
                submitBtn.classList.add('loading');
            });

            // Input field focus animation
            const inputField = document.getElementById('pelamar_id');
            inputField.addEventListener('focus', () => {
                inputField.parentElement.classList.add('focused');
            });

            inputField.addEventListener('blur', () => {
                inputField.parentElement.classList.remove('focused');
            });

            // Parallax Effect for Hero Section
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.gradient-orb');

                parallaxElements.forEach((el, index) => {
                    const speed = 0.3 + (index * 0.1);
                    el.style.transform = `translateY(${scrolled * speed}px)`;
                });
            });

            // Auto-focus on input field
            document.addEventListener('DOMContentLoaded', () => {
                document.getElementById('pelamar_id').focus();
            });
        </script>
    </body>
</html>
