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
        // Update kolom role di tabel users
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'bendahara', 'viewer'])
                  ->default('bendahara')
                  ->after('password')
                  ->change();
        });

        // Tambah kolom total_anggaran di tabel laporan
        Schema::table('laporan', function (Blueprint $table) {
            $table->decimal('total_anggaran', 15, 2)
                  ->default(0)
                  ->after('id'); // sesuaikan posisi after-nya
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Balik ke definisi lama
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'bendahara'])
                  ->default('bendahara')
                  ->after('password')
                  ->change();
        });

        Schema::table('laporan', function (Blueprint $table) {
            $table->dropColumn('total_anggaran');
        });
    }
};
