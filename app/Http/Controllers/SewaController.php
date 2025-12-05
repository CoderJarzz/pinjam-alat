<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Sewa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SewaController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:member')->only(['create', 'store']);
        $this->middleware('role:admin')->only(['approve', 'reject', 'complete']);
    }

    public function index(Request $request)
    {
        $user = $request->user();

        $sewasQuery = Sewa::with(['barang', 'user'])->latest();

        if ($user && $user->isAdmin()) {
            $sewas = $sewasQuery->get();
        } else {
            $sewas = $sewasQuery->where('user_id', optional($user)->id)->get();
        }

        return view('sewa.index', [
            'sewas' => $sewas,
            'isAdmin' => $user?->isAdmin() ?? false,
        ]);
    }

    public function create(Barang $barang)
    {
        if ($barang->stokTersedia() <= 0) {
            return redirect()->route('barang.index')->with('error', 'Stok perangkat ini sudah habis.');
        }

        return view('sewa.create', compact('barang'));
    }

    public function store(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_penyewa' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:1000'],
            'nomor_ktp' => ['required', 'string', 'max:50'],
            'foto_ktp' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'tanggal_selesai' => ['required', 'date', 'after:today'],
            'setuju_faq' => ['accepted'],
        ]);

        if ($barang->stokTersedia() <= 0) {
            return back()->withErrors(['stok' => 'Maaf, stok perangkat ini sedang penuh.'])->withInput();
        }

        $tanggal_mulai = Carbon::now();
        $tanggal_selesai = Carbon::parse($request->input('tanggal_selesai'));

        if ($tanggal_selesai->lessThanOrEqualTo($tanggal_mulai)) {
            return back()->withErrors(['tanggal_selesai' => 'Tanggal selesai harus setelah hari ini.'])->withInput();
        }

        $durasiHari = max($tanggal_mulai->diffInDays($tanggal_selesai), 1);
        $total_harga = $barang->harga_sewa * $durasiHari;

        $fotoPath = $request->hasFile('foto_ktp')
            ? $request->file('foto_ktp')->store('ktp', 'public')
            : null;

        Sewa::create([
            'user_id' => Auth::id(),
            'barang_id' => $barang->id,
            'nama_penyewa' => $request->input('nama_penyewa'),
            'alamat' => $request->input('alamat'),
            'nomor_ktp' => $request->input('nomor_ktp'),
            'foto_ktp' => $fotoPath,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'total_harga' => $total_harga,
            'status' => Sewa::STATUS_PENDING,
            'faq_disetujui_pada' => now(),
        ]);

        $barang->syncAvailability();

        return redirect()->route('sewa.index')->with('success', 'Pengajuan sewa berhasil! Admin akan memverifikasi data Anda.');
    }

    public function approve(Sewa $sewa)
    {
        if ($sewa->status !== Sewa::STATUS_PENDING) {
            return back()->with('error', 'Hanya sewa berstatus pending yang bisa disetujui.');
        }

        $sewa->update([
            'status' => Sewa::STATUS_BERHASIL,
            'alasan_penolakan' => null,
        ]);

        $sewa->barang?->syncAvailability();

        return back()->with('success', "Sewa #{$sewa->id} disetujui.");
    }

    public function reject(Request $request, Sewa $sewa)
    {
        if (! in_array($sewa->status, [Sewa::STATUS_PENDING, Sewa::STATUS_BERHASIL], true)) {
            return back()->with('error', 'Status sewa sudah tidak bisa digagalkan.');
        }

        $data = $request->validate([
            'alasan_penolakan' => ['required', 'string', 'max:500'],
        ]);

        $sewa->update([
            'status' => Sewa::STATUS_GAGAL,
            'alasan_penolakan' => $data['alasan_penolakan'],
        ]);

        $sewa->barang?->syncAvailability();

        return back()->with('success', "Sewa #{$sewa->id} ditandai gagal.");
    }

    public function complete(Sewa $sewa)
    {
        if ($sewa->status !== Sewa::STATUS_BERHASIL) {
            return back()->with('error', 'Hanya sewa aktif yang dapat diselesaikan.');
        }

        $sewa->update([
            'status' => Sewa::STATUS_SELESAI,
        ]);

        $sewa->barang?->syncAvailability();

        return back()->with('success', "Sewa #{$sewa->id} selesai.");
    }
}
