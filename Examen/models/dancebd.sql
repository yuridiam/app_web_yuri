-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2018 a las 20:07:54
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
-- Base de datos: `dancebd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnas`
--

CREATE TABLE `alumnas` (
  `id_alumna` int(11) NOT NULL,
  `nombre_alumna` varchar(100) NOT NULL,
  `grupo_alumna` int(11) NOT NULL,
  `apellidos_alumna` varchar(100) NOT NULL,
  `fecha_nac` varchar(10) NOT NULL,
  `eliminado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnas`
--

INSERT INTO `alumnas` (`id_alumna`, `nombre_alumna`, `grupo_alumna`, `apellidos_alumna`, `fecha_nac`, `eliminado`) VALUES
(1, 'Yuridia', 1, 'Montelongo', '1997-06-27', 0),
(2, 'Yuridia', 1, 'Montelongo', '1997-06-27', 1),
(3, 'Dulce', 3, 'Montelongo', '2000-04-24', 0),
(4, 'Mariana', 3, 'Hinojosa', '1997-10-17', 0),
(5, 'Miguel', 2, 'Hernandez', '1995-06-11', 0),
(6, 'Maria', 3, 'Padilla', '1998-07-16', 0),
(7, 'Miguel', 2, 'Hernandez', '1995-06-11', 0),
(8, 'Dulce ', 2, 'Montelongo', '2000-04-24', 0),
(9, 'Yuridia', 4, 'Montelongo', '1997-06-27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(100) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nombre_grupo`, `eliminado`) VALUES
(1, '1A', 1),
(2, '1B', 0),
(3, '1C', 0),
(4, '1D', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_alumna` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `nom_mama` varchar(200) NOT NULL,
  `ape_mama` varchar(100) NOT NULL,
  `fecha_pago` date NOT NULL,
  `fecha_envio` varchar(20) NOT NULL,
  `url` varchar(300) NOT NULL,
  `folio` varchar(45) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pago`, `id_alumna`, `id_grupo`, `nom_mama`, `ape_mama`, `fecha_pago`, `fecha_envio`, `url`, `folio`, `eliminado`) VALUES
(1, 7, 2, 'Marcela', 'RodrÃ­guez', '1995-06-11', '22-06-2018 21:58:18', '31564007_1914711838573326_8882288454583451648_n.jpg', '9847387', 0),
(2, 4, 3, 'Magdalena', 'Tijerina', '2017-11-11', '22-06-2018 21:58:56', 'tumblr_n1bx3a82QK1sk1hn5o1_1280.jpg', '89347', 0),
(3, 8, 2, 'Maria del Carmen', 'Padilla', '2018-06-22', '23-06-2018 02:05:37', 'tumblr_p00p4g042H1w1bnjeo5_1280.jpg', '984798743', 0),
(4, 9, 4, 'dskj', 'lkjlj', '2017-11-03', '23-06-2018 19:31:08', 'uploads/tumblr_nfmdqyECNT1r18ws3o2_1280.jpg', '48937', 1),
(5, 9, 4, 'kjdsl', 'ljd', '2018-12-31', '23-06-2018 19:33:54', 'tumblr_p5iiildD621v0rykbo3_400.png', '7669', 1),
(6, 4, 3, 'jkh', 'hg', '2017-01-01', '23-06-2018 19:37:13', 'tumblr_nfmdqyECNT1r18ws3o2_1280.jpg', 'jkkhh', 1),
(7, 6, 3, 'kj', 'hjkn', '2018-12-31', '23-06-2018 19:57:07', 'tumblr_p6h4mkIajl1vrpaero5_1280.jpg', '7687', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `pass` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `pass`) VALUES
(1, 'mario', '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnas`
--
ALTER TABLE `alumnas`
  ADD PRIMARY KEY (`id_alumna`),
  ADD KEY `grupo_alumna` (`grupo_alumna`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_alumna` (`id_alumna`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnas`
--
ALTER TABLE `alumnas`
  MODIFY `id_alumna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnas`
--
ALTER TABLE `alumnas`
  ADD CONSTRAINT `alumnas_ibfk_1` FOREIGN KEY (`grupo_alumna`) REFERENCES `grupos` (`id_grupo`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_alumna`) REFERENCES `alumnas` (`id_alumna`),
  ADD CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
