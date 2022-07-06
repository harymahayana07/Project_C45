-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2022 at 11:24 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `c45`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_siswa`
--

CREATE TABLE `data_siswa` (
  `nisn` varchar(10) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `asal_sekolah` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_siswa`
--

INSERT INTO `data_siswa` (`nisn`, `nama`, `jenis_kelamin`, `asal_sekolah`) VALUES
('0015668539', 'RIDHO FAHREZI ', 'L', 'SMPN 8 MATARAM'),
('0022032006', 'MA RUB EGIP ALGI WIRASYANDA', 'L', 'SMPN 15 MATARAM'),
('003068779', 'HAZIZ LUKMAN HAKIM', 'L', 'SMPN 13 MATARAM'),
('0037075495', 'SITI ERA FAZIRA YAMANI', 'P', 'SMPN 8 MATARAM'),
('0037116589', 'SYAHRAZAD HASAN', 'L', 'SMPN 3 MATARAM'),
('0037315958', 'I WAYAN PUTRA YASE', 'L', 'SMPN 7 MATARAM'),
('0037452457', 'MUHAMMAD SURYA FAJAR', 'L', 'MTSN 1 MATARAM'),
('0037648117', 'YULIATI', 'P', 'SMPN 15 MATARAM'),
('0041561434', 'NURIMAN', 'L', 'SMPN 1 GUNUNG SARI'),
('0042605673', 'NI MADE KARUNA DWITYA', 'P', 'SMPN 15 MATARAM'),
('0043185627', 'PUTRA BINTANG NUSANTARA', 'L', 'SMPN 3 MATARAM'),
('0043185628', 'ANNISA AMALIA FADILAH', 'P', 'SMPN 3 MATARAM'),
('0043334769', 'ROHIMAMUL AZMI', 'L', 'SMPN 13 MATARAM'),
('0043841235', 'EKA KARUNIA PUTRI', 'P', 'SMPN 13 MATARAM'),
('0044825803', 'I GEDE ARIA WIBAWA', 'L', 'MTSN 1 MATARAM'),
('0045015647', 'SAKIRMAN', 'L', 'SMPN 15 MATARAM'),
('0045348722', 'RISKY RAHMAWATI', 'P', 'SMPN 13 MATARAM'),
('0045384602', 'RATNA ANJANI', 'P', 'SMPN 13 MATARAM'),
('0046227443', 'JUHARTIN', 'P', 'MTSN 5 LOMBOK TENGAH'),
('0046918977', 'NOVI ANDINI', 'P', 'SMPN 11 MATARAM'),
('0047201875', 'M. HARLEY FITRA BINTANG', 'L', 'LENTERAHATI ISLAMIC BOARDING SCHOOL'),
('0048573324', 'SITI SAPURAH', 'P', 'MTSN 3 MATARAM'),
('0049163128', 'MUHAMMAD JHESSAR', 'L', 'SMPN 13 MATARAM'),
('0049358276', 'SATRIA RAMADHANI', 'L', 'SMP SWASTA HANURA DANGA '),
('0049925822', 'LIRA FIRDA', 'P', 'SMPN 13 MATARAM'),
('0049950078', 'ARI MUHAMMAD RIDWAN', 'L', 'SMPN 3 MATARAM'),
('0051217481', 'ANDHIKA PRIMA NUGRAHA', 'L', 'SMPN 13 MATARAM'),
('0051254488', 'AURELL ENDRAFARRAND RAHARDJO', 'P', 'SMPN 11 MATARAM'),
('0051254489', 'MUHAMMAD FAISHAL ', 'L', 'SMPN 13 MATARAM'),
('0051271593', 'NI PUTU WIDYA NOVITHA DEWI', 'P', 'SMPN 2 MATARAM'),
('0051328098', 'NI KADEK WIDYA RANI', 'P', 'SMPN 15 MATARAM'),
('0051329490', 'I PUTU BAGAS PRASETYA PUTRA', 'L', 'SMPN 6 MATARAM'),
('0051372226', 'HERI PURNA NURSIWANI', 'L', 'SMPN 1 MATARAM'),
('0051388621', 'MOHAMMAD HARI PAMBUDI', 'L', 'SMP IT ANAK SHOLEH MATARAM'),
('0051449529', 'MADE ARYA NUGRAHA ABINANDA MATARAM', 'L', 'SMPN 13 MATARAM'),
('0051505123', 'EKA YULI WIDHIANTARI', 'P', 'SMPIT DARUL FIKRI SIDOARJO'),
('0051671209', 'AYU WULANDARI', 'P', 'SMPN 11 MATARAM'),
('0051690359', 'AISYAH REGITA AMELIA', 'P', 'SMPN 13 MATARAM'),
('0051795599', 'ACHMAD GHIYAS AL BANNA', 'L', 'SMP IT ABUHURAIRAH MATARAM'),
('0051811724', 'I PUTU AGUS YOGA KALENDRA', 'L', 'SMPN 14 MATARAM'),
('0051971234', 'ARIL SEPTIYANSAH', 'L', 'SMPN 3 MATARAM'),
('0051993237', 'NI PUTU GESTALIA TATYANA PUTRI', 'P', 'MTSN 1 MATARAM'),
('0052011808', 'SRI DETO ', 'P', 'MTS HIDAYATTULLAH'),
('0052162546', 'SUKRON KHALID', 'L', 'SMPN 11 MATARAM'),
('0052353810', 'MUHAMMAD FAIZUL MULQI', 'L', 'SMPN 6 MATARAM'),
('0052417843', 'LALU TIRTA PUTRA TANDELA', 'L', 'SMPN 13 MATARAM'),
('0052445413', 'NOVI LESTARI', 'P', 'SMPN 13 MATARAM'),
('0052478973', 'AYU ARTHA WULAN NDARI', 'P', 'SMPN 13 MATARAM'),
('0052567695', 'HAIRUN NISA', 'P', 'SMPN 13 MATARAM'),
('0052622678', 'MUHAMMAD FAIZ RAHMATULLAH', 'L', 'SMPN 15 MATARAM'),
('0052624129', 'I PUTU ADITYA YOGA PRATAMA', 'L', 'SMPN 6 MATARAM'),
('0052710136', 'SOFI WARISMA', 'P', 'SMPN 13 MATARAM'),
('0052714208', 'AULIA AGUSTINA', 'P', 'MADRASAH TSANAWIYAH NEGERI 3 MATARAM'),
('0052821320', 'ALYA AZZAHRA NAJLA', 'P', 'SMPN 11 MATARAM'),
('0053009654', 'IVAN JUANDA ILHAM', 'L', 'MTSN 3 MATARAM'),
('0053077870', 'CINTA NADHIRA', 'P', 'SMPN 11 MATARAM'),
('0053093270', 'ZAHWA SUHANDANY ALKATIRI', 'P', 'MTSN 1 MATARAM'),
('0053179602', 'IVANDY MALIK BAKHTIARSHAH', 'L', 'MTSN 1 MATARAM'),
('0053193865', 'I GUSTI BAGUS ARYA SIWANDANA  JANATHA', 'L', 'SMPN 7 MATARAM'),
('0053206589', 'MUHAMAD YASIN', 'L', 'SMPN 1 MATARAM');

