-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 21, 2018 at 01:12 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jualy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `nama_brg` varchar(30) NOT NULL,
  `jenis_brg` set('Makanan','Minuman','Rumah Tangga') NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `harga_brg` int(7) NOT NULL,
  `jumlah` int(6) NOT NULL,
  `sisa` int(6) NOT NULL,
  `suplier` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`nama_brg`, `jenis_brg`, `kode_barang`, `harga_brg`, `jumlah`, `sisa`, `suplier`) VALUES
('Fanta', 'Minuman', 'BRG001', 6000, 2735, 2288, 'Pepsi Co'),
('Sprite', 'Minuman', 'BRG002', 4000, 200, 200, 'PT Sinarmas'),
('Coca Cola', 'Minuman', 'BRG003', 7000, 1400, 388, 'Pepsi Co International'),
('Bakmi Mewah', 'Makanan', 'BRG004', 2000, 203, 166, 'PT Indofood'),
('Sunlight', 'Rumah Tangga', 'BRG005', 3000, 300, 300, 'PT Mega Nusantara'),
('Daia', 'Minuman', 'BRG006', 2000, 1000, 630, 'Pepsi Co'),
('Lifebouy', 'Rumah Tangga', 'BRG007', 2500, 777, 777, 'PT Unilever Indonesia'),
('Dji Sam Soe', 'Makanan', 'BRG008', 15000, 600, 600, 'PT Djaroem Indonesia'),
('Mild', 'Makanan', 'BRG010', 16000, 700, 700, 'PT Djaroem Indonesia'),
('Pop Corn', 'Minuman', 'BRG011', 3000, 1140, 1004, 'Pepsi Co'),
('Silver Queen', 'Makanan', 'BRG012', 13000, 15, 15, 'PT Unilever Indonesia'),
('Mie Sedap Goreng', 'Makanan', 'BRG013', 2500, 1500, 1500, 'Pepsi Co');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(8) NOT NULL,
  `nama_pegawai` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `jenis_kelamin` set('Perempuan','Laki-laki') NOT NULL,
  `alamat` varchar(60) NOT NULL,
  `no_hape` varchar(13) NOT NULL,
  `shift` set('Pagi','Siang','Malam') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `password`, `jenis_kelamin`, `alamat`, `no_hape`, `shift`) VALUES
('PGW001', 'Yaumil Ikhsan', '111111', 'Laki-laki', 'Bireuen, Aceh, Indonesia', '082123242', 'Pagi'),
('PGW002', 'Waktu Kurniawan', '222222', 'Laki-laki', 'Blang Pulo, Lorong SMP 8, Lhokseumawe', '000000', 'Siang'),
('PGW003', 'Depi Elpina', '333333', 'Perempuan', 'Bireuen', '10000000', 'Siang'),
('PGW004', 'Zainannur', '444444', 'Laki-laki', 'Bireuen', '1234042', 'Malam'),
('PGW005', 'Dedi Torang', '555555', 'Laki-laki', 'Jakarta, Indonesia, ID', '992344', 'Pagi'),
('PGW006', 'Shinji', '666666', 'Perempuan', 'Jepang, Asia Barat, Dunia', '222222', 'Malam'),
('PGW007', 'Zainan Jr', '777777', 'Laki-laki', 'Medan, Sumatera Utara, Indonesia', '7436932', 'Malam'),
('PGW008', 'Subhan', '888888', 'Laki-laki', 'Blang Pulo, Lorong SMP 8, Lhokseumawe', '888548', 'Pagi'),
('PGW009', 'Kiesling', '', 'Laki-laki', 'Blang Pula, Lorong Samping Kak Ita, Lhoseumawe', '082134567891', 'Siang'),
('PGW010', 'Romi', '', 'Laki-laki', 'Jakarta, Indonesia, ID', '120591510', 'Malam'),
('PGW011', 'Roni', '', 'Laki-laki', 'Jl. Karto Sudibjo, Jawa Timur, Indonesia', '99999999', 'Pagi'),
('PGW012', 'Modis', '', 'Perempuan', 'Jl. Karto Sudibjo, Jawa Timur, Indonesia', '942588232', 'Pagi'),
('PGW013', 'M Salman', '', 'Laki-laki', 'Jl. Karto Sudibjo, Jawa Timur, Indonesia', '254235252', 'Siang'),
('PGW014', 'Katrina', '', 'Perempuan', 'Jl. Karto Sudibjo, Jawa Timur, Indonesia', '4325252', 'Siang'),
('PGW015', 'Kodi', '', 'Perempuan', 'Bireuen, Kota Juang, Kabupaten Bireuen, NAD', '1341421', 'Malam');

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

