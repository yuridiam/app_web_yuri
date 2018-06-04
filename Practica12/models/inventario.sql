-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2018 a las 03:11:57
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
  `fecha_registro` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`, `eliminado`, `fecha_registro`) VALUES
(1, 'Carnes Frias', 'Todo tipo de carne', 1, '2018-06-02'),
(2, 'Ropa', 'Todo tipo de ropa unisex', 0, '2018-06-02'),
(3, 'Harina y MaÃ­z', 'Todo tipo de alimentos hechos con harina y maÃ­z', 0, '2018-06-03'),
(4, 'Salchichoneria', 'Todo tipo de corte', 1, '2018-06-04');

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
  `eliminado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id_historial`, `id_producto`, `id_usuario`, `fecha`, `hora`, `nota`, `referencia`, `cantidad`, `movimiento`, `eliminado`) VALUES
(1, 1, 2, '03-06-2018', '01:58:20', 'hola', '18383', 10, 'se quito del stock', 1),
(2, 1, 1, '2018-06-03', '20:46:57', 'hola', '64873', 10, 'Se agregÃ³ al stock', 1),
(3, 2, 1, '2018-06-03', '20:48:26', 'hola', '78363', 1000, 'Se agregÃ³ al stock', 0),
(4, 1, 1, '2018-06-03', '21:00:32', 'hola222', '837837', 1, 'Se agregÃ³ al stock', 1),
(5, 1, 1, '2018-06-03', '21:00:44', 'holajeje', '49794', 20, 'Se quitÃ³ del stock', 1),
(6, 2, 1, '2018-06-03', '21:01:34', 'kdfjljf', '94874', 1001, 'Se quitÃ³ del stock', 0),
(7, 3, 2, '2018-06-03', '22:56:38', 'Con nuevo tipo de tela', '193883', 300, 'Se agregÃ³ al stock', 0),
(8, 4, 2, '2018-06-04', '00:26:46', '', '8498', 50, 'Se agregÃ³ al stock', 1);

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
  `fecha_registro` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `codigo_producto`, `nombre_producto`, `precio_producto`, `stock`, `id_categoria`, `eliminado`, `fecha_registro`) VALUES
(1, '102938', 'Chuleta de Lomo de Cerdo', 40.2, 0, 1, 1, '2018-06-02'),
(2, '3987478', 'Pan de barra con avena', 11.4, 4, 3, 0, '2018-06-03'),
(3, '3947983', 'PantalÃ³n de mezclilla', 100, 321, 2, 0, '2018-06-03'),
(4, '9430943', 'Jamon', 50, 62, 4, 1, '2018-06-04');

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
  `fecha_registro` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `pass`, `eliminado`, `fecha_registro`) VALUES
(1, 'Yuridia Montelongo Padilla', 'yjonas', '123', 0, '2018-06-02'),
(2, 'Mario Rodriguez', 'mrdz', 'mario', 0, '2018-06-02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
