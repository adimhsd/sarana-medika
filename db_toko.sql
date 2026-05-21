-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2014 at 05:19 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
CREATE TABLE IF NOT EXISTS `barang` (
  `kd_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `diskon` decimal(10,0) DEFAULT NULL,
  `satuan` varchar(255) NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `stok_min` int(11) NOT NULL,
  PRIMARY KEY (`kd_barang`),
  UNIQUE KEY `kd_barang` (`kd_barang`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `diskon`, `satuan`, `jumlah_stok`, `stok_min`) VALUES
('0010544ZN2', 'Asam Alkohol 3%', 45000, 120000, 4, '100ml', 33, 5),
('0160544B', 'ASAM SULFO 20%', 300000, 425000, 2, '100ml', 58, 5),
('0240544B', 'EOSIN 2%', 153000, 280000, 4, '100ml', 84, 5),
('1022099100', 'Albumin FS', 180000, 270000, 3, 'Kit', 80, 5),
('1040199830', 'Alkaline phospatase FS DKCG', 168000, 285000, 2, 'Kit', 45, 5),
('1084999903', 'Bilirubin JenGrof', 520000, 675000, 1, 'kit', 45, 5),
('1130099100', 'Cholesterol FS', 285000, 390000, 1, 'kit', 61, 5),
('1130099903', 'Cholesterol ecoline', 810000, 995000, 3, 'kit', 51, 5),
('1171199100', 'Creatinine FS', 180000, 295000, 1, 'kit', 80, 5),
('1260199100', 'Asat ( GOT ) FS', 195000, 285000, 2, 'kit', 52, 5),
('1270199100', 'Alat ( GPT ) FS', 180000, 270000, 2, 'Kit', 82, 5),
('1280991002', 'Gamma-GT FS', 348000, 485000, 3, 'kit', 55, 5),
('1311599100', 'Urea CT FS', 171000, 297000, 2, 'Kit', 43, 5);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('2691ea9dc0e394bc54ae624c3a3adc6a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.114 Safari/537.36', 1401373267, 'a:5:{s:9:"user_data";s:0:"";s:3:"nik";s:16:"19871028.01.0001";s:4:"nama";s:20:"Adi Muhamad M, A.md.";s:7:"jabatan";s:13:"administrator";s:15:"flash:old:alert";s:173:"<div class="alert alert-danger alert-dismissable"><button data-dismiss="alert" class="close" type="button">×</button><i class="icon-remove-sign"></i> Data sudah ada !</div>";}'),
('6bfe3ac20ecafb7c34d7e9619f0ed69e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.114 Safari/537.36', 1401376513, 'a:4:{s:9:"user_data";s:0:"";s:3:"nik";s:16:"19871028.01.0001";s:4:"nama";s:20:"Adi Muhamad M, A.md.";s:7:"jabatan";s:13:"administrator";}');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `kd_customer` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `jml_piutang` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`kd_customer`),
  UNIQUE KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`kd_customer`, `nama`, `alamat`, `no_telp`, `email`, `jml_piutang`) VALUES
(3, 'CV. BINA SEJAHTERA MANDIRI', 'Jln. TB Simatupang No. 23 Jakarta Barat', '21322435', 'binasejahteramandiri@ymail.com', 1459200),
(4, 'CV. GARUDA UTAMED', 'Jln. galxy No. 19 Bekasi', '21433298', 'garudautamed@gmail.com', NULL),
(5, 'RS. MEDIKA PERMATA HIJAU', 'Jln. Sukarno Hata No. 223 Jakarta Pusat', '212288', 'rsmedikapermatahijau@gmail.com', NULL),
(6, 'RS. BANI SALEH', 'Jln. TB Simatupang No. 3 Tanjung Priuk Jakarta Utara', '21228823', 'rsbanisaleh@gmail.com', NULL),
(7, 'CV. BUMI INDAH', 'Jln. Cipinag raya No. 231 Jakarta Timur', '2133442', 'cvbumiindah@gmail.com', NULL),
(8, 'Lab. Hosana Medika III', 'Jln. cut nyadien No. 3 Tanggerang - Banten', '21334887', 'labhosanamedika@ymail.com', NULL),
(9, 'JATI MULYA MEDICAL CENTER', 'Jln. meruya No. 23 meruya - Jakarta pusat', '32249974', 'jatimulyamedicalcenter@gmail.com', NULL),
(10, 'LKS "MEDIKA LESTARI  DUTA MAS"', 'Jln. raden patah No. 4 Jakarta Selatan', '32244590', 'lksmedikalestari@gmail.com', NULL),
(11, 'MEDIKA PLAZA International Clinik', 'Jln. Tanah Abang No. 23 Jakarta selatan', '23445387', 'medikaplaza@gmail.com', NULL),
(12, 'RS. BHAKTI HUSADA', 'Jln. muara jaya No. 23 Cikarang - Bekasi', '233446700', 'rsbhaktihusada@gmail.com', NULL),
(13, 'RS. Jakarta  Medical Center', 'Jln. rengas No. 123 meruya - Jakarta pusat', '23322990', 'jktmedicalcenter@gmail.com', NULL),
(14, 'RS. ANNISA', 'Jln. cikarang No. 23 Cikarang Barat - Bekasi', '21335600', 'rs.annisa@ymail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

DROP TABLE IF EXISTS `detail_pembelian`;
CREATE TABLE IF NOT EXISTS `detail_pembelian` (
  `no_faktur` varchar(20) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `jml_barang` int(11) NOT NULL,
  `subtotal_harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_faktur`,`kd_barang`),
  KEY `no_faktur` (`no_faktur`),
  KEY `kd_barang` (`kd_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`no_faktur`, `kd_barang`, `jml_barang`, `subtotal_harga`) VALUES
