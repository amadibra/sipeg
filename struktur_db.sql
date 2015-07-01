/*
SQLyog Enterprise - MySQL GUI v7.1 
MySQL - 5.0.45-community-nt : Database - dbsipeg
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbsipeg` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `dbsipeg`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `nipeg` varchar(10) NOT NULL,
  `kd_posisi` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='tabel daftar juragan sipeg';

/*Table structure for table `admin_dosir` */

DROP TABLE IF EXISTS `admin_dosir`;

CREATE TABLE `admin_dosir` (
  `nipeg` varchar(10) NOT NULL,
  `kd_posisi` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `bio01` */

DROP TABLE IF EXISTS `bio01`;

CREATE TABLE `bio01` (
  `nipeg` varchar(10) default NULL,
  `nama` varchar(30) default NULL,
  `gelar` varchar(15) default NULL,
  `pendidikan` varchar(10) default NULL,
  `kd_posisi` varchar(12) default NULL,
  `jabatan` varchar(80) default NULL,
  `KodeJenjang` int(2) NOT NULL,
  `tgl_jabat` date default NULL,
  `kd_jabatan` varchar(8) default NULL,
  `kd_posisir` varchar(12) default NULL,
  `jabatanr` varchar(60) default NULL,
  `kd_jabatr` varchar(8) default NULL,
  `eselon` char(2) default NULL,
  `tgl_masuk` date default NULL,
  `tgl_capeg` date default NULL,
  `tgl_tetap` date default NULL,
  `jenis_peg` int(1) default NULL,
  `kekaryaan` int(1) default NULL,
  `nip_nrp` varchar(10) default NULL,
  `aktivitas` int(1) default NULL,
  `tgl_aktif` date default NULL,
  `tgl_unit` date default NULL,
  `tgl_setara` date default NULL,
  `golongan` varchar(5) default NULL,
  `peringkat` int(2) default NULL,
  `grade_sk` varchar(8) default NULL,
  `gjdasar_sk` varchar(8) default NULL,
  `tgl_gaji` date default NULL,
  `tgl_pngkt` date default NULL,
  `gol_1thl` varchar(5) default NULL,
  `gol_2thl` varchar(5) default NULL,
  `gol_3thl` varchar(5) default NULL,
  `gol_4thl` varchar(5) default NULL,
  `gol_5thl` varchar(5) default NULL,
  `tgl_lahir` date default NULL,
  `tpt_lahir` varchar(15) default NULL,
  `kelamin` int(1) default NULL,
  `gol_darah` char(2) default NULL,
  `agama` varchar(9) default NULL,
  `perkawinan` int(1) default NULL,
  `jml_klrg` int(2) default NULL,
  `alamat` varchar(255) default NULL,
  `kota` varchar(15) default NULL,
  `kode_pos` varchar(5) default NULL,
  `perumahan` int(1) default NULL,
  `bhs_asing1` int(1) default NULL,
  `bhs_asing2` int(1) default NULL,
  `bhs_asing3` int(1) default NULL,
  `kuasa_bhs1` int(1) default NULL,
  `kuasa_bhs2` int(1) default NULL,
  `kuasa_bhs3` int(1) default NULL,
  `jml_bio02` int(2) default NULL,
  `jml_bio03` int(2) default NULL,
  `jml_bio04` int(2) default NULL,
  `jml_bio05` int(2) default NULL,
  `jml_bio06` int(2) default NULL,
  `jml_bio07` int(2) default NULL,
  `jml_bio08` int(2) default NULL,
  `jml_bio09` int(2) default NULL,
  `jml_bio10` int(2) default NULL,
  `tgl_update` date default NULL,
  `operator` varchar(8) default NULL,
  `flag` char(1) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `bio02` */

DROP TABLE IF EXISTS `bio02`;

CREATE TABLE `bio02` (
  `nipeg` varchar(10) default NULL,
  `no_urut` int(2) default NULL,
  `pangkat` char(2) default NULL,
  `tgl_pngkt` date default NULL,
  `kd_pangkat` int(1) default NULL,
  `flag` char(1) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `bio03` */

DROP TABLE IF EXISTS `bio03`;

CREATE TABLE `bio03` (
  `nipeg` varchar(10) default NULL,
  `no_urut` int(2) default '0',
  `kd_jabatan` varchar(8) default NULL,
  `jabatan` varchar(100) default NULL,
  `kd_unit` varchar(12) default NULL,
  `kd_org` varchar(8) default NULL,
  `unit_kerja` varchar(105) default NULL,
  `tgl_jabat` date default NULL,
  `tgl_akhir` date default NULL,
  `stat_jab` char(1) default NULL,
  `flag` char(1) default NULL,
  `tgl_update` date default NULL,
  `unit1` varchar(60) default NULL,
  `unit2` varchar(60) default NULL,
  `unit3` varchar(60) default NULL,
  `unit4` varchar(60) default NULL,
  `unit5` varchar(60) default NULL,
  `peringkat` int(2) default NULL,
  `grade_sk` varchar(10) default NULL,
  `no_sk` varchar(25) default NULL,
  `tgl_sk` date default NULL,
  `kd_mutasi` int(1) default NULL,
  `pa` varchar(4) default NULL,
  `parea` varchar(40) default NULL,
  `bus` varchar(4) default NULL,
  `barea` varchar(40) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `bio04` */

DROP TABLE IF EXISTS `bio04`;

CREATE TABLE `bio04` (
  `nipeg` varchar(10) default NULL,
  `no_urut` int(2) default NULL,
  `pendidikan` varchar(20) default NULL,
  `thn_lulus` int(4) default NULL,
  `lembaga` varchar(45) default NULL,
  `lokasi` varchar(25) default NULL,
  `kd_lokasi` int(1) default NULL,
  `gelar` varchar(15) default NULL,
  `flag` int(1) default NULL,
  `tgl_wkerja` date default NULL,
  `thn_wkerja` int(4) default NULL,
  `bln_wkerja` int(2) default NULL,
  `sortfld` char(1) default NULL,
  `tgl_update` date default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `bio05` */

DROP TABLE IF EXISTS `bio05`;

CREATE TABLE `bio05` (
  `nipeg` varchar(10) default NULL,
  `no_urut` int(2) default NULL,
  `kode` varchar(6) default NULL,
  `kursus` varchar(45) default NULL,
  `tgl_mulai` date default NULL,
  `tgl_akhir` date default NULL,
  `kd_lokasi` int(1) default NULL,
  `lembaga` varchar(25) default NULL,
  `lokasi` varchar(25) default NULL,
  `tgl_wkerja` char(2) default NULL,
  `thn_wkerja` char(2) default NULL,
  `bln_wkerja` char(2) default NULL,
  `tgl_sort` date default NULL,
  `flag` char(1) default NULL,
  `nilai` int(3) default NULL,
  `kriteria` char(1) default NULL,
  `rangking` int(3) default NULL,
  `peserta` int(3) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `bio06` */

DROP TABLE IF EXISTS `bio06`;

CREATE TABLE `bio06` (
  `nipeg` varchar(10) default NULL,
  `no_urut` int(2) default NULL,
  `instansi` varchar(80) default NULL,
  `jabatan` varchar(30) default NULL,
  `tgl_mulai` date default NULL,
  `tgl_akhir` date default NULL,
  `flag` char(1) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `bio07` */

DROP TABLE IF EXISTS `bio07`;

CREATE TABLE `bio07` (
  `nipeg` varchar(10) default NULL,
  `no_urut` int(2) default NULL,
  `penugasan` varchar(60) default NULL,
  `jabatan` varchar(20) default NULL,
  `unit_kerja` char(30) default NULL,
  `tgl_mulai` date default NULL,
  `tgl_akhir` date default NULL,
  `flag` char(1) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `bio08` */

DROP TABLE IF EXISTS `bio08`;

CREATE TABLE `bio08` (
  `nipeg` varchar(10) default NULL,
  `no_urut` int(2) default NULL,
  `nomor_spk` varchar(29) default NULL,
  `tgl_spk` date default NULL,
  `tgl_mulai` date default NULL,
  `tgl_akhir` date default NULL,
  `golongan` varchar(5) default NULL,
  `unit_kerja` char(3) default NULL,
  `flag` char(1) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `bio09` */

DROP TABLE IF EXISTS `bio09`;

CREATE TABLE `bio09` (
  `nipeg` varchar(10) default NULL,
  `no_urut` int(2) default '0',
  `jenis` int(1) default '0',
  `urai` text,
  `pemberi` varchar(30) default NULL,
  `tanggal` date default NULL,
  `flag` char(1) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `bio10` */

DROP TABLE IF EXISTS `bio10`;

CREATE TABLE `bio10` (
  `nipeg` varchar(10) default NULL,
  `no_urut` int(2) default '0',
  `hubungan` int(1) default '0',
  `nama` varchar(30) default NULL,
  `kelamin` int(1) default '0',
  `tgl_lahir` date default NULL,
  `pekerjaan` int(1) default '0',
  `nipeg_pln` varchar(10) default NULL,
  `stat_sipil` int(1) default '0',
  `tgl_status` date default NULL,
  `tunjangan` int(1) default '0',
  `flag` char(1) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `bus_area` */

DROP TABLE IF EXISTS `bus_area`;

CREATE TABLE `bus_area` (
  `kode_unit` varchar(5) collate latin1_general_ci default NULL,
  `id_bus` varchar(4) collate latin1_general_ci NOT NULL,
  `bus` varchar(30) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id_bus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Table structure for table `dozir` */

DROP TABLE IF EXISTS `dozir`;

CREATE TABLE `dozir` (
  `nipeg` varchar(10) collate latin1_general_ci default NULL,
  `time` bigint(20) default NULL,
  `id_Dozir` varchar(3) collate latin1_general_ci default NULL,
  `no_urut` varchar(2) collate latin1_general_ci default NULL,
  `keterangan` varchar(100) collate latin1_general_ci default NULL,
  `namafile` varchar(50) collate latin1_general_ci NOT NULL,
  `No_sk` varchar(50) collate latin1_general_ci default NULL,
  `tgl_sk` date default NULL,
  `tgl_entry` date default NULL,
  `id` double NOT NULL auto_increment,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=200160 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Table structure for table `foto` */

DROP TABLE IF EXISTS `foto`;

CREATE TABLE `foto` (
  `nipeg` varchar(10) default NULL,
  `foto` blob
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `gjdasar` */

DROP TABLE IF EXISTS `gjdasar`;

CREATE TABLE `gjdasar` (
  `nipeg` varchar(10) default NULL,
  `no_urut` int(2) default NULL,
  `gjdasar_sk` varchar(10) default NULL,
  `tgl_mulai` date default NULL,
  `no_sk` varchar(30) default NULL,
  `tgl_sk` date default NULL,
  `stat_gol` char(1) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `golongan` */

DROP TABLE IF EXISTS `golongan`;

CREATE TABLE `golongan` (
  `nipeg` varchar(10) default NULL,
  `no_urut` int(2) default NULL,
  `gjdasar_sk` varchar(10) default NULL,
  `tgl_mulai` date default NULL,
  `no_sk` varchar(30) default NULL,
  `tgl_sk` date default NULL,
  `stat_gol` char(1) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `jenis_dozir` */

DROP TABLE IF EXISTS `jenis_dozir`;

CREATE TABLE `jenis_dozir` (
  `id_dozir` varchar(2) collate latin1_general_ci default NULL,
  `nama_dozir` varchar(37) collate latin1_general_ci default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Table structure for table `logs` */

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `user` varchar(10) default NULL,
  `ip` varchar(20) default NULL,
  `time` bigint(20) unsigned default NULL,
  `act` varchar(255) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `pesan` */

DROP TABLE IF EXISTS `pesan`;

CREATE TABLE `pesan` (
  `no` int(10) unsigned default NULL,
  `time` bigint(20) unsigned default '0',
  `tanggal` date default '0000-00-00',
  `nipeg` varchar(10) default NULL,
  `nama` varchar(30) default NULL,
  `kd_posisi` varchar(12) default NULL,
  `ip` varchar(20) default NULL,
  `komentar` mediumblob,
  `tertulis` text,
  `seharusnya` text,
  `flag` tinyint(1) unsigned default '0',
  `id` double NOT NULL auto_increment,
  `status` int(1) default NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=473 DEFAULT CHARSET=latin1;

/*Table structure for table `posisi` */

DROP TABLE IF EXISTS `posisi`;

CREATE TABLE `posisi` (
  `kode` varchar(12) default NULL,
  `posisi` varchar(80) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `profesi` */

DROP TABLE IF EXISTS `profesi`;

CREATE TABLE `profesi` (
  `no_urut` int(2) default NULL,
  `nipeg` varchar(10) default NULL,
  `nm_profesi` varchar(50) default NULL,
  `sb_profesi` varchar(80) default NULL,
  `tgl_mulai` date default NULL,
  `tgl_akhir` date default NULL,
  `jenis` char(1) default NULL,
  `stat_prof` char(1) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `session` */

DROP TABLE IF EXISTS `session`;

CREATE TABLE `session` (
  `session` varchar(50) default NULL,
  `user` varchar(10) default NULL,
  `ip` varchar(20) default NULL,
  `last` bigint(20) unsigned default NULL,
  `act` varchar(255) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbgjdsr` */

DROP TABLE IF EXISTS `tbgjdsr`;

CREATE TABLE `tbgjdsr` (
  `no_urut` int(5) default NULL,
  `nipeg` varchar(10) default NULL,
  `nama` varchar(30) default NULL,
  `kd_jabatan` varchar(8) default NULL,
  `peringkat` int(2) default NULL,
  `grade_sk` varchar(10) default NULL,
  `nuk` char(17) default NULL,
  `gj_dasar` int(10) default NULL,
  `gjdasar_sk` varchar(10) default NULL,
  `tg_gaji` date default NULL,
  `stat_gaji` char(1) default NULL,
  `keterangan` varchar(20) default NULL,
  `no_sk` varchar(25) default NULL,
  `tgl_sk` date default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tbkondite` */

DROP TABLE IF EXISTS `tbkondite`;

CREATE TABLE `tbkondite` (
  `no_urut` int(2) default NULL,
  `nipeg` varchar(10) default NULL,
  `nama` varchar(30) default NULL,
  `tgl_mulai` date default NULL,
  `tgl_akhir` date default NULL,
  `talenta` varchar(17) default NULL,
  `grade_sk` varchar(8) default NULL,
  `gjdasar_sk` varchar(8) default NULL,
  `stat_gaji` varchar(1) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `upload` */

DROP TABLE IF EXISTS `upload`;

CREATE TABLE `upload` (
  `id` int(11) NOT NULL auto_increment,
  `time` bigint(20) unsigned default NULL,
  `name` varchar(30) NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `content` mediumblob NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49763 DEFAULT CHARSET=latin1;

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user` varchar(10) default NULL,
  `pass` varchar(50) default NULL,
  `active` tinyint(1) default '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
