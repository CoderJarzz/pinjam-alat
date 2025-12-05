<x-app-layout>
    <div class="py-10 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Edit Data HP</h1>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-800 p-3 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama HP</label>
                    <input type="text" name="nama" id="nama"
                        value="{{ old('nama', $barang->nama) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label for="merk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Merk</label>
                    <input type="text" name="merk" id="merk"
                        value="{{ old('merk', $barang->merk) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label for="harga_sewa" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga Sewa / Hari</label>
                        <input type="number" name="harga_sewa" id="harga_sewa"
                            value="{{ old('harga_sewa', $barang->harga_sewa) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="stok_total" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stok Unit</label>
                        <input type="number" min="1" name="stok_total" id="stok_total"
                            value="{{ old('stok_total', $barang->stok_total) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Sewa aktif: {{ $barang->activeSewas()->count() }} unit</p>
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                </div>

                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar</label>
                    @if ($barang->gambar)
                        <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama }}"
                             class="w-32 h-32 object-cover rounded mb-2">
                    @endif
                    <input type="file" name="gambar" id="gambar"
                        class="block w-full text-sm text-gray-700 dark:text-gray-300 mt-1">
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('barang.index') }}"
                       class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-600">
                        Kembali
                    </a>
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
