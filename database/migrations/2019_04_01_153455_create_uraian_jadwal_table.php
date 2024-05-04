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
        Schema::create('t_uraian_jadwal', function (Blueprint $table) {
            $table->id('id_uraian_jadwal');
            $table->unsignedBigInteger('id_jadwal');
            $table->string('nomor_jadwal');

            // tipe MCU
            $table->date('tgl_mulai_mcu')->nullable();
            $table->date('tgl_selesai_mcu')->nullable();
            $table->time('jam_mulai_mcu')->nullable();
            $table->time('jam_selesai_mcu')->nullable();
            $table->string('tempat_mcu', 100)->nullable();

            // tipe BIMBINGAN
            $table->date('tgl_mulai_bimbingan')->nullable();
            $table->date('tgl_selesai_bimbingan')->nullable();
            $table->time('jam_mulai_bimbingan')->nullable();
            $table->time('jam_selesai_bimbingan')->nullable();
            $table->string('nama_bimbingan', 150)->nullable();

            // tipe PASSPORT
            $table->date('tgl_mulai_passport')->nullable();
            $table->date('tgl_selesai_passport')->nullable();
            $table->time('jam_mulai_passport')->nullable();
            $table->time('jam_selesai_passport')->nullable();
            $table->string('tempat_pembuatan_passport', 150)->nullable();

            $table->string('flag_update', 15);
            $table->timestamps();

            // FK
            $table->foreign('id_jadwal')->references('id_jadwal')->on('t_jadwal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_raian_jadwal');
    }
};