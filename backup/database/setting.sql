
INSERT INTO `setting` (`id`, `variable`, `value`) VALUES
(1, 'site_title', 'Ambapers'),
(2, 'description', 'AMBAPERS, AMBANG BARITO NUSAPERSADA, BARITO EQUATOR, ALUR PELAYARAN, PENGERUKAN'),
(3, 'keyword', 'AMBAPERS, AMBANG BARITO NUSAPERSADA, BARITO EQUATOR, ALUR PELAYARAN, PENGERUKAN'),
(4, 'rss_url', 'http://ambapers.com/feed'),
(5, 'site_url', 'http://ambapers.com'),
(6, 'footer_text', 'Copyright © 2017- PT. Ambang Barito Nusapersada. All rights reserved.'),
(7, 'comment', 'site'),
(8, 'email', 'ambapers@ambapers.com'),
(9, 'membership', 'yes'),
(10, 'role', '2'),
(11, 'activation', 'yes'),
(12, 'address', 'Jl Yos Soedarso No. 6 RT 34 RW 2 Telaga Biru, Banjarmasin'),
(13, 'phone', '089534120312'),
(14, 'fax', '49102984012'),
(15, 'email_contact', 'pelayanan@ambapers.com'),
(16, 'corporate_name', 'PT Ambang Barito Nusapersada'),
(17, 'lat', '-3.326679955580957'),
(18, 'lng', '114.56321376721007'),
(19, 'kurs_calc', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
