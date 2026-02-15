<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #fafafa;  /* ← PUTIH KEABUAN SOFT */
       }
        
        .sidebar {
            background: linear-gradient(180deg, #C7B8EA 0%, #D4C5F9 100%);
            box-shadow: 4px 0 20px rgba(139, 92, 246, 0.1);
        }
        
        .nav-item {
            transition: all 0.3s ease;
            border-radius: 16px;
        }
        
        .nav-item:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: translateX(4px);
        }
        
        .nav-item.active {
            background: linear-gradient(135deg, #A78BFA 0%, #8B5CF6 100%);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }
        
        .nav-item.active svg {
            color: white;
        }
        
        .avatar-circle {
            background: linear-gradient(135deg, #FDE68A 0%, #FCA5A5 100%);
        }
        
        .logout-btn {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }
        
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        <!-- Pastel Sidebar -->
        <aside class="sidebar w-72 flex flex-col h-screen sticky top-0">
            <div class="p-6 flex-1 flex flex-col overflow-y-auto">
                <!-- Logo/Brand -->
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-purple-900">ShowMy</h1>
                    <p class="text-sm text-purple-700 mt-1">User Dashboard</p>
                </div>

                <!-- Navigation -->
                <nav class="space-y-2">
                    <a href="{{ route('user.dashboard') }}" class="nav-item flex items-center gap-3 px-4 py-3 {{ request()->routeIs('user.dashboard') ? 'active' : 'text-purple-800' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('shop.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 {{ request()->routeIs('shop.*') ? 'active' : 'text-purple-800' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span>Shop</span>
                    </a>

                    <a href="{{ route('cart.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 {{ request()->routeIs('cart.*') ? 'active' : 'text-purple-800' }} relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span>My Cart</span>
                        @php
                            $cartCount = Auth::user()->cart ? Auth::user()->cart->items->count() : 0;
                        @endphp
                        @if($cartCount > 0)
                        <span class="ml-auto bg-gradient-to-r from-pink-400 to-red-400 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center shadow-lg">
                            {{ $cartCount }}
                        </span>
                        @endif
                    </a>

                    <a href="{{ route('orders.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 {{ request()->routeIs('orders.*') ? 'active' : 'text-purple-800' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span>My Orders</span>
                    </a>

                    <a href="{{ route('wishlist.index') }}" class="nav-item flex items-center gap-3 px-4 py-3 {{ request()->routeIs('wishlist.*') ? 'active' : 'text-purple-800' }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                        </svg>
                        <span>Wishlist</span>
                    </a>

                    <a href="{{ route('user.profile.edit') }}" class="nav-item flex items-center gap-3 px-4 py-3 {{ request()->routeIs('user.profile.*') ? 'active' : 'text-purple-800' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Settings</span>
                    </a>
                </nav>
            </div>

            <!-- User Info -->
            <div class="p-6 border-t border-purple-300/30 mt-auto">
                <div class="flex items-center gap-3 mb-3">
                    <div class="avatar-circle w-12 h-12 rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-purple-900 font-bold text-lg">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-sm truncate text-purple-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-purple-700 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl transition text-sm text-purple-900 font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>
</body>
</html>