CREATE TABLE `pemasok` (
  `id_pemasok` varchar(8) NOT NULL,
  `nama_pemasok` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `telepon` int(13) NOT NULL,
  `barang` set('Makanan','Minuman','Rumah Tangga') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasok`
--

INSERT INTO `pemasok` (`id_pemasok`, `nama_pemasok`, `alamat`, `telepon`, `barang`) VALUES
('PMSK0001', 'PT Sinarmas', 'Blang Pulo, Lorong Samping Kak', 100001, 'Makanan'),
('PMSK0002', 'Pepsi Co', 'Jl. Karto Sudibjo, Jawa Timur,', 210221, 'Makanan'),
('PMSK0003', 'PT Unilever', 'Jl Sisinga Maraja, Kota Medan,', 922134, 'Makanan'),
('PMSK0004', 'PT Djaroem', 'Jl. Karto Sudibjo, Jawa Timur,', 1221411, 'Makanan'),
('PMSK0005', 'PT Sinarmas 2', 'Bireuen, Kota Juang, Kabupaten', 1243141, 'Makanan'),
('PMSK0006', 'PT Indofood', 'Jl Sisinga Maraja, Kota Medan,', 989823, 'Makanan'),
('PMSK0007', 'PT Mega Nusantara', 'Jl Sisinga Maraja, Kota Medan,', 9872120, 'Makanan'),
('PMSK0008', 'PT Danone', 'Jl. Karto Sudibjo, Jawa Timur,', 4919421, 'Minuman'),
('PMSK0009', 'PT Kenko', 'Jl Sisinga Maraja, Kota Medan,', 9411241, 'Rumah Tangga'),
('PMSK0010', 'PT Gelifood', 'Jl. Karto Sudibjo, Jawa Timur,', 492352, 'Makanan'),
('PMSK0011', 'PT Surya', 'Bireuen, Kota Juang, Kabupaten', 41941221, 'Rumah Tangga'),
('PMSK0012', 'PT Indoclean', 'Jl. Karto Sudibjo, Jawa Timur,', 92155195, 'Rumah Tangga'),
('PMSK0013', 'PT HouseIndo', 'Jl. Karto Sudibjo, Jawa Timur,', 924821, 'Rumah Tangga');

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` varchar(10) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `jenis_kelamin` set('Perempuan','Laki-laki') DEFAULT NULL,
  `no_hape` varchar(13) DEFAULT NULL,
  `pelanggan` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama`, `alamat`, `jenis_kelamin`, `no_hape`, `pelanggan`) VALUES
('PLG0000001', 'Dadang', 'Bireuen, Kota Juang, Kabupaten Bireuen, NAD', 'Laki-laki', NULL, 0),
('PLG0000002', 'Dudung', 'Blang Pulo, Lorong SMP 8 Banda Sakti, Lhokseumawe', 'Laki-laki', NULL, 0),
('PLG0000003', 'Diding', 'Blang Pula, Lorong Samping Kak Ita, Lhoseumawe', 'Laki-laki', NULL, 0),
('PLG0000004', 'Hoya', 'Bireuen, Kota Juang, Kabupaten Bireuen, NAD', 'Laki-laki', NULL, 0),
('PLG0000005', 'Zeus', 'Bireuen, Kota Juang, Kabupaten Bireuen, NAD', 'Laki-laki', NULL, 0),
('PLG0000006', 'Torres', 'Spanyol', 'Laki-laki', NULL, 0),
('PLG0000007', 'Mohammad Salah', 'Mesir', 'Laki-laki', NULL, 0),
('PLG0000008', 'Budi', 'Nanggroe Aceh Darussalam', 'Laki-laki', NULL, 0),
('PLG0000009', 'Andi', 'Nanggroe Aceh Darussalam', 'Laki-laki', NULL, 0),
('PLG0000010', 'Norman', 'Bireuen, Kota Juang, Kabupaten Bireuen, NAD', 'Perempuan', NULL, 0),
('PLG0000011', 'Sumiati', 'Jl. Karto Sudibjo, Jawa Timur, Indonesia', 'Perempuan', NULL, 0),
('PLG0000012', 'Akbar', 'Bireuen, Kota Juang, Kabupaten Bireuen, NAD', 'Laki-laki', NULL, 0),
('PLG0000013', 'Rahmat', 'Bireuen, Kota Juang, Kabupaten Bireuen, NAD', 'Laki-laki', NULL, 0),
('PLG0000014', 'Rahwana', 'Bireuen, Kota Juang, Kabupaten Bireuen, NAD', 'Laki-laki', NULL, 0),
('PLG0000015', 'Arjuna', 'Jl. Karto Sudibjo, Jawa Timur, Indonesia', 'Laki-laki', NULL, 0),
('PLG0000016', 'Karmin', 'Jl Sisinga Maraja, Kota Medan, Sumut', 'Perempuan', NULL, 0),
('PLG0000017', 'Anggun', 'Jl. Karto Sudibjo, Jawa Timur, Indonesia', 'Laki-laki', NULL, 0),
('PLG0000018', 'Anggi', 'Jl. Karto Sudibjo, Jawa Timur, Indonesia', 'Laki-laki', NULL, 0),
('PLG0000019', 'Andin', 'Medan, Sumatera Utara, Indonesia', 'Laki-laki', NULL, 0),
('PLG0000020', 'Manda', 'Jl Jenderal Sudirman', 'Laki-laki', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `kode_transaksi` varchar(10) NOT NULL,
  `id_pembeli` varchar(10) NOT NULL,
  `id_pegawai` varchar(8) NOT NULL,
  `waktu` datetime NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `harga` int(10) NOT NULL,
  `total_harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`kode_transaksi`, `id_pembeli`, `id_pegawai`, `waktu`, `kode_barang`, `jumlah`, `harga`, `total_harga`) VALUES
