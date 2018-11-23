-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2018 a las 13:10:57
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
CREATE DATABASE IF NOT EXISTS `quiz` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `quiz`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestionario`
--

CREATE TABLE IF NOT EXISTS `cuestionario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cuestionario`
--

INSERT INTO `cuestionario` (`id`, `codigo`, `titulo`) VALUES
(1, 'PRUEBA1', 'Examen de Prueba 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE IF NOT EXISTS `evaluacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cuestionario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nota` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  KEY `id_cuestionario` (`id_cuestionario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE IF NOT EXISTS `pregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cuestionario` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `alternativa1` varchar(50) NOT NULL,
  `alternativa2` varchar(50) NOT NULL,
  `alternativa3` varchar(50) NOT NULL,
  `alternativa4` varchar(50) NOT NULL,
  `alternativa5` varchar(50) NOT NULL,
  `correcta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cuestionario` (`id_cuestionario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `codigo`, `dni`, `nombresyapellidos`) VALUES
(1, '1234', '12345678', 'Silvana Cabana');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
