<x-user-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        .pastel-card {
            border-radius: 24px;
            box-shadow: 0 4px 20px rgba(139, 92, 246, 0.1);
            transition: all 0.3s ease;
        }
        
        .pastel-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(139, 92, 246, 0.2);
        }
        
        .stat-gradient-1 {
            background: linear-gradient(135deg, #A7F3D0 0%, #6EE7B7 100%);
        }
        
        .stat-gradient-2 {
            background: linear-gradient(135deg, #FDE68A 0%, #FCD34D 100%);
        }
        
        .stat-gradient-3 {
            background: linear-gradient(135deg, #FECACA 0%, #FCA5A5 100%);
        }
        
        .stat-gradient-4 {
            background: linear-gradient(135deg, #C7D2FE 0%, #A5B4FC 100%);
        }
        
        .action-card-1 {
            background: linear-gradient(135deg, #DDD6FE 0%, #C4B5FD 100%);
        }
        
        .action-card-2 {
            background: linear-gradient(135deg, #FBCFE8 0%, #F9A8D4 100%);
        }
        
        .action-card-3 {
            background: linear-gradient(135deg, #BAE6FD 0%, #7DD3FC 100%);
        }
        
        .action-card-4 {
            background: linear-gradient(135deg, #FED7AA 0%, #FDBA74 100%);
        }
        
        .status-pending { background: #FEF3C7; color: #92400E; }
        .status-processing { background: #DBEAFE; color: #1E40AF; }
        .status-completed { background: #D1FAE5; color: #065F46; }
        .status-cancelled { background: #FEE2E2; color: #991B1B; }
        .status-shipped { background: #E0E7FF; color: #4338CA; }
        .status-delivered { background: #D1FAE5; color: #065F46; }
        
        .hero-gradient {
            background: linear-gradient(135deg, #E9D5FF 0%, #FECACA 50%, #FDE68A 100%);
        }
        
        .order-card {
            background: linear-gradient(135deg, #F3E8FF 0%, #FAE8FF 100%);
            border: 2px solid #E9D5FF;
        }
    </style>

    @php
        $user = Auth::user();
        $cartCount = $user->cart ? $user->cart->items->count() : 0;
        $totalOrders = $user->orders()->count();
        $recentOrders = $user->orders()->with(['items.product'])->latest()->take(5)->get();
        $totalSpent = $user->orders()->where('status', 'completed')->sum('total');
    @endphp

    <!-- Pastel Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-4xl font-bold text-purple-900">Dashboard</h1>
            <p class="text-purple-700 mt-2 text-lg">Welcome back! Let's make today productive ✨</p>
        </div>
        <a href="{{ route('cart.index') }}" class="relative">
            <button class="flex items-center gap-3 bg-gradient-to-r from-pink-200 to-purple-200 px-6 py-3 rounded-2xl shadow-lg hover:shadow-xl transition-all border-2 border-purple-300">
                <svg class="w-6 h-6 text-purple-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="font-bold text-purple-900">My Cart</span>
                @if($cartCount > 0)
                <span class="bg-gradient-to-r from-red-400 to-pink-400 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center shadow-lg animate-pulse">
                    {{ $cartCount }}
                </span>
                @endif
            </button>
        </a>
    </div>

    <!-- Hero Card - Pastel -->
    <div class="hero-gradient pastel-card p-10 mb-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-purple-300/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-pink-300/30 rounded-full blur-3xl"></div>
        
        <div class="relative flex items-center justify-between">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-white/70 backdrop-blur-sm px-4 py-2 rounded-full mb-4 shadow-sm">
                    <span class="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="text-sm font-semibold text-purple-900">Active Account</span>
                </div>
                <h2 class="text-4xl font-bold text-purple-900 mb-3">
                    Hello, <span class="text-pink-600">{{ $user->name }}</span>! 👋
                </h2>
                <p class="text-purple-800 mb-6 text-lg max-w-2xl">
                    Discover amazing products and manage your orders seamlessly from your personalized dashboard
                </p>
                <div class="flex gap-4">
                    <a href="{{ route('shop.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-bold rounded-2xl hover:scale-105 transition-all shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Explore Products
                    </a>
                    <a href="{{ route('orders.index') }}" class="inline-flex items-center px-8 py-4 bg-white/80 backdrop-blur-sm text-purple-900 font-bold rounded-2xl hover:scale-105 transition-all shadow-lg border-2 border-purple-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        View Orders
                    </a>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="w-56 h-56 bg-gradient-to-br from-purple-400/40 to-pink-400/40 rounded-full flex items-center justify-center shadow-2xl backdrop-blur-sm">
                    <svg class="w-28 h-28 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards - Pastel Colors -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Orders -->
        <div class="stat-gradient-1 pastel-card p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-white/20 rounded-full -mr-8 -mt-8"></div>
            <div class="relative">
                <div class="w-14 h-14 bg-white/50 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                    <svg class="w-7 h-7 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <p class="text-green-800 text-sm font-semibold mb-1">Total Orders</p>
                <p class="text-4xl font-bold text-green-900">{{ $totalOrders }}</p>
            </div>
        </div>

        <!-- Cart Items -->
        <div class="stat-gradient-2 pastel-card p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-white/20 rounded-full -mr-8 -mt-8"></div>
            <div class="relative">
                <div class="w-14 h-14 bg-white/50 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                    <svg class="w-7 h-7 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <p class="text-yellow-800 text-sm font-semibold mb-1">Items in Cart</p>
                <p class="text-4xl font-bold text-yellow-900">{{ $cartCount }}</p>
                <a href="{{ route('cart.index') }}" class="text-sm text-yellow-800 hover:text-yellow-900 font-bold mt-2 inline-block">View Cart →</a>
            </div>
        </div>

        <!-- Total Spent -->
        <div class="stat-gradient-3 pastel-card p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-white/20 rounded-full -mr-8 -mt-8"></div>
            <div class="relative">
                <div class="w-14 h-14 bg-white/50 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                    <svg class="w-7 h-7 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-red-800 text-sm font-semibold mb-1">Total Spent</p>
                <p class="text-2xl font-bold text-red-900">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Reward Points -->
        <div class="stat-gradient-4 pastel-card p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-white/20 rounded-full -mr-8 -mt-8"></div>
            <div class="relative">
                <div class="w-14 h-14 bg-white/50 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                    <svg class="w-7 h-7 text-indigo-700" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                </div>
                <p class="text-indigo-800 text-sm font-semibold mb-1">Reward Points</p>
                <p class="text-4xl font-bold text-indigo-900">{{ $totalOrders * 10 }}</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions - Pastel -->
    <div class="bg-white/60 backdrop-blur-lg pastel-card p-8 mb-8 border-2 border-purple-200">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-400 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-purple-900">Quick Actions</h3>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('shop.index') }}" class="action-card-1 group p-6 rounded-2xl transition-all hover:scale-105 border-2 border-purple-300">
                <div class="w-14 h-14 bg-purple-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h4 class="font-bold text-purple-900 mb-1 text-lg">Browse Products</h4>
                <p class="text-sm text-purple-700">Explore collection</p>
            </a>

            <a href="{{ route('orders.index') }}" class="action-card-2 group p-6 rounded-2xl transition-all hover:scale-105 border-2 border-pink-300">
                <div class="w-14 h-14 bg-pink-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h4 class="font-bold text-pink-900 mb-1 text-lg">My Orders</h4>
                <p class="text-sm text-pink-700">Track purchases</p>
            </a>

            <a href="{{ route('wishlist.index') }}" class="action-card-3 group p-6 rounded-2xl transition-all hover:scale-105 border-2 border-blue-300">
                <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                    </svg>
                </div>
                <h4 class="font-bold text-blue-900 mb-1 text-lg">Wishlist</h4>
                <p class="text-sm text-blue-700">Saved items</p>
            </a>

            <a href="{{ route('user.profile.edit') }}" class="action-card-4 group p-6 rounded-2xl transition-all hover:scale-105 border-2 border-orange-300">
                <div class="w-14 h-14 bg-orange-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h4 class="font-bold text-orange-900 mb-1 text-lg">Settings</h4>
                <p class="text-sm text-orange-700">Manage account</p>
            </a>
        </div>
    </div>

    <!-- Recent Orders - Pastel -->
    <div class="bg-white/60 backdrop-blur-lg pastel-card p-8 border-2 border-purple-200">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-red-400 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-purple-900">Recent Orders</h3>
        </div>
        
        @if($recentOrders->count() > 0)
            <div class="space-y-4">
                @foreach($recentOrders as $order)
                <div class="order-card flex items-center justify-between p-5 rounded-2xl hover:scale-102 transition-all">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-1">
                                <h4 class="font-bold text-purple-900 text-lg">Order #{{ $order->id }}</h4>
                                <span class="status-badge status-{{ $order->status }}">{{ $order->status }}</span>
                            </div>
                            <p class="text-sm text-purple-700 font-medium">{{ $order->items->count() }} item(s) • {{ $order->created_at->diffForHumans() }}</p>
                            @if($order->items->isNotEmpty())
                            <p class="text-xs text-purple-600 mt-1">
                                {{ $order->items->pluck('product.name')->take(2)->implode(', ') }}
                                @if($order->items->count() > 2) + {{ $order->items->count() - 2 }} more @endif
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-purple-900 text-xl">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                        <a href="{{ route('orders.show', $order->id) }}" class="text-sm text-purple-600 hover:text-purple-700 font-bold">View Details →</a>
                    </div>
                </div>
                @endforeach
            </div>

            @if($totalOrders > 5)
            <div class="mt-6 text-center">
                <a href="{{ route('orders.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-bold rounded-2xl hover:scale-105 transition-all shadow-lg">
                    View All Orders ({{ $totalOrders }})
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            @endif
        @else
            <div class="text-center py-16">
                <div class="w-32 h-32 bg-gradient-to-br from-purple-200 to-pink-200 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-16 h-16 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <h4 class="text-2xl font-bold text-purple-900 mb-3">No Orders Yet</h4>
                <p class="text-purple-700 mb-8 text-lg">Start shopping and your orders will appear here!</p>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-bold rounded-2xl hover:scale-105 transition-all shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</x-user-layout>