-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2025 at 11:17 PM
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
(1, 7, 18, 'Untuk Bukti Kalau Saya Sudah Wisuda', '2018-05-20', 'Transkip Nilai Terakhir Saya', 'pdf', '296066', '../file/Transkip Nilai Terakhir Saya.pdf'),
(2, 1, 9, 'RPP', '2018-05-22', 'Perangkat Pengajaran 1', 'docx', '20791', '../file/Perangkat Pengajaran 1.docx'),
(3, 1, 9, 'SILABUS', '2018-05-22', 'Perangkat Pengajaran 2', 'docx', '20791', '../file/Perangkat Pengajaran 2.docx'),
(4, 1, 9, 'Program Tahunan', '2018-05-22', 'Perangkat Pengajaran 3', 'docx', '20791', '../file/Perangkat Pengajaran 3.docx'),
(7, 7, 24, 'Hanya Test', '2018-06-11', 'Tes Upload', 'pdf', '296066', '../file/Tes Upload.pdf'),
(6, 1, 21, 'pERANGKAT', '2018-05-24', 'RPP', 'pdf', '278892', '../file/RPP.pdf'),
(8, 1, 19, 'Perangkat', '2018-07-08', 'RPP', 'pdf', '806020', '../file/RPP.pdf'),
(9, 11, 29, 'PERANGKAT', '2018-07-19', 'SILABUS', 'pdf', '484705', '../file/SILABUS.pdf'),
(10, 1, 19, 'Perangkat', '2018-08-02', 'Silabus', 'pdf', '296266', '../file/Silabus.pdf'),
(11, 1, 22, 'Perangkat', '2018-08-02', 'Silabus', 'docx', '37170', '../file/Silabus.docx'),
(12, 1, 34, 'Perangkat', '2018-08-19', 'Silabus', 'pdf', '1708967', '../file/Silabus.pdf');

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
-- Dumping data for table `tb_agenda_lain`
--