('123.we3', '0160544B', 10, 3000000),
('12sm.ds33', '0010544ZN2', 5, 225000),
('12sm.ds33', '0240544B', 5, 765000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

DROP TABLE IF EXISTS `detail_penjualan`;
CREATE TABLE IF NOT EXISTS `detail_penjualan` (
  `no_faktur` varchar(20) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `jml_barang` int(11) NOT NULL,
  `subtotal_harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_faktur`,`kd_barang`),
  KEY `no_faktur` (`no_faktur`),
  KEY `kd_barang` (`kd_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`no_faktur`, `kd_barang`, `jml_barang`, `subtotal_harga`) VALUES
('2014.05.0001', '0010544ZN2', 2, 230400),
('2014.05.0001', '0160544B', 2, 833000),
('2014.05.0001', '0240544B', 2, 537600),
('2014.05.0001', '1260199100', 2, 558600),
('2014.05.0002', '1270199100', 3, 793800),
('2014.05.0002', '1311599100', 2, 582120),
('2014.05.0003', '0240544B', 2, 537600),
('2014.05.0003', '1130099903', 2, 1930300),
('2014.05.0004', '0010544ZN2', 2, 230400),
('2014.05.0004', '1130099100', 2, 772200),
('2014.05.0005', '1260199100', 3, 837900),
('2014.05.0006', '0010544ZN2', 1, 115200),
('2014.05.0006', '0240544B', 5, 1344000);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE IF NOT EXISTS `pegawai` (
  `nik` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT '0000-00-00',
  `alamat` varchar(100) DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL,
  `pendidikan` varchar(100) DEFAULT NULL,
  `tgl_masuk_kerja` date DEFAULT '0000-00-00',
  `gaji` decimal(10,0) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `jabatan` enum('owner','gudang','kurir','marketing','administrator') NOT NULL,
  PRIMARY KEY (`nik`),
  UNIQUE KEY `nik` (`nik`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nik`, `nama`, `username`, `password`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `alamat`, `no_telp`, `pendidikan`, `tgl_masuk_kerja`, `gaji`, `photo`, `jabatan`) VALUES
('19710101.01.0005', 'Drs. Ismail Marjuki, M,Si.', 'owner', '$2a$08$ITIzm7WmWJkkvdQ9I/GP6.P2So1J6UTS6V8EKTanKTjfSo6AgmsHC', 'Laki-laki', 'Kuningan', '1971-01-01', 'Desa Mekarjaya Kecamatan Sindang laya Sumedang Jawa Barat', '021888789', 'S2', '2012-05-01', 3500000, '42ef18b8580587263b296dd3ffa2a4b3.jpg', 'owner'),
('19871028.01.0001', 'Adi Muhamad M, A.md.', 'administrator', '$2a$08$rggqqVCWYqiV5j61qCt.5OOtbjRWlYI6a.FP7kSx5fB8n12A7CGTW', 'Laki-laki', 'Kuningan', '1987-10-28', 'Desa Sukaraja Kecamata Ciawigebang Kab. Kuningan 45591', '081210485104', 'Diploma 3', '2008-10-01', 3500000, '7aaf9475daad38accf8c5ab68b9cf256.jpg', 'administrator'),
('19880728.02.0002', 'Wiwi Setyo Pratiwi, S.Pd.', 'marketing', '$2a$08$iaYykApjdGBZxT4mJ9AtNu9JtfvtqooUFrfqOLzkvcRuG8l0bApd2', 'Perempuan', 'Kuningan', '1988-07-28', 'Desa Windujanten Kecamatan Kadugede Kab. Kuningan', '085759889720', 'Sarjana', '2009-10-01', 2000000, '70bcef64d43b0ba18a1a79a7afe353aa.jpg', 'marketing'),
('19890108.01.0004', 'Riki Kusriana Subagja', 'kurir', '$2a$08$y.2EWRBP146thV3XSg79xeKgtW5uthB1xw75XSEg6eQ4JN5Egue/q', 'Laki-laki', 'Kuningan', '1989-01-08', 'Desa Maleber kecamatan Maleber kab. Kuningan', '081310889108', 'SMA', '2013-02-04', 23500000, 'a7c3cc49a5682d6831cf8d91307bcc67.jpg', 'kurir'),
('19890214.02.0006', 'Coba Marketng Kedua', 'marketing2', '$2a$08$HUnaiGKHTyL4xoonkA.Rzu/AbyjWoE/32OvVtDHzMSNUrw7yG0t7W', 'Perempuan', 'majalengka', '1989-02-14', 'Desa Cihaur Kecamatan Malabar kabupaten Majalengka', '0323987123', 'SMA', '2013-01-01', 1250000, 'b752c74c06470351a47f49ae5ce3f918.jpg', 'marketing'),
('19891124.01.0007', 'Pengantar barang 2', 'kurir2', '$2a$08$W1/65vcOrtyTPoYCscv3kuAktL5WrXZNCveJ2OidXqdj0ZEwUiPSy', 'Laki-laki', 'Kuningan', '1989-11-24', 'Desa Windujanten Kecamatan Kadugede Kab. Kuningan', '098821000', 'SMP', '2012-03-01', 1850000, 'c8fa199be369bd4c2fa6538b6bf33746.jpg', 'kurir'),
('19911104.01.0003', 'Muhamad Debbian Tsamir Dzakki', 'gudang', '$2a$08$FyfRLlx36/ZLvOuuoPECZuRkS7VElun9kkt2mLx2dJpGDhvPGre86', 'Laki-laki', 'Kuningan', '1991-11-04', 'Perum Bima Agung Regensi, Sindang agung - Kuningan', '085797066191', 'SMA', '2012-08-18', 1800000, 'b7c035af959e9565c8f29c361bcfc77d.jpg', 'gudang');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE IF NOT EXISTS `pembelian` (
  `no_faktur` varchar(20) NOT NULL,
  `kd_supplier` int(11) NOT NULL,
  `tgl_faktur` date NOT NULL,
  `tgl_jatuh_tempo` date NOT NULL,
  `jml_harga` int(11) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `is_update` enum('y','n') NOT NULL DEFAULT 'n',
  `status` enum('y','n') DEFAULT 'n',
  PRIMARY KEY (`no_faktur`),
  KEY `kd_supplier` (`kd_supplier`),
  KEY `nik` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`no_faktur`, `kd_supplier`, `tgl_faktur`, `tgl_jatuh_tempo`, `jml_harga`, `nik`, `is_update`, `status`) VALUES
('123.we3', 5, '2014-05-02', '2014-05-16', 0, '19871028.01.0001', 'y', 'n'),
('12sm.ds33', 4, '2014-05-01', '2014-05-15', 0, '19871028.01.0001', 'y', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE IF NOT EXISTS `penjualan` (
  `no_faktur` varchar(20) NOT NULL,
  `kd_customer` int(11) NOT NULL,
  `tgl_faktur` date DEFAULT '0000-00-00',
  `tgl_jatuh_tempo` date DEFAULT '0000-00-00',
  `jml_harga` int(11) DEFAULT NULL,
  `nik` varchar(25) DEFAULT NULL,
  `is_update` enum('y','n') DEFAULT 'n',
  `status` enum('y','n') DEFAULT 'n',
  `nik_kurir` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`no_faktur`),
  KEY `kd_customer` (`kd_customer`),
  KEY `nik` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`no_faktur`, `kd_customer`, `tgl_faktur`, `tgl_jatuh_tempo`, `jml_harga`, `nik`, `is_update`, `status`, `nik_kurir`) VALUES
('2014.05.0001', 13, '2014-05-04', '2014-05-18', NULL, '19871028.01.0001', 'y', 'y', '19890108.01.0004'),
('2014.05.0002', 6, '2014-05-05', '2014-05-19', NULL, '19871028.01.0001', 'y', 'n', '19890108.01.0004'),
('2014.05.0003', 10, '2014-05-06', '2014-05-20', NULL, '19880728.02.0002', 'y', 'n', '19891124.01.0007'),
('2014.05.0004', 7, '2014-05-07', '2014-05-21', NULL, '19890214.02.0006', 'y', 'y', '19890108.01.0004'),
('2014.05.0005', 7, '2014-05-08', '2014-05-22', NULL, '19890214.02.0006', 'y', 'n', '19891124.01.0007'),
('2014.05.0006', 3, '2014-05-01', '2014-05-14', NULL, '19871028.01.0001', 'y', 'n', '19890108.01.0004');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `kd_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jml_utang` int(11) NOT NULL,
  PRIMARY KEY (`kd_supplier`),
  UNIQUE KEY `kd_supplier` (`kd_supplier`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kd_supplier`, `nama`, `alamat`, `no_telp`, `email`, `jml_utang`) VALUES
(4, 'PT. Merck tbk', 'Jln. TB Simatupang No. 23 Jakarta Barat', '02399800', 'merck@gmail.com', 0),
(5, 'CV. PALINDO MEDIKA', 'Jln. cikarang No. 23 Cikarang Barat - Bekasi', '08897776', 'palindomedika@gmail.com', 0),
(6, 'PT. MEDIKA UTAMA Tbk', 'Jln. Cipinag raya No. 231 Jakarta Timur', '099888673', 'medikautama@ymail.com', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_penjualan`
--
DROP VIEW IF EXISTS `view_penjualan`;
CREATE TABLE IF NOT EXISTS `view_penjualan` (
`no_faktur` varchar(20)
,`kd_customer` int(11)
,`tgl_faktur` date
,`tgl_jatuh_tempo` date
,`jml_harga` int(11)
,`nik` varchar(25)
,`is_update` enum('y','n')
,`status` enum('y','n')
,`kd_barang` varchar(10)
,`jml_barang` int(11)
,`subtotal_harga` int(11)
);
-- --------------------------------------------------------

--
-- Structure for view `view_penjualan`
--
DROP TABLE IF EXISTS `view_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_penjualan` AS select `penjualan`.`no_faktur` AS `no_faktur`,`penjualan`.`kd_customer` AS `kd_customer`,`penjualan`.`tgl_faktur` AS `tgl_faktur`,`penjualan`.`tgl_jatuh_tempo` AS `tgl_jatuh_tempo`,`penjualan`.`jml_harga` AS `jml_harga`,`penjualan`.`nik` AS `nik`,`penjualan`.`is_update` AS `is_update`,`penjualan`.`status` AS `status`,`detail_penjualan`.`kd_barang` AS `kd_barang`,`detail_penjualan`.`jml_barang` AS `jml_barang`,`detail_penjualan`.`subtotal_harga` AS `subtotal_harga` from (`penjualan` left join `detail_penjualan` on((`detail_penjualan`.`no_faktur` = `penjualan`.`no_faktur`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`no_faktur`) REFERENCES `pembelian` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pembelian_ibfk_2` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`);

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`no_faktur`) REFERENCES `penjualan` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`nik`) REFERENCES `pegawai` (`nik`),
  ADD CONSTRAINT `pembelian_ibfk_3` FOREIGN KEY (`kd_supplier`) REFERENCES `supplier` (`kd_supplier`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`kd_customer`) REFERENCES `customer` (`kd_customer`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`nik`) REFERENCES `pegawai` (`nik`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
