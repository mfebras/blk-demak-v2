-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2017 at 11:56 
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blk_demak`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(128) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `password`, `date_created`, `token`) VALUES
(1, 'admin', 'm.febras@yahoo.com', '02c425157ecd32f259548b33402ff6d3', '2017-03-02 00:27:10', '');

-- --------------------------------------------------------

--
-- Table structure for table `data_kerja`
--

CREATE TABLE `data_kerja` (
  `id_data_kerja` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `status_kerja` varchar(5) NOT NULL,
  `jenis_pekerjaan` varchar(9) DEFAULT NULL,
  `nama_perusahaan` varchar(128) DEFAULT NULL,
  `alamat_perusahaan` varchar(128) DEFAULT NULL,
  `telepon_perusahaan` varchar(16) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kerja`
--

INSERT INTO `data_kerja` (`id_data_kerja`, `id_peserta`, `status_kerja`, `jenis_pekerjaan`, `nama_perusahaan`, `alamat_perusahaan`, `telepon_perusahaan`, `date_created`) VALUES
(5, 6, 'Sudah', 'Wirausaha', 'Digit Creative Studio', 'Jl. Bulusan X No. 107, Semarang', '0857', '2017-03-10 23:40:32'),
(6, 7, 'Sudah', 'Karyawan', 'Digit Creative Studio', 'Jl. Bulusan X No. 107, Semarang', '085', '2017-03-11 01:38:43'),
(7, 8, 'Belum', '', '', '', '', '2017-03-11 01:44:47'),
(8, 9, 'Sudah', 'Wirausaha', 'Mochi Lab', 'Jl. Pattimura No. 5, Semarang', '089', '2017-03-11 01:47:18');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `angkatan` varchar(8) NOT NULL,
  `id_kejuruan` int(11) NOT NULL,
  `sumber_dana` varchar(8) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `status_pelaksanaan` varchar(8) NOT NULL DEFAULT 'belum',
  `seleksi_awal` date NOT NULL,
  `seleksi_akhir` date NOT NULL,
  `pelatihan_awal` date NOT NULL,
  `pelatihan_akhir` date NOT NULL,
  `status_hapus` int(11) NOT NULL DEFAULT '0' COMMENT '0 = belum dihapus, 1 = sudah dihapus',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `angkatan`, `id_kejuruan`, `sumber_dana`, `kapasitas`, `status_pelaksanaan`, `seleksi_awal`, `seleksi_akhir`, `pelatihan_awal`, `pelatihan_akhir`, `status_hapus`, `date_created`) VALUES
(1, 'I', 16, 'APBD', 20, 'sudah', '2017-02-28', '2017-02-28', '2017-03-02', '2017-03-31', 1, '2017-02-27 14:37:21'),
(2, 'I', 3, 'APBD', 30, 'belum', '2017-02-01', '2017-02-08', '2017-03-01', '2017-03-31', 0, '2017-02-28 03:44:19'),
(3, 'II', 16, 'APBD', 15, 'belum', '2017-02-15', '2017-02-22', '2017-03-31', '2017-04-30', 0, '2017-02-28 03:45:16'),
(4, 'I', 1, 'APBD', 20, 'sudah', '2017-03-01', '2017-03-10', '2017-03-16', '2017-04-12', 0, '2017-03-11 01:25:31');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_assign`
--

CREATE TABLE `jadwal_assign` (
  `id_jadwal` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama_karyawan` varchar(128) NOT NULL,
  `email` varchar(64) NOT NULL,
  `jabatan` varchar(16) NOT NULL,
  `password` varchar(64) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `email`, `jabatan`, `password`, `date_created`, `token`) VALUES
(1, 'Febra', 'm.febras@yahoo.com', 'staff', 'b59c67bf196a4758191e42f76670ceba', '2017-03-02 07:09:13', '2aeac4bb07a9c3df3efa23bf5fdc2cde');

-- --------------------------------------------------------

--
-- Table structure for table `kejuruan`
--

