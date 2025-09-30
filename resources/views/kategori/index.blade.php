
@extends('layout')

@section('title', 'Kategori Surat')

@section('content')
@php
    $breadcrumbs = [
        ['title' => 'Kategori Surat', 'url' => '#']
    ];
@endphp

<div class="row mb-4">
    <div class="col-md-6">
        <h2><i class="fas fa-tags me-2"></i>Kategori Surat</h2>
        <p class="text-muted">
            Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat. Klik "Tambah" pada kolom aksi untuk menambahkan kategori baru.
        </p>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('kategori.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Kategori
        </a>
    </div>
</div>

<!-- Search Form -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('kategori.index') }}" class="row g-3">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari berdasarkan nama kategori..." class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-search me-1"></i>Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Reset
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="fas fa-list me-2"></i>Daftar Kategori Surat
            @if(request('search'))
                <small class="text-muted">(Pencarian: "{{ request('search') }}")</small>
            @endif
        </h5>
    </div>
    <div class="card-body">
        @if($kategori->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 10%">ID Kategori</th>
                            <th style="width: 40%">Nama Kategori</th>
                            <th style="width: 40%">Keterangan</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama_kategori }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('kategori.edit', $item) }}"
                                       class="btn btn-warning btn-sm" title="Edit">
                                        Edit
                                    </a>
                                    <button type="button"
                                            class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $item->id }}"
                                            data-title="{{ $item->nama_kategori }}"
                                            title="Hapus">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Tidak ada kategori surat</h5>
                <p class="text-muted">Mulai dengan menambahkan kategori surat pertama Anda</p>
                <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Tambah Kategori
                </a>
            </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
// Handle delete button
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const title = this.dataset.title;

            Swal.fire({
                title: 'Konfirmasi Hapus',
                html: `Apakah Anda yakin ingin menghapus kategori:<br><strong>"${title}"</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit via AJAX to get JSON response
                    fetch(`/kategori/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: data.message,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Terjadi kesalahan');
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat menghapus data',
                            icon: 'error'
                        });
                    });
                }
            });
        });
    });
});
</script>
@endpush
