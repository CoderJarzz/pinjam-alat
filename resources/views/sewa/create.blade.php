<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-2">
            <a href="{{ route('barang.index') }}" class="text-sm text-indigo-500 hover:text-indigo-600">&larr; Kembali ke katalog</a>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Formulir Sewa</h1>
            <p class="text-sm text-slate-500 dark:text-slate-300">
                Lengkapi data berikut sebelum konfirmasi. Stok tersisa: <span class="font-semibold text-indigo-600">{{ $barang->stokTersedia() }}</span> dari {{ $barang->stok_total }} unit.
                Pastikan Anda sudah membaca <a href="{{ route('faq') }}" class="text-indigo-500 font-semibold" target="_blank">FAQ &amp; S&K</a>.
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-[1.1fr,0.9fr]">
            <div class="rounded-2xl border border-slate-200 bg-white/95 p-6 shadow-lg dark:border-slate-800 dark:bg-slate-900/80">
                <form action="{{ route('sewa.store', $barang->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <input type="hidden" name="barang_id" value="{{ $barang->id }}">

                    <div>
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Nama Lengkap</label>
                        <input type="text" name="nama_penyewa" value="{{ old('nama_penyewa', Auth::user()->name) }}" required class="mt-2 w-full rounded-xl border-gray-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        <x-input-error :messages="$errors->get('nama_penyewa')" class="mt-2" />
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" required class="mt-2 w-full rounded-xl border-gray-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">{{ old('alamat') }}</textarea>
                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Nomor KTP</label>
                            <input type="text" name="nomor_ktp" value="{{ old('nomor_ktp') }}" required class="mt-2 w-full rounded-xl border-gray-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <x-input-error :messages="$errors->get('nomor_ktp')" class="mt-2" />
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Foto KTP (opsional)</label>
                            <input type="file" name="foto_ktp" accept="image/*" class="mt-2 block w-full rounded-xl border border-dashed border-gray-300 bg-white px-4 py-3 text-sm text-gray-500 focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-600 dark:bg-slate-900">
                            <x-input-error :messages="$errors->get('foto_ktp')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Mulai Sewa</label>
                            <input type="text" value="{{ now()->translatedFormat('d M Y') }}" disabled class="mt-2 w-full rounded-xl border-gray-200 bg-gray-100 px-4 py-3 text-sm text-slate-600 dark:border-slate-700 dark:bg-slate-800">
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Sampai Tanggal</label>
                            <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required min="{{ now()->addDay()->toDateString() }}" class="mt-2 w-full rounded-xl border-gray-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <x-input-error :messages="$errors->get('tanggal_selesai')" class="mt-2" />
                        </div>
                    </div>

                    <label class="flex items-start gap-3 rounded-2xl border border-gray-200 bg-gray-50/80 px-4 py-3 text-sm text-slate-600 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200">
                        <input type="checkbox" name="setuju_faq" value="1" {{ old('setuju_faq') ? 'checked' : '' }} class="mt-1 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span>Saya menyatakan sudah membaca dan menyetujui <a href="{{ route('faq') }}" target="_blank" class="font-semibold text-indigo-600">FAQ serta Syarat &amp; Ketentuan</a>.</span>
                    </label>
                    <x-input-error :messages="$errors->get('setuju_faq')" class="mt-2" />

                    <button type="submit" class="w-full rounded-2xl bg-indigo-600 px-4 py-3 text-base font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:bg-indigo-500">
                        Konfirmasi &amp; Sewa Sekarang
                    </button>
                </form>
            </div>

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
                        <span>Harga sewa / hari</span>
                        <span class="font-semibold text-slate-900 dark:text-white">Rp {{ number_format($barang->harga_sewa, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Status perangkat</span>
                        <span class="{{ $barang->status === 'tersedia' ? 'text-emerald-600' : 'text-amber-500' }} font-semibold">{{ ucfirst($barang->status) }}</span>
                    </div>
                    <div class="rounded-xl bg-indigo-50/70 p-4 text-xs text-slate-600 dark:bg-indigo-500/10 dark:text-indigo-100">
                        Estimasi total akan dihitung otomatis berdasarkan tanggal selesai. Admin akan menghubungi Anda setelah data diverifikasi.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
