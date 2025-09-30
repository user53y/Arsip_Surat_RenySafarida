@extends('layout')

@section('title', 'Detail Arsip Surat')

@section('content')
@php
    $breadcrumbs = [
        ['title' => 'Dashboard', 'url' => route('dashboard')],
        ['title' => 'Detail Arsip Surat', 'url' => '#']
    ];

    use Illuminate\Support\Facades\Storage;
@endphp
<div class="row justify-content-center">

    <div class="col-lg-14">
        <h4 class="mb-4">
            <i class="fas fa-eye me-2"></i>Detail Arsip Surat
        </h4>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm me-2">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
            <a href="{{ route('arsip.download', $arsip) }}" class="btn btn-success btn-sm me-2">
                <i class="fas fa-download me-2"></i>Unduh PDF
            </a>
            <a href="{{ route('arsip.edit', $arsip) }}" class="btn btn-warning btn-sm me-2">
                <i class="fas fa-edit me-2"></i>Edit/Ganti File
            </a>
        </div>
        <div class="row mb-4">
            <div class="col-12 col-md-12 mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2 d-flex">
                            <strong class="me-2" style="min-width: 130px;">Nomor Surat</strong>
                            <span class="flex-fill">: {{ $arsip->nomor_surat }}</span>
                        </div>
                        <div class="mb-2 d-flex">
                            <strong class="me-2" style="min-width: 130px;">Kategori Surat</strong>
                            <span class="flex-fill">: {{ $arsip->kategori->nama_kategori }}</span>
                        </div>
                        <div class="mb-2 d-flex">
                            <strong class="me-2" style="min-width: 130px;">Judul</strong>
                            <span class="flex-fill">: {{ $arsip->judul }}</span>
                        </div>
                        <div class="mb-2 d-flex">
                            <strong class="me-2" style="min-width: 130px;">Waktu Unggah</strong>
                            <span class="flex-fill">: {{ $arsip->created_at->format('d F Y, H:i') }} WIB</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-2">
                <h5 class="mb-3">
                    <i class="fas fa-file-pdf me-2"></i>Preview Dokumen
                </h5>
                @if($arsip->file_pdf && Storage::disk('public')->exists($arsip->file_pdf))
                    <div class="ratio ratio-16x9 mb-4" style="height: 500px;">
                        <iframe src="{{ asset('storage/' . $arsip->file_pdf) }}"
                                class="border rounded"
                                style="width: 100%; height: 100%;">
                            <p>Browser Anda tidak mendukung tampilan PDF.
                               <a href="{{ route('arsip.download', $arsip) }}">Unduh file</a> untuk melihatnya.
                            </p>
                        </iframe>
                    </div>
                @else
                    <div class="alert alert-warning mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        File PDF tidak ditemukan atau telah dihapus.
                    </div>
                @endif
            </div>
        </div>

        </div>
        </div>
        <style>
        .container, .col-lg-10 {
            padding-left: 0.5px !important;
            padding-right: 0.5px !important;
        }
        .row.justify-content-center {
            margin-left: 0.5px !important;
            margin-right: 0.5px !important;
        }
        </style>

@endsection

@push('scripts')
<script>
// Handle delete button
document.addEventListener('DOMContentLoaded', function() {
    const deleteBtn = document.querySelector('.btn-delete');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
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
                    // Submit via AJAX to get JSON response
                    fetch(`/arsip/${id}`, {
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
                                window.location.href = '{{ route("dashboard") }}';
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
    }
});
</script>
@endpush
