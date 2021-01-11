-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2021 at 03:23 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemen_kuliah`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id_departemen` int(11) NOT NULL,
  `fakultas` varchar(128) NOT NULL,
  `jurusan` varchar(128) NOT NULL,
  `prodi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id_departemen`, `fakultas`, `jurusan`, `prodi`) VALUES
(1, 'Teknik dan Kejuruan', 'Teknik Informatika', 'Manajemen Informatika'),
(2, 'Teknik dan Kejuruan', 'Teknik Informatika', 'Pendidikan Teknik Informatika'),
(3, 'Teknik dan Kejuruan', 'Teknik Informatika', 'Sistem Informasi'),
(4, 'Teknik dan Kejuruan', 'Teknik Informatika', 'Ilmu Komputer'),
(5, 'Teknik dan Kejuruan', 'Teknik Industri', 'Teknik Elektro'),
(6, 'Ekonomi', 'Akuntansi', 'D3 Akuntansi'),
(7, 'Ekonomi', 'Akuntansi', 'S1 Akuntansi');

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `id_krs` int(11) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `id_matakuliah` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`id_krs`, `id_mhs`, `id_matakuliah`, `status`) VALUES
(1, 1, 3, 0),
(2, 1, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `id_matakuliah` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `semester` int(2) NOT NULL,
  `nama_matakuliah` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`id_matakuliah`, `id_departemen`, `semester`, `nama_matakuliah`) VALUES
(1, 1, 1, 'Algoritma Pemrograman'),
(2, 1, 1, 'Pengantar Basis Data'),
(3, 1, 6, 'Praktik Kerja Lapangan'),
(4, 1, 6, 'Tugas Akhir');

-- --------------------------------------------------------

--
-- Table structure for table `mhs`
--

CREATE TABLE `mhs` (
  `id_mhs` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `nim` char(10) NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `tgl_lahir` char(10) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `semester` int(2) NOT NULL,
  `status` int(1) NOT NULL,
  `id_user` int(11) NOT NULL,
  `img` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mhs`
--

INSERT INTO `mhs` (`id_mhs`, `nama`, `nim`, `jenis_kelamin`, `tgl_lahir`, `id_departemen`, `semester`, `status`, `id_user`, `img`) VALUES
(1, 'Zenith', '0000000000', 1, '31-12-1999', 1, 6, 1, 3, 'http://localhost/server-manajemen-kuliah/assets/img/zenith.png');

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id_operator` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `tgl_lahir` char(10) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `img` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id_operator`, `nama`, `jenis_kelamin`, `tgl_lahir`, `id_departemen`, `id_user`, `img`) VALUES
(1, 'Operator 1', 1, '1966-12-30', 1, 2, 'http://localhost/server-manajemen-kuliah/assets/img/user.png'),
(2, 'Operator 2', 2, '1967-11-22', 7, 4, 'http://localhost/server-manajemen-kuliah/assets/img/user.png'),
(4, 'Operator 3', 1, '1968-12-21', 1, 6, 'http://localhost/server-manajemen-kuliah/assets/img/user.png'),
(5, 'Operator 4', 1, '1969-12-26', 6, 7, 'http://localhost/server-manajemen-kuliah/assets/img/user.png'),
(6, 'Operator 5', 2, '1965-11-11', 6, 8, 'http://localhost/server-manajemen-kuliah/assets/img/user.png'),
(7, 'Operator 6', 1, '1969-12-26', 6, 9, 'http://localhost/server-manajemen-kuliah/assets/img/user.png'),
(8, 'Operator 7', 1, '1962-09-14', 1, 10, 'http://localhost/server-manajemen-kuliah/assets/img/user.png'),
(9, 'Operator 8', 2, '1958-10-15', 6, 11, 'http://localhost/server-manajemen-kuliah/assets/img/user.png'),
(10, 'Operator 9', 2, '1967-10-17', 1, 12, 'http://localhost/server-manajemen-kuliah/assets/img/user.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` enum('Admin','Operator','Mahasiswa') NOT NULL,
  `date_created` varchar(20) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `role`, `date_created`, `status`) VALUES
