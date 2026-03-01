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
                action="{{ route('admin.ktp_pengambilan.store') }}"
                enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-lg-6">
                    <label for="nama_pemohon" class="form-label">Pemohon</label>
                    <select name="nama_pemohon" class="form-select" id="nama_pemohon" required>
                        <option value="">Pilih Pemohon</option>
                        @foreach($all_ktp_selesai as $ktp)
                            <option value="{{ $ktp->nama_pemohon }}">{{ $ktp->nama_pemohon }}</option>
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
                    <input type="file" name="foto_bukti" id="foto_bukti" class="form-control" accept="image/*" required>
                    <div class="form-text">Ambil foto bukti langsung dari kamera atau unggah file.</div>
                </div>
                <div class="col-12">
                    <div class="toolbar">
                        <button type="button" class="btn btn-outline-secondary" id="bukaKamera">Buka Kamera</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
                    @foreach($ktp_pengambilan as $pengambilan)
                    <tr>
                        <td>{{ $pengambilan->nama_pemohon }}</td>
                        <td>{{ $pengambilan->kecamatan }}</td>
                        <td>{{ $pengambilan->keterangan_ikd }}</td>
                        <td><span class="badge-status success">Diambil</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $ktp_pengambilan->links() }}
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.getElementById('bukaKamera').addEventListener('click', function() {
    const input = document.querySelector('input[name="foto_bukti"]');
    
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({
            video: {
                facingMode: 'user',
                width: { ideal: 1280 },
                height: { ideal: 720 }
            },
            audio: false
        })
            .then(function(stream) {
                // Buat modal untuk kamera
                const modal = document.createElement('div');
                modal.style.position = 'fixed';
                modal.style.top = '0';
                modal.style.left = '0';
                modal.style.width = '100%';
                modal.style.height = '100%';
                modal.style.backgroundColor = 'rgba(0,0,0,0.8)';
                modal.style.display = 'flex';
                modal.style.flexDirection = 'column';
                modal.style.alignItems = 'center';
                modal.style.justifyContent = 'center';
                modal.style.zIndex = '9999';
                
                const video = document.createElement('video');
                video.srcObject = stream;
                video.autoplay = true;
                video.style.width = '640px';
                video.style.height = '480px';
                video.style.border = '2px solid white';
                
                const buttonContainer = document.createElement('div');
                buttonContainer.style.marginTop = '10px';
                
                const captureBtn = document.createElement('button');
                captureBtn.textContent = 'Ambil Foto';
                captureBtn.className = 'btn btn-success';
                captureBtn.style.marginRight = '10px';
                
                const cancelBtn = document.createElement('button');
                cancelBtn.textContent = 'Batal';
                cancelBtn.className = 'btn btn-danger';
                
                buttonContainer.appendChild(captureBtn);
                buttonContainer.appendChild(cancelBtn);
                
                modal.appendChild(video);
                modal.appendChild(buttonContainer);
                document.body.appendChild(modal);
                
                captureBtn.addEventListener('click', function() {
                    const canvas = document.createElement('canvas');
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    const context = canvas.getContext('2d');
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);
                    
                    const namaPemohon = document.getElementById('nama_pemohon').value;
                    const namaFile = 'bukti_' + namaPemohon.replace(/ /g, '_').replace(/\//g, '_').replace(/\\/g, '_') + '_kamera_' + Date.now() + '.jpg';
                    
                    canvas.toBlob(function(blob) {
                        const file = new File([blob], namaFile, { type: 'image/jpeg' });
                        const dt = new DataTransfer();
                        dt.items.add(file);
                        input.files = dt.files;
                        
                        // Tutup modal
                        stream.getTracks().forEach(track => track.stop());
                        document.body.removeChild(modal);
                        
                        alert('Foto berhasil diambil!');
                    }, 'image/jpeg', 0.8);
                });
                
                cancelBtn.addEventListener('click', function() {
                    stream.getTracks().forEach(track => track.stop());
                    document.body.removeChild(modal);
                });
            })
            .catch(function(err) {
                console.error('Error accessing camera:', err);
                alert('Kamera tidak dapat diakses. Pastikan browser mendukung dan izin kamera diberikan.');
            });
    } else {
        alert('Browser tidak mendukung akses kamera.');
    }
});
</script>
@endsection
