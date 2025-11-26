<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Selamat Datang, {{ auth()->user()->name }}!</h3>
                    
                    <div class="mt-4">
                        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        <p><strong>Role:</strong> 
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                {{ auth()->user()->role }}
                            </span>
                        </p>
                    </div>

                    <div class="mt-6">
                        <p class="text-gray-600">Ini adalah dashboard untuk user biasa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>