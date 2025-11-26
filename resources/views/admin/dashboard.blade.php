<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800">Admin Dashboard</h2>
                <p class="text-gray-500 text-sm mt-1">Manage users & monitor platform statistics</p>
            </div>
            <span class="px-4 py-1 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-full text-sm shadow">
                Administrator
            </span>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- SUCCESS / ERROR --}}
            @if(session('success'))
                <div class="mb-4 bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif


            {{-- CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                {{-- Total Users --}}
                <div class="rounded-xl shadow-md bg-white p-6 border border-gray-100 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm">Total Users</p>
                            <h3 class="text-3xl font-bold mt-1">{{ $users->count() }}</h3>
                        </div>
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                    </div>
                </div>

                {{-- Admin Users --}}
                <div class="rounded-xl shadow-md bg-white p-6 border border-gray-100 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm">Admin Users</p>
                            <h3 class="text-3xl font-bold mt-1">{{ $users->where('role', 'admin')->count() }}</h3>
                        </div>
                        <div class="bg-green-100 text-green-600 p-3 rounded-full">
                            <i class="fas fa-user-shield text-xl"></i>
                        </div>
                    </div>
                </div>

                {{-- Regular Users --}}
                <div class="rounded-xl shadow-md bg-white p-6 border border-gray-100 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm">Regular Users</p>
                            <h3 class="text-3xl font-bold mt-1">{{ $users->where('role', 'user')->count() }}</h3>
                        </div>
                        <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                            <i class="fas fa-user text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>


            {{-- USER TABLE --}}
            <div class="bg-white shadow-md rounded-xl border border-gray-100">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-700">User Management</h3>

                    <a href="{{ route('admin.users.create') }}"
                       class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow">
                        <i class="fas fa-plus mr-2"></i> Add User
                    </a>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600">User</th>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Email</th>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Role</th>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Joined</th>
                                    <th class="px-6 py-3 text-right font-semibold text-gray-600">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @foreach($users as $user)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <span class="font-medium text-gray-800">{{ $user->name }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-gray-700">{{ $user->email }}</td>

                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-xs rounded-full 
                                            {{ $user->role === 'admin' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-gray-500">
                                        {{ $user->created_at->format('M d, Y') }}
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.users.edit', $user) }}"
                                           class="text-blue-600 hover:text-blue-800 mr-4">
                                           <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
