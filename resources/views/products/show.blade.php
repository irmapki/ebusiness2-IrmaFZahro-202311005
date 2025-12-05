<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Product Details') }}
            </h2>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Product Image -->
                        <div>
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-lg shadow-md">
                            @else
                                <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-400 text-xl">No Image Available</span>
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
                            
                            <div class="mb-4">
                                @if($product->is_active)
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-semibold text-gray-600">Category</label>
                                    <p class="text-lg text-gray-800">{{ $product->category }}</p>
                                </div>

                                <div>
                                    <label class="text-sm font-semibold text-gray-600">Price</label>
                                    <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>

                                <div>
                                    <label class="text-sm font-semibold text-gray-600">Stock</label>
                                    <p class="text-lg text-gray-800">{{ $product->stock }} units</p>
                                </div>

                                <div>
                                    <label class="text-sm font-semibold text-gray-600">Description</label>
                                    <p class="text-gray-700 leading-relaxed">{{ $product->description ?? 'No description available.' }}</p>
                                </div>

                                <div class="pt-4 border-t">
                                    <label class="text-sm font-semibold text-gray-600">Created At</label>
                                    <p class="text-gray-700">{{ $product->created_at->format('d M Y, H:i') }}</p>
                                </div>

                                <div>
                                    <label class="text-sm font-semibold text-gray-600">Last Updated</label>
                                    <p class="text-gray-700">{{ $product->updated_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-6 flex gap-3">
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Edit Product
                                </a>
                                
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Delete Product
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>