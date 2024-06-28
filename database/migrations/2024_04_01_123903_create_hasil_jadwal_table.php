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
        Schema::create('t_report', function (Blueprint $table) {
            $table->id('id_report');
            $table->string('id_layanan', 11);
            $table->string('id_jadwal', 11);
            $table->string('id_uraian_jadwal', 11);
            $table->string('id_jamaah', 11);
            $table->string('tipe_report', 30); // MCU-PASSPORT-BIMBINGAN-MANASIK
            $table->string('tahap', 30);
            $table->string('status_report', 20);
            $table->text('keterangan');
            $table->string('file_opsional', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_report');
    }
};
