<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function __construct()
    {
        // Hanya admin yang bisa menambah/edit/hapus, index bisa diakses semua
        $this->middleware('role:admin')->except(['index']);
    }

    // Tampilkan daftar barang
    public function index()
    {
        // Eager load relasi category dan hitung stok terpakai
        $barangs = Barang::with('category') // pastikan relasi 'category' ada di model
            ->withCount('activeSewas as stok_terpakai') // jumlah sewa aktif
            ->get()
            ->map(function ($barang) {
                // Hitung stok tersedia
                $barang->stok_tersedia = max($barang->stok_total - $barang->stok_terpakai, 0);
                // Label status: tersedia / dipinjam
                $barang->status_label = $barang->stok_tersedia > 0 ? 'tersedia' : 'dipinjam';
                return $barang;
            });

        return view('barang.index', compact('barangs'));
    }

    // Form tambah barang
    public function create()
    {
        $categories = Category::latest()->get();
        return view('barang.create', compact('categories'));
    }

    // Simpan barang baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'merk'        => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'kondisi'     => 'required|in:baru,baik,rusak ringan,rusak berat',
            'stok_total'  => 'required|integer|min:1',
            'deskripsi'   => 'nullable|string',
            'lokasi'      => 'nullable|string|max:255',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('gambar_barang', 'public');
        }

        $barang = Barang::create($validated);
        $barang->syncAvailability(); // jika ada fungsi untuk sinkron stok

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    // Form edit barang
    public function edit(Barang $barang)
    {
        $categories = Category::latest()->get();
        return view('barang.edit', compact('barang', 'categories'));
    }

    // Update barang
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'merk'        => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'kondisi'     => 'required|in:baru,baik,rusak ringan,rusak berat',
            'stok_total'  => 'required|integer|min:1',
            'deskripsi'   => 'nullable|string',
            'lokasi'      => 'nullable|string|max:255',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Cek stok minimal sesuai sewa aktif
        $activeCount = $barang->activeSewas()->count();
        if ($validated['stok_total'] < $activeCount) {
            return back()->withErrors([
                'stok_total' => "Stok tidak boleh kurang dari jumlah pinjaman aktif ($activeCount unit).",
            ])->withInput();
        }

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            if ($barang->gambar) Storage::disk('public')->delete($barang->gambar);
            $validated['gambar'] = $request->file('gambar')->store('gambar_barang', 'public');
        }

        $barang->update($validated);
        $barang->syncAvailability();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    // Hapus barang
    public function destroy(Barang $barang)
    {
        if ($barang->activeSewas()->exists()) {
            return redirect()->route('barang.index')
                ->with('error', 'Tidak dapat menghapus barang yang masih dipinjam.');
        }

        if ($barang->gambar) Storage::disk('public')->delete($barang->gambar);

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
