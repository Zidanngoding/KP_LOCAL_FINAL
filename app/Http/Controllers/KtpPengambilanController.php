<?php

namespace App\Http\Controllers;

use App\Models\KtpPrr;
use App\Models\KtpPengambilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KtpPengambilanController extends Controller
{
    public function index(Request $request)
    {
        $query = KtpPrr::where('status', 'Selesai');

        if ($request->search) {
            $query->where('nama_pemohon', 'like', '%' . $request->search . '%');
        }

        if ($request->kecamatan) {
            $query->where('kecamatan', $request->kecamatan);
        }

        if ($request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $ktp_selesai = $query->paginate(50);

        return view('admin.ktp_pengambilan', compact('ktp_selesai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required',
            'keterangan_ikd' => 'required',
            'foto_bukti' => 'required|image|mimes:jpg,png',
        ]);

        // Cari kecamatan dari ktp_prr berdasarkan nama_pemohon dan status Selesai
        $ktpPrr = KtpPrr::where('nama_pemohon', $request->nama_pemohon)
                         ->where('status', 'Selesai')
                         ->first();

        if (!$ktpPrr) {
            return redirect()->back()->with('error', 'Pemohon tidak ditemukan atau belum selesai');
        }

        $namaFile = 'bukti_' . str_replace([' ', '/', '\\'], '_', $request->nama_pemohon) . '_' . time() . '.jpg';
        $path = $request->file('foto_bukti')->storeAs('bukti_pengambilan', $namaFile, ['disk' => 'public']);

        KtpPengambilan::create([
            'nama_pemohon' => $request->nama_pemohon,
            'kecamatan' => $ktpPrr->kecamatan,
            'foto_bukti' => $path,
            'keterangan' => null,
            'keterangan_ikd' => $request->keterangan_ikd,
        ]);

        // Update status di ktp_prr
        $ktpPrr->update(['status' => 'Diambil']);

        return redirect()->back()->with('success', 'Data pengambilan berhasil disimpan');
    }
}
