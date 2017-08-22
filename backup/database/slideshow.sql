
INSERT INTO `slideshow` (`id`, `image_url`, `link_url`, `title`, `description`, `order`, `published`) VALUES
(1, 'data/images/ambapers_03.jpg', 'kantor-pt-ambang-barito-nusa-persada', 'Kantor PT. Ambang Barito Nusa Persada', 'Banjarmasin - Warna biru terang selaras dengan warna cerah langit kota Banjarmasin nampak indah menunjukkan kantor PT. Ambang Barito Nusa Persada dari sudut depan. ', 1, 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
