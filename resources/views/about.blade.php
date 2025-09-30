@extends('layout')

@section('title', 'About - Sistem Arsip Surat')

@section('content')
@php
    $breadcrumbs = [
        ['title' => 'About', 'url' => '#']
    ];
@endphp

<div class="row">
    <div class="col-md-10 col-12">
        <div class="d-flex align-items-center border rounded p-4 bg-white shadow-sm">
            <!-- Foto kotak -->
            <img src="{{ asset('images/RENY SAFARIDA.jpeg') }}"
                 alt="Profile Picture"
                 class="border border-primary me-4"
                 style="width: 140px; height: 140px; object-fit: cover; border-width: 2px !important; border-radius: 8px;">
            <!-- Informasi -->
            <div>
                <h4 class="mb-1"><strong>Aplikasi ini dibuat oleh:</h4></strong>
                <p class="mb-1"><strong>Nama:</strong>Reny Safarida</p>
                <p class="mb-1"><strong>Prodi:</strong> D3 Manajemen Informatika - PSDKU KEDIRI</p>
                <p class="mb-1"><strong>NIM:</strong> 2331730040</p>
                <p class="mb-1"><strong>Tanggal:</strong> 30 September 2025</p>
            </div>
        </div>
    </div>
</div>
@endsection
