@extends('layout')

@section('title', 'Dashboard - Arsip Surat')

@section('content')
@php
    $breadcrumbs = [
        ['title' => 'Dashboard', 'url' => route('dashboard')]
    ];
@endphp

<div class="row mb-4">
    <div class="col-md-6">
        <h2><i class="fas fa-archive me-2"></i>Arsip Surat</h2>
        <p class="text-muted mb-0">Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.</p>
        <p class="text-muted">Klik <strong>"Lihat"</strong> pada kolom aksi untuk menampilkan surat.</p>

    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('arsip.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Arsipkan Surat...
        </a>
    </div>
</div>

<!-- Search Form -->
<div class="row mb-4 align-items-end">
    <div class="col-auto">
        <label for="search" class="form-label fw-semibold mb-0 me-2">Cari surat :</label>
    </div>
    <div class="col p-0">
        <form method="GET" action="{{ route('dashboard') }}" class="d-flex">
            <div class="input-group">
                <input type="text" id="search" name="search" value="{{ request('search') }}"
                       placeholder="Cari surat..." class="form-control" style="max-width: 250px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
                @if(request('search'))
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary ms-2">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Data Table -->
<div class="card">
    <div class="card-body">
        @if($arsip->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 15%">Nomor Surat</th>
                            <th style="width: 15%">Kategori</th>
                            <th style="width: 35%">Judul</th>
                            <th style="width: 15%">Waktu Pengarsipan</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($arsip as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nomor_surat }}</td>
                            <td>{{ $item->kategori->nama_kategori }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('arsip.show', $item) }}"
                                       class="btn btn-info btn-sm" title="Lihat Detail">
                                        Lihat
                                    </a>
                                    <a href="{{ route('arsip.download', $item) }}"
                                       class="btn btn-success btn-sm" title="Unduh PDF">
                                        Unduh
                                    </a>
                                    <button type="button"
                                            class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $item->id }}"
                                            data-title="{{ $item->judul }}"
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
            {{-- Pagination links removed because $arsip is not paginated --}}
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Tidak ada data arsip surat</h5>
                @if(request('search'))
                    <p class="text-muted">Tidak ditemukan hasil untuk pencarian "{{ request('search') }}"</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke semua data
                    </a>
                @else
                    <p class="text-muted">Mulai dengan menambahkan arsip surat pertama Anda</p>
                    <a href="{{ route('arsip.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Tambah Arsip Surat
                    </a>
                @endif
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
                html: `Apakah Anda yakin ingin menghapus arsip surat:<br><strong>"${title}"</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create and submit form
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/arsip/${id}`;
                    form.innerHTML = `
                        @csrf
                        @method('DELETE')
                    `;
                    document.body.appendChild(form);

                    // Submit via AJAX to get JSON response
                    fetch(form.action, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
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

                    document.body.removeChild(form);
                }
            });
        });
    });
});
</script>
@endpush
