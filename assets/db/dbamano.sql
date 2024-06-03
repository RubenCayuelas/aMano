-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2024 a las 17:08:17
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
-- Base de datos: `dbamano`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` set('0','1') DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_trabajo` int(11) DEFAULT NULL,
  `id_estudio` int(11) NOT NULL,
  `id_fotografo` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id`, `fecha`, `hora`, `estado`, `id_cliente`, `id_trabajo`, `id_estudio`, `id_fotografo`, `id_servicio`) VALUES
(2, '2023-03-23', '10:00:00', NULL, 3, NULL, 6, 1, 1),
(3, '2024-04-23', '10:00:00', '0', 1, NULL, 1, 9, 1),
(4, '2024-04-22', '11:30:00', NULL, 2, NULL, 2, 10, 1),
(5, '2024-04-25', '15:45:00', NULL, 3, NULL, 3, 11, 1),
(6, '2024-05-05', '09:00:00', NULL, 4, NULL, 4, 12, 1),
(7, '2024-05-10', '13:20:00', NULL, 5, NULL, 5, 13, 1),
(8, '2024-05-15', '14:00:00', NULL, 6, NULL, 6, 14, 1),
(9, '2024-05-20', '15:30:00', '1', 7, NULL, 1, 15, 1),
(10, '2024-05-25', '08:45:00', NULL, 8, NULL, 2, 9, 1),
(11, '2024-05-28', '12:15:00', NULL, 9, NULL, 3, 10, 1),
(12, '2024-05-30', '17:00:00', NULL, 10, NULL, 4, 11, 1),
(13, '2024-05-30', '17:00:00', '1', 1, 3, 1, 1, 1),
(14, '2024-05-06', '09:30:00', '0', 2, NULL, 1, 9, 1),
(23, '2024-05-20', '01:33:00', '1', 19, 4, 1, 1, 1),
(24, '2024-05-17', '10:15:00', '0', 20, NULL, 1, 9, 1),
(25, '2024-05-17', '10:15:00', '0', 20, NULL, 1, 9, 1),
(33, '2024-06-07', '09:17:00', '1', 1, NULL, 1, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nick` varchar(25) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `foto` varchar(50) NOT NULL DEFAULT 'defaultUser.png',
  `tlf` int(9) NOT NULL,
  `tlf2` int(9) DEFAULT NULL,
  `activo` set('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `nick`, `pass`, `foto`, `tlf`, `tlf2`, `activo`) VALUES
(1, 'Eugenia Sanchez', 'eugenia032', 'dd0befdf1a53577eb5aecd8c4551c3d0', 'profilePicture_1.jpg', 680574032, NULL, '1'),
(2, 'Carlos Rodriguez', 'carlos245', '10e750bb99efafbddf5856663606b344', 'profilePicture_2.jpg', 612345245, NULL, '1'),
(3, 'Maria Lopez', 'maria738', '86c40d75020fc7134743a2d3880f563b', 'defaultUser.png', 615678738, NULL, '1'),
(4, 'Juan Martinez', 'juan167', '956633bcaca263775c37800b3aec1ddd', 'defaultUser.png', 619876167, NULL, '1'),
(5, 'Laura Garcia', 'laura084', 'b285ff7b4261de42f26256ca30f08e7b', 'defaultUser.png', 629543084, NULL, '1'),
(6, 'David Fernandez', 'david973', '8467e687adb4430aabea5bad1712c242', 'defaultUser.png', 639432973, NULL, '1'),
(7, 'Marta Sanchez', 'marta509', 'a05f9a416d12789ede44c01680c99228', 'defaultUser.png', 649876509, 612345678, '1'),
(8, 'Javier Gonzalez', 'javier392', '82254a1a4d16f64a72659f10eea002f4', 'defaultUser.png', 652348392, NULL, '1'),
(9, 'Ana Martin', 'ana542', '7f5e71bf063f8046d817b3850561af8d', 'defaultUser.png', 662154542, NULL, '1'),
(10, 'Pedro Perez', 'pedro675', '2aecb7418a86f679138d7fcb6f7c7d7c', 'defaultUser.png', 671234675, 634567890, '1'),
(11, 'Lucia Gomez', 'lucia845', 'cc8b0a34072831f39b44c83962072b4b', 'defaultUser.png', 681345845, NULL, '1'),
(12, 'Oscar Ruiz', 'oscar786', '4a5e99010669bfd93106f390ff1c57db', 'defaultUser.png', 691287786, 645678901, '1'),
(13, 'Sara Hernandez', 'sara634', 'ebcffd2fe9447d43490eee07f76e6a6e', 'defaultUser.png', 602345634, NULL, '1'),
(14, 'Pablo Diaz', 'pablo492', '1777c3d4377150cb4761b5028a3b22c2', 'defaultUser.png', 612543492, NULL, '1'),
(15, 'Elena Castro', 'elena873', '22fff49f0e5ce8c0bbe4a2b5870b15d1', 'defaultUser.png', 623456873, NULL, '1'),
(16, 'Daniel Morales', 'daniel926', 'f0f2ca2fbcaaf4ad26e19729d4bebb20', 'defaultUser.png', 634543926, 678123456, '1'),
(17, 'Sofia Navarro', 'sofia458', 'd4cd74a97011341f862149fae2d8d523', 'defaultUser.png', 645678458, NULL, '1'),
(18, 'Alejandro Jimenez', 'alejandro769', '4a2bcf52a15e066c4d472ce9c8a031ad', 'defaultUser.png', 656789769, 690123456, '1'),
(19, 'Paula Vazquez', 'paula352', '9cb61a22ed0925a4e4bdb2340abeefec', 'defaultUser.png', 667890352, NULL, '1'),
(20, 'Manuel Santos', 'manuel879', 'e32d3eb16c4afc3beb6d5e6048f2db5c', 'defaultUser.png', 678905879, NULL, '1'),
(21, 'Carmen Torres', 'carmen284', 'ef97092159b47523b653a9b21eb20005', 'defaultUser.png', 689876284, NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudio`
--

CREATE TABLE `estudio` (
  `id` int(11) NOT NULL,
  `direccion` varchar(80) NOT NULL,
  `tlf` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudio`
--

INSERT INTO `estudio` (`id`, `direccion`, `tlf`) VALUES
(0, 'c/admin', 123456789),
(1, 'c/marinador', 957658421),
(2, 'Calle del Sol, 23', 957860201),
(3, 'Avenida de la Libertad, 45', 956720153),
(4, 'Plaza Mayor, 7', 958430972),
(5, 'Paseo de la Luna, 12', 954320864),
(6, 'Calle de la Estrella, 9', 951567239);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto`
--

CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `foto` varchar(70) NOT NULL,
  `id_trabajo` int(11) NOT NULL,
  `preview` set('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotografo`
--

CREATE TABLE `fotografo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nick` varchar(25) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `foto` varchar(50) NOT NULL DEFAULT 'defaultUser.png',
  `descripcion` varchar(200) DEFAULT NULL,
  `habilidades` varchar(100) NOT NULL,
  `id_estudio` int(11) NOT NULL,
  `activo` set('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fotografo`
--

INSERT INTO `fotografo` (`id`, `nombre`, `nick`, `pass`, `foto`, `descripcion`, `habilidades`, `id_estudio`, `activo`) VALUES
(1, 'Pablo Motos', 'pablo', '2a6757c83da3e883cd3cb842b8ec9a60', 'photograph_profilePicture_1.jpeg', 'Pablito y las motillos', 'retrato', 1, '1'),
(9, 'Laura Garcia', 'laura01', '6f2919e2c7ecb96ed2b1b354de12d597', 'defaultUser.png', NULL, 'naturaleza', 1, '1'),
(10, 'Daniel Sanchez', 'daniel', 'a257ace644b15df945947078d49b8b4b', 'defaultUser.png', NULL, 'eventos sociales', 3, '1'),
(11, 'Maria Rodriguez', 'maria', 'f79059d29aa4304412ba65cd2847dd1b', 'defaultUser.png', NULL, 'moda y publicidad', 2, '1'),
(12, 'Javier Fernandez', 'javier01', 'a4305d04a138058868493f642cc9f96c', 'defaultUser.png', 'Apasionado por la fotografía de paisajes.', 'paisajes', 6, '1'),
(13, 'Ana Martinez', 'ana', '2be3656036b8c326ffd09dc719d4a45e', 'defaultUser.png', 'Especialista en fotografía de arquitectura.', 'arquitectura', 4, '1'),
(14, 'Carlos Gomez', 'carlos', '371c26ae06024553d45bd1414d384cf2', 'defaultUser.png', 'Experto en fotografía deportiva.', 'deportes', 5, '1'),
(15, 'Sofia Lopez', 'sofia01', '3f7a8bd2627ee14d60f21457391287f7', 'defaultUser.png', 'Fotógrafa aficionada con un ojo para el detalle.', 'bodas', 3, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peticion`
--

CREATE TABLE `peticion` (
  `id` int(11) NOT NULL,
  `tipo` set('edit','elim') NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `estado` set('1','0') DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcionista`
--

CREATE TABLE `recepcionista` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nick` varchar(25) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `tlf` int(11) NOT NULL,
  `id_estudio` int(11) NOT NULL,
  `activo` set('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recepcionista`
--

INSERT INTO `recepcionista` (`id`, `nombre`, `nick`, `pass`, `tlf`, `id_estudio`, `activo`) VALUES
(0, 'Admin', 'admin', '67f43efc5701784db1504e4993d7e393', 123456789, 0, '1'),
(1, 'Lola Gimenes', 'lola', '5484e9f096e419f80399b46232c249c7', 653703605, 1, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `img` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre`, `descripcion`, `img`) VALUES
(1, 'Sesión Estándar', 'Fotos rápidas y profesionales para carnet, DNI, y pasaporte. Cumple con todos los requisitos oficiales y asegura imágenes claras y bien iluminadas. ¡Calidad y eficiencia garantizadas!', 'f_estandar.jpg'),
(2, 'Fotografía de Productos', 'Imágenes de alta calidad que destacan cada detalle, perfectas para catálogos, e-commerce y publicidad. ¡Haz que tus productos brillen!', 'f_producto.jpg'),
(3, 'Sesión en estudio', 'Ofrece un entorno controlado y profesional para capturar retratos, fotografía familiar, infantil y más. Obtenemos imágenes que reflejan tu esencia y personalidad.', 'f_estudio2.jpg'),
(4, 'Sesión en exteriores', 'Ideal para comuniones, bodas, cumpleaños y más, capturamos la magia de tus eventos fuera del estudio y en entornos naturales. Fotos llenas de vida y emoción para recordar siempre.', 'f_exterior.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo`
--

CREATE TABLE `trabajo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `publico` set('0','1') NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `id_fotografo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trabajo`
--

INSERT INTO `trabajo` (`id`, `nombre`, `descripcion`, `publico`, `id_servicio`, `id_fotografo`, `id_cliente`) VALUES
(3, 'Eugenia Sánchez Sesión Estándar', 'Eugenia Sánchez Sesión Estándar Test', '1', 1, 1, 1),
(4, 'Paula Vázquez Sesión Estándar', 'Paula Vázquez Sesión Estándar Test', '0', 1, 1, 19);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cita_ibfk_1` (`id_fotografo`),
  ADD KEY `cita_ibfk_2` (`id_estudio`),
  ADD KEY `cita_ibfk_3` (`id_trabajo`),
  ADD KEY `fk_cliente_id` (`id_cliente`),
  ADD KEY `fk_servicio_id` (`id_servicio`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudio`
--
ALTER TABLE `estudio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foto_ibfk_1` (`id_trabajo`);

--
-- Indices de la tabla `fotografo`
--
ALTER TABLE `fotografo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fotografo_ibfk_1` (`id_estudio`);

--
-- Indices de la tabla `peticion`
--
ALTER TABLE `peticion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peticion_ibfk_1` (`id_cita`),
  ADD KEY `peticion_ibfk_2` (`id_cliente`);

--
-- Indices de la tabla `recepcionista`
--
ALTER TABLE `recepcionista`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recepcionista_ibfk_1` (`id_estudio`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajo`
--
ALTER TABLE `trabajo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trabajo_ibfk_1` (`id_cliente`),
  ADD KEY `trabajo_ibfk_2` (`id_fotografo`),
  ADD KEY `trabajo_ibfk_3` (`id_servicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `estudio`
--
ALTER TABLE `estudio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `fotografo`
--
ALTER TABLE `fotografo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `peticion`
--
ALTER TABLE `peticion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recepcionista`
--
ALTER TABLE `recepcionista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `trabajo`
--
ALTER TABLE `trabajo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`id_fotografo`) REFERENCES `fotografo` (`id`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`id_estudio`) REFERENCES `estudio` (`id`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`id_trabajo`) REFERENCES `trabajo` (`id`),
  ADD CONSTRAINT `fk_cliente_id` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `fk_servicio_id` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`);

--
-- Filtros para la tabla `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`id_trabajo`) REFERENCES `trabajo` (`id`);

--
-- Filtros para la tabla `fotografo`
--
ALTER TABLE `fotografo`
  ADD CONSTRAINT `fotografo_ibfk_1` FOREIGN KEY (`id_estudio`) REFERENCES `estudio` (`id`);

--
-- Filtros para la tabla `peticion`
--
ALTER TABLE `peticion`
  ADD CONSTRAINT `peticion_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id`),
  ADD CONSTRAINT `peticion_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `recepcionista`
--
ALTER TABLE `recepcionista`
  ADD CONSTRAINT `recepcionista_ibfk_1` FOREIGN KEY (`id_estudio`) REFERENCES `estudio` (`id`);

--
-- Filtros para la tabla `trabajo`
--
ALTER TABLE `trabajo`
  ADD CONSTRAINT `trabajo_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `trabajo_ibfk_2` FOREIGN KEY (`id_fotografo`) REFERENCES `fotografo` (`id`),
  ADD CONSTRAINT `trabajo_ibfk_3` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
