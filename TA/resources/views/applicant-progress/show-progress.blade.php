<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Your Application Progress | JIWARAGA Careers</title>

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

            /* Hero Section */
            .hero-section {
                min-height: 40vh;
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

            .hero-title {
                font-size: clamp(2rem, 3vw, 2.5rem);
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

            .applicant-info {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                background: rgba(249, 115, 22, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(249, 115, 22, 0.2);
                padding: 0.5rem 1.25rem;
                border-radius: 50px;
                font-size: 0.875rem;
                font-weight: 600;
                color: white;
                margin-bottom: 1rem;
            }

            .application-id-badge {
                background: rgba(255, 255, 255, 0.2);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                padding: 0.5rem 1.25rem;
                border-radius: 12px;
                color: white;
                font-size: 0.875rem;
                font-weight: 500;
                display: inline-block;
            }

            /* Main Content */
            .main-content {
                flex-grow: 1;
                padding: 4rem 0;
                position: relative;
                background: white;
            }

            /* Status Cards Grid */
            .status-cards-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 1.5rem;
                margin-bottom: 3rem;
            }

            /* Modern Status Card */
            .status-card {
                background: var(--card-bg);
                border: 1px solid var(--border-color);
                border-radius: 20px;
                padding: 1.5rem;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
            }

            .status-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                opacity: 0;
                transition: opacity 0.4s ease;
            }

            .status-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }

            .status-card:hover::before {
                opacity: 1;
            }

            .status-card-blue::before { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
            .status-card-green::before { background: var(--accent-gradient); }
            .status-card-purple::before { background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); }

            .status-card-content {
                display: flex;
                align-items: start;
                gap: 1rem;
            }

            .status-icon-wrapper {
                width: 48px;
                height: 48px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 12px;
                flex-shrink: 0;
            }

            .status-icon-blue { background: rgba(59, 130, 246, 0.1); }
            .status-icon-green { background: rgba(249, 115, 22, 0.1); }
            .status-icon-purple { background: rgba(168, 85, 247, 0.1); }

            .status-icon {
                font-size: 1.25rem;
            }

            .status-icon-blue .status-icon { color: #3b82f6; }
            .status-icon-green .status-icon { color: var(--accent-color); }
            .status-icon-purple .status-icon { color: #a855f7; }

            .status-info h3 {
                font-size: 0.875rem;
                font-weight: 600;
                color: var(--text-secondary);
                margin-bottom: 0.5rem;
            }

            .status-value {
                font-size: 1rem;
                font-weight: 700;
                color: var(--primary-color);
            }

            .status-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.25rem;
                padding: 0.375rem 0.875rem;
                border-radius: 50px;
                font-size: 0.75rem;
                font-weight: 600;
                margin-top: 0.5rem;
            }

            .badge-pending {
                background: rgba(251, 191, 36, 0.1);
                color: #d97706;
                border: 1px solid rgba(251, 191, 36, 0.2);
            }

            .badge-accepted {
                background: rgba(16, 185, 129, 0.1);
                color: #059669;
                border: 1px solid rgba(16, 185, 129, 0.2);
            }

            .badge-rejected {
                background: rgba(239, 68, 68, 0.1);
                color: #dc2626;
                border: 1px solid rgba(239, 68, 68, 0.2);
            }

            /* Timeline Section */
            .timeline-section {
                margin-top: 3rem;
            }

            .timeline-header {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 3rem;
            }

            .timeline-icon-wrapper {
                width: 56px;
                height: 56px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: var(--accent-gradient);
                border-radius: 16px;
                color: white;
                font-size: 1.5rem;
            }

            .timeline-title {
                font-size: 1.75rem;
                font-weight: 800;
                color: var(--primary-color);
            }

            /* Modern Timeline */
            .timeline {
                position: relative;
                padding-left: 3rem;
            }

            .timeline::before {
                content: '';
                position: absolute;
                left: 1.5rem;
                top: 0;
                bottom: 0;
                width: 2px;
                background: linear-gradient(180deg, #e2e8f0 0%, #e2e8f0 90%, transparent 100%);
            }

            .timeline-item {
                position: relative;
                margin-bottom: 3rem;
                animation: fadeInUp 0.6s ease-out;
                animation-fill-mode: both;
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

            .timeline-item:nth-child(1) { animation-delay: 0.1s; }
            .timeline-item:nth-child(2) { animation-delay: 0.2s; }
            .timeline-item:nth-child(3) { animation-delay: 0.3s; }
            .timeline-item:nth-child(4) { animation-delay: 0.4s; }

            .timeline-marker {
                position: absolute;
                left: -1.5rem;
                width: 48px;
                height: 48px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: white;
                border-radius: 50%;
                box-shadow: 0 0 0 8px var(--light-bg);
                z-index: 2;
            }

            .marker-success {
                background: var(--success-color);
                color: white;
            }

            .marker-danger {
                background: var(--danger-color);
                color: white;
            }

            .marker-warning {
                background: var(--warning-color);
                color: white;
            }

            .marker-primary {
                background: var(--accent-gradient);
                color: white;
            }

            .timeline-content {
                background: var(--card-bg);
                border: 1px solid var(--border-color);
                border-radius: 20px;
                padding: 2rem;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .timeline-content::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                width: 4px;
                background: var(--border-color);
                transition: all 0.3s ease;
            }

            .timeline-content:hover {
                transform: translateX(5px);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }

            .timeline-content-success::before { background: var(--success-color); }
            .timeline-content-danger::before { background: var(--danger-color); }
            .timeline-content-warning::before { background: var(--warning-color); }
            .timeline-content-primary::before { background: var(--accent-gradient); }

            .timeline-header-content {
                display: flex;
                justify-content: space-between;
                align-items: start;
                margin-bottom: 1rem;
            }

            .timeline-stage-title {
                font-size: 1.25rem;
                font-weight: 700;
                color: var(--primary-color);
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .timeline-date {
                background: var(--light-bg);
                color: var(--text-secondary);
                padding: 0.25rem 0.75rem;
                border-radius: 8px;
                font-size: 0.75rem;
                font-weight: 500;
            }

            .timeline-description {
                color: var(--text-secondary);
                margin-bottom: 1rem;
                line-height: 1.6;
            }

            .timeline-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 1rem;
            }

            .timeline-status {
                display: inline-flex;
                align-items: center;
                gap: 0.25rem;
                padding: 0.375rem 0.875rem;
                border-radius: 50px;
                font-size: 0.75rem;
                font-weight: 600;
            }

            .timeline-hint {
                color: var(--text-secondary);
                font-size: 0.75rem;
            }

            /* Score Progress Bar */
            .score-section {
                margin-top: 1rem;
                padding-top: 1rem;
                border-top: 1px solid var(--border-color);
            }

            .score-label {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 0.5rem;
            }

            .score-text {
                font-size: 0.875rem;
                font-weight: 600;
                color: var(--text-primary);
            }

            .score-value {
                font-size: 0.875rem;
                font-weight: 700;
                color: var(--accent-color);
            }

            .score-bar {
                width: 100%;
                height: 8px;
                background: var(--light-bg);
                border-radius: 50px;
                overflow: hidden;
                position: relative;
            }

            .score-fill {
                height: 100%;
                border-radius: 50px;
                transition: width 1s ease-out;
                position: relative;
                overflow: hidden;
            }

            .score-fill::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                animation: shimmer 2s infinite;
            }

            @keyframes shimmer {
                0% { transform: translateX(-100%); }
                100% { transform: translateX(100%); }
            }

            .score-high { background: var(--success-color); }
            .score-medium { background: var(--warning-color); }
            .score-low { background: var(--danger-color); }

            /* Weekly Performance Table */
            .performance-section {
                margin-top: 1.5rem;
            }

            .performance-title {
                font-size: 1rem;
                font-weight: 700;
                color: var(--primary-color);
                margin-bottom: 1rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .performance-table-wrapper {
                background: var(--light-bg);
                border: 1px solid var(--border-color);
                border-radius: 12px;
                overflow: hidden;
            }

            .performance-table {
                width: 100%;
                border-collapse: collapse;
            }

            .performance-table th {
                background: white;
                padding: 0.75rem 1rem;
                text-align: left;
                font-size: 0.75rem;
                font-weight: 600;
                color: var(--text-secondary);
                text-transform: uppercase;
                letter-spacing: 0.05em;
                border-bottom: 1px solid var(--border-color);
            }

            .performance-table td {
                padding: 1rem;
                font-size: 0.875rem;
                color: var(--text-primary);
                border-bottom: 1px solid var(--border-color);
            }

            .performance-table tr:last-child td {
                border-bottom: none;
            }

            .performance-table tr:hover {
                background: rgba(249, 115, 22, 0.02);
            }

            .week-badge {
                background: var(--accent-gradient);
                color: white;
                padding: 0.25rem 0.75rem;
                border-radius: 8px;
                font-weight: 600;
                font-size: 0.75rem;
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

            /* CTA Section */
            .cta-section {
                text-align: center;
                margin-top: 3rem;
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

                .status-cards-grid {
                    grid-template-columns: 1fr;
                }

                .timeline {
                    padding-left: 2rem;
                }

                .timeline::before {
                    left: 1rem;
                }

                .timeline-marker {
                    left: -1rem;
                    width: 40px;
                    height: 40px;
                }

                .timeline-content {
                    padding: 1.5rem;
                }

                .timeline-header-content {
                    flex-direction: column;
                    gap: 0.5rem;
                }

                .timeline-footer {
                    flex-direction: column;
                    gap: 0.5rem;
                    align-items: start;
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

            /* Pulse Animation */
            .pulse {
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0% { opacity: 1; }
                50% { opacity: 0.7; }
                100% { opacity: 1; }
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
                <p style="color: #94a3b8; font-size: 0.875rem; margin-top: 0.5rem;">Loading your progress...</p>
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
                <h1 class="hero-title">
                    Application <span class="hero-gradient-text">Status</span>
                </h1>

                <div class="applicant-info">
                    <i class="fas fa-user-circle"></i>
                    {{ $pelamar->nama }}
                </div>

                <div class="application-id-badge">
                    <i class="fas fa-id-card mr-2"></i>
                    Application ID: {{ $pelamar->pelamar_id }}
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="main-content">
            <div class="container mx-auto px-6">
                <div class="max-w-6xl mx-auto">
                    <!-- Status Cards -->
                    <div class="status-cards-grid">
                        <!-- Application Status Card -->
                        <div class="status-card status-card-blue">
                            <div class="status-card-content">
                                <div class="status-icon-wrapper status-icon-blue">
                                    <i class="fas fa-clipboard-check status-icon"></i>
                                </div>
                                <div class="status-info">
                                    <h3>Application Status</h3>
                                    <p class="status-value">{{ $pelamar->status_seleksi }}</p>
                                    <span class="status-badge {{ $pelamar->status_seleksi === 'Pending' ? 'badge-pending' : ($pelamar->status_seleksi === 'Rejected' ? 'badge-rejected' : 'badge-accepted') }}">
                                        <i class="fas fa-circle" style="font-size: 0.5rem;"></i>
                                        {{ $pelamar->status_seleksi }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Position Applied Card -->
                        <div class="status-card status-card-green">
                            <div class="status-card-content">
                                <div class="status-icon-wrapper status-icon-green">
                                    <i class="fas fa-briefcase status-icon"></i>
                                </div>
                                <div class="status-info">
                                    <h3>Position Applied</h3>
                                    <p class="status-value">{{ $pelamar->job->nama_job }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $pelamar->periode->nama_periode }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Card -->
                        <div class="status-card status-card-purple">
                            <div class="status-card-content">
                                <div class="status-icon-wrapper status-icon-purple">
                                    <i class="fas fa-address-card status-icon"></i>
                                </div>
                                <div class="status-info">
                                    <h3>Contact Information</h3>
                                    <p class="text-sm text-gray-700 mt-1">
                                        <i class="fas fa-envelope text-purple-400 mr-2 text-xs"></i>{{ $pelamar->email }}
                                    </p>
                                    <p class="text-sm text-gray-700 mt-1">
                                        <i class="fab fa-whatsapp text-purple-400 mr-2 text-xs"></i>{{ $pelamar->nomor_wa }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Section -->
                    <div class="timeline-section">
                        <div class="timeline-header">
                            <div class="timeline-icon-wrapper">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <h2 class="timeline-title">Recruitment Progress Timeline</h2>
                        </div>

                        <div class="timeline">
                            <!-- Document Screening -->
                            @php
                                // Document screening is passed if the applicant has an interview, test or internship record
                                $documentPassed = $pelamar->interview || $pelamar->tesKemampuan || $pelamar->magang;
                                $documentRejected = $pelamar->status_seleksi === 'Rejected';
                                $documentPending = !$documentPassed && !$documentRejected;
                            @endphp

                            <div class="timeline-item">
                                <div class="timeline-marker {{ $documentPassed ? 'marker-success' : ($documentRejected ? 'marker-danger' : 'marker-warning') }}">
                                    @if($documentPassed)
                                        <i class="fas fa-check"></i>
                                    @elseif($documentRejected)
                                        <i class="fas fa-times"></i>
                                    @else
                                        <i class="fas fa-hourglass-half pulse"></i>
                                    @endif
                                </div>

                                <div class="timeline-content {{ $documentPassed ? 'timeline-content-success' : ($documentRejected ? 'timeline-content-danger' : 'timeline-content-warning') }}">
                                    <div class="timeline-header-content">
                                        <h4 class="timeline-stage-title">
                                            <i class="fas fa-file-alt {{ $documentPassed ? 'text-green-500' : ($documentRejected ? 'text-red-500' : 'text-yellow-500') }}"></i>
                                            Document Screening
                                        </h4>
                                        <span class="timeline-date">
                                            {{ $pelamar->created_at->format('d M Y') }}
                                        </span>
                                    </div>

                                    <p class="timeline-description">
                                        @if($documentPassed)
                                            Your application documents have passed our initial screening.
                                        @elseif($documentRejected)
                                            Your application did not match our requirements at this time.
                                        @else
                                            Your application documents are currently being reviewed.
                                        @endif
                                    </p>

                                    <div class="timeline-footer">
                                        <span class="timeline-status {{ $documentPassed ? 'badge-accepted' : ($documentRejected ? 'badge-rejected' : 'badge-pending') }}">
                                            {{ $documentPassed ? 'Passed' : ($documentRejected ? 'Rejected' : 'Pending') }}
                                        </span>

                                        @if(!$documentRejected)
                                            <span class="timeline-hint">
                                                {{ $documentPassed ? 'Moved to next stage' : 'Awaiting result' }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Interview -->
                            @if($pelamar->interview || $pelamar->tesKemampuan || $pelamar->magang)
                                @php
                                    // Interview is passed if the applicant has a test or internship record
                                    $interviewPassed = ($pelamar->interview && $pelamar->interview->hasil === 'Lulus') ||
                                                       $pelamar->tesKemampuan ||
                                                       $pelamar->magang;
                                    $interviewFailed = $pelamar->interview && $pelamar->interview->hasil === 'Gagal';
                                    $interviewPending = $pelamar->interview && !$interviewPassed && !$interviewFailed;
                                @endphp

                                <div class="timeline-item">
                                    <div class="timeline-marker {{ $interviewPassed ? 'marker-success' : ($interviewFailed ? 'marker-danger' : 'marker-primary') }}">
                                        @if($interviewPassed)
                                            <i class="fas fa-check"></i>
                                        @elseif($interviewFailed)
                                            <i class="fas fa-times"></i>
                                        @else
                                            <i class="fas fa-user-tie"></i>
                                        @endif
                                    </div>

                                    <div class="timeline-content {{ $interviewPassed ? 'timeline-content-success' : ($interviewFailed ? 'timeline-content-danger' : 'timeline-content-primary') }}">
                                        <div class="timeline-header-content">
                                            <h4 class="timeline-stage-title">
                                                <i class="fas fa-comments {{ $interviewPassed ? 'text-green-500' : ($interviewFailed ? 'text-red-500' : 'text-orange-500') }}"></i>
                                                Interview
                                            </h4>
                                            <span class="timeline-date">
                                                {{ $pelamar->interview && $pelamar->interview->tanggal_wawancara ? $pelamar->interview->tanggal_wawancara->format('d M Y') : 'Scheduled' }}
                                            </span>
                                        </div>

                                        <p class="timeline-description">
                                            @if($interviewPassed)
                                                You've successfully passed the interview stage.
                                            @elseif($interviewFailed)
                                                Thank you for your participation in the interview. Unfortunately, you did not meet our requirements at this stage.
                                            @elseif($pelamar->interview && $pelamar->interview->tanggal_wawancara && $pelamar->interview->tanggal_wawancara->isFuture())
                                                Your interview is scheduled for {{ $pelamar->interview->tanggal_wawancara->format('d M Y') }} at {{ $pelamar->interview->tanggal_wawancara->format('H:i') }}.
                                            @elseif($pelamar->interview && $pelamar->interview->tanggal_wawancara)
                                                Your interview was held on {{ $pelamar->interview->tanggal_wawancara->format('d M Y') }}. Results are being processed.
                                            @else
                                                Your interview is being scheduled. Please check back later.
                                            @endif
                                        </p>

                                        <div class="timeline-footer">
                                            <span class="timeline-status {{ $interviewPassed ? 'badge-accepted' : ($interviewFailed ? 'badge-rejected' : 'badge-pending') }}">
                                                {{ $interviewPassed ? 'Passed' : ($interviewFailed ? 'Failed' : 'In Progress') }}
                                            </span>

                                            @if(!$interviewFailed && $pelamar->interview && $pelamar->interview->tanggal_wawancara && $pelamar->interview->tanggal_wawancara->isFuture())
                                                <span class="timeline-hint">
                                                    <i class="far fa-clock mr-1"></i> Scheduled
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Skills Test -->
                            @if($pelamar->tesKemampuan || $pelamar->magang)
                                @php
                                    // Test is passed if the applicant has an internship record or has passed the test
                                    $testPassed = ($pelamar->tesKemampuan && $pelamar->tesKemampuan->hasil === 'Lulus') || $pelamar->magang;
                                    $testFailed = $pelamar->tesKemampuan && $pelamar->tesKemampuan->hasil === 'Gagal';
                                    $testPending = $pelamar->tesKemampuan && !$testPassed && !$testFailed;
                                @endphp

                                <div class="timeline-item">
                                    <div class="timeline-marker {{ $testPassed ? 'marker-success' : ($testFailed ? 'marker-danger' : 'marker-primary') }}">
                                        @if($testPassed)
                                            <i class="fas fa-check"></i>
                                        @elseif($testFailed)
                                            <i class="fas fa-times"></i>
                                        @else
                                            <i class="fas fa-clipboard-list"></i>
                                        @endif
                                    </div>

                                    <div class="timeline-content {{ $testPassed ? 'timeline-content-success' : ($testFailed ? 'timeline-content-danger' : 'timeline-content-primary') }}">
                                        <div class="timeline-header-content">
                                            <h4 class="timeline-stage-title">
                                                <i class="fas fa-tasks {{ $testPassed ? 'text-green-500' : ($testFailed ? 'text-red-500' : 'text-orange-500') }}"></i>
                                                Skills Test
                                            </h4>
                                            <span class="timeline-date">
                                                {{ $pelamar->tesKemampuan && $pelamar->tesKemampuan->tanggal_tes ? $pelamar->tesKemampuan->tanggal_tes->format('d M Y') : 'Scheduled' }}
                                            </span>
                                        </div>

                                        <p class="timeline-description">
                                            @if($testPassed && $pelamar->tesKemampuan)
                                                You've successfully passed the skills test.
                                            @elseif($testFailed && $pelamar->tesKemampuan)
                                                Thank you for taking the skills test. Unfortunately, your score did not meet our requirements.
                                            @elseif($pelamar->tesKemampuan && $pelamar->tesKemampuan->tanggal_tes && $pelamar->tesKemampuan->tanggal_tes->isFuture())
                                                Your skills test is scheduled for {{ $pelamar->tesKemampuan->tanggal_tes->format('d M Y') }}.
                                            @elseif($pelamar->tesKemampuan && $pelamar->tesKemampuan->tanggal_tes)
                                                Your skills test was held on {{ $pelamar->tesKemampuan->tanggal_tes->format('d M Y') }}. Results are being processed.
                                            @else
                                                Your skills test is being scheduled. Please check back later.
                                            @endif
                                        </p>

                                        @if($pelamar->tesKemampuan && $pelamar->tesKemampuan->nilai)
                                            <div class="score-section">
                                                <div class="score-label">
                                                    <span class="score-text">Test Score</span>
                                                    <span class="score-value">{{ $pelamar->tesKemampuan->nilai }}/100</span>
                                                </div>
                                                <div class="score-bar">
                                                    <div class="score-fill {{ $pelamar->tesKemampuan->nilai >= 80 ? 'score-high' : ($pelamar->tesKemampuan->nilai >= 60 ? 'score-medium' : 'score-low') }}"
                                                         style="width: {{ $pelamar->tesKemampuan->nilai }}%"></div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="timeline-footer">
                                            <span class="timeline-status {{ $testPassed ? 'badge-accepted' : ($testFailed ? 'badge-rejected' : 'badge-pending') }}">
                                                {{ $testPassed ? 'Passed' : ($testFailed ? 'Failed' : 'In Progress') }}
                                            </span>

                                            @if(!$testFailed && $pelamar->tesKemampuan && $pelamar->tesKemampuan->tanggal_tes && $pelamar->tesKemampuan->tanggal_tes->isFuture())
                                                <span class="timeline-hint">
                                                    <i class="far fa-clock mr-1"></i> Scheduled
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Internship -->
                            @if($pelamar->magang)
                                @php
                                    $isCompleted = $pelamar->magang->status_seleksi === 'Completed';
                                    $isTerminated = $pelamar->magang->status_seleksi === 'Terminated';
                                    $isActive = $pelamar->magang->status_seleksi === 'Active';
                                @endphp

                                <div class="timeline-item">
                                    <div class="timeline-marker {{ $isCompleted ? 'marker-success' : ($isTerminated ? 'marker-danger' : 'marker-primary') }}">
                                        @if($isCompleted)
                                            <i class="fas fa-check"></i>
                                        @elseif($isTerminated)
                                            <i class="fas fa-times"></i>
                                        @else
                                            <i class="fas fa-building"></i>
                                        @endif
                                    </div>

                                    <div class="timeline-content {{ $isCompleted ? 'timeline-content-success' : ($isTerminated ? 'timeline-content-danger' : 'timeline-content-primary') }}">
                                        <div class="timeline-header-content">
                                            <h4 class="timeline-stage-title">
                                                <i class="fas fa-graduation-cap {{ $isCompleted ? 'text-green-500' : ($isTerminated ? 'text-red-500' : 'text-orange-500') }}"></i>
                                                Internship
                                            </h4>
                                            <span class="timeline-date">
                                                {{ $pelamar->magang->jadwal_mulai ? $pelamar->magang->jadwal_mulai->format('d M Y') . ' - ' . ($pelamar->magang->tanggal_selesai ? $pelamar->magang->tanggal_selesai->format('d M Y') : 'Present') : 'Scheduled' }}
                                            </span>
                                        </div>

                                        <p class="timeline-description">
                                            @if($isCompleted)
                                                Congratulations! You've successfully completed the internship program.
                                            @elseif($isTerminated)
                                                Your internship was terminated before completion.
                                            @elseif($isActive)
                                                Your internship is currently active. Keep up the good work!
                                            @elseif($pelamar->magang->jadwal_mulai && $pelamar->magang->jadwal_mulai->isFuture())
                                                Your internship is scheduled to start on {{ $pelamar->magang->jadwal_mulai->format('d M Y') }}.
                                            @else
                                                Your internship details are being processed. Please check back later.
                                            @endif
                                        </p>

                                        <div class="timeline-footer">
                                            <span class="timeline-status {{ $isCompleted ? 'badge-accepted' : ($isTerminated ? 'badge-rejected' : 'badge-pending') }}">
                                                {{ $pelamar->magang->status_seleksi }}
                                            </span>

                                            @if($isActive)
                                                <span class="timeline-hint pulse">
                                                    <i class="fas fa-running mr-1"></i> In Progress
                                                </span>
                                            @endif
                                        </div>

                                        @if($pelamar->magang->evaluasiMingguan && $pelamar->magang->evaluasiMingguan->count() > 0 && $pelamar->magang->totalSkorMingguan)
                                            <div class="performance-section">
                                                <h5 class="performance-title">
                                                    <i class="fas fa-chart-line text-orange-500"></i>
                                                    Weekly Performance
                                                </h5>
                                                <div class="performance-table-wrapper">
                                                    <table class="performance-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Week</th>
                                                                <th>Date</th>
                                                                <th>Score</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                // Group evaluations by week to show one entry per week
                                                                $groupedEvals = $pelamar->magang->evaluasiMingguan->groupBy('minggu_ke');
                                                                $weeklyScores = $pelamar->magang->totalSkorMingguan;
                                                            @endphp

                                                            @foreach($groupedEvals as $week => $evals)
                                                                @php
                                                                    // Find the score for this week
                                                                    $weekScore = $weeklyScores->where('minggu_ke', $week)->first();
                                                                    $totalSkor = $weekScore ? $weekScore->total_skor : null;
                                                                @endphp
                                                                <tr>
                                                                    <td>
                                                                        <span class="week-badge">Week {{ $week }}</span>
                                                                    </td>
                                                                    <td>{{ $evals->first()->created_at->format('d M Y') }}</td>
                                                                    <td>
                                                                        <span class="timeline-status {{ $totalSkor >= 80 ? 'badge-accepted' : ($totalSkor >= 60 ? 'badge-pending' : ($totalSkor !== null ? 'badge-rejected' : 'badge-pending')) }}">
                                                                            {{ $totalSkor ?? 'Pending' }}
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- CTA Section -->
                    <div class="cta-section">
                        <a href="{{ route('applicant.progress.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i>
                            Back to All Periods
                        </a>
                    </div>
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

            // Parallax Effect for Hero Section
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.gradient-orb');

                parallaxElements.forEach((el, index) => {
                    const speed = 0.3 + (index * 0.1);
                    el.style.transform = `translateY(${scrolled * speed}px)`;
                });
            });

            // Animate score bars when visible
            const observerOptions = {
                threshold: 0.5,
                rootMargin: '0px'
            };

            const scoreObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const scoreFill = entry.target.querySelector('.score-fill');
                        if (scoreFill) {
                            const width = scoreFill.style.width;
                            scoreFill.style.width = '0';
                            setTimeout(() => {
                                scoreFill.style.width = width;
                            }, 100);
                        }
                        scoreObserver.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Observe all score sections
            document.querySelectorAll('.score-section').forEach(section => {
                scoreObserver.observe(section);
            });
        </script>
    </body>
</html>