('TRS0000001', 'PBL0000005', 'admin', '2018-05-18 15:54:20', 'BRG001', 12, 6000, 72000),
('TRS0000002', 'PBL0000005', 'admin', '2018-05-18 15:54:45', 'BRG003', 12, 7000, 84000),
('TRS0000003', 'PBL0000005', 'admin', '2018-05-18 16:08:06', 'BRG009', 12, 1000, 12000),
('TRS0000004', 'PBL0000005', 'admin', '2018-05-18 16:08:21', 'BRG001', 0, 6000, 0),
('TRS0000005', 'PBL0000005', 'admin', '2018-05-18 16:08:40', 'BRG001', 23, 6000, 138000),
('TRS0000006', 'PBL0000005', 'admin', '2018-05-18 16:08:51', 'BRG001', 45, 6000, 270000),
('TRS0000007', 'PBL0000007', 'admin', '2018-05-18 16:13:41', 'BRG001', 12, 6000, 72000),
('TRS0000008', 'PBL0000008', 'admin', '2018-05-18 17:56:45', 'BRG001', 90, 6000, 540000),
('TRS0000009', 'PBL0000009', 'admin', '2018-05-20 01:25:23', 'BRG001', 12, 6000, 72000),
('TRS0000010', 'PBL0000010', 'admin', '2018-05-20 02:06:48', 'BRG001', 809, 6000, 4854000),
('TRS0000011', 'PBL0000011', 'PGW001', '2018-05-21 02:25:35', 'BRG001', 12, 6000, 72000),
('TRS0000012', 'PBL0000012', 'PGW001', '2018-05-21 04:04:54', 'BRG001', 12, 6000, 72000),
('TRS0000013', 'PLG0000011', 'admin', '2018-05-21 04:51:52', 'BRG007', 23, 2500, 57500);

