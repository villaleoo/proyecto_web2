-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2023 a las 21:03:22
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `webtpe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clubes`
--

CREATE TABLE `clubes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `ciudad` varchar(45) NOT NULL,
  `id_liga` int(11) NOT NULL,
  `nombre_estadio` varchar(45) NOT NULL,
  `capacidad_estadio` int(11) NOT NULL,
  `descripcion_historia` text NOT NULL,
  `apodo` varchar(50) NOT NULL,
  `fecha_fundacion` date NOT NULL,
  `imagen_logo` varbinary(25000) DEFAULT NULL,
  `temporada_analisis` int(11) NOT NULL,
  `cant_partidos_jugados` int(11) NOT NULL,
  `goles_en_liga` int(11) NOT NULL,
  `goles_en_copa` int(11) NOT NULL,
  `promedio_edad_equipo` int(11) NOT NULL,
  `cantidad_jugadores` int(11) NOT NULL,
  `imagen_estadio` varbinary(20000) DEFAULT NULL,
  `entidad` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clubes`
--

INSERT INTO `clubes` (`id`, `nombre`, `ciudad`, `id_liga`, `nombre_estadio`, `capacidad_estadio`, `descripcion_historia`, `apodo`, `fecha_fundacion`, `imagen_logo`, `temporada_analisis`, `cant_partidos_jugados`, `goles_en_liga`, `goles_en_copa`, `promedio_edad_equipo`, `cantidad_jugadores`, `imagen_estadio`, `entidad`) VALUES
(1, 'aston villa', 'birmingham', 2, 'villa park', 42000, 'El Aston Villa Football Club es un club de fútbol del Reino Unido con sede en Birmingham (Inglaterra). Disputa la Premier League, máxima categoría del fútbol inglés, ininterrumpidamente desde 2019.​', 'villanos', '1897-07-14', '', 2022, 98, 25, 13, 28, 32, '', 'club'),
(2, 'chelsea', 'londres', 2, 'stamford bridge', 41841, 'El Chelsea Football Club (AFI: ˈtʃɛɫsiː), conocido simplemente como Chelsea, es un club de fútbol profesional de Inglaterra con sede en el distrito de Fulham, Londres, que disputa actualmente la Premier League, máxima competición futbolística de ese país.', 'the blues', '1905-03-10', '', 2022, 98, 25, 13, 28, 32, '', 'club'),
(3, 'bayer leverkusen', 'leverkusen', 3, 'bayarena', 30210, 'l Bayer 04 Leverkusen (Bayer 04 Leverkusen Fußball GmbH en alemán)1​ es un club de fútbol ubicado en Leverkusen, en la metrópoli Rin-Ruhr de Renania del Norte-Westfalia, Alemania. El equipo compite en la 1. Bundesliga, la primera división del fútbol nacional.', 'die werkself', '1904-07-01', NULL, 2022, 98, 33, 22, 25, 33, NULL, 'club'),
(5, 'borussia dortmund', 'dortmund', 3, 'signal iduna park', 81365, 'El Borussia Dortmund es una entidad deportiva profesional sita en Dortmund, en la región Rin-Ruhr del estado federal de Renania del Norte-Westfalia, Alemania. ', 'die schwarzgelben', '1909-12-19', '', 2022, 115, 23, 23, 32, 32, '', 'club');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ligas`
--

CREATE TABLE `ligas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `pais` varchar(80) NOT NULL,
  `formato` varchar(80) NOT NULL,
  `reglas` varchar(300) NOT NULL,
  `cant_partidos` int(11) NOT NULL,
  `division` int(11) NOT NULL,
  `fecha_fundacion` date NOT NULL,
  `descripcion` text NOT NULL,
  `temporada` int(11) NOT NULL,
  `imagen_logo` varbinary(20000) DEFAULT NULL,
  `imagen_pais` varbinary(20000) DEFAULT NULL,
  `entidad` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ligas`
--

INSERT INTO `ligas` (`id`, `nombre`, `pais`, `formato`, `reglas`, `cant_partidos`, `division`, `fecha_fundacion`, `descripcion`, `temporada`, `imagen_logo`, `imagen_pais`, `entidad`) VALUES
(2, 'premier league', 'inglaterra', 'Al término de la temporada 2011-12, ha habido 20 temporadas completas de la Premier League. Ante la insistencia de la FIFA, el organismo rector a nivel internacional del fútbol, de que las ligas regionales debían reducir el número de clubes que participan en ellas, la cifra de participantes disminuyó a 20 en 1995 tras el descenso de cuatro equipos contra el ascenso de solamente dos.', 'liguilla', 38, 1, '1992-08-14', 'La Premier League (en español: Liga Premier), también conocida en Inglaterra como The Premiership, es la máxima categoría del sistema de ligas de fútbol de Inglaterra. Comenzó a disputarse en la temporada 1992-93. En ella pueden también participar, por motivos históricos, aquellos clubes galeses que lo deseen, siempre que hayan competido ininterrumpidamente en el sistema de fútbol federado inglés desde, al menos, el 30 de junio de 1992', 2022, NULL, NULL, 'liga'),
(3, 'bundesliga', 'alemania', 'A lo largo de la historia de la competición han participado cincuenta y seis equipos diferentes. Con la excepción del Bayer 04 Leverkusen, TSG Hoffenheim y el VfL Wolfsburgo, todos los clubes son sociedades limitadas deportivas regidos bajo la Regla 50+1 que establece que los socios deben poseer más de la mitad del accionariado del club, pudiendo recaer el resto de la propiedad en accionistas, mientras que los dos citados son los únicos que se permite excepcionalmente ser entidades deportivas cuya propiedad mayor pertenezca a un único ente o estamento.', 'liguilla', 34, 1, '1963-08-24', 'La Bundesliga (en alemán: Fußball-Bundesliga (escuchar)ⓘ -Liga Federal de Fútbol-) es la competición entre los equipos de fútbol de la máxima categoría de Alemania. Se empezó a disputar en 1963, a partir de la unificación de los antiguos campeonatos locales llamados Oberligen. Junto a la Zweite Bundesliga y Dritte Bundesliga, forman las tres divisiones nacionales del fútbol profesional en Alemania.', 2022, NULL, NULL, 'liga');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(40) NOT NULL,
  `contrasenia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `contrasenia`) VALUES
(1, 'webadmin', '$2y$10$pITzopbsAYmLwUQr4AEyMuVG5qXM8MnflQAfUTfe4tb4T.O41FTPq');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clubes`
--
ALTER TABLE `clubes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_liga` (`id_liga`);

--
-- Indices de la tabla `ligas`
--
ALTER TABLE `ligas`
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
-- AUTO_INCREMENT de la tabla `clubes`
--
ALTER TABLE `clubes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ligas`
--
ALTER TABLE `ligas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clubes`
--
ALTER TABLE `clubes`
  ADD CONSTRAINT `clubes_ibfk_1` FOREIGN KEY (`id_liga`) REFERENCES `ligas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
