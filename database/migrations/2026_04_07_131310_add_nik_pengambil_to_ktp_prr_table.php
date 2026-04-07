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
            $table->string('nik_pengambil')->nullable()->after('nama_pengambil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ktp_prr', function (Blueprint $table) {
            $table->dropColumn('nik_pengambil');
        });
    }
};
