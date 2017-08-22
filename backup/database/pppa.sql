
INSERT INTO `pppa` (`id`, `bulan`, `tahun`, `trafik`, `berat`) VALUES
(1, 1, 2011, 660, NULL),
(2, 2, 2012, 761, 0),
(3, 3, 2011, 730, NULL),
(4, 4, 2011, 696, NULL),
(5, 5, 2011, 744, NULL),
(6, 6, 2011, 746, NULL),
(7, 7, 2011, 810, NULL),
(8, 8, 2011, 685, NULL),
(9, 9, 2011, 713, NULL),
(10, 10, 2011, 791, NULL),
(11, 11, 2011, 754, NULL),
(12, 12, 2011, 877, NULL),
(13, 1, 2012, 783, 0),
(14, 3, 2012, 807, 0),
(15, 2, 2011, 648, 0),
(16, 4, 2012, 846, 0),
(17, 5, 2012, 822, 0),
(18, 6, 2012, 804, 0),
(19, 7, 2012, 712, 0),
(20, 8, 2012, 621, 0),
(21, 9, 2012, 706, 0),
(22, 10, 2012, 785, 0),
(23, 11, 2012, 867, 0),
(24, 12, 2012, 921, 0),
(25, 1, 2013, 746, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pppa`
--
ALTER TABLE `pppa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pppa`
--
ALTER TABLE `pppa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
