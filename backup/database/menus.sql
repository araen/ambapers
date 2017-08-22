-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 15 Agu 2017 pada 21.52
-- Versi Server: 5.6.36-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ambapers_web`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `menutype` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `type` enum('url','category','article') NOT NULL DEFAULT 'article',
  `published` enum('yes','no') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `menutype`, `name`, `link`, `parent`, `order`, `type`, `published`) VALUES
(1, 'mainmenu', 'Profil', '#', 0, 1, 'url', 'yes'),
(2, 'mainmenu', 'Layanan', '#', 0, 2, 'url', 'yes'),
(3, 'mainmenu', 'Peraturan', 'document', 0, 3, 'url', 'yes'),
(4, 'mainmenu', 'Berita', '#', 0, 4, 'url', 'yes'),
(5, 'mainmenu', 'Galeri', 'galery', 0, 5, 'url', 'yes'),
(6, 'mainmenu', 'FAQ', 'frequently-asked-questions', 0, 6, 'article', 'yes'),
(7, 'profilemenu', 'Visi & Misi Perusahaan', 'visi-misi-perusahaan', 0, 1, 'article', 'yes'),
(8, 'profilemenu', 'Tujuan Perusahaan', 'tujuan-perusahaan', 0, 1, 'article', 'yes'),
(9, 'linkterkait', 'PT. Pelindo III Banjarmasin', 'http://www.banjarmasinport.co.id', 0, 1, 'url', 'yes'),
(10, 'linkterkait', 'PT Pelabuhan Indonesia III', 'https://www.pelindo.co.id/', 0, 1, 'url', 'yes'),
(11, 'layananmenu', 'Kondisi Alur', 'kondisi-alur', 0, 1, 'article', 'yes'),
(12, 'layananmenu', 'Prosedur PPPA', 'prosedur-pengajuan-pppa', 0, 1, 'article', 'yes'),
(15, 'mainmenu', 'Struktur Organisasi', 'struktur-organisasi', 1, 102, 'article', 'yes'),
(14, 'mainmenu', 'Visi & Misi Perusahaan', 'visi-misi-perusahaan', 13, 1301, 'article', 'yes'),
(13, 'mainmenu', 'Selayang Pandang', '#', 1, 101, 'url', 'yes'),
(16, 'mainmenu', 'Teknis', '#', 2, 201, 'url', 'yes'),
(17, 'mainmenu', 'PPPA', 'prosedur-pengajuan-pppa', 2, 201, 'article', 'yes'),
(18, 'mainmenu', 'Data Pelayanan', '#', 17, 1701, 'url', 'no'),
(19, 'mainmenu', 'Hot News', 'category/news', 4, 401, 'category', 'yes'),
(20, 'mainmenu', 'Kegiatan', 'category/kegiatan', 4, 401, 'category', 'yes'),
(21, 'mainmenu', 'Tujuan Perusahaan', 'tujuan-perusahaan', 13, 1301, 'article', 'yes'),
(22, 'mainmenu', 'Moto Perusahaan', 'moto-perusahaan', 13, 1301, 'article', 'yes'),
(23, 'profilemenu', 'Moto Perusahaan', 'moto-perusahaan', 0, 1, 'article', 'yes'),
(24, 'profilemenu', 'Struktur Organisasi', 'struktur-organisasi', 0, 1, 'article', 'yes'),
(25, 'linkterkait', 'Ditjen Pajak', 'http://www.pajak.go.id', 0, 1, 'url', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
