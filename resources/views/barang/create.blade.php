<x-app-layout>
    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4 text-gray-800">Tambah Alat Baru</h1>

            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-50 p-3 text-sm text-red-700">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Nama Barang -->
                <div>
                    <label class="text-sm font-semibold text-slate-600">Nama Barang</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="mt-2 w-full rounded border px-3 py-2" required>
                </div>

                <!-- Merk -->
                <div>
                    <label class="text-sm font-semibold text-slate-600">Merk / Merek</label>
                    <input type="text" name="merk" value="{{ old('merk') }}" class="mt-2 w-full rounded border px-3 py-2">
                </div>

                <!-- Kategori & Kondisi -->
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="text-sm font-semibold text-slate-600">Kategori</label>
                        <select name="category_id" class="mt-2 w-full rounded border px-3 py-2" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-slate-600">Kondisi</label>
                        <select name="kondisi" class="mt-2 w-full rounded border px-3 py-2">
                            <option value="baru" {{ old('kondisi') == 'baru' ? 'selected' : '' }}>Baru</option>
                            <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="rusak ringan" {{ old('kondisi') == 'rusak ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="rusak berat" {{ old('kondisi') == 'rusak berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                    </div>
                </div>

                <!-- Stok & Lokasi -->
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="text-sm font-semibold text-slate-600">Stok Unit</label>
                        <input type="number" name="stok_total" value="{{ old('stok_total', 1) }}" min="1" class="mt-2 w-full rounded border px-3 py-2" required>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-600">Lokasi Penyimpanan</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="mt-2 w-full rounded border px-3 py-2">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="text-sm font-semibold text-slate-600">Deskripsi</label>
                    <textarea name="deskripsi" class="mt-2 w-full rounded border px-3 py-2" rows="4">{{ old('deskripsi') }}</textarea>
                </div>

                <!-- Gambar -->
                <div>
                    <label class="text-sm font-semibold text-slate-600">Gambar</label>
                    <input type="file" name="gambar" class="mt-2 w-full rounded border px-3 py-2">
                </div>

                <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </form>
        </div>
    </div>
</x-app-layout>
