-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 15 Agu 2017 pada 21.50
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
CREATE DATABASE IF NOT EXISTS `ambapers_web` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ambapers_web`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `permalink` varchar(255) DEFAULT NULL,
  `introcontent` text CHARACTER SET utf8,
  `content` text CHARACTER SET utf8,
  `description` text CHARACTER SET utf8,
  `keyword` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `read` int(11) NOT NULL DEFAULT '0',
  `comment` enum('no','yes') DEFAULT 'no',
  `published` enum('yes','no') DEFAULT 'no',
  `headline` enum('yes','no') NOT NULL DEFAULT 'no',
  `image_headline` varchar(200) DEFAULT NULL,
  `id_post_fb` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan`
--

CREATE TABLE `bulan` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `singkat` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `calculator`
--

CREATE TABLE `calculator` (
  `id` int(2) NOT NULL,
  `jenis_muatan` varchar(25) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `tarif_usd` float NOT NULL,
  `tarif_idr` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `permalink` varchar(50) DEFAULT NULL,
  `parent` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `published` enum('no','yes') DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_article` int(11) DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `id_author` int(11) DEFAULT NULL,
  `author_name` varchar(50) DEFAULT NULL,
  `author_email` varchar(50) DEFAULT NULL,
  `author_website` varchar(50) DEFAULT NULL,
  `author_ip` varchar(50) DEFAULT NULL,
  `is_spam` enum('yes','no') DEFAULT 'no',
  `content` text CHARACTER SET utf8,
  `published` enum('yes','no') DEFAULT 'yes',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galery_albums`
--

CREATE TABLE `galery_albums` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` mediumtext,
  `created` datetime DEFAULT NULL,
  `published` enum('no','yes') DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galery_photos`
--

CREATE TABLE `galery_photos` (
  `id` int(11) NOT NULL,
  `image_url` varchar(250) NOT NULL,
  `description` mediumtext,
  `created` datetime DEFAULT NULL,
  `published` enum('no','yes') DEFAULT 'yes',
  `id_album` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `access` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hits`
--

CREATE TABLE `hits` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_article` int(11) NOT NULL,
  `total` int(11) NOT NULL DEFAULT '1',
  `ip_address` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `logger`
--

CREATE TABLE `logger` (
  `id_log` bigint(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `information` text NOT NULL,
  `ip_address` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_admin`
--

CREATE TABLE `menu_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL COMMENT 'apakah menu ini root atau tidak. bila root nilainya 0',
  `id_access` int(11) DEFAULT '0',
  `order` int(11) DEFAULT NULL,
  `link` varchar(50) DEFAULT '#' COMMENT 'url untuk akses ke manunya. diisi bukan full path... tapi setelah base urlnya'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_types`
--

CREATE TABLE `menu_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `menutype` varchar(75) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `pppa`
--

CREATE TABLE `pppa` (
  `id` int(11) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `trafik` int(5) NOT NULL,
  `berat` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `randomimage`
--

CREATE TABLE `randomimage` (
  `id` int(11) NOT NULL,
  `image_url` varchar(225) NOT NULL,
  `link_url` varchar(225) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(225) DEFAULT NULL,
  `published` enum('no','yes') DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `variable` varchar(50) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `image_url` varchar(225) NOT NULL,
  `link_url` varchar(225) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(225) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `published` enum('no','yes') DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL,
  `active` enum('yes','no') DEFAULT NULL,
  `online` enum('no','yes') DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `articles` ADD FULLTEXT KEY `title` (`title`);
ALTER TABLE `articles` ADD FULLTEXT KEY `content` (`content`);
ALTER TABLE `articles` ADD FULLTEXT KEY `keyword` (`keyword`);

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calculator`
--
ALTER TABLE `calculator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galery_albums`
--
ALTER TABLE `galery_albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galery_photos`
--
ALTER TABLE `galery_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hits`
--
ALTER TABLE `hits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logger`
--
ALTER TABLE `logger`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `menu_admin`
--
ALTER TABLE `menu_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_types`
--
ALTER TABLE `menu_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menutype` (`menutype`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pppa`
--
ALTER TABLE `pppa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `randomimage`
--
ALTER TABLE `randomimage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `calculator`
--
ALTER TABLE `calculator`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `galery_albums`
--
ALTER TABLE `galery_albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `galery_photos`
--
ALTER TABLE `galery_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hits`
--
ALTER TABLE `hits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logger`
--
ALTER TABLE `logger`
  MODIFY `id_log` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu_admin`
--
ALTER TABLE `menu_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu_types`
--
ALTER TABLE `menu_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pppa`
--
ALTER TABLE `pppa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `randomimage`
--
ALTER TABLE `randomimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
