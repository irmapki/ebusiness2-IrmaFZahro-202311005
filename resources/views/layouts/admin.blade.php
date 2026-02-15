<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #fafafa;  /* ← PUTIH KEABUAN SOFT */
            min-height: 100vh;
        }
        
        .sidebar {
            background: linear-gradient(180deg, #e5aafe 0%, #83add1 100%);
            box-shadow: 4px 0 20px rgba(251, 146, 60, 0.15);
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
            background: linear-gradient(135deg, #6117a1 0%, #ff53f6 100%);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(130, 60, 251, 0.4);
        }
        
        .nav-item.active svg {
            color: white;
        }
        
        .avatar-circle {
            background: linear-gradient(135deg, #A78BFA 0%, #8B5CF6 100%);
        }
        
        .logout-btn {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }
        
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.5);
        }
        
        .badge-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .7;
            }
        }
        
        .header-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .notification-btn {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .notification-btn:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: scale(1.05);
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
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-orange-900">ShowMy</h1>
                            <p class="text-xs text-orange-700 font-medium">Admin Panel</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="space-y-2 flex-1">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="nav-item flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-orange-900' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <!-- Orders with Badge -->
                    <a href="{{ route('admin.orders.index') }}" 
                       class="nav-item flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.orders.*') ? 'active' : 'text-orange-900' }} relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        <span class="font-medium">Orders</span>
                        @php
                            $pendingOrdersCount = \App\Models\Order::where('status', 'pending')->count();
                        @endphp
                        @if($pendingOrdersCount > 0)
                        <span class="ml-auto bg-gradient-to-r from-red-400 to-pink-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center shadow-lg badge-pulse">
                            {{ $pendingOrdersCount }}
                        </span>
                        @endif
                    </a>

                    <!-- Manage Users -->
                    <a href="{{ route('admin.users.index') }}" 
                       class="nav-item flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'active' : 'text-orange-900' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span class="font-medium">Manage Users</span>
                    </a>

                    <!-- Products -->
                    <a href="{{ route('admin.products.index') }}" 
                       class="nav-item flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.products.*') ? 'active' : 'text-orange-900' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span class="font-medium">Products</span>
                    </a>

                    <!-- Divider -->
                    <div class="pt-4 mt-4 border-t border-orange-300/30">
                        <!-- Settings -->
                        <a href="{{ route('admin.profile.edit') }}" 
                           class="nav-item flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.profile.*') ? 'active' : 'text-orange-900' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="font-medium">Settings</span>
                        </a>
                    </div>
                </nav>
            </div>

            <!-- User Info & Logout -->
            <div class="p-6 border-t border-orange-300/30">
                <div class="flex items-center gap-3 mb-3">
                    <div class="avatar-circle w-12 h-12 rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-white font-bold text-lg">{{ substr(Auth::user()->name, 0, 2) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-sm truncate text-orange-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-orange-700 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl transition text-sm text-orange-900 font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="header-card shadow-lg rounded-3xl m-6 mb-4">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex-1">
                        @if (isset($header))
                            {{ $header }}
                        @else
                            <h2 class="text-2xl font-bold text-gray-800">Welcome Back!</h2>
                            <p class="text-sm text-gray-600 mt-1">Manage your store efficiently</p>
                        @endif
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <!-- Notifications Bell -->
                        <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}"
                           class="notification-btn relative p-3 rounded-2xl">
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            @php
                                $pendingOrdersCount = \App\Models\Order::where('status', 'pending')->count();
                            @endphp
                            @if($pendingOrdersCount > 0)
                            <span class="absolute -top-1 -right-1 bg-gradient-to-r from-red-500 to-pink-500 text-white text-[10px] font-bold rounded-full px-2 py-0.5 shadow-lg badge-pulse">
                                {{ $pendingOrdersCount }}
                            </span>
                            @endif
                        </a>
                        
                        <!-- Mobile User Avatar -->
                        <div class="md:hidden">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-400 to-purple-600 flex items-center justify-center text-white text-sm font-bold shadow-lg">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto px-6 pb-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Mobile Menu Toggle (Optional) -->
    <script>
        // Add mobile menu functionality if needed
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu code here
        });
    </script>
</body>
</html>