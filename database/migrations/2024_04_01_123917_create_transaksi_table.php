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
        Schema::create('t_transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('id_jamaah');
            $table->unsignedBigInteger('id_layanan');
            $table->string('tipe_pembayaran', 20); // BANK/QRIS/E-Money/KREDIT CARD DLL (Tipe Select ajah biar permananet)
            $table->string('jumlah_pembayaran', 50);
            $table->string('status_pembayaran', 20);
            $table->string('tanggal_pembayaran', 20);
            $table->string('foto_bukti_pembayaran', 200);
            $table->timestamps();

            $table->foreign('id_jamaah')->references('id_jamaah')->on('t_jamaah');
            $table->foreign('id_layanan')->references('id_layanan')->on('t_layanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_transaksi');
    }
};