-- --------------------------------------------------------

--
-- Table structure for table `data_training`
--

CREATE TABLE `data_training` (
  `id` int(11) NOT NULL,
  `jk` enum('1','2') DEFAULT NULL,
  `ppdb` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `bhs_indonesia` double DEFAULT NULL,
  `matematika` double DEFAULT NULL,
  `bhs_inggris` double DEFAULT NULL,
  `ipa` double DEFAULT NULL,
  `ips` double DEFAULT NULL,
  `skhu` double DEFAULT NULL,
  `jurusan` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_training`
--

INSERT INTO `data_training` (`id`, `jk`, `ppdb`, `bhs_indonesia`, `matematika`, `bhs_inggris`, `ipa`, `ips`, `skhu`, `jurusan`) VALUES
(1, '1', '6', 85, 84, 85, 89, 88, 87, 'MIPA'),
(2, '2', '7', 84, 85, 85, 87, 87, 86, 'IPS'),
(3, '2', '5', 82, 84, 87, 85, 88, 88, 'IPS'),
(4, '2', '6', 82, 84, 88, 88, 87, 92, 'MIPA'),
(5, '1', '2', 81, 86, 84, 87, 86, 91, 'MIPA'),
(6, '2', '4', 85, 88, 85, 90, 87, 86, 'MIPA'),
(7, '2', '6', 84, 87, 85, 87, 88, 88, 'IPS'),
(8, '2', '2', 83, 85, 83, 89, 88, 90, 'MIPA'),
(9, '1', '3', 84, 87, 82, 90, 86, 92, 'MIPA'),
(10, '2', '2', 84, 86, 84, 90, 88, 90, 'MIPA'),
(11, '2', '2', 84, 88, 84, 86, 88, 91, 'IPS'),
(12, '2', '7', 84, 83, 84, 86, 87, 95, 'IPS'),
(13, '1', '6', 83, 84, 86, 88, 87, 90, 'MIPA'),
(14, '2', '7', 83, 84, 83, 87, 85, 94, 'MIPA'),
(15, '1', '1', 82, 87, 83, 87, 86, 87, 'MIPA'),
(16, '1', '5', 83, 84, 88, 87, 89, 86, 'IPS'),
(17, '1', '3', 82, 86, 86, 87, 86, 87, 'MIPA'),
(18, '2', '1', 82, 86, 83, 88, 87, 87, 'MIPA'),
(19, '2', '3', 81, 84, 84, 87, 88, 92, 'IPS'),
(20, '2', '6', 83, 85, 86, 86, 87, 91, 'IPS'),
(21, '1', '4', 81, 86, 85, 90, 88, 94, 'MIPA'),
(22, '2', '7', 85, 83, 87, 85, 86, 93, 'IPS'),
(23, '1', '6', 85, 83, 87, 88, 90, 87, 'IPS'),
(24, '2', '6', 83, 85, 86, 88, 86, 95, 'MIPA'),
(25, '2', '2', 81, 84, 83, 88, 86, 91, 'MIPA'),
(26, '2', '2', 81, 84, 84, 88, 86, 93, 'MIPA'),
(27, '2', '7', 84, 86, 85, 84, 87, 88, 'IPS'),
(28, '1', '7', 84, 87, 88, 85, 89, 88, 'IPS'),
(29, '1', '5', 84, 87, 86, 86, 89, 87, 'IPS'),
(30, '1', '6', 84, 85, 86, 88, 86, 94, 'MIPA'),
(31, '2', '6', 84, 84, 86, 85, 87, 88, 'IPS'),
(32, '1', '6', 85, 83, 86, 88, 91, 86, 'IPS'),
(33, '1', '5', 83, 84, 88, 87, 89, 86, 'IPS'),
(34, '1', '7', 84, 83, 86, 87, 86, 91, 'MIPA'),
(35, '1', '3', 84, 86, 85, 90, 87, 91, 'MIPA'),
(36, '2', '4', 82, 85, 86, 90, 87, 89, 'MIPA'),
(37, '1', '7', 84, 84, 85, 88, 87, 87, 'MIPA'),
(38, '2', '6', 83, 85, 86, 88, 86, 95, 'MIPA'),
(39, '1', '5', 84, 87, 86, 86, 89, 87, 'IPS'),
(40, '1', '2', 84, 86, 84, 90, 87, 89, 'MIPA'),
(41, '2', '5', 82, 84, 88, 86, 87, 92, 'IPS'),
(42, '2', '6', 82, 85, 86, 89, 87, 91, 'MIPA'),
(43, '2', '5', 82, 92, 88, 85, 86, 86, 'IPS'),
(44, '1', '4', 81, 86, 85, 90, 88, 94, 'MIPA'),
(45, '2', '6', 83, 86, 85, 89, 86, 93, 'MIPA'),
(46, '1', '7', 83, 86, 84, 87, 89, 86, 'IPS'),
(47, '2', '2', 81, 84, 84, 88, 86, 93, 'MIPA'),
(48, '2', '1', 81, 84, 83, 87, 84, 88, 'MIPA'),
(49, '1', '3', 83, 87, 86, 91, 89, 86, 'MIPA'),
(50, '2', '2', 84, 86, 84, 90, 88, 90, 'MIPA'),
(51, '2', '6', 84, 84, 86, 85, 87, 88, 'IPS'),
(52, '1', '6', 85, 83, 86, 88, 91, 86, 'IPS'),
(53, '1', '5', 83, 84, 88, 87, 89, 86, 'IPS'),
(54, '1', '7', 84, 83, 86, 87, 86, 91, 'MIPA'),
(55, '1', '3', 84, 86, 85, 90, 87, 91, 'MIPA'),
(56, '2', '4', 82, 85, 86, 90, 87, 89, 'MIPA'),
(57, '1', '7', 84, 84, 85, 88, 87, 87, 'MIPA'),
(58, '2', '6', 83, 85, 86, 88, 86, 95, 'MIPA'),
(59, '1', '5', 84, 87, 86, 86, 89, 87, 'IPS'),
(60, '1', '2', 84, 86, 84, 90, 87, 89, 'MIPA');

-- --------------------------------------------------------

--
-- Table structure for table `data_training_konversi`
--

CREATE TABLE `data_training_konversi` (
  `id` int(11) NOT NULL,
  `jk` enum('1','2') DEFAULT NULL,
  `ppdb` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `bhs_indonesia` varchar(4) DEFAULT NULL,
  `matematika` varchar(4) DEFAULT NULL,
  `bhs_inggris` varchar(4) DEFAULT NULL,
  `ipa` varchar(4) DEFAULT NULL,
  `ips` varchar(4) DEFAULT NULL,
  `skhu` varchar(4) DEFAULT NULL,
  `jurusan` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_training_konversi`
--

INSERT INTO `data_training_konversi` (`id`, `jk`, `ppdb`, `bhs_indonesia`, `matematika`, `bhs_inggris`, `ipa`, `ips`, `skhu`, `jurusan`) VALUES
(1, '1', '6', 'B', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(2, '2', '7', 'B', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(3, '2', '5', 'C', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(4, '2', '6', 'C', 'B', 'B', 'B', 'B', 'A', 'MIPA'),
(5, '1', '2', 'C', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(6, '2', '4', 'B', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(7, '2', '6', 'B', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(8, '2', '2', 'C', 'B', 'C', 'B', 'B', 'B', 'MIPA'),
(9, '1', '3', 'B', 'B', 'C', 'B', 'B', 'A', 'MIPA'),
(10, '2', '2', 'B', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(11, '2', '2', 'B', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(12, '2', '7', 'B', 'C', 'B', 'B', 'B', 'A', 'IPS'),
(13, '1', '6', 'C', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(14, '2', '7', 'C', 'B', 'C', 'B', 'B', 'A', 'MIPA'),
(15, '1', '1', 'C', 'B', 'C', 'B', 'B', 'B', 'MIPA'),
(16, '1', '5', 'C', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(17, '1', '3', 'C', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(18, '2', '1', 'C', 'B', 'C', 'B', 'B', 'B', 'MIPA'),
(19, '2', '3', 'C', 'B', 'B', 'B', 'B', 'A', 'IPS'),
(20, '2', '6', 'C', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(21, '1', '4', 'C', 'B', 'B', 'B', 'B', 'A', 'MIPA'),
(22, '2', '7', 'B', 'C', 'B', 'B', 'B', 'A', 'IPS'),
(23, '1', '6', 'B', 'C', 'B', 'B', 'B', 'B', 'IPS'),
(24, '2', '6', 'C', 'B', 'B', 'B', 'B', 'A', 'MIPA'),
(25, '2', '2', 'C', 'B', 'C', 'B', 'B', 'B', 'MIPA'),
(26, '2', '2', 'C', 'B', 'B', 'B', 'B', 'A', 'MIPA'),
(27, '2', '7', 'B', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(28, '1', '7', 'B', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(29, '1', '5', 'B', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(30, '1', '6', 'B', 'B', 'B', 'B', 'B', 'A', 'MIPA'),
(31, '2', '6', 'B', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(32, '1', '6', 'B', 'C', 'B', 'B', 'B', 'B', 'IPS'),
(33, '1', '5', 'C', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(34, '1', '7', 'B', 'C', 'B', 'B', 'B', 'B', 'MIPA'),
(35, '1', '3', 'B', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(36, '2', '4', 'C', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(37, '1', '7', 'B', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(38, '2', '6', 'C', 'B', 'B', 'B', 'B', 'A', 'MIPA'),
(39, '1', '5', 'B', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(40, '1', '2', 'B', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(41, '2', '5', 'C', 'B', 'B', 'B', 'B', 'A', 'IPS'),
(42, '2', '6', 'C', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(43, '2', '5', 'C', 'A', 'B', 'B', 'B', 'B', 'IPS'),
(44, '1', '4', 'C', 'B', 'B', 'B', 'B', 'A', 'MIPA'),
(45, '2', '6', 'C', 'B', 'B', 'B', 'B', 'A', 'MIPA'),
(46, '1', '7', 'C', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(47, '2', '2', 'C', 'B', 'B', 'B', 'B', 'A', 'MIPA'),
(48, '2', '1', 'C', 'B', 'C', 'B', 'B', 'B', 'MIPA'),
(49, '1', '3', 'C', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(50, '2', '2', 'B', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(51, '2', '6', 'B', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(52, '1', '6', 'B', 'C', 'B', 'B', 'B', 'B', 'IPS'),
(53, '1', '5', 'C', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(54, '1', '7', 'B', 'C', 'B', 'B', 'B', 'B', 'MIPA'),
(55, '1', '3', 'B', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(56, '2', '4', 'C', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(57, '1', '7', 'B', 'B', 'B', 'B', 'B', 'B', 'MIPA'),
(58, '2', '6', 'C', 'B', 'B', 'B', 'B', 'A', 'MIPA'),
(59, '1', '5', 'B', 'B', 'B', 'B', 'B', 'B', 'IPS'),
(60, '1', '2', 'B', 'B', 'B', 'B', 'B', 'B', 'MIPA');

-- --------------------------------------------------------

--
-- Table structure for table `data_uji`
--

CREATE TABLE `data_uji` (
  `id` int(11) NOT NULL,
  `jk` enum('1','2') DEFAULT NULL,
  `ppdb` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `bhs_indonesia` double DEFAULT NULL,
  `matematika` double DEFAULT NULL,
  `bhs_inggris` double DEFAULT NULL,
  `ipa` double DEFAULT NULL,
  `ips` double DEFAULT NULL,
  `skhu` double DEFAULT NULL,
  `jurusan_asli` varchar(15) DEFAULT NULL,
  `jurusan_prediksi` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_uji`
--

INSERT INTO `data_uji` (`id`, `jk`, `ppdb`, `bhs_indonesia`, `matematika`, `bhs_inggris`, `ipa`, `ips`, `skhu`, `jurusan_asli`, `jurusan_prediksi`) VALUES
(1, '2', '5', 82, 84, 88, 86, 87, 92, 'IPS', 'IPS'),
(2, '2', '6', 82, 85, 86, 89, 87, 91, 'MIPA', 'IPS'),
(3, '2', '5', 82, 92, 88, 85, 86, 86, 'IPS', 'IPS'),
(4, '1', '4', 81, 86, 85, 90, 88, 94, 'MIPA', 'MIPA'),
(5, '2', '6', 83, 86, 85, 89, 86, 93, 'MIPA', 'MIPA'),
(6, '1', '7', 83, 86, 84, 87, 89, 86, 'IPS', 'IPS'),
(7, '2', '2', 81, 84, 84, 88, 86, 93, 'MIPA', 'MIPA'),
(8, '2', '1', 81, 84, 83, 87, 84, 88, 'MIPA', 'MIPA'),
(9, '1', '3', 83, 87, 86, 91, 89, 86, 'MIPA', 'MIPA'),
(10, '2', '2', 84, 86, 84, 90, 88, 90, 'MIPA', 'MIPA'),
(11, '2', '6', 84, 84, 86, 85, 87, 88, 'IPS', 'MIPA'),
(12, '1', '6', 85, 83, 86, 88, 91, 86, 'IPS', 'IPS'),
(13, '1', '5', 83, 84, 88, 87, 89, 86, 'IPS', 'IPS'),
(14, '1', '7', 84, 83, 86, 87, 86, 91, 'MIPA', 'MIPA'),
(15, '1', '3', 84, 86, 85, 90, 87, 91, 'MIPA', 'MIPA'),
(16, '2', '4', 82, 85, 86, 90, 87, 89, 'MIPA', 'MIPA'),
(17, '1', '7', 84, 84, 85, 88, 87, 87, 'MIPA', 'MIPA'),
(18, '2', '6', 83, 85, 86, 88, 86, 95, 'MIPA', 'MIPA'),
(19, '1', '5', 84, 87, 86, 86, 89, 87, 'IPS', 'IPS'),
(20, '1', '2', 84, 86, 84, 90, 87, 89, 'MIPA', 'MIPA');

-- --------------------------------------------------------

--
-- Table structure for table `gain`
--

CREATE TABLE `gain` (
  `id` int(11) NOT NULL,
  `atribut` varchar(40) DEFAULT NULL,
  `gain` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gain`
--

INSERT INTO `gain` (`id`, `atribut`, `gain`) VALUES
(1, 'jk', 0.102),
(2, 'ppdb', 0.002),
(3, 'Bahasa Indonesia C', 0),
(4, 'Bahasa Indonesia B', 0),
(5, 'Bahasa Indonesia A', 0),
(6, 'Matematika C', 0),
(7, 'Matematika B', 0.182),
(8, 'Matematika A', 0),
(9, 'Bahasa Inggris C', 0),
(10, 'Bahasa Inggris B', 0.04),
(11, 'Bahasa Inggris A', 0),
(12, 'Ipa C', 0),
(13, 'Ipa B', 0.04),
(14, 'Ipa A', 0),
(15, 'Ips C', 0),
(16, 'Ips B', 0),
(17, 'Ips A', 0),
(18, 'Skhu C', 0),
(19, 'Skhu B', 0),
(20, 'Skhu A', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_prediksi`
--

CREATE TABLE `hasil_prediksi` (
  `id` int(11) NOT NULL,
  `nisn` varchar(10) DEFAULT NULL,
  `jk` enum('1','2') DEFAULT NULL,
  `ppdb` varchar(30) DEFAULT NULL,
  `bhs_indonesia` double DEFAULT NULL,
  `matematika` double DEFAULT NULL,
  `bhs_inggris` double DEFAULT NULL,
  `ipa` double DEFAULT NULL,
  `ips` double DEFAULT NULL,
  `skhu` double DEFAULT NULL,
  `hasil` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pohon_keputusan`
--

CREATE TABLE `pohon_keputusan` (
  `id` int(11) NOT NULL,
  `parent` text,
  `akar` text,
  `keputusan` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pohon_keputusan`
--

INSERT INTO `pohon_keputusan` (`id`, `parent`, `akar`, `keputusan`) VALUES
(1, '', '(ppdb=\'1\')', 'MIPA'),
(2, '(ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\' OR ppdb=\'4\' OR ppdb=\'3\')', '(ppdb=\'4\')', 'MIPA'),
(3, '(ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\' OR ppdb=\'4\' OR ppdb=\'3\') AND (ppdb=\'3\' OR ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\')', '(ppdb=\'3\')', 'MIPA'),
(4, '(ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\' OR ppdb=\'4\' OR ppdb=\'3\') AND (ppdb=\'3\' OR ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\') AND (ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\')', '(ppdb=\'5\')', 'IPS'),
(6, '(ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\' OR ppdb=\'4\' OR ppdb=\'3\') AND (ppdb=\'3\' OR ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\') AND (ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\') AND (ppdb=\'2\' OR ppdb=\'6\' OR ppdb=\'7\')', '(ppdb=\'2\')', 'MIPA'),
(7, '(ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\' OR ppdb=\'4\' OR ppdb=\'3\') AND (ppdb=\'3\' OR ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\') AND (ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\') AND (ppdb=\'2\' OR ppdb=\'6\' OR ppdb=\'7\') AND (ppdb=\'6\' OR ppdb=\'7\') AND (bhs_indonesia<=84) AND (skhu<=92)', '(matematika<=84)', 'MIPA'),
(8, '(ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\' OR ppdb=\'4\' OR ppdb=\'3\') AND (ppdb=\'3\' OR ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\') AND (ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\') AND (ppdb=\'2\' OR ppdb=\'6\' OR ppdb=\'7\') AND (ppdb=\'6\' OR ppdb=\'7\') AND (bhs_indonesia<=84) AND (skhu<=92)', '(matematika>84)', 'IPS'),
(9, '(ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\' OR ppdb=\'4\' OR ppdb=\'3\') AND (ppdb=\'3\' OR ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\') AND (ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\') AND (ppdb=\'2\' OR ppdb=\'6\' OR ppdb=\'7\') AND (ppdb=\'6\' OR ppdb=\'7\') AND (bhs_indonesia<=84)', '(skhu>92)', 'MIPA'),
(10, '(ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\' OR ppdb=\'4\' OR ppdb=\'3\') AND (ppdb=\'3\' OR ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\') AND (ppdb=\'6\' OR ppdb=\'7\' OR ppdb=\'5\' OR ppdb=\'2\') AND (ppdb=\'2\' OR ppdb=\'6\' OR ppdb=\'7\') AND (ppdb=\'6\' OR ppdb=\'7\')', '(bhs_indonesia>84)', 'IPS');

-- --------------------------------------------------------

--
-- Table structure for table `rasio_gain`
--

CREATE TABLE `rasio_gain` (
  `id` int(11) NOT NULL,
  `opsi` varchar(10) DEFAULT NULL,
  `cabang1` varchar(50) DEFAULT NULL,
  `cabang2` varchar(50) DEFAULT NULL,
  `rasio_gain` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rasio_gain`
--

INSERT INTO `rasio_gain` (`id`, `opsi`, `cabang1`, `cabang2`, `rasio_gain`) VALUES
(1, 'opsi1', '6', '7 , 2', 0.069),
(2, 'opsi2', '7', '2 , 6', 0.077),
(3, 'opsi3', '2', '6 , 7', 0.081);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(25) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` enum('admin','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama`, `password`, `type`) VALUES
('0015668539', 'RIDHO FAHREZI ', '0015668539', 'siswa'),
('0022032006', 'MA RUB EGIP ALGI WIRASYANDA', '0022032006', 'siswa'),
('003068779', 'HAZIZ LUKMAN HAKIM', '003068779', 'siswa'),
('0037075495', 'SITI ERA FAZIRA YAMANI', '0037075495', 'siswa'),
('0037116589', 'SYAHRAZAD HASAN', '0037116589', 'siswa'),
('0037315958', 'I WAYAN PUTRA YASE', '0037315958', 'siswa'),
('0037452457', 'MUHAMMAD SURYA FAJAR', '0037452457', 'siswa'),
('0037648117', 'YULIATI', '0037648117', 'siswa'),
('0041561434', 'NURIMAN', '0041561434', 'siswa'),
('0042605673', 'NI MADE KARUNA DWITYA', '0042605673', 'siswa'),
('0043185627', 'PUTRA BINTANG NUSANTARA', '0043185627', 'siswa'),
('0043185628', 'ANNISA AMALIA FADILAH', '0043185628', 'siswa'),
('0043334769', 'ROHIMAMUL AZMI', '0043334769', 'siswa'),
('0043841235', 'EKA KARUNIA PUTRI', '0043841235', 'siswa'),
('0044825803', 'I GEDE ARIA WIBAWA', '0044825803', 'siswa'),
('0045015647', 'SAKIRMAN', '0045015647', 'siswa'),
('0045348722', 'RISKY RAHMAWATI', '0045348722', 'siswa'),
('0045384602', 'RATNA ANJANI', '0045384602', 'siswa'),
('0046227443', 'JUHARTIN', '0046227443', 'siswa'),
('0046918977', 'NOVI ANDINI', '0046918977', 'siswa'),
('0047201875', 'M. HARLEY FITRA BINTANG', '0047201875', 'siswa'),
('0048573324', 'SITI SAPURAH', '0048573324', 'siswa'),
('0049163128', 'MUHAMMAD JHESSAR', '0049163128', 'siswa'),
('0049358276', 'SATRIA RAMADHANI', '0049358276', 'siswa'),
('0049925822', 'LIRA FIRDA', '0049925822', 'siswa'),
('0049950078', 'ARI MUHAMMAD RIDWAN', '0049950078', 'siswa'),
('0051217481', 'ANDHIKA PRIMA NUGRAHA', '0051217481', 'siswa'),
('0051254488', 'AURELL ENDRAFARRAND RAHARDJO', '0051254488', 'siswa'),
('0051254489', 'MUHAMMAD FAISHAL ', '0051254489', 'siswa'),
('0051271593', 'NI PUTU WIDYA NOVITHA DEWI', '0051271593', 'siswa'),
('0051328098', 'NI KADEK WIDYA RANI', '0051328098', 'siswa'),
('0051329490', 'I PUTU BAGAS PRASETYA PUTRA', '0051329490', 'siswa'),
('0051372226', 'HERI PURNA NURSIWANI', '0051372226', 'siswa'),
('0051388621', 'MOHAMMAD HARI PAMBUDI', '0051388621', 'siswa'),
('0051449529', 'MADE ARYA NUGRAHA ABINANDA MATARAM', '0051449529', 'siswa'),
('0051505123', 'EKA YULI WIDHIANTARI', '0051505123', 'siswa'),
('0051671209', 'AYU WULANDARI', '0051671209', 'siswa'),
('0051690359', 'AISYAH REGITA AMELIA', '0051690359', 'siswa'),
('0051795599', 'ACHMAD GHIYAS AL BANNA', '0051795599', 'siswa'),
('0051811724', 'I PUTU AGUS YOGA KALENDRA', '0051811724', 'siswa'),
('0051971234', 'ARIL SEPTIYANSAH', '0051971234', 'siswa'),
('0051993237', 'NI PUTU GESTALIA TATYANA PUTRI', '0051993237', 'siswa'),
('0052011808', 'SRI DETO ', '0052011808', 'siswa'),
('0052162546', 'SUKRON KHALID', '0052162546', 'siswa'),
('0052353810', 'MUHAMMAD FAIZUL MULQI', '0052353810', 'siswa'),
('0052417843', 'LALU TIRTA PUTRA TANDELA', '0052417843', 'siswa'),
('0052445413', 'NOVI LESTARI', '0052445413', 'siswa'),
('0052478973', 'AYU ARTHA WULAN NDARI', '0052478973', 'siswa'),
('0052567695', 'HAIRUN NISA', '0052567695', 'siswa'),
('0052622678', 'MUHAMMAD FAIZ RAHMATULLAH', '0052622678', 'siswa'),
('0052624129', 'I PUTU ADITYA YOGA PRATAMA', '0052624129', 'siswa'),
('0052710136', 'SOFI WARISMA', '0052710136', 'siswa'),
('0052714208', 'AULIA AGUSTINA', '0052714208', 'siswa'),
('0052821320', 'ALYA AZZAHRA NAJLA', '0052821320', 'siswa'),
('0053009654', 'IVAN JUANDA ILHAM', '0053009654', 'siswa'),
('0053077870', 'CINTA NADHIRA', '0053077870', 'siswa'),
('0053093270', 'ZAHWA SUHANDANY ALKATIRI', '0053093270', 'siswa'),
('0053179602', 'IVANDY MALIK BAKHTIARSHAH', '0053179602', 'siswa'),
('0053193865', 'I GUSTI BAGUS ARYA SIWANDANA  JANATHA', '0053193865', 'siswa'),
('0053206589', 'MUHAMAD YASIN', '0053206589', 'siswa'),
('admin', 'Ni luh Putu Sri Astiti', 'admin', 'admin'),
('arikmahayana', 'arikmahayana', 'harymahayana', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `data_training`
--
ALTER TABLE `data_training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_training_konversi`
--
ALTER TABLE `data_training_konversi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_uji`
--
ALTER TABLE `data_uji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gain`
--
ALTER TABLE `gain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_prediksi`
--
ALTER TABLE `hasil_prediksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pohon_keputusan`
--
ALTER TABLE `pohon_keputusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rasio_gain`
--
ALTER TABLE `rasio_gain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_training`
--
ALTER TABLE `data_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `data_training_konversi`
--
ALTER TABLE `data_training_konversi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `data_uji`
--
ALTER TABLE `data_uji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `gain`
--
ALTER TABLE `gain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `hasil_prediksi`
--
ALTER TABLE `hasil_prediksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pohon_keputusan`
--
ALTER TABLE `pohon_keputusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rasio_gain`
--
ALTER TABLE `rasio_gain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
