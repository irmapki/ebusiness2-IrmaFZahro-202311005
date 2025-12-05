<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Product Name *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" 
                                required>
                            @error('name')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea name="description" id="description" rows="4" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category *</label>
                                <select name="category" id="category" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('category') border-red-500 @enderror" 
                                    required>
                                    <option value="">-- Select Category --</option>
                                    <option value="Electronics" {{ old('category') == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                                    <option value="Fashion" {{ old('category') == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                    <option value="Food & Beverage" {{ old('category') == 'Food & Beverage' ? 'selected' : '' }}>Food & Beverage</option>
                                    <option value="Books" {{ old('category') == 'Books' ? 'selected' : '' }}>Books</option>
                                    <option value="Sports" {{ old('category') == 'Sports' ? 'selected' : '' }}>Sports</option>
                                    <option value="Toys" {{ old('category') == 'Toys' ? 'selected' : '' }}>Toys</option>
                                    <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('category')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price *</label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('price') border-red-500 @enderror" 
                                    required>
                                @error('price')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="stock" class="block text-gray-700 text-sm font-bold mb-2">Stock *</label>
                                <input type="number" name="stock" id="stock" value="{{ old('stock') }}" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('stock') border-red-500 @enderror" 
                                    required>
                                @error('stock')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Product Image</label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') border-red-500 @enderror">
                                @error('image')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} 
                                    class="form-checkbox h-5 w-5 text-blue-600">
                                <span class="ml-2 text-gray-700">Active</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Save Product
                            </button>
                            <a href="{{ route('admin.products.index') }}" 
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>