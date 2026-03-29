@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col-md-4">
                <h5 class="mb-0 fw-bold">Daftar Anggota Keluarga</h5>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-md-end mt-3 mt-md-0">
                    <form action="/anggota" method="GET" class="d-flex me-2">
                        <div class="input-group input-group-sm">
                            <input type="text" name="cari" class="form-control" placeholder="Cari nama..." value="{{ request('cari') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                    <a href="/anggota/tambah" class="btn btn-primary btn-sm px-3">
                        <i class="bi bi-plus-lg"></i> Tambah
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light text-secondary">
                    <tr>
                        <th class="ps-4" style="width: 80px;">Foto</th>
                        <th>Nama Lengkap</th>
                        <th class="text-center">Gender</th>
                        <th>Ayah</th>
                        <th>Ibu</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggotas as $anggota)
                    <tr>
                        <td class="ps-4">
                            <img src="{{ $anggota->foto_url }}" class="rounded-circle border"
                                style="width: 45px; height: 45px; object-fit: cover;" alt="profil">
                        </td>
                        <td>
                            <div class="fw-bold">{{ $anggota->nama }}</div>
                            <small class="text-muted">{{ $anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('d M Y') : '-' }}</small>
                        </td>
                        <td class="text-center">
                            @if($anggota->jenis_kelamin == 'L')
                            <span class="badge rounded-pill bg-primary-subtle text-primary border border-primary-subtle px-3">L</span>
                            @else
                            <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger-subtle px-3">P</span>
                            @endif
                        </td>
                        <td class="text-muted">{{ $anggota->ayah->nama ?? '-' }}</td>
                        <td class="text-muted">{{ $anggota->ibu->nama ?? '-' }}</td>
                        <td class="text-end pe-4">
                            <div class="btn-group shadow-sm">
                                <a href="/anggota/edit/{{ $anggota->id }}" class="btn btn-sm btn-white border border-end-0 text-warning" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="/anggota/hapus/{{ $anggota->id }}" class="btn btn-sm btn-white border text-danger"
                                    title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-5 text-center">
                            <i class="bi bi-people text-muted" style="font-size: 3rem;"></i>
                            <p class="mt-2 text-muted">Data anggota tidak ditemukan.</p>
                            @if(request('cari'))
                            <a href="/anggota" class="btn btn-sm btn-outline-secondary">Reset Pencarian</a>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Tambahan agar tombol grup terlihat lebih modern */
    .btn-white {
        background-color: #fff;
    }

    .btn-white:hover {
        background-color: #f8f9fa;
    }

    .badge {
        font-weight: 600;
        font-size: 0.75rem;
    }
</style>
@endsection