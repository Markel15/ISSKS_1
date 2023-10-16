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
('ANDER', 'ANDER', 'pruébáñÑ', '11111111-H', '123456789', '1960-12-12', 'email@gmail.com'),
('Juan', 'prueba3', 'Perez', '22222222-J', '123456788', '1980-10-02', 'juan@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `LIBURUA`
--

CREATE TABLE LIBURUA (
  Titulua varchar(30) NOT NULL,
  Autorea varchar(20) NOT NULL,
  Generoa varchar(20) NOT NULL,
  Prezioa float NOT NULL,
  ISBN varchar(17) NOT NULL,
  PRIMARY KEY (ISBN)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `LIBURUA`
--

INSERT INTO LIBURUA VALUES
('The Lord of the Rings', 'J.R.R. Tolkien', 'Fantasia', 30.05, '978-980-14-2517-5');
INSERT INTO LIBURUA VALUES
('Harry Potter', 'J.K. Rolling', 'Fantasia', 22.05, '978-980-14-3318-5');
INSERT INTO LIBURUA VALUES
('Dune', 'Frank Herbert', 'Zientzia-fikzioa', 25.99, '978-0450011849');
INSERT INTO LIBURUA VALUES
('El Código Da Vinci', 'Dan Brown', 'Misterioa', 18.50, '978-0307474278');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ERABILTZAILEA`
--
ALTER TABLE `ERABILTZAILEA`
  ADD PRIMARY KEY (`NAN`),
  ADD UNIQUE KEY `Izena` (`Izena`);


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
