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
                min-height: 60vh;
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
                width: 400px;
                height: 400px;
                background: radial-gradient(circle, rgba(249, 115, 22, 0.4) 0%, transparent 70%);
                top: -150px;
                left: -150px;
            }

            .orb-2 {
                width: 300px;
                height: 300px;
                background: radial-gradient(circle, rgba(251, 146, 60, 0.4) 0%, transparent 70%);
                bottom: -100px;
                right: -100px;
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
                font-size: clamp(2.5rem, 4vw, 3.5rem);
                font-weight: 900;
                color: white;
                line-height: 1.1;
                margin-bottom: 1.5rem;
                letter-spacing: -0.03em;
            }

            .hero-gradient-text {
                background: linear-gradient(135deg, #fed7aa 0%, #fb923c 50%, #f97316 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .hero-subtitle {
                font-size: clamp(1rem, 1.5vw, 1.25rem);
                color: #94a3b8;
                margin-bottom: 3rem;
                line-height: 1.6;
                font-weight: 400;
                max-width: 800px;
                margin-left: auto;
                margin-right: auto;
            }

            /* Info Box */
            .info-box {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 20px;
                padding: 2rem;
                max-width: 600px;
                margin: 0 auto;
                animation: fadeInUp 0.8s ease-out 0.5s both;
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

            .info-box-content {
                display: flex;
                align-items: center;
                gap: 1rem;
                color: white;
            }

            .info-box-icon {
                font-size: 2rem;
                color: var(--accent-light);
            }

            /* Main Content Section */
            .main-content {
                padding: 5rem 0;
                position: relative;
                background: white;
            }

            /* Section Header */
            .section-header {
                text-align: center;
                margin-bottom: 4rem;
            }

            .section-title {
                font-size: clamp(2rem, 3vw, 2.5rem);
                font-weight: 800;
                margin-bottom: 1rem;
                color: var(--primary-color);
                letter-spacing: -0.02em;
            }

            .section-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 60px;
                height: 60px;
                background: var(--accent-gradient);
                border-radius: 16px;
                color: white;
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }

            /* Period Cards Grid */
            .periods-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
                gap: 2rem;
                max-width: 1200px;
                margin: 0 auto;
            }

            /* Modern Period Card */
            .period-card {
                background: var(--card-bg);
                border: 1px solid var(--border-color);
                border-radius: 24px;
                padding: 2rem;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
                cursor: pointer;
                text-decoration: none;
                display: block;
            }

            .period-card::before {
                content: '';
                position: absolute;
                top: -2px;
                left: -2px;
                right: -2px;
                bottom: -2px;
                background: var(--accent-gradient);
                border-radius: 24px;
                opacity: 0;
                z-index: -1;
                transition: opacity 0.4s ease;
            }

            .period-card::after {
                content: '';
                position: absolute;
                inset: 1px;
                background: var(--card-bg);
                border-radius: 23px;
                z-index: -1;
            }

            .period-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            }

            .period-card:hover::before {
                opacity: 1;
            }

            .period-header {
                display: flex;
                justify-content: space-between;
                align-items: start;
                margin-bottom: 1.5rem;
            }

            .period-title {
                font-size: 1.25rem;
                font-weight: 700;
                color: var(--primary-color);
                margin-bottom: 0.5rem;
            }

            .period-status {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.5rem 1rem;
                border-radius: 50px;
                font-size: 0.875rem;
                font-weight: 600;
            }

            .status-active {
                background: rgba(16, 185, 129, 0.1);
                color: #059669;
                border: 1px solid rgba(16, 185, 129, 0.2);
            }

            .status-closed {
                background: rgba(239, 68, 68, 0.1);
                color: #dc2626;
                border: 1px solid rgba(239, 68, 68, 0.2);
            }

            .period-details {
                space-y: 1rem;
                margin-bottom: 2rem;
            }

            .period-detail {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                color: var(--text-secondary);
                font-size: 0.95rem;
            }

            .period-detail-icon {
                width: 36px;
                height: 36px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(249, 115, 22, 0.1);
                border-radius: 10px;
                color: var(--accent-color);
                font-size: 0.875rem;
            }

            .period-action {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                padding: 1rem 2rem;
                background: var(--accent-gradient);
                color: white;
                border-radius: 12px;
                font-weight: 600;
                transition: all 0.3s ease;
                text-decoration: none;
            }

            .period-action:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(249, 115, 22, 0.3);
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

            .btn-primary {
                background: var(--accent-gradient);
                color: white;
                box-shadow: 0 4px 14px rgba(249, 115, 22, 0.3);
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(249, 115, 22, 0.4);
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
                    font-size: clamp(2rem, 6vw, 2.5rem);
                }

                .periods-grid {
                    grid-template-columns: 1fr;
                    padding: 0 1rem;
                }

                .info-box {
                    margin: 0 1rem;
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

            /* Entrance Animations */
            .fade-in-up {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .fade-in-up.visible {
                opacity: 1;
                transform: translateY(0);
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
                    <a href="/" class="navbar-link">Home</a>
                    <a href="/#features" class="navbar-link">Why Join Us</a>
                    <a href="/#process" class="navbar-link">Process</a>
                    <a href="/#careers" class="navbar-link">Careers</a>
                    <a href="/" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i>
                        Back to Home
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
                <a href="/#features" class="mobile-menu-link">Why Join Us</a>
                <a href="/#process" class="mobile-menu-link">Hiring Process</a>
                <a href="/#careers" class="mobile-menu-link">Careers</a>
                <a href="/" class="btn btn-primary" style="text-align: center; margin-top: 1rem;">
                    <i class="fas fa-arrow-left"></i>
                    Back to Home
                </a>
            </div>
        </div>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-grid"></div>
            <div class="gradient-orb orb-1"></div>
            <div class="gradient-orb orb-2"></div>

            <div class="hero-content">
                <div class="hero-badge">
                    <span class="hero-badge-text">🔍 APPLICATION TRACKER</span>
                </div>

                <h1 class="hero-title">
                    Track Your <span class="hero-gradient-text">Application Progress</span>
                </h1>

                <p class="hero-subtitle">
                    Monitor your application status in real-time and stay updated throughout our recruitment process. Your journey to JIWARAGA starts here.
                </p>

                <div class="info-box">
                    <div class="info-box-content">
                        <i class="fas fa-info-circle info-box-icon"></i>
                        <div>
                            <p style="font-weight: 600; margin-bottom: 0.25rem;">Getting Started</p>
                            <p style="font-size: 0.875rem; opacity: 0.9;">Select a recruitment period below to track your application status</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content Section -->
        <section class="main-content">
            <div class="container mx-auto px-6">
                @if (session('success'))
                    <div class="alert alert-success max-w-4xl mx-auto">
                        <i class="fas fa-check-circle alert-icon"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-error max-w-4xl mx-auto">
                        <i class="fas fa-exclamation-circle alert-icon"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <div class="section-header fade-in-up">
                    <div class="section-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h2 class="section-title">Select Recruitment Period</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Choose the recruitment period when you submitted your application to view its current status</p>
                </div>

                <div class="periods-grid">
                    @foreach($periodes as $periode)
                        @if($periode->tanggal_mulai->lessThanOrEqualTo(now()))
                        <a href="{{ route('applicant.progress.select-period', $periode->periode_id) }}"
                           class="period-card fade-in-up">
                            <div class="period-header">
                                <div>
                                    <h3 class="period-title">{{ $periode->nama_periode }}</h3>
                                </div>
                                <span class="period-status {{ $periode->tanggal_selesai->isPast() ? 'status-closed' : 'status-active' }}">
                                    <i class="fas fa-circle" style="font-size: 0.5rem;"></i>
                                    {{ $periode->tanggal_selesai->isPast() ? 'Closed' : 'Active' }}
                                </span>
                            </div>

                            <div class="period-details">
                                <div class="period-detail">
                                    <div class="period-detail-icon">
                                        <i class="fas fa-play-circle"></i>
                                    </div>
                                    <div>
                                        <p style="font-size: 0.75rem; color: #94a3b8; margin-bottom: 0.125rem;">Start Date</p>
                                        <p style="font-weight: 600;">{{ $periode->tanggal_mulai->format('d M Y') }}</p>
                                    </div>
                                </div>

                                <div class="period-detail">
                                    <div class="period-detail-icon">
                                        <i class="fas fa-flag-checkered"></i>
                                    </div>
                                    <div>
                                        <p style="font-size: 0.75rem; color: #94a3b8; margin-bottom: 0.125rem;">End Date</p>
                                        <p style="font-weight: 600;">{{ $periode->tanggal_selesai->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="period-action">
                                <i class="fas fa-search"></i>
                                Track Application
                            </div>
                        </a>
                        @endif
                    @endforeach
                </div>
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
                        <li><a href="#" class="footer-link">Career Tips</a></li>
                        <li><a href="#" class="footer-link">Employee Stories</a></li>
                        <li><a href="#" class="footer-link">FAQ</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Contact</h4>
                    <ul class="footer-links">
                        <li class="flex items-center gap-2">
                            <i class="fas fa-envelope text-sm"></i>
                            careers@jiwaraga.com
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-phone text-sm"></i>
                            +62 21 5555 1234
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-sm"></i>
                            Jakarta, Indonesia
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
                }, 1000);
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

            // Close mobile menu on link click
            document.querySelectorAll('.mobile-menu-link').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.remove('active');
                    document.body.style.overflow = '';
                });
            });

            // Intersection Observer for Animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            // Apply observer to elements
            document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));

            // Parallax Effect for Hero Section
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.gradient-orb');

                parallaxElements.forEach((el, index) => {
                    const speed = 0.3 + (index * 0.1);
                    el.style.transform = `translateY(${scrolled * speed}px)`;
                });
            });

            // Initialize animations on page load
            document.addEventListener('DOMContentLoaded', () => {
                // Trigger initial animations
                document.querySelectorAll('.period-card').forEach((card, index) => {
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 100);
                });
            });
        </script>
    </body>
</html>