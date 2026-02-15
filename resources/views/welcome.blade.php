<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ShowMy - Your Personal Shopping Experience</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|poppins:400,500,600,700" rel="stylesheet" />
        
        <!-- Vite Assets -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Outfit', sans-serif;
                background: linear-gradient(135deg, #f5e6ff 0%, #e6f0ff 25%, #ffe6f0 50%, #fff4e6 75%, #e6fff5 100%);
                color: #4a3966;
                overflow-x: hidden;
                min-height: 100vh;
            }

            /* Floating shapes background */
            .bg-shapes {
                position: fixed;
                inset: 0;
                pointer-events: none;
                overflow: hidden;
                z-index: 0;
            }

            .shape {
                position: absolute;
                border-radius: 50%;
                opacity: 0.15;
                animation: float 20s ease-in-out infinite;
            }

            .shape-1 {
                width: 300px;
                height: 300px;
                background: linear-gradient(135deg, #c4b5fd, #ddd6fe);
                top: 10%;
                left: 5%;
                animation-delay: 0s;
            }

            .shape-2 {
                width: 200px;
                height: 200px;
                background: linear-gradient(135deg, #fecaca, #fca5a5);
                top: 50%;
                right: 10%;
                animation-delay: 3s;
            }

            .shape-3 {
                width: 250px;
                height: 250px;
                background: linear-gradient(135deg, #a7f3d0, #6ee7b7);
                bottom: 10%;
                left: 15%;
                animation-delay: 6s;
            }

            .shape-4 {
                width: 180px;
                height: 180px;
                background: linear-gradient(135deg, #fed7aa, #fdba74);
                top: 30%;
                right: 25%;
                animation-delay: 9s;
            }

            @keyframes float {
                0%, 100% {
                    transform: translate(0, 0) scale(1);
                }
                25% {
                    transform: translate(30px, -40px) scale(1.1);
                }
                50% {
                    transform: translate(-20px, 30px) scale(0.9);
                }
                75% {
                    transform: translate(40px, 20px) scale(1.05);
                }
            }

            /* Header */
            header {
                position: relative;
                z-index: 100;
                padding: 1.5rem 3rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
                animation: slideDown 0.8s ease-out;
            }

            @keyframes slideDown {
                from { opacity: 0; transform: translateY(-30px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .logo {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                font-family: 'Poppins', sans-serif;
                font-size: 1.8rem;
                font-weight: 700;
                color: #7c3aed;
                text-shadow: 0 2px 10px rgba(124, 58, 237, 0.2);
            }

            .logo-icon {
                width: 40px;
                height: 40px;
                background: linear-gradient(135deg, #a78bfa, #c4b5fd);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
            }

            .nav-buttons {
                display: flex;
                gap: 1rem;
            }

            .btn {
                position: relative;
                padding: 0.9rem 2rem;
                background: white;
                border: 2px solid transparent;
                border-radius: 16px;
                color: #7c3aed;
                text-decoration: none;
                font-weight: 600;
                font-size: 0.95rem;
                transition: all 0.3s ease;
                cursor: pointer;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            }

            .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(124, 58, 237, 0.2);
            }

            .btn-primary {
                background: linear-gradient(135deg, #7c3aed, #a78bfa);
                color: white;
            }

            .btn-primary:hover {
                background: linear-gradient(135deg, #6d28d9, #8b5cf6);
            }

            /* Main Content */
            main {
                position: relative;
                z-index: 10;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: calc(100vh - 100px);
                padding: 2rem;
                text-align: center;
            }

            .hero {
                max-width: 1100px;
                animation: fadeInUp 1s ease-out 0.3s both;
            }

            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(40px); }
                to { opacity: 1; transform: translateY(0); }
            }

            /* Shopping bag illustration */
            .hero-image {
                position: relative;
                width: 280px;
                height: 280px;
                margin: 0 auto 3rem;
                animation: float 4s ease-in-out infinite;
            }

            .shopping-bag {
                width: 200px;
                height: 240px;
                background: linear-gradient(135deg, #fdf4ff, #fae8ff);
                border-radius: 30px 30px 40px 40px;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                box-shadow: 
                    0 30px 60px rgba(167, 139, 250, 0.3),
                    inset 0 -10px 30px rgba(167, 139, 250, 0.1);
            }

            .bag-handle {
                width: 140px;
                height: 80px;
                border: 10px solid #c4b5fd;
                border-bottom: none;
                border-radius: 80px 80px 0 0;
                position: absolute;
                top: -30px;
                left: 50%;
                transform: translateX(-50%);
                box-shadow: 0 -10px 30px rgba(167, 139, 250, 0.2);
            }

            .bag-icon {
                position: absolute;
                font-size: 4rem;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                filter: drop-shadow(0 0 20px rgba(167, 139, 250, 0.4));
            }

            /* Floating elements around the bag */
            .float-element {
                position: absolute;
                width: 60px;
                height: 60px;
                border-radius: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.8rem;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
                animation: floatSlow 6s ease-in-out infinite;
            }

            .element-1 {
                background: linear-gradient(135deg, #fecaca, #fca5a5);
                top: -20px;
                right: -30px;
                animation-delay: 0s;
            }

            .element-2 {
                background: linear-gradient(135deg, #a7f3d0, #6ee7b7);
                bottom: 20px;
                left: -40px;
                animation-delay: 2s;
            }

            .element-3 {
                background: linear-gradient(135deg, #fed7aa, #fdba74);
                bottom: -20px;
                right: -20px;
                animation-delay: 4s;
            }

            @keyframes floatSlow {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(10deg); }
            }

            /* Typography */
            .badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.6rem 1.5rem;
                background: linear-gradient(135deg, rgba(167, 139, 250, 0.15), rgba(196, 181, 253, 0.15));
                border-radius: 50px;
                color: #7c3aed;
                font-size: 0.9rem;
                font-weight: 600;
                margin-bottom: 2rem;
                animation: fadeInUp 1s ease-out 0.5s both;
                border: 1px solid rgba(167, 139, 250, 0.3);
            }

            h1 {
                font-family: 'Outfit', sans-serif;
                font-size: clamp(3rem, 10vw, 5.5rem);
                font-weight: 800;
                line-height: 1.1;
                margin-bottom: 1.5rem;
                background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #f59e0b 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                animation: fadeInUp 1s ease-out 0.7s both;
            }

            .subtitle {
                font-size: clamp(1.1rem, 2.5vw, 1.4rem);
                color: #6b7280;
                margin-bottom: 3rem;
                line-height: 1.7;
                animation: fadeInUp 1s ease-out 0.9s both;
                max-width: 650px;
                margin-left: auto;
                margin-right: auto;
            }

            /* CTA Buttons */
            .cta-group {
                display: flex;
                gap: 1.5rem;
                justify-content: center;
                flex-wrap: wrap;
                animation: fadeInUp 1s ease-out 1.1s both;
            }

            .cta-group .btn {
                padding: 1.2rem 3rem;
                font-size: 1.1rem;
                border-radius: 20px;
            }

            /* Features */
            .features {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 2rem;
                margin-top: 6rem;
                animation: fadeInUp 1s ease-out 1.3s both;
            }

            .feature {
                text-align: center;
                padding: 2.5rem 2rem;
                background: white;
                border-radius: 24px;
                transition: all 0.4s ease;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            }

            .feature:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(124, 58, 237, 0.15);
            }

            .feature-icon-wrapper {
                width: 70px;
                height: 70px;
                margin: 0 auto 1.5rem;
                border-radius: 18px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 2rem;
            }

            .feature:nth-child(1) .feature-icon-wrapper {
                background: linear-gradient(135deg, #ddd6fe, #c4b5fd);
            }

            .feature:nth-child(2) .feature-icon-wrapper {
                background: linear-gradient(135deg, #fecaca, #fca5a5);
            }

            .feature:nth-child(3) .feature-icon-wrapper {
                background: linear-gradient(135deg, #a7f3d0, #6ee7b7);
            }

            .feature:nth-child(4) .feature-icon-wrapper {
                background: linear-gradient(135deg, #fed7aa, #fdba74);
            }

            .feature h3 {
                font-size: 1.3rem;
                color: #4a3966;
                margin-bottom: 0.8rem;
                font-weight: 700;
            }

            .feature p {
                font-size: 0.95rem;
                color: #6b7280;
                line-height: 1.6;
            }

            /* Stats section */
            .stats {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 2rem;
                margin-top: 4rem;
                animation: fadeInUp 1s ease-out 1.5s both;
            }

            .stat {
                text-align: center;
            }

            .stat-number {
                font-size: 3rem;
                font-weight: 800;
                color: #7c3aed;
                margin-bottom: 0.5rem;
            }

            .stat-label {
                font-size: 0.95rem;
                color: #6b7280;
                font-weight: 500;
            }

            /* Footer */
            footer {
                position: relative;
                z-index: 10;
                text-align: center;
                padding: 3rem 2rem;
                color: #6b7280;
                font-size: 0.9rem;
                margin-top: 4rem;
            }

            /* Responsive */
            @media (max-width: 768px) {
                header {
                    padding: 1.5rem;
                    flex-direction: column;
                    gap: 1.5rem;
                }

                .hero-image {
                    width: 220px;
                    height: 220px;
                }

                .shopping-bag {
                    width: 160px;
                    height: 200px;
                }

                .features {
                    grid-template-columns: 1fr;
                }

                .cta-group {
                    flex-direction: column;
                    width: 100%;
                }

                .cta-group .btn {
                    width: 100%;
                }

                .stats {
                    grid-template-columns: repeat(2, 1fr);
                }
            }
        </style>
    </head>
    <body>
        <!-- Animated Background -->
        <div class="bg-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>

        <!-- Header -->
        <header>
            <div class="logo">
                <div class="logo-icon">🛍️</div>
                ShowMy
            </div>

            @if (Route::has('login'))
                <nav class="nav-buttons">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn">
                            Login
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                Get Started
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Main Content -->
        <main>
            <div class="hero">
                <!-- Shopping Bag Illustration -->
                <div class="hero-image">
                    <div class="shopping-bag">
                        <div class="bag-handle"></div>
                        <div class="bag-icon">🛒</div>
                    </div>
                    <div class="float-element element-1">❤️</div>
                    <div class="float-element element-2">⭐</div>
                    <div class="float-element element-3">✨</div>
                </div>

                <div class="badge">
                    <span>✨</span>
                    <span>Your Personal Shopping Experience</span>
                </div>

                <h1>Shop Smart,<br>Live Better</h1>
                
                <p class="subtitle">
                    Discover amazing products and manage your orders seamlessly from your 
                    personalized dashboard. Join thousands of happy shoppers today!
                </p>

                <div class="cta-group">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                Start Shopping
                            </a>
                            <a href="{{ route('login') }}" class="btn">
                                Sign In
                            </a>
                        @endauth
                    @endif
                </div>

                <!-- Stats -->
                <div class="stats">
                    <div class="stat">
                        <div class="stat-number">10K+</div>
                        <div class="stat-label">Happy Customers</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">50K+</div>
                        <div class="stat-label">Products</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">99%</div>
                        <div class="stat-label">Satisfaction</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Support</div>
                    </div>
                </div>

                <!-- Features -->
                <div class="features">
                    <div class="feature">
                        <div class="feature-icon-wrapper">
                            🔍
                        </div>
                        <h3>Browse Products</h3>
                        <p>Explore our extensive collection of quality products curated just for you</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon-wrapper">
                            📦
                        </div>
                        <h3>Track Orders</h3>
                        <p>Monitor your purchases in real-time with our advanced tracking system</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon-wrapper">
                            💎
                        </div>
                        <h3>Exclusive Deals</h3>
                        <p>Get access to special discounts and member-only promotions</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon-wrapper">
                            ⚙️
                        </div>
                        <h3>Easy Management</h3>
                        <p>Manage your account, wishlist, and preferences with ease</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer>
            <p>&copy; {{ date('Y') }} ShowMy. All rights reserved. Made with 💜 for amazing shoppers</p>
        </footer>
    </body>
</html>