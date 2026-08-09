# Aplikasi Pengelolaan Data Kredit Motor Berbasis Web

Aplikasi ini dikembangkan sebagai bagian dari skripsi jurusan Informatika dengan judul:
**"RANCANG BANGUN APLIKASI PENGELOLAAN DATA KREDIT MOTOR BERBASIS WEB (STUDI KASUS: PERUSAHAAN FINANCE)"**

## Tujuan Aplikasi

Aplikasi ini dirancang untuk menggantikan pencatatan manual data debitur kredit motor (yang sebelumnya menggunakan Excel/kertas) menjadi sistem berbasis web yang lebih terstruktur, mudah dicari, dan mudah dilaporkan.

## Fitur Utama

### 1. Manajemen Data Debitur (CRUD)
- Tambah data debitur baru
- Lihat daftar semua debitur
- Edit data debitur
- Hapus data debitur
- Cari debitur berdasarkan nama atau nomor KTP

**Field data debitur:**
- ID Debitur (auto generate, format: DBT-0001)
- Nama Lengkap
- Nomor KTP
- Alamat
- Nomor HP
- Pekerjaan
- Penghasilan per bulan

### 2. Manajemen Data Motor (CRUD)
- Tambah data motor
- Lihat daftar motor
- Edit data motor
- Hapus data motor

**Field data motor:**
- ID Motor (auto generate, format: MTR-0001)
- Merek (contoh: Honda, Yamaha, Suzuki)
- Tipe (contoh: Beat, Vario, NMAX)
- Tahun
- Warna
- Harga OTR (On The Road)

### 3. Manajemen Data Kontrak Kredit (CRUD)
- Buat kontrak baru (menghubungkan debitur dengan motor)
- Lihat daftar kontrak
- Edit kontrak
- Hapus kontrak
- Cari kontrak berdasarkan nama debitur atau nomor kontrak

**Field data kontrak:**
- Nomor Kontrak (auto generate, format: KTR-20250001)
- Pilih Debitur (dropdown dari data debitur)
- Pilih Motor (dropdown dari data motor)
- Tenor (pilihan: 12 bulan, 18 bulan, 24 bulan, 36 bulan)
- Uang Muka (DP) dalam Rupiah
- Jumlah Pinjaman (harga motor - DP)
- Bunga per tahun (%) (input manual)
- Total Angsuran per bulan (otomatis dihitung: [Jumlah Pinjaman + (Jumlah Pinjaman * Bunga/100)] / Tenor)
- Tanggal Mulai Kontrak
- Tanggal Selesai Kontrak (otomatis + tenor dari tanggal mulai)

### 4. Laporan Sederhana
- Laporan semua debitur (bisa di-print atau export ke PDF)
- Laporan semua kontrak aktif (status: masih dalam masa angsuran)
- Laporan semua kontrak selesai (status: sudah lunas)

### 5. Autentikasi Pengguna
- Halaman login (username dan password)
- Role: Admin
- Logout

## Teknologi yang Digunakan

- **Backend Framework:** CodeIgniter 4
- **Frontend:** Bootstrap 5
- **Database:** MySQL / MariaDB
- **Library Tambahan:**
  - Dompdf (untuk export PDF laporan)
  - SweetAlert (untuk notifikasi popup)
  - DataTables (untuk tabel yang bisa di-search dan di-sort)

## Struktur Database

Aplikasi menggunakan 4 tabel utama:
- `users` - untuk autentikasi admin
- `debitur` - menyimpan data debitur
- `motor` - menyimpan data motor
- `kontrak` - menyimpan data kontrak kredit dengan relasi ke debitur dan motor

## Cara Setup

### Prasyarat

- PHP 8.2 atau lebih tinggi
- MySQL / MariaDB
- Composer
- Web server (Apache/Nginx)

### Langkah-langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/Bernatd-ST/PENGELOLAAN-DATA-KREDIT-MOTOR-BERBASIS-WEB.git
   cd PENGELOLAAN-DATA-KREDIT-MOTOR-BERBASIS-WEB
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Konfigurasi environment**
   ```bash
   cp env .env
   ```

4. **Edit file `.env`**
   Buka file `.env` dan sesuaikan konfigurasi berikut:
   ```ini
   app.baseURL = 'http://localhost:8080/'
   
   database.default.hostname = localhost
   database.default.database = nama_database
   database.default.username = username_mysql
   database.default.password = password_mysql
   database.default.DBDriver = MySQLi
   ```

5. **Import database**
   - Buat database baru di MySQL sesuai dengan nama yang diatur di `.env`
   - Import file `setup_db.sql` ke database yang telah dibuat:
   ```bash
   mysql -u username -p nama_database < setup_db.sql
   ```

6. **Jalankan aplikasi**
   ```bash
   php spark serve
   ```

7. **Akses aplikasi**
   Buka browser dan kunjungi: `http://localhost:8080`

### Login Default

- **Username:** admin
- **Password:** admin123

> **Catatan:** Silakan ubah password default setelah login pertama untuk keamanan.

## Struktur Folder Proyek

```
kredit_motor/
├── app/
│   ├── Config/          # Konfigurasi aplikasi
│   ├── Controllers/     # Controller untuk setiap fitur
│   ├── Models/          # Model database
│   ├── Views/           # View/template halaman
│   ├── Filters/         # Filter untuk autentikasi
│   ├── Helpers/         # Helper functions
│   └── Libraries/       # Custom libraries
├── public/              # Folder publik (index.php, assets)
├── writable/            # Folder untuk cache, logs, uploads
├── tests/               # Unit tests
├── setup_db.sql         # SQL untuk setup database
├── composer.json        # Dependencies PHP
├── env                  # Template environment
└── spark                # CLI tool CodeIgniter
```

## Halaman-halaman Aplikasi

1. **Halaman Login** - Autentikasi admin
2. **Dashboard** - Statistik ringkas (total debitur, motor, kontrak aktif)
3. **Manajemen Debitur** - CRUD data debitur
4. **Manajemen Motor** - CRUD data motor
5. **Manajemen Kontrak** - CRUD kontrak kredit dengan perhitungan otomatis
6. **Laporan** - Laporan debitur dan kontrak dengan export PDF

## Developer

Dikembangkan oleh:
- Andry Situmeang
- Jurusan Informatika

## Lisensi

Lisensi tersedia di file [LICENSE](LICENSE)

## Catatan Penting

Aplikasi ini dikembangkan untuk keperluan skripsi dan mencakup fitur-fitur minimum viable product (MVP). Beberapa fitur yang tidak disertakan:
- Notifikasi WhatsApp/SMS/Email
- Sistem pembayaran angsuran (cukup kontrak saja)
- Role user yang rumit (cukup admin saja)
- Fitur reset password
- API atau integrasi dengan sistem lain
- Hosting atau deployment (didesain untuk penggunaan lokal)
