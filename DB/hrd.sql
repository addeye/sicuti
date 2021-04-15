# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.11-MariaDB)
# Database: hrd
# Generation Time: 2021-04-15 02:28:11 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cuti
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cuti`;

CREATE TABLE `cuti` (
  `kode` varchar(10) NOT NULL,
  `nik` varchar(16) NOT NULL DEFAULT '',
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  `jenis_cuti` varchar(50) NOT NULL,
  `ket` varchar(50) DEFAULT '',
  `status_kepala` enum('Approved','Rejected','Pending') DEFAULT 'Pending',
  `status_sekertaris` enum('Approved','Rejected','Pending') DEFAULT 'Pending',
  `status_ketua` enum('Approved','Rejected','Pending') DEFAULT 'Pending',
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `cuti` WRITE;
/*!40000 ALTER TABLE `cuti` DISABLE KEYS */;

INSERT INTO `cuti` (`kode`, `nik`, `tanggal_awal`, `tanggal_akhir`, `jumlah`, `jenis_cuti`, `ket`, `status_kepala`, `status_sekertaris`, `status_ketua`)
VALUES
	('CT4136','7779798','2021-04-22','2021-04-29','7','VC2934','Mau nikah','Approved','Approved','Approved'),
	('CT6250','4545454','2021-04-22','2021-04-29','7','VC3132','sakit','Approved','Pending','Pending');

/*!40000 ALTER TABLE `cuti` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table departemen
# ------------------------------------------------------------

DROP TABLE IF EXISTS `departemen`;

CREATE TABLE `departemen` (
  `id_dept` varchar(10) NOT NULL,
  `nama_dept` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_dept`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `departemen` WRITE;
/*!40000 ALTER TABLE `departemen` DISABLE KEYS */;

INSERT INTO `departemen` (`id_dept`, `nama_dept`)
VALUES
	('D8050','IT'),
	('D9037','Accounting'),
	('D9853','PN PACITAN');

/*!40000 ALTER TABLE `departemen` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table izin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `izin`;

CREATE TABLE `izin` (
  `kode` varchar(10) NOT NULL DEFAULT '',
  `nik` varchar(16) DEFAULT NULL,
  `tanggal_awal` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `status` enum('Approved','Rejected','Pending') DEFAULT 'Pending',
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `izin` WRITE;
/*!40000 ALTER TABLE `izin` DISABLE KEYS */;

INSERT INTO `izin` (`kode`, `nik`, `tanggal_awal`, `tanggal_akhir`, `ket`, `status`)
VALUES
	('IZ4346','7779798','2021-04-22','2021-04-29','Izin kondangan','Rejected');

/*!40000 ALTER TABLE `izin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jabatan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id_jabatan` varchar(10) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tunjangan` varchar(10) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `jabatan` WRITE;
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`, `tunjangan`)
VALUES
	('J1506','Panitera Muda Perdata','-'),
	('J2051','Ketua Pengadilan','-'),
	('J3066','Wakil Ketua Pengadilan','-'),
	('J3878','Panitera Muda Pidana','-'),
	('J4284','Panitera','-'),
	('J9318','Kepala Subagian Umum','-');

/*!40000 ALTER TABLE `jabatan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jenis_cuti
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jenis_cuti`;

CREATE TABLE `jenis_cuti` (
  `id_cuti` varchar(10) NOT NULL,
  `nama_cuti` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cuti`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `jenis_cuti` WRITE;
/*!40000 ALTER TABLE `jenis_cuti` DISABLE KEYS */;

INSERT INTO `jenis_cuti` (`id_cuti`, `nama_cuti`)
VALUES
	('VC2934','Cuti Nikah'),
	('VC3007','Cuti Khitan Anak'),
	('VC3132','Cuti Mendadak'),
	('VC6503','Cuti Melahirkan'),
	('VC7268','Cuti Hamil');

/*!40000 ALTER TABLE `jenis_cuti` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table karyawan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `nik` varchar(40) NOT NULL DEFAULT '',
  `nama` varchar(100) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `departemen` varchar(50) NOT NULL DEFAULT '',
  `jabatan` varchar(50) NOT NULL,
  `status` enum('TETAP','PKWT','PKWTT') NOT NULL,
  `jumlah_cuti` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` int(11) NOT NULL,
  `gambar` text NOT NULL,
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `karyawan` WRITE;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;

INSERT INTO `karyawan` (`nik`, `nama`, `tanggal_masuk`, `departemen`, `jabatan`, `status`, `jumlah_cuti`, `username`, `password`, `level`, `gambar`)
VALUES
	('12345','Ari','2021-04-04','','J1506','TETAP','10','ketua','61eb5ed0f5a34d6671a07cef13798ad153d9814b',1,'uploads/profile/Instagram post - 2.jpeg'),
	('3434343','Bayu','2021-04-04','','J1506','TETAP','10','sekertaris','6cb0179ca5163a3b36b569291802160cfbf5ad5b',2,'uploads/profile/Instagram post - 3.jpeg'),
	('4545454','Bima','2021-04-04','D8050','J3878','TETAP','10','kepala','4efd7c429ad4cdab5c08c3e742445ec0f1ace4bb',3,'uploads/profile/Instagram post - 5.jpeg'),
	('767676','Puja','2021-04-07','D8050','J3878','TETAP','10','puja','b6798e282e8cf0d400d3d339d510374f203f61bb',4,'uploads/profile/Instagram post - 8.jpeg'),
	('7779798','Aga','2021-04-05','D8050','J4284','PKWT','10','aga','47b3af9da9b3132ba7a10479a787862f50e1928b',4,'uploads/profile/Instagram post - 6.jpeg');

/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table level
# ------------------------------------------------------------

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `level` WRITE;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;

INSERT INTO `level` (`id`, `nama`)
VALUES
	(1,'Ketua'),
	(2,'Sekertaris'),
	(3,'Kepala Bagian'),
	(4,'Pegawai');

/*!40000 ALTER TABLE `level` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(60) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `username`, `password`)
VALUES
	(1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
