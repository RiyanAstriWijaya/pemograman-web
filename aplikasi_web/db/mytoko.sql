-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jun 2024 pada 15.15
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mytoko`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `username`
--

CREATE TABLE `username` (
  `id_user` int(10) NOT NULL,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `verifikasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `username`
--

INSERT INTO `username` (`id_user`, `nama_depan`, `nama_belakang`, `no_hp`, `email`, `username`, `password`, `verifikasi`) VALUES
(19, 'Riski', 'Bejo', '087869008607', 'ongki@gmail.com', 'riski', '6e24184c9f8092a67bcd413cbcf598da', 'riski'),
(20, 'admin', '', '085675554332', 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(21, 'baidawi', '', '087869554654', 'baidawi@gmail.com', 'baidawi', 'f8f10d6823ad37b525889c6fa82adf56', 'baidawi'),
(22, 'asih', 'cantik', '087876543210', 'asih@gmail.com', 'asih', '9a27adf1714b77f749db78b0e5f2f75c', 'asih'),
(23, 'riyan', 'ganteng', '087840060990', 'riyanmaba69@gmail.com', 'riyan', '63a9f0ea7bb98050796b649e85481845', 'root');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `username`
--
ALTER TABLE `username`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `username`
--
ALTER TABLE `username`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
