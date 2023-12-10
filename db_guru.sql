-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2022 at 07:10 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_guru`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `cu_alternatif` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pendidikan` enum('Tidak Ada','SMA/SMK','S1','S2','S3') NOT NULL,
  `pengalaman` float NOT NULL,
  `status` enum('Belum Menikah','Menikah') NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`cu_alternatif`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `pengalaman`, `status`, `alamat`) VALUES
('1207262208950002', 'Agus Priono', 'Laki-Laki', 'Laut Dendang', '1995-08-22', 'S1', 3, 'Belum Menikah', 'DUSUN VI ANGGREK'),
('1205110203900004', 'Agus Salim', 'Laki-Laki', 'Pekubuan', '1990-03-02', 'S1', 4, 'Belum Menikah', 'Dusun IX Pekubuan'),
('1207264603870008', 'Amnah Lailan Batu Bara', 'Perempuan', 'Medan', '1987-03-06', 'S1', 5, 'Menikah', 'Psr 8 Gg.Muttakin Dsn VI Sei Rotan'),
('1207260309960008', 'Fachri Husaini Syam', 'Laki-Laki', 'Kisaran', '1996-09-03', 'S1', 4, 'Belum Menikah', 'jl. bustamam gg wijaya kesuma 15 a No. 9'),
('1271140312900003', 'Herawanto Dikromo', 'Laki-Laki', 'Medan', '1990-12-03', 'S1', 4, 'Menikah', 'JLN TUASAN NO.180');

-- --------------------------------------------------------

--
-- Table structure for table `hasilspk`
--

CREATE TABLE `hasilspk` (
  `cu_alternatif` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasilspk`
--

INSERT INTO `hasilspk` (`cu_alternatif`, `nama`, `nilai`) VALUES
('1205110203900004', 'Agus Salim', 0),
('1207260309960008', 'Fachri Husaini Syam', 0.78),
('1207262208950002', 'Agus Priono', 0.22),
('1207264603870008', 'Amnah Lailan Batu Bara', 1),
('1271140312900003', 'Herawanto Dikromo', 0.83);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` varchar(255) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`) VALUES
('K1', 'Perilaku', 0.25),
('K2', 'Absensi', 0.2),
('K3', 'Kinerja', 0.2),
('K4', 'Pengajaran', 0.2),
('K5', 'Pengalaman', 0.15);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(255) NOT NULL,
  `cu_alternatif` varchar(255) NOT NULL,
  `kd_kriteria` varchar(255) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `cu_alternatif`, `kd_kriteria`, `nilai`) VALUES
(0, '1205110203900004', 'K1', 80),
(0, '1205110203900004', 'K2', 80),
(0, '1205110203900004', 'K3', 90),
(0, '1205110203900004', 'K4', 80),
(0, '1205110203900004', 'K5', 80),
(0, '1207260309960008', 'K1', 90),
(0, '1207260309960008', 'K2', 90),
(0, '1207260309960008', 'K3', 80),
(0, '1207260309960008', 'K4', 80),
(0, '1207260309960008', 'K5', 80),
(0, '1207262208950002', 'K1', 80),
(0, '1207262208950002', 'K2', 90),
(0, '1207262208950002', 'K3', 80),
(0, '1207262208950002', 'K4', 90),
(0, '1207262208950002', 'K5', 80),
(0, '1207264603870008', 'K1', 90),
(0, '1207264603870008', 'K2', 90),
(0, '1207264603870008', 'K3', 80),
(0, '1207264603870008', 'K4', 90),
(0, '1207264603870008', 'K5', 80),
(0, '1271140312900003', 'K1', 90),
(0, '1271140312900003', 'K2', 80),
(0, '1271140312900003', 'K3', 90),
(0, '1271140312900003', 'K4', 90),
(0, '1271140312900003', 'K5', 60);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `cu_subkriteria` varchar(255) NOT NULL,
  `id_kriteria` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `bobot` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `cu_subkriteria`, `id_kriteria`, `kategori`, `bobot`) VALUES
(1, 'SK1', 'K1', 'A', 90),
(2, 'SK2', 'K1', 'B', 80),
(3, 'SK3', 'K1', 'C', 60),
(4, 'SK4', 'K1', 'E', 40),
(5, 'SK1', 'K2', '0', 90),
(7, 'SK2', 'K2', '1 s/d 5', 80),
(8, 'SK3', 'K2', '5 s/d 10', 60),
(9, 'SK4', 'K2', '>10', 40),
(10, 'SK1', 'K3', 'Sangat Baik', 90),
(11, 'SK2', 'K3', 'Baik', 80),
(12, 'SK3', 'K3', 'Cukup', 60),
(13, 'SK4', 'K3', 'Kurang', 40),
(14, 'SK1', 'K4', 'A', 90),
(15, 'SK2', 'K4', 'B', 80),
(16, 'SK3', 'K4', 'C', 60),
(17, 'SK4', 'K4', 'E', 40),
(18, 'SK1', 'K5', '>7 Tahun', 90),
(19, 'SK2', 'K5', '4 s/d 7 Tahun', 80),
(20, 'SK3', 'K5', '1 s/d 3 Tahun', 60),
(21, 'SK4', 'K5', '&lt; 1 Tahun', 40);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` enum('pimpinan','admin') NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `role`, `password`) VALUES
(2, 'Yudha Prayoga', 'admin', 'admin', '$2y$10$M7QkhxUBZP8jdHJizWve7.l6mQDkd7EMZwVokuVwOsKghS3xrV0qa'),
(0, 'Kepala Sekolah', 'kepsek', 'pimpinan', '$2y$10$74jV4lxLuSsg08omuDi1v.6tCWCCdbLJAIrjCbDHKcYtxmrj/5Hl.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
