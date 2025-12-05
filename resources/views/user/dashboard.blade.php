<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Card with Gradient -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-8 text-white">
                    <h3 class="text-3xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}! 👋</h3>
                    <p class="text-blue-100 text-lg">Have a great day shopping with us!</p>
                </div>
            </div>

            <!-- User Info Card -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Profile Card -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="ml-4">
                                <h4 class="text-xl font-bold text-gray-800">{{ auth()->user()->name }}</h4>
                                <p class="text-gray-600">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-600">Account Status:</span>
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                    Active
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Member Since:</span>
                                <span class="text-gray-800 font-semibold">{{ auth()->user()->created_at->format('M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Your Activity</h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-gray-700 font-medium">Total Orders</span>
                                </div>
                                <span class="text-2xl font-bold text-blue-600">0</span>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-gray-700 font-medium">Wishlist Items</span>
                                </div>
                                <span class="text-2xl font-bold text-green-600">0</span>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-gray-700 font-medium">Reward Points</span>
                                </div>
                                <span class="text-2xl font-bold text-purple-600">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Browse Products -->
                        <a href="#" class="group">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg text-center hover:shadow-lg transition duration-200 border-2 border-transparent group-hover:border-blue-500">
                                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <h5 class="font-semibold text-gray-800 group-hover:text-blue-600">Browse Products</h5>
                                <p class="text-xs text-gray-600 mt-1">Explore our catalog</p>
                            </div>
                        </a>

                        <!-- My Orders -->
                        <a href="#" class="group">
                            <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg text-center hover:shadow-lg transition duration-200 border-2 border-transparent group-hover:border-green-500">
                                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <h5 class="font-semibold text-gray-800 group-hover:text-green-600">My Orders</h5>
                                <p class="text-xs text-gray-600 mt-1">Track your orders</p>
                            </div>
                        </a>

                        <!-- Wishlist -->
                        <a href="#" class="group">
                            <div class="bg-gradient-to-br from-pink-50 to-pink-100 p-6 rounded-lg text-center hover:shadow-lg transition duration-200 border-2 border-transparent group-hover:border-pink-500">
                                <div class="w-12 h-12 bg-pink-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <h5 class="font-semibold text-gray-800 group-hover:text-pink-600">Wishlist</h5>
                                <p class="text-xs text-gray-600 mt-1">Saved items</p>
                            </div>
                        </a>

                        <!-- Profile Settings -->
                        <a href="{{ route('profile.edit') }}" class="group">
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-lg text-center hover:shadow-lg transition duration-200 border-2 border-transparent group-hover:border-purple-500">
                                <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <h5 class="font-semibold text-gray-800 group-hover:text-purple-600">Settings</h5>
                                <p class="text-xs text-gray-600 mt-1">Manage profile</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity / Placeholder -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mt-6">
                <div class="p-6">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Recent Activity</h4>
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                        <p class="text-gray-600">No recent activity yet</p>
                        <p class="text-sm text-gray-500 mt-2">Start shopping to see your activity here!</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>