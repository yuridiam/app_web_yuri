-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2018 a las 11:04:02
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tutorias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `matricula` bigint(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `id_tutor` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`matricula`, `nombre`, `id_carrera`, `id_tutor`, `eliminado`) VALUES
(1530043, 'Miguel HernÃ¡ndez', 2, 847487, 1),
(1530047, 'Jose Antonio Molina de la Fuente', 1, 4949847, 0),
(1530049, 'Monse Montelongo Padilla', 5, 4949847, 1),
(1530065, 'Moises', 4, 847487, 1),
(1530073, 'Benito Briones', 1, 4949847, 1),
(1530074, 'Yuridia Guadalupe Montelongo Padilla', 5, 1530076, 1),
(1530075, 'Monse', 2, 1530076, 1),
(1530076, 'Yuridia Guadalupe Montelongo Padilla', 1, 1593848, 0),
(1530082, 'Sergio Perez Picasso', 2, 847487, 1),
(1530269, 'Mariana Hinojosa', 1, 847487, 0),
(1530456, 'Erick Elizondo', 1, 5985494, 0),
(1533080, 'Juan Padilla P', 2, 1530076, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `siglas` varchar(5) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`, `siglas`, `eliminado`) VALUES
(1, 'Ingenieria en Tecnologias de la Informacion', 'ITI', 0),
(2, 'Ingenieria en Mecatronica', 'IM', 0),
(3, 'Ingenieria en Tecnologias de Manufactura', 'ITM', 0),
(4, 'Ingenieria en Sistemas Automotrices', 'ISA', 0),
(5, 'Licenciatura en Pequeñas y Medianas Empresas', 'PYMES', 0),
(6, 'Videojuegos', 'VD', 1),
(7, 'ldksjlvklfk', 'MDN', 1),
(8, 'Videojuegos', 'VDlfk', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro`
--

CREATE TABLE `maestro` (
  `idempleado` int(11) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(15) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `maestro`
--

INSERT INTO `maestro` (`idempleado`, `id_carrera`, `nombre`, `email`, `pass`, `eliminado`) VALUES
(847487, 1, 'Omar Jasso', 'omar@gmail.com', 'omar123', 0),
(1530076, 5, 'Yuridia Guadalupe Montelongo Padilla', 'yuridia@gmail.com', '123', 1),
(1593848, 1, 'Mario Rodriguez', 'mr@gmail.com', 'mario123', 0),
(4949847, 1, 'Alberto Garcia', 'alberto@gmail.com', 'a123', 0),
(5985494, 5, 'Alma Leticia', 'alma@gmail.com', 'alma123', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutoria`
--

CREATE TABLE `tutoria` (
  `id` int(11) NOT NULL,
  `id_maestro` int(11) NOT NULL,
  `hora` varchar(15) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `tutoria` varchar(150) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tutoria`
--

INSERT INTO `tutoria` (`id`, `id_maestro`, `hora`, `fecha`, `tutoria`, `eliminado`) VALUES
(7, 847487, '13:00', '2018-05-24', 'lkfjd', 1),
(17, 847487, '13:59', '2018-10-30', 'kljs', 1),
(18, 847487, '13:10', '2018-05-26', 'Asuntos sobre el cuatrimestre actual', 0),
(19, 4949847, '13:00', '2018-06-08', 'kfjkj', 1),
(20, 4949847, '08:58', '2018-05-31', 'Importante', 0),
(21, 1593848, '13:50', '2018-06-01', 'Clase', 0),
(22, 5985494, '13:57', '2018-12-31', 'lfk', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutoria_detalles`
--

CREATE TABLE `tutoria_detalles` (
  `id_tutoria` int(11) NOT NULL,
  `id_maestro` int(11) NOT NULL,
  `id_alumno` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tutoria_detalles`
--

INSERT INTO `tutoria_detalles` (`id_tutoria`, `id_maestro`, `id_alumno`) VALUES
(7, 847487, 1530269),
(17, 847487, 1530269),
(17, 847487, 1530269),
(18, 847487, 1530269),
(19, 4949847, 1530073),
(19, 4949847, 1530047),
(20, 4949847, 1530047),
(20, 4949847, 1530073),
(21, 1593848, 1530076),
(22, 5985494, 1530456);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `id_carrera` (`id_carrera`),
  ADD KEY `id_tutor` (`id_tutor`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `maestro`
--
ALTER TABLE `maestro`
  ADD PRIMARY KEY (`idempleado`),
  ADD KEY `id_carrera` (`id_carrera`) USING BTREE;

--
-- Indices de la tabla `tutoria`
--
ALTER TABLE `tutoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_maestro` (`id_maestro`);

--
-- Indices de la tabla `tutoria_detalles`
--
ALTER TABLE `tutoria_detalles`
  ADD KEY `id_maestro` (`id_maestro`) USING BTREE,
  ADD KEY `id_tutoria` (`id_tutoria`) USING BTREE,
  ADD KEY `id_alumno` (`id_alumno`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tutoria`
--
ALTER TABLE `tutoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id`),
  ADD CONSTRAINT `alumno_ibfk_2` FOREIGN KEY (`id_tutor`) REFERENCES `maestro` (`idempleado`);

--
-- Filtros para la tabla `maestro`
--
ALTER TABLE `maestro`
  ADD CONSTRAINT `maestro_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id`);

--
-- Filtros para la tabla `tutoria`
--
ALTER TABLE `tutoria`
  ADD CONSTRAINT `tutoria_ibfk_1` FOREIGN KEY (`id_maestro`) REFERENCES `maestro` (`idempleado`);

--
-- Filtros para la tabla `tutoria_detalles`
--
ALTER TABLE `tutoria_detalles`
  ADD CONSTRAINT `tutoria_detalles_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`matricula`),
  ADD CONSTRAINT `tutoria_detalles_ibfk_2` FOREIGN KEY (`id_maestro`) REFERENCES `maestro` (`idempleado`),
  ADD CONSTRAINT `tutoria_detalles_ibfk_3` FOREIGN KEY (`id_tutoria`) REFERENCES `tutoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
