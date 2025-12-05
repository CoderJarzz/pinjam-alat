<x-app-layout>
    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4 text-gray-800">Tambah HP Baru</h1>

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
                <div>
                    <label class="text-sm font-semibold text-slate-600">Nama HP</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="mt-2 w-full rounded border px-3 py-2" required>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-600">Merk</label>
                    <input type="text" name="merk" value="{{ old('merk') }}" class="mt-2 w-full rounded border px-3 py-2" required>
                </div>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="text-sm font-semibold text-slate-600">Harga Sewa / Hari</label>
                        <input type="number" name="harga_sewa" value="{{ old('harga_sewa') }}" class="mt-2 w-full rounded border px-3 py-2" required>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-600">Stok Unit</label>
                        <input type="number" name="stok_total" value="{{ old('stok_total', 1) }}" min="1" class="mt-2 w-full rounded border px-3 py-2" required>
                    </div>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-600">Deskripsi</label>
                    <textarea name="deskripsi" class="mt-2 w-full rounded border px-3 py-2" rows="4">{{ old('deskripsi') }}</textarea>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-600">Gambar</label>
                    <input type="file" name="gambar" class="mt-2 w-full rounded border px-3 py-2">
                </div>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </form>
        </div>
    </div>
</x-app-layout>
