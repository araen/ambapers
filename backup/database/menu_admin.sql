
INSERT INTO `menu_admin` (`id`, `name`, `alias`, `parent`, `id_access`, `order`, `link`) VALUES
(1, 'Site', 'site', 0, 100, 1, '#'),
(2, 'Content', 'content', 0, 100, 3, '#'),
(3, 'Plugin', 'plugin', 0, 100, 4, '#'),
(4, 'Setting', 'setting', 0, 105, 5, 'admin/setting'),
(5, 'User Manager', 'user', 1, 101, 101, 'admin/user'),
(6, 'Menus', 'menus', 0, 102, 2, 'admin/menu'),
(7, 'Articles', 'article', 2, 103, 202, 'admin/article'),
(8, 'Comments', 'comment', 2, 104, 204, 'admin/comment'),
(9, 'Slide Show', 'slideshow', 3, 111, 303, 'admin/slideshow'),
(10, 'Random Image', 'randomimage', 3, 106, 304, 'admin/randomimage'),
(11, 'Categories', 'categories', 2, 107, 203, 'admin/category'),
(12, 'Group Manager', 'groups', 1, 108, 102, 'admin/group'),
(13, 'Message', 'message', 1, 109, 103, '#'),
(14, 'File Manager', 'file manager', 1, 110, 104, 'admin/file'),
(15, 'Data PPPA', 'data-pppa', 3, 111, 301, 'admin/pppa'),
(16, 'Tarif Muatan', 'tarif-muatan', 3, 112, 302, 'admin/tarif'),
(17, 'Galery Manager', 'galery-manager', 1, 113, 105, 'admin/galery');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_admin`
--
ALTER TABLE `menu_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_admin`
--
ALTER TABLE `menu_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
