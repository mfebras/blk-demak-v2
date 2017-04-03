-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 03, 2017 at 10:55 
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
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `password`, `date_created`) VALUES
(1, 'Mohammad Fajar', 'fajarainul14@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2017-03-01 03:21:17'),
(2, 'febra', 'm.febras@yahoo.com', 'b59c67bf196a4758191e42f76670ceba', '2017-04-03 07:35:27');

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
(19, 'I', 4, 'APBD', 23, 'belum', '2017-04-04', '2017-04-11', '2017-04-26', '2017-05-12', 0, '2017-04-03 07:39:09'),
(20, 'I', 5, 'APBD', 20, 'belum', '2017-04-04', '2017-04-11', '2017-04-18', '2017-04-30', 0, '2017-04-03 08:47:01');

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
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `email`, `jabatan`, `password`, `date_created`) VALUES
(4, 'Mohammad Fajar Ainul Bashri', 'fajarainul@gmail.com', 'staff', '', '2017-02-26 11:38:10'),
(5, 'fajar ainul30', 'fajarainul14@gmail.com', 'staff', '25f9e794323b453885f5181f1b624d0b', '2017-03-01 04:43:53'),
(6, 'Gajah Merah', 'g@email.com', 'ketua', '45b3d7481e1a94b88ad72a97bd5e5850', '2017-03-02 14:56:27');

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
(1, 'Teknisi AC', 'TA', 0, '2017-02-25 10:59:23'),
(2, 'Menjahit Pakaian', 'MP', 0, '2017-02-25 11:09:45'),
(4, 'Otomotif', 'OT', 0, '2017-02-25 15:35:45'),
(5, 'Operator Komputer', 'OK', 0, '2017-03-01 10:47:29');

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
(1, 'Mohammad Fajar Ainul Bashri', 'fajar@email.com', 'INI ADALAH SUBJEK', 'Mereka adalah, Hadinoto Soedigno sebagai direktur teknik PT Garuda Indonesia 2007-2012 atau direktur produksi PT Citilink Indonesia 2012 sampai dengan sekarang. Kedua, Sunarto Kuntjoro sebagai mantan executive vice president (EVP) Engineering, Maintenance, and Information System PT Garuda Indonesia. Ketiga, Dodi Yasendri sebagai mantan senior manager maintenance budget PT Garuda Indonesia.\r\n\r\nDalam perkara ini, dia diduga menerima suap 1,2 juta euro dan 180.000 dolar Amerika Serikat atau senilai total Rp20 miliar serta dalam bentuk barang senilai 2 juta dolar Amerika Serikat yang tersebar di Singapura dan Indonesia dari perusahaan manufaktur terkemuka asal Inggris, Rolls Royce, dalam pembelian 50 mesin pesawat Airbus SAS pada periode 2005-2014 pada PT Garuda Indonesia Tbk.', 'belum', '2017-03-04 14:44:51'),
(2, 'FIRHAN ABADI', 'email@email.com', 'INI SUBJEK PESAN', 'Pemberian suap itu dilakukan melalui seorang perantara Soetikno Soedarjo selaku beneficial owner dari Connaught International Pte Ltd yang berlokasi di Singapura.\r\n\r\nSoektino diketahui merupakan presiden komisaris PT Mugi Rekso Abadi (MRA), satu kelompok perusahaan di bidang media dan gaya hidup.', 'sudah', '2017-03-04 15:26:44'),
(3, 'Febra', 'm.febras@yahoo.com', 'Tes', 'Sew', 'sudah', '2017-03-10 16:09:08'),
(4, 'Ilham', 'm.febras@yahoo.com', 'Op', 'swdqd', 'sudah', '2017-03-10 16:10:18');

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
  `email` varchar(64) DEFAULT NULL,
  `pendidikan_terakhir` varchar(16) NOT NULL,
  `sumber_info` varchar(16) DEFAULT NULL,
  `tanggal_daftar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'tanggal created at',
  `status_hapus` int(11) NOT NULL DEFAULT '0' COMMENT '0 = belum dihapus, 1 = sudah dihapus'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id`, `no_ktp`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `alamat`, `kecamatan`, `telepon`, `email`, `pendidikan_terakhir`, `sumber_info`, `tanggal_daftar`, `status_hapus`) VALUES
(5, '222', 'Ahmad', 'Laki-laki', 'Demak', '1990-04-03', 'Islam', 'Jl. ABC', 'Demak', '0857', NULL, 'SD Sederajat', 'Media Sosial', '2017-04-03 08:48:14', 0);

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
  `status` varchar(30) NOT NULL COMMENT '1 = belum dipanggil, 2 = sudah dipanggil, 3 = belum lulus tes wawancara, 4 = sudah lulus tes wawancara, 5 = belum lulus pelatihan, 6 = sudah lulus pelatihan',
  `tanggal_registrasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrasi_pelatihan`
--

INSERT INTO `registrasi_pelatihan` (`id_registrasi`, `no_registrasi`, `id_peserta`, `id_kejuruan`, `id_jadwal`, `status`, `tanggal_registrasi`) VALUES
(5, 'OK17001', 5, 5, 0, '1', '2017-04-03 08:48:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

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
  ADD UNIQUE KEY `no_ktp` (`no_ktp`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kejuruan`
--
ALTER TABLE `kejuruan`
  MODIFY `id_kejuruan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `registrasi_pelatihan`
--
ALTER TABLE `registrasi_pelatihan`
  MODIFY `id_registrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
