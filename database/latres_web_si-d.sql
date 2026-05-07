-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 07, 2026 at 01:19 PM
-- Server version: 8.0.44
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `latres_web_si-d`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id_asset` int NOT NULL,
  `serial_number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_alat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `merk` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` int NOT NULL,
  `url_gambar` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id_asset`, `serial_number`, `nama_alat`, `merk`, `status`, `jumlah`, `url_gambar`, `created_at`) VALUES
(1, 'CAM-SONY-A73-01', 'Sony Alpha a7 III Mirrorlesee', 'Sony', 'Tersedia', 3, 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=1000&auto=format&fit=crop', '2026-04-04 13:47:31'),
(2, 'LNS-CAN-50MM-02', 'Canon EF 50mm f/1.8 STM', 'Canon', 'Tersedia', 1, 'https://images.unsplash.com/photo-1617005082133-548c4dd27f35?q=80&w=1000&auto=format&fit=crop', '2026-04-04 13:47:31'),
(3, 'DRN-DJI-MAV-05', 'DJI Mavic 3 Classic', 'DJI', 'Dipinjam', 1, 'https://images.unsplash.com/photo-1473968512647-3e447244af8f?q=80&w=1000&auto=format&fit=crop', '2026-04-04 13:47:31'),
(5, 'CAM-SON-A74-01', 'Sony Alpha A7 IV Mirrorless Camera', 'Sony', 'Tersedia', 2, 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=1000&auto=format&fit=crop', '2026-05-07 20:03:20'),
(6, 'CAM-CAN-R50-02', 'Canon EOS R50 Camera', 'Canon', 'Dipinjam', 1, 'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?q=80&w=1000&auto=format&fit=crop', '2026-05-07 20:03:20'),
(7, 'LNS-SON-2470-03', 'Sony FE 24-70mm f/2.8 GM Lens', 'Sony', 'Maintenance', 3, 'https://images.unsplash.com/photo-1510127034890-ba27508e9f1c?q=80&w=1000&auto=format&fit=crop', '2026-05-07 20:03:20'),
(8, 'DRN-DJI-M3P-04', 'DJI Mini 3 Pro Drone', 'DJI', 'Maintenance', 1, 'https://images.unsplash.com/photo-1473968512647-3e447244af8f?q=80&w=1000&auto=format&fit=crop', '2026-05-07 20:03:20'),
(9, 'CAM-FUJ-XT5-05', 'Fujifilm X-T5 Mirrorless Camera', 'Fujifilm', 'Tersedia', 2, 'https://images.unsplash.com/photo-1495707902641-75cac588d2e9?q=80&w=1000&auto=format&fit=crop', '2026-05-07 20:03:20'),
(10, 'LNS-CAN-50MM-06', 'Canon RF 50mm f/1.8 STM Lens', 'Canon', 'Maintenance', 4, 'https://images.unsplash.com/photo-1516724562728-afc824a36e84?q=80&w=1000&auto=format&fit=crop', '2026-05-07 20:03:20'),
(11, 'TRP-MAN-190X-07', 'Manfrotto 190X Tripod', 'Manfrotto', 'Dipinjam', 5, 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1000&auto=format&fit=crop', '2026-05-07 20:03:20'),
(12, 'CAM-NIK-Z6II-08', 'Nikon Z6 II Mirrorless Camera', 'Nikon', 'Maintenance', 1, 'https://images.unsplash.com/photo-1512790182412-b19e6d62bc39?q=80&w=1000&auto=format&fit=crop', '2026-05-07 20:03:20'),
(13, 'DRN-DJI-AVT-09', 'DJI Avata FPV Drone', 'DJI', 'Dipinjam', 2, 'https://images.unsplash.com/photo-1508614589041-895b88991e3e?q=80&w=1000&auto=format&fit=crop', '2026-05-07 20:03:20'),
(14, 'LGT-GDX-SL60-10', 'Godox SL60W Studio Light', 'Godox', 'Tersedia', 6, 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=1000&auto=format&fit=crop', '2026-05-07 20:03:20'),
(15, 'MIC-ROD-NTG5-11', 'Rode NTG5 Shotgun Microphone', 'Rode', 'Dipinjam', 2, 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=1000&auto=format&fit=crop', '2026-05-07 20:03:20'),
(16, 'CAM-GOP-H12-12', 'GoPro Hero 12 Black', 'GoPro', 'Tersedia', 3, 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?q=80&w=1000&auto=format&fit=crop', '2026-05-07 20:03:20'),
(17, 'LNS-SIG-85MM-13', 'Sigma 85mm f/1.4 Art Lens', 'Sigma', 'Maintenance', 1, 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=1000&auto=format&fit=crop', '2026-05-07 20:03:20'),
(18, 'CAM-PAN-GH6-14', 'Panasonic Lumix GH6 Camera', 'Panasonic', 'Dipinjam', 2, 'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?q=80&w=1000&auto=format&fit=crop', '2026-05-07 20:03:20'),
(19, 'BAG-LOW-PRO-15', 'Lowepro ProTactic Camera Bag', 'Lowepro', 'Tersedia', 4, 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=1000&auto=format&fit=crop', '2026-05-07 20:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `created_at`) VALUES
(1, '123', '123', '2026-04-02 20:12:10'),
(3, 'rizal', 'rizal123', '2026-05-07 20:07:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id_asset`),
  ADD UNIQUE KEY `serial_number` (`serial_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id_asset` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
