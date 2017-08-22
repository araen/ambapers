
CREATE TABLE `users` (
  `id` INT(11) NOT NULL,
  `username` VARCHAR(50) DEFAULT NULL,
  `password` VARCHAR(255) DEFAULT NULL,
  `name` VARCHAR(50) DEFAULT NULL,
  `email` VARCHAR(50) DEFAULT NULL,
  `id_group` INT(11) DEFAULT NULL,
  `active` ENUM('yes','no') DEFAULT NULL,
  `online` ENUM('no','yes') DEFAULT 'no'
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `id_group`, `active`, `online`) VALUES
(1, 'admin', 'c8c2b617211ce19b64cd9819970896c9', 'Administrator', 'ambapers@ambapers.com', 1, 'yes', 'yes'),
(2, 'editor', '5aee9dbd2a188839105073571bee1b1f', 'Editor', 'editor@yahoo.com', 2, 'yes', 'yes'),
(3, 'author', '02bd92faa38aaa6cc0ea75e59937a1ef', 'Author', 'author@yahoo.com', 3, 'yes', 'yes'),
(4, 'sevima', '43cc8bfc6b4633c8149c931166808fa6', 'sevima', 'sevima@sevima.com', 1, 'yes', 'yes'),
(5, 'kajanto', '75ade1554042ada0290c787ff534bf54', 'Kajanto', 'kajanto@ambapers.com', 1, 'yes', 'yes'),
(6, 'banu', '0250cbeb7a4fc0c1b8ed0c9406d28f66', 'banu', 'himawan.saputra@sevima.com', 1, 'yes', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