INSERT INTO `tb_agenda_lain` (`id_lain`, `id_guru`, `tanggal`, `nama_kegiatan`, `jam_mulai`, `jam_selesai`, `keterangan`) VALUES
(1, 1, '2025-05-28', 'Rapat Koordinasi Kurikulum', '09:00:00', '11:00:00', 'Pembahasan pelaksanaan kurikulum tahun ajaran baru'),
(2, 1, '2025-05-28', 'Evaluasi Semester', '13:00:00', '15:00:00', 'Evaluasi pembelajaran semester genap tahun ajaran 2024/2025'),
(3, 7, '2025-06-08', 'Pelatihan Guru', '08:00:00', '16:00:00', 'Pelatihan penerapan teknologi dalam pembelajaran modern'),
(4, 7, '2025-06-11', 'Persiapan Tahun Ajaran Baru', '09:00:00', '12:00:00', 'Menyusun program dan persiapan awal tahun ajaran 2025/2026'),
(5, 11, '2025-07-19', 'Pelatihan Soft Skills', '08:00:00', '14:00:00', 'Pelatihan soft skills untuk siswa kelas XII'),
(6, 1, '2025-08-19', 'Revisi Kurikulum', '10:00:00', '12:00:00', 'Revisi kurikulum berbasis kompetensi keahlian'),
(7, 1, '2025-08-19', 'Pembukaan Tahun Ajaran', '07:00:00', '10:00:00', 'Kegiatan pembelajaran dimulai'),
(8, 1, '2025-11-27', 'Mempersiapkan Ruangan Rapat Persiapan Akhir Tahun', '08:00:00', '13:00:00', 'Menata Ruangan Rapat');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int NOT NULL,
  `nama_guru` varchar(20) NOT NULL,
  `nip` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nama_guru`, `nip`, `kelamin`, `alamat`, `telp`, `username`, `password`, `gelar`, `tempat`, `tgl`, `agama`, `email`, `photo`) VALUES
(1, 'Muhammad Abduh', '197409301999', 'Laki-laki', '        Ladang Laweh', '082214609889', 'guru', 'guru', 'M.Ag', 'Padang', '2018-05-28', 'Islam', 'bitras90@gmail.com', 'admin.jpg'),
(7, 'Riza Yoga Dermawan', '198903192011011003', 'Pria', 'Ds. Garung Lor RT 03 RW 02, Kaliwungu, Kudus', '081227384512', 'riza', 'riza', 'S.Pd.', 'Kudus', '1989-03-19', 'Islam', 'riza.yoga@smpn1kaliwungu.sch.id', 'foto/riza.jpg'),
(8, 'Asri Hidayat', '002897867', 'Laki-laki', 'Tabek Gadang', '7695', 'a', 'a', 'S.Pd', 'Kuansing', '2018-05-26', 'Islam', 'gdg@gmail.cpm', '10304432100006.png'),
(9, 'Revi Sumardi', '000584635654', 'Laki-laki', 'Palambayan', '098089977', 'r', 'r', 'S.Pd', 'Padang', '2018-05-04', 'Kristen', 'revi@gmail.com', 'guruc.png'),
(10, 'Anisa Fitri Yuniasih', '199601132020122004', 'Wanita', 'Ds. Temulus RT 05 RW 03, Mejobo, Kudus', '081329485671', 'anisa', 'anisa', 'S.Pd.', 'Kudus', '1996-01-13', 'Islam', 'anisa.fitri@smpn1kaliwungu.sch.id', 'foto/anisa.jpg'),
(11, 'Mohammad Miftahuddin', '199303292019031010', 'Pria', 'Ds. Papringan RT 02 RW 05, Kaliwungu', '081227485632', 'mohammad', 'mohammad', 'S.Pd.I.', 'Pati', '1993-03-29', 'Islam', 'miftahuddin@smpn1kaliwungu.sch.id', 'foto/miftah.jpg'),
(12, 'Ana Zahrotun', '197108182003122003', 'Wanita', 'Jl. Kauman No. 27, Kudus Kota', '081226789012', 'ana', 'ana', 'S.Pd.', 'Kudus', '1971-08-18', 'Islam', 'ana.zahrotun@smpn1kaliwungu.sch.id', 'foto/ana.jpg'),
(13, 'Dian Ismawati', '198104062006042016', 'Wanita', 'Perum Bumi Kudus Indah Blok D-8', '085729384756', 'dian', 'dian', 'S.Pd., M.Pd.', 'Jepara', '1981-04-06', 'Islam', 'dian.ismawati@smpn1kaliwungu.sch.id', 'foto/dian.jpg'),
(14, 'Erlita Arisanti', '197309252005012011', 'Wanita', 'Ds. Blendungan RT 04 RW 01, Kaliwungu', '081329102938', 'erlita', 'erlita', 'S.Pd.', 'Kudus', '1973-09-25', 'Islam', 'erlita.arisanti@smpn1kaliwungu.sch.id', 'foto/erlita.jpg'),
(17, 'Arnita Cahya Saputri', '199306262024212034', 'Wanita', 'Ds. Garung Kidul RT 02 RW 07, Kaliwungu', '081227384920', 'arnita', 'arnita', 'M.Pd.', 'Kudus', '1993-06-26', 'Islam', 'arnita.cahya@smpn1kaliwungu.sch.id', 'foto/arnita.jpg'),
(18, 'Wiji Lestari', '198812242011012009', 'Wanita', 'Ds. Ploso RT 01 RW 05, Jati, Kudus', '081329485674', 'wiji', 'wiji', 'S.Pd.', 'Kudus', '1988-12-24', 'Islam', 'wiji.lestari@smpn1kaliwungu.sch.id', 'foto/wiji.jpg'),
(19, 'Sariningsih', '196511211987022002', 'Wanita', 'Ds. Ngembal Kulon RT 03 RW 02, Jati', '081227384521', 'sariningsih', 'sariningsih', 'S.Pd.', 'Kudus', '1965-11-21', 'Islam', 'sariningsih@smpn1kaliwungu.sch.id', 'foto/sariningsih.jpg'),
(20, 'Nanik Whatini', '197308132006042014', 'Wanita', 'Ds. Golantepus RT 04 RW 03, Mejobo', '081329102937', 'nanik', 'nanik', 'S.Pd.', 'Kudus', '1973-08-13', 'Islam', 'nanik.whatini@smpn1kaliwungu.sch.id', 'foto/nanik.jpg'),
(21, 'Meilinda Ika Wijayan', '198605202022212023', 'Wanita', 'Ds. Kandangmas RT 02 RW 04, Dawe', '081227384522', 'meilinda', 'meilinda', 'S.Kom.', 'Kudus', '1986-05-20', 'Islam', 'meilinda.ika@smpn1kaliwungu.sch.id', 'foto/meilinda.jpg'),
(22, 'Suryadi', '196904072007011020', 'Pria', 'Ds. Papringan RT 05 RW 01, Kaliwungu', '081227485633', 'suryadi', 'suryadi', 'S.Ag., M.Pd.', 'Kudus', '1969-04-07', 'Islam', 'suryadi@smpn1kaliwungu.sch.id', 'foto/suryadi.jpg'),
(23, 'Laila Umairoh', '197909202008012011', 'Wanita', 'Ds. Temulus RT 01 RW 06, Mejobo', '081329485675', 'laila', 'laila', 'S.Pd.', 'Kudus', '1979-09-20', 'Islam', 'laila.umairoh@smpn1kaliwungu.sch.id', 'foto/laila.jpg'),
(24, 'Faila Apriliana', '202202002', 'Wanita', 'Ds. Garung Lor RT 05 RW 04, Kaliwungu', '081227384523', 'faila', 'faila', 'S.Pd.', 'Kudus', '1995-04-12', 'Islam', 'faila.apriliana@smpn1kaliwungu.sch.id', 'foto/faila.jpg'),
(25, 'Noor Melasary', '202203003', 'Wanita', 'Ds. Ploso RT 04 RW 02, Jati', '081329102939', 'noor', 'noor', 'S.Pd., M.Pd.', 'Kudus', '1994-07-20', 'Islam', 'noor.melasary@smpn1kaliwungu.sch.id', 'foto/noor.jpg'),
(26, 'Heni Sofiya', '197303062008012010', 'Wanita', 'Ds. Ngembal Kulon RT 02 RW 05, Jati', '081227384524', 'heni', 'heni', 'S.Pd.', 'Kudus', '1973-03-06', 'Islam', 'heni.sofiya@smpn1kaliwungu.sch.id', 'foto/heni.jpg'),
(27, 'Dwi Kartikasari', '202204004', 'Wanita', 'Ds. Golantepus RT 01 RW 07, Mejobo', '081329485676', 'dwi', 'dwi', 'S.Pd.', 'Kudus', '1996-11-03', 'Islam', 'dwi.kartikasari@smpn1kaliwungu.sch.id', 'foto/dwi.jpg'),
(28, 'Jihananda Cahya Baga', '201001001', 'Pria', 'Ds. Papringan RT 03 RW 06, Kaliwungu', '081227485634', 'jihananda', 'jihananda', 'S.Pd.', 'Kudus', '1998-08-15', 'Islam', 'jihananda@smpn1kaliwungu.sch.id', 'foto/jihananda.jpg'),
(29, 'Putra Wahyu Kristian', '199203212024211014', 'Pria', 'Ds. Blendungan RT 06 RW 02, Kaliwungu', '081227384525', 'putra', 'putra', 'S.Pd.', 'Kudus', '1992-03-21', 'Islam', 'putra.wahyu@smpn1kaliwungu.sch.id', 'foto/putra.jpg'),
(30, 'Fitriana Nur Cahyani', '197808242006042008', 'Wanita', 'Ds. Temulus RT 03 RW 04, Mejobo', '081329485677', 'fitriana', 'fitriana', 'S.Kom.', 'Kudus', '1978-08-24', 'Islam', 'fitriana.nur@smpn1kaliwungu.sch.id', 'foto/fitriana.jpg'),
(31, 'Maharjono Triswandon', '197806162011011016', 'Pria', 'Ds. Garung Kidul RT 01 RW 03, Kaliwungu', '081227485635', 'maharjono', 'maharjono', 'S.Kom.', 'Kudus', '1978-06-16', 'Islam', 'maharjono@smpn1kaliwungu.sch.id', 'foto/maharjono.jpg'),
(32, 'Tri Handayani Sulist', '202212012', 'Wanita', 'Ds. Ploso RT 05 RW 01, Jati', '081227384526', 'tri', 'tri', 'S.Pd.', 'Kudus', '1997-02-14', 'Islam', 'tri.handayani@smpn1kaliwungu.sch.id', 'foto/tri.jpg'),
(33, 'Mindayati', '197507252008012007', 'Wanita', 'Ds. Ngembal Kulon RT 04 RW 03, Jati', '081329102940', 'mindayati', 'mindayati', 'S.Pd.', 'Kudus', '1975-07-25', 'Islam', 'mindayati@smpn1kaliwungu.sch.id', 'foto/mindayati.jpg'),
(34, 'Nur Hayati', '197602122008012009', 'Wanita', 'Ds. Golantepus RT 03 RW 05, Mejobo', '081227384527', 'nur', 'nur', 'S.Pd.', 'Kudus', '1976-02-12', 'Islam', 'nur.hayati@smpn1kaliwungu.sch.id', 'foto/nurhayati.jpg'),
(35, 'Puspitaningrum', '197010052005012013', 'Wanita', 'Ds. Kandangmas RT 05 RW 02, Dawe', '081329485678', 'puspitaningrum', 'puspitaningrum', 'S.Pd.', 'Kudus', '1970-10-05', 'Islam', 'puspitaningrum@smpn1kaliwungu.sch.id', 'foto/puspi.jpg'),
(36, 'Suharlina', '197507272007012014', 'Wanita', 'Ds. Papringan RT 04 RW 07, Kaliwungu', '081227384528', 'suharlina', 'suharlina', 'S.Pd.', 'Kudus', '1975-07-27', 'Islam', 'suharlina@smpn1kaliwungu.sch.id', 'foto/suharlina.jpg'),
(37, 'Suyanto', '2022002002002', 'Pria', 'Ds. Garung Lor RT 06 RW 01, Kaliwungu', '081227485636', 'suyanto', 'suyanto', 'S.Ag., M.Pd.', 'Kudus', '1970-12-12', 'Islam', 'suyanto@smpn1kaliwungu.sch.id', 'foto/suyanto.jpg'),
(38, 'Zarkoni', '2023000999887', 'Pria', 'Ds. Temulus RT 07 RW 02, Mejobo', '081329102941', 'zarkoni', 'zarkoni', 'S.Pd.I.', 'Kudus', '1985-03-10', 'Islam', 'zarkoni@smpn1kaliwungu.sch.id', 'foto/zarkoni.jpg'),
(39, 'Supartiningsih', '196509031995122001', 'Wanita', 'Ds. Blendungan RT 01 RW 04, Kaliwungu', '081227384529', 'supartiningsih', 'supartiningsih', 'Dra.', 'Kudus', '1965-09-03', 'Islam', 'supartiningsih@smpn1kaliwungu.sch.id', 'foto/supartini.jpg'),
(40, 'Arofah Syamsiar', '197201252007012008', 'Wanita', 'Ds. Ploso RT 02 RW 06, Jati', '081329485679', 'arofah', 'arofah', 'S.Pd.', 'Kudus', '1972-01-25', 'Islam', 'arofah.syamsiar@smpn1kaliwungu.sch.id', 'foto/arofah.jpg'),
(41, 'Anita Widiastuti', '197105192007012005', 'Wanita', 'Ds. Ngembal Kulon RT 05 RW 04, Jati', '081227384530', 'anita', 'anita', 'S.Pd.', 'Kudus', '1971-05-19', 'Islam', 'anita.widiastuti@smpn1kaliwungu.sch.id', 'foto/anita.jpg'),
(42, 'Sri Winarsih', '196906292006042004', 'Wanita', 'Ds. Golantepus RT 06 RW 01, Mejobo', '081329102942', 'sri', 'sri', 'S.Pd.', 'Kudus', '1969-06-29', 'Islam', 'sri.winarsih@smpn1kaliwungu.sch.id', 'foto/sriwinarsih.jpg'),
(43, 'Agung Supriyanto', '196709011994121006', 'Pria', 'Ds. Kandangmas RT 03 RW 05, Dawe', '081227485637', 'agung', 'agung', 'S.Pd.', 'Kudus', '1967-09-01', 'Islam', 'agung.supriyanto@smpn1kaliwungu.sch.id', 'foto/agung.jpg'),
(44, 'Umi Maesaroh', '196711011990032005', 'Wanita', 'Ds. Garung Kidul RT 04 RW 05, Kaliwungu', '081227384531', 'umi', 'umi', 'S.Pd.', 'Kudus', '1967-11-01', 'Islam', 'umi.maesaroh@smpn1kaliwungu.sch.id', 'foto/umi.jpg'),
(45, 'Heni Hartanti', '196410021998022002', 'Wanita', 'Ds. Papringan RT 01 RW 08, Kaliwungu', '081329485680', 'heni', 'heni', 'Dra.', 'Kudus', '1964-10-02', 'Islam', 'heni.hartanti@smpn1kaliwungu.sch.id', 'foto/henihartanti.jpg'),
(46, 'Atik Rahmawati', '197902122008012016', 'Wanita', 'Ds. Temulus RT 04 RW 05, Mejobo', '081227384532', 'atik', 'atik', 'S.Pt.', 'Kudus', '1979-02-12', 'Islam', 'atik.rahmawati@smpn1kaliwungu.sch.id', 'foto/atik.jpg'),
(47, 'Zamrotul Khoiriyah', '197612242008012005', 'Wanita', 'Ds. Ploso RT 06 RW 03, Jati', '081329102943', 'zamrotul', 'zamrotul', 'S.Pd.', 'Kudus', '1976-12-24', 'Islam', 'zamrotul.khoiriyah@smpn1kaliwungu.sch.id', 'foto/zamrotul.jpg'),
(48, 'Aditya Purbantara', '198908072014021002', 'Pria', 'Ds. Blendungan RT 02 RW 07, Kaliwungu', '081227485638', 'aditya', 'aditya', 'S.Pd.', 'Kudus', '1989-08-07', 'Islam', 'aditya.purbantara@smpn1kaliwungu.sch.id', 'foto/aditya.jpg'),
(49, 'Mujiati', '1988082172024212014', 'Wanita', 'Ds. Ngembal Kulon RT 07 RW 01, Jati', '081227384533', 'mujiati', 'mujiati', 'S.Pd.', 'Kudus', '1988-08-21', 'Islam', 'mujiati@smpn1kaliwungu.sch.id', 'foto/mujiati.jpg'),
(50, 'Yani Fuadiyah', '198610102024212029', 'Wanita', 'Ds. Golantepus RT 05 RW 06, Mejobo', '081329485681', 'yani', 'yani', 'S.Pd.', 'Kudus', '1986-10-10', 'Islam', 'yani.fuadiyah@smpn1kaliwungu.sch.id', 'foto/yani.jpg'),
(51, 'Muryana Ovika Extyan', '199910282024212018', 'Wanita', 'Ds. Ploso RT 03 RW 04, Jati', '081227384534', 'muryana', 'muryana', 'S.Pd.', 'Kudus', '1999-10-28', 'Islam', 'muryana.ovika@smpn1kaliwungu.sch.id', 'foto/muryana.jpg'),
(52, 'Durrotun Nayyiroh', '199009132024212015', 'Wanita', 'Ds. Kandangmas RT 01 RW 03, Dawe', '081329102944', 'durrotun', 'durrotun', 'S.Kom.I.', 'Kudus', '1990-09-13', 'Islam', 'durrotun.nayyiroh@smpn1kaliwungu.sch.id', 'foto/durrotun.jpg'),
(53, 'Muflihul Fatih Kusum', '-', 'Pria', 'Ds. Garung Lor RT 07 RW 03, Kaliwungu', '081227485639', 'muflihul', 'muflihul', 'S.Pd.', 'Kudus', '1994-05-15', 'Islam', 'muflihul.fatih@smpn1kaliwungu.sch.id', 'foto/muflihul.jpg'),
(54, 'Annisa Ayu Rahmasari', '-', 'Wanita', 'Ds. Temulus RT 06 RW 01, Mejobo', '081329485682', 'annisa', 'annisa', 'S.Pd.', 'Kudus', '1997-03-22', 'Islam', 'annisa.ayu@smpn1kaliwungu.sch.id', 'foto/annisa_ayu.jpg'),
(55, 'Dina Fajar Yunitasar', '19920519202221010', 'Wanita', 'Ds. Garung Kidul RT 03 RW 06, Kaliwungu', '081227384535', 'dina', 'dina', 'S.Pd.', 'Kudus', '1992-05-19', 'Islam', 'dina.fajar@smpn1kaliwungu.sch.id', 'foto/dina.jpg'),
(56, 'Yulianto Nugroho', '0000000000', 'Laki-laki', '-', '-', 'yulianto', 'yulianto', 'SE', '-', '2000-01-01', 'Islam', '-', 'foto/dummy.jpg'),
(57, 'Muhammad Khoirul Uma', '0000000000', 'Laki-laki', '-', '-', 'umam', 'umam', 'SM', '-', '2000-01-01', 'Islam', '-', 'foto/dummy.jpg'),
(58, 'Inada Rizky', '-', 'Wanita', '-', '-', 'inada', 'inada', '-', '-', '2000-01-01', 'Islam', '-', 'foto/dummy.jpg'),
(59, 'Hening Larasati', '-', 'Wanita', '-', '-', 'hening', 'hening', 'S.Kom', '-', '2000-01-01', 'Islam', '-', 'foto/dummy.jpg'),
(60, 'Niniek Ismihartini', '-', 'Wanita', '-', '-', 'niniek', 'niniek', '-', '-', '2000-01-01', 'Islam', '-', 'foto/dummy.jpg'),
(61, 'Niniek Ismihartini', '-', 'Wanita', '-', '-', 'niniek', 'niniek', '-', '-', '2000-01-01', 'Islam', '-', 'foto/dummy.jpg'),
(1001, 'Abdul Yamin', '001970769769', 'Laki-laki', 'Desa Sibak, Ipuh Muko-muko', '082214607669', 'yamin', 'yamin', 'S.Pd', 'Sibak', '2018-05-17', 'Islam', 'ocikyamin93@gmail.com', 'userk.png'),
(1002, 'Kaur Kesiswaan', '202201', '-', 'Jl. Raya Kudus-Jepara KM 8, Kaliwungu', '0291-435123', 'kaur', 'kaur', '', '-', '0000-00-00', 'Islam', 'kesiswaan@smpn1kaliwungu.sch.id', 'foto/kaur.jpg'),
(1003, 'Guru Coba', '20431', 'Pria', 'Perum Griya Mukti Blok B-12, Kudus', '085878901234', 'guru', 'guru', '', 'Kudus', '1990-01-01', 'Islam', 'guru.coba@smpn1kaliwungu.sch.id', 'foto/dummy.jpg'),
(1004, 'Randu Franstio', '900808098079', 'Laki-laki', 'Tabek Gadang', '089797', 'rdn', 'rdn', 'S.Pd', 'Sijunjung', '2018-05-01', 'Kristen', 'randu@gmail.com', '10304432100006.png'),
(1005, 'Andro Sudirno', '08808080', 'Laki-laki', 'dff', '6666', 'tes', 'tes', 'spd', 'sss', '2018-07-19', 'Islam', 'ee@gmail.com', 'userk.png'),
(1006, 'Drs. H.W. Muryotomo', '-', 'Laki-laki', '-', '-', 'muryotomo', 'muryotomo', 'Drs.', '-', '2000-01-01', 'Islam', '-', 'foto/dummy.jpg'),
(1007, 'Diah Ayu Swasti Dita', '-', 'Wanita', '-', '-', 'diahayu', 'diahayu', 'S.Pd', '-', '2000-01-01', 'Islam', '-', 'foto/dummy.jpg'),
(1008, 'Mersiska Cahyaningty', '-', 'Wanita', '-', '-', 'mersiska', 'mersiska', '-', '-', '2000-01-01', 'Islam', '-', 'foto/dummy.jpg'),
(1010, 'Sri Purwaningsih', '', 'Wanita', '-', '-', 'sri.p', 'sri.p', 'S.Pd', '-', '2000-01-01', 'Islam', '-', 'foto/dummy.jpg'),
(1011, 'Nadia Rahmalita', '', 'Wanita', '-', '-', 'nadia.r', 'nadia.r', 'S.Pd', '-', '2000-01-01', 'Islam', '-', 'foto/dummy.jpg');

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
(2, 5, '2025-11-17', 'Sakit', 'sakit demam', 'Disetujui', 1),
(3, 5, '2025-11-20', 'Izin', 'Izin Saudara nya menikah', 'Disetujui', 1),
(4, 4, '2025-11-23', 'Sakit', 'Sakit Demam', 'Disetujui', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_piket`
--

