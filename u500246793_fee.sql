-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2020 a las 19:51:34
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u500246793_feebulari`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persons`
--

CREATE TABLE `persons` (
  `id` int(11) NOT NULL,
  `personId` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minusIdCard` int(11) DEFAULT NULL,
  `moreIdCard` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `persons`
--

INSERT INTO `persons` (`id`, `personId`, `minusIdCard`, `moreIdCard`, `created_at`, `updated_at`) VALUES
(1, '5ebf4d8ca1825', NULL, 164, '2020-06-01 16:32:23', '2020-06-01 16:32:23'),
(2, '5ebf4d8ca1825', 164, NULL, '2020-06-01 16:32:28', '2020-06-01 16:32:28'),
(3, '5ed9aa66d4011', NULL, 231, '2020-06-05 02:29:47', '2020-06-05 02:29:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proposals`
--

CREATE TABLE `proposals` (
  `id` int(11) NOT NULL,
  `company` text NOT NULL,
  `comment` text NOT NULL,
  `points` int(11) DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proposals`
--

INSERT INTO `proposals` (`id`, `company`, `comment`, `points`, `created_at`, `updated_at`) VALUES
(164, 'Burger King ', 'Tener un día de la semana una hamburguesa diferente o personalizada.', 16, '2020-04-22 00:27:54', '2020-06-01 16:32:28'),
(230, 'TELCEL', 'Que el saldo no se congele aunque no me lo haya terminado', 1, '2020-06-03 19:53:02', '2020-06-03 19:53:02'),
(231, 'google', 'Hi!  feebulari.com \r\n \r\nDid yоu knоw thаt it is pоssiblе tо sеnd lеttеr fully lеgаl? \r\nWе sеll а nеw mеthоd оf sеnding соmmеrсiаl оffеr thrоugh соntасt fоrms. Suсh fоrms аrе lосаtеd оn mаny sitеs. \r\nWhеn suсh соmmеrсiаl оffеrs аrе sеnt, nо pеrsоnаl dаtа is usеd, аnd mеssаgеs аrе sеnt tо fоrms spесifiсаlly dеsignеd tо rесеivе mеssаgеs аnd аppеаls. \r\nаlsо, mеssаgеs sеnt thrоugh fееdbасk Fоrms dо nоt gеt intо spаm bесаusе suсh mеssаgеs аrе соnsidеrеd impоrtаnt. \r\nWе оffеr yоu tо tеst оur sеrviсе fоr frее. Wе will sеnd up tо 50,000 mеssаgеs fоr yоu. \r\nThе соst оf sеnding оnе milliоn mеssаgеs is 49 USD. \r\n \r\nThis lеttеr is сrеаtеd аutоmаtiсаlly. Plеаsе usе thе соntасt dеtаils bеlоw tо соntасt us. \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype  FeedbackForm2019 \r\nWhatsApp - +375259112693', 2, '2020-06-04 17:45:43', '2020-06-05 02:29:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'caro.code@hotmail.com', '$2y$10$5UNX.I0CeqORfCv3qlUYJeWjfBGpxo7hO0LDNfSB6Y8br0AT9CIHm', '2020-03-25 03:07:20', '2020-03-25 03:07:20'),
(2, 'karo0wk@gmail.com', '$2y$10$mJ/dQzp/SrkjGz2KPHUYO.penGXMxKS3ljRgbMCZs9J9GC1Yf2O3u', '2020-04-09 16:50:13', '2020-04-09 16:50:13'),
(3, 'caro.code@hotmail.com', '$2y$10$Yu1RMDVUbyzOBOKySHqE2O1fduiRtEdyjI5F2S0zAEsxVzH2LqQFW', '2020-04-11 02:40:34', '2020-04-11 02:40:34'),
(4, 'Ihatepeople82@hotmail.com', '$2y$10$CbyT3NZH2fGqz3OEIt4WluE7V9is6D7LgeRX7fqqQi3Kot7pt..QG', '2020-04-13 04:26:29', '2020-04-13 04:26:29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `persons`
--
ALTER TABLE `persons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
