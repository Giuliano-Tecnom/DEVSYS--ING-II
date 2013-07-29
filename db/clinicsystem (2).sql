-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-07-2013 a las 00:54:11
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`idespecialidad`, `nombre`, `activo`) VALUES
(5, 'PediatrÃ­a', 1),
(6, 'OdontologÃ­a', 1),
(7, 'TraumatologÃ­a', 1),
(8, 'CirugÃ­a', 0),
(9, 'Oftalmologia', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`idhorario`, `horaIn`, `horaOut`, `dia`, `dia_nro`, `fecha`) VALUES
(1, '08:00:00', '14:00:00', 'Lunes', 1, '2013-07-29'),
(2, '14:00:00', '20:00:00', 'Lunes', 1, '2013-07-29'),
(3, '08:00:00', '14:00:00', 'Martes', 2, '2013-07-30'),
(4, '14:00:00', '20:00:00', 'Martes', 2, '2013-07-30'),
(5, '08:00:00', '14:00:00', 'Miercoles', 3, '2013-07-31'),
(6, '14:00:00', '20:00:00', 'Miercoles', 3, '2013-07-31'),
(7, '08:00:00', '14:00:00', 'Jueves', 4, '2013-08-01'),
(8, '14:00:00', '20:00:00', 'Jueves', 4, '2013-08-01'),
(9, '08:00:00', '14:00:00', 'Viernes', 5, '2013-08-02'),
(10, '14:00:00', '20:00:00', 'Viernes', 5, '2013-08-02'),
(11, '08:00:00', '14:00:00', 'Sabado', 6, '2013-08-03');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `licencias`
--

INSERT INTO `licencias` (`idlicencia`, `idmedico`, `fechaDesde`, `fechaHasta`, `estado`) VALUES
(17, 5, '2013-07-19', '2013-07-23', 0),
(18, 5, '2013-07-30', '2013-08-02', 1);

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

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`idmedico`, `nombre`, `apellido`, `nromatricula`, `email`, `telefono`, `fechaNac`, `dni`, `direccion`, `activo`) VALUES
(5, 'Esteban', 'Salinas', 111111111, '', 223459977, '1987-06-04', 10789456, '75 N 800', 1),
(6, 'Enrique', 'Planes', 555553333, '', 4536666, '1975-01-30', 20785463, '65 N 1021', 1),
(7, 'Albert', 'Rincolben', 557894645, '', 4699855, '1990-05-15', 151515151, '528 N 777', 0),
(8, 'Santiago', 'Puricelli', 9472742, '', 2147483647, '2009-12-02', 316361881, '4 y 527', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `med_esp`
--

CREATE TABLE IF NOT EXISTS `med_esp` (
  `idmedico` int(11) NOT NULL,
  `idespecialidad` int(11) NOT NULL,
  PRIMARY KEY (`idmedico`,`idespecialidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `med_esp`
--

INSERT INTO `med_esp` (`idmedico`, `idespecialidad`) VALUES
(5, 9),
(6, 6),
(7, 5),
(7, 9),
(8, 6),
(8, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `med_hor`
--

CREATE TABLE IF NOT EXISTS `med_hor` (
  `idmedico` int(11) NOT NULL,
  `idhorario` int(11) NOT NULL,
  PRIMARY KEY (`idmedico`,`idhorario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `med_hor`
--

INSERT INTO `med_hor` (`idmedico`, `idhorario`) VALUES
(5, 1),
(5, 3),
(5, 5),
(5, 7),
(5, 8),
(5, 9),
(5, 10),
(5, 11),
(6, 1),
(6, 4),
(6, 5),
(6, 8),
(6, 9),
(6, 11),
(7, 6),
(7, 7),
(7, 8),
(7, 9),
(7, 10),
(7, 11),
(8, 3),
(8, 5),
(8, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `med_obrasocial`
--

CREATE TABLE IF NOT EXISTS `med_obrasocial` (
  `idmedico` int(11) NOT NULL,
  `idobra` int(11) NOT NULL,
  PRIMARY KEY (`idmedico`,`idobra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `med_obrasocial`
--

INSERT INTO `med_obrasocial` (`idmedico`, `idobra`) VALUES
(5, 6),
(5, 7),
(5, 8),
(5, 9),
(6, 6),
(7, 6),
(7, 7),
(8, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obrasociales`
--

CREATE TABLE IF NOT EXISTS `obrasociales` (
  `idobra` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idobra`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `obrasociales`
--

INSERT INTO `obrasociales` (`idobra`, `nombre`, `activo`) VALUES
(6, 'OSECAC', 1),
(7, 'OSSEG', 1),
(8, 'IOMA', 1),
(9, 'GALENO', 1),
(10, 'VITTAL', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=83 ;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`idpaciente`, `dni`, `apellido`, `nombre`, `email`, `telefono`, `fechaNac`, `direccion`, `activo`) VALUES
(79, 35179786, 'Gonzalez', 'Ezequiel', '', 4536110, '1990-03-26', '60 N 1007', 1),
(81, 32155166, 'Romero', 'Cristian', '', 4511010, '1985-10-10', '501 N 120', 1),
(82, 16178752, 'Cambiasso', 'Adolfo', '', 4202020, '1999-02-15', '125 N 300', 0);

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

--
-- Volcado de datos para la tabla `pac_obrasocial`
--

INSERT INTO `pac_obrasocial` (`idpaciente`, `idobra`, `nroAfiliado`) VALUES
(79, 7, '1'),
(80, 8, '1'),
(80, 9, '1'),
(81, 6, '1'),
(81, 9, '1'),
(82, 9, '2');

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
  `estado` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en espera',
  PRIMARY KEY (`idturno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`idturno`, `idmedico`, `idpaciente`, `idobra`, `idhora`, `fecha`, `idespecialidad`, `estado`) VALUES
(33, 5, 81, 999, 18, '2013-07-18', 9, 'cancelado'),
(34, 5, 79, 999, 1, '2013-07-26', 9, 'en espera');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `apellido`, `usuario`, `password`, `tipo`) VALUES
(3, 'ESTEBAN', 'SALINAS', 'SALINAS', '12345', 'administrador'),
(6, 'CRISTIAN', 'ROMERO', 'ROMERO', '12345', 'usuario');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
