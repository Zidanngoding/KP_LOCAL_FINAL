<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KtpPrr extends Model
{
    protected $table = 'ktp_prr';

    protected $fillable = [
        'nama_pemohon',
        'no_hp',
        'kecamatan',
        'keterangan',
        'keterangan_pengambilan',
        'nama_pengambil',
        'nik_pengambil',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];
}
