<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>JIWARAGA - Career Portal | Shape Your Future</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=playfair-display:400,500,600,700,800|poppins:300,400,500,600,700" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --primary-gradient: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
                --secondary-gradient: linear-gradient(135deg, #f39c12 0%, #e74c3c 100%);
                --success-gradient: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
                --accent-color: #e67e22;
                --dark-accent: #d35400;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Poppins', sans-serif;
                overflow-x: hidden;
                background-color: #fff9f0;
                color: #444;
            }

            h1, h2, h3, h4, h5, h6 {
                font-family: 'Playfair Display', serif;
                font-weight: 700;
                color: #333;
            }

            /* Loading Animation */
            .page-loader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: #fff9f0;
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: opacity 0.5s ease-out;
            }

            .loader-content {
                text-align: center;
            }

            .loader-logo {
                width: 80px;
                height: 80px;
                margin: 0 auto 20px;
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0%, 100% { transform: scale(1); opacity: 1; }
                50% { transform: scale(1.1); opacity: 0.8; }
            }

            /* Navbar */
            .navbar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1000;
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(10px);
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .navbar.scrolled {
                background: rgba(255, 255, 255, 0.95);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            /* Hero Section */
            .hero-section {
                min-height: 100vh;
                padding-top: 80px;
                background: linear-gradient(135deg, rgba(255, 245, 230, 0.9) 0%, rgba(255, 252, 245, 0.9) 100%), url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
                background-size: cover;
                background-position: center;
                position: relative;
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .hero-bg-pattern {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image:
                    radial-gradient(circle at 20% 50%, rgba(230, 126, 34, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(243, 156, 18, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 40% 80%, rgba(211, 84, 0, 0.1) 0%, transparent 50%);
                animation: floatPattern 20s ease-in-out infinite;
            }

            @keyframes floatPattern {
                0%, 100% { transform: translate(0, 0) rotate(0deg); }
                33% { transform: translate(-20px, -20px) rotate(1deg); }
                66% { transform: translate(20px, -10px) rotate(-1deg); }
            }

            .floating-shapes {
                position: absolute;
                width: 100%;
                height: 100%;
                overflow: hidden;
            }

            .shape {
                position: absolute;
                background: linear-gradient(135deg, rgba(230, 126, 34, 0.1) 0%, rgba(211, 84, 0, 0.1) 100%);
                border-radius: 50%;
                animation: float 20s infinite ease-in-out;
            }

            .shape:nth-child(1) {
                width: 300px;
                height: 300px;
                top: -150px;
                left: -150px;
                animation-delay: 0s;
            }

            .shape:nth-child(2) {
                width: 200px;
                height: 200px;
                top: 50%;
                right: -100px;
                animation-delay: 5s;
            }

            .shape:nth-child(3) {
                width: 150px;
                height: 150px;
                bottom: -75px;
                left: 30%;
                animation-delay: 10s;
            }

            @keyframes float {
                0%, 100% { transform: translate(0, 0) rotate(0deg); }
                25% { transform: translate(30px, -30px) rotate(90deg); }
                50% { transform: translate(-20px, 20px) rotate(180deg); }
                75% { transform: translate(40px, 10px) rotate(270deg); }
            }

            .hero-content {
                position: relative;
                z-index: 10;
                text-align: center;
                max-width: 900px;
                padding: 0 20px;
                animation: fadeInUp 1s ease-out;
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

            .hero-title {
                font-size: clamp(2.5rem, 5vw, 4.5rem);
                font-weight: 800;
                margin-bottom: 1.5rem;
                background: var(--primary-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                line-height: 1.2;
            }

            .hero-subtitle {
                font-size: clamp(1.1rem, 2vw, 1.5rem);
                color: #555;
                margin-bottom: 3rem;
                line-height: 1.6;
            }

            .cta-buttons {
                display: flex;
                gap: 1.5rem;
                flex-wrap: wrap;
                justify-content: center;
                margin-bottom: 4rem;
            }

            .btn {
                padding: 1rem 2rem;
                border-radius: 12px;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            }

            .btn-primary {
                background: var(--primary-gradient);
                color: white;
                box-shadow: 0 5px 15px rgba(230, 126, 34, 0.3);
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(230, 126, 34, 0.4);
            }

            .btn-secondary {
                background: rgba(255, 255, 255, 0.8);
                color: #e67e22;
                border: 2px solid rgba(230, 126, 34, 0.3);
            }

            .btn-secondary:hover {
                background: rgba(255, 255, 255, 1);
                border-color: rgba(230, 126, 34, 0.5);
                transform: translateY(-2px);
            }

            .btn-success {
                background: var(--success-gradient);
                color: white;
                box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
            }

            .btn-success:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(46, 204, 113, 0.4);
            }

            /* Stats Section */
            .stats-container {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 2rem;
                margin-top: 4rem;
            }

            .stat-card {
                background: #fff;
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 16px;
                padding: 2rem;
                text-align: center;
                transition: all 0.3s ease;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            }

            .stat-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                border-color: rgba(230, 126, 34, 0.3);
            }

            .stat-number {
                font-size: 2.5rem;
                font-weight: 800;
                background: var(--primary-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            /* Features Section */
            .features-section {
                padding: 6rem 0;
                background: #fff;
                position: relative;
            }

            .section-header {
                text-align: center;
                margin-bottom: 4rem;
            }

            .section-title {
                font-size: clamp(2rem, 4vw, 3rem);
                font-weight: 800;
                margin-bottom: 1rem;
                background: var(--primary-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .section-subtitle {
                font-size: 1.2rem;
                color: #777;
            }

            .features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 2rem;
                max-width: 1200px;
                margin: 0 auto;
            }

            .feature-card {
                background: #fff;
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 20px;
                padding: 2.5rem;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            }

            .feature-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: var(--primary-gradient);
                transform: scaleX(0);
                transition: transform 0.3s ease;
            }

            .feature-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
                border-color: rgba(230, 126, 34, 0.3);
            }

            .feature-card:hover::before {
                transform: scaleX(1);
            }

            .feature-icon {
                width: 70px;
                height: 70px;
                margin-bottom: 1.5rem;
                position: relative;
            }

            .feature-icon-bg {
                position: absolute;
                width: 100%;
                height: 100%;
                background: var(--primary-gradient);
                border-radius: 20px;
                opacity: 0.1;
                transition: all 0.3s ease;
            }

            .feature-card:hover .feature-icon-bg {
                transform: rotate(45deg);
                border-radius: 50%;
            }

            .feature-icon i {
                position: relative;
                font-size: 2rem;
                background: var(--primary-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                height: 100%;
            }

            /* Process Timeline */
            .timeline-section {
                padding: 6rem 0;
                background: #fff9f0;
            }

            .timeline {
                position: relative;
                max-width: 1200px;
                margin: 0 auto;
            }

            .timeline::after {
                content: '';
                position: absolute;
                width: 2px;
                background: rgba(230, 126, 34, 0.3);
                top: 0;
                bottom: 0;
                left: 50%;
                margin-left: -1px;
            }

            .timeline-item {
                padding: 10px 40px;
                position: relative;
                width: 50%;
                opacity: 0;
                animation: fadeInTimeline 0.8s ease-out forwards;
            }

            .timeline-item:nth-child(1) { animation-delay: 0.1s; }
            .timeline-item:nth-child(2) { animation-delay: 0.2s; }
            .timeline-item:nth-child(3) { animation-delay: 0.3s; }
            .timeline-item:nth-child(4) { animation-delay: 0.4s; }

            @keyframes fadeInTimeline {
                to {
                    opacity: 1;
                }
            }

            .timeline-item:nth-child(odd) {
                left: 0;
                text-align: right;
                padding-right: 70px;
            }

            .timeline-item:nth-child(even) {
                left: 50%;
                text-align: left;
                padding-left: 70px;
            }

            .timeline-dot {
                position: absolute;
                width: 20px;
                height: 20px;
                background: var(--primary-gradient);
                border-radius: 50%;
                top: 20px;
                z-index: 1;
            }

            .timeline-item:nth-child(odd) .timeline-dot {
                right: -10px;
            }

            .timeline-item:nth-child(even) .timeline-dot {
                left: -10px;
            }

            .timeline-content {
                background: #fff;
                border: 1px solid rgba(0, 0, 0, 0.1);
                padding: 1.5rem;
                border-radius: 16px;
                transition: all 0.3s ease;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            }

            .timeline-content:hover {
                transform: scale(1.05);
                background: #fff;
                border-color: rgba(230, 126, 34, 0.3);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }

            /* Application Form Section */
            .form-section {
                padding: 6rem 0;
                background: linear-gradient(135deg, rgba(255, 245, 230, 0.9) 0%, rgba(255, 252, 245, 0.9) 100%), url('https://images.unsplash.com/photo-1552566626-52f8b828add9?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
                background-size: cover;
                background-position: center;
                position: relative;
            }

            .form-container {
                max-width: 1000px;
                margin: 0 auto;
                background: #fff;
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 24px;
                padding: 3rem;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            }

            .form-section-card {
                background: #f9f9f9;
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 16px;
                padding: 2rem;
                margin-bottom: 2rem;
                transition: all 0.3s ease;
            }

            .form-section-card:hover {
                background: #fff;
                border-color: rgba(230, 126, 34, 0.3);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            }

            .form-section-header {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                margin-bottom: 1.5rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }

            .form-section-icon {
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(230, 126, 34, 0.1);
                border-radius: 12px;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 500;
                color: #555;
                font-size: 0.9rem;
            }

            .form-control {
                width: 100%;
                padding: 0.75rem 1rem;
                background: #fff;
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                color: #444;
                transition: all 0.3s ease;
                font-size: 1rem;
            }

            .form-control:focus {
                outline: none;
                border-color: rgba(230, 126, 34, 0.5);
                box-shadow: 0 0 0 3px rgba(230, 126, 34, 0.1);
            }

            .form-control option {
                background: #fff;
                color: #444;
            }

            textarea.form-control {
                resize: vertical;
                min-height: 100px;
            }

            .file-input {
                position: relative;
                display: inline-block;
                cursor: pointer;
                width: 100%;
            }

            .file-input input[type="file"] {
                position: absolute;
                opacity: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
            }

            .file-input-label {
                display: flex;
                align-items: center;
                gap: 1rem;
                padding: 1rem;
                background: rgba(230, 126, 34, 0.05);
                border: 2px dashed rgba(230, 126, 34, 0.2);
                border-radius: 12px;
                transition: all 0.3s ease;
            }

            .file-input:hover .file-input-label {
                background: rgba(230, 126, 34, 0.1);
                border-color: rgba(230, 126, 34, 0.3);
            }

            .alert {
                padding: 1rem 1.5rem;
                border-radius: 12px;
                margin-bottom: 2rem;
                display: flex;
                align-items: center;
                gap: 1rem;
                animation: slideInDown 0.5s ease-out;
            }

            @keyframes slideInDown {
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
                background: rgba(46, 204, 113, 0.1);
                border: 1px solid rgba(46, 204, 113, 0.3);
                color: #27ae60;
            }

            .alert-error {
                background: rgba(231, 76, 60, 0.1);
                border: 1px solid rgba(231, 76, 60, 0.3);
                color: #e74c3c;
            }

            /* Footer */
            .footer {
                background: #fff9f0;
                padding: 4rem 0 2rem;
                border-top: 1px solid rgba(0, 0, 0, 0.1);
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
                font-size: 1.8rem;
                margin-bottom: 1rem;
                background: var(--primary-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .social-links {
                display: flex;
                gap: 1rem;
                margin-top: 1.5rem;
            }

            .social-link {
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #fff;
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                color: #777;
                transition: all 0.3s ease;
            }

            .social-link:hover {
                background: var(--primary-gradient);
                border-color: transparent;
                color: white;
                transform: translateY(-3px);
            }

            /* Responsive */
            @media (max-width: 768px) {
                .timeline::after {
                    left: 31px;
                }

                .timeline-item {
                    width: 100%;
                    padding-left: 70px;
                    padding-right: 25px;
                    text-align: left !important;
                }

                .timeline-item:nth-child(even) {
                    left: 0;
                }

                .timeline-dot {
                    left: 21px !important;
                    right: auto !important;
                }

                .cta-buttons {
                    flex-direction: column;
                    align-items: stretch;
                }

                .stats-container {
                    grid-template-columns: 1fr;
                }
            }

            /* Smooth Scroll */
            html {
                scroll-behavior: smooth;
            }

            /* Custom Scrollbar */
            ::-webkit-scrollbar {
                width: 10px;
            }

            ::-webkit-scrollbar-track {
                background: #f5f5f5;
            }

            ::-webkit-scrollbar-thumb {
                background: rgba(230, 126, 34, 0.5);
                border-radius: 5px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: rgba(230, 126, 34, 0.7);
            }
        </style>
    </head>
    <body>
        <!-- Page Loader -->
        <div class="page-loader" id="pageLoader">
            <div class="loader-content">
                <div class="loader-logo">
                    <i class="fas fa-utensils fa-3x" style="background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                </div>
                <h3 style="color: #e67e22;">JIWARAGA</h3>
            </div>
        </div>

        <!-- Navbar -->
        <nav class="navbar" id="navbar">
            <div class="container mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <div class="text-2xl font-bold">
                        <span style="background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">JIWARAGA</span>
                    </div>
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#home" class="text-gray-700 hover:text-orange-500 transition">Home</a>
                        <a href="#features" class="text-gray-700 hover:text-orange-500 transition">Why Join Us</a>
                        <a href="#process" class="text-gray-700 hover:text-orange-500 transition">Process</a>
                        <a href="#application-form" class="text-gray-700 hover:text-orange-500 transition">Apply Now</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="home" class="hero-section">
            <div class="hero-bg-pattern"></div>
            <div class="floating-shapes">
                <div class="shape"></div>
                <div class="shape"></div>
                <div class="shape"></div>
            </div>

            <div class="hero-content">
                <h1 class="hero-title">Shape Your Future With JIWARAGA</h1>
                <p class="hero-subtitle">Join our culinary team and build a career in authentic Indonesian cuisine. Discover opportunities that match your passion and skills in our growing restaurant.</p>

                <div class="cta-buttons">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-tachometer-alt"></i>
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-secondary">
                                <i class="fas fa-user-shield"></i>
                                Admin Portal
                            </a>
                        @endauth
                        <a href="{{ route('applicant.progress.index') }}" class="btn btn-success">
                            <i class="fas fa-search-location"></i>
                            Track Application
                        </a>
                    @endif
                </div>

                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-number">50+</div>
                        <p class="text-gray-600">Team Members</p>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">10+</div>
                        <p class="text-gray-600">Open Positions</p>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">95%</div>
                        <p class="text-gray-600">Employee Satisfaction</p>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">5+</div>
                        <p class="text-gray-600">Years of Excellence</p>
                    </div>
                </div>

                <div class="mt-12 animate-bounce">
                    <a href="#features" class="text-gray-600 hover:text-orange-500 transition">
                        <i class="fas fa-chevron-down text-2xl"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="features-section">
            <div class="container mx-auto px-6">
                <div class="section-header">
                    <h2 class="section-title">Why Join JIWARAGA?</h2>
                    <p class="section-subtitle">Experience a workplace that values growth, culinary innovation, and well-being</p>
                </div>

                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <div class="feature-icon-bg"></div>
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Career Growth</h3>
                        <p class="text-gray-600">Accelerate your culinary career with mentorship programs, training opportunities, and clear advancement paths from line cook to chef.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <div class="feature-icon-bg"></div>
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Collaborative Culture</h3>
                        <p class="text-gray-600">Work alongside passionate food enthusiasts in an inclusive kitchen environment that celebrates diversity and fosters culinary innovation.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <div class="feature-icon-bg"></div>
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Work-Life Balance</h3>
                        <p class="text-gray-600">Enjoy flexible scheduling options, wellness programs, and policies that support your personal life beyond the restaurant.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <div class="feature-icon-bg"></div>
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Culinary Innovation</h3>
                        <p class="text-gray-600">Express your creativity with opportunities to contribute to menu development and learn authentic Indonesian cooking techniques.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <div class="feature-icon-bg"></div>
                            <i class="fas fa-medal"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Competitive Benefits</h3>
                        <p class="text-gray-600">Receive competitive wages, meal benefits, health insurance options, and performance incentives as part of our team.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <div class="feature-icon-bg"></div>
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Learning Opportunities</h3>
                        <p class="text-gray-600">Expand your culinary knowledge through regular workshops, training sessions, and cultural immersion in Indonesian cuisine.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Process Timeline -->
        <section id="process" class="timeline-section">
            <div class="container mx-auto px-6">
                <div class="section-header">
                    <h2 class="section-title">Our Hiring Process</h2>
                    <p class="section-subtitle">Simple, transparent, and designed to find the perfect match</p>
                </div>

                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">1. Apply Online</h3>
                            <p class="text-gray-600">Submit your application through our easy-to-use online portal</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">2. Initial Screening</h3>
                            <p class="text-gray-600">Our team reviews your application and qualifications</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">3. Interview Process</h3>
                            <p class="text-gray-600">Meet with our team to discuss your experience and aspirations</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">4. Welcome Aboard!</h3>
                            <p class="text-gray-600">Join our team and start your exciting journey with JIWARAGA</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Application Form Section -->
        <section id="application-form" class="form-section">
            <div class="container mx-auto px-6">
                <div class="section-header">
                    <h2 class="section-title">Start Your Journey Today</h2>
                    <p class="section-subtitle">Fill out the form below to apply for your dream position</p>
                </div>

                <div class="form-container">
                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('pelamar.public.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Application Details -->
                        <div class="form-section-card">
                            <div class="form-section-header">
                                <div class="form-section-icon">
                                    <i class="fas fa-clipboard-list text-orange-500"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Application Details</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="form-group">
                                    <label class="form-label" for="periode_id">Application Period</label>
                                    <select name="periode_id" id="periode_id" class="form-control" required>
                                        <option value="">Select Period</option>
                                        @php
                                            $activePeriodes = $periodes->filter(function($periode) {
                                                return $periode->tanggal_selesai->greaterThanOrEqualTo(now());
                                            })->sortByDesc('tanggal_mulai');
                                        @endphp
                                        @foreach($activePeriodes as $periode)
                                            <option value="{{ $periode->periode_id }}" {{ old('periode_id') == $periode->periode_id ? 'selected' :                                            '' }}
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
                                    <label class="form-label" for="job_id">Position Applied</label>
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
                                    <i class="fas fa-user text-green-500"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Personal Information</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="form-group">
                                    <label class="form-label" for="nama">Full Name</label>
                                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-control" required>
                                    @error('nama')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="email">Email Address</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="nomor_wa">WhatsApp Number</label>
                                    <input type="text" name="nomor_wa" id="nomor_wa" value="{{ old('nomor_wa') }}" class="form-control" placeholder="+62" required>
                                    @error('nomor_wa')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="tgl_lahir">Date of Birth</label>
                                    <input type="date" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir') }}" class="form-control" required>
                                    @error('tgl_lahir')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group md:col-span-2">
                                    <label class="form-label" for="alamat">Address</label>
                                    <textarea name="alamat" id="alamat" rows="3" class="form-control" required>{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Education & Experience -->
                        <div class="form-section-card">
                            <div class="form-section-header">
                                <div class="form-section-icon">
                                    <i class="fas fa-graduation-cap text-purple-500"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Education & Experience</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="form-group">
                                    <label class="form-label" for="pendidikan">Education Level</label>
                                    <select name="pendidikan" id="pendidikan" class="form-control" required>
                                        <option value="">Select Education Level</option>
                                        <option value="SMA" {{ old('pendidikan') == 'SMA' ? 'selected' : '' }}>SMA/SMK</option>
                                        <option value="D3" {{ old('pendidikan') == 'D3' ? 'selected' : '' }}>D3</option>
                                        <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                                    </select>
                                    @error('pendidikan')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="lama_pengalaman">Years of Experience</label>
                                    <input type="number" name="lama_pengalaman" id="lama_pengalaman" value="{{ old('lama_pengalaman', 0) }}" min="0" class="form-control" required>
                                    @error('lama_pengalaman')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="tempat_pengalaman">Previous Workplace</label>
                                    <input type="text" name="tempat_pengalaman" id="tempat_pengalaman" value="{{ old('tempat_pengalaman') }}" class="form-control" placeholder="Restaurant/Company Name" required>
                                    @error('tempat_pengalaman')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group md:col-span-2">
                                    <label class="form-label" for="deskripsi_tempat">Job Description at Previous Workplace</label>
                                    <textarea name="deskripsi_tempat" id="deskripsi_tempat" rows="4" class="form-control" placeholder="Describe your role, responsibilities, and culinary experience..." required>{{ old('deskripsi_tempat') }}</textarea>
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
                                    <i class="fas fa-file-upload text-orange-500"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Document Upload</h3>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="berkas_cv">Upload Your CV</label>
                                <div class="file-input">
                                    <input type="file" name="berkas_cv" id="berkas_cv" accept=".pdf,.doc,.docx" required>
                                    <label for="berkas_cv" class="file-input-label">
                                        <i class="fas fa-cloud-upload-alt text-2xl text-orange-500"></i>
                                        <div>
                                            <p class="font-semibold text-gray-800">Click to upload or drag and drop</p>
                                            <p class="text-sm text-gray-600">PDF, DOC, DOCX (Max 500KB)</p>
                                        </div>
                                    </label>
                                </div>
                                @error('berkas_cv')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center mt-8">
                            <button type="submit" class="btn btn-primary px-8 py-3 text-lg">
                                <i class="fas fa-paper-plane"></i>
                                Submit Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-brand">
                    <h3>JIWARAGA</h3>
                    <p class="text-gray-600 mt-2">Building careers in authentic Indonesian cuisine</p>
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

                <div>
                    <h4 class="text-gray-800 font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-600 hover:text-orange-500 transition">Home</a></li>
                        <li><a href="#features" class="text-gray-600 hover:text-orange-500 transition">Why Join Us</a></li>
                        <li><a href="#process" class="text-gray-600 hover:text-orange-500 transition">Process</a></li>
                        <li><a href="#application-form" class="text-gray-600 hover:text-orange-500 transition">Apply Now</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-gray-800 font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('applicant.progress.index') }}" class="text-gray-600 hover:text-orange-500 transition">Track Application</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-orange-500 transition">Career Tips</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-orange-500 transition">FAQ</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-orange-500 transition">Contact Us</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-gray-800 font-semibold mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center gap-2">
                            <i class="fas fa-envelope"></i>
                            careers@jiwaraga.com
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-phone"></i>
                            +62 21 1234 5678
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-map-marker-alt"></i>
                            Jakarta, Indonesia
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-200 mt-8 pt-8 text-center text-gray-600">
                <p>&copy; {{ date('Y') }} JIWARAGA Restaurant. All rights reserved.</p>
            </div>
        </footer>

        <script>
            // Page Loader
            window.addEventListener('load', () => {
                setTimeout(() => {
                    document.getElementById('pageLoader').style.opacity = '0';
                    setTimeout(() => {
                        document.getElementById('pageLoader').style.display = 'none';
                    }, 500);
                }, 1000);
            });

            // Navbar Scroll Effect
            window.addEventListener('scroll', () => {
                const navbar = document.getElementById('navbar');
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Period and Job Selection
            document.addEventListener('DOMContentLoaded', function() {
                const periodeSelect = document.getElementById('periode_id');
                const jobSelect = document.getElementById('job_id');
                const fileInput = document.getElementById('berkas_cv');
                const fileLabel = fileInput.nextElementSibling;

                // Initialize jobs if periode is already selected
                if (periodeSelect.value) {
                    updateJobOptions();
                }

                periodeSelect.addEventListener('change', updateJobOptions);

                function updateJobOptions() {
                    jobSelect.innerHTML = '<option value="">Select Position</option>';

                    if (periodeSelect.value === '') {
                        jobSelect.disabled = true;
                        return;
                    }

                    const selectedOption = periodeSelect.options[periodeSelect.selectedIndex];
                    const jobs = JSON.parse(selectedOption.getAttribute('data-jobs') || '[]');

                    if (jobs && jobs.length > 0) {
                        jobs.forEach(job => {
                            const option = document.createElement('option');
                            option.value = job.job_id;
                            option.textContent = `${job.nama_job} - ${job.deskripsi || ''}`;

                            if (job.job_id === '{{ old("job_id") }}') {
                                option.selected = true;
                            }

                            jobSelect.appendChild(option);
                        });

                        jobSelect.disabled = false;
                    } else {
                        const option = document.createElement('option');
                        option.value = '';
                        option.textContent = 'No positions available for this period';
                        jobSelect.appendChild(option);
                        jobSelect.disabled = true;
                    }
                }

                // File Input Enhancement
                fileInput.addEventListener('change', function(e) {
                    const fileName = e.target.files[0]?.name || '';
                    if (fileName) {
                        fileLabel.querySelector('p.font-semibold').textContent = fileName;
                        fileLabel.style.borderColor = 'rgba(230, 126, 34, 0.5)';
                        fileLabel.style.background = 'rgba(230, 126, 34, 0.15)';
                    }
                });

                // Smooth Scroll for Anchor Links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
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
                            entry.target.classList.add('animate-in');
                        }
                    });
                }, observerOptions);

                // Observe all feature cards and timeline items
                document.querySelectorAll('.feature-card, .timeline-item').forEach(el => {
                    observer.observe(el);
                });
            });

            // Form Validation Enhancement
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                submitBtn.disabled = true;
            });
        </script>
    </body>
</html>