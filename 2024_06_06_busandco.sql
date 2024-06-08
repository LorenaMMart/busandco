-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2024 a las 20:32:14
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `busandco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordenadas`
--

DROP TABLE IF EXISTS `coordenadas`;
CREATE TABLE IF NOT EXISTS `coordenadas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sublinea_id` int(11) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_979E70798E6EC471` (`sublinea_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `coordenadas`
--

INSERT INTO `coordenadas` (`id`, `sublinea_id`, `latitud`, `longitud`, `orden`) VALUES
(1, 1, 37.93850697659542, -1.1439528887466566, 1),
(2, 1, 37.939855342105034, -1.1448564322444477, 2),
(3, 1, 37.94184609520126, -1.1452922110374961, 3),
(4, 1, 37.94230299522905, -1.1445680145805095, 4),
(5, 1, 37.94164916968006, -1.139808357303189, 5),
(6, 1, 37.941737339575916, -1.1352916221014435, 6),
(7, 1, 37.94227863016878, -1.132389669977968, 7),
(8, 1, 37.94256077104872, -1.1323571462313184, 8),
(9, 1, 37.94875572770925, -1.133985881472336, 9),
(10, 1, 37.95513830249323, -1.1359273686831914, 10),
(11, 1, 37.96018005528527, -1.1370968117861562, 11),
(12, 1, 37.96247422816983, -1.1375805892494695, 12),
(13, 1, 37.96567829496224, -1.1384078909904027, 13),
(14, 1, 37.96719580892208, -1.1387093033437552, 14),
(15, 1, 37.96917024022603, -1.1391587303402235, 15),
(16, 1, 37.975946650866575, -1.1333858409730269, 16),
(17, 1, 37.9751986087919, -1.1316419672950722, 17),
(18, 1, 37.97525204062146, -1.131648129392874, 18),
(19, 1, 37.97516217803517, -1.1291956143343402, 19),
(20, 1, 37.978983671955106, -1.1301538204803558, 20),
(21, 1, 37.98009906859641, -1.1304455177270183, 21),
(22, 1, 37.981354232753596, -1.130789119947327, 22),
(23, 1, 37.981623436514575, -1.1298411132627741, 23),
(24, 1, 37.982742066784986, -1.1290695685907983, 24),
(25, 1, 37.983057288707855, -1.1310798317724369, 25),
(26, 1, 37.98309076352038, -1.1310833709468544, 26),
(27, 1, 37.98317584526825, -1.1316602598581755, 27),
(28, 1, 37.98656772014039, -1.1321451207013644, 28),
(29, 1, 37.98957062165558, -1.1317712858240934, 29),
(30, 1, 37.991620648666085, -1.1309330214337565, 30),
(31, 1, 37.99158200417164, -1.1304053118250783, 31),
(32, 1, 37.99184515443371, -1.1298519172107149, 32),
(33, 1, 37.99244874028017, -1.1296721223360062, 33),
(34, 1, 37.9928664629543, -1.1300644020624209, 34),
(35, 1, 37.99294191040762, -1.1309248489597714, 35),
(36, 1, 37.992682444449336, -1.13135565615893, 36),
(37, 1, 37.99226012025037, -1.1314677360628267, 37),
(38, 1, 37.99191530035102, -1.1327943445836894, 38),
(39, 1, 37.991438525339305, -1.1350549571939001, 39),
(40, 1, 37.991574503475796, -1.1354786014702936, 40),
(41, 1, 37.99407062881478, -1.1362057290766798, 41),
(42, 1, 37.99501104234943, -1.1364165348981288, 42),
(43, 1, 37.99501104234648, -1.1366996705967223, 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `direccion`, `telefono`, `email`, `web`) VALUES
(1, 'TmpMurcia', 'Av. Libertad, 14, 30009, Murcia', '968250088', 'rgpd@monbus.com', 'https://www.tmpmurcia.es'),
(2, 'Transportes de Murcia', 'Plaza de Camachos, 2, 30001, Murcia', '968216405', ' rgpd@gruporuiz.com', 'https://www.tmurcia.com'),
(3, 'Movibus', 'Av. Juan Carlos I, s/n, 30840 Alhama de Murcia, Murcia', '968473106', 'info@movimurcia.es', 'https://www.movimurcia.es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE IF NOT EXISTS `horario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hora` time NOT NULL,
  `tipo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id`, `hora`, `tipo`) VALUES
