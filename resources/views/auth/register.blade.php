<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ShowMy</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #fae8ff 0%, #e9d5ff 25%, #fecaca 50%, #fed7aa 75%, #fbcfe8 100%);
            background-attachment: fixed;
        }
        
        .floating-shape {
            position: fixed;
            border-radius: 50%;
            opacity: 0.2;
            animation: float 15s ease-in-out infinite;
        }
        
        .shape-1 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, #f0abfc, #e879f9);
            top: -50px;
            right: -50px;
            animation-delay: 0s;
        }
        
        .shape-2 {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, #c4b5fd, #a78bfa);
            bottom: -50px;
            left: -50px;
            animation-delay: 5s;
        }
        
        .shape-3 {
            width: 180px;
            height: 180px;
            background: linear-gradient(135deg, #fca5a5, #f87171);
            top: 30%;
            left: 5%;
            animation-delay: 10s;
        }
        
        .shape-4 {
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, #fed7aa, #fdba74);
            bottom: 20%;
            right: 10%;
            animation-delay: 7s;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(30px, -30px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }
        
        .card-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        
        .logo-glow {
            box-shadow: 0 8px 32px rgba(244, 114, 182, 0.3);
        }
        
        .input-focus:focus {
            border-color: #f472b6;
            box-shadow: 0 0 0 3px rgba(244, 114, 182, 0.1);
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #f472b6 0%, #c084fc 100%);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            background: linear-gradient(135deg, #ec4899 0%, #a855f7 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(244, 114, 182, 0.4);
        }
        
        .sparkle {
            animation: sparkle 2s ease-in-out infinite;
        }
        
        @keyframes sparkle {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden py-12">
    <!-- Floating Background Shapes -->
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>
    <div class="floating-shape shape-3"></div>
    <div class="floating-shape shape-4"></div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-3xl shadow-2xl mb-4 logo-glow relative">
                <svg
                    class="w-11 h-11 text-pink-500"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <circle cx="9" cy="21" r="1" />
                    <circle cx="20" cy="21" r="1" />
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                </svg>
                <!-- Sparkle decoration -->
                <span class="sparkle absolute -top-1 -right-1 text-yellow-400 text-xl">✨</span>
            </div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-pink-500 via-purple-500 to-pink-500 bg-clip-text text-transparent">ShowMy</h1>
            <p class="text-purple-700 mt-2 font-medium">Create your account and start shopping!</p>
        </div>

        <!-- Register Card -->
        <div class="card-glass rounded-3xl shadow-2xl p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Sign Up</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="input-focus w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none transition-all @error('name') border-red-400 @enderror">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                           class="input-focus w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none transition-all @error('email') border-red-400 @enderror">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <input id="password" type="password" name="password" required
                           class="input-focus w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none transition-all @error('password') border-red-400 @enderror">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Must be at least 8 characters</p>
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           class="input-focus w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none transition-all">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-gradient w-full text-white py-3.5 rounded-xl font-semibold shadow-lg">
                    Create Account
                </button>

                <!-- Login Link -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600 text-sm">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-pink-600 hover:text-pink-700 font-bold transition">
                            Sign In
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-purple-700 text-sm font-medium opacity-75">© 2025 ShowMy. All rights reserved.</p>
        </div>
    </div>
</body>
</html>