<x-app-layout>
    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        @if($user->isAdmin())
            <div class="grid gap-4 md:grid-cols-4">
                <div class="rounded-2xl bg-white/90 dark:bg-gray-900/80 p-5 shadow">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Pending</p>
                    <p class="mt-2 text-3xl font-bold text-amber-500">{{ $stats['pending'] }}</p>
                    <span class="text-xs text-gray-400">Menunggu ACC</span>
                </div>
                <div class="rounded-2xl bg-white/90 dark:bg-gray-900/80 p-5 shadow">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Berjalan</p>
                    <p class="mt-2 text-3xl font-bold text-blue-500">{{ $stats['berjalan'] }}</p>
                    <span class="text-xs text-gray-400">Sedang Dipinjam</span>
                </div>
                <div class="rounded-2xl bg-white/90 dark:bg-gray-900/80 p-5 shadow">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Selesai</p>
                    <p class="mt-2 text-3xl font-bold text-emerald-500">{{ $stats['selesai'] }}</p>
                    <span class="text-xs text-gray-400">Sudah kembali</span>
                </div>
                <div class="rounded-2xl bg-white/90 dark:bg-gray-900/80 p-5 shadow">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Gagal</p>
                    <p class="mt-2 text-3xl font-bold text-rose-500">{{ $stats['gagal'] }}</p>
                    <span class="text-xs text-gray-400">Ditolak / batal</span>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="rounded-2xl bg-white/95 dark:bg-gray-900/80 shadow">
                <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 px-6 py-4">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-500">Perlu ACC</p>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Antrian Pending</h2>
                    </div>
                    <a href="{{ route('dashboard.export') }}" class="inline-flex items-center rounded-full border border-indigo-200 px-4 py-2 text-sm font-semibold text-indigo-600 hover:bg-indigo-50 dark:border-indigo-500/30 dark:text-indigo-200 dark:hover:bg-indigo-500/10">
                        Unduh Laporan (Excel)
                    </a>
                </div>
                    @if($pendingSewa->isEmpty())
                        <p class="px-6 py-8 text-sm text-gray-500">Tidak ada pengajuan menunggu.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                                <thead class="bg-gray-50/70 dark:bg-gray-800/70">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Penyewa</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Perangkat</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @foreach($pendingSewa as $sewa)
                                        <tr class="hover:bg-gray-50/60 dark:hover:bg-gray-800/60 transition">
                                            <td class="px-4 py-3">
                                                <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $sewa->user->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $sewa->nama_penyewa }}</p>
                                                <p class="text-xs text-gray-400">{{ $sewa->nomor_ktp }}</p>
                                            </td>
                                            <td class="px-4 py-3">
                                                <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $sewa->barang->nama ?? '-' }}</p>
                                                <p class="text-xs text-gray-500">{{ $sewa->tanggal_mulai?->format('d M') }} - {{ $sewa->tanggal_selesai?->format('d M') }}</p>
                                            </td>
                                            <td class="px-4 py-3 space-y-2">
                                                <form method="POST" action="{{ route('sewa.approve', $sewa) }}">
                                                    @csrf
                                                    <button class="w-full rounded-lg bg-emerald-500 px-3 py-1.5 text-white text-xs font-semibold hover:bg-emerald-400">
                                                        Terima
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('sewa.reject', $sewa) }}" class="flex items-center gap-2 text-xs">
                                                    @csrf
                                                    <input type="text" name="alasan_penolakan" placeholder="Alasan" class="flex-1 rounded border px-2 py-1 text-xs" required>
                                                    <button class="rounded bg-rose-500 px-3 py-1.5 text-white font-semibold hover:bg-rose-400">Tolak</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <div class="rounded-2xl bg-white/95 dark:bg-gray-900/80 shadow">
                    <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 px-6 py-4">
                        <div>
                            <p class="text-xs uppercase tracking-widest text-gray-500">Sewa Aktif</p>
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Monitoring</h2>
                        </div>
                    </div>
                    @php
                        $aktifSewa = $recentSewa->filter(fn ($sewa) => $sewa->status === 'disetujui');
                    @endphp
                    @if($aktifSewa->isEmpty())
                        <p class="px-6 py-8 text-sm text-gray-500">Belum ada Pinjaman berjalan.</p>
                    @else
                        <div class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach($aktifSewa as $sewa)
                                <div class="px-6 py-4 flex items-center justify-between text-sm">
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $sewa->barang->nama ?? '-' }}</p>
                                        <p class="text-xs text-gray-500">Sampai {{ $sewa->tanggal_selesai?->format('d M Y') }} • {{ $sewa->user->name }}</p>
                                    </div>
                                    <form method="POST" action="{{ route('sewa.complete', $sewa) }}">
                                        @csrf
                                        <button class="rounded-lg bg-indigo-600 px-3 py-1.5 text-white text-xs font-semibold hover:bg-indigo-500">Tandai selesai</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="rounded-2xl bg-white/95 dark:bg-gray-900/80 shadow">
                <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 px-6 py-4">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-500">Stok Perangkat</p>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Ringkasan Stok</h2>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                        <thead class="bg-gray-50/70 dark:bg-gray-800/70">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Model</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Stok Total</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Dipakai</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Sisa</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse($stokSummary as $barang)
                                <tr>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $barang->nama }}</p>
                                        <p class="text-xs text-gray-500">{{ $barang->merk }}</p>
                                    </td>
                                    <td class="px-4 py-3">{{ $barang->stok_total }} unit</td>
                                    <td class="px-4 py-3">{{ $barang->stok_terpakai }} unit</td>
                                    <td class="px-4 py-3 font-semibold {{ $barang->stok_tersedia > 0 ? 'text-emerald-600' : 'text-rose-500' }}">{{ $barang->stok_tersedia }} unit</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">Belum ada data perangkat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif($user->isPetugas())
            <div class="grid gap-4 md:grid-cols-3">
                <div class="rounded-2xl bg-white/90 dark:bg-gray-900/80 p-5 shadow">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Pending</p>
                    <p class="mt-2 text-3xl font-bold text-amber-500">{{ $petugasStats['pending'] ?? 0 }}</p>
                    <span class="text-xs text-gray-400">Menunggu konfirmasi</span>
                </div>
                <div class="rounded-2xl bg-white/90 dark:bg-gray-900/80 p-5 shadow">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Berjalan</p>
                    <p class="mt-2 text-3xl font-bold text-blue-500">{{ $petugasStats['aktif'] ?? 0 }}</p>
                    <span class="text-xs text-gray-400">Sedang disewa</span>
                </div>
                <div class="rounded-2xl bg-white/90 dark:bg-gray-900/80 p-5 shadow">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Selesai</p>
                    <p class="mt-2 text-3xl font-bold text-emerald-500">{{ $petugasStats['selesai'] ?? 0 }}</p>
                    <span class="text-xs text-gray-400">Riwayat selesai</span>
                </div>
            </div>

            <div class="rounded-2xl bg-white/95 dark:bg-gray-900/80 shadow mt-8">
                <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 px-6 py-4">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-500">Riwayat</p>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Transaksi terbaru</h2>
                    </div>
                    <a href="{{ route('sewa.index') }}" class="text-sm text-indigo-500">Lihat semua</a>
                </div>
                @if($petugasRecentSewa->isEmpty())
                    <p class="px-6 py-8 text-sm text-gray-500">Belum ada transaksi peminjaman.</p>
                @else
                    <div class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($petugasRecentSewa as $sewa)
                            <div class="px-6 py-4 flex items-center justify-between text-sm">
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $sewa->barang->nama ?? '-' }}</p>
                                    <p class="text-xs text-gray-500">{{ $sewa->tanggal_mulai?->format('d M') }} - {{ $sewa->tanggal_selesai?->format('d M Y') }}</p>
                                </div>
                                <span class="rounded-full px-3 py-1 text-xs font-semibold
                                    @class([
                                        'bg-amber-100 text-amber-800' => $sewa->status === 'pending',
                                        'bg-blue-100 text-blue-800' => $sewa->status === 'disetujui',
                                        'bg-emerald-100 text-emerald-700' => $sewa->status === 'selesai',
                                        'bg-rose-100 text-rose-700' => $sewa->status === 'gagal',
                                    ])">
                                    {{ $sewa->status === 'disetujui' ? 'Berjalan' : ucfirst($sewa->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div class="grid gap-4 md:grid-cols-3">
                <div class="rounded-2xl bg-white/90 dark:bg-gray-900/80 p-5 shadow">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Pending</p>
                    <p class="mt-2 text-3xl font-bold text-amber-500">{{ $memberStats['pending'] }}</p>
                    <span class="text-xs text-gray-400">Menunggu acc admin</span>
                </div>
                <div class="rounded-2xl bg-white/90 dark:bg-gray-900/80 p-5 shadow">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Berjalan</p>
                    <p class="mt-2 text-3xl font-bold text-blue-500">{{ $memberStats['aktif'] }}</p>
                    <span class="text-xs text-gray-400">Sedang disewa</span>
                </div>
                <div class="rounded-2xl bg-white/90 dark:bg-gray-900/80 p-5 shadow">
                    <p class="text-xs uppercase tracking-widest text-gray-500">Selesai</p>
                    <p class="mt-2 text-3xl font-bold text-emerald-500">{{ $memberStats['selesai'] }}</p>
                    <span class="text-xs text-gray-400">Riwayat selesai</span>
                </div>
            </div>

            <div class="rounded-2xl bg-white/95 dark:bg-gray-900/80 shadow">
                <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 px-6 py-4">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-500">Riwayat</p>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Transaksi terbaru</h2>
                    </div>
                    <a href="{{ route('sewa.index') }}" class="text-sm text-indigo-500">Lihat semua</a>
                </div>
                @if($recentSewa->isEmpty())
                    <p class="px-6 py-8 text-sm text-gray-500">Belum ada transaksi. Mulai sewa perangkat favoritmu.</p>
                @else
                    <div class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($recentSewa as $sewa)
                            <div class="px-6 py-4 flex items-center justify-between text-sm">
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $sewa->barang->nama ?? '-' }}</p>
                                    <p class="text-xs text-gray-500">{{ $sewa->tanggal_mulai?->format('d M') }} - {{ $sewa->tanggal_selesai?->format('d M Y') }}</p>
                                </div>
                                <span class="rounded-full px-3 py-1 text-xs font-semibold
                                    @class([
                                        'bg-amber-100 text-amber-800' => $sewa->status === 'pending',
                                        'bg-blue-100 text-blue-800' => $sewa->status === 'disetujui',
                                        'bg-emerald-100 text-emerald-700' => $sewa->status === 'selesai',
                                        'bg-rose-100 text-rose-700' => $sewa->status === 'gagal',
                                    ])">
                                    {{ $sewa->status === 'disetujui' ? 'Berjalan' : ucfirst($sewa->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-app-layout>
