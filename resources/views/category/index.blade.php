<x-app-layout>
    <div class="py-10 max-w-4xl mx-auto sm:px-6 lg:px-8">

        <h1 class="text-2xl font-bold mb-6">Daftar Kategori</h1>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-100 text-emerald-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('category.create') }}" class="mb-4 inline-block px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
            Tambah Kategori Baru
        </a>

        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">No</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Nama Kategori</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($categories as $index => $category)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-sm">
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
