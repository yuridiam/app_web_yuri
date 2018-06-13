-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2018 a las 06:55:53
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
(15, 4, 9, '2018-06-13', '05:12:36', '', '938093', 20, 'Se agregÃ³ al stock', 0, 2),
(16, 4, 9, '2018-06-13', '05:25:09', '', '498', 20, 'Se agregÃ³ al stock', 0, 2),
(17, 1, 9, '2018-06-13', '05:46:35', '', '', 0, 'Venta', 0, 2),
(18, 1, 9, '2018-06-13', '05:47:09', '', '', 0, 'Venta', 0, 2),
(19, 1, 9, '2018-06-13', '06:01:06', '', '', 0, 'Venta', 0, 2),
(20, 1, 9, '2018-06-13', '06:06:50', '', '', 0, 'Venta', 0, 2),
(21, 1, 9, '2018-06-13', '06:06:50', '', '', 0, 'Venta', 0, 2),
(22, 1, 9, '2018-06-13', '06:12:02', ' ', ' ', 0, 'Venta', 0, 2),
(23, 1, 9, '2018-06-13', '06:12:02', ' ', ' ', 0, 'Venta', 0, 2),
(24, 1, 9, '2018-06-13', '06:13:41', ' ', ' ', 1, 'Venta', 0, 2),
(25, 4, 9, '2018-06-13', '06:13:41', ' ', ' ', 1, 'Venta', 0, 2),
(26, 4, 9, '2018-06-13', '06:25:20', ' ', ' ', 1, 'Venta', 0, 2),
(27, 4, 9, '2018-06-13', '06:25:20', ' ', ' ', 1, 'Venta', 0, 2),
(28, 1, 9, '2018-06-13', '06:29:21', ' ', ' ', 1, 'Venta', 0, 2),
(29, 1, 9, '2018-06-13', '06:29:21', ' ', ' ', 11, 'Venta', 0, 2),
(30, 1, 9, '2018-06-13', '06:30:20', ' ', ' ', 1, 'Venta', 0, 2),
(31, 1, 9, '2018-06-13', '06:30:20', ' ', ' ', 11, 'Venta', 0, 2),
(32, 1, 9, '2018-06-13', '06:34:21', ' ', ' ', 1, 'Venta', 0, 2),
(33, 1, 9, '2018-06-13', '06:34:21', ' ', ' ', 1, 'Venta', 0, 2),
(34, 1, 9, '2018-06-13', '06:35:24', ' ', ' ', 1, 'Venta', 0, 2),
(35, 4, 9, '2018-06-13', '06:35:24', ' ', ' ', 1, 'Venta', 0, 2),
(36, 1, 9, '2018-06-13', '06:47:21', ' ', ' ', 5, 'Venta', 0, 2),
(37, 4, 9, '2018-06-13', '06:47:21', ' ', ' ', 10, 'Venta', 0, 2);

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
(1, '934898', 'Carne  de res', 100, 93, 1, 0, '2018-06-03', 2),
(2, '9483', 'Pechuga de res', 100, 10, 1, 1, '2018-06-11', 2),
(3, '095848', 'Pan', 30, 200, 2, 1, '2018-06-11', 4),
(4, '3094', 'Pollo', 20, 3, 1, 0, '2018-06-11', 2);

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
(4, 'granD', 'todo tamaulipas', 0);

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
(9, 'Mario Rodriguez', 'mario', 'mario123', 0, '2018-06-03', 1, 1),
(10, 'Yuridia', 'yuri', 'yuri', 0, '2018-06-11', 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `id_tienda`, `id_usuario`, `fecha`, `total`) VALUES
(8, 2, 9, '2018-06-11', 400),
(9, 2, 9, '2018-06-12', 100),
(10, 2, 9, '2018-06-12', 100),
(11, 2, 9, '2018-06-12', 100),
(12, 2, 9, '2018-06-13', 200),
(21, 2, 9, '2018-06-13', 100),
(22, 2, 9, '2018-06-13', 100),
(23, 2, 9, '2018-06-13', 140),
(24, 2, 9, '2018-06-13', 120),
(25, 2, 9, '2018-06-13', 200),
(26, 2, 9, '2018-06-13', 120),
(27, 2, 9, '2018-06-13', 40),
(28, 2, 9, '2018-06-13', 300),
(29, 2, 9, '2018-06-13', 300),
(30, 2, 9, '2018-06-13', 200),
(31, 2, 9, '2018-06-13', 120),
(32, 2, 9, '2018-06-13', 700);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_productos`
--

CREATE TABLE `venta_productos` (
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `unidades` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_productos`
--

INSERT INTO `venta_productos` (`id_venta`, `id_producto`, `unidades`, `total`) VALUES
(8, 1, 4, '400'),
(9, 4, 5, '100'),
(10, 1, 1, '100'),
(11, 1, 1, '100'),
(12, 1, 2, '200'),
(21, 1, 1, '100'),
(22, 1, 1, '100'),
(23, 1, 1, '100'),
(24, 1, 1, '100'),
(24, 4, 1, '20'),
(25, 1, 1, '100'),
(25, 1, 1, '100'),
(26, 1, 1, '100'),
(26, 4, 1, '20'),
(27, 4, 1, '20'),
(27, 4, 1, '20'),
(28, 1, 1, '100'),
(28, 1, 11, '1100'),
(29, 1, 1, '100'),
(29, 1, 11, '1100'),
(30, 1, 1, '100'),
(30, 1, 1, '100'),
(31, 1, 1, '100'),
(31, 4, 1, '20'),
(32, 1, 5, '500'),
(32, 4, 10, '200');

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
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_tienda` (`id_tienda`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `venta_productos`
--
ALTER TABLE `venta_productos`
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

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
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `venta_productos`
--
ALTER TABLE `venta_productos`
  ADD CONSTRAINT `venta_productos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `venta_productos_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
