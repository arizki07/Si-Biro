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
        Schema::create('t_arsip', function (Blueprint $table) {
            $table->id('id_arsip');
            $table->unsignedBigInteger('id_layanan');
            $table->unsignedBigInteger('id_jadwal');
            $table->unsignedBigInteger('id_jamaah');
            $table->unsignedBigInteger('id_hasil');
            $table->text('nama_dokumen');
            $table->text('url_directory');
            $table->timestamps();

            $table->foreign('id_layanan')->references('id_layanan')->on('t_layanan');
            $table->foreign('id_jadwal')->references('id_jadwal')->on('t_jadwal');
            $table->foreign('id_jamaah')->references('id_jamaah')->on('t_jamaah');
            $table->foreign('id_hasil')->references('id_hasil')->on('t_hasil_jadwal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_arsip');
    }
};
