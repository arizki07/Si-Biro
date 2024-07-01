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
        Schema::create('t_role', function (Blueprint $table) {
            $table->id('id_role', 50);
            $table->enum('role', ['admin', 'jamaah', 'finance', 'front office', 'kbih'])->default('jamaah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_role');
    }
};
