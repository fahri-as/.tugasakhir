<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>JIWARAGA Careers | Shape Tomorrow's Culinary Excellence</title>

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

            /* Hero Section with Advanced Animations */
            .hero-section {
                min-height: 100vh;
                padding-top: 80px;
                background: url('/images/jiwaragabackground.png');
                background-size: cover;
                background-position: center;
                position: relative;
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Add dark overlay for better text visibility */
            .hero-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.7); /* Semi-transparent black overlay */
                z-index: 1;
            }

            .hero-content {
                position: relative;
                z-index: 2; /* Ensure content appears above the overlay */
                text-align: center;
                max-width: 1200px;
                padding: 2rem 2rem 0;
                animation: heroFadeIn 1.2s cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* Animated Background Grid */
            .hero-grid {
                position: absolute;
                width: 100%;
                height: 100%;
                z-index: 0;
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
                opacity: 0.4;
                z-index: 0;
                animation: orbFloat 20s ease-in-out infinite;
            }

            .orb-1 {
                width: 600px;
                height: 600px;
                background: radial-gradient(circle, rgba(249, 115, 22, 0.4) 0%, transparent 70%);
                top: -200px;
                left: -200px;
            }

            .orb-2 {
                width: 400px;
                height: 400px;
                background: radial-gradient(circle, rgba(251, 146, 60, 0.4) 0%, transparent 70%);
                bottom: -150px;
                right: -150px;
                animation-delay: -10s;
            }

            .orb-3 {
                width: 300px;
                height: 300px;
                background: radial-gradient(circle, rgba(254, 215, 170, 0.3) 0%, transparent 70%);
                top: 50%;
                left: 50%;
                animation-delay: -5s;
            }

            @keyframes orbFloat {
                0%, 100% { transform: translate(0, 0) scale(1); }
                25% { transform: translate(50px, -50px) scale(1.1); }
                50% { transform: translate(-30px, 30px) scale(0.9); }
                75% { transform: translate(30px, 50px) scale(1.05); }
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
                margin-top: 1rem;
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
                font-size: clamp(3rem, 6vw, 5rem);
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
                font-size: clamp(1.125rem, 2vw, 1.5rem);
                color: #94a3b8;
                margin-bottom: 3rem;
                line-height: 1.6;
                font-weight: 400;
            }

            /* Modern CTA Buttons */
            .cta-buttons {
                display: flex;
                gap: 1.5rem;
                flex-wrap: wrap;
                justify-content: center;
                margin-bottom: 5rem;
            }

            .btn {
                padding: 1rem 2.5rem;
                border-radius: 12px;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
                display: inline-flex;
                align-items: center;
                gap: 0.75rem;
                font-size: 1rem;
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
                color: white;
                border: 1px solid rgba(255, 255, 255, 0.2);
                backdrop-filter: blur(10px);
            }

            .btn-secondary:hover {
                background: rgba(255, 255, 255, 0.15);
                border-color: rgba(255, 255, 255, 0.3);
                transform: translateY(-2px);
            }

            .btn-success {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                color: white;
                box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);
            }

            .btn-success:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
            }

            /* 3D Stats Cards */
            .stats-container {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 2rem;
                margin-top: 4rem;
                margin-bottom: 3rem;
                perspective: 1000px;
            }

            .stat-card {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(50px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 24px;
                padding: 2.5rem;
                text-align: center;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                transform-style: preserve-3d;
                position: relative;
                overflow: hidden;
            }

            .stat-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: radial-gradient(circle at top right, rgba(249, 115, 22, 0.1), transparent 70%);
                opacity: 0;
                transition: opacity 0.4s ease;
            }

            .stat-card:hover {
                transform: translateY(-10px) rotateX(5deg);
                border-color: rgba(249, 115, 22, 0.3);
            }

            .stat-card:hover::before {
                opacity: 1;
            }

            .stat-icon {
                width: 60px;
                height: 60px;
                margin: 0 auto 1.5rem;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(249, 115, 22, 0.1);
                border-radius: 16px;
                font-size: 1.5rem;
                color: #fb923c;
            }

            .stat-number {
                font-size: 3rem;
                font-weight: 800;
                background: linear-gradient(135deg, #fb923c 0%, #f97316 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                margin-bottom: 0.5rem;
            }

            .stat-label {
                color: #94a3b8;
                font-size: 0.875rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            /* Features Section with Modern Cards */
            .features-section {
                padding: 8rem 0;
                background: white;
                position: relative;
                overflow: hidden;
            }

            .section-header {
                text-align: center;
                margin-bottom: 5rem;
                position: relative;
            }

            .section-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                background: rgba(249, 115, 22, 0.1);
                border: 1px solid rgba(249, 115, 22, 0.2);
                padding: 0.5rem 1.25rem;
                border-radius: 50px;
                margin-bottom: 1.5rem;
                font-size: 0.875rem;
                font-weight: 600;
                color: var(--accent-color);
            }

            .section-title {
                font-size: clamp(2.5rem, 4vw, 3.5rem);
                font-weight: 800;
                margin-bottom: 1rem;
                color: var(--primary-color);
                letter-spacing: -0.02em;
            }

            .section-subtitle {
                font-size: 1.25rem;
                color: var(--text-secondary);
                max-width: 600px;
                margin: 0 auto;
            }

            .features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: 2rem;
                max-width: 1200px;
                margin: 0 auto;
            }

            .feature-card {
                background: var(--card-bg);
                border: 1px solid var(--border-color);
                border-radius: 24px;
                padding: 3rem;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
                cursor: pointer;
            }

            .feature-card::before {
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

            .feature-card::after {
                content: '';
                position: absolute;
                inset: 1px;
                background: var(--card-bg);
                border-radius: 23px;
                z-index: -1;
            }

            .feature-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            }

            .feature-card:hover::before {
                opacity: 1;
            }

            .feature-icon-wrapper {
                width: 80px;
                height: 80px;
                margin-bottom: 2rem;
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .feature-icon-bg {
                position: absolute;
                width: 100%;
                height: 100%;
                background: var(--accent-gradient);
                border-radius: 20px;
                opacity: 0.1;
                transition: all 0.4s ease;
            }

            .feature-card:hover .feature-icon-bg {
                transform: rotate(45deg) scale(1.1);
                border-radius: 50%;
                opacity: 0.15;
            }

            .feature-icon {
                position: relative;
                font-size: 2rem;
                background: var(--accent-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .feature-title {
                font-size: 1.5rem;
                font-weight: 700;
                color: var(--primary-color);
                margin-bottom: 1rem;
            }

            .feature-description {
                color: var(--text-secondary);
                line-height: 1.8;
            }

            /* Interactive Timeline */
            .timeline-section {
                padding: 8rem 0;
                background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
                position: relative;
                overflow: hidden;
            }

            .timeline {
                position: relative;
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 2rem;
            }

            .timeline-line {
                position: absolute;
                width: 2px;
                background: linear-gradient(180deg, transparent, #e2e8f0, #e2e8f0, transparent);
                top: 0;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
            }

            .timeline-progress {
                position: absolute;
                width: 2px;
                background: var(--accent-gradient);
                top: 0;
                left: 50%;
                transform: translateX(-50%);
                height: 0;
                transition: height 0.6s ease;
            }

            .timeline-item {
                position: relative;
                width: 50%;
                padding: 2rem 3rem;
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .timeline-item.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .timeline-item:nth-child(odd) {
                left: 0;
                text-align: right;
                padding-right: 4rem;
            }

            .timeline-item:nth-child(even) {
                left: 50%;
                padding-left: 4rem;
            }

            .timeline-dot {
                position: absolute;
                width: 24px;
                height: 24px;
                background: white;
                border: 3px solid #e2e8f0;
                border-radius: 50%;
                top: 2rem;
                z-index: 2;
                transition: all 0.3s ease;
            }

            .timeline-item.active .timeline-dot {
                background: var(--accent-gradient);
                border-color: transparent;
                transform: scale(1.3);
                box-shadow: 0 0 0 8px rgba(249, 115, 22, 0.1);
            }

            .timeline-item:nth-child(odd) .timeline-dot {
                right: -12px;
            }

            .timeline-item:nth-child(even) .timeline-dot {
                left: -12px;
            }

            .timeline-content {
                background: white;
                border: 1px solid var(--border-color);
                padding: 2.5rem;
                border-radius: 20px;
                transition: all 0.4s ease;
                position: relative;
                overflow: hidden;
            }

            .timeline-content::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: var(--accent-gradient);
                transform: scaleX(0);
                transform-origin: left;
                transition: transform 0.4s ease;
            }

            .timeline-item:hover .timeline-content::before {
                transform: scaleX(1);
            }

            .timeline-content:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }

            .timeline-number {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                background: rgba(249, 115, 22, 0.1);
                color: var(--accent-color);
                font-weight: 700;
                border-radius: 12px;
                margin-bottom: 1rem;
            }

            /* Modern Form Section */
            .form-section {
                padding: 8rem 0;
                background: white;
                position: relative;
            }

            .form-container {
                max-width: 1000px;
                margin: 0 auto;
                background: white;
                border: 1px solid var(--border-color);
                border-radius: 24px;
                padding: 0;
                overflow: hidden;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            }

            .form-header {
                background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
                padding: 3rem;
                text-align: center;
                border-bottom: 1px solid var(--border-color);
            }

            .form-body {
                padding: 3rem;
            }

            .form-section-card {
                background: #f8fafc;
                border: 1px solid var(--border-color);
                border-radius: 16px;
                padding: 2rem;
                margin-bottom: 2rem;
                transition: all 0.3s ease;
            }

            .form-section-card:hover {
                background: #f1f5f9;
                border-color: rgba(249, 115, 22, 0.2);
            }

            .form-section-header {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 2rem;
            }

            .form-section-icon {
                width: 48px;
                height: 48px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: var(--accent-gradient);
                border-radius: 12px;
                color: white;
                font-size: 1.25rem;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 600;
                color: var(--primary-color);
                font-size: 0.875rem;
                letter-spacing: 0.025em;
            }

            .form-label-required {
                color: var(--danger-color);
                margin-left: 0.25rem;
            }

            .form-control {
                width: 100%;
                padding: 0.875rem 1rem;
                background: white;
                border: 1px solid var(--border-color);
                border-radius: 12px;
                color: var(--text-primary);
                transition: all 0.3s ease;
                font-size: 1rem;
            }

            .form-control:focus {
                outline: none;
                border-color: var(--accent-color);
                box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
            }

            .form-control:hover {
                border-color: #cbd5e1;
            }

            textarea.form-control {
                resize: vertical;
                min-height: 120px;
            }

            /* Modern File Upload */
            .file-upload-wrapper {
                position: relative;
                overflow: hidden;
            }

            .file-upload-input {
                position: absolute;
                opacity: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
            }

            .file-upload-label {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 3rem 2rem;
                background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
                border: 2px dashed var(--border-color);
                border-radius: 16px;
                cursor: pointer;
                transition: all 0.3s ease;
                text-align: center;
            }

            .file-upload-wrapper:hover .file-upload-label {
                background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
                border-color: var(--accent-color);
            }

            .file-upload-icon {
                width: 64px;
                height: 64px;
                margin-bottom: 1rem;
                display: flex;
                align-items: center;
                justify-content: center;
                background: white;
                border-radius: 16px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                color: var(--accent-color);
                font-size: 1.5rem;
            }

            .file-upload-text {
                font-weight: 600;
                color: var(--primary-color);
                margin-bottom: 0.5rem;
            }

            .file-upload-hint {
                font-size: 0.875rem;
                color: var(--text-secondary);
            }

            /* Enhanced Alerts */
            .alert {
                padding: 1rem 1.5rem;
                border-radius: 12px;
                margin-bottom: 2rem;
                display: flex;
                align-items: center;
                gap: 1rem;
                animation: slideDown 0.5s cubic-bezier(0.4, 0, 0.2, 1);
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
                background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.5), transparent);
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
                    font-size: clamp(2rem, 8vw, 3rem);
                }

                .cta-buttons {
                    flex-direction: column;
                    align-items: stretch;
                    gap: 1rem;
                }

                .stats-container {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 1rem;
                }

                .timeline-line,
                .timeline-progress {
                    left: 20px;
                }

                .timeline-item {
                    width: 100%;
                    padding-left: 60px;
                    text-align: left !important;
                }

                .timeline-item:nth-child(even) {
                    left: 0;
                }

                .timeline-dot {
                    left: 10px !important;
                    right: auto !important;
                }

                .form-container {
                    padding: 2rem 1.5rem;
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

            /* Hover Effects */
            .hover-lift {
                transition: transform 0.3s ease;
            }

            .hover-lift:hover {
                transform: translateY(-5px);
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
                <p style="color: #94a3b8; font-size: 0.875rem; margin-top: 0.5rem;">Loading amazing opportunities...</p>
            </div>
        </div>

        <!-- Modern Navbar -->
        <nav class="navbar" id="navbar">
            <div class="navbar-content">
                <div class="navbar-brand">JIWARAGA</div>

                <div class="navbar-menu">
                    <a href="#home" class="navbar-link">Home</a>
                    <a href="#features" class="navbar-link">Why Join Us</a>
                    <a href="#process" class="navbar-link">Process</a>

                    <a href="#application-form" class="btn btn-primary">Apply Now</a>
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
                <a href="#home" class="mobile-menu-link">Home</a>
                <a href="#features" class="mobile-menu-link">Why Join Us</a>
                <a href="#process" class="mobile-menu-link">Process</a>


                <a href="#application-form" class="btn btn-primary" style="text-align: center;">Apply Now</a>
            </div>
        </div>

        <!-- Hero Section -->
        <section id="home" class="hero-section">
            <div class="hero-grid"></div>
            <div class="gradient-orb orb-1"></div>
            <div class="gradient-orb orb-2"></div>
            <div class="gradient-orb orb-3"></div>

            <div class="hero-content">
                <div class="hero-badge">
                    <span class="hero-badge-text">🚀 NOW HIRING TOP TALENT</span>
                </div>

                <h1 class="hero-title">
                    Shape Tomorrow's<br>
                    <span class="hero-gradient-text">Culinary Excellence</span>
                </h1>

                <p class="hero-subtitle">
                    Join JIWARAGA's innovative team and build a career that blends tradition with modern culinary artistry. Be part of Indonesia's premier dining experience.
                </p>

                <div class="cta-buttons">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-chart-line"></i>
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-secondary">
                                <i class="fas fa-lock"></i>
                                Admin Portal
                            </a>
                        @endauth
                        <a href="{{ route('applicant.progress.index') }}" class="btn btn-success">
                            <i class="fas fa-clipboard-check"></i>
                            Track Application
                        </a>
                    @endif
                </div>

                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-number">40+</div>
                        <div class="stat-label">Team Members</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="stat-number">5+</div>
                        <div class="stat-label">Open Positions</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Satisfaction Rate</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-number">3+</div>
                        <div class="stat-label">Years Excellence</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="features-section">
            <div class="container mx-auto px-6">
                <div class="section-header fade-in-up">
                    <div class="section-badge">
                        <i class="fas fa-star"></i>
                        WHY JIWARAGA
                    </div>
                    <h2 class="section-title">Build Your Career With Industry Leaders</h2>
                    <p class="section-subtitle">Experience a workplace that values innovation, growth, and excellence in every aspect</p>
                </div>

                <div class="features-grid">
                    <div class="feature-card fade-in-up">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-bg"></div>
                            <i class="fas fa-rocket feature-icon"></i>
                        </div>
                        <h3 class="feature-title">Accelerated Growth</h3>
                        <p class="feature-description">Fast-track your career with our comprehensive development programs, mentorship opportunities, and clear advancement pathways designed for ambitious professionals.</p>
                    </div>

                    <div class="feature-card fade-in-up">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-bg"></div>
                            <i class="fas fa-hand-holding-heart feature-icon"></i>
                        </div>
                        <h3 class="feature-title">Premium Benefits</h3>
                        <p class="feature-description">Enjoy competitive compensation, comprehensive health coverage, performance bonuses, and exclusive perks that recognize your valuable contributions.</p>
                    </div>

                    <div class="feature-card fade-in-up">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-bg"></div>
                            <i class="fas fa-globe feature-icon"></i>
                        </div>
                        <h3 class="feature-title">Global Exposure</h3>
                        <p class="feature-description">Work with international culinary experts, participate in global food festivals, and gain exposure to world-class culinary techniques and innovations.</p>
                    </div>

                    <div class="feature-card fade-in-up">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-bg"></div>
                            <i class="fas fa-lightbulb feature-icon"></i>
                        </div>
                        <h3 class="feature-title">Innovation Hub</h3>
                        <p class="feature-description">Be part of a creative environment where your ideas matter. Contribute to menu development, explore new culinary concepts, and shape the future of dining.</p>
                    </div>

                    <div class="feature-card fade-in-up">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-bg"></div>
                            <i class="fas fa-balance-scale feature-icon"></i>
                        </div>
                        <h3 class="feature-title">Work-Life Harmony</h3>
                        <p class="feature-description">Maintain a healthy balance with flexible schedules, wellness programs, and policies that support your personal life and professional aspirations.</p>
                    </div>

                    <div class="feature-card fade-in-up">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-bg"></div>
                            <i class="fas fa-graduation-cap feature-icon"></i>
                        </div>
                        <h3 class="feature-title">Continuous Learning</h3>
                        <p class="feature-description">Access world-class training programs, workshops with renowned chefs, and educational opportunities to continuously enhance your culinary expertise.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Process Timeline -->
        <section id="process" class="timeline-section">
            <div class="container mx-auto px-6">
                <div class="section-header fade-in-up">
                    <div class="section-badge">
                        <i class="fas fa-route"></i>
                        HIRING PROCESS
                    </div>
                    <h2 class="section-title">Your Journey to Success</h2>
                    <p class="section-subtitle">A streamlined process designed to identify and nurture exceptional talent</p>
                </div>

                <div class="timeline">
                    <div class="timeline-line"></div>
                    <div class="timeline-progress" id="timelineProgress"></div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-number">01</div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Online Application</h3>
                            <p class="text-gray-600">Submit your profile through our advanced portal. Our AI-powered system ensures your application reaches the right team quickly.</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-number">02</div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Initial Assessment</h3>
                            <p class="text-gray-600">Our talent acquisition team reviews your qualifications and experience to ensure the perfect match for your skills.</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-number">03</div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Interview</h3>
                            <p class="text-gray-600">Showcase your expertise through comprehensive interviews designed to highlight your unique talents and potential.</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-number">04</div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Skills Test</h3>
                            <p class="text-gray-600">Demonstrate your practical abilities through hands-on assessments tailored to your specific role and expertise.</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-number">05</div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Internship</h3>
                            <p class="text-gray-600">Experience our work environment first-hand through a structured internship program to ensure mutual fit and accelerate your learning.</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-number">06</div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Welcome to JIWARAGA</h3>
                            <p class="text-gray-600">Begin your journey with our comprehensive onboarding program and become part of our exceptional culinary family.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Application Form Section -->
        <section id="application-form" class="form-section">
            <div class="container mx-auto px-6">
                <div class="section-header fade-in-up">
                    <div class="section-badge">
                        <i class="fas fa-file-alt"></i>
                        APPLICATION FORM
                    </div>
                    <h2 class="section-title">Start Your Journey Today</h2>
                    <p class="section-subtitle">Take the first step towards an extraordinary career</p>
                </div>

                <div class="form-container">
                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle text-xl"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-circle text-xl"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('pelamar.public.store') }}" method="POST" enctype="multipart/form-data" id="applicationForm">
                        @csrf

                        <div class="form-body">
                            <!-- Position Selection -->
                            <div class="form-section-card">
                                <div class="form-section-header">
                                    <div class="form-section-icon">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">Position Details</h3>
                                        <p class="text-sm text-gray-600">Select your desired role</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <label class="form-label" for="periode_id">
                                            Application Period
                                            <span class="form-label-required">*</span>
                                        </label>
                                        <select name="periode_id" id="periode_id" class="form-control" required>
                                            <option value="">Select Period</option>
                                            @php
                                                $activePeriodes = $periodes->filter(function($periode) {
                                                    return $periode->tanggal_selesai->greaterThanOrEqualTo(now()) &&
                                                           $periode->tanggal_mulai->lessThanOrEqualTo(now());
                                                })->sortByDesc('tanggal_mulai');
                                            @endphp
                                            @foreach($activePeriodes as $periode)
                                                <option value="{{ $periode->periode_id }}" {{ old('periode_id') == $periode->periode_id ? 'selected' : '' }}
                                                    data-jobs="{{ json_encode($periode->jobs) }}">
                                                    {{ $periode->nama_periode }} ({{ $periode->tanggal_mulai->format('d M Y') }} - {{ $periode->tanggal_selesai->format('d M Y') }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('periode_id')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="job_id">
                                            Position Applied
                                            <span class="form-label-required">*</span>
                                        </label>
                                        <select name="job_id" id="job_id" class="form-control" required disabled>
                                            <option value="">Select Period First</option>
                                        </select>
                                        @error('job_id')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Personal Information -->
                            <div class="form-section-card">
                                <div class="form-section-header">
                                    <div class="form-section-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">Personal Information</h3>
                                        <p class="text-sm text-gray-600">Tell us about yourself</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nama">
                                            Full Name
                                            <span class="form-label-required">*</span>
                                        </label>
                                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-control" required>
                                        @error('nama')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="email">
                                            Email Address
                                            <span class="form-label-required">*</span>
                                        </label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="nomor_wa">
                                            WhatsApp Number
                                            <span class="form-label-required">*</span>
                                        </label>
                                        <input type="text" name="nomor_wa" id="nomor_wa" value="{{ old('nomor_wa') }}" class="form-control" placeholder="+62" required>
                                        @error('nomor_wa')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="tgl_lahir">
                                            Date of Birth
                                            <span class="form-label-required">*</span>
                                        </label>
                                        <input type="date" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir') }}" class="form-control" required>
                                        @error('tgl_lahir')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group md:col-span-2">
                                        <label class="form-label" for="alamat">
                                            Address
                                            <span class="form-label-required">*</span>
                                        </label>
                                        <textarea name="alamat" id="alamat" rows="3" class="form-control" required>{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Professional Background -->
                            <div class="form-section-card">
                                <div class="form-section-header">
                                    <div class="form-section-icon">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">Professional Background</h3>
                                        <p class="text-sm text-gray-600">Your education and experience</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <label class="form-label" for="pendidikan">
                                            Education Level
                                            <span class="form-label-required">*</span>
                                        </label>
                                        <select name="pendidikan" id="pendidikan" class="form-control" required>
                                            <option value="">Select Education Level</option>
                                            <option value="SMA" {{ old('pendidikan') == 'SMA' ? 'selected' : '' }}>High School</option>
                                            <option value="D3" {{ old('pendidikan') == 'D3' ? 'selected' : '' }}>Diploma</option>
                                            <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>Bachelor's Degree</option>
                                            <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>Master's Degree</option>
                                            <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>Doctoral Degree</option>
                                        </select>
                                        @error('pendidikan')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="lama_pengalaman">
                                            Years of Experience
                                            <span class="form-label-required">*</span>
                                        </label>
                                        <input type="number" name="lama_pengalaman" id="lama_pengalaman" value="{{ old('lama_pengalaman', 0) }}" min="0" class="form-control" required>
                                        @error('lama_pengalaman')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="tempat_pengalaman">
                                            Previous Company
                                            <span class="form-label-required">*</span>
                                        </label>
                                        <input type="text" name="tempat_pengalaman" id="tempat_pengalaman" value="{{ old('tempat_pengalaman') }}" class="form-control" placeholder="Company Name" required>
                                        @error('tempat_pengalaman')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group md:col-span-2">
                                        <label class="form-label" for="deskripsi_tempat">
                                            Role Description
                                            <span class="form-label-required">*</span>
                                        </label>
                                        <textarea name="deskripsi_tempat" id="deskripsi_tempat" rows="4" class="form-control" placeholder="Describe your responsibilities and achievements..." required>{{ old('deskripsi_tempat') }}</textarea>
                                        @error('deskripsi_tempat')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Document Upload -->
                            <div class="form-section-card">
                                <div class="form-section-header">
                                    <div class="form-section-icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">Upload Resume</h3>
                                        <p class="text-sm text-gray-600">Share your professional journey</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="file-upload-wrapper">
                                        <input type="file" name="berkas_cv" id="berkas_cv" class="file-upload-input" accept=".pdf,.doc,.docx" required>
                                        <label for="berkas_cv" class="file-upload-label">
                                            <div class="file-upload-icon">
                                                <i class="fas fa-file-upload"></i>
                                            </div>
                                            <p class="file-upload-text">Click to upload or drag and drop</p>
                                            <p class="file-upload-hint">PDF, DOC, DOCX (Max 2MB)</p>
                                        </label>
                                    </div>
                                    @error('berkas_cv')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center mt-8">
                                <button type="submit" class="btn btn-primary px-12 py-4 text-lg" id="submitBtn">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Submit Application
                                </button>
                            </div>
                        </div>
                    </form>
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
                        <li><a href="#home" class="footer-link">Home</a></li>
                        <li><a href="#features" class="footer-link">Why Join Us</a></li>
                        <li><a href="#process" class="footer-link">Hiring Process</a></li>
                        <li><a href="#application-form" class="footer-link">Apply Now</a></li>
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
                }, 1500);
            });

            // Navbar Scroll Effect
            let lastScrollTop = 0;
            window.addEventListener('scroll', () => {
                const navbar = document.getElementById('navbar');
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }

                lastScrollTop = scrollTop;
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

            // Dynamic Job Selection
            const periodeSelect = document.getElementById('periode_id');
            const jobSelect = document.getElementById('job_id');

            periodeSelect.addEventListener('change', function() {
                jobSelect.innerHTML = '<option value="">Select Position</option>';

                if (this.value === '') {
                    jobSelect.disabled = true;
                    return;
                }

                const selectedOption = this.options[this.selectedIndex];
                const jobs = JSON.parse(selectedOption.getAttribute('data-jobs') || '[]');

                if (jobs && jobs.length > 0) {
                    jobs.forEach(job => {
                        const option = document.createElement('option');
                        option.value = job.job_id;
                        option.textContent = `${job.nama_job} - ${job.deskripsi || 'Available Position'}`;
                        jobSelect.appendChild(option);
                    });
                    jobSelect.disabled = false;
                } else {
                    jobSelect.innerHTML = '<option value="">No positions available</option>';
                    jobSelect.disabled = true;
                }
            });

            // File Upload Enhancement
            const fileInput = document.getElementById('berkas_cv');
            const fileLabel = document.querySelector('.file-upload-label');

            fileInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name || '';
                if (fileName) {
                    fileLabel.querySelector('.file-upload-text').textContent = fileName;
                    fileLabel.style.borderColor = 'var(--accent-color)';
                    fileLabel.style.background = 'rgba(249, 115, 22, 0.05)';
                }
            });

            // Form Submission
            const form = document.getElementById('applicationForm');
            const submitBtn = document.getElementById('submitBtn');

            form.addEventListener('submit', function(e) {
                submitBtn.innerHTML = '<span class="spinner"></span> Processing...';
                submitBtn.disabled = true;
                submitBtn.classList.add('loading');
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

                        // Timeline animation
                        if (entry.target.classList.contains('timeline-item')) {
                            const index = Array.from(entry.target.parentNode.children)
                                .filter(child => child.classList.contains('timeline-item'))
                                .indexOf(entry.target);
                            setTimeout(() => {
                                entry.target.classList.add('active');
                                updateTimelineProgress(index + 1);
                            }, index * 200);
                        }
                    }
                });
            }, observerOptions);

            // Apply observer to elements
            document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));
            document.querySelectorAll('.timeline-item').forEach(el => observer.observe(el));

            // Timeline Progress
            function updateTimelineProgress(activeItems) {
                const progress = document.getElementById('timelineProgress');
                const totalItems = document.querySelectorAll('.timeline-item').length;
                const percentage = (activeItems / totalItems) * 100;
                progress.style.height = `${percentage}%`;
            }

            // Smooth Scroll
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        const offset = 80;
                        const targetPosition = target.offsetTop - offset;
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Parallax Effect for Hero Section
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.gradient-orb');

                parallaxElements.forEach((el, index) => {
                    const speed = 0.5 + (index * 0.2);
                    el.style.transform = `translateY(${scrolled * speed}px)`;
                });
            });

            // Initialize animations on page load
            document.addEventListener('DOMContentLoaded', () => {
                // Trigger initial animations
                document.querySelectorAll('.stat-card').forEach((card, index) => {
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 100);
                });

                // Check if there are success or error messages and scroll to application form
                const hasFormMessages = document.querySelector('.alert-success, .alert-error');
                if (hasFormMessages) {
                    const formSection = document.getElementById('application-form');
                    if (formSection) {
                        const offset = 80;
                        const formPosition = formSection.offsetTop - offset;
                        window.scrollTo({
                            top: formPosition,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        </script>
    </body>
</html>
