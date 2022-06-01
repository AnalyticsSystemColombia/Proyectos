-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2022 a las 13:33:37
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `acme.sa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductores`
--

CREATE TABLE `conductores` (
  `id` int(11) NOT NULL,
  `cedula` int(20) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `conductores`
--

INSERT INTO `conductores` (`id`, `cedula`, `nombres`, `apellidos`, `direccion`, `telefono`, `ciudad`, `status`) VALUES
(1, 14243444, 'jenny paola', 'riaño forero', 'cra 34- 56-34 A', '602543534', 'medellin', 1),
(2, 56456435, 'carlos andres', 'medina romero', 'cra 5 # 34-45', '601435435', 'Pereira', 1),
(3, 6456464, 'pedro alias', 'fernandez romero', 'cra 45 f #34-45', '601234543', 'bogotá', 1),
(4, 32434324, 'mario enrique', 'perdomo paez', '4324324', '242424', 'pasto', 1),
(5, 45435435, 'Mario hernandez', 'pereira goméz', 'cra 34 -56-67', '602345433', 'calí', 1),
(6, 4324324, 'Jenny camila', 'riaño urutia', 'cra 79 #45-54', '601234543', 'bogotá', 1),
(7, 54353453, 'pedro pablo', 'padilla', 'cra 34 #23-15', '603456765', 'bogotá', 1),
(8, 143232424, 'camila andrea', 'cardozo romero', 'cra 34 #23-45', '601234654', 'ibague', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `id_conductor` int(11) NOT NULL,
  `placa` varchar(12) NOT NULL,
  `color` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `conductor` varchar(255) NOT NULL,
  `propietario` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `id_conductor`, `placa`, `color`, `marca`, `tipo`, `conductor`, `propietario`, `status`) VALUES
(1, 3, 'VUG987', 'negro', 'Mazda', '2', '', 'harold mendoza', 1),
(2, 3, 'hjj234', 'Verde', 'BMW', '2', '', 'harold mendoza', 1),
(3, 5, 'ght456', 'Azul', 'Mazda', '2', '', 'harold mendoza', 1),
(4, 6, 'hgr456', 'negro', 'Volvo', '2', '', 'monica bonilla', 1),
(5, 7, 'rty678', 'rojo', 'Volvo', '2', '', 'hermelinda martinez', 1),
(6, 4, 'vgt567', 'rojo', 'Pegeout', '1', '', 'monica bonilla', 1),
(7, 8, 'vgr456', 'azul', 'BMW', '2', '', 'carlos alcala', 1),
(8, 8, 'HHR234', 'verde', 'BMW', '2', '', 'jenne riaño', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conductores`
--
ALTER TABLE `conductores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_conductor` (`id_conductor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `conductores`
--
ALTER TABLE `conductores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`id_conductor`) REFERENCES `conductores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
