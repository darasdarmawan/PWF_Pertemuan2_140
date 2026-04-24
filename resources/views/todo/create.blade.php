<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2 class="text-2xl font-bold mb-6">Todo</h2>

                    {{-- Form buat todo baru --}}
                    <form action="{{ route('todo.store') }}" method="POST">
                        @csrf

                        {{-- Input Title --}}
                        <div class="mb-4">
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" name="title" type="text"
                                class="mt-1 block w-full" :value="old('title')" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- Dropdown Category pakai component select --}}
                        <div class="mb-4">
                            <x-input-label for="category_id" value="Category" />
                            <x-select id="category_id" name="category_id" class="mt-1 block w-full">
                                <option value="">Empty</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </x-select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="flex gap-2">
                            <x-primary-button>SAVE</x-primary-button>
                            <a href="{{ route('todo.index') }}">
                                <x-secondary-button type="button">CANCEL</x-secondary-button>
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>