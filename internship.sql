-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Eki 2024, 09:02:21
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `internship`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `currency_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `currency`
--

INSERT INTO `currency` (`id`, `currency_name`) VALUES
(26, 'AZN'),
(27, 'AZN'),
(28, 'Dollar'),
(29, 'Dollar');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `payment_cash` float NOT NULL,
  `payment_category` varchar(30) NOT NULL,
  `payment_currency` varchar(30) NOT NULL,
  `payment_type` text NOT NULL,
  `user` varchar(20) NOT NULL,
  `notes` text NOT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `payment`
--

INSERT INTO `payment` (`id`, `payment_cash`, `payment_category`, `payment_currency`, `payment_type`, `user`, `notes`, `payment_date`) VALUES
(40, 1000, 'Freelance', '    AZN', 'income', 'Pasha', 'Notes', '2024-10-17'),
(41, 1000, 'Freelance', '    AZN', 'income', 'Pasha', 'Notes', '2024-10-17'),
(42, 1000, 'Salary', '    Dollar', 'income', 'Huseyn', '', '2024-10-17'),
(43, 1000, 'Salary', '    Dollar', 'income', 'Huseyn', '', '2024-10-17'),
(44, 1000, 'Salary', '    Dollar', 'income', 'Huseyn', '', '2024-10-17');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `paymentcategoryname`
--

CREATE TABLE `paymentcategoryname` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `paymentcategoryname`
--

INSERT INTO `paymentcategoryname` (`id`, `cat_name`) VALUES
(72, 'Freelance'),
(73, 'Freelance'),
(74, 'Salary'),
(75, 'Salary');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `phone`) VALUES
(9, 'Pasha', '0553216774'),
(10, 'Huseyn', '0553216774');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `paymentcategoryname`
--
ALTER TABLE `paymentcategoryname`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Tablo için AUTO_INCREMENT değeri `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Tablo için AUTO_INCREMENT değeri `paymentcategoryname`
--
ALTER TABLE `paymentcategoryname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
