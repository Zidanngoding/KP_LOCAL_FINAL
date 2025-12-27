@extends('layouts.app')

@section('title', 'KTP Masuk')

@section('content')
<div class="page-header">
    <div>
        <h2 class="page-title">KTP Masuk</h2>
        <p class="page-subtitle">Tambah data pemohon baru dan pantau status proses.</p>
    </div>
</div>

<div class="card section-gap">
    <div class="card-header">Form KTP Masuk</div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.ktp_masuk') }}">
            @csrf
            <div class="row g-3">
                <div class="col-lg-4">
                    <label class="form-label">Nama Pemohon</label>
                    <input type="text" name="nama_pemohon" class="form-control" placeholder="Nama Pemohon" required>
                </div>
                <div class="col-lg-4">
                    <label class="form-label">No HP Pengambil</label>
                    <input type="text" name="no_hp" class="form-control" placeholder="No HP" required>
                </div>
                <div class="col-lg-4">
                    <label class="form-label">Kecamatan</label>
                    <select name="kecamatan" class="form-select" required>
                        <option value="">Pilih Kecamatan</option>
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
                <div class="col-lg-4">
                    <label class="form-label">Keterangan</label>
                    <select name="keterangan" class="form-select" required>
                        <option value="">Pilih Keterangan</option>
                        <option value="PRR">PRR</option>
                        <option value="Hilang">Hilang</option>
                        <option value="Rusak">Rusak</option>
                        <option value="Perubahan">Perubahan</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <label class="form-label">Pengambilan</label>
                    <select name="keterangan_pengambilan" class="form-select" required>
                        <option value="">Pilih Keterangan Pengambilan</option>
                        <option value="Diambil sendiri">Diambil sendiri</option>
                        <option value="Diwakilkan satu KK">Diwakilkan satu KK</option>
                        <option value="Diwakilkan surat Dinas Sosial">Diwakilkan surat Dinas Sosial</option>
                        <option value="Diwakilkan surat Kelurahan">Diwakilkan surat Kelurahan</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <label class="form-label">Nama Pengambil</label>
                    <input type="text" name="nama_pengambil" class="form-control" placeholder="Nama Pengambil">
                </div>
                <div class="col-lg-4 d-grid align-self-end">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>
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
    <div class="card-header">Daftar Pemohon</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>No HP Pengambil</th>
                        <th>Kecamatan</th>
                        <th>Keterangan</th>
                        <th>Pengambilan</th>
                        <th>Nama Pengambil</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ktp_prr as $ktp)
                    @php
                        $statusClass = strtolower($ktp->status) === 'diproses' ? 'pending' : 'success';
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration + ($ktp_prr->currentPage() - 1) * $ktp_prr->perPage() }}</td>
                        <td>{{ $ktp->created_at->format('d-m-Y') }}</td>
                        <td>{{ $ktp->nama_pemohon }}</td>
                        <td>{{ $ktp->no_hp }}</td>
                        <td>{{ $ktp->kecamatan }}</td>
                        <td>{{ $ktp->keterangan }}</td>
                        <td>{{ $ktp->keterangan_pengambilan }}</td>
                        <td>{{ $ktp->nama_pengambil ?: '-' }}</td>
                        <td><span class="badge-status {{ $statusClass }}">{{ $ktp->status }}</span></td>
                        <td>
                            <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $ktp->id }}">Edit</button>
                            @if($ktp->status == 'Diproses')
                                <form method="POST" action="{{ route('admin.ktp_masuk') }}/{{ $ktp->id }}/complete" class="d-inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success">Selesai</button>
                                </form>
                            @endif
                            <form method="POST" action="{{ route('admin.ktp_masuk') }}/{{ $ktp->id }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $ktp_prr->appends(request()->query())->links() }}
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="nama_pemohon" class="form-control mb-2" id="edit_nama" required>
                    <input type="text" name="no_hp" class="form-control mb-2" id="edit_hp" required>
                    <select name="kecamatan" class="form-select mb-2" id="edit_kecamatan" required>
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
                    <select name="keterangan" class="form-select mb-2" id="edit_keterangan" required>
                        <option value="PRR">PRR</option>
                        <option value="Hilang">Hilang</option>
                        <option value="Rusak">Rusak</option>
                        <option value="Perubahan">Perubahan</option>
                    </select>
                    <select name="keterangan_pengambilan" class="form-select mb-2" id="edit_pengambilan" required>
                        <option value="Diambil sendiri">Diambil sendiri</option>
                        <option value="Diwakilkan satu KK">Diwakilkan satu KK</option>
                        <option value="Diwakilkan surat Dinas Sosial">Diwakilkan surat Dinas Sosial</option>
                        <option value="Diwakilkan surat Kelurahan">Diwakilkan surat Kelurahan</option>
                    </select>
                    <input type="text" name="nama_pengambil" class="form-control mb-2" id="edit_nama_pengambil" placeholder="Nama Pengambil">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.dataset.id;
        fetch(`/admin/ktp_masuk/${id}/edit`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('edit_nama').value = data.nama_pemohon;
                document.getElementById('edit_hp').value = data.no_hp;
                document.getElementById('edit_kecamatan').value = data.kecamatan;
                document.getElementById('edit_keterangan').value = data.keterangan;
                document.getElementById('edit_pengambilan').value = data.keterangan_pengambilan;
                document.getElementById('edit_nama_pengambil').value = data.nama_pengambil || '';
                document.getElementById('editForm').action = `/admin/ktp_masuk/${id}`;
                new bootstrap.Modal(document.getElementById('editModal')).show();
            });
    });
});
</script>
@endsection
