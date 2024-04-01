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
        Schema::create('t_jadwal', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->unsignedBigInteger('id_layanan');
            $table->string('nomor_jadwal', 30);
            $table->string('judul_jadwal', 150);
            $table->string('tipe_jadwal', 30); // tipe => 1 = jadwal_MCU, 2 = jadwal_PASPORT, 3 = jadwal_BIMBINGAN 
            $table->string('jangka_waktu', 20); // dalam bentuk hari INT cth : 3 berarti 3 hari
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->timestamps();

            $table->foreign('id_layanan')->references('id_layanan')->on('t_layanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_jadwal');
    }
};
