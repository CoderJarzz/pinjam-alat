<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-2">
            <a href="{{ route('barang.index') }}" class="text-sm text-indigo-500 hover:text-indigo-600">&larr; Kembali ke katalog</a>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Formulir Peminjaman Barang</h1>
            <p class="text-sm text-slate-500 dark:text-slate-300">
                Lengkapi data berikut sebelum mengajukan peminjaman. Stok tersedia:
                <span class="font-semibold text-indigo-600">{{ $barang->stok }}</span>
                dari {{ $barang->stok }} unit.
                Pastikan Anda sudah membaca 
                <a href="{{ route('faq') }}" class="text-indigo-500 font-semibold" target="_blank">FAQ &amp; Syarat & Ketentuan</a>.
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-[1.1fr,0.9fr]">
            <div class="rounded-2xl border border-slate-200 bg-white/95 p-6 shadow-lg dark:border-slate-800 dark:bg-slate-900/80">

                {{-- FORM --}}
                <form action="{{ route('sewa.store', $barang->id) }}" 
                      method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <input type="hidden" name="barang_id" value="{{ $barang->id }}">

                    {{-- Nama --}}
                    <div>
                        <label for="nama_penyewa" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1">Nama Lengkap</label>
                        <input type="text" id="nama_penyewa" name="nama_penyewa" 
                               value="{{ old('nama_penyewa', Auth::user()->name) }}" required
                               placeholder="Masukkan nama lengkap"
                               class="w-full rounded-xl border-gray-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        @error('nama_penyewa')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kelas --}}
                    <div>
                        <label for="kelas" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1">Kelas</label>
                        <input type="text" id="kelas" name="kelas" value="{{ old('kelas') }}" required
                            placeholder="Contoh: XI IPA 2"
                            class="w-full rounded-xl border-gray-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        @error('kelas')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hapus field nomor KTP dan foto KTP -->

                    {{-- Tanggal --}}
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1">Tanggal Mulai Pinjam</label>
                            <input type="text" value="{{ now()->translatedFormat('d M Y') }}" disabled
                                class="w-full rounded-xl border-gray-200 bg-gray-100 px-4 py-3 text-sm text-slate-600 dark:border-slate-700 dark:bg-slate-800">
                        </div>
                        <div>
                            <label for="tanggal_selesai" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1">Tanggal Pengembalian</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                value="{{ old('tanggal_selesai') }}" required
                                min="{{ now()->addDay()->toDateString() }}"
                                class="w-full rounded-xl border-gray-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            @error('tanggal_selesai')
                                <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Tanda Nama/Keterangan Sekolah --}}
                    <div>
                        <label for="tanda_nama" class="block text-sm font-semibold text-slate-700 dark:text-slate-200 mb-1">Tanda Nama / Keterangan</label>
                        <input type="text" id="tanda_nama" name="tanda_nama" value="{{ old('tanda_nama') }}"
                            placeholder="Contoh: XI IPA 2 / OSIS / Keperluan Praktikum"
                            class="w-full rounded-xl border-gray-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        @error('tanda_nama')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Persetujuan FAQ --}}
                    <label class="flex items-start gap-3 rounded-2xl border border-gray-200 bg-gray-50/80 px-4 py-3 text-sm text-slate-600 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200">
                        <input type="checkbox" name="setuju_faq" value="1" class="mt-1 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" required>
                        <span>Saya menyatakan sudah membaca dan menyetujui 
                            <a href="{{ route('faq') }}" target="_blank" class="font-semibold text-indigo-600">FAQ &amp; Syarat & Ketentuan</a>.
                        </span>
                    </label>

                    <div class="flex flex-col gap-3 mt-2">
                        <button type="submit"
                            class="w-full rounded-2xl bg-indigo-600 px-4 py-3 text-base font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:bg-indigo-500">
                            Ajukan Peminjaman
                        </button>
                    </div>
                </form>

            </div>

            {{-- SIDEBAR --}}
            <div class="rounded-2xl border border-slate-200 bg-white/90 p-6 shadow-lg dark:border-slate-800 dark:bg-slate-900/80">
                <div class="flex items-center gap-4 border-b border-slate-200 pb-4 dark:border-slate-800">
                    @if($barang->gambar)
                        <img src="{{ asset('storage/' . $barang->gambar) }}" class="h-20 w-20 rounded-xl object-cover" alt="{{ $barang->nama }}">
                    @else
                        <div class="h-20 w-20 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400">No Img</div>
                    @endif

                    <div>
                        <p class="text-xs uppercase tracking-widest text-slate-400">Perangkat</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $barang->nama }}</h2>
                        <span class="text-sm text-slate-500">{{ $barang->merk }}</span>
                    </div>
                </div>

                <div class="space-y-3 pt-4 text-sm text-slate-600 dark:text-slate-300">
                    <div class="flex justify-between">
                        <span>Kondisi</span>
                        <span class="font-semibold text-slate-900 dark:text-white">{{ ucfirst($barang->kondisi) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Kategori</span>
                        <span class="font-semibold text-slate-900 dark:text-white">{{ $barang->kategori }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Lokasi</span>
                        <span class="font-semibold text-slate-900 dark:text-white">{{ $barang->lokasi ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}

</x-app-layout>
