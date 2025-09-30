<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriSurat;

class KategoriSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama_kategori' => 'Undangan',
                'keterangan' => 'Surat undangan untuk berbagai acara atau kegiatan',
            ],
            [
                'nama_kategori' => 'Pengumuman',
                'keterangan' => 'Surat pengumuman resmi untuk informasi publik',
            ],
            [
                'nama_kategori' => 'Nota Dinas',
                'keterangan' => 'Nota dinas internal untuk komunikasi antar divisi',
            ],
            [
                'nama_kategori' => 'Pemberitahuan',
                'keterangan' => 'Surat pemberitahuan untuk informasi penting',
            ],
        ];

        foreach ($kategoris as $kategori) {
            KategoriSurat::create($kategori);
        }
    }
}
