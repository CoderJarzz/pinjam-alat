<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sewas', function (Blueprint $table) {
            $table->string('kelas')->nullable()->after('nama_penyewa');
            $table->string('tanda_nama')->nullable()->after('kelas');
        });
    }

    public function down(): void
    {
        Schema::table('sewas', function (Blueprint $table) {
            $table->dropColumn(['kelas', 'tanda_nama']);
        });
    }
};