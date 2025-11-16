# Aplikasi Agenda Mengajar & Kegiatan Harian Guru Berbasis Web PHP/MySQLi

## Deskripsi Aplikasi

Aplikasi Agenda Mengajar & Kegiatan Harian Guru adalah sistem informasi berbasis web yang dirancang untuk mengelola dan mencatat aktivitas harian pendidikan di lingkungan sekolah. Aplikasi ini dibangun menggunakan teknologi PHP dan MySQL, serta dirancang khusus untuk Sekolah Menengah Pertama (SMP) N 1 Kaliwungu.

Sistem ini bertujuan untuk menggantikan proses manual pengelolaan agenda harian guru, mencatat kehadiran siswa, mengelola perizinan dan keterlambatan, serta memberikan kemudahan dalam pelaporan aktivitas pendidikan secara digital.

## Fitur Utama

### 1. Sistem Multi-Role
Aplikasi ini memiliki tiga level pengguna dengan fungsionalitas berbeda:
- **Guru (Piket)**: Melakukan input agenda harian, mencatat kehadiran siswa, izin dan keterlambatan
- **Administrator**: Mengelola master data, menyetujui permintaan, dan membuat laporan sistem
- **Kepala Sekolah**: Mengakses laporan dan data untuk kebutuhan supervisi dan pengambilan keputusan

### 2. Manajemen Agenda Harian
- Mencatat agenda mengajar harian guru
- Mencatat materi yang diajarkan
- Mencatat kehadiran siswa dan kondisi kelas
- Menyimpan catatan tambahan dalam agenda

### 3. Manajemen Kedisiplinan Siswa
- Mencatat keterlambatan siswa
- Mencatat izin siswa
- Menyimpan data pelanggaran siswa secara sistematis

### 4. Manajemen Guru
- Jadwal piket guru
- Manajemen guru pengganti
- Kehadiran guru

### 5. File Perangkat
- Upload dan manajemen file perangkat ajar
- Repositori dokumen pendidikan

### 6. Sistem Laporan
- Laporan harian
- Laporan bulanan
- Laporan berdasarkan guru
- Fungsi ekspor data

## Teknologi yang Digunakan

- **Backend**: PHP
- **Database**: MySQLi
- **Frontend**: HTML, CSS, JavaScript
- **Framework UI**: Bootstrap
- **Library tambahan**: CKEditor (editor teks kaya), DataTables (tabel data interaktif)

## Struktur Database

Aplikasi ini menggunakan database `db_jurnal` dengan berbagai tabel, termasuk:
- `tb_user`: Penyimpanan data administrator
- `tb_guru`: Data guru
- `tb_kepsek`: Data kepala sekolah
- `tb_agenda`: Data agenda mengajar
- `tb_agendalain`: Data kegiatan lainnya
- `tb_kelas`: Data kelas
- `tb_mapel`: Data mata pelajaran
- Dan berbagai tabel pendukung lainnya

## Instalasi

1. Pastikan sistem telah terinstall XAMPP atau server web lainnya (Apache, PHP, MySQL)
2. Ekstrak file aplikasi ke dalam direktori htdocs
3. Import file `db_jurnal.sql` ke dalam database MySQL
4. Sesuaikan konfigurasi koneksi database pada file `koneksi.php`
5. Jalankan aplikasi melalui browser

## Hak Akses

- **Halaman Login Umum**: `index.php` - untuk semua jenis pengguna
- **Halaman Admin**: `_admin/` - khusus administrator
- **Halaman Guru**: `_guru/` - khusus guru/piket
- **Halaman Kepala Sekolah**: `_kepsek/` - khusus kepala sekolah

## Tujuan Pengembangan

Aplikasi ini dikembangkan untuk:
- Mendigitalkan proses administrasi pendidikan
- Mempermudah pengelolaan agenda harian guru
- Memberikan informasi real-time tentang kegiatan pendidikan
- Meningkatkan efisiensi dan efektivitas pengelolaan data pendidikan
- Menyediakan sistem informasi yang dapat diandalkan untuk pengambilan keputusan

## Informasi Tambahan

- Nama Sekolah: SMP N 1 Kaliwungu
- Alamat: Kedungdowo, Kec. Kaliwungu, Kabupaten Kudus, Jawa Tengah 59361
- Telepon: (0291) 438068
