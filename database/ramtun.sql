-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-11-2020 a las 18:27:58
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ramtun`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE IF NOT EXISTS `alumnos` (
  `idalumno` int(3) NOT NULL AUTO_INCREMENT,
  `dni` int(8) NOT NULL,
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  `apellido` varchar(50) CHARACTER SET latin1 NOT NULL,
  `clave` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idalumno`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`idalumno`, `dni`, `nombre`, `apellido`, `clave`) VALUES
(1, 12345678, 'Pablo', 'Romero', 'c483f6ce851c9ecd9fb835ff7551737c'),
(2, 40182652, 'Franco', 'Ortiz', 'c483f6ce851c9ecd9fb835ff7551737c'),
(3, 1234, 'Anónimo', 'Usuario', 'c6865cf98b133f1f3de596a4a2894630');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anios`
--

DROP TABLE IF EXISTS `anios`;
CREATE TABLE IF NOT EXISTS `anios` (
  `idanio` int(1) NOT NULL AUTO_INCREMENT,
  `numero` int(1) NOT NULL,
  PRIMARY KEY (`idanio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `anios`
--

INSERT INTO `anios` (`idanio`, `numero`) VALUES
(1, 1),
(2, 2),
(3, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

DROP TABLE IF EXISTS `consultas`;
CREATE TABLE IF NOT EXISTS `consultas` (
  `idconsulta` int(3) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) CHARACTER SET latin1 NOT NULL,
  `contenido` longtext CHARACTER SET latin1 NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idmateria` int(3) NOT NULL,
  `idalumno` int(3) NOT NULL,
  PRIMARY KEY (`idconsulta`),
  KEY `idmateria` (`idmateria`,`idalumno`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`idconsulta`, `titulo`, `contenido`, `fecha`, `idmateria`, `idalumno`) VALUES
(1, 'Consulta 1', 'Consulta de ejemplo para verificar la funcionalidad del apartado.', '2015-09-23 14:07:23', 1, 3),
(29, 'Funciones', 'Cómo se resuelve una función de a pares?', '2015-10-05 13:14:19', 2, 1),
(30, 'Tarea', 'A qué hora se entrega la tarea?', '2015-10-31 13:57:14', 1, 1),
(31, 'Aviso', 'Hoy me olvidé un pendrive en el horario de clase. Alguien lo ha visto?', '2015-11-02 14:01:54', 2, 1),
(32, 'Última clase', 'Hoy es el último día de la materia cierto?', '2015-11-16 12:44:07', 2, 1),
(33, 'Temas evaluación', 'Buen día profesor, quería saber cuáles son los temas que se evaluarán en el examen.', '2015-11-16 12:48:31', 3, 1),
(35, 'Encriptación php', 'Para la siguiente clase que métodos de encriptación hay que investigar?', '2015-11-16 13:02:40', 5, 2),
(36, 'Creación', 'La próxima clase trabajaremos con la madera que sobró para crear un silla?', '2020-11-27 04:56:58', 1, 1),
(37, 'Documentación', 'Cómo puedo empezar la documentación del proyecto?', '2020-11-27 05:02:43', 5, 1),
(38, 'Consulta biología', 'Vamos a ver anatomía humana?', '2020-11-27 06:01:00', 4, 1),
(39, 'Medidas silla', 'De cuanto debe ser la medida de la silla en altura?', '2020-11-27 07:15:27', 1, 1),
(40, 'Matematica 2020', 'Este año se realizan las olimpiadas de matemática, cierto?', '2020-11-27 15:47:34', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

DROP TABLE IF EXISTS `docentes`;
CREATE TABLE IF NOT EXISTS `docentes` (
  `iddocente` int(3) NOT NULL AUTO_INCREMENT,
  `dni` int(8) NOT NULL,
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  `apellido` varchar(50) CHARACTER SET latin1 NOT NULL,
  `clave` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`iddocente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`iddocente`, `dni`, `nombre`, `apellido`, `clave`) VALUES
(1, 87654321, 'Mauricio', 'Baier', 'dc468c70fb574ebd07287b38d0d0676d');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE IF NOT EXISTS `materias` (
  `idmateria` int(3) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(6) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  `idanio` int(1) NOT NULL,
  PRIMARY KEY (`idmateria`),
  KEY `idanio` (`idanio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`idmateria`, `tipo`, `nombre`, `idanio`) VALUES
(1, 'Taller', 'Carpinteria', 1),
(2, 'Teoria', 'Matematica', 1),
(3, 'Taller', 'Hojalateria', 1),
(4, 'Teoria', 'Biologia', 2),
(5, 'taller', 'Construccion de Software', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiasdocentes`
--

DROP TABLE IF EXISTS `materiasdocentes`;
CREATE TABLE IF NOT EXISTS `materiasdocentes` (
  `idmd` int(3) NOT NULL AUTO_INCREMENT,
  `iddocente` int(3) NOT NULL,
  `idmateria` int(3) NOT NULL,
  PRIMARY KEY (`idmd`),
  KEY `iddocente` (`iddocente`,`idmateria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `materiasdocentes`
--

INSERT INTO `materiasdocentes` (`idmd`, `iddocente`, `idmateria`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 4),
(4, 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

DROP TABLE IF EXISTS `respuestas`;
CREATE TABLE IF NOT EXISTS `respuestas` (
  `idrespuesta` int(3) NOT NULL AUTO_INCREMENT,
  `contenido` longtext CHARACTER SET latin1 NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  `apellido` varchar(50) CHARACTER SET latin1 NOT NULL,
  `idconsulta` int(3) NOT NULL,
  `idalumno` int(3) DEFAULT NULL,
  `iddocente` int(3) DEFAULT NULL,
  PRIMARY KEY (`idrespuesta`),
  KEY `idconsulta` (`idconsulta`,`idalumno`,`iddocente`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`idrespuesta`, `contenido`, `fecha`, `nombre`, `apellido`, `idconsulta`, `idalumno`, `iddocente`) VALUES
(79, 'Funciona!!!', '2015-10-05 13:28:42', 'Pablo', 'Romero', 1, 1, NULL),
(80, 'Hola', '2015-10-08 13:07:32', 'Pablo', 'Romero', 1, 1, NULL),
(81, 'hola', '2015-10-31 13:57:29', 'Pablo', 'Romero', 30, 1, NULL),
(82, 'hola', '2015-10-31 13:58:11', 'Oscar', 'Perez', 30, NULL, 1),
(86, 'si', '2015-11-02 14:02:05', 'Pablo', 'Romero', 31, 1, NULL),
(87, 'hola\r\n', '2015-11-16 12:44:16', 'Pablo', 'Romero', 32, 1, NULL),
(88, 'chau', '2015-11-16 12:44:47', 'Oscar', 'Perez', 32, NULL, 1),
(89, 'qwe!\r\n', '2015-11-16 12:48:54', 'Pablo', 'Romero', 33, 1, NULL),
(90, 'Eh, si viejin!', '2015-11-16 13:03:20', 'Mauricio', 'Baier', 35, NULL, 1),
(91, ':) :D ^^', '2015-11-16 13:03:33', 'Mauricio', 'Baier', 35, NULL, 1),
(92, 'Respuesta 2020 biologÃ­a', '2020-11-27 14:48:31', 'Pablo', 'Romero', 38, 1, NULL),
(93, 'Todavía no lo sé a esta altura', '2020-11-27 18:08:35', 'Pablo', 'Romero', 37, 1, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
