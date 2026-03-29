@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="fw-bold">Selamat Datang di Silsilah Keluarga</h2>
        <p class="text-muted">Kelola dan telusuri garis keturunan keluarga Anda dengan mudah.</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body py-4">
                <h5 class="card-title">Total Anggota</h5>
                <h2 class="fw-bold mb-0">0</h2>
                <small>Orang terdaftar</small>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5>Aksi Cepat</h5>
                <div class="d-flex gap-2 mt-3">
                    <a href="/anggota/tambah" class="btn btn-outline-primary">Mulai Tambah Anggota Pertama</a>
                    <a href="/pohon" class="btn btn-outline-secondary">Lihat Struktur Pohon</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection