<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sewas', function (Blueprint $table) {
            $table->string('nama_penyewa')->nullable()->after('user_id');
            $table->text('alamat')->nullable()->after('nama_penyewa');
            $table->string('nomor_ktp')->nullable()->after('alamat');
            $table->string('foto_ktp')->nullable()->after('nomor_ktp');
            $table->timestamp('faq_disetujui_pada')->nullable()->after('foto_ktp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sewas', function (Blueprint $table) {
            $table->dropColumn([
                'nama_penyewa',
                'alamat',
                'nomor_ktp',
                'foto_ktp',
                'faq_disetujui_pada',
            ]);
        });
    }
};
