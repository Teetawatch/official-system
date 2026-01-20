<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="เข้าสู่ระบบฝึกพิมพ์หนังสือราชการ พัฒนาทักษะการพิมพ์ที่ถูกต้อง แม่นยำ และรวดเร็ว">
    
    <title>เข้าสู่ระบบ - ระบบวิชาพิมพ์หนังสือราชการ 1</title>
    
    <!-- Google Font: Kanit + Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary: #8b5cf6;
            --accent: #ec4899;
            --bg-light: #f8fafc;
            --bg-dark: #0f172a;
            --glass-bg: rgba(255, 255, 255, 0.75);
            --glass-border: rgba(255, 255, 255, 0.4);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            font-family: 'Kanit', 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            padding: 1rem;
        }

        /* Animated Background */
        .bg-animated {
            position: fixed;
            inset: 0;
            z-index: 0;
            background: linear-gradient(-45deg, #667eea, #764ba2, #6366f1, #8b5cf6);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Floating Particles */
        .particles {
            position: fixed;
            inset: 0;
            z-index: 1;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatParticle 20s infinite linear;
        }

        .particle:nth-child(1) { left: 10%; animation-delay: 0s; width: 20px; height: 20px; }
        .particle:nth-child(2) { left: 20%; animation-delay: 2s; width: 15px; height: 15px; }
        .particle:nth-child(3) { left: 35%; animation-delay: 4s; width: 25px; height: 25px; }
        .particle:nth-child(4) { left: 50%; animation-delay: 0s; width: 18px; height: 18px; }
        .particle:nth-child(5) { left: 65%; animation-delay: 3s; width: 12px; height: 12px; }
        .particle:nth-child(6) { left: 75%; animation-delay: 5s; width: 22px; height: 22px; }
        .particle:nth-child(7) { left: 85%; animation-delay: 1s; width: 16px; height: 16px; }
        .particle:nth-child(8) { left: 90%; animation-delay: 6s; width: 14px; height: 14px; }

        @keyframes floatParticle {
            0% { 
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% { opacity: 0.6; }
            90% { opacity: 0.6; }
            100% { 
                transform: translateY(-100vh) rotate(720deg);
                opacity: 0;
            }
        }

        /* Glowing Orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.5;
            animation: orbFloat 10s infinite ease-in-out alternate;
        }

        .orb-1 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #ec4899, #8b5cf6);
            top: -150px;
            left: -150px;
        }

        .orb-2 {
            width: 350px;
            height: 350px;
            background: linear-gradient(135deg, #06b6d4, #3b82f6);
            bottom: -100px;
            right: -100px;
            animation-delay: -5s;
        }

        .orb-3 {
            width: 250px;
            height: 250px;
            background: linear-gradient(135deg, #f59e0b, #ef4444);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -2.5s;
        }

        @keyframes orbFloat {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(30px, -30px) scale(1.1); }
        }

        /* Login Container */
        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 1050px;
            display: flex;
            border-radius: 2rem;
            overflow: hidden;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: 
                0 25px 50px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 0 rgba(255, 255, 255, 0.2);
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            0% { 
                opacity: 0;
                transform: translateY(60px) scale(0.95);
            }
            100% { 
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Brand Side */
        .brand-side {
            width: 45%;
            background: linear-gradient(145deg, #4f46e5, #7c3aed, #8b5cf6);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .brand-pattern {
            position: absolute;
            inset: 0;
            opacity: 0.08;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .brand-content {
            position: relative;
            z-index: 5;
        }

        .brand-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            animation: iconPulse 3s ease-in-out infinite;
        }

        @keyframes iconPulse {
            0%, 100% { transform: scale(1); box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); }
            50% { transform: scale(1.05); box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15); }
        }

        .brand-icon i {
            font-size: 2.5rem;
            color: white;
        }

        .brand-title {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            line-height: 1.3;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .brand-subtitle {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 300;
            line-height: 1.7;
            max-width: 280px;
        }

        .brand-features {
            margin-top: 2.5rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            margin-bottom: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feature-icon i {
            color: white;
            font-size: 1rem;
        }

        .feature-text {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.95);
            font-weight: 400;
        }

        .brand-footer {
            position: relative;
            z-index: 5;
            margin-top: auto;
            padding-top: 2rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 2rem;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #4ade80;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.2); }
        }

        .status-text {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        .copyright {
            margin-top: 1rem;
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.5);
        }

        /* Decorative shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .shape-1 {
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            bottom: -60px;
            right: -60px;
        }

        .shape-2 {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.03);
            top: 80px;
            right: -30px;
        }

        /* Form Side */
        .form-side {
            width: 55%;
            padding: 3.5rem 4rem;
            background: rgba(255, 255, 255, 0.95);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            margin-bottom: 2.5rem;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .wave-emoji {
            display: inline-block;
            animation: wave 2.5s infinite;
            transform-origin: 70% 70%;
        }

        @keyframes wave {
            0%, 100% { transform: rotate(0deg); }
            10% { transform: rotate(14deg); }
            20% { transform: rotate(-8deg); }
            30% { transform: rotate(14deg); }
            40% { transform: rotate(-4deg); }
            50%, 100% { transform: rotate(0deg); }
        }

        .form-subtitle {
            font-size: 1.05rem;
            color: #64748b;
            font-weight: 300;
        }

        /* Input Groups */
        .input-group {
            margin-bottom: 1.5rem;
        }

        .input-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
            margin-left: 0.25rem;
            transition: color 0.3s ease;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .custom-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3.5rem;
            font-size: 1rem;
            font-weight: 400;
            color: #1e293b;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 1rem;
            outline: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: 'Kanit', sans-serif;
        }

        .custom-input::placeholder {
            color: #94a3b8;
            font-weight: 300;
        }

        .custom-input:hover {
            border-color: #cbd5e1;
            background: white;
        }

        .custom-input:focus {
            background: white;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .input-group:focus-within .input-label {
            color: var(--primary);
        }

        .input-group:focus-within .input-icon {
            color: var(--primary);
            transform: translateY(-50%) scale(1.1);
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 0.5rem;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .toggle-password:hover {
            color: var(--primary);
        }

        /* Label Row */
        .label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .forgot-link {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .forgot-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .forgot-link:hover::after {
            width: 100%;
        }

        .forgot-link:hover {
            color: var(--primary-dark);
        }

        /* Error Message */
        .error-message {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            color: #ef4444;
            margin-top: 0.5rem;
            margin-left: 0.25rem;
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Checkbox */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.75rem;
            cursor: pointer;
        }

        .checkbox-input {
            display: none;
        }

        .checkbox-custom {
            width: 22px;
            height: 22px;
            border: 2px solid #d1d5db;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .checkbox-custom i {
            font-size: 0.7rem;
            color: white;
            opacity: 0;
            transform: scale(0);
            transition: all 0.2s ease;
        }

        .checkbox-input:checked + .checkbox-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-color: transparent;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
        }

        .checkbox-input:checked + .checkbox-custom i {
            opacity: 1;
            transform: scale(1);
        }

        .checkbox-label {
            font-size: 0.9rem;
            color: #64748b;
            transition: color 0.3s ease;
        }

        .checkbox-wrapper:hover .checkbox-label {
            color: #374151;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 1.1rem 2rem;
            font-size: 1.05rem;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            border-radius: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: 'Kanit', sans-serif;
            position: relative;
            overflow: hidden;
            box-shadow: 
                0 4px 15px rgba(99, 102, 241, 0.35),
                0 1px 3px rgba(99, 102, 241, 0.2);
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 
                0 8px 25px rgba(99, 102, 241, 0.4),
                0 4px 10px rgba(99, 102, 241, 0.3);
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:active {
            transform: translateY(0) scale(0.98);
        }

        .submit-btn i {
            transition: transform 0.3s ease;
        }

        .submit-btn:hover i {
            transform: translateX(5px);
        }

        .submit-btn.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .submit-btn.loading i {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            100% { transform: rotate(360deg); }
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 2rem 0;
            gap: 1rem;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
        }

        .divider-text {
            font-size: 0.8rem;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 500;
        }

        /* Register Link */
        .register-link {
            text-align: center;
        }

        .register-link p {
            font-size: 0.95rem;
            color: #64748b;
        }

        .register-link a {
            font-weight: 600;
            color: var(--primary);
            text-decoration: none;
            margin-left: 0.25rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .register-link a:hover {
            color: var(--primary-dark);
        }

        .register-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .register-link a:hover::after {
            width: 100%;
        }

        /* Social login buttons (optional) */
        .social-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 1rem;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 0.875rem;
            color: #374151;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Kanit', sans-serif;
        }

        .social-btn:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .social-btn i {
            font-size: 1.2rem;
        }

        .social-btn.google i { color: #ea4335; }
        .social-btn.microsoft i { color: #00a4ef; }

        /* Responsive Styles */
        @media (max-width: 900px) {
            .login-container {
                flex-direction: column;
                max-width: 500px;
            }

            .brand-side {
                width: 100%;
                padding: 2.5rem 2rem;
            }

            .brand-features {
                display: none;
            }

            .form-side {
                width: 100%;
                padding: 2.5rem 2rem;
            }

            .brand-title {
                font-size: 1.75rem;
            }

            .form-title {
                font-size: 1.75rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0.75rem;
            }

            .login-container {
                border-radius: 1.5rem;
            }

            .brand-side {
                padding: 2rem 1.5rem;
            }

            .brand-icon {
                width: 60px;
                height: 60px;
                margin-bottom: 1.5rem;
            }

            .brand-icon i {
                font-size: 1.75rem;
            }

            .brand-title {
                font-size: 1.5rem;
            }

            .brand-subtitle {
                font-size: 0.9rem;
            }

            .form-side {
                padding: 2rem 1.5rem;
            }

            .form-title {
                font-size: 1.5rem;
            }

            .form-subtitle {
                font-size: 0.95rem;
            }

            .custom-input {
                padding: 0.875rem 0.875rem 0.875rem 3rem;
                font-size: 0.95rem;
            }

            .input-icon {
                left: 1rem;
            }

            .submit-btn {
                padding: 1rem 1.5rem;
                font-size: 1rem;
            }

            .social-buttons {
                flex-direction: column;
            }
        }

        /* Accessibility */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Print styles */
        @media print {
            .bg-animated, .particles, .orb { display: none; }
            .login-container { box-shadow: none; }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-animated"></div>

    <!-- Floating Particles -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Glowing Orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Login Container -->
    <div class="login-container">
        <!-- Brand Side -->
        <div class="brand-side">
            <div class="brand-pattern"></div>
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>

            <div class="brand-content">
                <div class="brand-icon">
                    <i class="fas fa-keyboard"></i>
                </div>
                <h1 class="brand-title">ระบบวิชาพิมพ์<br>หนังสือราชการ 1</h1>
                <p class="brand-subtitle">พัฒนาทักษะการพิมพ์ที่ถูกต้อง แม่นยำ และรวดเร็ว เพื่อความเป็นมืออาชีพ</p>

                <div class="brand-features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <span class="feature-text">ติดตามความก้าวหน้า</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <span class="feature-text">ท้าทายในการแข่งขัน</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <span class="feature-text">บทเรียนมาตรฐาน</span>
                    </div>
                </div>
            </div>

            <div class="brand-footer">
                <div class="status-badge">
                    <div class="status-dot"></div>
                    <span class="status-text">ระบบพร้อมใช้งาน</span>
                </div>
                <p class="copyright">© {{ date('Y') }} Official Typing System</p>
            </div>
        </div>

        <!-- Form Side -->
        <div class="form-side">
            <div class="form-header">
                <h2 class="form-title">
                    ยินดีต้อนรับ 
                    <span class="wave-emoji">👋</span>
                </h2>
                <p class="form-subtitle">เข้าสู่ระบบเพื่อจัดการงานและคะแนนของคุณ</p>
            </div>

            <form action="{{ route('typing.login') }}" method="POST" id="loginForm">
                @csrf
                
                <!-- Email/Username Input -->
                <div class="input-group">
                    <label for="email" class="input-label">อีเมล หรือ Username</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input 
                            type="text" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            class="custom-input"
                            placeholder="กรอกอีเมลหรือ Username ของคุณ" 
                            required
                            autocomplete="username"
                        >
                    </div>
                    @error('email')
                        <p class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="input-group" x-data="{ show: false }">
                    <div class="label-row">
                        <label for="password" class="input-label">รหัสผ่าน</label>
                        <a href="#" class="forgot-link">ลืมรหัสผ่าน?</a>
                    </div>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            :type="show ? 'text' : 'password'" 
                            id="password" 
                            name="password" 
                            class="custom-input"
                            placeholder="กรอกรหัสผ่านของคุณ" 
                            required
                            autocomplete="current-password"
                        >
                        <button 
                            type="button" 
                            @click="show = !show" 
                            class="toggle-password"
                            aria-label="Toggle password visibility"
                        >
                            <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <label class="checkbox-wrapper">
                    <input type="checkbox" name="remember" class="checkbox-input">
                    <span class="checkbox-custom">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="checkbox-label">จดจำการเข้าสู่ระบบ</span>
                </label>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn" id="submitBtn">
                    <span>เข้าสู่ระบบ</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <!-- Divider -->
                <div class="divider">
                    <div class="divider-line"></div>
                    <span class="divider-text">หรือ</span>
                    <div class="divider-line"></div>
                </div>

                <!-- Register Link -->
                <div class="register-link">
                    <p>
                        ยังไม่มีบัญชีผู้ใช้งาน?
                        <a href="{{ route('typing.student-register') }}">สมัครสมาชิกใหม่</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Form submit loading state
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.classList.add('loading');
            btn.querySelector('span').textContent = 'กำลังเข้าสู่ระบบ...';
            btn.querySelector('i').className = 'fas fa-spinner';
        });

        // Add input animations
        document.querySelectorAll('.custom-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.classList.add('focused');
            });
            input.addEventListener('blur', function() {
                this.parentElement.parentElement.classList.remove('focused');
            });
        });
    </script>
</body>
</html>
