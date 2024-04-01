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
        Schema::create('t_jamaah', function (Blueprint $table) {
            $table->id('id_jamaah');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_role');
            $table->unsignedBigInteger('id_layanan');
            $table->string('nama_lengkap', 150);
            $table->string('umur', 20);
            $table->string('jk', 10);
            $table->string('status', 20);
            $table->string('tempat_lahir', 50);
            $table->date('tgl_lahir');
            $table->string('no_hp', 20);
            $table->string('no_hp_wali', 20);
            $table->string('no_rekening', 30);
            $table->string('no_ktp', 30);
            $table->string('no_kk', 30);
            $table->string('no_passport', 30)->nullable(); // jika blm ada, biarkan null
            $table->string('bank', 15);
            $table->string('berat_badan', 20);
            $table->string('tinggi_badan', 20);
            $table->string('warna_kulit', 30);
            $table->string('pekerjaan', 100);
            $table->string('pendidikan', 20);
            $table->string('pernah_haji_umroh', 100);
            $table->string('kelurahan', 100);
            $table->string('kecamatan', 100);
            $table->string('kota_kabupaten', 100);
            $table->string('provinsi', 100);
            $table->string('kode_pos', 20);
            $table->text('alamat_lengkap');
            $table->string('warga_negara', 100);
            $table->string('gol_darah', 100);
            $table->string('foto_ktp', 200);
            $table->string('foto_kk', 200);
            $table->string('foto_passport', 200)->nullable(); // jika blm ada, biarkan null
            $table->string('pas_foto', 200);
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_role')->references('id_role')->on('t_role');
            $table->foreign('id_layanan')->references('id_layanan')->on('t_layanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_jamaah');
    }
};
