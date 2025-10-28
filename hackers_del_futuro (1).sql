-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2025 a las 15:07:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `equipo_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hackers_del_futuro`
--

CREATE TABLE `hackers_del_futuro` (
  `id` int(11) NOT NULL,
  `integrantes` varchar(18) NOT NULL,
  `no_control` varchar(50) NOT NULL,
  `rol` varchar(30) NOT NULL,
  `img` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hackers_del_futuro`
--

INSERT INTO `hackers_del_futuro` (`id`, `integrantes`, `no_control`, `rol`, `img`) VALUES
(9, 'alexis guerra', '55268091', 'desarrollardor', 'alexis.jpg'),
(10, 'Javier Hernández', '55258902', 'diseñador', 'javier.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hackers_del_futuro`
--
ALTER TABLE `hackers_del_futuro`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hackers_del_futuro`
--
ALTER TABLE `hackers_del_futuro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
