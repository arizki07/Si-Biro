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
        Schema::create('t_layanan', function (Blueprint $table) {
            $table->id('id_layanan');
            $table->string('judul_layanan', 100);
            $table->string('kuota', 20);
            $table->string('tahun_pemberangkatan', 20);
            $table->string('bulan_pemberangkatan', 25);
            $table->string('paket', 50);
            $table->string('status_paket', 20);
            $table->text('deskripsi');
            $table->string('foto_bg', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_layanan');
    }
};
