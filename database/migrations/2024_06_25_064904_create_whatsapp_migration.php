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
        Schema::create('log_app', function (Blueprint $table) {
            $table->id();
            $table->string('action')->nullable();
            $table->string('id_jamaah')->nullable();
            $table->string('ip')->nullable();
            $table->TEXT('json')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_app');
    }
};
