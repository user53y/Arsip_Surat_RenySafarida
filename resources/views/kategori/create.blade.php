
@extends('layout')

@section('title', 'Tambah Kategori Surat')

@section('content')
@php
    $breadcrumbs = [
        ['title' => 'Kategori Surat', 'url' => route('kategori.index')],
        ['title' => 'Tambah Kategori', 'url' => '#']
    ];
@endphp
<form action="{{ route('kategori.store') }}" method="POST">
    @csrf
    <div class="row mb-3 align-items-center">
        <label for="id_kategori" class="col-sm-2 col-form-label">ID Kategori (Auto Increment)</label>
        <div class="col-sm-4">
            <input type="text" readonly class="form-control-plaintext bg-light" id="id_kategori" name="id_kategori" value="{{ old('id_kategori', $nextId ?? 'Auto Generate') }}">
        </div>
    </div>

    <div class="row mb-3 align-items-center">
        <label for="nama_kategori" class="col-sm-2 col-form-label">Nama Kategori <span class="text-danger">*</span></label>
        <div class="col-sm-4">
            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                   id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}"
                   placeholder="Masukkan nama kategori">
            @error('nama_kategori')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mb-3 align-items-center">
        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
        <div class="col-sm-4">
            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                      id="keterangan" name="keterangan" rows="3"
                      placeholder="Masukkan keterangan kategori (opsional)">{{ old('keterangan') }}</textarea>
            @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 d-flex justify-content-between">
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>

@endsection
