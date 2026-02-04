<x-app-layout>
    @php($user = auth()->user())

    <style>
        .fade-in { opacity: 0; animation: fadeIn 0.8s ease-in-out forwards; }
        @keyframes fadeIn { to { opacity: 1; } }
        .floating { transition: transform 0.25s ease, box-shadow 0.25s ease; }
        .floating:hover { transform: translateY(-6px) scale(1.02); box-shadow: 0 12px 25px rgba(0,0,0,0.15); }
    </style>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8 fade-in">

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-6">
            <div>
                <p class="text-sm font-semibold text-indigo-500">Katalog Perangkat</p>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Daftar Alat Siap Pinjam</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $user?->isAdmin() ? 'Admin dapat menambah, mengedit, atau menghapus stok.' : 'Member dapat memilih perangkat favorit lalu lanjutkan proses pinjam.' }}
                </p>


            @if($user && !$user->isPetugas())
                <a href="{{ route('barang.create') }}"
                   class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg shadow-md transition-all floating">
                    + Tambah alat
                </a>

            @endif
        </div>
        <!-- Daftar barang dan konten lain di sini -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($barangs as $barang)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    @if($barang->gambar)
                        <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama }}" class="h-48 w-full object-cover">
                    @else
                        <div class="h-48 flex items-center justify-center bg-gray-100 text-gray-400">
                            <span>Tidak ada gambar</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-1">{{ $barang->nama }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $barang->merk }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Stok tersedia: <span class="font-semibold">{{ $barang->stok_tersedia ?? $barang->stokTersedia() }}</span> / {{ $barang->stok_total }} unit</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Sedang dipinjam: <span class="font-semibold">{{ $barang->stok_terpakai ?? ($barang->stok_total - ($barang->stok_tersedia ?? $barang->stokTersedia())) }}</span> unit</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Kategori: <span class="font-semibold">{{ $barang->category->name ?? '-' }}</span></p>
                        <div class="flex justify-between items-center mt-2">
                            <span class="px-2 py-1 text-xs rounded-full {{ ($barang->stok_tersedia ?? $barang->stokTersedia()) > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ($barang->stok_tersedia ?? $barang->stokTersedia()) > 0 ? 'Tersedia' : 'Penuh' }}
                            </span>
                            @if($user?->isAdmin())
                                <div class="flex space-x-3 text-sm font-semibold">
                                    <a href="{{ route('barang.edit', $barang->id) }}" class="text-amber-500 hover:text-amber-400 transition">Edit</a>
                                    <form id="delete-form-{{ $barang->id }}" action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $barang->id }})" class="text-red-500 hover:text-red-400 transition">Hapus</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        @if(($barang->stok_tersedia ?? $barang->stokTersedia()) > 0)
                            @if($user?->isMember())
                                <a href="{{ route('sewa.create', $barang->id) }}" class="mt-4 inline-flex w-full items-center justify-center rounded-lg bg-indigo-600 px-3 py-2 font-semibold text-white transition hover:bg-indigo-500">
                                    Ajukan Peminjaman
                                </a>
                                <p class="mt-2 text-xs text-slate-400">Pastikan baca <a href="{{ route('faq') }}" class="font-semibold text-indigo-500">FAQ</a> sebelum lanjut.</p>
                            @else
                                <p class="mt-4 text-sm text-gray-400">Modul peminjaman hanya tersedia untuk member.</p>
                            @endif
                        @else
                            <button disabled class="w-full bg-gray-200 text-gray-600 px-3 py-2 rounded-lg mt-4 cursor-not-allowed">Sedang Dipinjam Semua</button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-500 dark:text-gray-400">Belum ada barang yang tersedia.</div>
            @endforelse
        </div>
</x-app-layout>