(1, 'admin@admin.com', '$2y$10$eKn.Zc5GyqBXs4NOIvHO.uoBv0FSbWPZDwR/Q1iiT1gvN2CKtpGb2', 'Admin', '2021', 1),
(2, 'operator@operator.com', '$2y$10$3E/0iGfMziSoeTBdD5EECORqxzbTN4Nj/Q2LQWPzEvwVUFRlaGnx.', 'Operator', '2021', 1),
(3, 'mhs@mhs.com', '$2y$10$QUP2GANp3YHSjwKpJ1.c7uS2p0iFdynuQvuUYqP2xuAOVDh89Y23i', 'Mahasiswa', '2021', 1),
(4, 'operator2@operator.com', '$2y$10$AhUGw55teweVn66BFrEr6.PtrMYFCPZBTjVmu/Eyhkjjkl.D//FqS', 'Operator', '07-01-2021 18:57:13', 1),
(6, 'operator3@operator.com', '$2y$10$8tBp7FDCo1fHyyxRAv/aLuMzq9nApyxNTIfr4k1Vb17Gts/09.4Ui', 'Operator', '08-01-2021 21:33:49', 1),
(7, 'operator4@operator.com', '$2y$10$P8L/zNZqcGDCo6KorpXYGur5fwPN33PcuEK1KZTlsK4xHUTKtlPDe', 'Operator', '08-01-2021 23:17:27', 1),
(8, 'operator5@operator.com', '$2y$10$maVtaTEt3g.5Ub.p4D3VouFQutESZ/sT0iVIW2WRVJ6dExgmLw4YO', 'Operator', '09-01-2021 00:00:44', 1),
(9, 'operator6@operator.com', '$2y$10$wz89VeCmn2S1qPx4tu55RuMQtK0sQ93/MMRWE9jjHQmOSidb7Ki6q', 'Operator', '10-01-2021 16:20:02', 1),
(10, 'operator7@operator.com', '$2y$10$yea/tnWPaB790/cJiThDues.p/HmuY6xV1lJUV7SYYgADu.kjLdaW', 'Operator', '10-01-2021 16:42:15', 1),
(11, 'operator8@operator.com', '$2y$10$vNPd1Xyyf72BgvPqB08kR.4O34mPc9wbI.MDE3MA.71/PTLpIy3wK', 'Operator', '10-01-2021 17:52:36', 1),
(12, 'operator9@operator.com', '$2y$10$Nu30lbrzoRCF7IhXyeUFAue0TpXhQfg5/o6nmnXM1rk9zv2nLYqcy', 'Operator', '10-01-2021 19:04:32', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id_krs`),
  ADD KEY `index_matakuliah` (`id_matakuliah`),
  ADD KEY `index_mhs` (`id_mhs`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`id_matakuliah`),
  ADD KEY `index_departemen` (`id_departemen`);

--
-- Indexes for table `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`id_mhs`),
  ADD KEY `index_user` (`id_user`),
  ADD KEY `index_departemen` (`id_departemen`) USING BTREE;

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id_operator`),
  ADD KEY `index_departemen` (`id_departemen`),
  ADD KEY `index_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_departemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id_krs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id_matakuliah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mhs`
--
ALTER TABLE `mhs`
  MODIFY `id_mhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id_operator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`id_matakuliah`) REFERENCES `matakuliah` (`id_matakuliah`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krs_ibfk_2` FOREIGN KEY (`id_mhs`) REFERENCES `mhs` (`id_mhs`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD CONSTRAINT `matakuliah_ibfk_1` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mhs`
--
ALTER TABLE `mhs`
  ADD CONSTRAINT `mhs_ibfk_1` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mhs_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `operator`
--
ALTER TABLE `operator`
  ADD CONSTRAINT `operator_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `operator_ibfk_2` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id_departemen`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
