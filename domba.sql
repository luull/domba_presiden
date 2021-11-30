-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2021 at 05:20 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `domba`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_domba`
--

CREATE TABLE `jenis_domba` (
  `id` int(11) NOT NULL,
  `jenis` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_domba`
--

INSERT INTO `jenis_domba` (`id`, `jenis`) VALUES
(1, 'Jantan'),
(2, 'Betina Pedaging'),
(3, 'Morino'),
(4, 'Tangkas');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pakan`
--

CREATE TABLE `jenis_pakan` (
  `id` int(11) NOT NULL,
  `pakan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_pakan`
--

INSERT INTO `jenis_pakan` (`id`, `pakan`) VALUES
(1, 'Pagi'),
(2, 'Siang'),
(3, 'Sore');

-- --------------------------------------------------------

--
-- Table structure for table `kandang_domba`
--

CREATE TABLE `kandang_domba` (
  `id` int(11) NOT NULL,
  `kandang` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kandang_domba`
--

INSERT INTO `kandang_domba` (`id`, `kandang`) VALUES
(1, 'Kandang Utama'),
(2, 'Kandang Baja'),
(3, 'Kandang Kayu');

-- --------------------------------------------------------

--
-- Table structure for table `order_pakan`
--

CREATE TABLE `order_pakan` (
  `id` int(11) NOT NULL,
  `no_order` varchar(255) NOT NULL,
  `tgl_order` date NOT NULL,
  `jenis_pakan` int(11) NOT NULL,
  `tgl_estimasi` date NOT NULL,
  `harga` varchar(255) NOT NULL,
  `supplier` varchar(500) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tgl_terima` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_pakan`
--

INSERT INTO `order_pakan` (`id`, `no_order`, `tgl_order`, `jenis_pakan`, `tgl_estimasi`, `harga`, `supplier`, `status`, `tgl_terima`) VALUES
(5, 'PO-365248', '2021-11-17', 2, '2021-12-09', '200.000', '3', '0', '2021-11-30'),
(7, 'PO-539781', '2021-11-30', 3, '2021-12-01', '1.000.000', '1', '0', '2021-11-30'),
(8, 'PO-964273', '2021-11-09', 2, '2021-11-02', '20.000', '3', '0', '2021-11-30'),
(9, 'PO-846573', '2021-11-16', 2, '2021-12-01', '60.000', '3', '1', '2021-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `penimbangan`
--

CREATE TABLE `penimbangan` (
  `id` int(11) NOT NULL,
  `no_regis` int(255) NOT NULL,
  `tgl_timbang` date NOT NULL,
  `berat_timbang` int(255) NOT NULL,
  `vitamin` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penimbangan`
--

INSERT INTO `penimbangan` (`id`, `no_regis`, `tgl_timbang`, `berat_timbang`, `vitamin`) VALUES
(8, 1234567890, '2021-11-25', 11, 'TIDAK'),
(11, 12123123, '2021-11-09', 100, 'TIDAK'),
(12, 12321321, '2021-11-18', 99, 'YA'),
(13, 1234567890, '2021-11-18', 12, 'TIDAK');

-- --------------------------------------------------------

--
-- Table structure for table `regis_domba`
--

CREATE TABLE `regis_domba` (
  `id` int(11) NOT NULL,
  `no_regis` int(255) NOT NULL,
  `berat_awal` int(255) NOT NULL,
  `jenis` varchar(500) NOT NULL,
  `kandang` varchar(500) NOT NULL,
  `kamar` varchar(500) NOT NULL,
  `harga_beli` int(255) NOT NULL,
  `supplier` varchar(500) NOT NULL,
  `tgl_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regis_domba`
--

INSERT INTO `regis_domba` (`id`, `no_regis`, `berat_awal`, `jenis`, `kandang`, `kamar`, `harga_beli`, `supplier`, `tgl_masuk`) VALUES
(1, 1234567890, 12, 'Betina Pedaging', 'Kandang Kayu', '12', 12, 'Marinalo', '2020-09-04'),
(3, 12123123, 13, 'Morino', 'Kandang Kayu', '10', 20, 'Njay', '2021-11-25'),
(5, 12321321, 20, 'Tangkas', 'Kandang Utama', '20', 20, 'asdasd', '2021-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama_supplier`) VALUES
(1, 'PT HUNG A INDONESIA'),
(3, 'PT CARKAP');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `level` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `date_created`) VALUES
(1, 'admin', '$2y$10$O6skXSE.zEZr8S9AUMqSVeseryQdRNgeF4OAn896UuRBHPJtQCh/u', 1, '2021-11-24 14:42:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_domba`
--
ALTER TABLE `jenis_domba`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_pakan`
--
ALTER TABLE `jenis_pakan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kandang_domba`
--
ALTER TABLE `kandang_domba`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_pakan`
--
ALTER TABLE `order_pakan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penimbangan`
--
ALTER TABLE `penimbangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regis_domba`
--
ALTER TABLE `regis_domba`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_regis` (`no_regis`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_domba`
--
ALTER TABLE `jenis_domba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenis_pakan`
--
ALTER TABLE `jenis_pakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kandang_domba`
--
ALTER TABLE `kandang_domba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_pakan`
--
ALTER TABLE `order_pakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penimbangan`
--
ALTER TABLE `penimbangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `regis_domba`
--
ALTER TABLE `regis_domba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
