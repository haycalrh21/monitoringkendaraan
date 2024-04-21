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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pegawai');
            $table->foreign('id_pegawai')->references('id')->on('pegawais');

            $table->unsignedBigInteger('id_kendaraan');
            $table->foreign('id_kendaraan')->references('id')->on('kendaraans');

            $table->unsignedBigInteger('id_atasan1')->nullable();
            $table->foreign('id_atasan1')->references('id')->on('users');

            $table->unsignedBigInteger('id_atasan2')->nullable();
            $table->foreign('id_atasan2')->references('id')->on('users');

            $table->string('nama_kendaraan');
            $table->string('nama');
            $table->enum('status1', ['Belum Disetujui', 'Disetujui'])->default('Belum Disetujui');
            $table->enum('status2', ['Belum Disetujui', 'Disetujui'])->default('Belum Disetujui');




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
