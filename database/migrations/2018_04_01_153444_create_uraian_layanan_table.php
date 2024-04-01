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
        Schema::create('t_uraian_layanan', function (Blueprint $table) {
            $table->id('id_uraian_layanan');
            $table->unsignedBigInteger('id_layanan');
            $table->string('uraian', 200);
            $table->string('keterangan', 200);
            $table->timestamps();

            $table->foreign('id_layanan')->references('id_layanan')->on('t_layanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_uraian_layanan');
    }
};
