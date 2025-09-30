# Sistem Arsip Surat

Aplikasi web untuk mengelola arsip surat digital menggunakan Laravel dan Bootstrap. Memungkinkan pengguna untuk menyimpan, mengkategorikan, mencari, dan mengelola dokumen surat dalam format PDF.

## Tujuan

- Digitalisasi sistem kearsipan surat untuk meningkatkan efisiensi pengelolaan dokumen
- Menyediakan sistem kategorisasi surat yang terstruktur
- Memudahkan pencarian dan akses dokumen surat
- Mengoptimalkan penyimpanan dan pengorganisasian file PDF

## ✨ Fitur Utama

### Manajemen Arsip Surat
- **Upload File PDF**: Upload dokumen surat dalam format PDF (max 2MB)
- **Kategorisasi**: Pengelompokan surat berdasarkan kategori (Undangan, Pengumuman, Nota Dinas, Pemberitahuan)
- **Pencarian**: Cari surat berdasarkan judul dengan fitur search real-time
- **Preview PDF**: Tampilan preview dokumen PDF langsung di browser
- **Download**: Unduh file PDF ke perangkat pengguna
- **CRUD Operations**: Create, Read, Update, Delete arsip surat

###  Manajemen Kategori Surat
- **Kelola Kategori**: Tambah, edit, dan hapus kategori surat
- **ID Auto Increment**: Sistem ID otomatis untuk setiap kategori
- **Pencarian Kategori**: Cari kategori berdasarkan nama
- **Statistik**: Menampilkan jumlah arsip per kategori

###  Fitur Pencarian
- Pencarian arsip berdasarkan judul surat
- Pencarian kategori berdasarkan nama kategori
- Filter dan reset pencarian

### 🛡️ Validasi dan Keamanan
- Validasi form input dengan Laravel Validation
- CSRF protection

## 🚀 Cara Menjalankan

### 1. Clone Repository
```bash
git clone https://github.com/username/arsip-surat.git
cd arsip-surat
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install


### 3. Konfigurasi Environment
```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=arsip_surat
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Migrasi Database dan Seeder
```bash
# Jalankan migrasi
php artisan migrate

# Jalankan seeder untuk data kategori
php artisan db:seed
```

### 6. Setup Storage
```bash
# Buat symbolic link untuk storage
php artisan storage:link
```

### 7. Jalankan Aplikasi
```bash
# Development server
php artisan serve
```

### Dashboard Arsip Surat
*Halaman utama dengan daftar arsip surat, fitur pencarian, dan tombol aksi*

### Form Upload Surat
*Form untuk mengarsipkan surat baru dengan dropdown kategori dan upload PDF*

### Detail Arsip
*Halaman detail dengan preview PDF dan informasi lengkap surat*

### Manajemen Kategori
*Halaman untuk mengelola kategori surat*

### Halaman About
*Informasi pembuat aplikasi*

## 👨‍💻 Pembuat

**Reni Safarida**
- NIM: 2331730040
- Prodi: Manajemen Informatika
- Tanggal: 30 September 2025
