-- phpMyAdmin SQL Dump
-- version 4.0.10deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-10-2020 a las 15:05:52
-- Versión del servidor: 5.5.62-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cetihs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `htq_ficheros`
--

CREATE TABLE IF NOT EXISTS `htq_ficheros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sustancia` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `htq_users`
--

CREATE TABLE IF NOT EXISTS `htq_users` (
  `username` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `password` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `htq_users`
--

INSERT INTO `htq_users` (`username`, `password`) VALUES
('tonalaTQ', 0x74332e63685f4075696d31633473);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
