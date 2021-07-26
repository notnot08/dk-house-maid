-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 26, 2021 at 07:47 PM
-- Server version: 10.2.39-MariaDB-log-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `housemai_stg_ctki`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`housemai`@`localhost` PROCEDURE `setApproveDokTki` (IN `ID_TKI` VARCHAR(11), IN `ID_JUSTIFIKASI` VARCHAR(11))  NO SQL
UPDATE JUSTIFIKASI_PEKERJAAN SET DATA_DIRI_APPROVAL = (SELECT APPROVE FROM MST_TKI WHERE ID = ID_TKI), APPROVED_BY_1 = (SELECT APPROVED_BY FROM MST_TKI WHERE ID = ID_TKI), APPROVED_DATE_1 = (SELECT APPROVED_DATE FROM MST_TKI WHERE ID = ID_TKI) WHERE ID = ID_JUSTIFIKASI$$

CREATE DEFINER=`housemai`@`localhost` PROCEDURE `setUserPenyalur` (IN `ID_NYA` VARCHAR(11), IN `ID_USER` VARCHAR(11), IN `ID_PEMBUAT` VARCHAR(11), IN `USERNYA` VARCHAR(100))  NO SQL
INSERT INTO MST_USER (id, username, nama, jenis, id_penyalur, id_group, created_by)
  SELECT
    ID_USER AS id,
    USERNYA AS username,
    nama AS nama,
    '3' AS jenis,
    ID AS id_penyalur,
    ID_GROUP AS id_group,
    ID_PEMBUAT AS CREATED_BY
  FROM MST_PENYALUR 
  WHERE id = ID_NYA$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `DOKUMEN`
--

