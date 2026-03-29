@extends('layouts.app')

@section('title', 'Pohon Keluarga')

@section('content')
<style>
    /* CSS Sederhana untuk Struktur Pohon */
    .tree ul {
        padding-top: 20px;
        position: relative;
        transition: all 0.5s;
    }

    .tree li {
        float: left;
        text-align: center;
        list-style-type: none;
        position: relative;
        padding: 20px 5px 0 5px;
        transition: all 0.5s;
    }

    /* Garis-garis penghubung */
    .tree li::before,
    .tree li::after {
        content: '';
        position: absolute;
        top: 0;
        right: 50%;
        border-top: 1px solid #ccc;
        width: 50%;
        height: 20px;
    }

    .tree li::after {
        right: auto;
        left: 50%;
        border-left: 1px solid #ccc;
    }

    .tree li:only-child::after,
    .tree li:only-child::before {
        display: none;
    }

    .tree li:only-child {
        padding-top: 0;
    }

    .tree li:first-child::before,
    .tree li:last-child::after {
        border: 0 none;
    }

    .tree li:last-child::before {
        border-right: 1px solid #ccc;
        border-radius: 0 5px 0 0;
    }

    .tree li:first-child::after {
        border-radius: 5px 0 0 0;
    }

    .tree ul ul::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        border-left: 1px solid #ccc;
        width: 0;
        height: 20px;
    }

    /* Kotak Nama */
    .tree li div {
        border: 1px solid #ccc;
        padding: 10px;
        text-decoration: none;
        color: #666;
        font-family: arial, verdana, tahoma;
        font-size: 12px;
        display: inline-block;
        border-radius: 5px;
        background-color: white;
        transition: all 0.5s;
    }

    .tree li div:hover {
        background: #eef;
        border: 1px solid #94a0b4;
        color: #000;
    }

    .gender-l {
        border-bottom: 3px solid #007bff !important;
    }

    .gender-p {
        border-bottom: 3px solid #e83e8c !important;
    }
</style>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-diagram-3 me-2"></i>Visualisasi Pohon Keluarga</h5>
    </div>
    <div class="card-body overflow-auto">
        <div class="tree text-center">
            <ul>
                @foreach($leluhur as $person)
                @include('anggota.node', ['person' => $person])
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection