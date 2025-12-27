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
            $table->string('nama_pengambil')->nullable()->after('keterangan_pengambilan');
        });
    }

    public function down(): void
    {
        Schema::table('ktp_prr', function (Blueprint $table) {
            $table->dropColumn('nama_pengambil');
        });
    }
};
