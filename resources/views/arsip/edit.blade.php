
@extends('layout')

@section('title', 'Edit Arsip Surat')

@section('content')
@php
    $breadcrumbs = [
        ['title' => 'Dashboard', 'url' => route('dashboard')],
        ['title' => 'Edit Arsip Surat', 'url' => '#']
    ];
@endphp
<h3 class="mb-4 text-start">Edit Arsip Surat</h3>

<form action="{{ route('arsip.update', $arsip) }}" method="POST" enctype="multipart/form-data" class="text-start">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nomor_surat" class="form-label">Nomor Surat <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror"
               id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $arsip->nomor_surat) }}"
               placeholder="Masukkan nomor surat">
        @error('nomor_surat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori Surat <span class="text-danger">*</span></label>
        <select class="form-select @error('kategori_id') is-invalid @enderror"
                id="kategori_id" name="kategori_id">
            <option value="">Pilih Kategori Surat</option>
            @foreach($kategori as $item)
                <option value="{{ $item->id }}"
                        {{ old('kategori_id', $arsip->kategori_id) == $item->id ? 'selected' : '' }}>
                    {{ $item->nama_kategori }}
                </option>
            @endforeach
        </select>
        @error('kategori_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="judul" class="form-label">Judul Surat <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('judul') is-invalid @enderror"
               id="judul" name="judul" value="{{ old('judul', $arsip->judul) }}"
               placeholder="Masukkan judul surat">
        @error('judul')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="file_pdf" class="form-label">File PDF</label>
        <input type="file" class="form-control @error('file_pdf') is-invalid @enderror"
               id="file_pdf" name="file_pdf" accept=".pdf">
        <div class="form-text">
        </div>
        @if($arsip->file_pdf)
            <div class="mt-2">
                <small class="text-muted">
                    File saat ini: {{ basename($arsip->file_pdf) }}
                </small>
            </div>
        @endif
        @error('file_pdf')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

@push('scripts')
<script>
// File validation
document.getElementById('file_pdf').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Check file type
        if (file.type !== 'application/pdf') {
            Swal.fire({
                title: 'File Tidak Valid',
                text: 'Hanya file PDF yang diperbolehkan',
                icon: 'error'
            });
            this.value = '';
            return;
        }

        // Check file size (2MB = 2097152 bytes)
        if (file.size > 2097152) {
            Swal.fire({
                title: 'File Terlalu Besar',
                text: 'Ukuran file maksimal 2MB',
                icon: 'error'
            });
            this.value = '';
            return;
        }
    }
});
</script>
@endpush

@endsection

@push('scripts')
<script>
// File validation
document.getElementById('file_pdf').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Check file type
        if (file.type !== 'application/pdf') {
            Swal.fire({
                title: 'File Tidak Valid',
                text: 'Hanya file PDF yang diperbolehkan',
                icon: 'error'
            });
            this.value = '';
            return;
        }

        // Check file size (2MB = 2097152 bytes)
        if (file.size > 2097152) {
            Swal.fire({
                title: 'File Terlalu Besar',
                text: 'Ukuran file maksimal 2MB',
                icon: 'error'
            });
            this.value = '';
            return;
        }
    }
});
</script>
@endpush
