-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2023 pada 19.26
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
-- Database: `phpdasar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(10) NOT NULL,
  `nim` char(10) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `jurusan` varchar(70) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `jurusan`, `gambar`, `email`) VALUES
(31, '2021520004', 'Riyan Astri Wijaya', 'Teknik Arsitek', '647c04bf069ff.jpg', 'thekingofkelassore@gmail.com'),
(32, '2021520024', 'Moh Syahdan', 'Teknik Informatika', '647c0aaed07d6.jpg', 'syahdanyolanda@gmail.com'),
(33, '2021520041', 'Siti Ririn Sutarsih', 'Teknik Informatika', '647c0b0bd4a62.jpg', 'rincha@gmail.com'),
(38, '2021520017', 'Dimas Farid Ali', 'Teknik Informatika', '647c0fa3452b1.jpg', 'alisantoso@gmail.com'),
(39, '2021520016', 'Sriwirayanti', 'Teknik Elektro', '647c0feb2f027.jpg', 'yantisentosa@gmail.com'),
(40, '2021530043', 'Fahmi', 'Teknik Arsitek', '647c10296bbee.jpg', 'famimaba69@gmail.com'),
(41, '2021510055', 'Amir Hamzah', 'Teknik Sipil', '647c10aa71a5f.jpg', 'amiedesta@gmail.com'),
(42, '2021560087', 'Ulfatul Maulidia', 'Teknik Elektro', '647c110c8c520.jpg', 'ulfanih@gmail.com'),
(43, '2021520056', 'Maulidia', 'Teknik Mesin', '647c11bd88043.jpg', 'deasaja@gmail.com'),
(44, '2021530004', 'Dimas Arman Maulana Putra', 'Teknik Mesin', '647c12190ab0b.jpg', 'dimasamp@gmail.com'),
(45, '2021520007', 'Darus Ilham Abadi', 'Teknik Informatika', '647c12612b59b.jpg', 'darus@gmail.com'),
(46, '2021540002', 'Asmat Baidawi', 'Teknik Arsitek', '647c129b35566.jpg', 'baidawi@gmail.com'),
(47, '2022510003', 'Khana Zulfana Imam', 'Teknik Elektro', '647c12dfbdb16.jpg', 'khanaimamnih@gmail.com'),
(48, '2021520066', 'Safi Uddin', 'Teknik Mesin', '647c132303b5b.jpg', 'safiudin@gmail.com'),
(49, '2021520063', 'Syamsul Arifin', 'Teknik Sipil', '647c135d79db9.jpg', 'arifin@gmail.com'),
(50, '2020510093', 'Hefni Alapola', 'Teknik Arsitek', '647c13ad9c4a8.jpg', 'hefnigaul@gmail.com'),
(51, '2019520031', 'Ikus Tikus', 'Teknik Elektro', '647c13fcc2894.jpg', 'ikustok@gmail.com'),
(52, '2021520042', 'Riko Astri Wijaya', 'Teknik Mesin', '647c1449a0daa.jpg', 'rikosazaalie@gmail.com'),
(53, '2021520039', 'Bima Sakti Adi', 'Teknik Arsitek', '647c148c001d9.jpg', 'saktikan@gmail.com'),
(54, '2018520046', 'Fauzy BS', 'Teknik Informatika', '647c14e0312ae.jpg', 'bsnihbos@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'riyan', '$2y$10$xDA3zmAVz3rCnWSBV1lPXe.Kdccm1mgmmjpOMIkAsNnT7SFBtSjWS'),
(2, 'admin', '$2y$10$qK/yw8um/oQZzPEvkz4g5eyIcP6qTjmybRGMoq7aom.ieHbLldVTO');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
