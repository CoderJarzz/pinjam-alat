<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except(['index']);
    }

    public function index()
    {
        $barangs = Barang::withCount('activeSewas as stok_terpakai')->get()->map(function ($barang) {
            $barang->stok_tersedia = max($barang->stok_total - $barang->stok_terpakai, 0);
            $barang->status_label = $barang->stok_tersedia > 0 ? 'tersedia' : 'disewa';
            return $barang;
        });

        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'harga_sewa' => 'required|numeric|min:0',
            'stok_total' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('gambar_hp', 'public');
        }

        $barang = Barang::create($validated);
        $barang->syncAvailability();

        return redirect()->route('barang.index')->with('success', 'HP berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'harga_sewa' => 'required|numeric|min:0',
            'stok_total' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $activeCount = $barang->activeSewas()->count();
        if ($validated['stok_total'] < $activeCount) {
            return back()->withErrors([
                'stok_total' => "Stok tidak boleh kurang dari jumlah sewa aktif ($activeCount unit).",
            ])->withInput();
        }

        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('gambar_hp', 'public');
        }

        $barang->update($validated);
        $barang->syncAvailability();

        return redirect()->route('barang.index')->with('success', 'HP berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->activeSewas()->exists()) {
            return redirect()->route('barang.index')->with('error', 'Tidak dapat menghapus barang yang masih memiliki sewa aktif.');
        }

        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'HP berhasil dihapus!');
    }
}
