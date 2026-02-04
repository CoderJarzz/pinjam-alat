<x-app-layout>
    <div class="py-10 max-w-2xl mx-auto sm:px-6 lg:px-8">

        <h1 class="text-2xl font-bold mb-6">Tambah Kategori Baru</h1>

        {{-- Error --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('category.store') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Nama Kategori</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <div class="flex justify-between items-center mt-4">
                <a href="{{ route('category.index') }}" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg transition">
                    Kembali
                </a>

                <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold transition">
                    Simpan
                </button>
            </div>
        </form>

    </div>
</x-app-layout>
