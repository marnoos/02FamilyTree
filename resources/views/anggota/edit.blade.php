@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold text-warning"><i class="bi bi-pencil-square me-2"></i>Edit Anggota Keluarga</h5>
            </div>
            <div class="card-body p-4">
                <form action="/anggota/update/{{ $anggota->id }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mb-3 text-center">
                            <label class="form-label fw-semibold d-block">Foto Profil</label>
                            <img id="preview-foto" src="{{ $anggota->foto_url }}"
                                class="rounded-circle img-thumbnail mb-2"
                                style="width: 120px; height: 120px; object-fit: cover;">
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto-input">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $anggota->nama) }}" placeholder="Masukkan nama lengkap">
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="L" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control"
                                value="{{ old('tanggal_lahir', $anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('Y-m-d') : '') }}">
                        </div>

                        <hr class="my-4 text-muted">
                        <h6 class="mb-3 text-primary fw-bold">Hubungan Keluarga</h6>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Ayah</label>
                            <select name="ayah_id" class="form-select">
                                <option value="">-- Tidak Ada / Rahasia --</option>
                                @foreach($ayahs as $ayah)
                                <option value="{{ $ayah->id }}" {{ $anggota->ayah_id == $ayah->id ? 'selected' : '' }}>
                                    {{ $ayah->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Ibu</label>
                            <select name="ibu_id" class="form-select">
                                <option value="">-- Tidak Ada / Rahasia --</option>
                                @foreach($ibus as $ibu)
                                <option value="{{ $ibu->id }}" {{ $anggota->ibu_id == $ibu->id ? 'selected' : '' }}>
                                    {{ $ibu->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="/anggota" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-warning px-4 text-white">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview Gambar saat pilih file
    document.getElementById('foto-input').onchange = function(evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function() {
                document.getElementById('preview-foto').src = fr.result;
            }
            fr.readAsDataURL(files[0]);
        }
    }
</script>
@endsection