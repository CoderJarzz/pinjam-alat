<x-app-layout>
    <div class="py-10 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                Edit Data Barang
            </h1>

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

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Barang</label>
                    <input type="text" name="nama"
                        value="{{ old('nama', $barang->nama) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        required>
                </div>

                {{-- Merk --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Merk</label>
                    <input type="text" name="merk"
                        value="{{ old('merk', $barang->merk) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>

                {{-- Kategori & Kondisi --}}
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                        <input type="text" name="kategori"
                            value="{{ old('kategori', $barang->kategori) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kondisi</label>
                        <select name="kondisi"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @foreach (['baru', 'baik', 'rusak ringan', 'rusak berat'] as $kondisi)
                                <option value="{{ $kondisi }}" @selected(old('kondisi', $barang->kondisi) === $kondisi)>
                                    {{ ucfirst($kondisi) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Stok --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stok Total</label>
                    <input type="number" min="1" name="stok_total"
                        value="{{ old('stok_total', $barang->stok_total) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        required>
                    <p class="mt-1 text-xs text-gray-500">
                        Sedang dipinjam: {{ $barang->activeSewas()->count() }} unit
                    </p>
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lokasi Penyimpanan</label>
                    <input type="text" name="lokasi"
                        value="{{ old('lokasi', $barang->lokasi) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                </div>

                {{-- Gambar --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar</label>
                    @if ($barang->gambar)
                        <img src="{{ asset('storage/' . $barang->gambar) }}"
                             class="w-32 h-32 object-cover rounded mb-2">
                    @endif
                    <input type="file" name="gambar" class="block w-full text-sm mt-1">
                </div>

                {{-- Tombol --}}
                <div class="flex justify-between mt-6">
                    <a href="{{ route('barang.index') }}"
                       class="px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded-lg">
                        Kembali
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