CREATE TABLE `DOKUMEN` (
  `ID` varchar(11) NOT NULL,
  `ID_TKI` varchar(11) DEFAULT NULL,
  `ID_JENIS_DOK` varchar(11) NOT NULL,
  `ID_KONTRAK` varchar(11) DEFAULT NULL,
  `ID_PERJANJIAN` varchar(11) DEFAULT NULL,
  `CODE` varchar(50) DEFAULT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 = ACTIVE, 0 = NON ACTIVE',
  `PATH` text DEFAULT NULL,
  `FILE` varchar(20) DEFAULT NULL,
  `DELETED_BY` varchar(11) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `JUSTIFIKASI_PEKERJAAN`
--

CREATE TABLE `JUSTIFIKASI_PEKERJAAN` (
  `ID` varchar(11) NOT NULL,
  `ID_TKI` varchar(11) NOT NULL,
  `ID_PEKERJAAN` varchar(11) NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 = ACTIVE, 0 = NON ACTIVE',
  `PROGRESS` varchar(1) NOT NULL DEFAULT '1' COMMENT '0 = COMPLETED, 1 = NEW, 2 = ON PROGRESS, 3 = APPROVED, 4 = REJECTED, 5 = CANCELED, 6 = CANCELED CONTRACT',
  `DATA_DIRI_APPROVAL` varchar(1) NOT NULL DEFAULT '0' COMMENT '0 = NEW, 1 = APPROVED, 2 = REJECTED',
  `APPROVED_BY_1` varchar(11) DEFAULT NULL,
  `APPROVED_DATE_1` timestamp NULL DEFAULT NULL,
  `SURAT_PERJANJIAN_APPROVAL` varchar(1) DEFAULT NULL COMMENT '0 = NEW, 1 = APPROVED, 2 = REJECTED, 3 = SUBMITED, 4',
  `APPROVED_BY_2` varchar(11) DEFAULT NULL,
  `APPROVED_DATE_2` timestamp NULL DEFAULT NULL,
  `KONTRAK_KERJA_APPROVAL` varchar(1) DEFAULT NULL COMMENT '0 = NEW, 1 = APPROVED, 2 = REJECTED, 3 = SUBMITED',
  `APPROVED_BY_3` varchar(11) DEFAULT NULL,
  `APPROVED_DATE_3` timestamp NULL DEFAULT NULL,
  `ID_KONTRAK` varchar(11) DEFAULT NULL,
  `ID_PERJANJIAN` varchar(11) DEFAULT NULL,
  `ID_LOWONGAN` varchar(11) DEFAULT NULL,
  `ASSIGNED_BY` varchar(11) DEFAULT NULL,
  `ASSIGNED_DATE` timestamp NULL DEFAULT NULL,
  `CATATAN` text DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `KUALIFIKASI`
--

CREATE TABLE `KUALIFIKASI` (
  `ID` varchar(11) NOT NULL,
  `ID_TKI` varchar(11) DEFAULT NULL,
  `ID_KUALIFIKASI` varchar(11) NOT NULL,
  `JAWABAN` varchar(1) DEFAULT NULL,
  `KETERANGAN` text DEFAULT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 = ACTIVE, 0 = NON ACTIVE',
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LOG`
--

CREATE TABLE `LOG` (
  `ID` int(11) NOT NULL,
  `JENIS` int(11) NOT NULL,
  `CODE` varchar(11) DEFAULT NULL,
  `AKSI` varchar(6) DEFAULT NULL,
  `STATUS` varchar(1) DEFAULT NULL COMMENT '1 = SUKSES, 0 = GAGAL',
  `CATATAN` text DEFAULT NULL,
  `CHANGE_STATUS` varchar(1) DEFAULT NULL,
  `ID_USER` varchar(11) DEFAULT NULL,
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LOG`
--

INSERT INTO `LOG` (`ID`, `JENIS`, `CODE`, `AKSI`, `STATUS`, `CATATAN`, `CHANGE_STATUS`, `ID_USER`, `INSERT_DATE`) VALUES
(1, 1, NULL, NULL, NULL, 'SUKSES', NULL, '87429290576', '2021-07-26 12:46:46');

-- --------------------------------------------------------

--
-- Table structure for table `LOG_EVENT`
--

CREATE TABLE `LOG_EVENT` (
  `ID` int(11) NOT NULL,
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `EVENTTYPE` varchar(100) NOT NULL,
  `MESSAGE` varchar(400) NOT NULL,
  `REF1` varchar(11) DEFAULT NULL,
  `REF2` varchar(11) DEFAULT NULL,
  `REF3` varchar(11) DEFAULT NULL,
  `USER` varchar(200) DEFAULT NULL,
  `REMARK` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `MST_PENYALUR`
--

CREATE TABLE `MST_PENYALUR` (
  `ID` varchar(11) NOT NULL,
  `NAMA` varchar(100) DEFAULT NULL,
  `NIK` varchar(16) DEFAULT NULL,
  `NPWP` varchar(20) DEFAULT NULL,
  `ALAMAT` text DEFAULT NULL,
  `TEMPAT_LAHIR` varchar(50) DEFAULT NULL,
  `TANGGAL_LAHIR` date DEFAULT NULL,
  `ID_GROUP` int(11) DEFAULT NULL,
  `APPROVE` varchar(1) DEFAULT '0' COMMENT '0 = NEW, 1 = APPROVED, 2 = REJECTED',
  `APPROVED_BY` varchar(11) DEFAULT NULL,
  `APPROVED_DATE` timestamp NULL DEFAULT NULL,
  `CATATAN` text DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `MST_PERUSAHAAN`
--

CREATE TABLE `MST_PERUSAHAAN` (
  `ID` varchar(11) NOT NULL,
  `NAMA_PERUSAHAAN` varchar(100) NOT NULL,
  `NPWP` varchar(20) DEFAULT NULL,
  `ALAMAT` text DEFAULT NULL,
  `NO_TELP` varchar(12) DEFAULT NULL,
  `EMAIL` varchar(200) DEFAULT NULL,
  `CONTACT_PERSON` varchar(50) DEFAULT NULL,
  `STATUS` int(11) DEFAULT 1 COMMENT '1 = ACTIVE, 0 = NON ACTIVE',
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `MST_TKI`
--

CREATE TABLE `MST_TKI` (
  `ID` varchar(11) NOT NULL,
  `NIK` varchar(16) DEFAULT NULL,
  `MAID_CODE` varchar(12) DEFAULT NULL,
  `NAMA` varchar(100) DEFAULT NULL,
  `PASSPORT` varchar(11) DEFAULT NULL,
  `TEMPAT_LAHIR` varchar(50) DEFAULT NULL,
  `TANGGAL_LAHIR` date DEFAULT NULL,
  `JENIS_KELAMIN` varchar(1) DEFAULT NULL COMMENT 'L = LAKI LAKI, P = PEREMPUAN',
  `TINGGI_BADAN` varchar(3) DEFAULT '0',
  `BERAT_BADAN` varchar(3) DEFAULT '0',
  `KEWARGANEGARAAN` varchar(3) DEFAULT NULL,
  `NEGARA_ASAL` varchar(50) DEFAULT NULL,
  `AGAMA` varchar(10) DEFAULT NULL,
  `JML_SAUDARA` varchar(2) DEFAULT '0',
  `ANAK_KE` varchar(2) DEFAULT '0',
  `STATUS_NIKAH` varchar(1) DEFAULT NULL,
  `JML_ANAK` varchar(2) DEFAULT '0',
  `PENDIDIKAN_TERAKHIR` varchar(3) DEFAULT NULL,
  `ALAMAT_LENGKAP` text NOT NULL,
  `APPROVE` varchar(1) NOT NULL DEFAULT '0' COMMENT '0 = NEW, 1 = APPROVED, 2 = REJECTED',
  `APPROVED_BY` varchar(11) DEFAULT NULL,
  `APPROVED_DATE` timestamp NULL DEFAULT NULL,
  `CATATAN` text DEFAULT NULL,
  `ID_GROUP` varchar(3) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `MST_TKI`
--
DELIMITER $$
CREATE TRIGGER `UpdateApprovalDataDiri` AFTER UPDATE ON `MST_TKI` FOR EACH ROW UPDATE JUSTIFIKASI_PEKERJAAN SET DATA_DIRI_APPROVAL = new.APPROVE, APPROVED_BY_1 = new.APPROVED_BY, APPROVED_DATE_1 = new.APPROVED_DATE WHERE ID_TKI = new.ID
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `RIWAYAT_PEKERJAAN`
--

CREATE TABLE `RIWAYAT_PEKERJAAN` (
  `ID` varchar(11) NOT NULL,
  `ID_TKI` varchar(11) NOT NULL,
  `ID_PEKERJAAN` varchar(11) NOT NULL,
  `LAMA_BEKERJA` varchar(2) DEFAULT NULL,
  `SATUAN_LAMA_BEKERJA` varchar(20) DEFAULT NULL,
  `LOKASI` varchar(50) DEFAULT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 = ACTIVE, 0 = NON ACTIVE',
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TB_EVENTTYPE`
--

CREATE TABLE `TB_EVENTTYPE` (
  `ID` int(11) NOT NULL,
  `EVENT` text NOT NULL,
  `DETAIL` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TB_GROUP`
--

CREATE TABLE `TB_GROUP` (
  `ID` int(11) NOT NULL,
  `ID_PERUSAHAAN` varchar(11) NOT NULL,
  `KET` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TB_JENIS_DOK`
--

CREATE TABLE `TB_JENIS_DOK` (
  `ID` varchar(11) NOT NULL,
  `NAMA_DOKUMEN` varchar(50) NOT NULL,
  `ALIAS` varchar(10) NOT NULL,
  `JENIS` varchar(1) DEFAULT NULL COMMENT '1 = Doc Wajib CTKI, 2 = Doc Wajib Penyalur, NULL = Doc Surat/Dokumen',
  `STATUS` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 = ACTIVE, 0 = NON ACTIVE',
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TB_JENIS_DOK`
--

INSERT INTO `TB_JENIS_DOK` (`ID`, `NAMA_DOKUMEN`, `ALIAS`, `JENIS`, `STATUS`, `UPDATE_DATE`, `INSERT_DATE`, `CREATED_BY`) VALUES
('26955576485', 'DOKUMEN KONTRAK', '', NULL, '1', '2021-07-24 12:36:03', '2021-04-30 18:36:49', '77739680169'),
('29836358418', 'PASSPORT', '', '1', '1', '2021-07-24 12:36:03', '2021-04-30 18:38:24', '77739680169'),
('50132812553', 'AKTE KELAHIRAN', '', '1', '1', '2021-07-24 12:36:03', '2021-04-30 18:36:41', '77739680169'),
('53890630510', 'SURAT KETERANGANAN CATATAN KEPOLISIAN', 'SKCK', '1', '1', '2021-07-24 12:36:03', '2021-04-30 18:38:54', '77739680169'),
('72800662015', 'KARTU TANDA PENDUDUK', 'KTP', '1', '1', '2021-07-24 12:36:03', '2021-04-30 18:38:01', '77739680169'),
('79014042052', 'SURAT IZIN KELUARGA', '', '1', '1', '2021-07-24 12:36:03', '2021-04-30 18:38:36', '77739680169'),
('83457374256', 'IJAZAH', '', '1', '1', '2021-07-24 12:36:03', '2021-04-30 18:37:31', '77739680169'),
('95164479391', 'DOKUMEN SURAT PERJANJIAN', '', NULL, '1', '2021-07-24 12:36:03', '2021-04-30 18:37:19', '77739680169'),
('95516593229', 'DOKUMEN PERSETUJUAN TKI', '', NULL, '1', '2021-07-24 12:36:03', '2021-04-30 18:37:00', '77739680169'),
('95932287375', 'PAS FOTO', '', '1', '1', '2021-07-24 12:36:03', '2021-04-30 18:38:15', '77739680169'),
('99082695476', 'KARTU KELUARGA', 'KK', '1', '1', '2021-07-24 12:36:03', '2021-04-30 18:37:49', '77739680169');

-- --------------------------------------------------------

--
-- Table structure for table `TB_KONTEN`
--

CREATE TABLE `TB_KONTEN` (
  `ID` varchar(11) NOT NULL,
  `JENIS_KONTEN` varchar(2) NOT NULL COMMENT '1 = Pengumuman, 2 = Karir, 3 = Berita',
  `JUDUL` varchar(200) NOT NULL,
  `DESKRIPSI` text NOT NULL,
  `PIC` varchar(200) DEFAULT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1',
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TB_KONTEN`
--

INSERT INTO `TB_KONTEN` (`ID`, `JENIS_KONTEN`, `JUDUL`, `DESKRIPSI`, `PIC`, `STATUS`, `UPDATE_DATE`, `INSERT_DATE`, `CREATED_BY`) VALUES
('10820095809', '1', 'LOWONGAN DI NEGARA SINGAPORE', '<p>DIBUTUHKAN CTKI!</p><p>JOBDESK :<br>-Menjaga Anak dengan waktu kerja yang tidak ditentukan<br>-Memasak untuk orang rumah<br>-Memandikan Anak 2x sehari<br>-Membersihkan seluruh rumah<br>-Mencuci Baju</p>', NULL, '1', '2021-07-24 12:36:03', '2021-05-30 02:50:21', '63935625183');

-- --------------------------------------------------------

--
-- Table structure for table `TB_KONTRAK`
--

CREATE TABLE `TB_KONTRAK` (
  `ID` varchar(11) NOT NULL,
  `NO` int(11) NOT NULL,
  `NO_KONTRAK` varchar(20) DEFAULT NULL,
  `ID_PERUSAHAAN` varchar(11) DEFAULT NULL,
  `LAMA_KONTRAK` varchar(2) DEFAULT NULL,
  `SATUAN_LAMA_KONTRAK` varchar(5) DEFAULT NULL COMMENT 'TAHUN, BULAN, HARI',
  `TANGGAL_MULAI` date DEFAULT NULL,
  `TANGGAL_SELESAI` date DEFAULT NULL,
  `WAKTU_KERJA` varchar(2) DEFAULT NULL,
  `SATUAN_WAKTU_KERJA` varchar(5) DEFAULT NULL,
  `JAM_PERHARI` varchar(2) DEFAULT NULL,
  `JAM_PERMINGGU` varchar(2) DEFAULT NULL,
  `ID_PEKERJAAN` varchar(11) DEFAULT NULL,
  `TGL_PEMBERIAN_GAJI` varchar(2) DEFAULT NULL,
  `JUMLAH_GAPOK` int(11) DEFAULT NULL,
  `TUNJANGAN_KESEHATAN` int(11) DEFAULT NULL,
  `TUNJANGAN_TRANSPORTASI` int(11) DEFAULT NULL,
  `UANG_KERAJINAN` int(11) DEFAULT NULL,
  `BIAYA_PENGOBATAN` int(11) DEFAULT NULL,
  `CUTI_TAHUNAN` varchar(2) DEFAULT NULL,
  `SYARAT_UNDURDIRI` varchar(2) DEFAULT NULL,
  `WAKTU_UNDURDIRI` varchar(2) DEFAULT NULL,
  `TGL_PENGESAHAN` date DEFAULT NULL,
  `ID_DOKUMEN` varchar(11) DEFAULT NULL,
  `PIHAK_PERTAMA` varchar(200) DEFAULT NULL,
  `PIHAK_KEDUA` varchar(200) DEFAULT NULL,
  `STATUS` varchar(1) DEFAULT '1' COMMENT '1 = ACTIVE, 0 = NON ACTIVE',
  `CATATAN` text DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TB_KUALIFIKASI`
--

CREATE TABLE `TB_KUALIFIKASI` (
  `ID` varchar(11) NOT NULL,
  `PERTANYAAN` text NOT NULL,
  `JENIS` varchar(2) NOT NULL DEFAULT '0' COMMENT '1 = Pilihan',
  `STATUS` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 = ACTIVE, 0 = NON ACTIVE',
  `CATATAN` text DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TB_KUALIFIKASI`
--

INSERT INTO `TB_KUALIFIKASI` (`ID`, `PERTANYAAN`, `JENIS`, `STATUS`, `CATATAN`, `UPDATE_DATE`, `INSERT_DATE`, `CREATED_BY`) VALUES
('58575113282', 'APAKAH MEMILIKI PENYAKIT ?', '1', '1', '', '2021-07-24 12:36:03', '2021-05-30 02:39:46', '63935625183'),
('67573529266', 'APAKAH SIAP UNTUK BEKERJA DIMALAM HARI?', '1', '1', '', '2021-07-24 12:36:03', '2021-05-30 02:42:42', '63935625183');

-- --------------------------------------------------------

--
-- Table structure for table `TB_LOWONGAN`
--

CREATE TABLE `TB_LOWONGAN` (
  `ID` varchar(11) NOT NULL,
  `JOB` varchar(200) NOT NULL,
  `JENIS_PEKERJAAN` varchar(11) NOT NULL,
  `DESKRIPSI` text NOT NULL,
  `NEGARA` varchar(100) DEFAULT NULL,
  `ALAMAT_LOKASI` text DEFAULT NULL,
  `IS_COMPANY` varchar(1) NOT NULL COMMENT 'Y = Company, N = Non Company',
  `PENERIMA_JASA` varchar(300) DEFAULT NULL,
  `EMAIL_PJ` varchar(200) DEFAULT NULL,
  `KODE_PJ` varchar(20) DEFAULT NULL,
  `JUMLAH_GAPOK` int(11) DEFAULT NULL,
  `TUNJANGAN_KESEHATAN` int(11) DEFAULT NULL,
  `TUNJANGAN_TRANSPORTASI` int(11) DEFAULT NULL,
  `UANG_KERAJINAN` int(11) DEFAULT NULL,
  `BIAYA_PENGOBATAN` int(11) DEFAULT NULL,
  `CUTI_TAHUNAN` int(11) DEFAULT NULL,
  `LAMA_BEKERJA` int(11) DEFAULT NULL,
  `SATUAN_LAMA_BEKERJA` varchar(5) DEFAULT NULL COMMENT 'TAHUN, BULAN, HARI',
  `WAKTU_KERJA` varchar(2) DEFAULT NULL,
  `SATUAN_WAKTU_KERJA` varchar(5) DEFAULT NULL,
  `JAM_PERHARI` varchar(2) DEFAULT NULL,
  `JAM_PERMINGGU` varchar(2) DEFAULT NULL,
  `SLOT_PEKERJAAN` int(11) DEFAULT 1,
  `IS_USED` varchar(1) NOT NULL DEFAULT 'N',
  `STATUS` varchar(1) NOT NULL DEFAULT '1',
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TB_LOWONGAN`
--

INSERT INTO `TB_LOWONGAN` (`ID`, `JOB`, `JENIS_PEKERJAAN`, `DESKRIPSI`, `NEGARA`, `ALAMAT_LOKASI`, `IS_COMPANY`, `PENERIMA_JASA`, `EMAIL_PJ`, `KODE_PJ`, `JUMLAH_GAPOK`, `TUNJANGAN_KESEHATAN`, `TUNJANGAN_TRANSPORTASI`, `UANG_KERAJINAN`, `BIAYA_PENGOBATAN`, `CUTI_TAHUNAN`, `LAMA_BEKERJA`, `SATUAN_LAMA_BEKERJA`, `WAKTU_KERJA`, `SATUAN_WAKTU_KERJA`, `JAM_PERHARI`, `JAM_PERMINGGU`, `SLOT_PEKERJAAN`, `IS_USED`, `STATUS`, `UPDATE_DATE`, `INSERT_DATE`, `CREATED_BY`) VALUES
('38083034355', 'BABY SITTER', '82037052359', 'TAKE CARE BABY', '', 'SEDNEY STREETS', 'N', 'AGNES', 'cippaa19@gmail.com', '232342423', 6000000, 1000000, 500000, 200000, 650000, 12, 2, 'TAHUN', '6', 'HARI', '12', NULL, 10, 'N', '1', '2021-07-24 12:36:03', '2021-07-22 02:49:10', '70702061090'),
('49872239999', 'LOWONGAN SUPIR', '82037052359', 'NYUPIR', 'ID', 'CIBARUSAH', 'N', 'RUMAH BELAJAR', 'angeloasyifa21@gmail.com', '328795', 3400000, 20000, 20000, 35000, 120000, 2, 1, 'TAHUN', '29', 'HARI', '8', NULL, 4, 'N', '1', '2021-07-24 12:36:03', '2021-06-28 05:55:19', '63935625183'),
('62940692053', 'LOWONGAN PRT', '82037052359', 'MENYAPU MENCUCI PIRING', 'ID', 'JL.PROF SOEPOMO', 'N', 'PANTI JUMPO', 'jaenab@office.com', '32958675474', 300000, 25000, 30000, 230000, 20000, 2, 2, 'TAHUN', '30', 'HARI', '12', NULL, 5, 'N', '1', '2021-07-24 12:36:03', '2021-07-15 03:50:30', '70702061090'),
('71551886966', 'BABY SITTER', '82037052359', 'TAKE CARE BABY', '', 'JL. ASIA AFRIKA', 'N', 'AGNES ', 'angeloasyifa21@gmail.com', '2913023822921', 6000000, 1000000, 500000, 200000, 500000, 12, 2, 'TAHUN', '6', 'HARI', '12', NULL, 6, 'N', '1', '2021-07-24 12:36:03', '2021-07-22 03:05:03', '70702061090'),
('74835702502', 'LOWONGAN PRT', '82037052359', 'CUCI PIRING CUCI BAJU', 'ID', 'TAMAN RAHAYU', 'N', 'RUMAH HANTU', 'angeloasyifa21@gmail.com', '345623', 4000000, 150000, 350000, 200000, 2000000, 2, 2, 'TAHUN', '29', 'HARI', '12', NULL, 5, 'N', '1', '2021-07-24 12:36:03', '2021-06-26 10:11:03', '70702061090'),
('92137633702', 'BABY SITTER', '82037052359', 'TAKE CARE BABY', '', 'JL TOA PA YO', 'N', 'AGNES ', 'angeloasyifa21@gmail.com', '2913023822921', 6000000, 1000000, 500000, 200000, 650000, 12, 2, 'TAHUN', '6', 'HARI', '12', NULL, 6, 'N', '1', '2021-07-24 12:36:03', '2021-07-22 03:07:45', '63935625183'),
('96459870264', 'BABY SITTER', '82037052359', 'BABY SITTER', 'AU', 'SEDNEY STREET', 'N', 'BABY SITTER', 'cippaa19@gmail.com', '39284923742', 6000000, 1000000, 500000, 200000, 650000, 12, 2, 'TAHUN', '6', 'HARI', '12', NULL, 10, 'N', '1', '2021-07-24 12:36:03', '2021-07-20 16:51:23', '63935625183');

-- --------------------------------------------------------

--
-- Table structure for table `TB_MENU`
--

CREATE TABLE `TB_MENU` (
  `ID` int(11) NOT NULL,
  `NAMA_MENU` varchar(30) DEFAULT NULL,
  `URL` text DEFAULT NULL,
  `ROLE` varchar(7) DEFAULT NULL,
  `IS_PARENT` varchar(1) DEFAULT NULL,
  `PARENT` varchar(2) DEFAULT NULL,
  `CHILD` varchar(2) DEFAULT NULL,
  `SUBCHILD` varchar(2) DEFAULT NULL,
  `MENU` varchar(2) DEFAULT NULL,
  `MENU_TEXT` varchar(30) DEFAULT NULL,
  `URUTAN` int(11) DEFAULT NULL,
  `ICON` text DEFAULT NULL,
  `REMARK` text DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TB_MENU`
--

INSERT INTO `TB_MENU` (`ID`, `NAMA_MENU`, `URL`, `ROLE`, `IS_PARENT`, `PARENT`, `CHILD`, `SUBCHILD`, `MENU`, `MENU_TEXT`, `URUTAN`, `ICON`, `REMARK`, `UPDATE_DATE`, `INSERT_DATE`) VALUES
(1, 'DASHBOARD', 'index.php/Main', '0|1|2|3', 'Y', '1', 'N', NULL, '1', 'MENU', 1, 'nav-icon fas fa-tachometer-alt', NULL, '2021-07-24 12:36:03', '2021-04-15 22:31:55'),
(2, 'TKI', '#', '1|2|3', 'Y', '2', 'Y', NULL, '1', 'MENU', 5, 'nav-icon fas fa-users', NULL, '2021-07-24 12:36:03', '2021-04-15 22:31:55'),
(3, 'KONTRAK', '#', '1|2|3', 'Y', '3', 'Y', NULL, '1', 'MENU', 10, 'nav-icon fas fa-file-contract', NULL, '2021-07-24 12:36:03', '2021-04-15 22:33:07'),
(4, 'PEKERJAAN', '#', '1|2|3', 'Y', '4', 'Y', NULL, '1', 'MENU', 20, 'nav-icon fas fa-briefcase', NULL, '2021-07-24 12:36:03', '2021-04-15 22:33:07'),
(5, 'PENYALUR', '#', '1|2', 'Y', '5', 'Y', NULL, '1', 'MENU', 25, 'nav-icon fas fa-user', NULL, '2021-07-24 12:36:03', '2021-04-15 22:33:07'),
(6, 'SURAT PERJANJIAN', '#', '1|2|3', 'Y', '6', 'Y', NULL, '1', 'MENU', 30, 'nav-icon fas fa-handshake', NULL, '2021-07-24 12:36:03', '2021-04-15 22:33:07'),
(7, 'MASTER DATA', '#', '0|1|2', 'Y', '7', 'Y', NULL, '2', 'MASTER DATA', 40, 'nav-icon fas fa-database', NULL, '2021-07-24 12:36:03', '2021-04-15 22:33:07'),
(8, 'Pendaftaran CTKI', 'index.php/Tki/', '3', NULL, '2', NULL, NULL, '1', 'MENU', 6, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:37:14'),
(9, 'Approve Profil CTKI', 'index.php/Tki/approve', '1', NULL, '2', NULL, NULL, '1', 'MENU', 7, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:37:14'),
(10, 'Cari Kontrak', 'index.php/Kontrak/cari', '1|2|3', NULL, '3', NULL, NULL, '1', 'MENU', 11, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:38:54'),
(11, 'Manage Kontrak', 'index.php/Kontrak/all', '1|2', NULL, '3', NULL, NULL, '1', 'MENU', 12, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:38:54'),
(12, 'Pengajuan Pekerjaan', 'index.php/Pekerjaan/pengajuan', '3', NULL, '4', NULL, NULL, '1', 'MENU', 21, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:42:34'),
(13, 'Pekerjaan Aktif', 'index.php/Pekerjaan/aktif', '1|2|3', NULL, '4', NULL, NULL, '1', 'MENU', 22, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:42:34'),
(14, 'Pendaftaran Penyalur', 'index.php/Penyalur/pengajuan', '1', NULL, '5', NULL, NULL, '1', 'MENU', 26, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:43:21'),
(15, 'Approve Penyalur', 'index.php/Penyalur/approve', '2', NULL, '5', NULL, NULL, '1', 'MENU', 27, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:43:21'),
(16, 'Cari Surat Perjanjian', 'index.php/Perjanjian/cari', '1|2|3', NULL, '6', NULL, NULL, '1', 'MENU', 31, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:44:23'),
(17, 'Manage Surat Perjanjian', 'index.php/Perjanjian/all', '1|2', NULL, '6', NULL, NULL, '1', 'MENU', 32, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:44:23'),
(18, 'MASTER KONTEN', '#', '0', 'Y', '18', 'Y', NULL, '3', 'MASTER KONTEN', 50, 'nav-icon fas fa-paint-brush', NULL, '2021-07-24 12:36:03', '2021-04-15 22:45:54'),
(19, 'Master Jenis Dok', 'index.php/master/Dokumen', '0|1', NULL, '7', NULL, NULL, '2', 'MASTER DATA', 41, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:46:34'),
(20, 'Master Kualifikasi', 'index.php/master/Kualifikasi', '0|1', NULL, '7', NULL, NULL, '2', 'MASTER DATA', 42, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:46:34'),
(21, 'Master Pekerjaan', 'index.php/master/Pekerjaan', '0|1', NULL, '7', NULL, NULL, '2', 'MASTER DATA', 43, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:47:44'),
(22, 'Master Perusahaan', 'index.php/master/Perusahaan', '0|1|2', NULL, '7', NULL, NULL, '2', 'MASTER DATA', 44, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:47:44'),
(23, 'Master TKI', NULL, '-', NULL, '7', NULL, NULL, '2', 'MASTER DATA', 45, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:47:44'),
(24, 'Master User', 'index.php/master/User', '0|1', NULL, '7', NULL, NULL, '2', 'MASTER DATA', 46, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:47:44'),
(25, 'Pengumuman', 'index.php/master/Pengumuman', '0|1', NULL, '18', NULL, NULL, '3', 'MASTER KONTEN', 52, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:49:14'),
(26, 'Berita', 'index.php/master/Berita', '0|1', NULL, '18', NULL, NULL, '3', 'MASTER KONTEN', 53, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:49:14'),
(27, 'Karir', 'index.php/master/Karir', '0|1', NULL, '18', NULL, NULL, '3', 'MASTER KONTEN', 54, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:49:14'),
(28, 'Manage TKI', 'index.php/Tki/all', '1|2|3', NULL, '2', NULL, NULL, '1', 'MENU', 8, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 23:47:00'),
(29, 'Manage Penyalur', 'index.php/Penyalur/all', '1|2', NULL, '5', NULL, NULL, '1', 'MENU', 28, NULL, NULL, '2021-07-24 12:36:03', '2021-04-17 13:19:42'),
(30, 'Manage Pekerjaan', 'index.php/Pekerjaan/all', '1|2|3', NULL, '4', NULL, NULL, '1', 'MENU', 23, NULL, NULL, '2021-07-24 12:36:03', '2021-04-17 13:29:44'),
(31, 'LOWONGAN', '#', '1|2|3', 'Y', '31', 'Y', NULL, '1', 'MENU', 15, 'nav-icon fas fa-building', NULL, '2021-07-24 12:36:03', '2021-04-17 23:34:37'),
(32, 'Lihat Lowongan', 'index.php/Lowongan/all', '1|2|3', NULL, '31', NULL, NULL, '1', 'MENU', 16, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:37:14'),
(33, 'Master Lowongan', 'index.php/master/Lowongan', '0|1|2', NULL, '7', NULL, NULL, '2', 'MASTER DATA', 47, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:47:44'),
(34, 'Tambah Lowongan', 'index.php/master/Lowongan/add', '1|2', NULL, '31', NULL, NULL, '1', 'MENU', 17, NULL, NULL, '2021-07-24 12:36:03', '2021-04-15 22:37:14'),
(35, 'Dashboard', 'index.php/master/Konten', '0|1', NULL, '18', NULL, NULL, '3', 'MASTER KONTEN', 51, NULL, NULL, '2021-07-24 12:36:03', '2021-04-26 19:39:22'),
(36, 'Setting', 'index.php/master/Setting', NULL, NULL, '18', NULL, NULL, '3', 'MASTER KONTEN', 55, NULL, '0|1', '2021-07-24 12:36:03', '2021-04-15 22:49:14'),
(37, 'LOG', NULL, NULL, 'Y', '37', 'Y', NULL, '4', 'LOG', 66, 'nav-icon fas fa-clipboard-list', '0', '2021-07-24 12:36:03', '2021-05-06 10:07:02'),
(38, 'Login Log', NULL, NULL, NULL, '37', NULL, NULL, '4', 'LOG', 67, NULL, '0', '2021-07-24 12:36:03', '2021-05-06 10:07:02'),
(39, 'Transaction Log', NULL, NULL, NULL, '37', NULL, NULL, '4', 'LOG', 68, NULL, '0', '2021-07-24 12:36:03', '2021-05-06 10:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `TB_NEGARA`
--

CREATE TABLE `TB_NEGARA` (
  `ID` int(11) NOT NULL,
  `NEGARA` varchar(100) DEFAULT NULL,
  `CODE` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TB_NEGARA`
--

INSERT INTO `TB_NEGARA` (`ID`, `NEGARA`, `CODE`) VALUES
(1, 'Indonesia', 'ID'),
(2, 'Taiwan', 'TW'),
(3, 'Singapore', 'SG'),
(4, 'Saudi Arabia', 'AE'),
(5, 'Korea', 'KR'),
(6, 'Malaysia', 'MY');

-- --------------------------------------------------------

--
-- Table structure for table `TB_PEKERJAAN`
--

CREATE TABLE `TB_PEKERJAAN` (
  `ID` varchar(11) NOT NULL,
  `PEKERJAAN` text DEFAULT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 = ACTIVE, 0 = NON ACTIVE',
  `CATATAN` text DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TB_PEKERJAAN`
--

INSERT INTO `TB_PEKERJAAN` (`ID`, `PEKERJAAN`, `STATUS`, `CATATAN`, `UPDATE_DATE`, `INSERT_DATE`, `CREATED_BY`) VALUES
('82037052359', 'PRT', '1', '', '2021-07-24 12:36:03', '2021-05-30 07:51:14', '63935625183');

-- --------------------------------------------------------

--
-- Table structure for table `TB_RULE_ACT`
--

CREATE TABLE `TB_RULE_ACT` (
  `ID` int(11) NOT NULL,
  `JENIS` varchar(50) NOT NULL,
  `TABEL` varchar(30) NOT NULL,
  `ALLOWED_USERS` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TB_RULE_ACT`
--

INSERT INTO `TB_RULE_ACT` (`ID`, `JENIS`, `TABEL`, `ALLOWED_USERS`) VALUES
(1, 'LOGIN', 'MST_USER', '0|1|2|3'),
(2, 'CREATE USER', 'MST_USER', '0|1'),
(3, 'CHANGE ACTIVE STATUS USER', 'MST_USER', '0|1'),
(4, 'SET NEW PASSWORD', 'MST_USER', '0|1|2|3'),
(5, 'RESET PASSWORD', 'MST_USER', '0|1|2|3'),
(6, 'EDIT USER', 'MST_USER', '0|1'),
(7, 'TAMBAH MASTER DOKUMEN', 'MST_JENIS_DOK', '0|1'),
(8, 'TAMBAH MASTER PEKERJAAN', 'MST_PEKERJAAN', '0|1'),
(9, 'CHANGE ACTIVE STATUS PEKERJAAN', 'MST_PEKERJAAN', '0|3'),
(10, 'EDIT PEKERJAAN', 'MST_PEKERJAAN', '0|1'),
(11, 'TAMBAH MASTER KUALIFIKASI', 'MST_KUALIFIKASI', '0|1'),
(12, 'CHANGE ACTIVE STATUS KUALIFIKASI', 'MST_KUALIFIKASI', '0|1'),
(13, 'EDIT KUALIFIKASI', 'MST_KUALIFIKASI', '0|1'),
(14, 'REGISTER DATA DIRI CALON TKI', 'MST_TKI', '3'),
(15, 'INSERT KUALIFIKASI TKI', 'KUALIFIKASI', '3'),
(16, 'INSERT ALAMAT', 'ALAMAT', '3'),
(17, 'PENGAJUAN PEKERJAAN', 'JUSTIFIKASI_PEKERJAAN', '3'),
(18, 'UPLOAD DOKUMEN TKI', 'DOKUMEN', '3'),
(19, 'UPLOAD DOKUMEN', 'DOKUMEN', '1|2|3'),
(20, 'APPROVE/REJECT DATA DAN DOKUMEN TKI', 'MST_TKI', '1'),
(21, 'BUAT SURAT PERJANJIAN', 'MST_SURAT_PERJANJIAN', '1'),
(22, 'UPDATE JUSTIFIKASI SURAT PERJANJIAN', 'JUSTIFIKASI_PEKERJAAN', '1|3'),
(23, 'UPDATE SURAT PERJANJIAN', 'MST_SURAT_PERJANJIAN', '1'),
(24, 'APPROVE/REJECT SURAT PERJANJIAN', 'JUSTIFIKASI_PEKERJAAN', '3'),
(25, 'BUAT KONTRAK', 'MST_KONTRAK', '2'),
(26, 'UPDATE JUSTIFIKASI KONTRAK', 'JUSTIFIKASI_PEKERJAAN', '2|3'),
(27, 'UPDATE KONTRAK', 'MST_KONTRAK', '2'),
(28, 'APPROVE/REJECT KONTRAK', 'JUSTIFIKASI_PEKERJAAN', '3'),
(29, 'PENGAJUAN PENYALUR', 'MST_PENYALUR', '1'),
(30, 'APPROVE/REJECT PENYALUR', 'MST_PENYALUR', '2'),
(31, 'UPDATE PENYALUR', 'MST_PENYALUR', '1'),
(32, 'TRIGGER SQL', 'TRIGGER SQL', NULL),
(33, 'SUBMIT KONTRAK KERJA', 'JUSTIFIKASI_PEKERJAAN', '2'),
(34, 'SUBMIT SURAT PERJANJIAN', 'JUSTIFIKASI_PEKERJAAN', '1'),
(35, 'UPDATE DATA TKI', 'MST_TKI', '3'),
(36, 'UPDATE ALAMAT TKI', 'ALAMAT', '3'),
(37, 'UPDATE KUALIFIKASI', 'KUALIFIKASI', '3'),
(38, 'INSERT PERUSAHAAN', 'MST_PERUSAHAAN', '0|1|2'),
(39, 'INSERT LOWONGAN', 'MST_LOWONGAN', '0|1|2'),
(40, 'ASSIGN PEKERJAAN', 'JUSTIFIKASI_PEKERJAAN', '2'),
(41, 'GENERATE USER PENYALUR', 'MST_USER', '1'),
(42, 'GENERATE GROUP PENYALUR', 'MST_GROUP', '0|1|2'),
(43, 'EDIT KONTEN', 'MST_KONTEN', '0|1'),
(44, 'CHANGE ACTIVE STATUS KONTEN', 'MST_KONTEN', '0|1'),
(45, 'ADD KONTEN', 'MST_KONTEN', '0|1'),
(46, 'DELETE FILE TKI', 'DOKUMEN', '0|3'),
(47, 'DELETE FILE KONTRAK/PERJANJIAN', 'DOKUMEN', '0|1|2|3');

-- --------------------------------------------------------

--
-- Table structure for table `TB_RULE_URL`
--

CREATE TABLE `TB_RULE_URL` (
  `ID` int(11) NOT NULL,
  `URL` text NOT NULL,
  `ALLOWED_ROLE` varchar(7) NOT NULL,
  `REMARK` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TB_RULE_URL`
--

INSERT INTO `TB_RULE_URL` (`ID`, `URL`, `ALLOWED_ROLE`, `REMARK`) VALUES
(1, '', '0|1|2|3', ''),
(2, 'index.php/Tki/', '3', ''),
(3, 'index.php/Tki/approve', '1', ''),
(4, 'index.php/Tki/all', '1|2|3', ''),
(5, 'index.php/Tki/detail', '1|2|3', ''),
(6, 'index.php/Kontrak/cari', '0|1|2|3', ''),
(7, 'index.php/Kontrak/all', '0|1|2|3', ''),
(8, 'index.php/Kontrak/detail', '0|1|2|3', ''),
(9, 'index.php/Lowongan/all', '0|1|2|3', ''),
(10, 'index.php/master/Lowongan/add', '0|1|2', ''),
(11, 'index.php/master/Lowongan', '0|1|2', ''),
(12, 'index.php/Lowongan/all/detail', '0|1|2|3', ''),
(13, 'index.php/Pekerjaan/pengajuan', '0|3', ''),
(14, 'index.php/Pekerjaan/aktif', '0|1|2|3', ''),
(15, 'index.php/Pekerjaan/detail', '0|1|2|3', ''),
(16, 'index.php/Pekerjaan/all', '0|1|2|3', ''),
(17, 'index.php/Pekerjaan/tambah', '0|3', ''),
(18, 'index.php/Pekerjaan/assign', '0|2', ''),
(19, 'index.php/Penyalur/pengajuan', '0|1', ''),
(20, 'index.php/Penyalur/detail', '0|1|2', ''),
(21, 'index.php/Penyalur/approve', '0|2', ''),
(22, 'index.php/Penyalur/all', '0|1|2', ''),
(23, 'index.php/Perjanjian/cari', '0|1|2|3', ''),
(24, 'index.php/Perjanjian/detail', '0|1|2|3', ''),
(25, 'index.php/master/Dokumen', '0|1', ''),
(26, 'index.php/master/Kualifikasi', '0|1', ''),
(27, 'index.php/master/Pekerjaan', '0|1', ''),
(28, 'index.php/master/Perusahaan', '0|1|2', ''),
(29, 'index.php/master/User', '0|1', ''),
(30, 'index.php/master/User/detail', '0|1', ''),
(31, 'index.php/Perjanjian/all', '1|2', ''),
(32, 'index.php/master/Konten', '0|1', ''),
(33, 'index.php/master/Konten/detail/', '0|1', ''),
(34, 'index.php/master/Pengumuman/', '0|1', ''),
(35, 'index.php/master/Karir/', '0|1', ''),
(36, 'index.php/master/Berita/', '0|1', ''),
(37, 'index.php/master/Konten/add/', '0|1', '');

-- --------------------------------------------------------

--
-- Table structure for table `TB_SETTING`
--

CREATE TABLE `TB_SETTING` (
  `ID` int(11) NOT NULL,
  `TYPE` varchar(100) NOT NULL,
  `JENIS` varchar(2) NOT NULL,
  `TITLE` varchar(200) NOT NULL,
  `CONTENT` text NOT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TB_SETTING`
--

INSERT INTO `TB_SETTING` (`ID`, `TYPE`, `JENIS`, `TITLE`, `CONTENT`, `UPDATE_DATE`, `INSERT_DATE`, `CREATED_BY`) VALUES
(1, 'ABOUT-US', '1', 'Empowering individual', 'Efficiently unleash cross-media tour function information without cross action media value. Quickly maximize timely deliverables for real-time schemas.', '2021-07-24 12:36:03', '2021-04-27 04:52:02', '33730380207'),
(4, 'COPYRIGHT', '1', '', 'CTKI 2021', '2021-07-24 12:36:03', '2021-04-26 20:52:02', '33730380207');

-- --------------------------------------------------------

--
-- Table structure for table `TB_SURAT_PERJANJIAN`
--

CREATE TABLE `TB_SURAT_PERJANJIAN` (
  `ID` varchar(11) NOT NULL,
  `NO` int(11) NOT NULL,
  `NOMOR_SURAT` varchar(100) DEFAULT NULL,
  `NAMA_PJ` varchar(50) DEFAULT NULL,
  `NIK_PJ` varchar(20) DEFAULT NULL,
  `TMP_LAHIR_PJ` varchar(100) DEFAULT NULL,
  `TGL_LAHIR_PJ` date DEFAULT NULL,
  `JABATAN_PJ` varchar(50) DEFAULT NULL,
  `ALAMAT_PJ` text DEFAULT NULL,
  `NOMOR_SK` varchar(20) DEFAULT NULL,
  `TANGGAL_SK` date DEFAULT NULL,
  `ID_TKI` varchar(11) DEFAULT NULL,
  `NEGARA_TUJUAN` varchar(100) DEFAULT NULL,
  `ALAMAT` text DEFAULT NULL,
  `TANGGAL_PENGESAHAN` date DEFAULT NULL,
  `CATATAN` text DEFAULT NULL,
  `ID_DOKUMEN` varchar(11) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TB_USER`
--

CREATE TABLE `TB_USER` (
  `ID` varchar(11) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL DEFAULT '575f5d6cef70204485e63956d4366546' COMMENT 'DEFAULT ctki2021',
  `NAMA` varchar(100) NOT NULL,
  `JENIS` varchar(1) NOT NULL DEFAULT '3' COMMENT ' 0 = SUPERADMIN, 1 = ADMIN, 2 = MANAGER, 3 = PENYALUR, 4 = UNASSIGNED',
  `ID_GROUP` varchar(3) DEFAULT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 = ACTIVE, 0 = NONACTIVE',
  `AKTIVASI` varchar(1) NOT NULL DEFAULT '0',
  `ID_PENYALUR` varchar(11) DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TB_USER`
--

INSERT INTO `TB_USER` (`ID`, `USERNAME`, `PASSWORD`, `NAMA`, `JENIS`, `ID_GROUP`, `STATUS`, `AKTIVASI`, `ID_PENYALUR`, `UPDATE_DATE`, `INSERT_DATE`, `CREATED_BY`) VALUES
('05822747243', 'rizal', '575f5d6cef70204485e63956d4366546', 'RIZAL', '3', '4', '1', '0', '51768028119', '2021-07-24 12:36:03', '2021-07-20 18:17:12', '70702061090'),
('12205428825', 'safira', 'ef77dc208893e4a5affef5f3bff49316', 'SAFIRA', '3', '4', '1', '1', '89595150334', '2021-07-24 12:36:03', '2021-06-28 11:33:03', '70702061090'),
('14280001433', 'sitinur', 'b2693d9c2124f3ca9547b897794ac6a1', 'SITI NUR MAYA RINI', '3', '1', '1', '1', '64298740467', '2021-07-24 12:36:03', '2021-04-30 18:35:14', '46204811185'),
('21820778902', 'intan', '575f5d6cef70204485e63956d4366546', 'INTAN', '3', '1', '1', '0', '55111876473', '2021-07-24 12:36:03', '2021-06-28 09:15:26', '70702061090'),
('24913227228', 'atika', '575f5d6cef70204485e63956d4366546', 'ATIKA', '3', '1', '1', '1', '99488745340', '2021-07-24 12:36:03', '2021-05-28 11:09:47', '70702061090'),
('25538791598', 'tiara', '575f5d6cef70204485e63956d4366546', 'TIARA', '3', '2', '1', '0', '39826788475', '2021-07-24 12:36:03', '2021-06-28 07:29:24', '70702061090'),
('33306058033', 'asyifa', '575f5d6cef70204485e63956d4366546', 'ASYIFA HERSUMULYOASTUTI', '2', '-', '1', '0', NULL, '2021-07-24 12:36:03', '2021-07-20 16:33:02', '63935625183'),
('33427054656', 'udin', '575f5d6cef70204485e63956d4366546', 'UDIN', '3', '2', '1', '1', '69136096396', '2021-07-24 12:36:03', '2021-06-27 11:31:13', '70702061090'),
('33730380207', 'ferial', 'c93ccd78b2076528346216b3b2f701e6', 'FERIAL FAHLEVI', '0', '-', '1', '1', NULL, '2021-07-24 12:36:03', '0000-00-00 00:00:00', '33730380207'),
('43632169105', 'testingmanager2', '575f5d6cef70204485e63956d4366546', 'TESTING MANAGER', '2', '-', '1', '1', NULL, '2021-07-24 12:36:03', '2021-05-28 12:48:22', '33730380207'),
('46204811185', 'irfandaru', 'ff16303c79e6c52677d934df1f13d23c', 'IRFAN DARU AQILLIAN', '2', '-', '0', '1', NULL, '2021-07-24 12:36:03', '2021-04-30 18:20:58', '33730380207'),
('49262817821', 'indah', 'ef77dc208893e4a5affef5f3bff49316', 'INDAH', '3', '3', '1', '1', '77103306695', '2021-07-24 12:36:03', '2021-07-15 03:37:18', '70702061090'),
('55650904902', 'testingpenyalur', '575f5d6cef70204485e63956d4366546', 'TESTING PENYALUR', '3', '1', '1', '1', '00418757945', '2021-07-24 12:36:03', '2021-05-28 12:49:49', '43632169105'),
('63935625183', 'testingadmin1', 'ef77dc208893e4a5affef5f3bff49316', 'TESTING ADMIN 1', '1', '-', '1', '1', NULL, '2021-07-24 12:36:03', '2021-05-04 04:03:13', '33730380207'),
('67027419424', 'imam', 'ef77dc208893e4a5affef5f3bff49316', 'IMAM', '3', '2', '1', '1', '20457953445', '2021-07-24 12:36:03', '2021-06-26 10:56:01', '70702061090'),
('68119264882', 'anggi', 'ef77dc208893e4a5affef5f3bff49316', 'ANGGI', '3', '3', '1', '1', '38398129424', '2021-07-24 12:36:03', '2021-06-29 12:49:31', '70702061090'),
('70702061090', 'testingmanager1', '575f5d6cef70204485e63956d4366546', 'TESTING MANAGER 1', '2', '-', '1', '1', NULL, '2021-07-24 12:36:03', '2021-05-04 04:03:34', '33730380207'),
('71429349783', 'ivon', 'ef77dc208893e4a5affef5f3bff49316', 'IVON', '3', '6', '0', '1', '44684600316', '2021-07-24 12:36:03', '2021-07-18 07:01:12', '70702061090'),
('77739680169', 'delia', '83007ab0b22d51bc6cfa53fc21787257', 'DELIA ULFA', '1', '-', '1', '1', NULL, '2021-07-24 12:36:03', '2021-04-30 18:14:17', '33730380207'),
('77948121680', 'amel', 'ef77dc208893e4a5affef5f3bff49316', 'AMEL', '3', '2', '1', '1', '11789424119', '2021-07-24 12:36:03', '2021-06-28 05:46:48', '70702061090'),
('86629414379', 'resti', 'ef77dc208893e4a5affef5f3bff49316', 'RESTI', '3', '1', '1', '1', '05246530671', '2021-07-24 12:36:03', '2021-06-26 09:50:47', '70702061090'),
('87429290576', 'testingadmin2', '575f5d6cef70204485e63956d4366546', 'TESTING ADMIN', '1', '-', '1', '1', NULL, '2021-07-24 12:36:03', '2021-05-28 12:36:19', '33730380207');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `DOKUMEN`
--
ALTER TABLE `DOKUMEN`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_JENIS_DOK` (`ID_JENIS_DOK`),
  ADD KEY `ID_KONTRAK` (`ID_KONTRAK`),
  ADD KEY `ID_PERJANJIAN` (`ID_PERJANJIAN`),
  ADD KEY `ID_TKI` (`ID_TKI`),
  ADD KEY `CREATED_BY` (`CREATED_BY`);

--
-- Indexes for table `JUSTIFIKASI_PEKERJAAN`
--
ALTER TABLE `JUSTIFIKASI_PEKERJAAN`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID_KONTRAK` (`ID_KONTRAK`),
  ADD UNIQUE KEY `ID_PERJANJIAN` (`ID_PERJANJIAN`),
  ADD KEY `CREATED_BY` (`CREATED_BY`),
  ADD KEY `ID_PEKERJAAN` (`ID_PEKERJAAN`),
  ADD KEY `ID_TKI` (`ID_TKI`),
  ADD KEY `APPROVED_BY_1` (`APPROVED_BY_1`),
  ADD KEY `APPROVED_BY_2` (`APPROVED_BY_2`),
  ADD KEY `APPROVED_BY_3` (`APPROVED_BY_3`);

--
-- Indexes for table `KUALIFIKASI`
--
ALTER TABLE `KUALIFIKASI`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_KUALIFIKASI` (`ID_KUALIFIKASI`),
  ADD KEY `ID_TKI` (`ID_TKI`),
  ADD KEY `CREATED_BY` (`CREATED_BY`);

--
-- Indexes for table `LOG`
--
ALTER TABLE `LOG`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_USER` (`ID_USER`),
  ADD KEY `JENIS` (`JENIS`);

--
-- Indexes for table `LOG_EVENT`
--
ALTER TABLE `LOG_EVENT`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `MST_PENYALUR`
--
ALTER TABLE `MST_PENYALUR`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `APPROVED_BY` (`APPROVED_BY`),
  ADD KEY `CREATED_BY` (`CREATED_BY`),
  ADD KEY `ID_GROUP` (`ID_GROUP`);

--
-- Indexes for table `MST_PERUSAHAAN`
--
ALTER TABLE `MST_PERUSAHAAN`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `NPWP` (`NPWP`);

--
-- Indexes for table `MST_TKI`
--
ALTER TABLE `MST_TKI`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `NIK` (`NIK`),
  ADD KEY `APPROVED_BY` (`APPROVED_BY`),
  ADD KEY `CREATED_BY` (`CREATED_BY`);

--
-- Indexes for table `RIWAYAT_PEKERJAAN`
--
ALTER TABLE `RIWAYAT_PEKERJAAN`
  ADD KEY `CREATED_BY` (`CREATED_BY`),
  ADD KEY `ID_PEKERJAAN` (`ID_PEKERJAAN`),
  ADD KEY `ID_TKI` (`ID_TKI`);

--
-- Indexes for table `TB_EVENTTYPE`
--
ALTER TABLE `TB_EVENTTYPE`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `TB_GROUP`
--
ALTER TABLE `TB_GROUP`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_PERUSAHAAN` (`ID_PERUSAHAAN`);

--
-- Indexes for table `TB_JENIS_DOK`
--
ALTER TABLE `TB_JENIS_DOK`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CREATED_BY` (`CREATED_BY`);

--
-- Indexes for table `TB_KONTEN`
--
ALTER TABLE `TB_KONTEN`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `TB_KONTRAK`
--
ALTER TABLE `TB_KONTRAK`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `NO` (`NO`),
  ADD UNIQUE KEY `NO_KONTRAK` (`NO_KONTRAK`),
  ADD KEY `ID_PEKERJAAN` (`ID_PEKERJAAN`),
  ADD KEY `ID_PERUSAHAAN` (`ID_PERUSAHAAN`);

--
-- Indexes for table `TB_KUALIFIKASI`
--
ALTER TABLE `TB_KUALIFIKASI`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CREATED_BY` (`CREATED_BY`);

--
-- Indexes for table `TB_LOWONGAN`
--
ALTER TABLE `TB_LOWONGAN`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `TB_MENU`
--
ALTER TABLE `TB_MENU`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `TB_NEGARA`
--
ALTER TABLE `TB_NEGARA`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `TB_PEKERJAAN`
--
ALTER TABLE `TB_PEKERJAAN`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CREATED_BY` (`CREATED_BY`);

--
-- Indexes for table `TB_RULE_ACT`
--
ALTER TABLE `TB_RULE_ACT`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `TB_RULE_URL`
--
ALTER TABLE `TB_RULE_URL`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `TB_SETTING`
--
ALTER TABLE `TB_SETTING`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `TB_SURAT_PERJANJIAN`
--
ALTER TABLE `TB_SURAT_PERJANJIAN`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `NO` (`NO`),
  ADD KEY `ID_DOKUMEN` (`ID_DOKUMEN`),
  ADD KEY `ID_TKI` (`ID_TKI`),
  ADD KEY `CREATED_BY` (`CREATED_BY`);

--
-- Indexes for table `TB_USER`
--
ALTER TABLE `TB_USER`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`),
  ADD UNIQUE KEY `ID_PENYALUR` (`ID_PENYALUR`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `LOG`
--
ALTER TABLE `LOG`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `LOG_EVENT`
--
ALTER TABLE `LOG_EVENT`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TB_EVENTTYPE`
--
ALTER TABLE `TB_EVENTTYPE`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TB_GROUP`
--
ALTER TABLE `TB_GROUP`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TB_KONTRAK`
--
ALTER TABLE `TB_KONTRAK`
  MODIFY `NO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TB_MENU`
--
ALTER TABLE `TB_MENU`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `TB_NEGARA`
--
ALTER TABLE `TB_NEGARA`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `TB_RULE_ACT`
--
ALTER TABLE `TB_RULE_ACT`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `TB_RULE_URL`
--
ALTER TABLE `TB_RULE_URL`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `TB_SETTING`
--
ALTER TABLE `TB_SETTING`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `TB_SURAT_PERJANJIAN`
--
ALTER TABLE `TB_SURAT_PERJANJIAN`
  MODIFY `NO` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `DOKUMEN`
--
ALTER TABLE `DOKUMEN`
  ADD CONSTRAINT `DOKUMEN_ibfk_1` FOREIGN KEY (`ID_JENIS_DOK`) REFERENCES `TB_JENIS_DOK` (`ID`),
  ADD CONSTRAINT `DOKUMEN_ibfk_2` FOREIGN KEY (`ID_KONTRAK`) REFERENCES `TB_KONTRAK` (`ID`),
  ADD CONSTRAINT `DOKUMEN_ibfk_3` FOREIGN KEY (`ID_PERJANJIAN`) REFERENCES `TB_SURAT_PERJANJIAN` (`ID`),
  ADD CONSTRAINT `DOKUMEN_ibfk_4` FOREIGN KEY (`ID_TKI`) REFERENCES `MST_TKI` (`ID`);

--
-- Constraints for table `JUSTIFIKASI_PEKERJAAN`
--
ALTER TABLE `JUSTIFIKASI_PEKERJAAN`
  ADD CONSTRAINT `JUSTIFIKASI_PEKERJAAN_ibfk_10` FOREIGN KEY (`APPROVED_BY_2`) REFERENCES `TB_USER` (`ID`),
  ADD CONSTRAINT `JUSTIFIKASI_PEKERJAAN_ibfk_11` FOREIGN KEY (`APPROVED_BY_3`) REFERENCES `TB_USER` (`ID`),
  ADD CONSTRAINT `JUSTIFIKASI_PEKERJAAN_ibfk_5` FOREIGN KEY (`ID_KONTRAK`) REFERENCES `TB_KONTRAK` (`ID`),
  ADD CONSTRAINT `JUSTIFIKASI_PEKERJAAN_ibfk_6` FOREIGN KEY (`ID_PEKERJAAN`) REFERENCES `TB_PEKERJAAN` (`ID`),
  ADD CONSTRAINT `JUSTIFIKASI_PEKERJAAN_ibfk_7` FOREIGN KEY (`ID_PERJANJIAN`) REFERENCES `TB_SURAT_PERJANJIAN` (`ID`),
  ADD CONSTRAINT `JUSTIFIKASI_PEKERJAAN_ibfk_8` FOREIGN KEY (`ID_TKI`) REFERENCES `MST_TKI` (`ID`),
  ADD CONSTRAINT `JUSTIFIKASI_PEKERJAAN_ibfk_9` FOREIGN KEY (`APPROVED_BY_1`) REFERENCES `TB_USER` (`ID`);

--
-- Constraints for table `KUALIFIKASI`
--
ALTER TABLE `KUALIFIKASI`
  ADD CONSTRAINT `KUALIFIKASI_ibfk_1` FOREIGN KEY (`ID_KUALIFIKASI`) REFERENCES `TB_KUALIFIKASI` (`ID`),
  ADD CONSTRAINT `KUALIFIKASI_ibfk_2` FOREIGN KEY (`ID_TKI`) REFERENCES `MST_TKI` (`ID`);

--
-- Constraints for table `LOG`
--
ALTER TABLE `LOG`
  ADD CONSTRAINT `LOG_ibfk_1` FOREIGN KEY (`JENIS`) REFERENCES `TB_RULE_ACT` (`ID`);

--
-- Constraints for table `MST_PENYALUR`
--
ALTER TABLE `MST_PENYALUR`
  ADD CONSTRAINT `MST_PENYALUR_ibfk_4` FOREIGN KEY (`ID_GROUP`) REFERENCES `TB_GROUP` (`ID`);

--
-- Constraints for table `MST_TKI`
--
ALTER TABLE `MST_TKI`
  ADD CONSTRAINT `MST_TKI_ibfk_1` FOREIGN KEY (`APPROVED_BY`) REFERENCES `TB_USER` (`ID`);

--
-- Constraints for table `RIWAYAT_PEKERJAAN`
--
ALTER TABLE `RIWAYAT_PEKERJAAN`
  ADD CONSTRAINT `RIWAYAT_PEKERJAAN_ibfk_2` FOREIGN KEY (`ID_PEKERJAAN`) REFERENCES `TB_PEKERJAAN` (`ID`),
  ADD CONSTRAINT `RIWAYAT_PEKERJAAN_ibfk_3` FOREIGN KEY (`ID_TKI`) REFERENCES `MST_TKI` (`ID`);

--
-- Constraints for table `TB_GROUP`
--
ALTER TABLE `TB_GROUP`
  ADD CONSTRAINT `TB_GROUP_ibfk_1` FOREIGN KEY (`ID_PERUSAHAAN`) REFERENCES `MST_PERUSAHAAN` (`ID`);

--
-- Constraints for table `TB_KONTRAK`
--
ALTER TABLE `TB_KONTRAK`
  ADD CONSTRAINT `TB_KONTRAK_ibfk_2` FOREIGN KEY (`ID_PEKERJAAN`) REFERENCES `TB_PEKERJAAN` (`ID`),
  ADD CONSTRAINT `TB_KONTRAK_ibfk_3` FOREIGN KEY (`ID_PERUSAHAAN`) REFERENCES `MST_PERUSAHAAN` (`ID`);

--
-- Constraints for table `TB_SURAT_PERJANJIAN`
--
ALTER TABLE `TB_SURAT_PERJANJIAN`
  ADD CONSTRAINT `TB_SURAT_PERJANJIAN_ibfk_1` FOREIGN KEY (`ID_DOKUMEN`) REFERENCES `DOKUMEN` (`ID`),
  ADD CONSTRAINT `TB_SURAT_PERJANJIAN_ibfk_2` FOREIGN KEY (`ID_TKI`) REFERENCES `MST_TKI` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
