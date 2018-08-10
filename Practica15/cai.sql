-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-08-2018 a las 09:10:39
-- Versión del servidor: 5.7.23-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cai`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id_actividad` int(11) NOT NULL,
  `nombre_actividad` varchar(100) NOT NULL,
  `desc_actividad` varchar(400) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  `lugares` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id_actividad`, `nombre_actividad`, `desc_actividad`, `eliminado`, `lugares`) VALUES
(1, 'Book', 'Read an academic book', 0, 4),
(2, 'PC', 'Use a computer for academy purposes', 0, 16),
(3, 'Gameboards', 'Funny gameboards.', 0, 6),
(4, 'Dancing', 'dancing', 0, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` int(11) NOT NULL,
  `matricula_alumno` varchar(7) NOT NULL,
  `nombre_alumno` varchar(200) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `img_alumno` varchar(300) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `matricula_alumno`, `nombre_alumno`, `id_carrera`, `img_alumno`, `eliminado`) VALUES
(14, '1530074', 'Yuridia Guadalupe Montelongo Padilla', 2, 'large (2).jpg', 0),
(15, '1530269', 'Mariana Hinojosa', 1, 'tumblr_p6z1zqAH5T1s13wj2o2_1280.jpg', 0),
(16, '1530076', 'Monse Montelongo Padilla', 1, 'tumblr_p5iiildD621v0rykbo2_400.png', 1),
(32, '1530370', 'Fher Francisco Torres Paz', 1, 'de-gea-man-utd-barcelona_3329596.jpg', 0),
(33, '346456', 'Benito', 2, 'tumblr_p6go2jqG4f1s13wj2o9_1280.jpg', 0),
(34, '0000000', 'Valentin Elizalde', 1, 'tumblr_p6h4mkIajl1vrpaero1_1280.jpg', 0),
(35, '1530278', 'Luz Paulina', 4, 'tacos_julios.jpg', 0),
(36, '9999999', 'Dishelt Torres', 1, 'icon_fb.png', 0),
(37, '482023', 'Renata Baez', 5, 'dieta-militar-1.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_grupo`
--

CREATE TABLE `alumno_grupo` (
  `id_alumno` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno_grupo`
--

INSERT INTO `alumno_grupo` (`id_alumno`, `id_grupo`) VALUES
(14, 2),
(15, 2),
(14, 1),
(32, 1),
(32, 2),
(33, 1),
(14, 4),
(33, 9),
(35, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id_carrera` int(11) NOT NULL,
  `siglas` varchar(5) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id_carrera`, `siglas`, `nombre`) VALUES
(1, 'ITI', 'Ingenieria en Tecnologias de la Informacion'),
(2, 'ITM', 'Ingenieria en Tecnologias de Manufactura'),
(3, 'ISA', 'Ingenieria en Sistemas Automotrices'),
(4, 'IM', 'Ingenieria en Mecatronica'),
(5, 'PYMES', 'Licenciatura en Pequenas y Medianas Empresas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `id_entrada` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `id_maestro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_entrada` varchar(8) NOT NULL,
  `hora_salida` varchar(8) NOT NULL,
  `horas` int(11) NOT NULL,
  `unidad` varchar(30) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`id_entrada`, `id_alumno`, `id_actividad`, `id_maestro`, `fecha`, `hora_entrada`, `hora_salida`, `horas`, `unidad`, `eliminado`) VALUES
(1, 14, 1, 6, '2018-08-03', '14:02', '17:07', 3, 'Unidad 3', 0),
(3, 14, 1, 6, '2018-08-04', '14:02', '14:53', 1, 'Unidad 3', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `codigo_grupo` varchar(10) NOT NULL,
  `id_maestro` int(11) NOT NULL,
  `nivel` varchar(2) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `codigo_grupo`, `id_maestro`, `nivel`, `eliminado`) VALUES
(1, 'INGLES-201', 1, '9', 0),
(2, 'INGLES-205', 6, '9', 0),
(3, '8378', 8, '1', 1),
(4, '8479387487', 8, '2', 0),
(5, '82934', 6, '5', 0),
(6, '7575666776', 1, '1', 0),
(7, '72931', 7, '9', 0),
(8, '123456789', 7, '1', 0),
(9, '54244', 8, '9', 0),
(10, '8e9w', 6, '1', 0),
(11, '98765577', 1, '1', 0),
(12, '4555767676', 8, '1', 0),
(13, '645654', 1, '1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `horario` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro`
--

CREATE TABLE `maestro` (
  `id_maestro` int(11) NOT NULL,
  `numero_empleado` varchar(7) NOT NULL,
  `nombre_maestro` varchar(200) NOT NULL,
  `telefono_maestro` varchar(50) NOT NULL,
  `direccion_maestro` varchar(300) NOT NULL,
  `fecha_nac` date NOT NULL,
  `img_maestro` varchar(300) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `maestro`
--

INSERT INTO `maestro` (`id_maestro`, `numero_empleado`, `nombre_maestro`, `telefono_maestro`, `direccion_maestro`, `fecha_nac`, `img_maestro`, `usuario`, `pass`, `tipo_usuario`, `eliminado`) VALUES
(1, '1678839', 'Martha Patricia Carranza de Mendoza', '8341892714', 'calle art 15 colonia mariano matamoros', '1955-06-12', '', 'paty', '123', 1, 0),
(2, '1234567', 'Arleth GalvÃ¡n', '8341892714', 'calle articulo 15 #152 colonia mariano matamoros', '2018-01-01', '', 'arleth', '123456', 2, 1),
(5, '303498', 'Benito', '8341892731', 'calle articulo 15 #152 colonia mariano matamoros', '2018-01-01', 'tumblr_p5iiildD621v0rykbo6_1280.png', 'beni', '123', 2, 1),
(6, '9586059', 'Mario Rodriguez Chavez', '8341892714', 'calle articulo 15 col mariano matamoros', '2018-12-31', 's1.JPG', 'mario', '123', 2, 0),
(7, '9438098', 'Maria Padilla', '8341892843', 'calle articulo 15 #152 colonia mariano matamoros', '2015-10-30', 'padre.png', 'maria', '123', 2, 0),
(8, '498438', 'Manuel Rodriguez', '8341892714', 'calle articulo 15 #152 colonia mariano matamoros', '1985-10-11', 'maestro.png', 'manuel', '123', 2, 0),
(13, '8457983', 'Valentin Elizalde', '018341892714', 'calle articulo 15 #152 colonia mariano matamoros', '2018-01-01', 'tumblr_p6z1zqAH5T1s13wj2o1_1280.jpg', 'valentin', '123', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `id` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `id_maestro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_entrada` varchar(20) NOT NULL,
  `unidad` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE `unidad` (
  `id_unidad` int(11) NOT NULL,
  `unidad` varchar(50) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`id_unidad`, `unidad`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 'Unidad 1', '2017-09-04', '2017-09-29'),
(2, 'Unidad 2', '2017-10-02', '2017-10-27'),
(3, 'Unidad 3', '2017-10-30', '2017-11-24'),
(4, 'Unidad 4', '2017-11-27', '2017-12-08'),
(5, 'Unidad 1', '2018-01-08', '2018-02-02'),
(6, 'Unidad 2', '2018-02-05', '2018-03-02'),
(7, 'Unidad 3', '2018-03-05', '2018-03-30'),
(8, 'Unidad 4', '2018-04-02', '2018-04-27'),
(9, 'Unidad 1', '2018-05-01', '2018-05-25'),
(10, 'Unidad 2', '2018-05-28', '2018-06-22'),
(11, 'Unidad 3', '2018-06-25', '2018-08-03'),
(12, 'Unidad 4', '2018-08-06', '2018-08-29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id_actividad`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`),
  ADD UNIQUE KEY `UC_alumno` (`matricula_alumno`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `alumno_grupo`
--
ALTER TABLE `alumno_grupo`
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_actividad` (`id_actividad`),
  ADD KEY `id_maestro` (`id_maestro`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `id_maestro` (`id_maestro`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`);

--
-- Indices de la tabla `maestro`
--
ALTER TABLE `maestro`
  ADD PRIMARY KEY (`id_maestro`),
  ADD UNIQUE KEY `UC_maestro` (`numero_empleado`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_actividad` (`id_actividad`),
  ADD KEY `id_maestro` (`id_maestro`);

--
-- Indices de la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`id_unidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `maestro`
--
ALTER TABLE `maestro`
  MODIFY `id_maestro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `unidad`
--
ALTER TABLE `unidad`
  MODIFY `id_unidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_2` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`);

--
-- Filtros para la tabla `alumno_grupo`
--
ALTER TABLE `alumno_grupo`
  ADD CONSTRAINT `alumno_grupo_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  ADD CONSTRAINT `alumno_grupo_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`);

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  ADD CONSTRAINT `entrada_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`),
  ADD CONSTRAINT `entrada_ibfk_3` FOREIGN KEY (`id_maestro`) REFERENCES `maestro` (`id_maestro`);

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`id_maestro`) REFERENCES `maestro` (`id_maestro`);

--
-- Filtros para la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD CONSTRAINT `sesion_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  ADD CONSTRAINT `sesion_ibfk_3` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`),
  ADD CONSTRAINT `sesion_ibfk_4` FOREIGN KEY (`id_maestro`) REFERENCES `maestro` (`id_maestro`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
