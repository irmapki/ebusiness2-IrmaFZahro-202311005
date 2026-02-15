<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome to Ngopi King - Premium Coffee Experience</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=playfair-display:700,900|dm-sans:400,500,600,700" rel="stylesheet" />
        
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'DM Sans', sans-serif;
                background: #0a0a0a;
                color: #fff;
                overflow-x: hidden;
                position: relative;
                min-height: 100vh;
            }

            /* Animated coffee beans background */
            .coffee-bg {
                position: fixed;
                inset: 0;
                background: 
                    radial-gradient(circle at 20% 30%, rgba(139, 69, 19, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 80% 70%, rgba(101, 67, 33, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 50% 50%, rgba(160, 82, 45, 0.1) 0%, transparent 50%);
                animation: bgPulse 10s ease-in-out infinite;
            }

            @keyframes bgPulse {
                0%, 100% { opacity: 0.5; }
                50% { opacity: 0.8; }
            }

            /* Floating coffee steam */
            .steam {
                position: fixed;
                width: 100%;
                height: 100%;
                pointer-events: none;
                overflow: hidden;
            }

            .steam-particle {
                position: absolute;
                width: 3px;
                height: 40px;
                background: linear-gradient(to top, transparent, rgba(255, 255, 255, 0.3), transparent);
                border-radius: 50%;
                animation: rise 6s ease-in infinite;
            }

            .steam-particle:nth-child(1) { left: 20%; animation-delay: 0s; }
            .steam-particle:nth-child(2) { left: 40%; animation-delay: 2s; }
            .steam-particle:nth-child(3) { left: 60%; animation-delay: 4s; }
            .steam-particle:nth-child(4) { left: 80%; animation-delay: 1s; }

            @keyframes rise {
                0% {
                    bottom: -50px;
                    opacity: 0;
                    transform: translateX(0) scale(1);
                }
                25% {
                    opacity: 0.5;
                }
                50% {
                    transform: translateX(20px) scale(1.2);
                }
                75% {
                    opacity: 0.3;
                }
                100% {
                    bottom: 100%;
                    opacity: 0;
                    transform: translateX(-20px) scale(0.8);
                }
            }

            /* Header */
            header {
                position: relative;
                z-index: 100;
                padding: 2rem 3rem;
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
                gap: 0.75rem;
                font-family: 'Playfair Display', serif;
                font-size: 1.8rem;
                font-weight: 900;
                color: #D4A574;
                text-shadow: 0 2px 10px rgba(212, 165, 116, 0.3);
            }

            .logo svg {
                width: 40px;
                height: 40px;
                filter: drop-shadow(0 0 10px rgba(212, 165, 116, 0.5));
            }

            .nav-buttons {
                display: flex;
                gap: 1rem;
            }

            .btn {
                position: relative;
                padding: 0.9rem 2rem;
                background: transparent;
                border: 2px solid rgba(212, 165, 116, 0.3);
                border-radius: 50px;
                color: #D4A574;
                text-decoration: none;
                font-weight: 600;
                font-size: 0.95rem;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                overflow: hidden;
                cursor: pointer;
            }

            .btn::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, #D4A574, #8B4513);
                opacity: 0;
                transition: opacity 0.4s ease;
            }

            .btn span {
                position: relative;
                z-index: 1;
            }

            .btn:hover {
                border-color: #D4A574;
                transform: translateY(-2px);
                box-shadow: 0 10px 30px rgba(212, 165, 116, 0.3);
            }

            .btn:hover::before {
                opacity: 1;
            }

            .btn-primary {
                background: linear-gradient(135deg, #D4A574, #8B4513);
                border-color: transparent;
                color: #fff;
            }

            .btn-primary::before {
                background: linear-gradient(135deg, #8B4513, #654321);
                opacity: 0;
            }

            .btn-primary:hover::before {
                opacity: 1;
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
                max-width: 900px;
                animation: fadeInUp 1s ease-out 0.3s both;
            }

            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(40px); }
                to { opacity: 1; transform: translateY(0); }
            }

            /* Coffee Cup Illustration */
            .coffee-cup {
                position: relative;
                width: 200px;
                height: 200px;
                margin: 0 auto 3rem;
                animation: fadeInUp 1s ease-out 0.5s both, float 3s ease-in-out infinite;
            }

            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }

            .cup-body {
                width: 140px;
                height: 180px;
                background: linear-gradient(135deg, #8B4513 0%, #654321 100%);
                border-radius: 0 0 60px 60px;
                position: absolute;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                box-shadow: 
                    0 20px 60px rgba(139, 69, 19, 0.4),
                    inset 0 -20px 30px rgba(0, 0, 0, 0.3);
            }

            .cup-handle {
                width: 50px;
                height: 70px;
                border: 12px solid #8B4513;
                border-left: none;
                border-radius: 0 40px 40px 0;
                position: absolute;
                right: -30px;
                top: 50px;
                box-shadow: 0 10px 30px rgba(139, 69, 19, 0.3);
            }

            .cup-steam {
                position: absolute;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
            }

            .steam-line {
                width: 4px;
                height: 50px;
                background: linear-gradient(to top, rgba(212, 165, 116, 0.6), transparent);
                border-radius: 50%;
                position: absolute;
                animation: steamRise 2s ease-in-out infinite;
            }

            .steam-line:nth-child(1) { left: -20px; animation-delay: 0s; }
            .steam-line:nth-child(2) { left: 0px; animation-delay: 0.3s; }
            .steam-line:nth-child(3) { left: 20px; animation-delay: 0.6s; }

            @keyframes steamRise {
                0% {
                    transform: translateY(0) scale(1);
                    opacity: 0;
                }
                50% {
                    opacity: 0.8;
                }
                100% {
                    transform: translateY(-40px) scale(0.5);
                    opacity: 0;
                }
            }

            /* Typography */
            .tagline {
                font-size: 1rem;
                color: #D4A574;
                letter-spacing: 3px;
                text-transform: uppercase;
                margin-bottom: 1rem;
                animation: fadeInUp 1s ease-out 0.7s both;
            }

            h1 {
                font-family: 'Playfair Display', serif;
                font-size: clamp(3rem, 10vw, 6rem);
                font-weight: 900;
                line-height: 1.1;
                margin-bottom: 1.5rem;
                background: linear-gradient(135deg, #D4A574 0%, #FFE4B5 50%, #D4A574 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                animation: fadeInUp 1s ease-out 0.9s both;
                text-shadow: 0 4px 20px rgba(212, 165, 116, 0.3);
            }

            .subtitle {
                font-size: clamp(1.1rem, 2.5vw, 1.5rem);
                color: rgba(255, 255, 255, 0.7);
                margin-bottom: 3rem;
                line-height: 1.6;
                animation: fadeInUp 1s ease-out 1.1s both;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
            }

            /* CTA Buttons */
            .cta-group {
                display: flex;
                gap: 1.5rem;
                justify-content: center;
                flex-wrap: wrap;
                animation: fadeInUp 1s ease-out 1.3s both;
            }

            .cta-group .btn {
                padding: 1.2rem 3rem;
                font-size: 1.1rem;
            }

            /* Features */
            .features {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 2rem;
                margin-top: 5rem;
                animation: fadeInUp 1s ease-out 1.5s both;
            }

            .feature {
                text-align: center;
                padding: 2rem;
                background: rgba(212, 165, 116, 0.05);
                border: 1px solid rgba(212, 165, 116, 0.2);
                border-radius: 20px;
                transition: all 0.4s ease;
            }

            .feature:hover {
                transform: translateY(-10px);
                background: rgba(212, 165, 116, 0.1);
                border-color: rgba(212, 165, 116, 0.4);
                box-shadow: 0 20px 40px rgba(212, 165, 116, 0.2);
            }

            .feature-icon {
                font-size: 2.5rem;
                margin-bottom: 1rem;
                filter: drop-shadow(0 0 10px rgba(212, 165, 116, 0.5));
            }

            .feature h3 {
                font-size: 1.2rem;
                color: #D4A574;
                margin-bottom: 0.5rem;
            }

            .feature p {
                font-size: 0.9rem;
                color: rgba(255, 255, 255, 0.6);
            }

            /* Decorative Elements */
            .coffee-bean {
                position: fixed;
                width: 60px;
                height: 40px;
                background: linear-gradient(135deg, #8B4513, #654321);
                border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
                opacity: 0.1;
                animation: floatBean 15s infinite ease-in-out;
            }

            .coffee-bean::before {
                content: '';
                position: absolute;
                width: 8px;
                height: 30px;
                background: rgba(10, 10, 10, 0.3);
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) rotate(10deg);
                border-radius: 50%;
            }

            .bean-1 { top: 10%; left: 10%; animation-delay: 0s; }
            .bean-2 { top: 30%; right: 15%; animation-delay: 3s; }
            .bean-3 { bottom: 20%; left: 20%; animation-delay: 6s; }
            .bean-4 { bottom: 30%; right: 25%; animation-delay: 9s; }

            @keyframes floatBean {
                0%, 100% {
                    transform: translate(0, 0) rotate(0deg);
                }
                25% {
                    transform: translate(20px, -30px) rotate(90deg);
                }
                50% {
                    transform: translate(-10px, 20px) rotate(180deg);
                }
                75% {
                    transform: translate(30px, 10px) rotate(270deg);
                }
            }

            /* Responsive */
            @media (max-width: 768px) {
                header {
                    padding: 1.5rem;
                    flex-direction: column;
                    gap: 1.5rem;
                }

                .coffee-cup {
                    width: 150px;
                    height: 150px;
                }

                .cup-body {
                    width: 100px;
                    height: 140px;
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
            }

            /* Footer */
            footer {
                position: relative;
                z-index: 10;
                text-align: center;
                padding: 2rem;
                color: rgba(255, 255, 255, 0.5);
                font-size: 0.9rem;
            }
        </style>
    </head>
    <body>
        <!-- Animated Background -->
        <div class="coffee-bg"></div>
        <div class="steam">
            <div class="steam-particle"></div>
            <div class="steam-particle"></div>
            <div class="steam-particle"></div>
            <div class="steam-particle"></div>
        </div>

        <!-- Decorative Coffee Beans -->
        <div class="coffee-bean bean-1"></div>
        <div class="coffee-bean bean-2"></div>
        <div class="coffee-bean bean-3"></div>
        <div class="coffee-bean bean-4"></div>

        <!-- Header -->
        <header>
            <div class="logo">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M2,21H20V19H2M20,8H18V5H20M20,3H4V13A4,4 0 0,0 8,17H14A4,4 0 0,0 18,13V10H20A2,2 0 0,0 22,8V5C22,3.89 21.1,3 20,3Z"/>
                </svg>
                Ngopi King
            </div>

            @if (Route::has('login'))
                <nav class="nav-buttons">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                            <span>Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn">
                            <span>Login</span>
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                <span>Register</span>
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Main Content -->
        <main>
            <div class="hero">
                <!-- Coffee Cup Animation -->
                <div class="coffee-cup">
                    <div class="cup-steam">
                        <div class="steam-line"></div>
                        <div class="steam-line"></div>
                        <div class="steam-line"></div>
                    </div>
                    <div class="cup-body">
                        <div class="cup-handle"></div>
                    </div>
                </div>

                <p class="tagline">Premium Coffee Experience</p>
                <h1>Welcome to<br>Ngopi King</h1>
                <p class="subtitle">
                    Discover the finest coffee beans from around the world. 
                    Experience the perfect blend of tradition and innovation in every cup.
                </p>

                <div class="cta-group">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                                <span>Go to Dashboard</span>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                <span>Get Started</span>
                            </a>
                            <a href="{{ route('login') }}" class="btn">
                                <span>Sign In</span>
                            </a>
                        @endauth
                    @endif
                </div>

                <!-- Features -->
                <div class="features">
                    <div class="feature">
                        <div class="feature-icon">☕</div>
                        <h3>Premium Beans</h3>
                        <p>Sourced from the best farms worldwide</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">🎯</div>
                        <h3>Expert Roasting</h3>
                        <p>Perfectly roasted for optimal flavor</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">⚡</div>
                        <h3>Fast Delivery</h3>
                        <p>Fresh coffee delivered to your door</p>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">❤️</div>
                        <h3>Satisfaction</h3>
                        <p>100% customer satisfaction guaranteed</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer>
            <p>&copy; {{ date('Y') }} Ngopi King. All rights reserved. | Crafted with ❤️ and ☕</p>
        </footer>
    </body>
</html>