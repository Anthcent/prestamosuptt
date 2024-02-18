-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-02-2024 a las 04:16:49
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
-- Base de datos: `prestamos_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'plomeriaaaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`) VALUES
(1, 'desconocida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion_hogar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `nombre`, `apellido`, `cedula`, `cargo`, `departamento`, `telefono`, `direccion_hogar`) VALUES
(1, 'Anthony', 'Gelvez', '26784637', 'admin', 'control', '04122913826', 'sanra asdas'),
(3, 'hola', 'a', '2', 'a', 'a', '2', 'a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int(11) NOT NULL,
  `persona_nombre` varchar(255) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad_prestada` int(11) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `estado` varchar(10) DEFAULT 'Prestado',
  `persona_id` int(11) DEFAULT NULL,
  `persona_cargo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id`, `persona_nombre`, `producto_id`, `cantidad_prestada`, `fecha_entrega`, `fecha_devolucion`, `estado`, `persona_id`, `persona_cargo`) VALUES
(3, '0', 7, 2, '2024-02-03', '2024-02-09', 'Devuelto', NULL, NULL),
(4, '0', 11, 1, '2024-02-02', '2024-02-03', 'Devuelto', 1, NULL),
(5, '0', 11, 3, '2024-02-02', '2024-02-03', 'Devuelto', 1, NULL),
(6, '0', 11, 4, '2024-02-02', '2024-02-03', 'Devuelto', 1, NULL),
(7, '0', 11, 1, '2024-02-02', '2024-02-02', 'Devuelto', 1, ''),
(8, '0', 11, 1, '2024-02-02', '2024-02-02', 'Devuelto', 1, 'admin'),
(9, '0', 11, 1, '2024-02-02', '2024-02-02', 'Devuelto', 1, NULL),
(10, '0', 11, 1, '2024-02-02', '2024-02-02', 'Devuelto', 1, NULL),
(11, 'Anthony', 10, 1, '2024-02-02', '2024-02-02', 'Prestado', 1, NULL),
(12, 'Anthony', 11, 1, '2024-02-02', '2024-02-02', 'Prestado', 1, NULL),
(13, '', 11, 2, '2024-02-23', '2024-02-15', 'Prestado', 1, ''),
(14, '', 11, 2, '2024-02-02', '2024-02-03', 'Prestado', 1, 'admin'),
(15, 'Anthony', 11, 3, '2024-02-02', '2024-02-03', 'Prestado', 1, NULL),
(16, 'Anthony', 11, 1, '2024-02-02', '2024-02-03', 'Prestado', 1, ''),
(17, 'Anthony', 11, 1, '2024-02-02', '2024-02-02', 'Prestado', 1, 'admin'),
(18, 'Anthony', 11, 1, '2024-01-01', '2024-01-17', 'Devuelto', 1, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cantidad_disponible` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `ubicacion_id` int(11) DEFAULT NULL,
  `marca_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `cantidad`, `cantidad_disponible`, `categoria_id`, `ubicacion_id`, `marca_id`) VALUES
(1, 'Producto 2', 10, 10, 1, 1, 1),
(2, 'Producto 2', 5, 0, NULL, NULL, NULL),
(3, 'Producto 3', 7, 1, NULL, NULL, NULL),
(4, 'Producto 1', 10, 0, NULL, NULL, NULL),
(5, 'Producto 2', 5, 0, NULL, NULL, NULL),
(6, 'Producto 3', 8, 0, NULL, NULL, NULL),
(7, 'Producto 1', 10, 10, NULL, NULL, NULL),
(8, 'Producto 2', 5, 5, NULL, NULL, NULL),
(9, 'Producto 3', 8, 8, NULL, NULL, NULL),
(10, 'pincel', 0, 9, NULL, NULL, NULL),
(11, 'Llave de baño', 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id`, `nombre`) VALUES
(1, 'estante 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contrasena`, `rol`) VALUES
(1, 'admin', '$2y$10$ejoVGyvCQRXiPiGjPm8pWeBIahgFwlOK.T7wI.UsxmK1xaJGNF3Z2', 'administrador'),
(2, 'invitado', '$2y$10$A1omZbY1Bg0ZpyhHVrfkBeFxaXn9Y8cL1suSPkiW/j9oMmNn1l4Pa', 'usuario'),
(3, 'ad', '$2y$10$1pj4Fekdnt9KPw16uHetAe.WUbX9yHk65ZlZKIoFu9mNond0o8Zb.', 'administrador'),
(4, 'iv', '$2y$10$e0Huxy7BHPLRQMv2uI8n9ucLqn2vmNy4J8mSWc8l0NRAlIUBZBKo.', 'usuario'),
(5, 'user', '$2y$10$NRkbO4ZJCDvdepZtDeaQb.6t39/eHdG8K/ZSkQb4Isot/x.806PPO', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `persona_id` (`persona_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `ubicacion_id` (`ubicacion_id`),
  ADD KEY `marca_id` (`marca_id`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`persona_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`ubicacion_id`) REFERENCES `ubicaciones` (`id`),
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
