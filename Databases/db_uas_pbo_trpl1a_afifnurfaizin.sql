-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2026 at 12:48 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_trpl1a_afifnurfaizin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_mahasiswa`
--

CREATE TABLE `tabel_mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nama_mahasiswa` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nim` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `semester` int NOT NULL,
  `trif_ukt_nominal` decimal(12,2) NOT NULL,
  `jenis_pembiayaan` enum('Mandiri','Bidikmisi','Prestasi') COLLATE utf8mb4_general_ci NOT NULL,
  `golongan_ukt` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_wali` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nomor_kip_kuliah` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dana_saku_subsidi` decimal(12,2) DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `minimal_ipk_syarat` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_mahasiswa`
--

INSERT INTO `tabel_mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `semester`, `trif_ukt_nominal`, `jenis_pembiayaan`, `golongan_ukt`, `nama_wali`, `nomor_kip_kuliah`, `dana_saku_subsidi`, `nama_instansi_beasiswa`, `minimal_ipk_syarat`) VALUES
(1, 'Afif Nur Faizin', 'TRPL1A-001', 2, 7500000.00, 'Mandiri', 'Golongan 5', NULL, NULL, NULL, NULL, NULL),
(2, 'Budi Santoso', 'TRPL1A-002', 4, 6500000.00, 'Mandiri', 'Golongan 4', NULL, NULL, NULL, NULL, NULL),
(3, 'Citra Dewi', 'TRPL1A-003', 2, 7500000.00, 'Mandiri', 'Golongan 5', NULL, NULL, NULL, NULL, NULL),
(4, 'Dimas Prayoga', 'TRPL1A-004', 6, 5500000.00, 'Mandiri', 'Golongan 3', NULL, NULL, NULL, NULL, NULL),
(5, 'Eka Putri Rahayu', 'TRPL1A-005', 4, 6000000.00, 'Mandiri', 'Golongan 4', NULL, NULL, NULL, NULL, NULL),
(6, 'Farhan Maulana', 'TRPL1A-006', 2, 8000000.00, 'Mandiri', 'Golongan 6', NULL, NULL, NULL, NULL, NULL),
(7, 'Gita Ayu Lestari', 'TRPL1A-007', 4, 7000000.00, 'Mandiri', 'Golongan 5', NULL, NULL, NULL, NULL, NULL),
(8, 'Hendra Wijaya', 'TRPL1A-008', 6, 4500000.00, 'Mandiri', 'Golongan 2', NULL, NULL, NULL, NULL, NULL),
(9, 'Indah Permatasari', 'TRPL1A-009', 2, 8500000.00, 'Mandiri', 'Golongan 7', NULL, NULL, NULL, NULL, NULL),
(10, 'Joko Prasetyo', 'TRPL1A-010', 2, 2500000.00, 'Bidikmisi', NULL, 'Suyanto', 'KIP-2024-00101', 700000.00, NULL, NULL),
(11, 'Kartika Sari', 'TRPL1A-011', 4, 2500000.00, 'Bidikmisi', NULL, 'Sumarni', 'KIP-2024-00102', 700000.00, NULL, NULL),
(12, 'Lukman Hakim', 'TRPL1A-012', 2, 2500000.00, 'Bidikmisi', NULL, 'Abdul Rohman', 'KIP-2024-00103', 750000.00, NULL, NULL),
(13, 'Mega Wulandari', 'TRPL1A-013', 4, 2500000.00, 'Bidikmisi', NULL, 'Siti Aminah', 'KIP-2024-00104', 700000.00, NULL, NULL),
(14, 'Naufal Rizky', 'TRPL1A-014', 6, 2500000.00, 'Bidikmisi', NULL, 'Hasan Basri', 'KIP-2024-00105', 800000.00, NULL, NULL),
(15, 'Olivia Anggraeni', 'TRPL1A-015', 2, 2500000.00, 'Bidikmisi', NULL, 'Endang Suhartini', 'KIP-2024-00106', 700000.00, NULL, NULL),
(16, 'Putra Aditya', 'TRPL1A-016', 4, 2500000.00, 'Bidikmisi', NULL, 'Bambang Sutrisno', 'KIP-2024-00107', 750000.00, NULL, NULL),
(17, 'Qonitah Zahra', 'TRPL1A-017', 2, 2500000.00, 'Bidikmisi', NULL, 'Mahmud Haryono', 'KIP-2024-00108', 700000.00, NULL, NULL),
(18, 'Rizal Fahmi', 'TRPL1A-018', 6, 2500000.00, 'Bidikmisi', NULL, 'Mulyadi', 'KIP-2024-00109', 800000.00, NULL, NULL),
(19, 'Sinta Maharani', 'TRPL1A-019', 4, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Yayasan Djarum', 3.50),
(20, 'Taufik Hidayat', 'TRPL1A-020', 2, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'LPDP Kemenkeu', 3.25),
(21, 'Ulfa Ramadhani', 'TRPL1A-021', 4, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Tanoto Foundation', 3.40),
(22, 'Vino Bastian', 'TRPL1A-022', 6, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Bank Indonesia', 3.30),
(23, 'Winda Kusuma', 'TRPL1A-023', 2, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Unggulan Kemdikbud', 3.50),
(24, 'Xavier Pratama', 'TRPL1A-024', 4, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Pertamina', 3.25),
(25, 'Yuliana Safitri', 'TRPL1A-025', 2, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Telkom Indonesia', 3.40),
(26, 'Zainul Abidin', 'TRPL1A-026', 6, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Toyota Astra', 3.30),
(27, 'Ahmad Fauzan', 'TRPL1A-027', 4, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Sampoerna Foundation', 3.50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
