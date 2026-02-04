<?php

namespace App\Http\Controllers;

use App\Exports\SewaExport;
use App\Models\Barang;
use App\Models\Sewa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $stats = [
                'pending' => Sewa::where('status', Sewa::STATUS_PENDING)->count(),
                'berjalan' => Sewa::whereIn('status', [Sewa::STATUS_BERHASIL, 'disetujui'])->count(),
                'selesai' => Sewa::where('status', Sewa::STATUS_SELESAI)->count(),
                'gagal' => Sewa::where('status', Sewa::STATUS_GAGAL)->count(),
            ];

            $pendingSewa = Sewa::with(['barang', 'user'])
                ->where('status', Sewa::STATUS_PENDING)
                ->orderBy('created_at')
                ->get();

            $recentSewa = Sewa::with(['barang', 'user'])->latest()->take(5)->get();

            $stokSummary = Barang::withCount('activeSewas as stok_terpakai')->get()->map(function ($barang) {
                $barang->stok_tersedia = max($barang->stok_total - $barang->stok_terpakai, 0);
                return $barang;
            });

            return view('dashboard', [
                'user' => $user,
                'stats' => $stats,
                'pendingSewa' => $pendingSewa,
                'recentSewa' => $recentSewa,
                'stokSummary' => $stokSummary,
            ]);
        } elseif ($user->isPetugas()) {
            // Petugas melihat semua peminjaman, bisa konfirmasi
            $petugasStats = [
                'pending' => Sewa::where('status', Sewa::STATUS_PENDING)->count(),
                'aktif' => Sewa::whereIn('status', [Sewa::STATUS_BERHASIL, 'disetujui'])->count(),
                'selesai' => Sewa::where('status', Sewa::STATUS_SELESAI)->count(),
            ];
            $petugasRecentSewa = Sewa::with(['barang', 'user'])->latest()->take(5)->get();
            return view('dashboard', [
                'user' => $user,
                'petugasStats' => $petugasStats,
                'petugasRecentSewa' => $petugasRecentSewa,
            ]);
        } else {
            $memberStats = [
                'pending' => Sewa::where('user_id', $user->id)->where('status', Sewa::STATUS_PENDING)->count(),
                'aktif' => Sewa::where('user_id', $user->id)->whereIn('status', [Sewa::STATUS_BERHASIL, 'disetujui'])->count(),
                'selesai' => Sewa::where('user_id', $user->id)->where('status', Sewa::STATUS_SELESAI)->count(),
            ];

            $recentSewa = Sewa::with('barang')
                ->where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get();

            return view('dashboard', [
                'user' => $user,
                'memberStats' => $memberStats,
                'recentSewa' => $recentSewa,
            ]);
        }
    }

    public function export(Request $request)
    {
        $this->authorizeAdmin($request->user());

        $filename = 'laporan-sewa-'.now()->format('Ymd_His').'.xlsx';
        $sewas = Sewa::with(['barang', 'user'])->orderByDesc('created_at')->get();

        return Excel::download(new SewaExport($sewas), $filename);
    }

    protected function authorizeAdmin($user): void
    {
        abort_unless($user && $user->isAdmin(), 403, 'Hanya admin yang boleh melakukan tindakan ini.');
    }
}
