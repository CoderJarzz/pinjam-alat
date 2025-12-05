<x-app-layout>
    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col gap-2 mb-8 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-indigo-500">Riwayat Penyewaan</p>
                <h1 class="text-3xl font-bold text-gray-900">Semua transaksi {{ $isAdmin ? 'pelanggan' : 'Anda' }}</h1>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $isAdmin ? 'Pantau pergerakan stok dan transaksi terbaru member.' : 'Lihat semua HP yang pernah atau sedang Anda sewa.' }}
                </p>
            </div>
            <span class="inline-flex items-center gap-2 self-start rounded-full border px-4 py-1 text-sm font-semibold text-gray-600 border-gray-200 bg-white shadow-sm dark:bg-gray-800 dark:text-gray-100 dark:border-gray-700">
                <span class="h-2.5 w-2.5 rounded-full {{ $isAdmin ? 'bg-rose-500' : 'bg-emerald-500' }}"></span>
                {{ $isAdmin ? 'Mode Admin' : 'Mode Member' }}
            </span>
        </div>

        <div class="bg-white/90 dark:bg-gray-900/80 backdrop-blur rounded-2xl shadow-xl ring-1 ring-gray-100 dark:ring-gray-800">
            @if($sewas->isEmpty())
                <div class="p-10 text-center text-gray-500">
                    <p class="text-lg font-medium">Belum ada transaksi.</p>
                    <p class="text-sm mt-2">Mulai sewa perangkat untuk melihat riwayat Anda di sini.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                        <thead class="bg-gray-50/70 dark:bg-gray-800/70">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600">Perangkat</th>
                                @if($isAdmin)
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600">Penyewa</th>
                                @endif
                                <th class="px-6 py-3 text-left font-semibold text-gray-600">Tanggal</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600">Data Penyewa</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600">Total</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach($sewas as $sewa)
                                <tr class="hover:bg-gray-50/60 dark:hover:bg-gray-800/60 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900 dark:text-gray-100">{{ $sewa->barang->nama ?? '-' }}</div>
                                        <div class="text-xs text-gray-500">{{ $sewa->barang->merk ?? '' }}</div>
                                    </td>
                                    @if($isAdmin)
                                        <td class="px-6 py-4">
                                            <div class="font-medium text-gray-900 dark:text-gray-100">{{ $sewa->user->name ?? '-' }}</div>
                                            <div class="text-xs text-gray-500">{{ $sewa->user->email ?? '' }}</div>
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 text-gray-700 dark:text-gray-200">
                                        @php
                                            $durasi = 0;
                                            if ($sewa->tanggal_mulai && $sewa->tanggal_selesai) {
                                                $durasi = $sewa->tanggal_mulai->diffInDays($sewa->tanggal_selesai);
                                            }
                                            $durasi = max($durasi, 1);
                                        @endphp
                                        <div class="font-medium">
                                            {{ $sewa->tanggal_mulai?->translatedFormat('d M Y') }} - {{ $sewa->tanggal_selesai?->translatedFormat('d M Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">({{ $durasi }} hari)</div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700 dark:text-gray-200">
                                        <div class="font-semibold text-gray-900 dark:text-gray-100">{{ $sewa->nama_penyewa ?? ($sewa->user->name ?? '-') }}</div>
                                        <div class="text-xs text-gray-500">KTP: {{ $sewa->nomor_ktp ?? '-' }}</div>
                                        <div class="text-xs text-gray-500 line-clamp-2">{{ $sewa->alamat ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-gray-100">
                                        Rp {{ number_format($sewa->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statuses = [
                                                'pending' => 'bg-amber-100 text-amber-800',
                                                'disetujui' => 'bg-blue-100 text-blue-800',
                                                'selesai' => 'bg-emerald-100 text-emerald-700',
                                                'gagal' => 'bg-rose-100 text-rose-700',
                                            ];
                                            $statusLabels = [
                                                'pending' => 'Menunggu ACC',
                                                'disetujui' => 'Berjalan',
                                                'selesai' => 'Selesai',
                                                'gagal' => 'Gagal',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $statuses[$sewa->status] ?? 'bg-gray-100 text-gray-600' }}">
                                            {{ $statusLabels[$sewa->status] ?? ucfirst($sewa->status) }}
                                        </span>
                                        @if($sewa->status === 'gagal' && $sewa->alasan_penolakan)
                                            <p class="mt-1 text-xs text-rose-600">Alasan: {{ $sewa->alasan_penolakan }}</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
