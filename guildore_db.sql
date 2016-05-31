-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2015 a las 13:21:21
-- Versión del servidor: 5.5.20
-- Versión de PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `guildore`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portfolio`
--

CREATE TABLE IF NOT EXISTS `portfolio` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `user` varchar(2000) NOT NULL,
  `ticker` varchar(200) NOT NULL,
  `shares` int(200) NOT NULL,
  `price` float NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `portfolio`
--

INSERT INTO `portfolio` (`id`, `user`, `ticker`, `shares`, `price`, `date`) VALUES
(4, 'imanol', '^GSPC', 1, 10.5, '2015-04-07 21:28:38'),
(6, 'imanol', 'IBE.MC', 5, 5.5, '2015-04-09 10:52:57'),
(7, 'imanol', 'SAN.MC', 6, 10, '2015-04-09 11:32:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `user` varchar(2000) NOT NULL,
  `pass` varchar(2000) NOT NULL,
  `name` varchar(2000) NOT NULL,
  `surname` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `user`, `pass`, `name`, `surname`) VALUES
(1, 'imanol', 'ad9efc6b39972ee6940fa2fb7e757b87', 'Imanol', 'Pérez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `watchlist`
--

CREATE TABLE IF NOT EXISTS `watchlist` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `user` varchar(2000) NOT NULL,
  `ticker` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `watchlist`
--

INSERT INTO `watchlist` (`id`, `user`, `ticker`) VALUES
(4, 'imanol', 'AMZN');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
