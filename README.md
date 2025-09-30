# 📁 Sistem Arsip Surat

Aplikasi web untuk mengelola arsip surat digital menggunakan Laravel dan Bootstrap. Memungkinkan pengguna untuk menyimpan, mengkategorikan, mencari, dan mengelola dokumen surat dalam format PDF.

## 🎯 Tujuan

- Digitalisasi sistem kearsipan surat untuk meningkatkan efisiensi pengelolaan dokumen
- Menyediakan sistem kategorisasi surat yang terstruktur
- Memudahkan pencarian dan akses dokumen surat
- Mengoptimalkan penyimpanan dan pengorganisasian file PDF

## ✨ Fitur Utama

### 🗂️ Manajemen Arsip Surat
- **Upload File PDF**: Upload dokumen surat dalam format PDF (max 2MB)
- **Kategorisasi**: Pengelompokan surat berdasarkan kategori (Undangan, Pengumuman, Nota Dinas, Pemberitahuan)
- **Pencarian**: Cari surat berdasarkan judul dengan fitur search real-time
- **Preview PDF**: Tampilan preview dokumen PDF langsung di browser
- **Download**: Unduh file PDF ke perangkat pengguna
- **CRUD Operations**: Create, Read, Update, Delete arsip surat

### 📂 Manajemen Kategori Surat
- **Kelola Kategori**: Tambah, edit, dan hapus kategori surat
- **ID Auto Increment**: Sistem ID otomatis untuk setiap kategori
- **Pencarian Kategori**: Cari kategori berdasarkan nama
- **Statistik**: Menampilkan jumlah arsip per kategori

### 🔍 Fitur Pencarian
- Pencarian arsip berdasarkan judul surat
- Pencarian kategori berdasarkan nama kategori
- Filter dan reset pencarian

### 🛡️ Validasi dan Keamanan
- Validasi file PDF (format dan ukuran)
- Konfirmasi hapus menggunakan SweetAlert2
- Validasi form input dengan Laravel Validation
- CSRF protection

### 💻 User Interface
- **Responsive Design**: Layout yang responsif untuk desktop dan mobile
- **Bootstrap 5**: UI modern dan konsisten
- **Sidebar Navigation**: Menu navigasi dengan indikator halaman aktif
- **Breadcrumb**: Navigasi breadcrumb di setiap halaman
- **Sweet Alert**: Notifikasi dan konfirmasi yang menarik
- **Font Awesome Icons**: Ikon yang konsisten di seluruh aplikasi

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 11
- **Frontend**: Bootstrap 5, HTML5, CSS3, JavaScript
- **Database**: MySQL
- **Icons**: Font Awesome 6
- **Notifications**: SweetAlert2
- **File Storage**: Laravel Storage dengan Symbolic Link

## 📋 Persyaratan Sistem

- PHP >= 8.1
- Composer
- MySQL >= 5.7 atau MariaDB
- Node.js & NPM (untuk asset compilation)
- Web Server (Apache/Nginx) atau PHP built-in server

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

# Install Node.js dependencies (opsional)
npm install
```

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

Aplikasi akan berjalan di: `http://127.0.0.1:8000`

## 📁 Struktur Menu

### Sidebar Navigation
- **Arsip** → Mengelola arsip surat (dashboard utama)
- **Kategori Surat** → Mengelola kategori surat
- **About** → Informasi pembuat aplikasi

## 📊 Struktur Database

### Tabel `kategori_surat`
- `id` (Primary Key, Auto Increment)
- `nama_kategori` (String)
- `keterangan` (Text, Nullable)
- `created_at`, `updated_at` (Timestamps)

### Tabel `arsip_surat`
- `id` (Primary Key, Auto Increment)
- `nomor_surat` (String, Unique)
- `kategori_id` (Foreign Key ke kategori_surat)
- `judul` (String)
- `file_pdf` (String - path file)
- `created_at`, `updated_at` (Timestamps)

## 📸 Screenshot

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

## 🔧 Fitur Khusus

### Upload dan Preview PDF
- Validasi file PDF otomatis
- Preview dokumen dalam browser menggunakan iframe
- Penyimpanan file dengan nama unik untuk menghindari konflik

### Konfirmasi Hapus
- Implementasi SweetAlert2 untuk konfirmasi hapus
- AJAX request untuk pengalaman pengguna yang smooth
- Penghapusan file fisik dari storage ketika data dihapus

### Responsive Design
- Layout sidebar yang responsif
- Tabel yang dapat di-scroll pada layar kecil
- Menu navigasi yang mobile-friendly

## 👨‍💻 Pembuat

**Reni Safarida**
- NIM: 123456789
- Prodi: Teknik Informatika
- Tanggal: 30 September 2025

---

**© 2025 Sistem Arsip Surat. Dibuat dengan ❤️ menggunakan Laravel & Bootstrap.**

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
"# Arsip_Surat_RenySafarida" 
