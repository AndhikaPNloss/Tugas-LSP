-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 04:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lsp`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id_inventory` int(15) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `jenis_barang` varchar(30) NOT NULL,
  `kuantitas_stok` varchar(30) NOT NULL,
  `lokasi_gudang` varchar(30) NOT NULL,
  `serial_number` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id_inventory`, `nama_barang`, `jenis_barang`, `kuantitas_stok`, `lokasi_gudang`, `serial_number`) VALUES
(3, 'Dobujack', 'Tracktop', '9', 'Tandes', 1903),
(12, '', '', '6', '', 0),
(22, 'New Balance', 'Topi', '7', 'Manyar Sabrangan', 1922),
(90, 'Rucas', 'Kaos', '2', 'Medokan Timur', 1986);

-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

CREATE TABLE `storage` (
  `id_storage` int(15) NOT NULL,
  `nama_gudang` varchar(30) NOT NULL,
  `lokasi_gudang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `storage`
--

INSERT INTO `storage` (`id_storage`, `nama_gudang`, `lokasi_gudang`) VALUES
(18, 'Rumah Desain', 'JL.Manyar '),
(19, 'PT.PNloss', 'Medokan Timur Horor'),
(87, 'PT.Rajawalimedia.net', 'Manyar Sabrangan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(15) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kontak` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `kontak`, `email`) VALUES
(86, 'Andhika', '081986', 'D.eightysix@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` int(15) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kontak` varchar(30) NOT NULL,
  `nama_barang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `nama`, `kontak`, `nama_barang`) VALUES
(9, 'Praditya', '086345234156780', 'HLGN'),
(10, 'Dinda', '082341567809', 'Company'),
(11, 'Dika', '085885234156', 'Adidas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id_inventory`),
  ADD UNIQUE KEY `nama_barang` (`nama_barang`),
  ADD UNIQUE KEY `lokasi_gudang` (`lokasi_gudang`);

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`id_storage`),
  ADD UNIQUE KEY `lokasi_gudang` (`lokasi_gudang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id_vendor`),
  ADD UNIQUE KEY `nama_barang` (`nama_barang`),
  ADD UNIQUE KEY `nama` (`nama`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
