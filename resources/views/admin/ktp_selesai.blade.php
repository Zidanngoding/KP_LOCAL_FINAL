@extends('layouts.app')

@section('title', 'KTP Selesai')

@section('content')
@if(!$isPdf)
<div class="page-header">
    <div>
        <h2 class="page-title">KTP Selesai</h2>
        <p class="page-subtitle">Riwayat KTP yang sudah diambil beserta bukti.</p>
    </div>
    <div class="toolbar">
        <a href="?pdf=1" class="btn btn-primary" target="_blank">Print/PDF</a>
    </div>
</div>

<div class="card section-gap">
    <div class="card-header">Filter Data</div>
    <div class="card-body">
        <form method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Cari Nama</label>
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama" value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Kecamatan</label>
                    <select name="kecamatan" class="form-select" value="{{ request('kecamatan') }}">
                        <option value="">Semua Kecamatan</option>
                        <option value="Bumi Waras">Bumi Waras</option>
                        <option value="Enggal">Enggal</option>
                        <option value="Kedamaian">Kedamaian</option>
                        <option value="Kedaton">Kedaton</option>
                        <option value="Kemiling">Kemiling</option>
                        <option value="Labuhan Ratu">Labuhan Ratu</option>
                        <option value="Langkapura">Langkapura</option>
                        <option value="Panjang">Panjang</option>
                        <option value="Rajabasa">Rajabasa</option>
                        <option value="Sukabumi">Sukabumi</option>
                        <option value="Sukarame">Sukarame</option>
                        <option value="Tanjung Senang">Tanjung Senang</option>
                        <option value="Tanjung Karang Barat">Tanjung Karang Barat</option>
                        <option value="Tanjung Karang Pusat">Tanjung Karang Pusat</option>
                        <option value="Tanjung Karang Timur">Tanjung Karang Timur</option>
                        <option value="Teluk Betung Barat">Teluk Betung Barat</option>
                        <option value="Teluk Betung Selatan">Teluk Betung Selatan</option>
                        <option value="Teluk Betung Timur">Teluk Betung Timur</option>
                        <option value="Teluk Betung Utara">Teluk Betung Utara</option>
                        <option value="Way Halim">Way Halim</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-secondary">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card section-gap">
    <div class="card-header">Daftar Selesai</div>
    <div class="card-body">
        <div class="table-responsive">
@endif
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>No HP Pengambil</th>
                        <th>Kecamatan</th>
                        <th>Keterangan</th>
                        <th>Keterangan IKD</th>
                        <th></th>Pengambilan</th>
                        <th>Nama Pengambil</th>
                        @if(!$isPdf)
                        <th>Foto Pengambil</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($ktp_selesai as $ktp)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ktp->tanggal_ambil->format('d-m-Y') }}</td>
                        <td>{{ $ktp->nama_pemohon }}</td>
                        <td>{{ $ktp->no_hp ?: '-' }}</td>
                        <td>{{ $ktp->kecamatan }}</td>
                        <td>{{ $ktp->keterangan }}</td>
                        <td>{{ $ktp->keterangan_ikd ?: '-' }}</td>
                        <td>{{ $ktp->keterangan_pengambilan }}</td>
                        <td>{{ $ktp->nama_pengambil ?: '-' }}</td>
                        @if(!$isPdf)
                        <td><img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($ktp->foto_bukti) }}" width="100" class="img-thumbnail"></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
@if(!$isPdf)
        </div>
    </div>
</div>
@endif

@if($isPdf)
<script>
window.onload = function() {
    window.print();
};
</script>
@endif

@endsection
