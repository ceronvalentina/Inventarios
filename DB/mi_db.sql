-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2024 a las 23:29:53
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mi_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(7) NOT NULL,
  `categoria_nombre` varchar(50) NOT NULL,
  `categoria_ubicacion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_nombre`, `categoria_ubicacion`) VALUES
(3, 'Snacks', 'Estanteria de Snacks'),
(6, 'Cervezas', 'Nevera'),
(7, 'Whisky', 'Estanteria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int(20) NOT NULL,
  `producto_codigo` varchar(70) NOT NULL,
  `producto_nombre` varchar(70) NOT NULL,
  `producto_precio` decimal(30,2) NOT NULL,
  `producto_stock` int(25) NOT NULL,
  `producto_foto` varchar(500) NOT NULL,
  `categoria_id` int(7) NOT NULL,
  `usuario_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `producto_codigo`, `producto_nombre`, `producto_precio`, `producto_stock`, `producto_foto`, `categoria_id`, `usuario_id`) VALUES
(5, '2024-04-26', 'Papas de pollo', '1200.00', 10, '', 3, 2),
(6, '2024-04-27', 'Papas de limon', '1200.00', 100, '', 3, 2),
(7, 'Poker', 'Cerveza Poker', '3000.00', 15, '', 6, 2),
(8, 'Poker Lata', 'Cerveza Poker Lata', '3000.00', 15, '', 6, 2),
(9, 'Pokeron', 'Cerveza Pokeron', '8000.00', 15, '', 6, 2),
(10, 'Margarita', 'Papas Naturales', '2000.00', 10, 'Papas_Naturales_10.jpg', 3, 2),
(11, 'Chivas Regal', 'Chivas Regal 15', '40000.00', 5, 'Chivas_Regal_15_70.jpg', 7, 2),
(12, 'Buchanas', 'Buchanas Deluxe', '56000.00', 200, 'Buchanas_Deluxe_83.jpg', 7, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `Id` int(10) NOT NULL,
  `Fecha` date NOT NULL DEFAULT current_timestamp(),
  `Mesero` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Estado` varchar(15) NOT NULL,
  `Categoria` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Producto` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Lote` varchar(15) NOT NULL,
  `FV` date NOT NULL,
  `Cantidad` int(30) NOT NULL,
  `Precio` int(10) NOT NULL,
  `Total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`Id`, `Fecha`, `Mesero`, `Estado`, `Categoria`, `Producto`, `Lote`, `FV`, `Cantidad`, `Precio`, `Total`) VALUES
(105, '2024-05-02', 'Miguel', 'Entrada', 'Snacks', 'Papas de pollo', '101', '2024-05-28', 2000, 1200, 2400000),
(106, '2024-05-02', 'Miguel', 'Entrada', 'Snacks', 'Papas Naturales', '2000', '2024-05-15', 200, 2000, 400000),
(107, '2024-05-02', 'Miguel', 'Entrada', 'Whisky', 'Buchanas Deluxe', '600', '2024-05-24', 12, 56000, 672000),
(108, '2024-05-02', 'Miguel', 'Salida', 'Snacks', 'Papas de pollo', '101', '2024-05-28', -12, 1200, 14400),
(109, '2024-05-02', 'Miguel', 'Entrada', 'Snacks', 'Papas de pollo', '123', '2024-05-25', 30, 1200, 36000),
(110, '2024-05-02', 'Administrador', 'Entrada', 'Cervezas', 'Cerveza Poker Lata', '2000', '2024-05-22', 200, 3000, 600000),
(111, '2024-05-02', 'Administrador', 'Salida', 'Cervezas', 'Cerveza Poker Lata', '2000', '2024-05-22', -20, 3000, 60000),
(112, '2024-05-03', 'Administrador', 'Entrada', 'Whisky', 'Chivas Regal 15', '5000', '2024-05-30', 20, 40000, 800000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL,
  `usuario_nombre` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_usuario` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_clave` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_email` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `usuario_imagen` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_clave`, `usuario_email`, `usuario_imagen`) VALUES
(1, 'Administrador', 'Principal', 'Administrador', '$2y$10$Kjtwmu3DfMyP37/f7FxeZesoAAAMC5CIw/h8iUvuNbSSBJ.HIH.gW', '', '_41_png_7_jpg_70.png'),
(2, 'Miguel', 'Moreno', 'Miguelito', '$2y$10$8WMSkKH7VsMTn2kiwBI/U.LttSYl9lnhkLrXdcEyRwYCBTQOjbL8m', 'mdmm1100@gmail.com', '_91_jpg_9_jpg_96.png'),
(6, 'David', 'Montañez', 'Davidsito', '$2y$10$JiXeEDUhql5KmhiTXB3M7OuXsm3IpRH1En4B8Nf5GVrt5mQIFdZjO', 'mdm@gmail.com', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
