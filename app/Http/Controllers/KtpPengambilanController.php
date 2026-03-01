<?php

namespace App\Http\Controllers;

use App\Models\KtpPrr;
use App\Models\KtpPengambilan;
use Illuminate\Http\Request;

class KtpPengambilanController extends Controller
{
    public function index(Request $request)
    {
        $query = KtpPengambilan::query();

        if ($request->search) {
            $query->where('nama_pemohon', 'like', '%' . $request->search . '%');
        }

        if ($request->kecamatan) {
            $query->where('kecamatan', $request->kecamatan);
        }

        if ($request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $ktp_pengambilan = $query->paginate(50);
        $all_ktp_selesai = KtpPrr::where('status', 'Selesai')->get();

        // 🔑 KUNCI UTAMA: VIEW SESUAI ROLE
        $view = auth()->user()->role === 'admin'
            ? 'admin.ktp_pengambilan'
            : 'petugas.ktp_pengambilan';

        return view($view, compact('ktp_pengambilan', 'all_ktp_selesai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemohon'   => 'required',
            'keterangan_ikd' => 'required',
            'foto_bukti'     => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $ktpPrr = KtpPrr::where('nama_pemohon', $request->nama_pemohon)
            ->where('status', 'Selesai')
            ->first();

        if (!$ktpPrr) {
            return back()->with('error', 'Pemohon belum berstatus selesai');
        }

        $filename = 'bukti_' . time() . '.jpg';
        $path = $request->file('foto_bukti')->storeAs(
            'bukti_pengambilan',
            $filename,
            'public'
        );

        KtpPengambilan::create([
            'nama_pemohon'   => $request->nama_pemohon,
            'kecamatan'      => $ktpPrr->kecamatan,
            'foto_bukti'     => $path,
            'keterangan_ikd' => $request->keterangan_ikd,
        ]);

        $ktpPrr->update(['status' => 'Diambil']);

        return back()->with('success', 'Data pengambilan berhasil disimpan');
    }
}