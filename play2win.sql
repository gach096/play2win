-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2026 a las 16:36:45
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
-- Base de datos: `play2win`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actualizaciones_juego`
--

CREATE TABLE `actualizaciones_juego` (
  `id_actualizacion` int(10) UNSIGNED NOT NULL,
  `id_juego` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(270) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actualizaciones_juego`
--

INSERT INTO `actualizaciones_juego` (`id_actualizacion`, `id_juego`, `nombre`, `descripcion`, `fecha`) VALUES
(1, 1, '1.0.1', 'Mejoras visuales y arreglo de bugs', '2021-06-08'),
(2, 1, '1.0.2', 'Mejora en sonido, ya no se detiene durante la carga del juego.', '2021-06-09'),
(3, 1, '1.0.3', 'Mejora en la IA.', '2021-06-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_expansion`
--

CREATE TABLE `carrito_expansion` (
  `id_usuario` int(11) NOT NULL,
  `id_expansion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_juego`
--

CREATE TABLE `carrito_juego` (
  `id_usuario` int(11) NOT NULL,
  `id_juego` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito_juego`
--

INSERT INTO `carrito_juego` (`id_usuario`, `id_juego`) VALUES
(15, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_expansion`
--

CREATE TABLE `compras_expansion` (
  `id_expansion` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras_expansion`
--

INSERT INTO `compras_expansion` (`id_expansion`, `id_usuario`) VALUES
(4, 6),
(4, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_juego`
--

CREATE TABLE `compras_juego` (
  `id_juego` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras_juego`
--

INSERT INTO `compras_juego` (`id_juego`, `id_usuario`) VALUES
(1, 15),
(7, 15),
(9, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desarrolladores`
--

CREATE TABLE `desarrolladores` (
  `id_dev` int(10) UNSIGNED NOT NULL,
  `nombre_dev` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `desarrolladores`
--

INSERT INTO `desarrolladores` (`id_dev`, `nombre_dev`) VALUES
(1, 'Ubisoft'),
(2, 'id Software'),
(3, 'Unknown Worlds Entertainment'),
(4, 'NetherRealms Studios'),
(5, 'Rockstar North'),
(6, 'Square Enix'),
(7, 'Digital Extremes'),
(8, ' Rockstar Games');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devs_expansion`
--

CREATE TABLE `devs_expansion` (
  `id_dev` int(10) UNSIGNED NOT NULL,
  `id_expansion` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devs_expansion`
--

INSERT INTO `devs_expansion` (`id_dev`, `id_expansion`) VALUES
(1, 4),
(1, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devs_juego`
--

CREATE TABLE `devs_juego` (
  `id_dev` int(10) UNSIGNED NOT NULL,
  `id_juego` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devs_juego`
--

INSERT INTO `devs_juego` (`id_dev`, `id_juego`) VALUES
(1, 1),
(2, 5),
(3, 6),
(4, 7),
(5, 8),
(6, 9),
(7, 10),
(8, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editores`
--

CREATE TABLE `editores` (
  `id_editor` int(10) UNSIGNED NOT NULL,
  `nombre_editor` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `editores`
--

INSERT INTO `editores` (`id_editor`, `nombre_editor`) VALUES
(1, 'Square Enix'),
(2, 'Rockstar Games'),
(3, 'Warner Bross Interactive Entertainment'),
(4, 'Unknown Worlds Entertainment'),
(5, 'Bethesda Softworks'),
(6, 'Ubisoft'),
(7, 'Digital Extremes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editores_expansion`
--

CREATE TABLE `editores_expansion` (
  `id_editor` int(10) UNSIGNED NOT NULL,
  `id_expansion` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `editores_expansion`
--

INSERT INTO `editores_expansion` (`id_editor`, `id_expansion`) VALUES
(6, 4),
(6, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editores_juego`
--

CREATE TABLE `editores_juego` (
  `id_editor` int(10) UNSIGNED NOT NULL,
  `id_juego` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `editores_juego`
--

INSERT INTO `editores_juego` (`id_editor`, `id_juego`) VALUES
(1, 9),
(2, 8),
(2, 11),
(3, 7),
(4, 6),
(5, 5),
(6, 1),
(7, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expansiones`
--

CREATE TABLE `expansiones` (
  `id_expansion` int(10) UNSIGNED NOT NULL,
  `id_juego` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(270) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `fecha_lanzamiento` date NOT NULL,
  `precio` decimal(10,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `expansiones`
--

INSERT INTO `expansiones` (`id_expansion`, `id_juego`, `nombre`, `descripcion`, `fecha_publicacion`, `fecha_lanzamiento`, `precio`) VALUES
(4, 1, 'Assassin’s CreedⓇ Odyssey – Legacy of the First Blade', 'Lucha junto a la leyenda que empuñó la hoja oculta por primera vez para cambiar el curso de la historia mientras descubres por qué los Assassins eligieron luchar desde las sombras.', '2021-06-01', '2018-12-04', 1249.00),
(5, 1, 'Assassin’s CreedⓇ Odyssey - The Fate of Atlantis', 'En El destino de la Atlántida, el segundo contenido descargable, adéntrate en los fabulosos reinos de la mitología griega para descubrir tu verdadero poder y desvelar los misterios de la Primera Civilización.', '2021-06-11', '2019-01-23', 1249.00),
(6, 1, 'Assassin\'s Creed® Odyssey - Season Pass', 'Enriquece tu experiencia de juego en Assassin\'s Creed® Odyssey con el SEASON PASS.', '2020-06-24', '2018-08-05', 1999.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expansiones_wishlist`
--

CREATE TABLE `expansiones_wishlist` (
  `id_expansion` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `expansiones_wishlist`
--

INSERT INTO `expansiones_wishlist` (`id_expansion`, `id_usuario`) VALUES
(6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id_genero` int(10) UNSIGNED NOT NULL,
  `nombre_genero` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id_genero`, `nombre_genero`) VALUES
(1, 'Accion'),
(2, 'Aventura'),
(3, 'Mundo Abierto'),
(4, 'Supervivencia'),
(5, 'JRPG'),
(6, 'Rol'),
(7, 'Sigilo'),
(8, 'Disparos'),
(9, 'Terror'),
(10, 'RPG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos_expansion`
--

CREATE TABLE `generos_expansion` (
  `id_expansion` int(10) UNSIGNED NOT NULL,
  `id_genero` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos_expansion`
--

INSERT INTO `generos_expansion` (`id_expansion`, `id_genero`) VALUES
(4, 1),
(4, 3),
(4, 7),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(6, 2),
(6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos_juego`
--

CREATE TABLE `generos_juego` (
  `id_juego` int(10) UNSIGNED NOT NULL,
  `id_genero` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos_juego`
--

INSERT INTO `generos_juego` (`id_juego`, `id_genero`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 6),
(1, 7),
(5, 1),
(5, 8),
(6, 3),
(6, 4),
(6, 9),
(7, 1),
(8, 1),
(8, 2),
(8, 3),
(9, 2),
(9, 3),
(9, 5),
(9, 6),
(9, 10),
(10, 1),
(10, 8),
(11, 1),
(11, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id_juego` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(270) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `fecha_lanzamiento` date NOT NULL,
  `precio` decimal(10,2) UNSIGNED NOT NULL,
  `ingame_players` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id_juego`, `nombre`, `descripcion`, `fecha_publicacion`, `fecha_lanzamiento`, `precio`, `ingame_players`) VALUES
(1, 'Assassin\'s Creed® Odyssey', 'Elige tu destino en Assassin\'s Creed® Odyssey. Pasa de la marginación a la gloria embarcándote en una odisea para descubrir los secretos de tu pasado y cambiar el destino de la antigua Grecia.', '2018-05-05', '2018-08-05', 2999.00, 0),
(5, 'DOOM Eternal', 'Los ejércitos del infierno han invadido la Tierra. Ponte en la piel del Slayer en una épica campaña para un jugador y cruza dimensiones para detener la destrucción definitiva de la humanidad. No le tienen miedo a nada... salvo a ti.', '2019-09-27', '2020-03-20', 599.00, 0),
(6, 'Subnautica: Below Zero', 'Sumérgete en una gélida aventura subacuática en un planeta alienígena. Below Zero está ambientado dos años después de los hechos del juego original de Subnautica. Sobrevive a las arduas condiciones construyendo hábitats, fabricando herramientas.', '2019-02-28', '2020-05-14', 329.00, 0),
(7, 'Mortal Kombat 11', 'Mortal Kombat ha regresado mejor que nunca en esta entrega de la icónica saga.', '2019-01-01', '2019-03-23', 1199.00, 0),
(8, 'Grand Theft Auto V: Edición Premium', 'Un joven estafador callejero, un ladrón de bancos retirado y un psicópata aterrador se meten en un lío, y tendrán que llevar a cabo una serie de peligrosos golpes para sobrevivir en una ciudad en la que no pueden confiar en nadie, y mucho menos los unos en los otros.', '2012-07-05', '2013-09-17', 315.00, 0),
(9, 'FINAL FANTASY XV WINDOWS EDITION', 'Noctis Lucis Caelum, el último de un antiguo linaje real y el heredero al trono, proviene del reino de Lucis. Este es un país que ostenta el último cristal en el mundo, lo cual es beneficioso para la política, la economía y los aspectos militares del reino.', '2016-02-10', '2016-11-29', 800.00, 0),
(10, 'Warframe', 'Despierta como un guerrero imparable y lucha junto a tus amigos en este juego de acción gratuito en línea y basado en historias.', '2010-03-25', '2013-03-25', 0.00, 0),
(11, 'Grand Theft Auto: San Andreas', 'Five years ago Carl Johnson escaped from the pressures of life in Los Santos, San Andreas... a city tearing itself apart with gang trouble, drugs and corruption.', '2005-06-06', '2005-06-06', 400.00, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos_wishlist`
--

CREATE TABLE `juegos_wishlist` (
  `id_juego` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juegos_wishlist`
--

INSERT INTO `juegos_wishlist` (`id_juego`, `id_usuario`) VALUES
(1, 15),
(10, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contrasenia` varchar(40) NOT NULL,
  `tipo_usuario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `contrasenia`, `tipo_usuario`) VALUES
(6, 'pedro40', 'pedro40@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', ''),
(15, 'pedrito', 'ch.gabriel.096@gmail.com', '64fe53e0fb164f09c56cffbd0ff6d46cf3bf361e', 'User');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actualizaciones_juego`
--
ALTER TABLE `actualizaciones_juego`
  ADD PRIMARY KEY (`id_actualizacion`),
  ADD KEY `id_juego` (`id_juego`);

--
-- Indices de la tabla `compras_expansion`
--
ALTER TABLE `compras_expansion`
  ADD PRIMARY KEY (`id_expansion`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `compras_juego`
--
ALTER TABLE `compras_juego`
  ADD PRIMARY KEY (`id_juego`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `desarrolladores`
--
ALTER TABLE `desarrolladores`
  ADD PRIMARY KEY (`id_dev`);

--
-- Indices de la tabla `devs_expansion`
--
ALTER TABLE `devs_expansion`
  ADD PRIMARY KEY (`id_dev`,`id_expansion`),
  ADD KEY `id_expansion` (`id_expansion`);

--
-- Indices de la tabla `devs_juego`
--
ALTER TABLE `devs_juego`
  ADD PRIMARY KEY (`id_dev`,`id_juego`),
  ADD KEY `id_juego` (`id_juego`);

--
-- Indices de la tabla `editores`
--
ALTER TABLE `editores`
  ADD PRIMARY KEY (`id_editor`);

--
-- Indices de la tabla `editores_expansion`
--
ALTER TABLE `editores_expansion`
  ADD PRIMARY KEY (`id_editor`,`id_expansion`),
  ADD KEY `id_expansion` (`id_expansion`);

--
-- Indices de la tabla `editores_juego`
--
ALTER TABLE `editores_juego`
  ADD PRIMARY KEY (`id_editor`,`id_juego`),
  ADD KEY `id_juego` (`id_juego`);

--
-- Indices de la tabla `expansiones`
--
ALTER TABLE `expansiones`
  ADD PRIMARY KEY (`id_expansion`),
  ADD KEY `id_juego` (`id_juego`);

--
-- Indices de la tabla `expansiones_wishlist`
--
ALTER TABLE `expansiones_wishlist`
  ADD KEY `FK_id_expansion` (`id_expansion`),
  ADD KEY `FK_id_usuario` (`id_usuario`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `generos_expansion`
--
ALTER TABLE `generos_expansion`
  ADD PRIMARY KEY (`id_expansion`,`id_genero`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Indices de la tabla `generos_juego`
--
ALTER TABLE `generos_juego`
  ADD PRIMARY KEY (`id_juego`,`id_genero`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id_juego`);

--
-- Indices de la tabla `juegos_wishlist`
--
ALTER TABLE `juegos_wishlist`
  ADD PRIMARY KEY (`id_juego`,`id_usuario`),
  ADD KEY `FK_id_juego` (`id_juego`) USING BTREE,
  ADD KEY `FK_id_usuario` (`id_usuario`) USING BTREE;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actualizaciones_juego`
--
ALTER TABLE `actualizaciones_juego`
  MODIFY `id_actualizacion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `desarrolladores`
--
ALTER TABLE `desarrolladores`
  MODIFY `id_dev` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `editores`
--
ALTER TABLE `editores`
  MODIFY `id_editor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `expansiones`
--
ALTER TABLE `expansiones`
  MODIFY `id_expansion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id_genero` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id_juego` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actualizaciones_juego`
--
ALTER TABLE `actualizaciones_juego`
  ADD CONSTRAINT `actualizaciones_juego_ibfk_1` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`);

--
-- Filtros para la tabla `compras_expansion`
--
ALTER TABLE `compras_expansion`
  ADD CONSTRAINT `compras_expansion_ibfk_1` FOREIGN KEY (`id_expansion`) REFERENCES `expansiones` (`id_expansion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_expansion_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compras_juego`
--
ALTER TABLE `compras_juego`
  ADD CONSTRAINT `compras_juego_ibfk_1` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_juego_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `devs_expansion`
--
ALTER TABLE `devs_expansion`
  ADD CONSTRAINT `devs_expansion_ibfk_1` FOREIGN KEY (`id_expansion`) REFERENCES `expansiones` (`id_expansion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `devs_expansion_ibfk_2` FOREIGN KEY (`id_dev`) REFERENCES `desarrolladores` (`id_dev`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `devs_juego`
--
ALTER TABLE `devs_juego`
  ADD CONSTRAINT `devs_juego_ibfk_1` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON UPDATE CASCADE,
  ADD CONSTRAINT `devs_juego_ibfk_2` FOREIGN KEY (`id_dev`) REFERENCES `desarrolladores` (`id_dev`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `editores_expansion`
--
ALTER TABLE `editores_expansion`
  ADD CONSTRAINT `editores_expansion_ibfk_1` FOREIGN KEY (`id_editor`) REFERENCES `editores` (`id_editor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `editores_expansion_ibfk_2` FOREIGN KEY (`id_expansion`) REFERENCES `expansiones` (`id_expansion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `editores_juego`
--
ALTER TABLE `editores_juego`
  ADD CONSTRAINT `editores_juego_ibfk_1` FOREIGN KEY (`id_editor`) REFERENCES `editores` (`id_editor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `editores_juego_ibfk_2` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `expansiones`
--
ALTER TABLE `expansiones`
  ADD CONSTRAINT `expansiones_ibfk_1` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `expansiones_wishlist`
--
ALTER TABLE `expansiones_wishlist`
  ADD CONSTRAINT `expansiones_wishlist_ibfk_1` FOREIGN KEY (`id_expansion`) REFERENCES `expansiones` (`id_expansion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `expansiones_wishlist_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `generos_expansion`
--
ALTER TABLE `generos_expansion`
  ADD CONSTRAINT `generos_expansion_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`) ON UPDATE CASCADE,
  ADD CONSTRAINT `generos_expansion_ibfk_2` FOREIGN KEY (`id_expansion`) REFERENCES `expansiones` (`id_expansion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `generos_juego`
--
ALTER TABLE `generos_juego`
  ADD CONSTRAINT `generos_juego_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`) ON UPDATE CASCADE,
  ADD CONSTRAINT `generos_juego_ibfk_2` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `juegos_wishlist`
--
ALTER TABLE `juegos_wishlist`
  ADD CONSTRAINT `FOREIN KEY` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `juegos_wishlist_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
