-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2013 a las 07:55:37
-- Versión del servidor: 5.6.11-log
-- Versión de PHP: 5.4.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `clinicsystem`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE IF NOT EXISTS `especialidades` (
  `idespecialidad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idespecialidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hora`
--

CREATE TABLE IF NOT EXISTS `hora` (
  `idhora` int(11) NOT NULL AUTO_INCREMENT,
  `hora` time NOT NULL,
  PRIMARY KEY (`idhora`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `hora`
--

INSERT INTO `hora` (`idhora`, `hora`) VALUES
(1, '08:00:00'),
(2, '08:30:00'),
(3, '09:00:00'),
(4, '09:30:00'),
(5, '10:00:00'),
(6, '10:30:00'),
(7, '11:00:00'),
(8, '11:30:00'),
(9, '12:00:00'),
(10, '12:30:00'),
(11, '13:00:00'),
(12, '13:30:00'),
(13, '14:00:00'),
(14, '14:30:00'),
(15, '15:00:00'),
(16, '15:30:00'),
(17, '16:00:00'),
(18, '16:30:00'),
(19, '17:00:00'),
(20, '17:30:00'),
(21, '18:00:00'),
(22, '18:30:00'),
(23, '19:00:00'),
(24, '19:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE IF NOT EXISTS `horarios` (
  `idhorario` int(11) NOT NULL AUTO_INCREMENT,
  `horaIn` time NOT NULL,
  `horaOut` time NOT NULL,
  `dia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dia_nro` int(2) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`idhorario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`idhorario`, `horaIn`, `horaOut`, `dia`, `dia_nro`, `fecha`) VALUES
(1, '08:00:00', '14:00:00', 'Lunes', 1, '2013-07-01'),
(2, '14:00:00', '20:00:00', 'Lunes', 1, '2013-07-01'),
(3, '08:00:00', '14:00:00', 'Martes', 2, '2013-07-02'),
(4, '14:00:00', '20:00:00', 'Martes', 2, '2013-07-02'),
(5, '08:00:00', '14:00:00', 'Miercoles', 3, '2013-07-03'),
(6, '14:00:00', '20:00:00', 'Miercoles', 3, '2013-07-03'),
(7, '08:00:00', '14:00:00', 'Jueves', 4, '2013-07-04'),
(8, '14:00:00', '20:00:00', 'Jueves', 4, '2013-07-04'),
(9, '08:00:00', '14:00:00', 'Viernes', 5, '2013-07-05'),
(10, '14:00:00', '20:00:00', 'Viernes', 5, '2013-07-05'),
(11, '08:00:00', '14:00:00', 'Sabado', 6, '2013-06-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencias`
--

CREATE TABLE IF NOT EXISTS `licencias` (
  `idlicencia` int(11) NOT NULL AUTO_INCREMENT,
  `idmedico` int(11) NOT NULL,
  `fechaDesde` date NOT NULL,
  `fechaHasta` date NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idlicencia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE IF NOT EXISTS `medicos` (
  `idmedico` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nromatricula` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` int(25) NOT NULL,
  `fechaNac` date NOT NULL,
  `dni` int(11) NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idmedico`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `med_esp`
--

CREATE TABLE IF NOT EXISTS `med_esp` (
  `idmedico` int(11) NOT NULL,
  `idespecialidad` int(11) NOT NULL,
  PRIMARY KEY (`idmedico`,`idespecialidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `med_hor`
--

CREATE TABLE IF NOT EXISTS `med_hor` (
  `idmedico` int(11) NOT NULL,
  `idhorario` int(11) NOT NULL,
  PRIMARY KEY (`idmedico`,`idhorario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `med_obrasocial`
--

CREATE TABLE IF NOT EXISTS `med_obrasocial` (
  `idmedico` int(11) NOT NULL,
  `idobra` int(11) NOT NULL,
  PRIMARY KEY (`idmedico`,`idobra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obrasociales`
--

CREATE TABLE IF NOT EXISTS `obrasociales` (
  `idobra` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idobra`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE IF NOT EXISTS `pacientes` (
  `idpaciente` int(11) NOT NULL AUTO_INCREMENT,
  `dni` int(11) NOT NULL,
  `apellido` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` int(11) NOT NULL,
  `fechaNac` date NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idpaciente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=81 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pac_obrasocial`
--

CREATE TABLE IF NOT EXISTS `pac_obrasocial` (
  `idpaciente` int(11) NOT NULL,
  `idobra` int(11) NOT NULL,
  `nroAfiliado` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idpaciente`,`idobra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE IF NOT EXISTS `turnos` (
  `idturno` int(11) NOT NULL AUTO_INCREMENT,
  `idmedico` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `idobra` int(11) DEFAULT NULL,
  `idhora` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idespecialidad` int(11) NOT NULL,
  PRIMARY KEY (`idturno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
