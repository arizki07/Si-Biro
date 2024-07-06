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
        Schema::create('t_keuangan', function (Blueprint $table) {
            $table->id('id_keuangan');
            $table->unsignedBigInteger('id_jamaah');
            $table->unsignedBigInteger('id_transaksi');
            $table->string('pembayaran');
            $table->string('tipe_keuangan', 50); // CICILAN/PELUNASAN
            $table->date('periode');
            $table->timestamps();

            $table->foreign('id_jamaah')->references('id_jamaah')->on('t_jamaah');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('t_transaksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_keuangan');
    }
};
