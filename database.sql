-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 27-09-2023 a las 20:30:42
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

CREATE TABLE ERABILTZAILEA (
  Izena varchar(20) NOT NULL,
  Pasahitza varchar(20) NOT NULL,
  PRIMARY KEY (Izena)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ERABILTZAILEA`
--

INSERT INTO ERABILTZAILEA (Izena, Pasahitza) VALUES
('ANDER', 'ANDER');

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
-- Índices para tablas volcadas
--

INSERT INTO LIBURUA VALUES
('The Lord of the Rings', 'J.R.R. Tolkien', 'Fantasia', 30.05, '978-980-14-2517-5');
INSERT INTO LIBURUA VALUES
('Harry Potter', 'J.K. Rolling', 'Fantasia', 22.05, '978-980-14-3318-5');

--
-- Indices de la tabla `ERABILTZAILEA`
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;