(1, '08:00:00', 'Laboral'),
(2, '09:30:00', 'Laboral'),
(3, '12:30:00', 'Laboral'),
(4, '15:30:00', 'Laboral'),
(5, '17:00:00', 'Laboral'),
(6, '18:00:00', 'Laboral'),
(7, '20:00:00', 'Laboral'),
(8, '21:30:00', 'Laboral'),
(9, '11:00:00', 'Sabado'),
(10, '14:00:00', 'Sabado'),
(11, '19:00:00', 'Sabado'),
(12, '07:30:00', 'Festivo'),
(13, '10:30:00', 'Festivo'),
(14, '15:00:00', 'Festivo'),
(15, '19:00:00', 'Festivo'),
(16, '08:06:00', 'Laboral'),
(17, '09:36:00', 'Laboral'),
(18, '12:36:00', 'Laboral'),
(19, '15:36:00', 'Laboral'),
(20, '17:06:00', 'Laboral'),
(21, '18:06:00', 'Laboral'),
(22, '20:06:00', 'Laboral'),
(23, '21:36:00', 'Laboral'),
(24, '11:06:00', 'Sabado'),
(25, '14:06:00', 'Sabado'),
(26, '19:06:00', 'Sabado'),
(27, '07:36:00', 'Festivo'),
(28, '10:36:00', 'Festivo'),
(29, '15:06:00', 'Festivo'),
(30, '19:06:00', 'Festivo'),
(31, '08:12:00', 'Laboral'),
(32, '09:42:00', 'Laboral'),
(33, '12:42:00', 'Laboral'),
(34, '15:42:00', 'Laboral'),
(35, '17:12:00', 'Laboral'),
(36, '18:12:00', 'Laboral'),
(37, '20:12:00', 'Laboral'),
(38, '21:42:00', 'Laboral'),
(39, '11:12:00', 'Sabado'),
(40, '14:12:00', 'Sabado'),
(41, '19:12:00', 'Sabado'),
(42, '07:42:00', 'Festivo'),
(43, '10:42:00', 'Festivo'),
(44, '15:12:00', 'Festivo'),
(45, '19:12:00', 'Festivo'),
(46, '08:19:00', 'Laboral'),
(47, '09:49:00', 'Laboral'),
(48, '12:49:00', 'Laboral'),
(49, '15:49:00', 'Laboral'),
(50, '17:19:00', 'Laboral'),
(51, '18:19:00', 'Laboral'),
(52, '20:19:00', 'Laboral'),
(53, '21:49:00', 'Laboral'),
(54, '11:19:00', 'Sabado'),
(55, '14:19:00', 'Sabado'),
(56, '19:19:00', 'Sabado'),
(57, '07:49:00', 'Festivo'),
(58, '10:49:00', 'Festivo'),
(59, '15:19:00', 'Festivo'),
(60, '19:19:00', 'Festivo'),
(61, '08:26:00', 'Laboral'),
(62, '09:56:00', 'Laboral'),
(63, '12:56:00', 'Laboral'),
(64, '15:56:00', 'Laboral'),
(65, '17:26:00', 'Laboral'),
(66, '18:26:00', 'Laboral'),
(67, '20:26:00', 'Laboral'),
(68, '21:56:00', 'Laboral'),
(69, '11:26:00', 'Sabado'),
(70, '14:26:00', 'Sabado'),
(71, '19:26:00', 'Sabado'),
(72, '07:56:00', 'Festivo'),
(73, '10:56:00', 'Festivo'),
(74, '15:26:00', 'Festivo'),
(75, '19:26:00', 'Festivo'),
(76, '07:31:00', 'laboral'),
(77, '08:01:00', 'laboral'),
(78, '09:01:00', 'laboral'),
(79, '10:01:00', 'laboral'),
(80, '10:31:00', 'laboral'),
(81, '11:01:00', 'laboral'),
(82, '11:31:00', 'laboral'),
(83, '12:01:00', 'laboral'),
(84, '12:31:00', 'laboral'),
(85, '13:01:00', 'laboral'),
(86, '13:31:00', 'laboral'),
(87, '14:01:00', 'laboral'),
(88, '15:01:00', 'laboral'),
(89, '16:01:00', 'laboral'),
(90, '16:31:00', 'laboral'),
(91, '17:01:00', 'laboral'),
(92, '17:31:00', 'laboral'),
(93, '18:01:00', 'laboral'),
(94, '18:31:00', 'laboral'),
(95, '19:01:00', 'laboral'),
(96, '20:01:00', 'laboral'),
(97, '20:31:00', 'laboral'),
(98, '21:01:00', 'laboral'),
(99, '21:31:00', 'laboral'),
(100, '22:01:00', 'laboral'),
(101, '22:28:00', 'laboral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencia`
--

DROP TABLE IF EXISTS `incidencia`;
CREATE TABLE IF NOT EXISTS `incidencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `incidencia`
--

INSERT INTO `incidencia` (`id`, `nombre`, `descripcion`, `fecha`, `estado`) VALUES
(1, 'Calle Cartagena Cortada', 'Se corta la calle Cartagena a la altura del número 36 durante 3 días hasta el 23 de marzo de 2024, debido a la realización de obras en la calzada.', '2024-06-17 00:00:00', 1),
(2, 'Obras en la salida de la Universidad', 'Todas las líneas con parada en la salida sur de la Universidad de Murcia sufrirán una modificación en su recorrido durante el mes de Julio', '2024-05-31 00:00:00', 1),
(3, 'Modificación de recorrido por procesión de Jueves ', 'El recorrido de las líneas que circulan por Plaza de San Agustín modificarán su recorrido durante Jueves Santo debido a los cortes en las calles por la que circulará la procesión', '2024-03-28 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias_sublineas`
--

DROP TABLE IF EXISTS `incidencias_sublineas`;
CREATE TABLE IF NOT EXISTS `incidencias_sublineas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incidencia_id` int(11) NOT NULL,
  `sublinea_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8A0D8A648E6EC471` (`sublinea_id`),
  KEY `IDX_8A0D8A64E1605BE2` (`incidencia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `incidencias_sublineas`
--

INSERT INTO `incidencias_sublineas` (`id`, `incidencia_id`, `sublinea_id`) VALUES
(1, 1, 6),
(2, 1, 3),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

DROP TABLE IF EXISTS `linea`;
CREATE TABLE IF NOT EXISTS `linea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activa` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BCB8FDDE521E1991` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`id`, `empresa_id`, `nombre`, `descripcion`, `tipo`, `activa`) VALUES
(1, 1, 'L6', 'La Alberca-Murcia', 'Interurbana', 1),
(2, 1, 'L26', 'El Palmar-Murcia', 'Interurbana', 1),
(3, 2, 'C1', 'Pza Circular- 1º de Mayo-Glorieta', 'Urbana', 1),
(4, 2, 'C2', 'Pza Circular-Pza Camachos-H.San Carlos', 'Urbana', 1),
(5, 1, 'L1', 'San Ginés-Murcia', 'Interurbana', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parada`
--

DROP TABLE IF EXISTS `parada`;
CREATE TABLE IF NOT EXISTS `parada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poblacion_id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ADB5C4F2238957D9` (`poblacion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `parada`
--

INSERT INTO `parada` (`id`, `poblacion_id`, `nombre`, `latitud`, `longitud`) VALUES
(1, 2, 'Vistabella', 37.93845205870166, -1.1439575858259798),
(2, 3, 'El Charco', 37.94215009569323, -1.1323881552750608),
(3, 4, 'Tanatorio Arcoiris', 37.96221696809336, -1.1377886410799087),
(4, 1, 'Estacion de ferrocarril (impar)', 37.975063849718765, -1.1314374267149603),
(5, 1, 'Glorieta de España', 37.9830650824149, -1.1311069779335519),
(6, 1, 'Sta. Isabel', 37.98651433798771, -1.132140098100607),
(7, 1, 'Carcel Vieja', 37.99196376458487, -1.1327669670862717),
(8, 1, 'Santa María de Gracia', 37.99415751258224, -1.1362418895219832);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poblacion`
--

DROP TABLE IF EXISTS `poblacion`;
CREATE TABLE IF NOT EXISTS `poblacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `poblacion`
--

INSERT INTO `poblacion` (`id`, `nombre`) VALUES
(1, 'Murcia'),
(2, 'La Alberca'),
(3, 'Santo Angel'),
(4, 'Santa Catalina'),
(5, 'S.Jose de la Montaña'),
(6, 'El Palmar'),
(7, 'Ctra. El Palmar'),
(8, 'San Gines'),
(9, 'Aljucer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sublinea`
--

DROP TABLE IF EXISTS `sublinea`;
CREATE TABLE IF NOT EXISTS `sublinea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linea_id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C60B120485FE79F8` (`linea_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sublinea`
--

INSERT INTO `sublinea` (`id`, `linea_id`, `nombre`) VALUES
(1, 1, 'A'),
(2, 1, 'B'),
(3, 2, 'A'),
(4, 2, 'B'),
(5, 2, 'C'),
(6, 5, 'A'),
(7, 5, 'B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sublineas_paradas_horarios`
--

DROP TABLE IF EXISTS `sublineas_paradas_horarios`;
CREATE TABLE IF NOT EXISTS `sublineas_paradas_horarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sublinea_id` int(11) NOT NULL,
  `horario_id` int(11) NOT NULL,
  `parada_id` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `direccion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3BB5AEFF8E6EC471` (`sublinea_id`),
  KEY `IDX_3BB5AEFF4959F1BA` (`horario_id`),
  KEY `IDX_3BB5AEFFC49C376A` (`parada_id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sublineas_paradas_horarios`
--

INSERT INTO `sublineas_paradas_horarios` (`id`, `sublinea_id`, `horario_id`, `parada_id`, `orden`, `direccion`) VALUES
(1, 1, 1, 1, 1, 'La Alberca-Murcia'),
(2, 1, 2, 1, 1, 'La Alberca-Murcia'),
(3, 1, 3, 1, 1, 'La Alberca-Murcia'),
(4, 1, 5, 1, 1, 'La Alberca-Murcia'),
(5, 1, 6, 1, 1, 'La Alberca-Murcia'),
(6, 1, 7, 1, 1, 'La Alberca-Murcia'),
(7, 1, 8, 1, 1, 'La Alberca-Murcia'),
(8, 1, 9, 1, 1, 'La Alberca-Murcia'),
(9, 1, 10, 1, 1, 'La Alberca-Murcia'),
(10, 1, 11, 1, 1, 'La Alberca-Murcia'),
(11, 1, 12, 1, 1, 'La Alberca-Murcia'),
(12, 1, 13, 1, 1, 'La Alberca-Murcia'),
(13, 1, 14, 1, 1, 'La Alberca-Murcia'),
(14, 1, 15, 1, 1, 'La Alberca-Murcia'),
(15, 1, 4, 1, 1, 'La Alberca-Murcia'),
(16, 1, 16, 2, 2, 'La Alberca-Murcia'),
(17, 1, 17, 2, 2, 'La Alberca-Murcia'),
(18, 1, 18, 2, 2, 'La Alberca-Murcia'),
(19, 1, 20, 2, 2, 'La Alberca-Murcia'),
(20, 1, 21, 2, 2, 'La Alberca-Murcia'),
(21, 1, 22, 2, 2, 'La Alberca-Murcia'),
(22, 1, 23, 2, 2, 'La Alberca-Murcia'),
(23, 1, 24, 2, 2, 'La Alberca-Murcia'),
(24, 1, 25, 2, 2, 'La Alberca-Murcia'),
(25, 1, 26, 2, 2, 'La Alberca-Murcia'),
(26, 1, 27, 2, 2, 'La Alberca-Murcia'),
(27, 1, 28, 2, 2, 'La Alberca-Murcia'),
(28, 1, 29, 2, 2, 'La Alberca-Murcia'),
(29, 1, 30, 2, 2, 'La Alberca-Murcia'),
(30, 1, 19, 2, 2, 'La Alberca-Murcia'),
(31, 1, 31, 3, 3, 'La Alberca-Murcia'),
(32, 1, 32, 3, 3, 'La Alberca-Murcia'),
(33, 1, 33, 3, 3, 'La Alberca-Murcia'),
(34, 1, 35, 3, 3, 'La Alberca-Murcia'),
(35, 1, 36, 3, 3, 'La Alberca-Murcia'),
(36, 1, 37, 3, 3, 'La Alberca-Murcia'),
(37, 1, 38, 3, 3, 'La Alberca-Murcia'),
(38, 1, 39, 3, 3, 'La Alberca-Murcia'),
(39, 1, 40, 3, 3, 'La Alberca-Murcia'),
(40, 1, 41, 3, 3, 'La Alberca-Murcia'),
(41, 1, 42, 3, 3, 'La Alberca-Murcia'),
(42, 1, 43, 3, 3, 'La Alberca-Murcia'),
(43, 1, 44, 3, 3, 'La Alberca-Murcia'),
(44, 1, 45, 3, 3, 'La Alberca-Murcia'),
(45, 1, 34, 3, 3, 'La Alberca-Murcia'),
(46, 1, 46, 4, 4, 'La Alberca-Murcia'),
(47, 1, 47, 4, 4, 'La Alberca-Murcia'),
(48, 1, 48, 4, 4, 'La Alberca-Murcia'),
(49, 1, 50, 4, 4, 'La Alberca-Murcia'),
(50, 1, 51, 4, 4, 'La Alberca-Murcia'),
(51, 1, 52, 4, 4, 'La Alberca-Murcia'),
(52, 1, 53, 4, 4, 'La Alberca-Murcia'),
(53, 1, 54, 4, 4, 'La Alberca-Murcia'),
(54, 1, 55, 4, 4, 'La Alberca-Murcia'),
(55, 1, 56, 4, 4, 'La Alberca-Murcia'),
(56, 1, 57, 4, 4, 'La Alberca-Murcia'),
(57, 1, 58, 4, 4, 'La Alberca-Murcia'),
(58, 1, 59, 4, 4, 'La Alberca-Murcia'),
(59, 1, 60, 4, 4, 'La Alberca-Murcia'),
(60, 1, 49, 4, 4, 'La Alberca-Murcia'),
(61, 1, 61, 5, 5, 'La Alberca-Murcia'),
(62, 1, 62, 5, 5, 'La Alberca-Murcia'),
(63, 1, 63, 5, 5, 'La Alberca-Murcia'),
(64, 1, 65, 5, 5, 'La Alberca-Murcia'),
(65, 1, 66, 5, 5, 'La Alberca-Murcia'),
(66, 1, 67, 5, 5, 'La Alberca-Murcia'),
(67, 1, 68, 5, 5, 'La Alberca-Murcia'),
(68, 1, 69, 5, 5, 'La Alberca-Murcia'),
(69, 1, 70, 5, 5, 'La Alberca-Murcia'),
(70, 1, 71, 5, 5, 'La Alberca-Murcia'),
(71, 1, 72, 5, 5, 'La Alberca-Murcia'),
(72, 1, 73, 5, 5, 'La Alberca-Murcia'),
(73, 1, 74, 5, 5, 'La Alberca-Murcia'),
(74, 1, 75, 5, 5, 'La Alberca-Murcia'),
(75, 1, 64, 5, 5, 'La Alberca-Murcia'),
(76, 6, 76, 5, 7, 'San Gines-Murcia'),
(77, 6, 77, 5, 7, 'San Gines-Murcia'),
(78, 6, 78, 5, 7, 'San Gines-Murcia'),
(79, 6, 80, 5, 7, 'San Gines-Murcia'),
(80, 6, 81, 5, 7, 'San Gines-Murcia'),
(81, 6, 82, 5, 7, 'San Gines-Murcia'),
(82, 6, 83, 5, 7, 'San Gines-Murcia'),
(83, 6, 84, 5, 7, 'San Gines-Murcia'),
(84, 6, 85, 5, 7, 'San Gines-Murcia'),
(85, 6, 86, 5, 7, 'San Gines-Murcia'),
(86, 6, 87, 5, 7, 'San Gines-Murcia'),
(87, 6, 88, 5, 7, 'San Gines-Murcia'),
(88, 6, 89, 5, 7, 'San Gines-Murcia'),
(89, 6, 90, 5, 7, 'San Gines-Murcia'),
(90, 6, 91, 5, 7, 'San Gines-Murcia'),
(91, 6, 79, 5, 7, 'San Gines-Murcia'),
(92, 6, 80, 5, 7, 'San Gines-Murcia'),
(93, 6, 81, 5, 7, 'San Gines-Murcia'),
(94, 6, 82, 5, 7, 'San Gines-Murcia'),
(95, 6, 83, 5, 7, 'San Gines-Murcia'),
(96, 6, 84, 5, 7, 'San Gines-Murcia'),
(97, 6, 85, 5, 7, 'San Gines-Murcia'),
(98, 6, 86, 5, 7, 'San Gines-Murcia'),
(99, 6, 87, 5, 7, 'San Gines-Murcia'),
(100, 6, 88, 5, 7, 'San Gines-Murcia'),
(101, 6, 89, 5, 7, 'San Gines-Murcia'),
(102, 6, 90, 5, 7, 'San Gines-Murcia'),
(103, 6, 91, 5, 7, 'San Gines-Murcia'),
(104, 6, 92, 5, 7, 'San Gines-Murcia'),
(105, 6, 93, 5, 7, 'San Gines-Murcia'),
(106, 6, 94, 5, 7, 'San Gines-Murcia'),
(107, 6, 95, 5, 7, 'San Gines-Murcia'),
(108, 6, 96, 5, 7, 'San Gines-Murcia'),
(109, 6, 97, 5, 7, 'San Gines-Murcia'),
(110, 6, 98, 5, 7, 'San Gines-Murcia'),
(111, 6, 99, 5, 7, 'San Gines-Murcia'),
(112, 6, 100, 5, 7, 'San Gines-Murcia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
  UNIQUE KEY `UNIQ_2265B05D521E1991` (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `empresa_id`, `email`, `username`, `roles`, `password`) VALUES
(1, 1, 'fernando@planes.es', 'fernando@planes.es', '[]', '$2y$15$t04zKpnOVS3Brh2wUQS7UOJsotPj.u5eaFhBoX8da67HJIyXdfjWe');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `coordenadas`
--
ALTER TABLE `coordenadas`
  ADD CONSTRAINT `FK_979E70798E6EC471` FOREIGN KEY (`sublinea_id`) REFERENCES `sublinea` (`id`);

--
-- Filtros para la tabla `incidencias_sublineas`
--
ALTER TABLE `incidencias_sublineas`
  ADD CONSTRAINT `FK_8A0D8A648E6EC471` FOREIGN KEY (`sublinea_id`) REFERENCES `sublinea` (`id`),
  ADD CONSTRAINT `FK_8A0D8A64E1605BE2` FOREIGN KEY (`incidencia_id`) REFERENCES `incidencia` (`id`);

--
-- Filtros para la tabla `linea`
--
ALTER TABLE `linea`
  ADD CONSTRAINT `FK_BCB8FDDE521E1991` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`);

--
-- Filtros para la tabla `parada`
--
ALTER TABLE `parada`
  ADD CONSTRAINT `FK_ADB5C4F2238957D9` FOREIGN KEY (`poblacion_id`) REFERENCES `poblacion` (`id`);

--
-- Filtros para la tabla `sublinea`
--
ALTER TABLE `sublinea`
  ADD CONSTRAINT `FK_C60B120485FE79F8` FOREIGN KEY (`linea_id`) REFERENCES `linea` (`id`);

--
-- Filtros para la tabla `sublineas_paradas_horarios`
--
ALTER TABLE `sublineas_paradas_horarios`
  ADD CONSTRAINT `FK_3BB5AEFF4959F1BA` FOREIGN KEY (`horario_id`) REFERENCES `horario` (`id`),
  ADD CONSTRAINT `FK_3BB5AEFF8E6EC471` FOREIGN KEY (`sublinea_id`) REFERENCES `sublinea` (`id`),
  ADD CONSTRAINT `FK_3BB5AEFFC49C376A` FOREIGN KEY (`parada_id`) REFERENCES `parada` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_2265B05D521E1991` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
