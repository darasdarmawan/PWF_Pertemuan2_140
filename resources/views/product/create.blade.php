<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex items-center gap-3 mb-6">
                        <a href="{{ route('product.index') }}"
                            class="p-1.5 rounded-md text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">Add Product</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Fill in the details to add a new product</p>
                        </div>
                    </div>

                    @if (session('error'))
                        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('product.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Product Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                placeholder="e.g. Wireless Headphones"
                                class="w-full px-4 py-2.5 rounded-lg border text-sm
                                text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500
                                focus:outline-none focus:ring-2 focus:border-transparent transition
                                {{ $errors->has('name')
                                    ? 'border-red-500 bg-red-50 dark:bg-red-900/20 focus:ring-red-400'
                                    : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:ring-indigo-500' }}">
                            @error('name')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="qty" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Quantity <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="qty" name="qty" value="{{ old('qty') }}"
                                    placeholder="0" min="0"
                                    class="w-full px-4 py-2.5 rounded-lg border text-sm
                                    text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500
                                    focus:outline-none focus:ring-2 focus:border-transparent transition
                                    {{ $errors->has('qty')
                                        ? 'border-red-500 bg-red-50 dark:bg-red-900/20 focus:ring-red-400'
                                        : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:ring-indigo-500' }}">
                                @error('qty')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Price (Rp) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="price" name="price" value="{{ old('price') }}"
                                    placeholder="0" min="0" step="0.01"
                                    class="w-full px-4 py-2.5 rounded-lg border text-sm
                                    text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500
                                    focus:outline-none focus:ring-2 focus:border-transparent transition
                                    {{ $errors->has('price')
                                        ? 'border-red-500 bg-red-50 dark:bg-red-900/20 focus:ring-red-400'
                                        : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:ring-indigo-500' }}">
                                @error('price')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-2">
                            <a href="{{ route('product.index') }}"
                                class="px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-4 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition shadow-sm">
                                Save Product
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>