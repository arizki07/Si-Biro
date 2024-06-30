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
        Schema::create('t_grup', function (Blueprint $table) {
            $table->id('id_grup');
            $table->unsignedBigInteger('id_jamaah');
            $table->string('kode_grup');
            $table->string('no_hp');
            $table->timestamps();

            $table->foreign('id_jamaah')->references('id_jamaah')->on('t_jamaah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_grup');
    }
};
