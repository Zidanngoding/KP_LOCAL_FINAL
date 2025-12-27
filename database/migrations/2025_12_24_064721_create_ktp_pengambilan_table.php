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
        Schema::create('ktp_pengambilan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('kecamatan');
            $table->string('foto_bukti');
            $table->text('keterangan')->nullable();
            $table->timestamp('tanggal_ambil')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ktp_pengambilan');
    }
};