CREATE TABLE `tb_jadwal_piket` (
  `id_jadwal` int NOT NULL,
  `id_tajaran` int NOT NULL,
  `tanggal_piket` date NOT NULL,
  `hari_piket` varchar(20) NOT NULL,
  `id_guru` int NOT NULL,
  `keterangan` text NOT NULL,
  `id_guru_pengganti` int DEFAULT NULL,
  `status_pengganti` varchar(20) DEFAULT 'Tidak',
  `catatan_penggantian` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal_piket`
--

INSERT INTO `tb_jadwal_piket` (`id_jadwal`, `id_tajaran`, `tanggal_piket`, `hari_piket`, `id_guru`, `keterangan`, `id_guru_pengganti`, `status_pengganti`, `catatan_penggantian`) VALUES
(1, 3, '2025-11-27', 'Kamis', 1, 'Jaga Perpustakaan', 7, 'Ya', ''),
(2, 3, '2025-11-27', 'Kamis', 7, 'Jaga Lab Bahasa', NULL, 'Tidak', NULL),
(3, 3, '2025-11-27', 'Kamis', 1, 'Menyusun Buku di Tempatnya', NULL, 'Tidak', NULL),
(4, 3, '2025-11-27', 'Kamis', 7, 'Jaga Lab IPA', NULL, 'Tidak', NULL);

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
(1, 2, 1, '2025-11-17', 'Hadir', NULL, ''),
(2, 2, 1, '2025-11-20', 'Hadir', NULL, '');

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
(1, 'VII A'),
(2, 'VII B'),
(3, 'VII C'),
(4, 'VIII A'),
(5, 'VIII B'),
(6, 'VIII C'),
(7, 'IX A'),
(8, 'IX B'),
(9, 'IX C');

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
(1, 'Abdul Rochim, S.Pd., M.Pd', 'kepsek', 'kepsek', 'userk.png');

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

--
-- Dumping data for table `tb_keterlambatan`
--

INSERT INTO `tb_keterlambatan` (`id_keterlambatan`, `id_siswa`, `tanggal`, `waktu_terlambat`, `keterangan`, `id_guru_piket`) VALUES
(1, 1, '2025-11-20', 17, '', 1);

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
(1, 1, 5, 'Instalasi SO Berbasis GUI', '-', 'VIII'),
(2, 1, 1, 'Instalasi SO Berbasis Text', '-', 'VII'),
(3, 1, 2, 'KKPI', '-', 'VII'),
(4, 7, 7, 'Instalasi SO Berbasis Text', '-', 'IX'),
(5, 7, 8, 'Bahasa Indonesia', '-', 'IX'),
(6, 7, 8, 'Bahasa Indonesia', '-', 'IX'),
(18, 7, 1, 'Instalasi SO Berbasis GUI', 'TKJ', '1'),
(19, 1, 2, 'Instalasi SO Berbasis GUI', '-', 'VII'),
(20, 1, 3, 'Instalasi SO Berbasis Text', '-', 'VII'),
(22, 1, 4, 'Bahasa Inggris', '-', 'VII'),
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
(33, 1, 1, 'Bahasa Indonesia', '-', 'VII'),
(34, 1, 1, 'MIJLAN', '-', 'VII');

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
-- Table structure for table `tb_piket_mingguan`
--

CREATE TABLE `tb_piket_mingguan` (
  `id_mingguan` int NOT NULL,
  `hari` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_piket_mingguan`
--

INSERT INTO `tb_piket_mingguan` (`id_mingguan`, `hari`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabu'),
(4, 'Kamis'),
(5, 'Jumat'),
(6, 'Sabtu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_piket_mingguan_guru`
--

CREATE TABLE `tb_piket_mingguan_guru` (
  `id_mg` int NOT NULL,
  `id_mingguan` int NOT NULL,
  `id_guru` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_piket_mingguan_guru`
--

INSERT INTO `tb_piket_mingguan_guru` (`id_mg`, `id_mingguan`, `id_guru`) VALUES
(10, 1, 8),
(11, 1, 26),
(12, 1, 17),
(13, 1, 19),
(14, 1, 12),
(15, 1, 35),
(16, 1, 25),
(17, 1, 51),
(18, 1, 49),
(19, 2, 44),
(20, 2, 41),
(21, 2, 13),
(22, 2, 1006),
(23, 2, 55),
(24, 2, 1007),
(25, 2, 52),
(26, 2, 50),
(27, 2, 1008),
(28, 3, 43),
(29, 3, 1010),
(30, 3, 14),
(31, 3, 33),
(32, 3, 23),
(33, 3, 7),
(34, 3, 54),
(35, 3, 1011),
(36, 4, 26),
(37, 4, 20),
(38, 4, 42),
(39, 4, 18),
(40, 4, 17),
(41, 4, 32),
(42, 4, 53),
(43, 4, 56),
(44, 4, 57),
(45, 5, 22),
(46, 5, 38),
(47, 5, 11),
(48, 5, 30),
(49, 5, 21),
(50, 5, 58),
(51, 5, 59),
(52, 6, 40),
(53, 6, 47),
(54, 6, 46),
(55, 6, 35),
(56, 6, 48),
(57, 6, 29),
(58, 6, 28),
(59, 6, 61),
(60, 6, 40),
(61, 6, 47),
(62, 6, 46),
(63, 6, 35),
(64, 6, 48),
(65, 6, 29),
(66, 6, 28),
(67, 6, 61);

-- --------------------------------------------------------

--
-- Table structure for table `tb_piket_mingguan_tugas`
--

CREATE TABLE `tb_piket_mingguan_tugas` (
  `id_tugas` int NOT NULL,
  `id_mingguan` int NOT NULL,
  `tugas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_piket_mingguan_tugas`
--

INSERT INTO `tb_piket_mingguan_tugas` (`id_tugas`, `id_mingguan`, `tugas`) VALUES
(1, 1, 'Mengatur pelaksanaan upacara bendera'),
(2, 1, 'Mengontrol PBM'),
(3, 1, 'Mencatat siswa yang datang terlambat'),
(4, 1, 'Memberi izin kepada siswa yang sakit atau perlu meninggalkan pelajaran'),
(5, 1, 'Mengontrol pelaksanaan 7K'),
(6, 1, 'Mengatur kegiatan pembiasaan/Sholat berjamaah'),
(7, 1, 'Mengatur pelaksanaan upacara bendera'),
(8, 1, 'Mengontrol PBM'),
(9, 1, 'Mencatat siswa yang datang terlambat'),
(10, 1, 'Memberi izin kepada siswa yang sakit atau perlu meninggalkan pelajaran'),
(11, 1, 'Mengontrol pelaksanaan 7K'),
(12, 1, 'Mengatur kegiatan pembiasaan/Sholat berjamaah'),
(13, 2, 'Mengontrol PBM'),
(14, 2, 'Mencatat siswa yang datang terlambat'),
(15, 2, 'Memberi izin kepada siswa yang sakit atau perlu meninggalkan pelajaran'),
(16, 2, 'Mengontrol pelaksanaan 7K'),
(17, 2, 'Mengatur kegiatan pembiasaan/Sholat berjamaah'),
(18, 3, 'Mengontrol PBM'),
(19, 3, 'Mencatat siswa yang datang terlambat'),
(20, 3, 'Memberi izin kepada siswa yang sakit atau perlu meninggalkan pelajaran'),
(21, 3, 'Mengontrol pelaksanaan 7K'),
(22, 3, 'Mengatur kegiatan pembiasaan/Sholat berjamaah'),
(23, 4, 'Mengontrol PBM'),
(24, 4, 'Mencatat siswa yang datang terlambat'),
(25, 4, 'Memberi izin kepada siswa yang sakit atau perlu meninggalkan pelajaran'),
(26, 4, 'Mengontrol pelaksanaan 7K'),
(27, 4, 'Mengatur kegiatan pembiasaan/Sholat berjamaah'),
(28, 2, 'Mengontrol PBM'),
(29, 2, 'Mencatat siswa yang datang terlambat'),
(30, 2, 'Memberi izin kepada siswa yang sakit atau perlu meninggalkan pelajaran'),
(31, 2, 'Mengontrol pelaksanaan 7K'),
(32, 2, 'Mengatur kegiatan pembiasaan/Sholat berjamaah'),
(33, 3, 'Mengontrol PBM'),
(34, 3, 'Mencatat siswa yang datang terlambat'),
(35, 3, 'Memberi izin kepada siswa yang sakit atau perlu meninggalkan pelajaran'),
(36, 3, 'Mengontrol pelaksanaan 7K'),
(37, 3, 'Mengatur kegiatan pembiasaan/Sholat berjamaah'),
(38, 4, 'Mengontrol PBM'),
(39, 4, 'Mencatat siswa yang datang terlambat'),
(40, 4, 'Memberi izin kepada siswa yang sakit atau perlu meninggalkan pelajaran'),
(41, 4, 'Mengontrol pelaksanaan 7K'),
(42, 4, 'Mengatur kegiatan pembiasaan/Sholat berjamaah'),
(43, 5, 'Mengatur kegiatan Jumat Bersih / Aksi Gizi'),
(44, 5, 'Mengontrol PBM'),
(45, 5, 'Mencatat siswa yang datang terlambat'),
(46, 5, 'Memberi izin kepada siswa yang sakit atau perlu meninggalkan pelajaran'),
(47, 5, 'Mengontrol pelaksanaan 7K'),
(48, 5, 'Mengatur kegiatan Jumat Bersih / Aksi Gizi'),
(49, 5, 'Mengontrol PBM'),
(50, 5, 'Mencatat siswa yang datang terlambat'),
(51, 5, 'Memberi izin kepada siswa yang sakit atau perlu meninggalkan pelajaran'),
(52, 5, 'Mengontrol pelaksanaan 7K'),
(53, 6, 'Mengatur kegiatan Literasi'),
(54, 6, 'Mengontrol PBM'),
(55, 6, 'Mencatat siswa yang datang terlambat'),
(56, 6, 'Memberi izin kepada siswa yang sakit atau perlu meninggalkan pelajaran'),
(57, 6, 'Mengontrol pelaksanaan 7K'),
(58, 6, 'Mengatur kegiatan pembiasaan/Sholat berjamaah');

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
-- Indexes for table `tb_agenda`
--
ALTER TABLE `tb_agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indexes for table `tb_agenda_lain`
--
ALTER TABLE `tb_agenda_lain`
  ADD PRIMARY KEY (`id_lain`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `tb_izin_siswa`
--
ALTER TABLE `tb_izin_siswa`
  ADD PRIMARY KEY (`id_izin`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_guru_piket` (`id_guru_piket`);

--
-- Indexes for table `tb_jadwal_piket`
--
ALTER TABLE `tb_jadwal_piket`
  ADD PRIMARY KEY (`id_jadwal`);

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
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `tb_piket_mingguan`
--
ALTER TABLE `tb_piket_mingguan`
  ADD PRIMARY KEY (`id_mingguan`);

--
-- Indexes for table `tb_piket_mingguan_guru`
--
ALTER TABLE `tb_piket_mingguan_guru`
  ADD PRIMARY KEY (`id_mg`),
  ADD KEY `id_mingguan` (`id_mingguan`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `tb_piket_mingguan_tugas`
--
ALTER TABLE `tb_piket_mingguan_tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `id_mingguan` (`id_mingguan`);

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
-- AUTO_INCREMENT for table `tb_agenda`
--
ALTER TABLE `tb_agenda`
  MODIFY `id_agenda` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tb_agenda_lain`
--
ALTER TABLE `tb_agenda_lain`
  MODIFY `id_lain` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_izin_siswa`
--
ALTER TABLE `tb_izin_siswa`
  MODIFY `id_izin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_jadwal_piket`
--
ALTER TABLE `tb_jadwal_piket`
  MODIFY `id_jadwal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kehadiran_guru`
--
ALTER TABLE `tb_kehadiran_guru`
  MODIFY `id_kehadiran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `idkelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_keterlambatan`
--
ALTER TABLE `tb_keterlambatan`
  MODIFY `id_keterlambatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  MODIFY `id_mapel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_piket_mingguan`
--
ALTER TABLE `tb_piket_mingguan`
  MODIFY `id_mingguan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_piket_mingguan_guru`
--
ALTER TABLE `tb_piket_mingguan_guru`
  MODIFY `id_mg` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tb_piket_mingguan_tugas`
--
ALTER TABLE `tb_piket_mingguan_tugas`
  MODIFY `id_tugas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_piket_mingguan_guru`
--
ALTER TABLE `tb_piket_mingguan_guru`
  ADD CONSTRAINT `tb_piket_mingguan_guru_ibfk_1` FOREIGN KEY (`id_mingguan`) REFERENCES `tb_piket_mingguan` (`id_mingguan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_piket_mingguan_guru_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `tb_guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_piket_mingguan_tugas`
--
ALTER TABLE `tb_piket_mingguan_tugas`
  ADD CONSTRAINT `tb_piket_mingguan_tugas_ibfk_1` FOREIGN KEY (`id_mingguan`) REFERENCES `tb_piket_mingguan` (`id_mingguan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`idkelas`) REFERENCES `tb_kelas` (`idkelas`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
