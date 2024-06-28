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
            // $table->unsignedBigInteger('id_jadwal');
            $table->string('nomor_jadwal');
            $table->string('tahap');

            // tipe MCU
            $table->string('judul_mcu', 255)->nullable();
            $table->date('tgl_mulai_mcu')->nullable();
            $table->date('tgl_selesai_mcu')->nullable();
            $table->time('jam_mulai_mcu')->nullable();
            $table->time('jam_selesai_mcu')->nullable();
            $table->string('tempat_mcu', 100)->nullable();
            $table->text('keterangan_mcu')->nullable();
            $table->text('file_mcu')->nullable();
            
            // tipe BIMBINGAN
            $table->string('judul_bimbingan', 150)->nullable();
            $table->date('tgl_mulai_bimbingan')->nullable();
            $table->date('tgl_selesai_bimbingan')->nullable();
            $table->time('jam_mulai_bimbingan')->nullable();
            $table->time('jam_selesai_bimbingan')->nullable();
            $table->string('tempat_bimbingan', 100)->nullable();
            $table->text('keterangan_bimbingan')->nullable();
            $table->text('file_bimbingan')->nullable();
            
            // tipe PASSPORT
            $table->string('judul_passport', 150)->nullable();
            $table->date('tgl_mulai_passport')->nullable();
            $table->date('tgl_selesai_passport')->nullable();
            $table->time('jam_mulai_passport')->nullable();
            $table->time('jam_selesai_passport')->nullable();
            $table->string('tempat_passport', 150)->nullable();
            $table->text('keterangan_passport')->nullable();
            $table->text('file_passport')->nullable();
            
            // tipe MANASIK
            $table->string('judul_manasik', 150)->nullable();
            $table->date('tgl_mulai_manasik')->nullable();
            $table->date('tgl_selesai_manasik')->nullable();
            $table->time('jam_mulai_manasik')->nullable();
            $table->time('jam_selesai_manasik')->nullable();
            $table->string('tempat_manasik', 150)->nullable();
            $table->text('keterangan_manasik')->nullable();
            $table->text('file_manasik')->nullable();

            $table->timestamps();

            // FK
            // $table->foreign('id_jadwal')->references('id_jadwal')->on('t_jadwal')->onDelete('cascade');
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