<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2 class="text-2xl font-bold mb-6">Todo</h2>

                    {{-- Form buat category baru --}}
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf

                        {{-- Input Title --}}
                        <div class="mb-4">
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" name="title" type="text"
                                class="mt-1 block w-full" :value="old('title')" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="flex gap-2">
                            <x-primary-button>SAVE</x-primary-button>
                            <a href="{{ route('category.index') }}">
                                <x-secondary-button type="button">CANCEL</x-secondary-button>
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>