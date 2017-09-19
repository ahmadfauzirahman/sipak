-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 19, 2017 at 08:07 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipak`
--

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_keg` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_keg` varchar(100) NOT NULL,
  `tgl_keg` date NOT NULL,
  `tgl2_keg` date NOT NULL,
  `tmp_keg` varchar(100) NOT NULL,
  `dana_keg` enum('Anggaran Tahunan Poltekkes','Dana Mandiri','Dana Sponsor') NOT NULL,
  `plk_keg` int(11) NOT NULL,
  `status_keg` enum('Draft','Menunggu Persetujuan Pudir','Ditolak Pudir','Menunggu Persetujuan Direktur','Disetujui Direktur','Ditolak Direktur') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_lap` int(11) NOT NULL,
  `id_keg` int(11) NOT NULL,
  `judul_lap` varchar(250) NOT NULL,
  `tgl_lap` date NOT NULL,
  `status_lap` enum('Draft','Menunggu Persetujuan Pudir','Ditolak Pudir','Menunggu Persetujuan Direktur','Disetujui Direktur','Ditolak Direktur') NOT NULL,
  `foto` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_lap`, `id_keg`, `judul_lap`, `tgl_lap`, `status_lap`, `foto`) VALUES
(2, 61, 'Laporan Pengabdian Masyarakat 2015.pdf', '2017-06-04', 'Disetujui Direktur', 'Capture.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `pelaksana`
--

CREATE TABLE `pelaksana` (
  `id_plk` int(11) NOT NULL,
  `id_keg` int(11) NOT NULL,
  `nama_plk` varchar(50) NOT NULL,
  `nip_plk` varchar(20) NOT NULL,
  `pangkat_plk` varchar(50) NOT NULL,
  `jabatan_plk` varchar(30) NOT NULL,
  `unit_plk` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `email`, `level`) VALUES
(4, 'pudir', '202cb962ac59075b964b07152d234b70', 'Pembantu Direktur I', 'pudir@gmail.com', 'Pudir'),
(12, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@gmail.com', 'Administrator'),
(14, 'sekdir', '202cb962ac59075b964b07152d234b70', 'Kerani ', 'sekdir@gmail.com', 'Sekdir'),
(15, 'pudir2', '202cb962ac59075b964b07152d234b70', 'Pembantu Direktur II', 'pudir2@gmail.com', 'Pudir'),
(16, 'pudir3', '202cb962ac59075b964b07152d234b70', 'Pembantu Direktur III', 'pudir3@gmail.com', 'Pudir'),
(19, 'Bangkit', '71c7c97e86a4618374f3a345248b3dff', 'bangkit', 'bangkit123@gmail.com', 'Direktur'),
(20, 'fauzi', '202cb962ac59075b964b07152d234b70', 'fauzi', 'fauzi@gmail.com', 'Pegawai'),
(21, 'deslin', '202cb962ac59075b964b07152d234b70', 'deslin', 'deslin@gmail.com', 'Pegawai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_keg`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_lap`);

--
-- Indexes for table `pelaksana`
--
ALTER TABLE `pelaksana`
  ADD PRIMARY KEY (`id_plk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_keg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_lap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pelaksana`
--
ALTER TABLE `pelaksana`
  MODIFY `id_plk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
