-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 16, 2017 at 10:11 
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_topsis_guru`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `kode_bobot` varchar(15) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`kode_bobot`, `jumlah`, `keterangan`) VALUES
('B001', 1, 'Sangat Buruk'),
('B002', 2, 'Buruk'),
('B003', 3, 'Cukup'),
('B004', 4, 'Baik'),
('B005', 5, 'Sangat Baik');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama`, `alamat`, `jenis_kelamin`, `no_hp`) VALUES
('G001', 'Fauzy', 'Bogor', 'Pria', '081234567'),
('G002', 'Imuth', 'Depok', 'Wanita', '087654321');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `kode_kriteria` varchar(15) NOT NULL,
  `nama_kriteria` varchar(30) NOT NULL,
  `kategori` varchar(35) DEFAULT NULL,
  `bobot` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`kode_kriteria`, `nama_kriteria`, `kategori`, `bobot`) VALUES
('C1', 'Absensi', 'Benefit/Keuntungan', 2),
('C2', 'Disiplin', 'Benefit/Keuntungan', 3),
('C3', 'Etika', 'Benefit/Keuntungan', 2),
('C4', 'Motivasi', 'Benefit/Keuntungan', 4),
('C5', 'Tanggung Jawab', 'Benefit/Keuntungan', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(15) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `email`) VALUES
('001', '', 'admin', 'admin123', 'admin@admin.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`kode_bobot`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
