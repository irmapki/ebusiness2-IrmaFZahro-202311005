<x-admin-layout>
    <x-slot name="header">
        ✨ Add New Product
    </x-slot>

    <!-- Back Button & Header -->
    <div class="mb-6">
        <a href="{{ route('admin.products.index') }}" 
           class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-semibold transition-colors mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Products
        </a>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6">
            <h3 class="text-xl font-semibold text-white">Product Information</h3>
            <p class="text-indigo-100 text-sm mt-1">Fields marked with * are required</p>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf

            <!-- Product Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Product Name <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name') }}" 
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all @error('name') border-red-300 @enderror" 
                       placeholder="e.g., Premium Wireless Headphones"
                       required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                    Description
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="5" 
                          class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all @error('description') border-red-300 @enderror"
                          placeholder="Describe your product in detail...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Category & Price -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <select name="category" 
                            id="category" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all @error('category') border-red-300 @enderror" 
                            required>
                        <option value="">-- Select Category --</option>
                        <option value="Electronics" {{ old('category') == 'Electronics' ? 'selected' : '' }}>📱 Electronics</option>
                        <option value="Fashion" {{ old('category') == 'Fashion' ? 'selected' : '' }}>👔 Fashion</option>
                        <option value="Food & Beverage" {{ old('category') == 'Food & Beverage' ? 'selected' : '' }}>🍔 Food & Beverage</option>
                        <option value="Books" {{ old('category') == 'Books' ? 'selected' : '' }}>📚 Books</option>
                        <option value="Sports" {{ old('category') == 'Sports' ? 'selected' : '' }}>⚽ Sports</option>
                        <option value="Toys" {{ old('category') == 'Toys' ? 'selected' : '' }}>🧸 Toys</option>
                        <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>📦 Other</option>
                    </select>
                    @error('category')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                        Price (Rp) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                        <input type="number" 
                               name="price" 
                               id="price" 
                               value="{{ old('price') }}" 
                               step="0.01"
                               min="0"
                               class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all @error('price') border-red-300 @enderror" 
                               placeholder="0"
                               required>
                    </div>
                    @error('price')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Stock & Image -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">
                        Stock <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" 
                               name="stock" 
                               id="stock" 
                               value="{{ old('stock', 0) }}" 
                               min="0"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all @error('stock') border-red-300 @enderror" 
                               placeholder="0"
                               required>
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">units</span>
                    </div>
                    @error('stock')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Product Status
                    </label>
                    <div class="bg-indigo-50 border-2 border-indigo-100 rounded-xl p-4">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" 
                                   name="is_active" 
                                   value="1" 
                                   {{ old('is_active', true) ? 'checked' : '' }} 
                                   class="w-5 h-5 rounded border-gray-300 text-indigo-600 focus:ring-4 focus:ring-indigo-100 transition-all">
                            <div class="ml-3">
                                <span class="text-base font-semibold text-gray-900">Active Product</span>
                                <p class="text-sm text-gray-600">Product will be visible in shop</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    Product Image
                </label>
                <div class="relative">
                    <input type="file" 
                           id="image" 
                           name="image" 
                           accept="image/*" 
                           class="hidden" 
                           onchange="previewImage(event)">
                    <label for="image" 
                           class="flex flex-col items-center justify-center w-full h-72 border-3 border-dashed border-gray-300 rounded-2xl cursor-pointer bg-gradient-to-br from-gray-50 to-white hover:from-indigo-50 hover:to-purple-50 hover:border-indigo-400 transition-all duration-300 group">
                        <div id="uploadPlaceholder" class="flex flex-col items-center justify-center pt-7">
                            <div class="p-4 bg-indigo-100 rounded-full mb-4 group-hover:bg-indigo-200 transition-colors">
                                <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                            </div>
                            <p class="mb-2 text-base font-semibold text-gray-700">
                                <span class="text-indigo-600">Click to upload</span> or drag and drop
                            </p>
                            <p class="text-sm text-gray-500">PNG, JPG, GIF (MAX. 2MB)</p>
                        </div>
                        <div id="imagePreview" class="hidden w-full h-full p-4">
                            <img id="preview" class="w-full h-full object-contain rounded-xl" alt="Preview">
                        </div>
                    </label>
                </div>
                @error('image')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t-2 border-gray-100">
                <a href="{{ route('admin.products.index') }}" 
                   class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                    💾 Save Product
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('uploadPlaceholder').classList.add('hidden');
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-admin-layout>