-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 11-10-2023 a las 15:55:36
-- Versión del servidor: 10.8.2-MariaDB-1:10.8.2+maria~focal
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ERABILTZAILEA`
--

CREATE TABLE `ERABILTZAILEA` (
  `Izena` varchar(20) NOT NULL,
  `Pasahitza` varchar(20) NOT NULL,
  `Abizenak` varchar(25) NOT NULL,
  `NAN` varchar(20) NOT NULL,
  `Telefonoa` varchar(15) NOT NULL,
  `Jaiotzedata` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ERABILTZAILEA`
--

INSERT INTO `ERABILTZAILEA` (`Izena`, `Pasahitza`, `Abizenak`, `NAN`, `Telefonoa`, `Jaiotzedata`, `email`) VALUES
('ANDER', 'ANDER', 'pruébáñÑ', '11111111-V', '123456789', '1960-12-12', 'email@gmail.com'),
('Juan', 'prueba3', 'Perez', '22222222-N', '123456788', '1980-10-02', 'juan@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `LIBURUA`
--

CREATE TABLE `LIBURUA` (
  `Titulua` varchar(20) NOT NULL,
  `Autorea` varchar(20) NOT NULL,
  `Generoa` varchar(20) NOT NULL,
  `Prezioa` float NOT NULL,
  `ISBN` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `LIBURUA`
--

INSERT INTO `LIBURUA` (`Titulua`, `Autorea`, `Generoa`, `Prezioa`, `ISBN`) VALUES
('Liburua1', 'Egilea1', 'Misterioa', 30, 123456781);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ERABILTZAILEA`
--
ALTER TABLE `ERABILTZAILEA`
  ADD PRIMARY KEY (`NAN`),
  ADD UNIQUE KEY `Izena` (`Izena`);

--
-- Indices de la tabla `LIBURUA`
--
ALTER TABLE `LIBURUA`
  ADD PRIMARY KEY (`ISBN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
