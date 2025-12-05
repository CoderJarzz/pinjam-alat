<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sewas', function (Blueprint $table) {
            $table->string('status_text')->default('pending')->after('total_harga');
        });

        DB::table('sewas')->update([
            'status_text' => DB::raw('status'),
        ]);

        Schema::table('sewas', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('sewas', function (Blueprint $table) {
            $table->renameColumn('status_text', 'status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sewas', function (Blueprint $table) {
            $table->enum('status_old', ['pending', 'disetujui', 'selesai'])->default('pending')->after('total_harga');
        });

        DB::table('sewas')->update([
            'status_old' => DB::raw('status'),
        ]);

        Schema::table('sewas', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('sewas', function (Blueprint $table) {
            $table->renameColumn('status_old', 'status');
        });
    }
};
