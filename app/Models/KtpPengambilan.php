<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KtpPengambilan extends Model
{
    protected $table = 'ktp_pengambilan';

    protected $fillable = [
        'nama_pemohon',
        'kecamatan',
        'foto_bukti',
        'keterangan',
        'tanggal_ambil',
    ];

    protected $casts = [
        'tanggal_ambil' => 'datetime',
    ];
}
