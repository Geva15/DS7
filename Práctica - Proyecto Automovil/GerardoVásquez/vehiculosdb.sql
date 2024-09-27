-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2024 a las 06:01:11
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
-- Base de datos: `vehiculosdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca_vehiculo`
--

CREATE TABLE `marca_vehiculo` (
  `id_marca` int(11) NOT NULL,
  `marca` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca_vehiculo`
--

INSERT INTO `marca_vehiculo` (`id_marca`, `marca`) VALUES
(1, 'Toyota'),
(2, 'Honda'),
(3, 'Nissan'),
(4, 'Ford'),
(5, 'Chevrolet'),
(6, 'BMW'),
(7, 'Mercedes-Benz'),
(8, 'Hyundai'),
(9, 'Kia'),
(10, 'Volkswagen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo_vehiculo`
--

CREATE TABLE `modelo_vehiculo` (
  `id_modelo` int(11) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `id_marca_fk` int(11) DEFAULT NULL,
  `id_tipo_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modelo_vehiculo`
--

INSERT INTO `modelo_vehiculo` (`id_modelo`, `modelo`, `id_marca_fk`, `id_tipo_fk`) VALUES
(1, 'Corolla', 1, 1),
(2, 'Civic', 2, 1),
(3, 'Altima', 3, 1),
(4, 'Mustang', 4, 5),
(5, 'Camaro', 5, 6),
(6, 'X5', 6, 2),
(7, 'C-Class', 7, 5),
(8, 'Elantra', 8, 1),
(9, 'Sorento', 9, 2),
(10, 'Golf', 10, 3),
(11, 'Accord', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietarios`
--

CREATE TABLE `propietarios` (
  `cedula` varchar(13) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `telefono` int(15) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `tipo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propietarios`
--

INSERT INTO `propietarios` (`cedula`, `nombre`, `apellido`, `telefono`, `direccion`, `tipo`) VALUES
('10-939-4849', 'Ariana', 'Pinkie', 3930394, 'Nueva Vista', 'natural'),
('2-293-3939', 'Arturo', 'Castillo', 88493839, 'Bethania, 38Westh', 'natural'),
('3-245-8795', 'Sebastian', 'Lordfor', 93049591, 'Nuevo Tocumen, calle 24', 'juridico'),
('4-894-73839', 'Ana', 'Cubilla', 88839302, 'Las Americas', 'natural'),
('5-839-4849', 'Talia', 'Burrowers', 8393024, 'Monagrillo', 'natural'),
('5-859-9495', 'Maria', 'Flexford', 37480394, 'El Dorado', 'juridico'),
('6-939-9400', 'Christian', 'Godoy', 38494030, 'Pedregal', 'natural'),
('8-1002-3047', 'Fernado', 'Obarrios', 83924029, 'Rio Abajo', 'natural'),
('8-930-9494', 'Marcelo', 'Versallez', 55759594, 'Tocumen', 'juridico'),
('9-999-9339', 'Paty', 'Zeballo', 6574839, 'San Miguel', 'natural');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_vehiculo`
--

CREATE TABLE `tipo_vehiculo` (
  `id_tipo` int(11) NOT NULL,
  `tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_vehiculo`
--

INSERT INTO `tipo_vehiculo` (`id_tipo`, `tipo`) VALUES
(1, 'Sedán'),
(2, 'SUV'),
(3, 'Hatchback'),
(4, 'Pick-up'),
(5, 'Coupé'),
(6, 'Convertible'),
(7, 'Minivan'),
(8, 'Wagon'),
(9, 'Crossover'),
(10, 'Camioneta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `placa` varchar(10) NOT NULL,
  `anio` year(4) NOT NULL,
  `color` varchar(20) DEFAULT NULL,
  `numero_motor` varchar(30) DEFAULT NULL,
  `numero_chasis` varchar(30) DEFAULT NULL,
  `cedula_fk` varchar(13) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `id_modelo` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`placa`, `anio`, `color`, `numero_motor`, `numero_chasis`, `cedula_fk`, `id_marca`, `id_modelo`, `id_tipo`) VALUES
('JDKD93N39', '2022', 'Negro', 'DJ9F84FNKD', 'JD93HFJ94', '5-839-4849', 9, 9, 2),
('JKD9049D', '2020', 'Gris', 'JD803N304N', 'FH38D0EN03', '8-1002-3047', 1, 1, 1),
('KDK930EJD', '2013', 'Azul', 'JD8940EWC', 'CEN39FN9C', '10-939-4849', 3, 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `marca_vehiculo`
--
ALTER TABLE `marca_vehiculo`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `modelo_vehiculo`
--
ALTER TABLE `modelo_vehiculo`
  ADD PRIMARY KEY (`id_modelo`),
  ADD KEY `fk_marca_new` (`id_marca_fk`),
  ADD KEY `fk_tipo_new` (`id_tipo_fk`);

--
-- Indices de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `tipo_vehiculo`
--
ALTER TABLE `tipo_vehiculo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`placa`),
  ADD KEY `fk_marca` (`id_marca`),
  ADD KEY `fk_modelo` (`id_modelo`),
  ADD KEY `fk_tipo` (`id_tipo`),
  ADD KEY `fk_cedula` (`cedula_fk`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `marca_vehiculo`
--
ALTER TABLE `marca_vehiculo`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `modelo_vehiculo`
--
ALTER TABLE `modelo_vehiculo`
  MODIFY `id_modelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tipo_vehiculo`
--
ALTER TABLE `tipo_vehiculo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `modelo_vehiculo`
--
ALTER TABLE `modelo_vehiculo`
  ADD CONSTRAINT `fk_marca_new` FOREIGN KEY (`id_marca_fk`) REFERENCES `marca_vehiculo` (`id_marca`),
  ADD CONSTRAINT `fk_tipo_new` FOREIGN KEY (`id_tipo_fk`) REFERENCES `tipo_vehiculo` (`id_tipo`);

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `cedula_fk` FOREIGN KEY (`cedula_fk`) REFERENCES `propietarios` (`cedula`),
  ADD CONSTRAINT `fk_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca_vehiculo` (`id_marca`),
  ADD CONSTRAINT `fk_modelo` FOREIGN KEY (`id_modelo`) REFERENCES `modelo_vehiculo` (`id_modelo`),
  ADD CONSTRAINT `fk_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_vehiculo` (`id_tipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
