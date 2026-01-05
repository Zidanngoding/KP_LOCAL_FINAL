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
        // For the table: list of pengambilan records
        $pengambilanQuery = KtpPengambilan::query();

        if ($request->search) {
            $pengambilanQuery->where('nama_pemohon', 'like', '%' . $request->search . '%');
        }

        if ($request->kecamatan) {
            $pengambilanQuery->where('kecamatan', $request->kecamatan);
        }

        if ($request->tanggal) {
            $pengambilanQuery->whereDate('created_at', $request->tanggal);
        }

        $ktp_pengambilan = $pengambilanQuery->paginate(50);

        // For select options: all pemohon with status Selesai
        $all_ktp_selesai = KtpPrr::where('status', 'Selesai')->get();

        return view('admin.ktp_pengambilan', compact('ktp_pengambilan', 'all_ktp_selesai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required',
            'keterangan_ikd' => 'required',
            'foto_bukti' => 'required|image|mimes:jpeg,jpg,png|max:2048',
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
