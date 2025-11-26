<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="flex">

        <!-- SIDEBAR -->
        <aside class="w-64 min-h-screen bg-white shadow-lg">
            <div class="p-6 border-b">
                <h1 class="text-xl font-bold">Admin Panel</h1>
            </div>

            <nav class="mt-4">
                <a href="{{ route('admin.dashboard') }}"
                   class="block px-6 py-3 hover:bg-gray-200 {{ request()->is('admin') ? 'bg-gray-200 font-semibold' : '' }}">
                    📊 Dashboard
                </a>

                <a href="{{ route('admin.users') }}"
                   class="block px-6 py-3 hover:bg-gray-200 {{ request()->is('admin/users') ? 'bg-gray-200 font-semibold' : '' }}">
                    👥 User Management
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left px-6 py-3 hover:bg-red-100 text-red-600">
                        🔓 Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- CONTENT -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>

    </div>

</body>
</html>
