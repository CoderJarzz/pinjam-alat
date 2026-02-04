<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            
            $table->string('nama');                  // Nama barang
            $table->string('merk')->nullable();      // Merk barang
            $table->string('kategori')->nullable();  // Kategori, misal: alat tulis, elektronik, dll
            $table->enum('kondisi', ['baru', 'baik', 'rusak ringan', 'rusak berat'])->default('baik'); // Kondisi barang
            $table->integer('stok')->default(1);    // Jumlah unit tersedia
            $table->text('deskripsi')->nullable();  // Deskripsi tambahan
            $table->string('lokasi')->nullable();   // Lokasi penyimpanan
            $table->string('gambar')->nullable();   // Foto/gambar barang
            
            $table->enum('status', ['tersedia', 'disewa'])->default('tersedia'); // Status peminjaman
            
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