-- --------------------------------------------------------

--
-- Table structure for table `suplai`
--

CREATE TABLE `suplai` (
  `kode_suplai` varchar(8) NOT NULL,
  `waktu` datetime NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `jumlah` int(8) NOT NULL,
  `harga` int(10) NOT NULL,
  `total_harga` int(10) NOT NULL,
  `id_pemasok` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suplai`
--

INSERT INTO `suplai` (`kode_suplai`, `waktu`, `kode_barang`, `nama_barang`, `jumlah`, `harga`, `total_harga`, `id_pemasok`) VALUES
('SPL00001', '2018-05-12 00:19:39', 'BRG004', 'Bakmi Mewah', 1000, 300, 300000, 'PMSK0001'),
('SPL00002', '2018-05-12 00:34:23', 'BRG003', 'Coca Cola', 1000, 2000, 2000000, 'PMSK0001'),
('SPL00003', '2018-05-12 00:35:07', 'BRG001', 'Fanta', 2000, 2000, 4000000, 'PMSK0002'),
('SPL00004', '2018-05-12 00:40:56', 'BRG001', 'Fanta', 100, 2000, 200000, 'PMSK0001'),
('SPL00005', '2018-05-12 00:43:04', 'BRG001', 'Fanta', 100, 1000, 100000, 'PMSK0001'),
('SPL00006', '2018-05-12 00:49:06', 'BRG001', 'Fanta', 5000, 100, 500000, 'PMSK0001'),
('SPL00007', '2018-05-12 00:52:43', 'BRG001', 'Fanta', 1000, 100, 100000, 'PMSK0001'),
('SPL00008', '2018-05-12 01:04:46', 'BRG001', 'Fanta', 10000, 10, 100000, 'PMSK0001'),
('SPL00012', '2018-05-12 01:09:19', 'BRG001', 'Fanta', 325, 200, 65000, 'PMSK0001'),
('SPL00013', '2018-05-21 05:48:06', 'BRG007', 'Lifebouy', 500, 2500, 1250000, 'PMSK0013'),
('SPL00014', '2018-05-21 05:50:22', 'BRG011', 'Pop Corn', 1000, 3000, 3000000, 'PMSK0002'),
('SPL00016', '2018-05-21 05:51:58', 'BRG010', 'Mild', 300, 12000, 3600000, 'PMSK0002'),
('SPL00017', '2018-05-21 05:52:26', 'BRG006', 'Daia', 600, 4000, 2400000, 'PMSK0013');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD UNIQUE KEY `kode_brg` (`kode_barang`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `no_hape` (`no_hape`),
  ADD KEY `nama_pegawai` (`nama_pegawai`);

--
-- Indexes for table `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id_pemasok`),
  ADD KEY `nama_pemasok` (`nama_pemasok`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`kode_transaksi`),
  ADD KEY `penjualan_ibfk_1` (`kode_barang`),
  ADD KEY `penjualan_ibfk_2` (`id_pegawai`),
  ADD KEY `penjualan_ibfk_3` (`id_pembeli`);

--
-- Indexes for table `suplai`
--
ALTER TABLE `suplai`
  ADD PRIMARY KEY (`kode_suplai`),
  ADD KEY `suplai_ibfk_1` (`id_pemasok`),
  ADD KEY `suplai_ibfk_2` (`kode_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
