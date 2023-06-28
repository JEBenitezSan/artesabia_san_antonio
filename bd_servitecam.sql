-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-01-2023 a las 23:50:50
-- Versión del servidor: 8.0.27
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_servitecam`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE IF NOT EXISTS `admin_user` (
  `id_admin_usuario` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `nombres_user` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apelldos_user` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cedula_user` varchar(14) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `sexo_user` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo_user` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion_user` varchar(700) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nom_ingreuser` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_admin_usuario`),
  UNIQUE KEY `id_usuarios_2` (`id_usuario`),
  KEY `id_usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `admin_user`
--

INSERT INTO `admin_user` (`id_admin_usuario`, `id_usuario`, `nombres_user`, `apelldos_user`, `cedula_user`, `sexo_user`, `correo_user`, `direccion_user`, `nom_ingreuser`) VALUES
(8, 10, 'UsuarioPrueba', 'UsuarioPrueba', '3620801950000U', 'Masculino', 'UsuarioPrueba@gmail.com', 'Camoapa', 'EBenitez'),
(9, 11, 'Jose Esteban ', 'Sanchez Benitez', '3620801950000D', 'Masculino', 'joseestebansanchezbenitez9514@gmail.com', 'Camoapa, iglesia san francisco de asis', 'UsuarioPrueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

DROP TABLE IF EXISTS `caja`;
CREATE TABLE IF NOT EXISTS `caja` (
  `id_caja` int NOT NULL AUTO_INCREMENT,
  `monto_inicial_caja` int NOT NULL,
  `monto_final_caja` float DEFAULT NULL,
  `fecha_apertuta_caja` datetime NOT NULL,
  `fecha_cerrar_caja` datetime DEFAULT NULL,
  `total_cierre_caja` int DEFAULT NULL,
  `estado_caja` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int NOT NULL,
  `descrip_cerrar_caja` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `id_usuario_cerro` int DEFAULT NULL,
  PRIMARY KEY (`id_caja`),
  KEY `id_usuario_cerro` (`id_usuario_cerro`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `monto_inicial_caja`, `monto_final_caja`, `fecha_apertuta_caja`, `fecha_cerrar_caja`, `total_cierre_caja`, `estado_caja`, `id_usuario`, `descrip_cerrar_caja`, `id_usuario_cerro`) VALUES
(10, 0, NULL, '2023-01-17 12:14:57', NULL, NULL, 'Abierto', 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

DROP TABLE IF EXISTS `categoria_producto`;
CREATE TABLE IF NOT EXISTS `categoria_producto` (
  `id_categoria_produc` int NOT NULL AUTO_INCREMENT,
  `categoria` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_cat` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha_ingre_cat` datetime DEFAULT NULL,
  PRIMARY KEY (`id_categoria_produc`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria_producto`
--

INSERT INTO `categoria_producto` (`id_categoria_produc`, `categoria`, `descripcion_cat`, `id_usuario`, `fecha_ingre_cat`) VALUES
(6, 'Accesorios', 'Guardara todos los accesorios', 11, '2022-08-29 17:08:57'),
(7, 'Accesorios Compu', 'Guardara todos los accesorios de computadoras', 11, '2023-01-14 15:23:25'),
(8, 'Sistemas y Redes', 'Guardara todos lo que abarque redes y sistemas', 11, '2023-01-14 15:23:51'),
(9, 'Dispositivo Movil', 'Guardara todos los dispositivo movil', 11, '2023-01-17 10:46:36'),
(10, 'SmartPhone', 'Guardara todos los smartphone', 11, '2023-01-19 12:10:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_precio`
--

DROP TABLE IF EXISTS `cat_precio`;
CREATE TABLE IF NOT EXISTS `cat_precio` (
  `id_precio` int NOT NULL AUTO_INCREMENT,
  `id_stock_produc` int NOT NULL,
  `prec_compra` float NOT NULL,
  `porcen_utili` float NOT NULL,
  `prec_venta` float NOT NULL,
  `fecha_ingre_prec` datetime NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_precio`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_stock_produc` (`id_stock_produc`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cat_precio`
--

INSERT INTO `cat_precio` (`id_precio`, `id_stock_produc`, `prec_compra`, `porcen_utili`, `prec_venta`, `fecha_ingre_prec`, `id_usuario`) VALUES
(1, 10, 200, 75, 350, '2023-01-13 16:41:30', 11),
(2, 11, 120, 100, 240, '2023-01-13 17:35:45', 11),
(3, 12, 100, 100, 200, '2023-01-13 17:58:37', 11),
(4, 13, 500, 50, 750, '2023-01-14 11:26:30', 11),
(5, 14, 700, 36, 952, '2023-01-14 11:34:20', 11),
(6, 15, 70, 100, 140, '2023-01-14 11:43:52', 11),
(7, 16, 50, 140, 120, '2023-01-14 12:00:00', 11),
(8, 17, 250, 52, 380, '2023-01-14 12:14:55', 11),
(9, 18, 300, 50, 450, '2023-01-14 12:18:48', 11),
(10, 19, 700, 50, 1050, '2023-01-14 12:25:21', 11),
(11, 20, 1500, 50, 2250, '2023-01-14 12:32:16', 11),
(12, 21, 22.94, 23, 28.22, '2023-01-14 12:44:57', 11),
(13, 22, 12.51, 24, 15.51, '2023-01-14 12:51:36', 11),
(14, 23, 234, 64, 383.76, '2023-01-14 15:35:22', 11),
(15, 24, 108.5, 75.112, 190, '2023-01-14 15:47:14', 11),
(16, 25, 106.5, 75.589, 187, '2023-01-14 15:56:58', 11),
(17, 26, 77.14, 100.93, 155, '2023-01-14 16:07:37', 11),
(18, 27, 581.59, 50.45, 875, '2023-01-14 16:25:47', 11),
(19, 28, 146, 70.55, 249, '2023-01-14 16:29:48', 11),
(20, 29, 729.6, 52.001, 1109, '2023-01-14 16:36:30', 11),
(21, 30, 1284.65, 50.002, 1927, '2023-01-14 16:41:36', 11),
(22, 31, 35, 300, 140, '2023-01-14 17:11:41', 11),
(23, 32, 25, 260, 90, '2023-01-14 17:19:40', 11),
(24, 33, 12, 233.3, 40, '2023-01-14 17:33:49', 11),
(25, 34, 100, 80, 180, '2023-01-14 17:40:35', 11),
(26, 35, 404, 41.09, 570, '2023-01-16 10:33:40', 11),
(27, 36, 293.6, 43.051, 420, '2023-01-16 10:40:23', 11),
(28, 37, 367, 49.865, 550, '2023-01-16 10:55:15', 11),
(29, 38, 1028, 41.051, 1450, '2023-01-16 11:01:57', 11),
(30, 39, 918, 50, 1377, '2023-01-16 11:16:27', 11),
(31, 40, 257, 40.076, 360, '2023-01-16 11:24:53', 11),
(32, 41, 734, 70.3, 1250, '2023-01-16 11:52:10', 11),
(33, 42, 257, 51.75, 390, '2023-01-16 12:02:24', 11),
(34, 43, 477, 60.377, 765, '2023-01-16 12:15:24', 11),
(35, 44, 1358, 29.602, 1760, '2023-01-16 12:23:12', 11),
(36, 45, 2569, 42.857, 3670, '2023-01-16 12:30:42', 11),
(37, 46, 136, 47.06, 200, '2023-01-16 14:18:22', 11),
(38, 47, 141, 63.12, 230, '2023-01-16 14:26:31', 11),
(39, 48, 151, 72.188, 260, '2023-01-16 14:34:28', 11),
(40, 49, 141, 45.39, 205, '2023-01-16 14:42:48', 11),
(41, 50, 151, 58.94, 240, '2023-01-16 14:54:23', 11),
(42, 51, 172, 56.974, 270, '2023-01-16 15:03:30', 11),
(43, 52, 403, 36.476, 550, '2023-01-16 15:09:40', 11),
(44, 53, 3047, 24.0566, 3780, '2023-01-17 10:53:24', 11),
(45, 54, 200, 115, 430, '2023-01-17 12:00:02', 11),
(46, 55, 64, 150, 160, '2023-01-17 16:47:37', 11),
(47, 56, 65, 84.61, 120, '2023-01-17 17:27:43', 11),
(48, 57, 30, 166.68, 80, '2023-01-17 17:53:44', 11),
(49, 58, 30, 166.68, 80, '2023-01-17 17:54:55', 11),
(50, 59, 130, 100, 260, '2023-01-18 10:29:39', 11),
(51, 60, 100, 100, 200, '2023-01-18 10:55:30', 11),
(52, 61, 50, 180, 140, '2023-01-18 10:58:13', 11),
(53, 62, 40, 100, 80, '2023-01-18 10:59:26', 11),
(54, 63, 80, 125, 180, '2023-01-18 11:00:56', 11),
(55, 64, 120, 100, 240, '2023-01-18 11:05:34', 11),
(56, 65, 180, 100, 360, '2023-01-18 11:08:04', 11),
(57, 66, 60, 100, 120, '2023-01-18 11:09:11', 11),
(58, 67, 150, 66.67, 250, '2023-01-18 11:16:38', 11),
(59, 68, 180, 94.447, 350, '2023-01-18 11:36:15', 11),
(60, 69, 30, 133.35, 70, '2023-01-18 11:44:50', 11),
(61, 70, 35, 157.13, 90, '2023-01-18 11:46:19', 11),
(62, 71, 200, 100, 400, '2023-01-18 11:48:57', 11),
(63, 72, 110, 81.82, 200, '2023-01-18 11:53:51', 11),
(64, 73, 150, 93.33, 290, '2023-01-18 11:56:02', 11),
(65, 74, 450, 100, 900, '2023-01-18 11:59:53', 11),
(66, 75, 900, 66.667, 1500, '2023-01-18 12:03:30', 11),
(67, 76, 80, 50, 120, '2023-01-18 15:04:24', 11),
(68, 77, 70, 42.85, 100, '2023-01-18 15:19:00', 11),
(69, 78, 200, 80, 360, '2023-01-18 15:26:01', 11),
(70, 79, 450, 60, 720, '2023-01-18 15:33:04', 11),
(71, 80, 220, 59.09, 350, '2023-01-18 15:35:41', 11),
(72, 81, 40, 137.5, 95, '2023-01-18 15:37:39', 11),
(73, 82, 80, 125, 180, '2023-01-18 15:40:19', 11),
(74, 83, 50, 80, 90, '2023-01-18 15:42:49', 11),
(75, 84, 80, 87.5, 150, '2023-01-18 15:55:59', 11),
(76, 85, 80, 87.5, 150, '2023-01-18 15:58:02', 11),
(77, 86, 120, 100, 240, '2023-01-18 15:59:26', 11),
(78, 87, 108, 103.7, 220, '2023-01-18 16:12:31', 11),
(79, 88, 450, 68.89, 760, '2023-01-18 16:17:29', 11),
(80, 89, 200, 90, 380, '2023-01-18 16:21:23', 11),
(81, 90, 200, 90, 380, '2023-01-18 16:23:23', 11),
(82, 91, 120, 133.33, 280, '2023-01-18 16:26:14', 11),
(83, 92, 45, 88.9, 85, '2023-01-18 16:36:17', 11),
(84, 93, 400, 62.5, 650, '2023-01-18 16:39:02', 11),
(85, 94, 280, 71.43, 480, '2023-01-18 16:44:45', 11),
(86, 95, 180, 77.78, 320, '2023-01-18 16:46:38', 11),
(87, 96, 140, 78.57, 250, '2023-01-18 16:49:31', 11),
(88, 97, 200, 85, 370, '2023-01-18 17:00:53', 11),
(89, 98, 65, 100, 130, '2023-01-18 17:02:59', 11),
(90, 99, 15, 500, 90, '2023-01-18 17:25:23', 11),
(91, 100, 400, 62.5, 650, '2023-01-18 17:52:27', 11),
(92, 101, 200, 125, 450, '2023-01-18 17:53:41', 11),
(93, 102, 50, 120, 110, '2023-01-18 17:58:41', 11),
(94, 103, 40, 137.5, 95, '2023-01-18 18:00:18', 11),
(95, 104, 120, 86.67, 224, '2023-01-18 18:02:21', 11),
(96, 105, 180, 50, 270, '2023-01-19 09:49:53', 11),
(97, 106, 50, 100, 100, '2023-01-19 09:54:22', 11),
(98, 107, 1400, 28, 1792, '2023-01-19 09:56:59', 11),
(99, 108, 129, 239.532, 438, '2023-01-19 10:31:27', 11),
(100, 109, 147, 148.3, 365, '2023-01-19 10:38:31', 11),
(101, 110, 294, 111.225, 621, '2023-01-19 11:28:19', 11),
(102, 111, 320, 112.5, 680, '2023-01-19 11:37:21', 11),
(103, 112, 150, 100, 300, '2023-01-19 11:39:36', 11),
(104, 113, 734, 49.183, 1095, '2023-01-19 11:48:03', 11),
(105, 114, 387, 15, 445.05, '2023-01-19 11:54:55', 11),
(106, 115, 450, 100, 900, '2023-01-19 12:01:16', 11),
(107, 116, 1500, 26.6669, 1900, '2023-01-19 12:11:23', 11),
(108, 117, 239, 44.35, 345, '2023-01-19 12:17:31', 11),
(109, 118, 8808, 9, 9600.72, '2023-01-19 12:20:19', 11),
(110, 119, 120, 100, 240, '2023-01-19 12:23:19', 11),
(111, 120, 120, 75, 210, '2023-01-19 12:25:37', 11),
(112, 121, 35, 42.87, 50, '2023-01-19 12:35:53', 11),
(113, 122, 6935, 10.5263, 7665, '2023-01-19 12:39:21', 11),
(114, 123, 294, 35.035, 397, '2023-01-19 16:32:15', 11),
(115, 124, 551, 32.487, 730, '2023-01-19 16:37:41', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nombre_cliente` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido_cliente` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `num_cedula` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `num_celular` int NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre_cliente`, `apellido_cliente`, `sexo`, `num_cedula`, `num_celular`, `id_usuario`) VALUES
(7, 'Fernando Jose', 'Herrera Sandoval', 'Masculino', '3620801950000U', 77889955, 11),
(8, 'Jose Esteban', 'Sanchez Benitez', 'Masculino', '3620801950000D', 77884455, 11),
(9, 'Nica ', 'Solar', 'Masculino', '12358697422236G', 85746925, 11),
(10, 'Eliam ', 'Diaz Zeledon', 'Masculino', '3623006031001w', 85382706, 11),
(11, 'Marbelli ', 'Suarez', 'Femenino', '3622602850003G', 76698689, 11),
(12, 'Agrovet', 'Aragon', 'Masculino', '3361245783333f', 77084066, 11),
(13, 'Cliente', 'General', 'Masculino', '00125252500000', 12345678, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE IF NOT EXISTS `compras` (
  `id_compras` int NOT NULL AUTO_INCREMENT,
  `num_fac_compra` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_proveedor` int NOT NULL,
  `fecha_compra` date NOT NULL,
  `total_compra` float NOT NULL,
  `fecha_igreso_user` datetime NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_compras`),
  UNIQUE KEY `num_fac_compra` (`num_fac_compra`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compras`, `num_fac_compra`, `id_proveedor`, `fecha_compra`, `total_compra`, `fecha_igreso_user`, `id_usuario`) VALUES
(1, '68270', 10, '2023-01-13', 10770, '2023-01-13 16:39:16', 11),
(2, '227220', 11, '2023-01-14', 7592, '2023-01-14 15:22:01', 11),
(3, '110123', 12, '2023-01-14', 1120, '2023-01-14 17:04:20', 11),
(4, '12159', 8, '2023-01-16', 11515, '2023-01-16 10:28:50', 11),
(5, '12160', 8, '2023-01-16', 8635, '2023-01-16 14:14:25', 11),
(7, '121600', 8, '2023-01-16', 3047, '2023-01-17 10:44:40', 11),
(8, '17012023', 9, '2023-01-17', 1, '2023-01-17 11:58:01', 11),
(9, '170120238620', 10, '2023-01-17', 0, '2023-01-17 17:45:04', 11),
(10, '18012023487', 9, '2023-01-18', 0, '2023-01-18 16:14:03', 11),
(11, '1801234897', 13, '2023-01-18', 0, '2023-01-18 16:15:52', 11),
(12, '1801201704', 9, '2023-01-18', 0, '2023-01-18 17:04:22', 11),
(13, '19012023487', 8, '2023-01-19', 0, '2023-01-19 10:27:18', 11),
(14, '5789942', 9, '2023-01-19', 0, '2023-01-19 12:00:24', 11),
(15, '19202389', 14, '2023-01-19', 1500, '2023-01-19 12:08:32', 11),
(16, '8795314', 8, '2023-01-19', 0, '2023-01-19 16:29:51', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra_product`
--

DROP TABLE IF EXISTS `detalle_compra_product`;
CREATE TABLE IF NOT EXISTS `detalle_compra_product` (
  `id_compra_stock_pro` int NOT NULL AUTO_INCREMENT,
  `id_compra` int NOT NULL,
  `nom_producto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cod_barra_compra` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cant_producto` float NOT NULL,
  `pre_compra_producto` float NOT NULL,
  `pre_vent_producto` float NOT NULL,
  `fecha_compra_stock` datetime NOT NULL,
  `estado_produc` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_categoria_produc` int NOT NULL,
  PRIMARY KEY (`id_compra_stock_pro`),
  KEY `id_categoria_produc` (`id_categoria_produc`),
  KEY `id_compra` (`id_compra`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_compra_product`
--

INSERT INTO `detalle_compra_product` (`id_compra_stock_pro`, `id_compra`, `nom_producto`, `cod_barra_compra`, `cant_producto`, `pre_compra_producto`, `pre_vent_producto`, `fecha_compra_stock`, `estado_produc`, `id_categoria_produc`) VALUES
(1, 1, 'Samsung_35W_Type_C', '8801811240751', 20, 200, 350, '2023-01-13 16:41:30', 'Disponible', 6),
(2, 1, 'Travel_Adapter_V8', '8806088359502', 10, 120, 240, '2023-01-13 17:35:45', 'Disponible', 6),
(3, 1, 'TravelAdapter_V8_Azul', '88060883595026', 10, 100, 200, '2023-01-13 17:58:37', 'Disponible', 6),
(4, 1, 'PowerBank_Dusty_20', '6973707057261', 1, 500, 750, '2023-01-14 11:26:30', 'Disponible', 6),
(5, 1, 'PowerBank_Lonio_10', '6933138700297', 1, 700, 952, '2023-01-14 11:34:20', 'Disponible', 6),
(6, 1, 'CableUSB_V8Lonio', '22391', 6, 70, 140, '2023-01-14 11:43:52', 'Disponible', 6),
(7, 1, 'CableUSB_LINTypoC', '6954176814852', 6, 50, 120, '2023-01-14 12:00:00', 'Disponible', 6),
(8, 1, 'Bosina_MS2646BT', '1401202645', 1, 250, 380, '2023-01-14 12:14:55', 'Disponible', 6),
(9, 1, 'Bosina_CHV402', '140120402', 2, 300, 450, '2023-01-14 12:18:48', 'Disponible', 6),
(10, 1, 'Bosina_AO623', '140120623', 1, 700, 1050, '2023-01-14 12:25:21', 'Disponible', 6),
(11, 1, 'Bosina_SZ2211', '1401202211', 1, 1500, 2250, '2023-01-14 12:32:16', 'Disponible', 6),
(12, 2, 'CableUTP_CAT6', '1401206356', 100, 22.94, 28.22, '2023-01-14 12:44:57', 'Disponible', 8),
(13, 2, 'CAT6_RJ45', '798302032866', 100, 12.51, 15.51, '2023-01-14 12:51:36', 'Disponible', 8),
(14, 2, 'Adapter_HDMI_VGA_Argom', '886540003943', 2, 234, 383.76, '2023-01-14 15:35:22', 'Disponible', 7),
(15, 2, 'Cable_LaptopXTC120', '798302161443', 2, 108.5, 190, '2023-01-14 15:47:14', 'Disponible', 7),
(16, 2, 'Cable_Alimen_XTC210', '798303111119', 2, 106.5, 187, '2023-01-14 15:56:58', 'Disponible', 7),
(17, 2, 'Cable_USB_TypeC_TO_V8', '886540006548', 2, 77.14, 155, '2023-01-14 16:07:37', 'Disponible', 7),
(18, 2, 'Covertidor_TypoC_HDMI', '886540006029', 1, 581.59, 875, '2023-01-14 16:25:47', 'Disponible', 7),
(19, 2, 'Extencsion_USB3.0', '886540006623', 3, 146, 249, '2023-01-14 16:29:48', 'Disponible', 7),
(20, 2, 'Adaptdor_TypoC_RJ45_Red', '886540006654', 1, 729.6, 1109, '2023-01-14 16:36:30', 'Disponible', 7),
(21, 2, 'Carga_Univer_Laptop', '865400063884', 1, 1284.65, 1927, '2023-01-14 16:41:36', 'Disponible', 7),
(22, 3, 'USB_Typo_C', '1401202329', 6, 35, 140, '2023-01-14 17:11:41', 'Disponible', 6),
(23, 3, 'CableUSB_V8_SAM', '14012023821', 20, 25, 90, '2023-01-14 17:19:40', 'Disponible', 6),
(24, 3, 'Adaptador_Europeo', '1401202312', 20, 12, 40, '2023-01-14 17:33:49', 'Disponible', 6),
(25, 3, 'Bosina_GTS_1346', '1401231346', 2, 100, 180, '2023-01-14 17:40:35', 'Disponible', 6),
(26, 4, 'Mouse_Inalam_M170', '097855124197', 2, 404, 570, '2023-01-16 10:33:40', 'Disponible', 7),
(27, 4, 'MouseUSB_LogiM110', '097855142702', 2, 293.6, 420, '2023-01-16 10:40:23', 'Disponible', 7),
(28, 4, 'Enclosure3.0_Argom', '886540006111', 2, 367, 550, '2023-01-16 10:55:15', 'Disponible', 7),
(29, 4, 'Enclosure_PCIE_M2', '886540007729', 1, 1028, 1450, '2023-01-16 11:01:57', 'Disponible', 7),
(30, 4, 'Audifonos_KlipXtreme_Pulse', '798302078512', 1, 918, 1377, '2023-01-16 11:16:27', 'Disponible', 6),
(31, 4, 'Multipuerto_Argom', '886540000324', 3, 257, 360, '2023-01-16 11:24:53', 'Disponible', 7),
(32, 4, 'Combo_Gamer_KB51', '886540007156', 1, 734, 1250, '2023-01-16 11:52:10', 'Disponible', 7),
(33, 4, 'Teclaso_USB_Argom', '886540006920', 2, 257, 390, '2023-01-16 12:02:24', 'Disponible', 7),
(34, 4, 'Mouse_Gaming_Venom', '798398163499', 2, 477, 765, '2023-01-16 12:15:24', 'Disponible', 7),
(35, 4, 'WebCam_C270_720p', '097855070739', 1, 1358, 1760, '2023-01-16 12:23:12', 'Disponible', 7),
(36, 4, 'BosinaBluWavell_KMS616', '798302077515', 1, 2569, 3670, '2023-01-16 12:30:42', 'Disponible', 7),
(37, 5, 'Micro_Adata_8GB', '13034098', 4, 136, 200, '2023-01-16 14:18:22', 'Disponible', 6),
(38, 5, 'Micro_Adata_16GB', '13034090', 6, 141, 230, '2023-01-16 14:26:31', 'Disponible', 6),
(39, 5, 'Micro_Kings_32GB', '740617298680', 6, 151, 260, '2023-01-16 14:34:28', 'Disponible', 6),
(40, 5, 'USB_Adata_8GB', '11580504', 4, 141, 205, '2023-01-16 14:42:48', 'Disponible', 7),
(41, 5, 'USB_Adata_16GB', '11580147', 6, 151, 240, '2023-01-16 14:54:23', 'Disponible', 7),
(42, 5, 'USB_Kings_32GB', '740617326185', 6, 172, 270, '2023-01-16 15:03:30', 'Disponible', 7),
(43, 5, 'USB_TYPOC_King_32GB', '740617243024', 2, 403, 550, '2023-01-16 15:09:40', 'Disponible', 7),
(44, 7, 'Realme_C30', '861385061210798', 1, 3047, 3780, '2023-01-17 10:53:24', 'Disponible', 9),
(45, 8, 'Otter_Box_MultiModelo', '1701200378', 23, 200, 430, '2023-01-17 12:00:02', 'Disponible', 6),
(46, 8, 'Audi_Celebrat_G12_G13', '6925146950801', 21, 64, 160, '2023-01-17 16:47:37', 'Disponible', 6),
(47, 8, 'Cover_Multiples', '1401202395032', 221, 65, 120, '2023-01-17 17:27:43', 'Disponible', 6),
(48, 9, 'GM_Carga_V8', '14026001', 17, 30, 80, '2023-01-17 17:53:44', 'Disponible', 6),
(49, 9, 'GM_Carga_V3', '14026002', 3, 30, 80, '2023-01-17 17:54:55', 'Disponible', 6),
(50, 9, 'Cover_Multiples_Premiun', '180120231315', 15, 130, 260, '2023-01-18 10:29:39', 'Disponible', 6),
(51, 9, 'Audifonos_AKG_S10', '6954201904201', 3, 100, 200, '2023-01-18 10:55:30', 'Disponible', 6),
(52, 9, 'CableUSB_TypoC', '00510', 4, 50, 140, '2023-01-18 10:58:13', 'Disponible', 6),
(53, 9, 'CableUSB_V3', '156204', 1, 40, 80, '2023-01-18 10:59:26', 'Disponible', 6),
(54, 9, 'CableUSB_LihgtningAAA', '2000410', 2, 80, 180, '2023-01-18 11:00:56', 'Disponible', 6),
(55, 9, 'CargadorHuawei_TypoC', '6967850656181', 2, 120, 240, '2023-01-18 11:05:34', 'Disponible', 6),
(56, 9, 'MicroPhone_Lavalier', '109', 2, 180, 360, '2023-01-18 11:08:04', 'Disponible', 6),
(57, 9, 'Cargador_Economico', '219', 1, 60, 120, '2023-01-18 11:09:11', 'Disponible', 6),
(58, 9, 'Power_Lightning_Ori', '885909627363', 6, 150, 250, '2023-01-18 11:16:38', 'Disponible', 6),
(59, 9, 'Power_Lightning_Ori', '885909627363', 4, 150, 250, '2023-01-18 11:24:45', 'Disponible', 6),
(60, 9, 'CargaHuawei_TypoC', '2000098', 5, 180, 350, '2023-01-18 11:36:15', 'Disponible', 6),
(61, 9, 'OTG_TYPOC', '464', 3, 30, 70, '2023-01-18 11:44:50', 'Disponible', 6),
(62, 9, 'OTG_TypopC_V8', '463', 2, 35, 90, '2023-01-18 11:46:19', 'Disponible', 6),
(63, 9, 'Cargador_RealmeC', '36527485', 3, 200, 400, '2023-01-18 11:48:57', 'Disponible', 6),
(64, 9, 'SpeedUSB_Multiples', '416', 4, 110, 200, '2023-01-18 11:53:51', 'Disponible', 6),
(65, 9, 'AudiNote_TypoC', '2000621', 2, 150, 290, '2023-01-18 11:56:02', 'Disponible', 6),
(66, 9, 'AudifoBOSE_InalamP12', '141P12', 14, 450, 900, '2023-01-18 11:59:53', 'Disponible', 6),
(67, 9, 'AudiGaming_Compu', '0305541890005', 2, 900, 1500, '2023-01-18 12:03:30', 'Disponible', 6),
(68, 9, 'Auxiliar_Celebrat', '6925146990081', 7, 80, 120, '2023-01-18 15:04:24', 'Disponible', 6),
(69, 9, 'Selfie_Flexi_Pod', '6459751458518', 8, 70, 100, '2023-01-18 15:19:00', 'Disponible', 6),
(70, 9, 'CoverMagnetic_Iphone', '480', 5, 200, 360, '2023-01-18 15:26:01', 'Disponible', 6),
(71, 9, 'WirelessCharger', '273', 2, 450, 720, '2023-01-18 15:33:04', 'Disponible', 6),
(72, 9, 'Amplifier_Pantalla', '6985427854853', 2, 220, 350, '2023-01-18 15:35:41', 'Disponible', 6),
(73, 9, 'Cover_Watch4044mm', '465', 5, 40, 95, '2023-01-18 15:37:39', 'Disponible', 6),
(74, 9, 'Audifonos_S8', '6999969795659', 3, 80, 180, '2023-01-18 15:40:19', 'Disponible', 6),
(75, 9, 'AdaptadorUSB_MicroSD', '9134504492755', 5, 50, 90, '2023-01-18 15:42:49', 'Disponible', 6),
(76, 9, 'AdaptaTypoC_Aux3.5', '6925146938083', 2, 80, 150, '2023-01-18 15:55:59', 'Disponible', 6),
(77, 9, 'CableUSBTypeC_TypeC', '6925146981270', 1, 80, 150, '2023-01-18 15:58:02', 'Disponible', 6),
(78, 9, 'CargaAudi_Lightning', '266', 1, 120, 240, '2023-01-18 15:59:26', 'Disponible', 6),
(79, 9, 'Holder_S031', '2020121013510', 2, 108, 220, '2023-01-18 16:12:31', 'Disponible', 6),
(80, 11, 'Gaming_K150', '0305541801506', 1, 450, 760, '2023-01-18 16:17:29', 'Disponible', 6),
(81, 11, 'AudoGaming_K12122', '264', 2, 200, 380, '2023-01-18 16:21:23', 'Disponible', 6),
(82, 11, 'Carga_Vehiculo', '8502916516580', 2, 200, 380, '2023-01-18 16:23:23', 'Disponible', 6),
(83, 11, 'Holder_Vehiculo', '348', 2, 120, 280, '2023-01-18 16:26:14', 'Disponible', 6),
(84, 11, 'PockSocker', '466', 8, 45, 85, '2023-01-18 16:36:17', 'Disponible', 6),
(85, 11, 'Cargador_Mutiple', '315', 1, 400, 650, '2023-01-18 16:39:02', 'Disponible', 6),
(86, 11, 'CableHDMI_10Mts', '6957156272147', 1, 280, 480, '2023-01-18 16:44:45', 'Disponible', 6),
(87, 11, 'CableHDMI_5Mts', '6957145404689', 1, 180, 320, '2023-01-18 16:46:38', 'Disponible', 6),
(88, 11, 'CableHDMI_3Mts', '52310401', 1, 140, 250, '2023-01-18 16:49:31', 'Disponible', 6),
(89, 11, 'Travel_Adapter_V8', '8806088359502', 2, 120, 240, '2023-01-18 16:57:20', 'Disponible', 6),
(90, 11, 'HolderTripode_XT02P', '424', 4, 200, 370, '2023-01-18 17:00:53', 'Disponible', 6),
(91, 11, 'PAD_MOUSE', '471', 2, 65, 130, '2023-01-18 17:02:59', 'Disponible', 6),
(92, 12, 'Glass_MultiplesModel', '180120231724', 167, 15, 90, '2023-01-18 17:25:23', 'Disponible', 6),
(93, 12, 'AudiInpods13_Inalam', '390', 1, 400, 650, '2023-01-18 17:52:27', 'Disponible', 6),
(94, 12, 'inPods12', '359', 5, 200, 450, '2023-01-18 17:53:41', 'Disponible', 6),
(95, 12, 'CargadorS4_Econo', '843163017559', 5, 50, 110, '2023-01-18 17:58:41', 'Disponible', 6),
(96, 12, 'CargaV8_Vehiculo', '354', 3, 40, 95, '2023-01-18 18:00:18', 'Disponible', 6),
(97, 12, 'Holder_FCC309', '391', 2, 120, 224, '2023-01-18 18:02:21', 'Disponible', 6),
(98, 12, 'Holder_Stents', '1601011', 1, 180, 270, '2023-01-19 09:49:53', 'Disponible', 6),
(99, 12, 'Cuvo_Samsung', '190120', 5, 50, 100, '2023-01-19 09:54:22', 'Disponible', 6),
(100, 12, 'Bosina_PromoAux', '19012023503', 1, 1400, 1792, '2023-01-19 09:56:59', 'Disponible', 6),
(101, 13, 'USB_C_to_Lightning_2Mts_Orig', '888462496988', 6, 129, 438, '2023-01-19 10:31:27', 'Disponible', 6),
(102, 13, 'Lightning_to_USB1M_Orig', '190198531704', 6, 147, 365, '2023-01-19 10:38:31', 'Disponible', 6),
(103, 13, 'Power_Adap_USBC20W_Orig', '194252156940', 6, 294, 621, '2023-01-19 11:28:19', 'Disponible', 6),
(104, 13, 'PowerLightning20W', '190198889966', 6, 320, 680, '2023-01-19 11:37:21', 'Disponible', 6),
(105, 13, 'USB_C_Lightnin', '190198496263', 2, 150, 300, '2023-01-19 11:39:36', 'Disponible', 6),
(106, 13, 'MagSafeCharger20W_Orig', '194252192450', 2, 734, 1095, '2023-01-19 11:48:03', 'Disponible', 6),
(107, 13, 'LimpiContactoSabo', '811176000165', 2, 387, 445.05, '2023-01-19 11:54:55', 'Disponible', 8),
(108, 14, 'AudiWireless_A24', '6925146923362', 2, 450, 900, '2023-01-19 12:01:16', 'Disponible', 6),
(109, 15, 'ZTEBladeA31Lite', '865196054224795', 1, 1500, 1900, '2023-01-19 12:11:23', 'Disponible', 10),
(110, 15, 'MouseXKlipTremeUSB', '211022499', 1, 239, 345, '2023-01-19 12:17:31', 'Disponible', 7),
(111, 15, 'Iphone8plus_SemiN', '19120238', 1, 8808, 9600.72, '2023-01-19 12:20:19', 'Disponible', 10),
(112, 15, 'CableDePoderCPU', '1512532', 2, 120, 240, '2023-01-19 12:23:19', 'Disponible', 7),
(113, 15, 'CableVGA', '190120232919', 1, 120, 210, '2023-01-19 12:25:37', 'Disponible', 7),
(114, 15, 'SimcarChip_Tigo', '19120235012', 10, 35, 50, '2023-01-19 12:35:53', 'Disponible', 6),
(115, 15, 'A23', '8950530312579', 7, 6935, 7665, '2023-01-19 12:39:21', 'Disponible', 10),
(116, 16, 'Bluetooth4.0_USB', '6935364099664', 1, 294, 397, '2023-01-19 16:32:15', 'Disponible', 7),
(117, 16, 'EnclosureEX500', '14860200', 1, 551, 730, '2023-01-19 16:37:41', 'Disponible', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

DROP TABLE IF EXISTS `detalle_factura`;
CREATE TABLE IF NOT EXISTS `detalle_factura` (
  `id_detall_factura` int NOT NULL AUTO_INCREMENT,
  `id_num_factura` int NOT NULL,
  `id_stock_produc` int DEFAULT NULL,
  `id_servicio` int DEFAULT NULL,
  `prec_venta_detall` float NOT NULL,
  `cant_detall` int NOT NULL,
  `sub_total` float NOT NULL,
  `id_usuario` int NOT NULL,
  `id_detall_stock_pro` int DEFAULT NULL,
  PRIMARY KEY (`id_detall_factura`),
  KEY `id_num_factura` (`id_num_factura`),
  KEY `id_num_factura_2` (`id_num_factura`),
  KEY `id_stock_produc` (`id_stock_produc`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_detall_stock_pro` (`id_detall_stock_pro`),
  KEY `id_servicio` (`id_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_detall_factura`, `id_num_factura`, `id_stock_produc`, `id_servicio`, `prec_venta_detall`, `cant_detall`, `sub_total`, `id_usuario`, `id_detall_stock_pro`) VALUES
(16, 11, 11, NULL, 240, 1, 240, 11, 10),
(17, 12, 16, NULL, 120, 1, 120, 11, 15),
(18, 13, 49, NULL, 200, 1, 200, 11, 48),
(19, 14, 54, NULL, 430, 1, 430, 11, 53),
(20, 14, 99, NULL, 70, 1, 70, 11, 100),
(21, 15, 99, NULL, 90, 1, 90, 11, 100),
(22, 16, 56, NULL, 80, 1, 80, 11, 55),
(23, 16, 48, NULL, 260, 1, 260, 11, 47),
(24, 17, 12, NULL, 200, 1, 200, 11, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_stock_product`
--

DROP TABLE IF EXISTS `detalle_stock_product`;
CREATE TABLE IF NOT EXISTS `detalle_stock_product` (
  `id_detall_stock_pro` int NOT NULL AUTO_INCREMENT,
  `id_stock_produc` int NOT NULL,
  `nom_producto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cant_producto` float NOT NULL,
  `id_proveedor` int NOT NULL,
  `fecha_ingres_stock` datetime NOT NULL,
  `estado_produc` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_categoria_produc` int NOT NULL,
  PRIMARY KEY (`id_detall_stock_pro`),
  KEY `id_stock_produc` (`id_stock_produc`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_categoria_produc` (`id_categoria_produc`),
  KEY `id_categoria_produc_2` (`id_categoria_produc`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_stock_product`
--

INSERT INTO `detalle_stock_product` (`id_detall_stock_pro`, `id_stock_produc`, `nom_producto`, `cant_producto`, `id_proveedor`, `fecha_ingres_stock`, `estado_produc`, `id_categoria_produc`) VALUES
(4, 3, 'Realme_C21_Y', 0, 8, '2022-12-17 16:50:24', 'Disponible', 6),
(5, 10, 'Samsung_35W_Type_C', 20, 10, '2023-01-13 16:41:30', 'Disponible', 6),
(10, 11, 'Travel_Adapter_V8', 9, 10, '2023-01-13 17:35:45', 'Disponible', 6),
(11, 12, 'TravelAdapter_V8_Azul', 9, 10, '2023-01-13 17:58:37', 'Disponible', 6),
(12, 13, 'PowerBank_Dusty_20', 1, 10, '2023-01-14 11:26:30', 'Disponible', 6),
(13, 14, 'PowerBank_Lonio_10', 1, 10, '2023-01-14 11:34:20', 'Disponible', 6),
(14, 15, 'CableUSB_V8Lonio', 6, 10, '2023-01-14 11:43:52', 'Disponible', 6),
(15, 16, 'CableUSB_LINTypoC', 5, 10, '2023-01-14 12:00:00', 'Disponible', 6),
(16, 17, 'Bosina_MS2646BT', 1, 10, '2023-01-14 12:14:55', 'Disponible', 6),
(17, 18, 'Bosina_CHV402', 2, 10, '2023-01-14 12:18:48', 'Disponible', 6),
(18, 19, 'Bosina_AO623', 1, 10, '2023-01-14 12:25:21', 'Disponible', 6),
(19, 20, 'Bosina_SZ2211', 1, 10, '2023-01-14 12:32:16', 'Disponible', 6),
(20, 21, 'CableUTP_CAT6', 100, 11, '2023-01-14 12:44:57', 'Disponible', 6),
(21, 22, 'CAT6_RJ45', 100, 11, '2023-01-14 12:51:36', 'Disponible', 6),
(22, 23, 'Adapter_HDMI_VGA_Argom', 2, 11, '2023-01-14 15:35:22', 'Disponible', 7),
(23, 24, 'Cable_LaptopXTC120', 2, 11, '2023-01-14 15:47:14', 'Disponible', 7),
(24, 25, 'Cable_Alimen_XTC210', 2, 11, '2023-01-14 15:56:58', 'Disponible', 7),
(25, 26, 'Cable_USB_TypeC_TO_V8', 2, 11, '2023-01-14 16:07:37', 'Disponible', 7),
(26, 27, 'Covertidor_TypoC_HDMI', 1, 11, '2023-01-14 16:25:47', 'Disponible', 7),
(27, 28, 'Extencsion_USB3.0', 3, 11, '2023-01-14 16:29:48', 'Disponible', 7),
(28, 29, 'Adaptdor_TypoC_RJ45_Red', 1, 11, '2023-01-14 16:36:30', 'Disponible', 7),
(29, 30, 'Carga_Univer_Laptop', 1, 11, '2023-01-14 16:41:36', 'Disponible', 7),
(30, 31, 'USB_Typo_C', 6, 12, '2023-01-14 17:11:41', 'Disponible', 6),
(31, 32, 'CableUSB_V8_SAM', 20, 12, '2023-01-14 17:19:40', 'Disponible', 6),
(32, 33, 'Adaptador_Europeo', 20, 12, '2023-01-14 17:33:49', 'Disponible', 6),
(33, 34, 'Bosina_GTS_1346', 2, 12, '2023-01-14 17:40:35', 'Disponible', 6),
(34, 35, 'Mouse_Inalam_M170', 2, 8, '2023-01-16 10:33:40', 'Disponible', 7),
(35, 36, 'MouseUSB_LogiM110', 2, 8, '2023-01-16 10:40:23', 'Disponible', 7),
(36, 37, 'Enclosure3.0_Argom', 2, 8, '2023-01-16 10:55:15', 'Disponible', 7),
(37, 38, 'Enclosure_PCIE_M2', 1, 8, '2023-01-16 11:01:57', 'Disponible', 7),
(38, 39, 'Audifonos_KlipXtreme_Pulse', 1, 8, '2023-01-16 11:16:27', 'Disponible', 6),
(39, 40, 'Multipuerto_Argom', 3, 8, '2023-01-16 11:24:53', 'Disponible', 7),
(40, 41, 'Combo_Gamer_KB51', 1, 8, '2023-01-16 11:52:10', 'Disponible', 7),
(41, 42, 'Teclaso_USB_Argom', 2, 8, '2023-01-16 12:02:24', 'Disponible', 7),
(42, 43, 'Mouse_Gaming_Venom', 2, 8, '2023-01-16 12:15:24', 'Disponible', 7),
(43, 44, 'WebCam_C270_720p', 1, 8, '2023-01-16 12:23:12', 'Disponible', 7),
(44, 45, 'BosinaBluWavell_KMS616', 1, 8, '2023-01-16 12:30:42', 'Disponible', 7),
(45, 46, 'Micro_Adata_8GB', 4, 8, '2023-01-16 14:18:22', 'Disponible', 6),
(46, 47, 'Micro_Adata_16GB', 6, 8, '2023-01-16 14:26:31', 'Disponible', 6),
(47, 48, 'Micro_Kings_32GB', 5, 8, '2023-01-16 14:34:28', 'Disponible', 6),
(48, 49, 'USB_Adata_8GB', 3, 8, '2023-01-16 14:42:48', 'Disponible', 7),
(49, 50, 'USB_Adata_16GB', 6, 8, '2023-01-16 14:54:23', 'Disponible', 7),
(50, 51, 'USB_Kings_32GB', 6, 8, '2023-01-16 15:03:30', 'Disponible', 7),
(51, 52, 'USB_TYPOC_King_32GB', 2, 8, '2023-01-16 15:09:40', 'Disponible', 7),
(52, 53, 'Realme_C30', 1, 8, '2023-01-17 10:53:24', 'Disponible', 9),
(53, 54, 'Otter_Box_MultiModelo', 22, 9, '2023-01-17 12:00:02', 'Disponible', 6),
(54, 55, 'Audi_Celebrat_G12_G13', 21, 9, '2023-01-17 16:47:37', 'Disponible', 6),
(55, 56, 'Cover_Multiples', 220, 9, '2023-01-17 17:27:43', 'Disponible', 6),
(56, 57, 'GM_Carga_V8', 17, 10, '2023-01-17 17:53:44', 'Disponible', 6),
(57, 58, 'GM_Carga_V3', 3, 10, '2023-01-17 17:54:55', 'Disponible', 6),
(58, 59, 'Cover_Multiples_Premiun', 15, 10, '2023-01-18 10:29:39', 'Disponible', 6),
(59, 60, 'Audifonos_AKG_S10', 3, 10, '2023-01-18 10:55:30', 'Disponible', 6),
(60, 61, 'CableUSB_TypoC', 4, 10, '2023-01-18 10:58:13', 'Disponible', 6),
(61, 62, 'CableUSB_V3', 1, 10, '2023-01-18 10:59:26', 'Disponible', 6),
(62, 63, 'CableUSB_LihgtningAAA', 2, 10, '2023-01-18 11:00:56', 'Disponible', 6),
(63, 64, 'CargadorHuawei_TypoC', 2, 10, '2023-01-18 11:05:34', 'Disponible', 6),
(64, 65, 'MicroPhone_Lavalier', 2, 10, '2023-01-18 11:08:04', 'Disponible', 6),
(65, 66, 'Cargador_Economico', 1, 10, '2023-01-18 11:09:11', 'Disponible', 6),
(66, 67, 'Power_Lightning_Ori', 6, 10, '2023-01-18 11:16:38', 'Disponible', 6),
(67, 67, 'Power_Lightning_Ori', 4, 10, '2023-01-18 11:24:45', 'Disponible', 6),
(68, 68, 'CargaHuawei_TypoC', 5, 10, '2023-01-18 11:36:15', 'Disponible', 6),
(69, 69, 'OTG_TYPOC', 3, 10, '2023-01-18 11:44:50', 'Disponible', 6),
(70, 70, 'OTG_TypopC_V8', 2, 10, '2023-01-18 11:46:19', 'Disponible', 6),
(71, 71, 'Cargador_RealmeC', 3, 10, '2023-01-18 11:48:57', 'Disponible', 6),
(72, 72, 'SpeedUSB_Multiples', 4, 10, '2023-01-18 11:53:51', 'Disponible', 6),
(73, 73, 'AudiNote_TypoC', 2, 10, '2023-01-18 11:56:02', 'Disponible', 6),
(74, 74, 'AudifoBOSE_InalamP12', 14, 10, '2023-01-18 11:59:53', 'Disponible', 6),
(75, 75, 'AudiGaming_Compu', 2, 10, '2023-01-18 12:03:30', 'Disponible', 6),
(76, 76, 'Auxiliar_Celebrat', 7, 10, '2023-01-18 15:04:24', 'Disponible', 6),
(77, 77, 'Selfie_Flexi_Pod', 8, 10, '2023-01-18 15:19:00', 'Disponible', 6),
(78, 78, 'CoverMagnetic_Iphone', 5, 10, '2023-01-18 15:26:01', 'Disponible', 6),
(79, 79, 'WirelessCharger', 2, 10, '2023-01-18 15:33:04', 'Disponible', 6),
(80, 80, 'Amplifier_Pantalla', 2, 10, '2023-01-18 15:35:41', 'Disponible', 6),
(81, 81, 'Cover_Watch4044mm', 5, 10, '2023-01-18 15:37:39', 'Disponible', 6),
(82, 82, 'Audifonos_S8', 3, 10, '2023-01-18 15:40:19', 'Disponible', 6),
(83, 83, 'AdaptadorUSB_MicroSD', 5, 10, '2023-01-18 15:42:49', 'Disponible', 6),
(84, 84, 'AdaptaTypoC_Aux3.5', 2, 10, '2023-01-18 15:55:59', 'Disponible', 6),
(85, 85, 'CableUSBTypeC_TypeC', 1, 10, '2023-01-18 15:58:02', 'Disponible', 6),
(86, 86, 'CargaAudi_Lightning', 1, 10, '2023-01-18 15:59:26', 'Disponible', 6),
(87, 87, 'Holder_S031', 2, 10, '2023-01-18 16:12:31', 'Disponible', 6),
(88, 88, 'Gaming_K150', 1, 13, '2023-01-18 16:17:29', 'Disponible', 6),
(89, 89, 'AudoGaming_K12122', 2, 13, '2023-01-18 16:21:23', 'Disponible', 6),
(90, 90, 'Carga_Vehiculo', 2, 13, '2023-01-18 16:23:23', 'Disponible', 6),
(91, 91, 'Holder_Vehiculo', 2, 13, '2023-01-18 16:26:14', 'Disponible', 6),
(92, 92, 'PockSocker', 8, 13, '2023-01-18 16:36:17', 'Disponible', 6),
(93, 93, 'Cargador_Mutiple', 1, 13, '2023-01-18 16:39:02', 'Disponible', 6),
(94, 94, 'CableHDMI_10Mts', 1, 13, '2023-01-18 16:44:45', 'Disponible', 6),
(95, 95, 'CableHDMI_5Mts', 1, 13, '2023-01-18 16:46:38', 'Disponible', 6),
(96, 96, 'CableHDMI_3Mts', 1, 13, '2023-01-18 16:49:31', 'Disponible', 6),
(97, 11, 'Travel_Adapter_V8', 2, 13, '2023-01-18 16:57:20', 'Disponible', 6),
(98, 97, 'HolderTripode_XT02P', 4, 13, '2023-01-18 17:00:53', 'Disponible', 6),
(99, 98, 'PAD_MOUSE', 2, 13, '2023-01-18 17:02:59', 'Disponible', 6),
(100, 99, 'Glass_MultiplesModel', 165, 9, '2023-01-18 17:25:23', 'Disponible', 6),
(101, 100, 'AudiInpods13_Inalam', 1, 9, '2023-01-18 17:52:27', 'Disponible', 6),
(102, 101, 'inPods12', 5, 9, '2023-01-18 17:53:41', 'Disponible', 6),
(103, 102, 'CargadorS4_Econo', 5, 9, '2023-01-18 17:58:41', 'Disponible', 6),
(104, 103, 'CargaV8_Vehiculo', 3, 9, '2023-01-18 18:00:18', 'Disponible', 6),
(105, 104, 'Holder_FCC309', 2, 9, '2023-01-18 18:02:21', 'Disponible', 6),
(106, 105, 'Holder_Stents', 1, 9, '2023-01-19 09:49:53', 'Disponible', 6),
(107, 106, 'Cuvo_Samsung', 5, 9, '2023-01-19 09:54:22', 'Disponible', 6),
(108, 107, 'Bosina_PromoAux', 1, 9, '2023-01-19 09:56:59', 'Disponible', 6),
(109, 108, 'USB_C_to_Lightning_2Mts_Orig', 6, 8, '2023-01-19 10:31:27', 'Disponible', 6),
(110, 109, 'Lightning_to_USB1M_Orig', 6, 8, '2023-01-19 10:38:31', 'Disponible', 6),
(111, 110, 'Power_Adap_USBC20W_Orig', 6, 8, '2023-01-19 11:28:19', 'Disponible', 6),
(112, 111, 'PowerLightning20W', 6, 8, '2023-01-19 11:37:21', 'Disponible', 6),
(113, 112, 'USB_C_Lightnin', 2, 8, '2023-01-19 11:39:36', 'Disponible', 6),
(114, 113, 'MagSafeCharger20W_Orig', 2, 8, '2023-01-19 11:48:03', 'Disponible', 6),
(115, 114, 'LimpiContactoSabo', 2, 8, '2023-01-19 11:54:55', 'Disponible', 8),
(116, 115, 'AudiWireless_A24', 2, 9, '2023-01-19 12:01:16', 'Disponible', 6),
(117, 116, 'ZTEBladeA31Lite', 1, 14, '2023-01-19 12:11:23', 'Disponible', 10),
(118, 117, 'MouseXKlipTremeUSB', 1, 14, '2023-01-19 12:17:31', 'Disponible', 7),
(119, 118, 'Iphone8plus_SemiN', 1, 14, '2023-01-19 12:20:19', 'Disponible', 10),
(120, 119, 'CableDePoderCPU', 2, 14, '2023-01-19 12:23:19', 'Disponible', 7),
(121, 120, 'CableVGA', 1, 14, '2023-01-19 12:25:37', 'Disponible', 7),
(122, 121, 'SimcarChip_Tigo', 10, 14, '2023-01-19 12:35:53', 'Disponible', 6),
(123, 122, 'A23', 7, 14, '2023-01-19 12:39:21', 'Disponible', 10),
(124, 123, 'Bluetooth4.0_USB', 1, 8, '2023-01-19 16:32:15', 'Disponible', 7),
(125, 124, 'EnclosureEX500', 1, 8, '2023-01-19 16:37:41', 'Disponible', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `id_num_factura` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `total_factura` float NOT NULL,
  `total_descuent` float NOT NULL,
  `total_fac_neto` float NOT NULL,
  `efectivo` float NOT NULL,
  `vuelto_fac` float NOT NULL,
  `fecha_factura` datetime NOT NULL,
  `condiciones_fac` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int NOT NULL,
  `id_cant_porcendes` int NOT NULL,
  `id_caja` int NOT NULL,
  `confirma_caja` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_factura` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_num_factura`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_cant_porcendes` (`id_cant_porcendes`),
  KEY `id_caja` (`id_caja`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_num_factura`, `id_cliente`, `total_factura`, `total_descuent`, `total_fac_neto`, `efectivo`, `vuelto_fac`, `fecha_factura`, `condiciones_fac`, `id_usuario`, `id_cant_porcendes`, `id_caja`, `confirma_caja`, `tipo_factura`) VALUES
(11, 13, 240, 0, 240, 240, 0, '2023-01-17 12:15:38', 'Revisado y entregado', 11, 0, 10, 'Recibido', 'Producto'),
(12, 13, 120, 0, 120, 120, 0, '2023-01-17 12:16:10', 'Entregado y revisado', 11, 0, 10, 'Recibido', 'Producto'),
(13, 13, 200, 0, 200, 200, 0, '2023-01-17 12:16:59', 'Entregado', 11, 0, 10, 'Recibido', 'Producto'),
(14, 13, 500, 0, 500, 500, 0, '2023-01-18 17:49:40', 'Probado y entregado', 11, 0, 10, 'Recibido', 'Producto'),
(15, 13, 90, 0, 90, 100, 10, '2023-01-18 18:03:48', 'Instalado', 11, 0, 10, 'Recibido', 'Producto'),
(16, 13, 340, 0, 340, 500, 160, '2023-01-19 11:07:11', 'Probado y entregado', 11, 0, 10, 'Recibido', 'Producto'),
(17, 13, 200, 0, 200, 200, 0, '2023-01-19 11:12:56', 'Probado y entregado', 11, 0, 10, 'Recibido', 'Producto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planilla_pago`
--

DROP TABLE IF EXISTS `planilla_pago`;
CREATE TABLE IF NOT EXISTS `planilla_pago` (
  `id_plani_pago` int NOT NULL AUTO_INCREMENT,
  `id_usuario_v` int NOT NULL,
  `id_por_comi` int NOT NULL,
  `id_salario` int NOT NULL,
  `comision` float NOT NULL,
  `total_neto` float NOT NULL,
  `fecha_realizada` datetime NOT NULL,
  `fech_ran_1` datetime NOT NULL,
  `fech_ran_2` datetime NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha_edit` datetime NOT NULL,
  PRIMARY KEY (`id_plani_pago`),
  KEY `id_usuario_v` (`id_usuario_v`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_por_comi` (`id_por_comi`),
  KEY `id_salario` (`id_salario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `porcentaje_comision`
--

DROP TABLE IF EXISTS `porcentaje_comision`;
CREATE TABLE IF NOT EXISTS `porcentaje_comision` (
  `id_por_comi` int NOT NULL,
  `porcen_comision` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_por_comi`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `porcentaje_comision`
--

INSERT INTO `porcentaje_comision` (`id_por_comi`, `porcen_comision`, `id_usuario`) VALUES
(6, '% de comisión de venta', 11),
(10, '% de comisión de venta', 11),
(12, '% de comisiones de venta', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `porcen_descuento`
--

DROP TABLE IF EXISTS `porcen_descuento`;
CREATE TABLE IF NOT EXISTS `porcen_descuento` (
  `id_cant_porcendes` int NOT NULL,
  `descrip_porcendes` varchar(35) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ingre_des` datetime NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_cant_porcendes`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `porcen_descuento`
--

INSERT INTO `porcen_descuento` (`id_cant_porcendes`, `descrip_porcendes`, `fecha_ingre_des`, `id_usuario`) VALUES
(0, '0 % de descuento', '2022-08-29 17:12:27', 11),
(5, '5 % de descuento', '2022-09-15 12:08:23', 11),
(10, '10 % de descuento', '2022-11-26 11:06:34', 10),
(15, '15 % pociento', '2022-12-02 15:50:56', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id_proveedor` int NOT NULL AUTO_INCREMENT,
  `nom_proveedor` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ruc_proveedor` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telef_proveedor` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha_ingre_prov` datetime DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nom_proveedor`, `ruc_proveedor`, `telef_proveedor`, `direccion`, `id_usuario`, `fecha_ingre_prov`) VALUES
(8, 'Christian Diaz', '78452222', '22669988', 'Managua 1 al Lago', 11, '2022-08-29 17:07:59'),
(9, 'TechParts', '585555', '54599555', 'Proveedor de dolofin', 11, '2022-10-17 10:29:42'),
(10, 'DIGI CELL Santo Rocha', '2902609790003H', '7520 2323', 'Gancho de camino', 11, '2023-01-13 16:39:12'),
(11, 'Sevasa los Robles', 'J031000015360', '22524204', 'Los robles Managua', 11, '2023-01-14 15:21:56'),
(12, 'Oriental Nueva Tienda', '1254875511', '22335566', 'Mercado Oriental', 11, '2023-01-14 17:04:15'),
(13, 'ZONADIGITAL', '180177414416', '77414416', 'Mercado Oriental', 11, '2023-01-18 16:15:48'),
(14, 'Digesa', '123457955613', ' 8465 0447', 'Boaco', 11, '2023-01-19 12:07:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salario`
--

DROP TABLE IF EXISTS `salario`;
CREATE TABLE IF NOT EXISTS `salario` (
  `id_salario` int NOT NULL AUTO_INCREMENT,
  `salario_neto` float NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_salario`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida`
--

DROP TABLE IF EXISTS `salida`;
CREATE TABLE IF NOT EXISTS `salida` (
  `id_salida` int NOT NULL AUTO_INCREMENT,
  `tipo_salida` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_salida` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `monto_salida` float NOT NULL,
  `id_usuario_salida` int NOT NULL,
  `id_caja` int NOT NULL,
  `fecha_salida` datetime NOT NULL,
  PRIMARY KEY (`id_salida`),
  KEY `id_usuario_salida` (`id_usuario_salida`),
  KEY `id_caja` (`id_caja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

DROP TABLE IF EXISTS `servicios`;
CREATE TABLE IF NOT EXISTS `servicios` (
  `id_servicio` int NOT NULL AUTO_INCREMENT,
  `id_tiposervicio` int NOT NULL,
  `observaciones` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_entreda` date NOT NULL,
  `precio_inversion` float NOT NULL,
  `precio_servicio` float NOT NULL,
  `precio_total_venta` float NOT NULL,
  `estado` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha_ingresado` datetime NOT NULL,
  PRIMARY KEY (`id_servicio`),
  KEY `id_tiposervicio` (`id_tiposervicio`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `id_tiposervicio`, `observaciones`, `fecha_entreda`, `precio_inversion`, `precio_servicio`, `precio_total_venta`, `estado`, `id_usuario`, `fecha_ingresado`) VALUES
(1, 1, 'Equipo entra con lentitud optimizar', '2022-12-01', 0, 720, 720, 'Entregado', 11, '2022-11-30 15:56:57'),
(2, 1, 'Cambiar disco duro por un SSD 240 GB', '2022-12-03', 1647, 732, 2379, 'Entregado', 11, '2022-11-30 15:59:18'),
(3, 1, 'Cambio de memori', '2022-12-02', 0, 1500, 1500, 'Pendiente', 11, '2022-12-01 11:27:58'),
(4, 1, 'Equipo no enciende la pantalla', '2022-12-02', 3660, 720, 4380, 'Pendiente', 11, '2022-12-01 16:10:41'),
(5, 1, 'Laptop mantenimiento', '2022-12-06', 0, 720, 720, 'Pendiente', 11, '2022-12-05 16:16:33'),
(6, 1, 'Laptop Dell inspiron 14 3878, no funciona correctamente, al dar clic en una area repondia en otro lado del escritorio.', '2022-12-15', 0, 150, 150, 'Entregado', 11, '2022-12-15 12:36:55'),
(7, 1, 'Cambio de pantalla A32 Modulo Oled', '2022-12-28', 0, 1466, 1466, 'Entregado', 11, '2022-12-27 12:56:59'),
(8, 1, 'Cambio de pantalla A32 Modulo Oled', '2022-12-28', 0, 2932, 2932, 'Entregado', 11, '2022-12-28 18:07:23'),
(9, 2, 'Cambio de arrastre de papel goma. Repuesto entregado por usuario', '2023-01-13', 450, 0, 450, 'Entregado', 11, '2023-01-13 13:15:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_productos`
--

DROP TABLE IF EXISTS `stock_productos`;
CREATE TABLE IF NOT EXISTS `stock_productos` (
  `id_stock_produc` int NOT NULL AUTO_INCREMENT,
  `cod_barra` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_product` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cant_stock` int NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_stock_produc`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `stock_productos`
--

INSERT INTO `stock_productos` (`id_stock_produc`, `cod_barra`, `nombre_product`, `cant_stock`, `id_usuario`) VALUES
(3, '860256055477076', 'Realme_C21_Y', 0, 11),
(10, '8801811240751', 'Samsung_35W_Type_C', 20, 11),
(11, '8806088359502', 'Travel_Adapter_V8', 11, 11),
(12, '88060883595026', 'TravelAdapter_V8_Azul', 9, 11),
(13, '6973707057261', 'PowerBank_Dusty_20', 1, 11),
(14, '6933138700297', 'PowerBank_Lonio_10', 1, 11),
(15, '22391', 'CableUSB_V8Lonio', 6, 11),
(16, '6954176814852', 'CableUSB_LINTypoC', 5, 11),
(17, '1401202645', 'Bosina_MS2646BT', 1, 11),
(18, '140120402', 'Bosina_CHV402', 2, 11),
(19, '140120623', 'Bosina_AO623', 1, 11),
(20, '1401202211', 'Bosina_SZ2211', 1, 11),
(21, '1401206356', 'CableUTP_CAT6', 100, 11),
(22, '798302032866', 'CAT6_RJ45', 100, 11),
(23, '886540003943', 'Adapter_HDMI_VGA_Argom', 2, 11),
(24, '798302161443', 'Cable_LaptopXTC120', 2, 11),
(25, '798303111119', 'Cable_Alimen_XTC210', 2, 11),
(26, '886540006548', 'Cable_USB_TypeC_TO_V8', 2, 11),
(27, '886540006029', 'Covertidor_TypoC_HDMI', 1, 11),
(28, '886540006623', 'Extencsion_USB3.0', 3, 11),
(29, '886540006654', 'Adaptdor_TypoC_RJ45_Red', 1, 11),
(30, '865400063884', 'Carga_Univer_Laptop', 1, 11),
(31, '1401202329', 'USB_Typo_C', 6, 11),
(32, '14012023821', 'CableUSB_V8_SAM', 20, 11),
(33, '1401202312', 'Adaptador_Europeo', 20, 11),
(34, '1401231346', 'Bosina_GTS_1346', 2, 11),
(35, '097855124197', 'Mouse_Inalam_M170', 2, 11),
(36, '097855142702', 'MouseUSB_LogiM110', 2, 11),
(37, '886540006111', 'Enclosure3.0_Argom', 2, 11),
(38, '886540007729', 'Enclosure_PCIE_M2', 1, 11),
(39, '798302078512', 'Audifonos_KlipXtreme_Pulse', 1, 11),
(40, '886540000324', 'Multipuerto_Argom', 3, 11),
(41, '886540007156', 'Combo_Gamer_KB51', 1, 11),
(42, '886540006920', 'Teclaso_USB_Argom', 2, 11),
(43, '798398163499', 'Mouse_Gaming_Venom', 2, 11),
(44, '097855070739', 'WebCam_C270_720p', 1, 11),
(45, '798302077515', 'BosinaBluWavell_KMS616', 1, 11),
(46, '13034098', 'Micro_Adata_8GB', 4, 11),
(47, '13034090', 'Micro_Adata_16GB', 6, 11),
(48, '740617298680', 'Micro_Kings_32GB', 5, 11),
(49, '11580504', 'USB_Adata_8GB', 3, 11),
(50, '11580147', 'USB_Adata_16GB', 6, 11),
(51, '740617326185', 'USB_Kings_32GB', 6, 11),
(52, '740617243024', 'USB_TYPOC_King_32GB', 2, 11),
(53, '861385061210798', 'Realme_C30', 1, 11),
(54, '1701200378', 'Otter_Box_MultiModelo', 22, 11),
(55, '6925146950801', 'Audi_Celebrat_G12_G13', 21, 11),
(56, '1401202395032', 'Cover_Multiples', 220, 11),
(57, '14026001', 'GM_Carga_V8', 17, 11),
(58, '14026002', 'GM_Carga_V3', 3, 11),
(59, '180120231315', 'Cover_Multiples_Premiun', 15, 11),
(60, '6954201904201', 'Audifonos_AKG_S10', 3, 11),
(61, '00510', 'CableUSB_TypoC', 4, 11),
(62, '156204', 'CableUSB_V3', 1, 11),
(63, '2000410', 'CableUSB_LihgtningAAA', 2, 11),
(64, '6967850656181', 'CargadorHuawei_TypoC', 2, 11),
(65, '109', 'MicroPhone_Lavalier', 2, 11),
(66, '219', 'Cargador_Economico', 1, 11),
(67, '885909627363', 'Power_Lightning_Ori', 10, 11),
(68, '2000098', 'CargaHuawei_TypoC', 5, 11),
(69, '464', 'OTG_TYPOC', 3, 11),
(70, '463', 'OTG_TypopC_V8', 2, 11),
(71, '36527485', 'Cargador_RealmeC', 3, 11),
(72, '416', 'SpeedUSB_Multiples', 4, 11),
(73, '2000621', 'AudiNote_TypoC', 2, 11),
(74, '141P12', 'AudifoBOSE_InalamP12', 14, 11),
(75, '0305541890005', 'AudiGaming_Compu', 2, 11),
(76, '6925146990081', 'Auxiliar_Celebrat', 7, 11),
(77, '6459751458518', 'Selfie_Flexi_Pod', 8, 11),
(78, '480', 'CoverMagnetic_Iphone', 5, 11),
(79, '273', 'WirelessCharger', 2, 11),
(80, '6985427854853', 'Amplifier_Pantalla', 2, 11),
(81, '465', 'Cover_Watch4044mm', 5, 11),
(82, '6999969795659', 'Audifonos_S8', 3, 11),
(83, '9134504492755', 'AdaptadorUSB_MicroSD', 5, 11),
(84, '6925146938083', 'AdaptaTypoC_Aux3.5', 2, 11),
(85, '6925146981270', 'CableUSBTypeC_TypeC', 1, 11),
(86, '266', 'CargaAudi_Lightning', 1, 11),
(87, '2020121013510', 'Holder_S031', 2, 11),
(88, '0305541801506', 'Gaming_K150', 1, 11),
(89, '264', 'AudoGaming_K12122', 2, 11),
(90, '8502916516580', 'Carga_Vehiculo', 2, 11),
(91, '348', 'Holder_Vehiculo', 2, 11),
(92, '466', 'PockSocker', 8, 11),
(93, '315', 'Cargador_Mutiple', 1, 11),
(94, '6957156272147', 'CableHDMI_10Mts', 1, 11),
(95, '6957145404689', 'CableHDMI_5Mts', 1, 11),
(96, '52310401', 'CableHDMI_3Mts', 1, 11),
(97, '424', 'HolderTripode_XT02P', 4, 11),
(98, '471', 'PAD_MOUSE', 2, 11),
(99, '180120231724', 'Glass_MultiplesModel', 165, 11),
(100, '390', 'AudiInpods13_Inalam', 1, 11),
(101, '359', 'inPods12', 5, 11),
(102, '843163017559', 'CargadorS4_Econo', 5, 11),
(103, '354', 'CargaV8_Vehiculo', 3, 11),
(104, '391', 'Holder_FCC309', 2, 11),
(105, '1601011', 'Holder_Stents', 1, 11),
(106, '190120', 'Cuvo_Samsung', 5, 11),
(107, '19012023503', 'Bosina_PromoAux', 1, 11),
(108, '888462496988', 'USB_C_to_Lightning_2Mts_Orig', 6, 11),
(109, '190198531704', 'Lightning_to_USB1M_Orig', 6, 11),
(110, '194252156940', 'Power_Adap_USBC20W_Orig', 6, 11),
(111, '190198889966', 'PowerLightning20W', 6, 11),
(112, '190198496263', 'USB_C_Lightnin', 2, 11),
(113, '194252192450', 'MagSafeCharger20W_Orig', 2, 11),
(114, '811176000165', 'LimpiContactoSabo', 2, 11),
(115, '6925146923362', 'AudiWireless_A24', 2, 11),
(116, '865196054224795', 'ZTEBladeA31Lite', 1, 11),
(117, '211022499', 'MouseXKlipTremeUSB', 1, 11),
(118, '19120238', 'Iphone8plus_SemiN', 1, 11),
(119, '1512532', 'CableDePoderCPU', 2, 11),
(120, '190120232919', 'CableVGA', 1, 11),
(121, '19120235012', 'SimcarChip_Tigo', 10, 11),
(122, '8950530312579', 'A23', 7, 11),
(123, '6935364099664', 'Bluetooth4.0_USB', 1, 11),
(124, '14860200', 'EnclosureEX500', 1, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_servicios`
--

DROP TABLE IF EXISTS `tipo_servicios`;
CREATE TABLE IF NOT EXISTS `tipo_servicios` (
  `id_tiposervicio` int NOT NULL AUTO_INCREMENT,
  `tipo_servicio` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_servi` text COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_tiposervicio`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_servicios`
--

INSERT INTO `tipo_servicios` (`id_tiposervicio`, `tipo_servicio`, `descripcion_servi`, `id_usuario`) VALUES
(1, 'Mantenimiento', 'Contendrá todos los mantenimientos de dispositivos electrónicos  ', 10),
(2, 'Reparacion ', 'Contendrá todas las reparaciones', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo_user` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `foto_perfil` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `contrasena` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `tipo_user`, `estado`, `foto_perfil`) VALUES
(10, 'UsuarioPrueba', 'e910b7cd717948450790edc8a45e4a90d49d287d', 'Admin', 'Activo', '6e11cd0f28995a5d2a5ded374bc196f5.jpg'),
(11, 'JBenitez', 'bc6402f494448c0e2a461227a481846e5bdd7eb2', 'Admin', 'Activo', '7b452d771f46845e715c86e8d44d3e47.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `utilidades`
--

DROP TABLE IF EXISTS `utilidades`;
CREATE TABLE IF NOT EXISTS `utilidades` (
  `id_utili` int NOT NULL AUTO_INCREMENT,
  `salidas` float NOT NULL,
  `entradas` float NOT NULL,
  `salarios` float NOT NULL,
  `utilidad` float NOT NULL,
  `fecha_reali` datetime NOT NULL,
  `fecha_1r` datetime NOT NULL,
  `fecha_2r` datetime NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_utili`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin_user`
--
ALTER TABLE `admin_user`
  ADD CONSTRAINT `admin_user_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `caja_ibfk_2` FOREIGN KEY (`id_usuario_cerro`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD CONSTRAINT `categoria_producto_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cat_precio`
--
ALTER TABLE `cat_precio`
  ADD CONSTRAINT `cat_precio_ibfk_1` FOREIGN KEY (`id_stock_produc`) REFERENCES `stock_productos` (`id_stock_produc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cat_precio_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_compra_product`
--
ALTER TABLE `detalle_compra_product`
  ADD CONSTRAINT `detalle_compra_product_ibfk_3` FOREIGN KEY (`id_categoria_produc`) REFERENCES `categoria_producto` (`id_categoria_produc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compra_product_ibfk_4` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id_compras`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`id_num_factura`) REFERENCES `factura` (`id_num_factura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`id_stock_produc`) REFERENCES `stock_productos` (`id_stock_produc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_factura_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_factura_ibfk_4` FOREIGN KEY (`id_detall_stock_pro`) REFERENCES `detalle_stock_product` (`id_detall_stock_pro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_factura_ibfk_5` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_stock_product`
--
ALTER TABLE `detalle_stock_product`
  ADD CONSTRAINT `detalle_stock_product_ibfk_1` FOREIGN KEY (`id_stock_produc`) REFERENCES `stock_productos` (`id_stock_produc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_stock_product_ibfk_3` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_stock_product_ibfk_4` FOREIGN KEY (`id_categoria_produc`) REFERENCES `categoria_producto` (`id_categoria_produc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_cant_porcendes`) REFERENCES `porcen_descuento` (`id_cant_porcendes`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id_caja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `planilla_pago`
--
ALTER TABLE `planilla_pago`
  ADD CONSTRAINT `planilla_pago_ibfk_1` FOREIGN KEY (`id_usuario_v`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `planilla_pago_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `planilla_pago_ibfk_3` FOREIGN KEY (`id_por_comi`) REFERENCES `porcentaje_comision` (`id_por_comi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `planilla_pago_ibfk_4` FOREIGN KEY (`id_salario`) REFERENCES `salario` (`id_salario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `porcentaje_comision`
--
ALTER TABLE `porcentaje_comision`
  ADD CONSTRAINT `porcentaje_comision_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `porcen_descuento`
--
ALTER TABLE `porcen_descuento`
  ADD CONSTRAINT `porcen_descuento_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salario`
--
ALTER TABLE `salario`
  ADD CONSTRAINT `salario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salida`
--
ALTER TABLE `salida`
  ADD CONSTRAINT `salida_ibfk_1` FOREIGN KEY (`id_usuario_salida`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salida_ibfk_2` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id_caja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`id_tiposervicio`) REFERENCES `tipo_servicios` (`id_tiposervicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `stock_productos`
--
ALTER TABLE `stock_productos`
  ADD CONSTRAINT `stock_productos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipo_servicios`
--
ALTER TABLE `tipo_servicios`
  ADD CONSTRAINT `tipo_servicios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `utilidades`
--
ALTER TABLE `utilidades`
  ADD CONSTRAINT `utilidades_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
