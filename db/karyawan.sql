-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Apr 2020 pada 21.18
-- Versi server: 10.1.30-MariaDB
-- Versi PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karyawan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_karyawan`
--

CREATE TABLE `dt_karyawan` (
  `nik` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `gender` enum('Pria','Perempuan') NOT NULL,
  `religion` enum('Katolik','Kristen','Islam','Hindu','Buddha','Others') NOT NULL,
  `address` text NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `department` varchar(200) NOT NULL,
  `position` varchar(200) NOT NULL,
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dt_karyawan`
--

INSERT INTO `dt_karyawan` (`nik`, `photo`, `fullname`, `gender`, `religion`, `address`, `email`, `phone`, `department`, `position`, `active`) VALUES
(20031101, '20031101.jpg', 'Charlius', 'Pria', 'Others', 'Jl Alam Sutera', 'acang@gmail.com', '081233456678', 'HRD', 'Manager', 1),
(20031102, '20031102.jpg', 'Christian Penthatius Yudianto', 'Pria', 'Kristen', 'Jl. Lodan', 'pentha@gmail.com', '081244558899', 'Production', 'Senior Staff', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `nik` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('HR','NHR') NOT NULL,
  `last` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`nik`, `password`, `level`, `last`, `created_at`) VALUES
('20031101', '$2y$10$knOpCx4s8uL8w8OtvN9q9eyw7blG/7rHhBhd6j.KENP1H3xPcgk6m', 'HR', '2020-04-18 18:45:48', '2020-03-11 01:59:41'),
('20031102', '$2y$10$63PmEFVPwtlKpnYNbuSdfuBqbWmSKrEGXkQUnVZ7vbvAgcpmEtNk.', 'NHR', '2020-04-18 18:30:00', '2020-04-18 17:31:14');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dt_karyawan`
--
ALTER TABLE `dt_karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
