<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold">Todo</h2>
                        <a href="{{ route('todo.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition">
                            CREATE
                        </a>
                    </div>

                    {{-- Flash Message --}}
                    @if (session('success'))
                        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tabel Todo --}}
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse ($todos as $todo)
                                <tr>
                                    <td class="px-6 py-4 font-medium">{{ $todo->title }}</td>
                                    {{-- Tampilkan nama category, jika kosong tampilkan strip --}}
                                    <td class="px-6 py-4 text-gray-500">{{ $todo->category->title ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        {{-- Badge status: hijau jika done, kuning jika ongoing --}}
                                        <span class="px-2 py-0.5 rounded text-xs font-medium
                                            {{ $todo->is_done ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                            {{ $todo->is_done ? 'Complete' : 'Ongoing' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            {{-- Tombol Complete (hanya muncul jika belum selesai) --}}
                                            @if (!$todo->is_done)
                                                <form action="{{ route('todo.complete', $todo->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-indigo-500 hover:text-indigo-700 text-sm font-medium">
                                                        Complete
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- Tombol Delete --}}
                                            <form action="{{ route('todo.destroy', $todo->id) }}" method="POST"
                                                onsubmit="return confirm('Delete this todo?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-400">No todos found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>