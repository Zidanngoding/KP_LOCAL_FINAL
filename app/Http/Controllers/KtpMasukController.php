<?php

namespace App\Http\Controllers;

use App\Models\KtpPrr;
use Illuminate\Http\Request;

class KtpMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = KtpPrr::query();

        if ($request->search) {
            $query->where('nama_pemohon', 'like', '%' . $request->search . '%');
        }

        if ($request->kecamatan) {
            $query->where('kecamatan', $request->kecamatan);
        }

        if ($request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $ktp_prr = $query->get();

        return view('admin.ktp_masuk', compact('ktp_prr'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required',
            'no_hp' => 'required',
            'kecamatan' => 'required',
            'keterangan_pengambilan' => 'required|in:Diambil sendiri,Diwakilkan satu KK,Diwakilkan surat Dinas Sosial,Diwakilkan surat Kelurahan',
            'nama_pengambil' => 'nullable|string',
        ]);

        KtpPrr::create([
            'nama_pemohon' => $request->nama_pemohon,
            'no_hp' => $request->no_hp,
            'kecamatan' => $request->kecamatan,
            'keterangan' => 'PRR',
            'keterangan_pengambilan' => $request->keterangan_pengambilan,
            'nama_pengambil' => $request->nama_pengambil,
            'status' => 'Diproses',
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $ktp = KtpPrr::findOrFail($id);
        return response()->json($ktp);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pemohon' => 'required',
            'no_hp' => 'required',
            'kecamatan' => 'required',
            'keterangan' => 'required|in:PRR,Hilang,Rusak,Perubahan',
            'keterangan_pengambilan' => 'required|in:Diambil sendiri,Diwakilkan',
            'nama_pengambil' => 'nullable|string',
        ]);

        $ktp = KtpPrr::findOrFail($id);
        $ktp->update($request->except('status'));

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function complete($id)
    {
        $ktp = KtpPrr::findOrFail($id);
        $ktp->update(['status' => 'Selesai']);

        return redirect()->back()->with('success', 'Status berhasil diubah');
    }

    public function destroy($id)
    {
        KtpPrr::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
