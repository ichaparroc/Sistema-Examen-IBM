-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2018 a las 04:49:11
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `quiz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestionario`
--

CREATE TABLE IF NOT EXISTS `cuestionario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(25) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cuestionario`
--

INSERT INTO `cuestionario` (`id`, `codigo`, `titulo`) VALUES
(1, 'PRUEBA1', 'Examen de Prueba 1'),
(2, 'PRUEBA2', 'Examen 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE IF NOT EXISTS `evaluacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cuestionario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `nota` int(11) DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `id_cuestionario` (`id_cuestionario`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`id`, `id_cuestionario`, `id_usuario`, `fecha`, `nota`) VALUES
(49, 1, 1, '2018-11-28 04:48:03', 1),
(50, 1, 2, '2018-11-28 05:02:15', 0),
(51, 2, 1, '2018-11-28 05:04:11', 1),
(52, 2, 2, '2018-11-28 05:04:29', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE IF NOT EXISTS `pregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cuestionario` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `alternativa1` varchar(100) NOT NULL,
  `alternativa2` varchar(100) NOT NULL,
  `alternativa3` varchar(100) NOT NULL,
  `alternativa4` varchar(100) NOT NULL,
  `alternativa5` varchar(100) NOT NULL,
  `correcta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cuestionario` (`id_cuestionario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id`, `id_cuestionario`, `titulo`, `alternativa1`, `alternativa2`, `alternativa3`, `alternativa4`, `alternativa5`, `correcta`) VALUES
(1, 1, 'pregunta1', 'alternativa1', 'alternativa2', 'alternativa3', 'alternativa4', 'alternativa5', 1),
(2, 1, 'pregunta2', 'alternativa1', 'alternativa2', 'alternativa3', 'alternativa4', 'alternativa5', 2),
(3, 2, 'Pregunta1', 'Alternativa1', 'Alternativa2', 'Alternativa3', 'Alternativa4', 'Alternativa5', 5),
(4, 2, 'Pregunta2', 'Alternativa1', 'Alternativa2', 'Alternativa3', 'Alternativa4', 'Alternativa5', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE IF NOT EXISTS `respuesta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evaluacion` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `marcada` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_evaluacion` (`id_evaluacion`),
  KEY `id_pregunta` (`id_pregunta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id`, `id_evaluacion`, `id_pregunta`, `marcada`) VALUES
(17, 49, 1, 1),
(18, 49, 2, 3),
(19, 50, 1, 3),
(20, 50, 2, 4),
(21, 51, 3, 4),
(22, 51, 4, 4),
(23, 52, 3, 5),
(24, 52, 4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(4) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `nombresyapellidos` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `codigo`, `dni`, `nombresyapellidos`) VALUES
(1, '1234', '12345678', 'Silvana Cabana'),
(2, '2468', '24682468', 'Israel Chaparro');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD CONSTRAINT `id_cuestionario2` FOREIGN KEY (`id_cuestionario`) REFERENCES `cuestionario` (`id`),
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `id_cuestionario` FOREIGN KEY (`id_cuestionario`) REFERENCES `cuestionario` (`id`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `id_evaluacion` FOREIGN KEY (`id_evaluacion`) REFERENCES `evaluacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_pregunta` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
