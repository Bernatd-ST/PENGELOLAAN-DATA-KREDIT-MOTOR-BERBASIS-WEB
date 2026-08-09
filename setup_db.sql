CREATE DATABASE IF NOT EXISTS db_kredit_motor CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_kredit_motor;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS debitur (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_debitur VARCHAR(10) NOT NULL UNIQUE,
  nama_lengkap VARCHAR(100) NOT NULL,
  no_ktp VARCHAR(20) NOT NULL UNIQUE,
  alamat TEXT NOT NULL,
  no_hp VARCHAR(15) NOT NULL,
  pekerjaan VARCHAR(100) NOT NULL,
  penghasilan DECIMAL(15,2) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS motor (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_motor VARCHAR(10) NOT NULL UNIQUE,
  merek VARCHAR(50) NOT NULL,
  tipe VARCHAR(50) NOT NULL,
  tahun YEAR NOT NULL,
  warna VARCHAR(30) NOT NULL,
  harga_otr DECIMAL(15,2) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS kontrak (
  id INT AUTO_INCREMENT PRIMARY KEY,
  no_kontrak VARCHAR(15) NOT NULL UNIQUE,
  debitur_id INT NOT NULL,
  motor_id INT NOT NULL,
  tenor INT NOT NULL,
  dp DECIMAL(15,2) NOT NULL,
  jumlah_pinjaman DECIMAL(15,2) NOT NULL,
  bunga_pertahun DECIMAL(5,2) NOT NULL,
  angsuran_perbulan DECIMAL(15,2) NOT NULL,
  tgl_mulai DATE NOT NULL,
  tgl_selesai DATE NOT NULL,
  status ENUM('aktif','selesai') DEFAULT 'aktif',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (debitur_id) REFERENCES debitur(id) ON DELETE CASCADE,
  FOREIGN KEY (motor_id) REFERENCES motor(id) ON DELETE CASCADE
);

-- Data dummy users (password: admin123)
INSERT INTO users (nama, username, password) VALUES
('Administrator', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Data dummy debitur
INSERT INTO debitur (id_debitur, nama_lengkap, no_ktp, alamat, no_hp, pekerjaan, penghasilan) VALUES
('DBT-0001', 'Budi Santoso', '3171234567890001', 'Jl. Mawar No. 12, Jakarta Selatan', '081234567890', 'Karyawan Swasta', 5000000),
('DBT-0002', 'Siti Rahayu', '3171234567890002', 'Jl. Melati No. 5, Bandung', '082234567891', 'Wiraswasta', 7000000),
('DBT-0003', 'Ahmad Fauzi', '3171234567890003', 'Jl. Kenanga No. 8, Surabaya', '083234567892', 'PNS', 6500000),
('DBT-0004', 'Dewi Anggraini', '3171234567890004', 'Jl. Anggrek No. 3, Yogyakarta', '084234567893', 'Guru', 4500000),
('DBT-0005', 'Rudi Hartono', '3171234567890005', 'Jl. Flamboyan No. 17, Medan', '085234567894', 'Pedagang', 8000000);

-- Data dummy motor
INSERT INTO motor (id_motor, merek, tipe, tahun, warna, harga_otr) VALUES
('MTR-0001', 'Honda', 'Beat', 2023, 'Merah', 18500000),
('MTR-0002', 'Yamaha', 'NMAX', 2023, 'Biru', 32000000),
('MTR-0003', 'Honda', 'Vario 125', 2022, 'Hitam', 22000000),
('MTR-0004', 'Suzuki', 'GSX-R150', 2023, 'Putih', 31500000),
('MTR-0005', 'Yamaha', 'Aerox', 2022, 'Abu-abu', 25000000);

-- Data dummy kontrak
INSERT INTO kontrak (no_kontrak, debitur_id, motor_id, tenor, dp, jumlah_pinjaman, bunga_pertahun, angsuran_perbulan, tgl_mulai, tgl_selesai, status) VALUES
('KTR-20250001', 1, 1, 24, 4000000, 14500000, 10, 705833.33, '2025-01-15', '2027-01-15', 'aktif'),
('KTR-20250002', 2, 2, 36, 7000000, 25000000, 12, 1000000.00, '2025-02-01', '2028-02-01', 'aktif'),
('KTR-20250003', 3, 3, 18, 5000000, 17000000, 10, 1022222.22, '2025-03-01', '2026-09-01', 'aktif'),
('KTR-20250004', 4, 4, 12, 8000000, 23500000, 9, 2127500.00, '2024-01-01', '2025-01-01', 'selesai'),
('KTR-20250005', 5, 5, 24, 5000000, 20000000, 11, 950833.33, '2025-04-01', '2027-04-01', 'aktif');
