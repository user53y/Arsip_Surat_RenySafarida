
@extends('layout')

@section('title', 'Edit Kategori Surat')

@section('content')
@php
    $breadcrumbs = [
        ['title' => 'Kategori Surat', 'url' => route('kategori.index')],
        ['title' => 'Edit Kategori', 'url' => '#']
    ];
@endphp

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Kategori Surat</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('kategori.update', $kategori) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="id_kategori" class="form-label">ID Kategori</label>
                        <input type="text" readonly class="form-control-plaintext bg-light" id="id_kategori" value="{{ $kategori->id }}">
                        <small class="text-muted">ID tidak dapat diubah</small>
                    </div>

                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                               id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                               placeholder="Masukkan nama kategori">
                        @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                  id="keterangan" name="keterangan" rows="3"
                                  placeholder="Masukkan keterangan kategori (opsional)">{{ old('keterangan', $kategori->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
