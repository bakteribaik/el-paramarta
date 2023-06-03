-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2023 at 05:54 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `el-paramarta`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_forum`
--

CREATE TABLE `db_forum` (
  `id_forum` int(10) NOT NULL,
  `id_guru` int(10) NOT NULL,
  `id_quiz` int(6) DEFAULT NULL,
  `judul_forum` varchar(50) NOT NULL,
  `deskripsi_forum` varchar(200) NOT NULL,
  `nama_mapel` varchar(40) NOT NULL,
  `nama_guru` varchar(40) NOT NULL,
  `kode_jurusan` varchar(6) NOT NULL,
  `status_forum` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_guru`
--

CREATE TABLE `db_guru` (
  `userid` int(12) NOT NULL,
  `u_pass` varchar(12) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `kode_jurusan` varchar(6) NOT NULL,
  `roles` int(2) NOT NULL,
  `statuses` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `db_guru`
--

INSERT INTO `db_guru` (`userid`, `u_pass`, `nama_user`, `kode_jurusan`, `roles`, `statuses`) VALUES
(181011, '123', 'Dadang Junaedi  S.Pd', 'XMM2', 1, 'ONLINE');

-- --------------------------------------------------------

--
-- Table structure for table `db_jawaban`
--

CREATE TABLE `db_jawaban` (
  `id_pertanyaan` int(4) NOT NULL,
  `userid` int(16) NOT NULL,
  `jawaban_user` varchar(500) NOT NULL,
  `is_correct` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_mapel`
--

CREATE TABLE `db_mapel` (
  `id_mapel` varchar(8) NOT NULL,
  `id_guru` int(10) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `kode_jurusan` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `db_mapel`
--

INSERT INTO `db_mapel` (`id_mapel`, `id_guru`, `nama_mapel`, `nama_guru`, `kode_jurusan`) VALUES
('BINDO', 181011, 'Bahasa Indonesia', 'Dadang Junaedi S.Pd', 'XMM2'),
('BING', 181012, 'Bahasa Inggris', 'Budi Setiawan. S.Pd', 'XMM2');

-- --------------------------------------------------------

--
-- Table structure for table `db_pertanyaan`
--

CREATE TABLE `db_pertanyaan` (
  `id_pertanyaan` int(4) NOT NULL,
  `pertanyaan` varchar(500) NOT NULL,
  `jawaban_a` varchar(500) NOT NULL,
  `jawaban_b` varchar(500) NOT NULL,
  `jawaban_c` varchar(500) NOT NULL,
  `jawaban_d` varchar(500) NOT NULL,
  `jawaban_benar` varchar(500) NOT NULL,
  `id_quiz` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_postingan`
--

CREATE TABLE `db_postingan` (
  `id_postingan` int(6) NOT NULL,
  `id_parent` int(9) DEFAULT NULL,
  `id_forum` int(6) NOT NULL,
  `userid` int(10) NOT NULL,
  `nama_user` varchar(40) NOT NULL,
  `pesan` text NOT NULL,
  `file_dir` varchar(200) DEFAULT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_quiz`
--

CREATE TABLE `db_quiz` (
  `id_quiz` int(4) NOT NULL,
  `id_guru` int(16) NOT NULL,
  `nama_guru` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_siswa`
--

CREATE TABLE `db_siswa` (
  `userid` int(12) NOT NULL,
  `nama_user` varchar(40) DEFAULT NULL,
  `kode_jurusan` varchar(6) NOT NULL,
  `u_pass` int(5) DEFAULT NULL,
  `roles` int(2) NOT NULL,
  `statuses` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `db_siswa`
--

INSERT INTO `db_siswa` (`userid`, `nama_user`, `kode_jurusan`, `u_pass`, `roles`, `statuses`) VALUES
(123, 'Zulfikar Alwi', 'XMM2', 123, 2, 'OFFLINE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_forum`
--
ALTER TABLE `db_forum`
  ADD PRIMARY KEY (`id_forum`);

--
-- Indexes for table `db_guru`
--
ALTER TABLE `db_guru`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `db_mapel`
--
ALTER TABLE `db_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `db_pertanyaan`
--
ALTER TABLE `db_pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`);

--
-- Indexes for table `db_postingan`
--
ALTER TABLE `db_postingan`
  ADD PRIMARY KEY (`id_postingan`);

--
-- Indexes for table `db_quiz`
--
ALTER TABLE `db_quiz`
  ADD PRIMARY KEY (`id_quiz`);

--
-- Indexes for table `db_siswa`
--
ALTER TABLE `db_siswa`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_forum`
--
ALTER TABLE `db_forum`
  MODIFY `id_forum` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `db_pertanyaan`
--
ALTER TABLE `db_pertanyaan`
  MODIFY `id_pertanyaan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `db_postingan`
--
ALTER TABLE `db_postingan`
  MODIFY `id_postingan` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `db_quiz`
--
ALTER TABLE `db_quiz`
  MODIFY `id_quiz` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
