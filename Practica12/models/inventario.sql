-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2018 a las 11:18:38
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
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `descripcion_categoria` varchar(200) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  `fecha_registro` varchar(10) NOT NULL,
  `id_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`, `eliminado`, `fecha_registro`, `id_tienda`) VALUES
(1, 'Carnes', 'todo tipo de carnes', 0, '2018-06-02', 2),
(2, 'Panaderia', 'Todo tipo de pan', 1, '2018-06-03', 4),
(3, 'Variedades', 'Variedad', 1, '2018-06-11', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id_historial` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `hora` varchar(8) NOT NULL,
  `nota` varchar(200) NOT NULL,
  `referencia` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `movimiento` varchar(100) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  `id_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id_historial`, `id_producto`, `id_usuario`, `fecha`, `hora`, `nota`, `referencia`, `cantidad`, `movimiento`, `eliminado`, `id_tienda`) VALUES
(5, 1, 9, '2018-06-11', '09:03:05', '', '930903', 10, 'Se agregÃ³ al stock', 0, 2),
(6, 1, 9, '2018-06-11', '09:05:16', '', '0439', 80, 'Se agregÃ³ al stock', 0, 2),
(7, 1, 9, '2018-06-11', '09:05:42', '', '939', 10, 'Se agregÃ³ al stock', 0, 2),
(8, 1, 9, '2018-06-11', '09:07:00', '', '09390', 10, 'Se agregÃ³ al stock', 0, 2),
(9, 1, 9, '2018-06-11', '09:16:06', '', '949', 10, 'Se quitÃ³ del stock', 0, 2),
(11, 1, 9, '2018-06-11', '09:19:40', '', '9340', 20, 'Se quitÃ³ del stock', 0, 2),
(12, 1, 9, '2018-06-11', '09:20:54', '', '04993', 10, 'Se quitÃ³ del stock', 0, 2),
(13, 1, 9, '2018-06-11', '09:21:08', '', '0939', 100, 'Se agregÃ³ al stock', 0, 2),
(14, 1, 7, '2018-06-11', '09:22:24', '', '39890', 10, 'Se agregÃ³ al stock', 0, 2),
(15, 3, 9, '2018-06-11', '09:25:22', '', '09382', 100, 'Se agregÃ³ al stock', 0, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `codigo_producto` varchar(20) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `precio_producto` double NOT NULL,
  `stock` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  `fecha_registro` varchar(10) NOT NULL,
  `id_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `codigo_producto`, `nombre_producto`, `precio_producto`, `stock`, `id_categoria`, `eliminado`, `fecha_registro`, `id_tienda`) VALUES
(1, '934898', 'Carne  de res', 100, 140, 1, 0, '2018-06-03', 2),
(2, '9483', 'Pechuga de res', 100, 10, 1, 1, '2018-06-11', 2),
(3, '095848', 'Pan', 30, 200, 2, 1, '2018-06-11', 4),
(4, '3094', 'Pollo', 20, 10, 1, 0, '2018-06-11', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `id_tienda` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `desactivado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`id_tienda`, `nombre`, `direccion`, `desactivado`) VALUES
(1, 'default', 'default', 0),
(2, 'Wallmart', 'En todo el mundo', 0),
(4, 'granD', 'todo tamaulipas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  `fecha_registro` varchar(10) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `pass`, `eliminado`, `fecha_registro`, `id_tienda`, `tipo`) VALUES
(6, 'Yuridia Montelongo', 'yjonas', '123', 0, '2018-06-03', 1, 1),
(7, 'Dulce Montelongo', 'dulce123', 'dulce12', 0, '2018-06-03', 2, 2),
(9, 'Mario Rodriguez', 'mario', 'mario123', 0, '2018-06-03', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_tienda` (`id_tienda`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_tienda` (`id_tienda`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_tienda` (`id_tienda`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`id_tienda`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_tienda` (`id_tienda`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tienda`
--
ALTER TABLE `tienda`
  MODIFY `id_tienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`);

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `historial_ibfk_3` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
