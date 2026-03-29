@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-person-plus me-2"></i>Tambah Anggota Keluarga</h5>
            </div>
            <div class="card-body p-4">
                <form action="/anggota/simpan" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mb-3 text-center">
                            <label class="form-label fw-semibold d-block">Foto Profil (Opsional)</label>
                            <img id="preview-foto" src="{{ asset('images/default-male.png') }}"
                                class="rounded-circle img-thumbnail mb-2"
                                style="width: 100px; height: 100px; object-fit: cover;">
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto-input">
                            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}">
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
                        </div>

                        <hr class="my-4 text-muted">
                        <h6 class="mb-3 text-primary fw-bold">Hubungan Keluarga (Opsional)</h6>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Ayah</label>
                            <select name="ayah_id" class="form-select">
                                <option value="">-- Pilih Ayah --</option>
                                @foreach($ayahs as $ayah)
                                <option value="{{ $ayah->id }}">{{ $ayah->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Ibu</label>
                            <select name="ibu_id" class="form-select">
                                <option value="">-- Pilih Ibu --</option>
                                @foreach($ibus as $ibu)
                                <option value="{{ $ibu->id }}">{{ $ibu->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="/anggota" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">Simpan Anggota</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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