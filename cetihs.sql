-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2020 a las 03:52:19
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hojastq`
--
CREATE DATABASE IF NOT EXISTS `hojastq` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `hojastq`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `htq_ficheros`
--

CREATE TABLE `htq_ficheros` (
  `id` int(11) NOT NULL,
  `sustancia` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `htq_ficheros`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `htq_users`
--

CREATE TABLE `htq_users` (
  `username` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `password` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `htq_users`
--

INSERT INTO `htq_users` (`username`, `password`) VALUES
('tonalaTQ', 0x743363684075696d316341);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `htq_ficheros`
--
ALTER TABLE `htq_ficheros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `htq_ficheros`
--
ALTER TABLE `htq_ficheros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
