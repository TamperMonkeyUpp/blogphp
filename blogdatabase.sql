-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: sql202.epizy.com
-- Üretim Zamanı: 22 Oca 2023, 11:28:09
-- Sunucu sürümü: 10.3.27-MariaDB
-- PHP Sürümü: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `epiz_33407632_blog`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `short_description` varchar(500) NOT NULL,
  `description` text DEFAULT NULL,
  `imageUrl` varchar(100) DEFAULT NULL,
  `url` varchar(100) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp(),
  `isHome` tinyint(1) NOT NULL DEFAULT 0,
  `post_likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `short_description`, `description`, `imageUrl`, `url`, `isActive`, `dateAdded`, `isHome`, `post_likes`) VALUES
(56, 'Trial 1', 'Trial 1\r\n', '&lt;p&gt;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!&lt;/p&gt;\r\n', '76852ad151bec2e301a668caaa048d38.png', 'trial-1', 1, '2023-01-22 16:25:30', 1, 0),
(57, 'Trial 2', 'Trial 2', '&lt;p&gt;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!&lt;/p&gt;\r\n', 'be9dbc15d9c9be5f918bedca0b2f148d.png', 'trial-2', 1, '2023-01-22 16:26:27', 1, 0),
(58, 'Trial 3', 'Trial 3', '&lt;p&gt;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem tenetur maiores sunt vel tempore magni eum neque sit modi. Asperiores omnis exercitationem dolore, natus iusto tempora distinctio aliquam adipisci deleniti!&lt;/p&gt;\r\n', 'a0233330d36e1193a8135d07dc88e225.png', 'trial-3', 1, '2023-01-22 16:26:51', 1, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) DEFAULT NULL,
  `user_id_name` int(11) DEFAULT NULL,
  `comment` varchar(150) DEFAULT NULL,
  `exam_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog_likes`
--

CREATE TABLE `blog_likes` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name_lastName` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_img` varchar(100) DEFAULT NULL,
  `user_type` varchar(10) NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `name_lastName`, `password`, `user_img`, `user_type`, `created_at`) VALUES
(12, 'eral008', 'eral@gmail.com', 'eral keskinkurt', '$2y$10$Yc8JdYf43JdaEIkUZlPrJ.BV.LX/f7wVyB98b6k39oVEnXyioDCty', 'b4f5b88c96e8224419c449c9e197d686.png', 'admin', '2023-01-19 01:12:50');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Tablo için indeksler `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_name` (`user_id_name`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Tablo için indeksler `blog_likes`
--
ALTER TABLE `blog_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `blog_id_2` (`blog_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Tablo için AUTO_INCREMENT değeri `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- Tablo için AUTO_INCREMENT değeri `blog_likes`
--
ALTER TABLE `blog_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD CONSTRAINT `blog_comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_comments_ibfk_2` FOREIGN KEY (`user_id_name`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `blog_likes`
--
ALTER TABLE `blog_likes`
  ADD CONSTRAINT `blog_likes_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
