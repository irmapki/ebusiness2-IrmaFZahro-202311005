<x-admin-layout>
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">⚙️ Admin Profile Settings</h2>

        @if(session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('status') }}
            </div>
        @endif

        <!-- Update Profile -->
        <div class="bg-white rounded-2xl shadow-sm p-8 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Profile Information</h3>
            
            <form method="POST" action="{{ route('admin.profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition">
                    Save Changes
                </button>
            </form>
        </div>

        <!-- Update Password -->
        <div class="bg-white rounded-2xl shadow-sm p-8 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Update Password</h3>
            
            <form method="POST" action="{{ route('admin.profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                    <input type="password" name="current_password" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                    <input type="password" name="password" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition">
                    Update Password
                </button>
            </form>
        </div>

        <!-- Delete Account -->
        <div class="bg-white rounded-2xl shadow-sm p-8 border-l-4 border-red-500">
            <h3 class="text-xl font-bold text-red-600 mb-4">Delete Account</h3>
            <p class="text-gray-600 mb-6">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
            
            <form method="POST" action="{{ route('admin.profile.destroy') }}" onsubmit="return confirm('Are you sure? This action cannot be undone!');">
                @csrf
                @method('DELETE')

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm with Password</label>
                    <input type="password" name="password" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                           placeholder="Enter your password to confirm">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="px-6 py-3 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition">
                    Delete Account
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>