-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 17, 2025 at 12:50 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jurnal`
--

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE `download` (
  `id_perangkat` int NOT NULL,
  `id_guru` int NOT NULL,
  `id_mapel` int NOT NULL,
  `ket` varchar(100) NOT NULL,
  `tanggal_upload` date NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `tipe_file` varchar(10) NOT NULL,
  `ukuran_file` varchar(20) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`id_perangkat`, `id_guru`, `id_mapel`, `ket`, `tanggal_upload`, `nama_file`, `tipe_file`, `ukuran_file`, `file`) VALUES
(1, 7, 18, 'Laporan Akhir Semester Gasal', '2025-05-20', 'Laporan Pembelajaran Teknik Pemrograman', 'pdf', '296066', '../file/Laporan-Pembelajaran-Teknik-Pemrograman.pdf'),
(2, 1, 9, 'Rencana Pelaksanaan Pembelajaran (RPP)', '2025-05-22', 'RPP Pemrograman Berbasis Objek', 'docx', '20791', '../file/RPP-Pemrograman-Berbasis-Objek.docx'),
(3, 1, 9, 'Silabus Mata Pelajaran', '2025-05-22', 'Silabus Sistem Operasi dan Jaringan', 'docx', '20791', '../file/Silabus-Sistem-Operasi-dan-Jaringan.docx'),
(4, 1, 9, 'Program Tahunan', '2025-05-22', 'Program Tahunan Pengembangan Perangkat Lunak', 'docx', '20791', '../file/Program-Tahunan-Pengembangan-Perangkat-Lunak.docx'),
(7, 7, 24, 'Evaluasi Pembelajaran', '2025-06-11', 'Evaluasi Tengah Semester', 'pdf', '296066', '../file/Evaluasi-Tengah-Semester.pdf'),
(6, 1, 21, 'Perangkat Ajar', '2025-05-24', 'RPP Pengembangan Aplikasi Mobile', 'pdf', '278892', '../file/RPP-Pengembangan-Aplikasi-Mobile.pdf'),
(8, 1, 19, 'Perangkat Pembelajaran', '2025-07-08', 'RPP Implementasi Database', 'pdf', '806020', '../file/RPP-Implementasi-Database.pdf'),
(9, 11, 29, 'Perangkat Ajar', '2025-07-19', 'Silabus Keamanan Jaringan dan Sistem', 'pdf', '484705', '../file/Silabus-Keamanan-Jaringan-dan-Sistem.pdf'),
(10, 1, 19, 'Perangkat Ajar', '2025-08-02', 'Silabus Pemrograman Web', 'pdf', '296266', '../file/Silabus-Pemrograman-Web.pdf'),
(11, 1, 22, 'Perangkat Ajar', '2025-08-02', 'Silabus Proyek Akhir', 'docx', '37170', '../file/Silabus-Proyek-Akhir.docx'),
(12, 1, 34, 'Perangkat Ajar', '2025-08-19', 'Silabus Pemrograman Python', 'pdf', '1708967', '../file/Silabus-Pemrograman-Python.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tb_agenda`
--

