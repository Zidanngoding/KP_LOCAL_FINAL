@extends('layouts.app')

@section('title', 'Pengambilan KTP')

@section('content')
<div class="page-header">
    <div>
        <h2 class="page-title">Pengambilan KTP</h2>
        <p class="page-subtitle">Catat pengambilan KTP dan unggah bukti dengan cepat.</p>
    </div>
</div>

<div class="card section-gap">
    <div class="card-header">Form Pengambilan</div>
    <div class="card-body">

        <form method="POST"
            action="{{ route('petugas.ktp_pengambilan.store') }}"
            enctype="multipart/form-data">
        @csrf

            <div class="row g-3">
                <div class="col-lg-6">
                    <label for="nama_pemohon" class="form-label">Pemohon</label>
                    <select name="nama_pemohon" class="form-select" id="nama_pemohon" required>
                        <option value="">Pilih Pemohon</option>
                        @foreach($all_ktp_selesai as $ktp)
                            <option value="{{ $ktp->nama_pemohon }}">
                                {{ $ktp->nama_pemohon }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-6">
                    <label for="keterangan_ikd" class="form-label">Keterangan IKD</label>
                    <select name="keterangan_ikd" class="form-select" id="keterangan_ikd" required>
                        <option value="">Pilih Keterangan IKD</option>
                        <option value="Sudah IKD">IKD Sendiri</option>
                        <option value="Sudah IKD">IKD Orang Tua</option>
                        <option value="Sudah IKD">IKD Dalam Satu KK</option>
                        <option value="Belum IKD">Belum IKD</option>
                    </select>
                </div>

                <div class="col-lg-6">
                    <label for="foto_bukti" class="form-label">Foto Bukti</label>
                    <input type="file" name="foto_bukti" id="foto_bukti"
                           class="form-control" accept="image/*" required>
                    <div class="form-text">Ambil foto dari kamera atau unggah file.</div>
                </div>

                <div class="col-12">
                    <div class="toolbar">
                        <button type="button" class="btn btn-outline-secondary" id="bukaKamera">
                            Buka Kamera
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
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
                    <input type="text" name="search" class="form-control"
                           value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Kecamatan</label>
                    <select name="kecamatan" class="form-select">
                        <option value="">Semua Kecamatan</option>
                        @foreach([
                            'Bumi Waras','Enggal','Kedamaian','Kedaton','Kemiling','Labuhan Ratu',
                            'Langkapura','Panjang','Rajabasa','Sukabumi','Sukarame','Tanjung Senang',
                            'Tanjung Karang Barat','Tanjung Karang Pusat','Tanjung Karang Timur',
                            'Teluk Betung Barat','Teluk Betung Selatan','Teluk Betung Timur',
                            'Teluk Betung Utara','Way Halim'
                        ] as $kec)
                            <option value="{{ $kec }}" @selected(request('kecamatan') == $kec)>
                                {{ $kec }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control"
                           value="{{ request('tanggal') }}">
                </div>

                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-secondary">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card section-gap">
    <div class="card-header">Daftar Pengambilan</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kecamatan</th>
                        <th>Keterangan IKD</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ktp_pengambilan as $pengambilan)
                        <tr>
                            <td>{{ $pengambilan->nama_pemohon }}</td>
                            <td>{{ $pengambilan->kecamatan }}</td>
                            <td>{{ $pengambilan->keterangan_ikd }}</td>
                            <td>
                                <span class="badge-status success">Diambil</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Data belum ada
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $ktp_pengambilan->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('bukaKamera')?.addEventListener('click', function () {
    const input = document.getElementById('foto_bukti');

    navigator.mediaDevices.getUserMedia({ video: true, audio: false })
        .then(stream => {
            const video = document.createElement('video');
            video.srcObject = stream;
            video.autoplay = true;

            const modal = document.createElement('div');
            modal.style.cssText = `
                position:fixed; inset:0; background:rgba(0,0,0,.8);
                display:flex; flex-direction:column;
                align-items:center; justify-content:center; z-index:9999;
            `;

            const btn = document.createElement('button');
            btn.textContent = 'Ambil Foto';
            btn.className = 'btn btn-success mt-3';

            modal.append(video, btn);
            document.body.appendChild(modal);

            btn.onclick = () => {
                const canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0);

                canvas.toBlob(blob => {
                    const file = new File([blob], 'bukti.jpg', { type: 'image/jpeg' });
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    input.files = dt.files;

                    stream.getTracks().forEach(t => t.stop());
                    modal.remove();
                });
            };
        });
});
</script>
@endsection