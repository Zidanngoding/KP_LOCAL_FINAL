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
        Schema::table('ktp_prr', function (Blueprint $table) {
            $table->enum('keterangan_pengambilan', ['Diambil sendiri', 'Diwakilkan satu KK', 'Diwakilkan surat Dinas Sosial', 'Diwakilkan surat Kelurahan'])->change();
        });
    }

    public function down(): void
    {
        Schema::table('ktp_prr', function (Blueprint $table) {
            $table->enum('keterangan_pengambilan', ['Diambil sendiri', 'Diwakilkan'])->change();
        });
    }
};
