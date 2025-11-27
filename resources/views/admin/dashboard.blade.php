<x-admin-layout>
    <x-slot name="header">
        🏠 Dashboard
    </x-slot>

    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-xl p-8 mb-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-indigo-100">Kelola bisnis Anda dengan mudah dari dashboard ini</p>
            </div>
            <div class="hidden md:block">
                <svg class="w-32 h-32 opacity-20" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Users -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold uppercase">Total Users</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalUsers }}</p>
                    <p class="text-green-600 text-sm mt-2">
                        <span class="font-semibold">↑ 12%</span> dari bulan lalu
                    </p>
                </div>
                <div class="p-4 bg-blue-100 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Admin Users -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold uppercase">Admin</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $adminCount }}</p>
                    <p class="text-gray-500 text-sm mt-2">
                        Administrator aktif
                    </p>
                </div>
                <div class="p-4 bg-purple-100 rounded-full">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Regular Users -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold uppercase">Users</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $userCount }}</p>
                    <p class="text-green-600 text-sm mt-2">
                        <span class="font-semibold">↑ 8%</span> dari bulan lalu
                    </p>
                </div>
                <div class="p-4 bg-green-100 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Products -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-amber-500 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold uppercase">Products</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ \App\Models\Product::count() }}</p>
                    <p class="text-gray-500 text-sm mt-2">
                        Total produk
                    </p>
                </div>
                <div class="p-4 bg-amber-100 rounded-full">
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Quick Actions Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                <h3 class="text-xl font-bold text-white">⚡ Quick Actions</h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.products.create') }}" class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl hover:from-blue-100 hover:to-indigo-100 transition-all duration-200 group">
                    <div class="p-3 bg-blue-500 rounded-lg group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="font-bold text-gray-800">Tambah Produk Baru</p>
                        <p class="text-sm text-gray-600">Buat produk dalam hitungan detik</p>
                    </div>
                </a>

                <a href="{{ route('admin.products.index') }}" class="flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl hover:from-green-100 hover:to-emerald-100 transition-all duration-200 group">
                    <div class="p-3 bg-green-500 rounded-lg group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="font-bold text-gray-800">Kelola Produk</p>
                        <p class="text-sm text-gray-600">Edit atau hapus produk existing</p>
                    </div>
                </a>

                <a href="{{ route('admin.users.create') }}" class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl hover:from-purple-100 hover:to-pink-100 transition-all duration-200 group">
                    <div class="p-3 bg-purple-500 rounded-lg group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="font-bold text-gray-800">Tambah User</p>
                        <p class="text-sm text-gray-600">Buat akun user atau admin baru</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-amber-500 to-orange-600 px-6 py-4">
                <h3 class="text-xl font-bold text-white">📊 System Info</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="ml-3 text-gray-700 font-medium">System Status</span>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">Online</span>
                </div>

                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <span class="ml-3 text-gray-700 font-medium">Laravel Version</span>
                    </div>
                    <span class="text-gray-600 font-semibold">{{ app()->version() }}</span>
                </div>

                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                        <span class="ml-3 text-gray-700 font-medium">PHP Version</span>
                    </div>
                    <span class="text-gray-600 font-semibold">{{ PHP_VERSION }}</span>
                </div>

                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-amber-500 rounded-full"></div>
                        <span class="ml-3 text-gray-700 font-medium">Database</span>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">Connected</span>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>