CREATE TABLE `kejuruan` (
  `id_kejuruan` int(11) NOT NULL,
  `nama_kejuruan` varchar(64) NOT NULL,
  `kode_kejuruan` varchar(8) NOT NULL,
  `status_hapus` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kejuruan`
--

INSERT INTO `kejuruan` (`id_kejuruan`, `nama_kejuruan`, `kode_kejuruan`, `status_hapus`, `date_created`) VALUES
(1, 'Operator Komputer & Laptop', 'OP', 0, '2017-02-27 01:01:56'),
(2, 'Teknisi HP', 'HP', 0, '2017-02-27 01:02:06'),
(3, 'Teknisi AC', 'AC', 0, '2017-02-27 01:02:27'),
(4, 'Mekanik Motor', 'MT', 0, '2017-02-27 01:02:41'),
(5, 'Las SMAW', 'LS', 0, '2017-02-27 01:03:43'),
(16, 'Mekanik Mobil', 'MM', 0, '2017-02-27 01:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `kejuruan_assign`
--

CREATE TABLE `kejuruan_assign` (
  `id_kejuruan` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `status` varchar(8) NOT NULL COMMENT '1 = belum dipanggil, 2 = sudah dipanggil, 3 = belum lulus tes wawancara, 4 = sudah lulus tes wawancara, 5 = belum lulus pelatihan, 6 = sudah lulus pelatihan',
  `selected` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(64) NOT NULL,
  `subyek` varchar(128) NOT NULL,
  `pesan` text NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'belum' COMMENT 'status apakah pesan sudah dibaca atau belum',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `nama`, `email`, `subyek`, `pesan`, `status`, `date_created`) VALUES
(1, 'Febra', 'febra@f.com', 'Tes', 'Hello world', 'sudah', '2017-03-10 16:12:08'),
(3, 'Febra', 'febra@f.com', 'Tes 2', 'Hi', '', '2017-03-10 16:12:08'),
(5, 'Febra', 'febra@f.com', 'Tes 3', 'Nom', '', '2017-03-10 16:12:08'),
(6, 'B', 'b@blk.com', 'Tes', 'Lop', '', '2017-03-10 16:12:08'),
(7, 'Ab', 'ab@ab.com', 'wqw', 'wwe', '', '2017-03-10 16:12:08'),
(8, 'QW', 'we', 'Op', 'Wds', '', '2017-03-10 16:12:08'),
(9, 'Edi', 'edi@e.com', 'Pesan', 'Lorem', '', '2017-03-10 16:12:08'),
(10, 'Oki', 'oki@e.com', 'O', 'O, Oki', '', '2017-03-10 16:12:08'),
(11, 'Abi', 'abi@blk.com', 'O', 'lorem', 'sudah', '2017-03-11 07:13:15'),
(12, 'Adelia', 'adelia@blk.com', 'adelia', 'Hello', 'sudah', '2017-03-13 04:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id` int(11) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `jenis_kelamin` varchar(9) DEFAULT NULL,
  `tempat_lahir` varchar(128) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(16) DEFAULT NULL,
  `alamat` varchar(256) DEFAULT NULL,
  `kecamatan` varchar(12) NOT NULL,
  `telepon` varchar(14) NOT NULL,
  `pendidikan_terakhir` varchar(16) NOT NULL,
  `sumber_info` varchar(16) DEFAULT NULL,
  `status_hapus` int(11) NOT NULL DEFAULT '0' COMMENT '0 = belum dihapus, 1 = sudah dihapus'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id`, `no_ktp`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `alamat`, `kecamatan`, `telepon`, `pendidikan_terakhir`, `sumber_info`, `status_hapus`) VALUES
(6, '111', 'Febra', 'Laki-laki', 'Pekalongan', '1994-02-05', 'Islam', 'Jl. Indragiri No.10 Pekalongan', '', '111', 'SMA Sederajat', 'Brosur', 0),
(7, '222', 'Abi', 'Laki-laki', 'Semarang', '1990-03-14', 'Islam', 'Jl. Todano No.13', '', '222', 'SMP Sederajat', 'Brosur', 0),
(8, '333', 'Adelia', 'Perempuan', 'Semarang', '1992-01-02', 'Islam', 'Jl. Mawar No.11', '', '333', 'SMA Sederajat', 'Media Sosial', 0),
(9, '4444', 'Dita', 'Perempuan', 'Semarang', '1994-05-11', 'Islam', 'Jl. Beringin No. 44, Semarang', '', '4444', 'SMA Sederajat', 'Media Sosial', 0),
(10, '8999', 'M Febra S', 'Laki-laki', 'Pekalongan', '1994-02-05', 'Islam', 'Jl. Aaa', 'Guntur', '0857', 'SMA Sederajat', 'Brosur', 0),
(13, '1311', 'Alfi', 'Perempuan', 'Serang', '1994-05-11', 'Islam', 'Jl. deq', 'Karangtengah', '211', 'SD Sederajat', 'Media Sosial', 0),
(14, '112', 'Edi', 'Laki-laki', 'Serang', '1992-01-27', 'Islam', 'swdq', 'Demak', '0857', 'SD Sederajat', 'Media Sosial', 0),
(15, '1333', 'Elf', 'Laki-laki', 'Semarang', '1970-01-28', 'Islam', 'Lkoj', 'Karanganyar', '222', 'Tidak Sekolah', 'Brosur', 0),
(16, '444', 'G', 'Laki-laki', 'Pekalongan', '1999-02-04', 'Islam', 'kop', 'Kebonagung', '211', 'SD Sederajat', 'Media Sosial', 0),
(17, '13112', 'Ab', 'Laki-laki', 'Semarang', '1994-02-27', 'Islam', 'dwe', 'Sayung', '0857', 'SMP Sederajat', 'Media Sosial', 0),
(18, '89991', 'Abi', 'Laki-laki', 'Pekalongan', '1992-06-26', 'Islam', 'wqq', 'Dempet', '222', 'SD Sederajat', 'Brosur', 0);

-- --------------------------------------------------------

--
-- Table structure for table `registrasi_pelatihan`
--

CREATE TABLE `registrasi_pelatihan` (
  `id_registrasi` int(11) NOT NULL,
  `no_registrasi` varchar(7) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_kejuruan` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL DEFAULT '0',
  `tanggal_registrasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrasi_pelatihan`
--

INSERT INTO `registrasi_pelatihan` (`id_registrasi`, `no_registrasi`, `id_peserta`, `id_kejuruan`, `id_jadwal`, `tanggal_registrasi`) VALUES
(1, 'OP17001', 6, 1, 1, '2017-03-10 23:39:58'),
(2, 'AC17001', 7, 3, 2, '2017-03-11 01:41:19'),
(3, 'OP17002', 8, 1, 1, '2017-03-11 01:43:53'),
(4, 'OP17003', 9, 1, 1, '2017-03-11 01:46:12'),
(5, 'MM17001', 6, 16, 0, '2017-03-19 13:05:28'),
(6, 'AC17002', 10, 3, 0, '2017-03-30 01:49:06'),
(7, 'OP17004', 12, 1, 0, '2017-03-30 04:32:09'),
(8, 'MM17002', 14, 16, 0, '2017-03-30 04:46:05'),
(9, 'AC17003', 16, 3, 0, '2017-03-30 06:24:42'),
(10, 'AC17004', 17, 3, 0, '2017-03-30 06:26:15'),
(11, 'AC17005', 18, 3, 0, '2017-03-30 06:27:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `data_kerja`
--
ALTER TABLE `data_kerja`
  ADD PRIMARY KEY (`id_data_kerja`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kejuruan`
--
ALTER TABLE `kejuruan`
  ADD PRIMARY KEY (`id_kejuruan`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_ktp` (`no_ktp`);

--
-- Indexes for table `registrasi_pelatihan`
--
ALTER TABLE `registrasi_pelatihan`
  ADD PRIMARY KEY (`id_registrasi`,`no_registrasi`),
  ADD UNIQUE KEY `id_registrasi` (`id_registrasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `data_kerja`
--
ALTER TABLE `data_kerja`
  MODIFY `id_data_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kejuruan`
--
ALTER TABLE `kejuruan`
  MODIFY `id_kejuruan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `registrasi_pelatihan`
--
ALTER TABLE `registrasi_pelatihan`
  MODIFY `id_registrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