CREATE TABLE `tb_agenda` (
  `id_agenda` int NOT NULL,
  `id_guru` int NOT NULL,
  `id_mapel` int NOT NULL,
  `tgl` date NOT NULL,
  `jam` varchar(12) NOT NULL,
  `materi` text NOT NULL,
  `absen` varchar(50) NOT NULL,
  `ket` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_agenda`
--

INSERT INTO `tb_agenda` (`id_agenda`, `id_guru`, `id_mapel`, `tgl`, `jam`, `materi`, `absen`, `ket`, `status`) VALUES
(17, 7, 18, '2025-05-17', '19:14', '<p>Pengenalan Konsep Dasar Pemrograman</p>\r\n', 'Cukup', 'Siswa aktif dalam diskusi kelas', ''),
(24, 7, 18, '2025-05-22', '19:00', '<p>Praktikum Struktur Data</p>\r\n', 'Baik', 'Siswa antusias mengikuti praktikum', ''),
(26, 1, 20, '2025-05-23', '21:01', '<p>Pembelajaran Sistem Operasi</p>\r\n', 'Baik', 'Materi berjalan dengan lancar', ''),
(28, 1, 19, '2025-05-25', '22:01', '<p>Implementasi Basis Data Relasional</p>\r\n', 'Sangat Baik', 'Materi penting untuk proyek akhir', ''),
(29, 1, 19, '2025-05-25', '23:59', '<p>Analisis Jaringan Komputer</p>\r\n', 'Cukup', 'Perlu pendalaman lebih lanjut', ''),
(31, 1, 20, '2025-11-30', '23:57', '<p>Implementasi Web Dinamis dengan PHP</p>\r\n', 'Baik', 'Praktikum dengan database MySQL', ''),
(33, 9, 26, '2025-05-27', '14:58', '<p>Pemrograman Berorientasi Objek</p>\r\n', 'Sangat Baik', 'Siswa memahami konsep inheritance', ''),
(34, 9, 27, '2025-05-27', '12:59', '<p>Statistika dan Probabilitas</p>\r\n', 'Baik', 'Penerapan dalam analisis data', ''),
(35, 7, 18, '2025-04-13', '01:30', '<p>Reviu Materi Ujian Tengah Semester</p>\r\n', '10 Hadir', '2 Siswa Tidak Hadir karena sakit', ''),
(36, 1, 22, '2025-07-08', '02:58', '<p>Proyek Akhir Semester Genap</p>\r\n', 'Cukup', 'Evaluasi hasil presentasi', ''),
(37, 1, 22, '2025-07-08', '03:04', '<p>Analisis Algoritma dan Struktur Data</p>\r\n', 'Baik', 'Implementasi dalam bahasa C++', ''),
(38, 11, 29, '2025-07-19', '04:04', '<p>Keamanan Jaringan dan Sistem</p>\r\n', 'Cukup', 'Penting untuk sistem informasi', ''),
(39, 11, 29, '2025-07-20', '08:08', '<p>Desain Antarmuka Pengguna</p>\r\n', 'Baik', 'Focus pada UX dan UI', ''),
(40, 11, 29, '2025-07-19', '06:06', '<p>Pemrograman Mobile Android</p>\r\n', 'Sangat Baik', 'Siswa antusias belajar Kotlin', ''),
(41, 11, 30, '2025-07-19', '23:01', '<p>Machine Learning Dasar</p>\r\n', 'Sangat Baik', 'Pengenalan AI di kalangan siswa', ''),
(42, 1, 19, '2025-08-02', '22:59', '<p>Implementasi Sistem Informasi</p>\r\n', 'Baik', 'Menggunakan framework Laravel', ''),
(43, 10, 31, '2025-08-03', '23:59', '<p>Instalasi dan Konfigurasi Sistem Operasi Linux</p>\r\n', 'Cukup', 'Praktikum Instalasi Sistem Operasi Berbasis Open Source', ''),
(44, 1, 33, '2025-08-03', '22:58', '<p>Multimedia dan Animasi Digital</p>\r\n', 'Baik', 'Penggunaan software Adobe Creative Suite', ''),
(45, 1, 19, '2025-08-18', '09:01', '<p>Pembelajaran Pemrograman Python</p>\r\n', 'Baik', 'Penerapan dalam bidang data science', ''),
(46, 8, 25, '2025-08-18', '10:10', '<p>Implementasi Cloud Computing</p>\r\n', 'Baik', 'Simulasi penggunaan AWS dan Google Cloud', ''),
(47, 9, 27, '2025-08-18', '07:50', '<p>Kolaborasi dan Presentasi Projek</p>\r\n', 'Baik', 'Penilaian soft skills siswa', ''),
(48, 1, 19, '2025-08-19', '07:30', '<p>Proses Pemrograman Berbasis Agile</p>\r\n', 'Cukup', 'Pengenalan metodologi pengembangan perangkat lunak', ''),
(49, 8, 25, '2025-08-19', '08:30', '<p>Simulasi Jaringan Komputer</p>\r\n', 'Baik', 'Praktikum menggunakan Cisco Packet Tracer', ''),
(50, 11, 29, '2025-08-19', '10:30', '<p>Focus Group Discussion Sistem Jaringan</p>\r\n', 'Baik', 'Diskusi kelompok tentang implementasi jaringan', ''),
(51, 1, 20, '2025-08-19', '12:30', '<p>Ulasan Tugas dan Evaluasi Mingguan</p>\r\n', 'Baik', 'Evaluasi tugas mingguan dan remedial', ''),
(52, 1, 20, '2025-08-19', '08:00', '<p>Pembelajaran Berbasis Proyek</p>\r\n', 'Baik', 'Pembuatan aplikasi berbasis web', ''),
(53, 1, 33, '2025-08-19', '03:04', '<p>Analisis Kebutuhan Sistem</p>\r\n', 'Baik', 'Studi kasus implementasi sistem informasi', ''),
(54, 1, 33, '2025-08-19', '06:59', '<p>Manajemen Proyek Perangkat Lunak</p>\r\n', 'Baik', 'Pengenalan tools manajemen proyek', ''),
(55, 1, 34, '2025-08-19', '05:00', '<p>Desain dan Implementasi Database</p>\r\n', 'Baik', 'Praktikum dengan MySQL dan PostgreSQL', ''),
(56, 1, 19, '2025-08-19', '06:40', '<p>Testing dan Quality Assurance</p>\r\n', 'Baik', 'Pengujian sistem dan debugging', ''),
(57, 1, 19, '2025-08-19', '06:59', '<p>Maintainance Sistem</p>\r\n', 'Baik', 'Perawatan dan optimalisasi sistem', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_agenda_lain`
--

CREATE TABLE `tb_agenda_lain` (
  `id_lain` int NOT NULL,
  `id_guru` int NOT NULL,
  `tanggal` date NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `tb_agenda_lain`
--
ALTER TABLE `tb_agenda_lain`
  ADD PRIMARY KEY (`id_lain`);

--
-- AUTO_INCREMENT for table `tb_agenda_lain`
--
ALTER TABLE `tb_agenda_lain`
  MODIFY `id_lain` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Dumping data for table `tb_agenda_lain`
--

INSERT INTO `tb_agenda_lain` (`id_lain`, `id_guru`, `tanggal`, `nama_kegiatan`, `jam_mulai`, `jam_selesai`, `keterangan`) VALUES
(1, 1, '2025-05-28', 'Rapat Koordinasi Kurikulum', '09:00', '11:00', 'Pembahasan pelaksanaan kurikulum tahun ajaran baru'),
(2, 1, '2025-05-28', 'Evaluasi Semester', '13:00', '15:00', 'Evaluasi pembelajaran semester genap tahun ajaran 2024/2025'),
(3, 7, '2025-06-08', 'Pelatihan Guru', '08:00', '16:00', 'Pelatihan penerapan teknologi dalam pembelajaran modern'),
(4, 7, '2025-06-11', 'Persiapan Tahun Ajaran Baru', '09:00', '12:00', 'Menyusun program dan persiapan awal tahun ajaran 2025/2026'),
(5, 11, '2025-07-19', 'Pelatihan Soft Skills', '08:00', '14:00', 'Pelatihan soft skills untuk siswa kelas XII'),
(6, 1, '2025-08-19', 'Revisi Kurikulum', '10:00', '12:00', 'Revisi kurikulum berbasis kompetensi keahlian'),
(7, 1, '2025-08-19', 'Pembukaan Tahun Ajaran', '07:00', '10:00', 'Kegiatan pembelajaran dimulai');

--
-- Table structure for table `tb_agendalain`
--

CREATE TABLE `tb_agendalain` (
  `id_lain` int NOT NULL,
  `id_guru` int NOT NULL,
  `tgl_kgt` date NOT NULL,
  `kegiatan` text NOT NULL,
  `isi` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_agendalain`
--

INSERT INTO `tb_agendalain` (`id_lain`, `id_guru`, `tgl_kgt`, `kegiatan`, `isi`, `keterangan`) VALUES
(9, 1, '2025-05-28', 'Rapat Koordinasi Kurikulum', '<p>Pembahasan pelaksanaan kurikulum tahun ajaran baru</p>\r\n', 'Sudah terealisasi'),
(10, 1, '2025-05-28', 'Evaluasi Semester', '<p>Evaluasi pembelajaran semester genap tahun ajaran 2024/2025</p>\r\n', 'Selesai'),
(11, 7, '2025-06-08', 'Pelatihan Guru', '<p>Pelatihan penerapan teknologi dalam pembelajaran modern</p>\r\n', 'Berhasil diselenggarakan'),
(12, 7, '2025-06-11', 'Persiapan Tahun Ajaran Baru', '<p>Menyusun program dan persiapan awal tahun ajaran 2025/2026</p>\r\n', 'Sudah terlaksana dengan baik'),
(13, 11, '2025-07-19', 'Pelatihan Soft Skills', '<p>Pelatihan soft skills untuk siswa kelas XII</p>\r\n', 'Dilakukan di aula sekolah'),
(14, 1, '2025-08-19', 'Revisi Kurikulum', '<p>Revisi kurikulum berbasis kompetensi keahlian</p>\r\n', 'Terkait dengan standar mutu pendidikan'),
(15, 1, '2025-08-19', 'Pembukaan Tahun Ajaran', '<p>Pembukaan tahun ajaran baru 2025/2026</p>\r\n', 'Kegiatan pembelajaran dimulai');


-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int NOT NULL,
  `nama_guru` varchar(20) NOT NULL,
  `nip` varchar(12) NOT NULL,
  `kelamin` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(12) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gelar` varchar(100) NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `agama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nama_guru`, `nip`, `kelamin`, `alamat`, `telp`, `username`, `password`, `gelar`, `tempat`, `tgl`, `agama`, `email`, `photo`) VALUES
(1, 'Ahmad Fauzi', '19740930200501001', 'Laki-laki', '        Jl. Pendidikan No. 15, Padang', '082214609889', 'guru', 'guru', 'S.Kom., M.T.', 'Padang', '1974-09-30', 'Islam', 'ahmad.fauzi@smkn4pyk.sch.id', 'admin.jpg'),
(8, 'Siti Rahmawati', '19851123201001002', 'Perempuan', 'Jl. Teknologi No. 8, Pekanbaru', '081234567890', 'a', 'a', 'S.Kom., M.Kom.', 'Pekanbaru', '1985-11-23', 'Islam', 'siti.rahmawati@smkn4pyk.sch.id', '10304432100006.png'),
(7, 'Budi Santoso', '19800515200801003', 'Laki-laki', 'Jl. Informatika No. 23, Bengkulu', '082134567890', 'yamin', 'yamin', 'S.T., M.T.', 'Bengkulu', '1980-05-15', 'Islam', 'budi.santoso@smkn4pyk.sch.id', 'userk.png'),
(9, 'Dewi Kusuma Wardhani', '19830812200701004', 'Perempuan', 'Jl. Multimedia No. 5, Padang', '081345678901', 'r', 'r', 'S.Pd., M.Kom.', 'Padang', '1983-08-12', 'Kristen', 'dewi.wardhani@smkn4pyk.sch.id', 'guruc.png'),
(10, 'M. Joko Prasetyo', '19820308200601005', 'Laki-laki', 'Jl. Riset dan Teknologi No. 12, Solok', '085234567890', 'rdn', 'rdn', 'S.Kom., M.T.', 'Solok', '1982-03-08', 'Kristen', 'joko.prasetyo@smkn4pyk.sch.id', '10304432100006.png'),
(11, 'Lintang Sari', '19880719201201006', 'Perempuan', 'Jl. Digital Inovasi No. 7, Jakarta', '081234567980', 'tes', 'tes', 'S.T., M.Kom.', 'Jakarta', '1988-07-19', 'Islam', 'lintang.sari@smkn4pyk.sch.id', 'userk.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_izin_siswa`
--

CREATE TABLE `tb_izin_siswa` (
  `id_izin` int NOT NULL,
  `id_siswa` int NOT NULL,
  `tanggal_izin` date NOT NULL,
  `jenis_izin` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `status_izin` varchar(20) NOT NULL DEFAULT 'Menunggu',
  `id_guru_piket` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_izin_siswa`
--

INSERT INTO `tb_izin_siswa` (`id_izin`, `id_siswa`, `tanggal_izin`, `jenis_izin`, `keterangan`, `status_izin`, `id_guru_piket`) VALUES
(1, 1, '2025-11-17', 'Sakit', 'sakit demam', 'Disetujui', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kehadiran_guru`
--

CREATE TABLE `tb_kehadiran_guru` (
  `id_kehadiran` int NOT NULL,
  `id_tajaran` int NOT NULL,
  `id_guru` int NOT NULL,
  `tanggal_kehadiran` date NOT NULL,
  `status_kehadiran` varchar(20) NOT NULL,
  `waktu_masuk` time DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kehadiran_guru`
--

INSERT INTO `tb_kehadiran_guru` (`id_kehadiran`, `id_tajaran`, `id_guru`, `tanggal_kehadiran`, `status_kehadiran`, `waktu_masuk`, `keterangan`) VALUES
(1, 2, 1, '2025-11-17', 'Hadir', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `idkelas` int NOT NULL,
  `kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`idkelas`, `kelas`) VALUES
(1, 'X-TKJ'),
(2, 'XI-TKJ'),
(3, 'XII-RPL'),
(4, 'XII- TKJ'),
(5, 'XI-RPL'),
(6, 'X-RPL'),
(7, 'X-MULTIMEDIA'),
(8, 'XI-MULTIMEDIA'),
(9, 'XII-MULTIMEDIA');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas_mapel`
--

CREATE TABLE `tb_kelas_mapel` (
  `id_kelas_m` int NOT NULL,
  `idkelas` int NOT NULL,
  `id_mapel` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kepsek`
--

CREATE TABLE `tb_kepsek` (
  `id_kepsek` int NOT NULL,
  `nama` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `photok` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kepsek`
--

INSERT INTO `tb_kepsek` (`id_kepsek`, `nama`, `username`, `password`, `photok`) VALUES
(1, 'Aizur Hedi, M.Hum', 'kepsek', 'kepsek', 'userk.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keterlambatan`
--

CREATE TABLE `tb_keterlambatan` (
  `id_keterlambatan` int NOT NULL,
  `id_siswa` int NOT NULL,
  `tanggal` date NOT NULL,
  `waktu_terlambat` int DEFAULT NULL COMMENT 'Durasi keterlambatan dalam menit',
  `keterangan` text,
  `id_guru_piket` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `id_mapel` int NOT NULL,
  `id_guru` int NOT NULL,
  `idkelas` int NOT NULL,
  `nama_mapel` varchar(60) NOT NULL,
  `jurusan` varchar(60) NOT NULL,
  `tingkat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mapel`
--

INSERT INTO `tb_mapel` (`id_mapel`, `id_guru`, `idkelas`, `nama_mapel`, `jurusan`, `tingkat`) VALUES
(18, 7, 1, 'Instalasi SO Berbasis GUI', 'TKJ', '1'),
(19, 1, 2, 'KKPI', 'TKJ', '1'),
(20, 1, 3, 'Instalasi SO Berbasis Text', 'TKR', '3'),
(22, 1, 4, 'Bahasa Inggris', 'TKR', '2'),
(23, 7, 1, 'Bahasa Indonesia', 'TKJ', '1'),
(24, 7, 4, 'Bahasa Inggris', 'TKR', '3'),
(25, 8, 1, 'Instalasi SO Berbasis GUI', 'TKJ', '1'),
(26, 9, 1, 'KKPI', 'TKJ', '1'),
(27, 9, 2, 'MIJWAN', 'TKR', '2'),
(28, 9, 3, 'MIS', 'RPL', '3'),
(29, 11, 1, 'KKPI', 'TKJ', '1'),
(30, 11, 2, 'Bahasa Indonesia', 'RPL', '1'),
(31, 10, 1, 'Instalasi SO Berbasis GUI', 'TKJ', '1'),
(32, 10, 2, 'Instalasi SO Berbasis Text', 'TKJ', '1'),
(33, 1, 1, 'Bahasa Indonesia', 'TKJ', '1'),
(34, 1, 1, 'MIJLAN', 'RPL', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mastermapel`
--

CREATE TABLE `tb_mastermapel` (
  `id_mMapel` int NOT NULL,
  `mapel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mastermapel`
--

INSERT INTO `tb_mastermapel` (`id_mMapel`, `mapel`) VALUES
(2, 'Instalasi SO Berbasis GUI'),
(3, 'Instalasi SO Berbasis Text'),
(4, 'Bahasa Indonesia'),
(5, 'Bahasa Inggris'),
(6, 'KKPI'),
(7, 'MISOD'),
(8, 'MIS'),
(9, 'MIJWAN'),
(10, 'MIJLAN');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `kelamin` varchar(20) NOT NULL,
  `idkelas` int NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nis`, `nama_siswa`, `kelamin`, `idkelas`, `alamat`) VALUES
(1, '12345678', 'Andi Pratama', 'Laki-laki', 1, 'Jl. Merdeka No.10'),
(2, '12345679', 'Siti Nurhaliza', 'Perempuan', 2, 'Jl. Kenanga No.15'),
(3, '12345680', 'Budi Santoso', 'Laki-laki', 3, 'Jl. Melati No.22'),
(4, '12345681', 'Rina Amelia', 'Perempuan', 4, 'Jl. Mawar No.30'),
(5, '12345682', 'Doni Gunawan', 'Laki-laki', 5, 'Jl. Anggrek No.18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tajaran`
--

CREATE TABLE `tb_tajaran` (
  `id_tajaran` int NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tajaran`
--

INSERT INTO `tb_tajaran` (`id_tajaran`, `tahun_ajaran`, `status`) VALUES
(1, '2023 / 2024', 'T'),
(2, '2024 -2025', 'T'),
(3, '2025 / 2026', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_admin` int NOT NULL,
  `nama` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_admin`, `nama`, `username`, `password`, `foto`) VALUES
(1, 'Administrator', 'admin', 'admin', 'userk.png'),
(1, 'Administrator', 'admin', 'admin', 'userk.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_agenda_lain`
--
ALTER TABLE `tb_agenda_lain`
  ADD PRIMARY KEY (`id_lain`);

--
-- Indexes for table `tb_izin_siswa`
--
ALTER TABLE `tb_izin_siswa`
  ADD PRIMARY KEY (`id_izin`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_guru_piket` (`id_guru_piket`);

--
-- Indexes for table `tb_kehadiran_guru`
--
ALTER TABLE `tb_kehadiran_guru`
  ADD PRIMARY KEY (`id_kehadiran`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_tajaran` (`id_tajaran`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`idkelas`);

--
-- Indexes for table `tb_keterlambatan`
--
ALTER TABLE `tb_keterlambatan`
  ADD PRIMARY KEY (`id_keterlambatan`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_guru_piket` (`id_guru_piket`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `idkelas` (`idkelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_agenda_lain`
--
ALTER TABLE `tb_agenda_lain`
  MODIFY `id_lain` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_izin_siswa`
--
ALTER TABLE `tb_izin_siswa`
  MODIFY `id_izin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kehadiran_guru`
--
ALTER TABLE `tb_kehadiran_guru`
  MODIFY `id_kehadiran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `idkelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_keterlambatan`
--
ALTER TABLE `tb_keterlambatan`
  MODIFY `id_keterlambatan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`idkelas`) REFERENCES `tb_kelas` (`idkelas`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
