-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2021 a las 04:11:44
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_impresoras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `detalle` varchar(200) NOT NULL,
  `puntaje` int(10) NOT NULL,
  `id_impresora_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `detalle`, `puntaje`, `id_impresora_fk`) VALUES
(163, 'Se tapa rapido', 2, 1),
(164, 'Funciona', 3, 1),
(165, 'Buena calidad', 4, 2),
(166, 'Podria ser mejor.', 3, 41),
(167, 'Sirve para una casa, nada mas.', 4, 41),
(168, 'Se rompe de nada', 1, 41),
(169, 'Requiere mucha calibracion', 1, 44),
(170, 'Imprime desde el primer momento', 3, 44),
(171, 'Muy buena definición', 5, 44),
(172, 'Casi 1,2mt ', 4, 45),
(173, 'Hice 4 metros de lona sin problema', 5, 45),
(174, 'Se tapa el solvente', 2, 45),
(175, 'Fotos a puro color', 5, 46),
(176, 'Calidad excelente', 5, 46),
(177, 'Se marca la imagen', 3, 46),
(178, 'Se trabo el papel, no sirve', 1, 46),
(179, 'Larga las hojas como loco!', 5, 50),
(180, 'Imprime muy bien ', 4, 50),
(181, 'Se atora la hoja ', 2, 50),
(182, 'Sirve para lo que es ', 2, 1),
(183, 'Imprime medio medio ', 3, 2),
(184, 'No sirve ni pa bosta', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impresoras`
--

CREATE TABLE `impresoras` (
  `id_impresora` int(11) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `id_metodo_fk` int(11) NOT NULL,
  `imagen` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `impresoras`
--

INSERT INTO `impresoras` (`id_impresora`, `modelo`, `marca`, `descripcion`, `id_metodo_fk`, `imagen`) VALUES
(1, 'LX300', 'Epson', 'Solo imprime en blanco y negro.', 2, 'img/619efde642d88.jpg'),
(2, 'M651', 'Epson', 'Imprime color, escanea. ', 1, 'img/619efdf0221c7.jpg'),
(41, 'M607', 'HP test 2', 'test_555', 1, 'img/619efdf726e19.jpg'),
(44, 'Ender-3', 'Creality', 'Impresora 3D', 85, 'img/Creality_Ender3.jpg'),
(45, 'Deskjet 430_7', 'Canon', 'Plotter de impresion 3', 81, 'img/619efdff7b0a7.jpg'),
(46, 'ColorMax 750-3', 'Kodak Enterprise', 'Color fotografico', 1, 'img/619efe04d757d.jpg'),
(50, 'CW224-L', 'Brother', 'Laser color A4', 89, 'img/619efe0cc7ae9.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos`
--

CREATE TABLE `metodos` (
  `id_metodo` int(11) NOT NULL,
  `metodo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `metodos`
--

INSERT INTO `metodos` (`id_metodo`, `metodo`) VALUES
(1, 'Laser'),
(2, 'Tinta'),
(3, 'Matriz_de_punto'),
(81, 'Gran formato'),
(85, 'Impresora FMD'),
(89, 'Laser Color');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'administrador'),
(2, 'userBasic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_rol_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `id_rol_fk`) VALUES
(55, 'user@test', '$2y$10$7OfozF0Vvy82QOY9LDcuJunhgeejsUVOyd9/3pgWmVvI6TMeZT9h6', 2),
(64, 'admin@tudai', '$2y$10$fd/IcnY6yxDlFpMIczP4CeGK7fldtaz0OzoU6G1usERKytuqnGUp.', 1),
(65, 'yo@vos', '$2y$10$Gv0Q4VrK.icWifmP2Tdr.uZaRHDpLwyxxTlEJXVhcdV2PlAxKUhQC', 2),
(72, 'joaquin@sarasa', '$2y$10$n2woNapDZS.14uDNrzRE7.XGLEHqVH9agr3WWrNuikfY3.5eZg.BW', 2),
(73, 'sacoa@tudai', '$2y$10$1BokY5rt5hnxtBvmDGvyGOdGrNSl3eFhuFWrE5sg8kyKZM.ACPOdK', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_impresora_fk` (`id_impresora_fk`);

--
-- Indices de la tabla `impresoras`
--
ALTER TABLE `impresoras`
  ADD PRIMARY KEY (`id_impresora`),
  ADD KEY `id_metodo_fk` (`id_metodo_fk`);

--
-- Indices de la tabla `metodos`
--
ALTER TABLE `metodos`
  ADD PRIMARY KEY (`id_metodo`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol_fk` (`id_rol_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT de la tabla `impresoras`
--
ALTER TABLE `impresoras`
  MODIFY `id_impresora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `metodos`
--
ALTER TABLE `metodos`
  MODIFY `id_metodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_impresora_fk`) REFERENCES `impresoras` (`id_impresora`);

--
-- Filtros para la tabla `impresoras`
--
ALTER TABLE `impresoras`
  ADD CONSTRAINT `impresoras_ibfk_1` FOREIGN KEY (`id_metodo_fk`) REFERENCES `metodos` (`id_metodo`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol_fk`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
