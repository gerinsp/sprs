-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 12:39 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sprs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `kondisi` enum('Sangat Baik','Baik','Kurang Baik') NOT NULL DEFAULT 'Sangat Baik'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kendaraan`
--

CREATE TABLE `tbl_kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengembalian_barang`
--

CREATE TABLE `tbl_pengembalian_barang` (
  `id_pengembalian_barang` int(11) NOT NULL,
  `id_pinjam_barang` int(11) NOT NULL,
  `waktu_pengembalian` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kondisi_barang` varchar(255) NOT NULL,
  `denda` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_penerima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengembalian_kendaraan`
--

CREATE TABLE `tbl_pengembalian_kendaraan` (
  `id_pengembalian_kendaraan` int(11) NOT NULL,
  `id_pinjam_kendaraan` int(11) NOT NULL,
  `waktu_pengembalian` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `denda` varchar(255) NOT NULL,
  `kilometer_akhir` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_penerima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam_barang`
--

CREATE TABLE `tbl_pinjam_barang` (
  `id_pinjam_barang` int(11) NOT NULL,
  `id_peminjam` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_takeaway` tinyint(1) NOT NULL,
  `alasan_pinjam` varchar(255) NOT NULL,
  `kondisi_barang` varchar(255) NOT NULL,
  `estimasi_pengembalian` datetime NOT NULL,
  `is_finish` tinyint(1) NOT NULL,
  `status` enum('ditolak','menunggu','diterima') NOT NULL,
  `id_user_confirm` int(11) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam_kendaraan`
--

CREATE TABLE `tbl_pinjam_kendaraan` (
  `id_pinjam_kendaraan` int(11) NOT NULL,
  `id_peminjam` int(11) NOT NULL,
  `id_kendaraan` int(11) NOT NULL,
  `kilometer_awal` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL,
  `id_supir` int(11) NOT NULL,
  `is_finish` tinyint(1) NOT NULL,
  `status` enum('ditolak','menunggu','diterima') NOT NULL,
  `id_user_confirm` int(11) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam_ruangan`
--

CREATE TABLE `tbl_pinjam_ruangan` (
  `id_pinjam_ruangan` int(11) NOT NULL,
  `id_peminjam` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `acara` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL,
  `kebutuhan` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `is_finish` tinyint(1) NOT NULL,
  `status` enum('ditolak','menunggu','diterima') NOT NULL,
  `id_user_confirm` int(11) NOT NULL,
  `pesan` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id_role` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id_role`, `nama`) VALUES
(1, 'Administrator'),
(2, 'Kepala Sekolah'),
(3, 'Kepegawaian'),
(4, 'Peminjam');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ruangan`
--

CREATE TABLE `tbl_ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `lokasi` varchar(225) NOT NULL,
  `foto_ruangan` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supir`
--

CREATE TABLE `tbl_supir` (
  `id_supir` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `ttl` varchar(255) NOT NULL,
  `foto_sim` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `image` varchar(150) NOT NULL,
  `id_role` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama`, `image`, `id_role`, `is_active`, `created_at`) VALUES
(1, 'admin', '$2a$12$hCRoWUAtpzFVvimiYOgSMODeXHgqHGxnsqcnC/imrDma3f27jRFqG', 'IT Admin', 'default.png', 0, 1, '2023-11-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_pengembalian_barang`
--
ALTER TABLE `tbl_pengembalian_barang`
  ADD PRIMARY KEY (`id_pengembalian_barang`);

--
-- Indexes for table `tbl_pengembalian_kendaraan`
--
ALTER TABLE `tbl_pengembalian_kendaraan`
  ADD PRIMARY KEY (`id_pengembalian_kendaraan`);

--
-- Indexes for table `tbl_pinjam_barang`
--
ALTER TABLE `tbl_pinjam_barang`
  ADD PRIMARY KEY (`id_pinjam_barang`);

--
-- Indexes for table `tbl_pinjam_kendaraan`
--
ALTER TABLE `tbl_pinjam_kendaraan`
  ADD PRIMARY KEY (`id_pinjam_kendaraan`);

--
-- Indexes for table `tbl_pinjam_ruangan`
--
ALTER TABLE `tbl_pinjam_ruangan`
  ADD PRIMARY KEY (`id_pinjam_ruangan`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `tbl_ruangan`
--
ALTER TABLE `tbl_ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `tbl_supir`
--
ALTER TABLE `tbl_supir`
  ADD PRIMARY KEY (`id_supir`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pengembalian_barang`
--
ALTER TABLE `tbl_pengembalian_barang`
  MODIFY `id_pengembalian_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pengembalian_kendaraan`
--
ALTER TABLE `tbl_pengembalian_kendaraan`
  MODIFY `id_pengembalian_kendaraan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pinjam_barang`
--
ALTER TABLE `tbl_pinjam_barang`
  MODIFY `id_pinjam_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pinjam_kendaraan`
--
ALTER TABLE `tbl_pinjam_kendaraan`
  MODIFY `id_pinjam_kendaraan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pinjam_ruangan`
--
ALTER TABLE `tbl_pinjam_ruangan`
  MODIFY `id_pinjam_ruangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_ruangan`
--
ALTER TABLE `tbl_ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_supir`
--
ALTER TABLE `tbl_supir`
  MODIFY `id_supir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
