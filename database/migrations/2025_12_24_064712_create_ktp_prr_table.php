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
        Schema::create('ktp_prr', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('no_hp');
            $table->string('kecamatan');
            $table->enum('keterangan', ['PRR', 'Hilang', 'Rusak', 'Perubahan']);
            $table->enum('keterangan_pengambilan', ['Diambil sendiri', 'Diwakilkan']);
            $table->enum('status', ['Diproses', 'Selesai', 'Diambil'])->default('Diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ktp_prr');
    }
};
