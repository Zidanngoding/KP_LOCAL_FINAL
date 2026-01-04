<?php

namespace App\Http\Controllers;

use App\Models\KtpPengambilan;
use Illuminate\Http\Request;

class KtpSelesaiController extends Controller
{
    public function index(Request $request)
    {
        $query = KtpPengambilan::join('ktp_prr', function($join) {
            $join->on('ktp_pengambilan.nama_pemohon', '=', 'ktp_prr.nama_pemohon')
                 ->on('ktp_pengambilan.kecamatan', '=', 'ktp_prr.kecamatan');
        })->select(
            'ktp_pengambilan.*',
            'ktp_prr.no_hp',
            'ktp_prr.keterangan',
            'ktp_prr.keterangan_pengambilan',
            'ktp_prr.nama_pengambil'
        );

        if ($request->search) {
            $query->where('ktp_pengambilan.nama_pemohon', 'like', '%' . $request->search . '%');
        }

        if ($request->kecamatan) {
            $query->where('ktp_pengambilan.kecamatan', $request->kecamatan);
        }

        if ($request->tanggal) {
            $query->whereDate('ktp_pengambilan.tanggal_ambil', $request->tanggal);
        }

        $ktp_selesai = $query->get();

        $isPdf = $request->has('pdf');

        return view('admin.ktp_selesai', compact('ktp_selesai', 'isPdf'));
    }
}
