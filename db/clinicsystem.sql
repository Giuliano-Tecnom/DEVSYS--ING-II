-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2013 a las 19:34:24
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`idespecialidad`, `nombre`, `activo`) VALUES
(1, 'Pediatria', 1),
(2, 'Odontologia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE IF NOT EXISTS `horarios` (
  `idhorario` int(11) NOT NULL AUTO_INCREMENT,
  `horaIn` time NOT NULL,
  `horaOut` time NOT NULL,
  `dia` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idhorario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`idhorario`, `horaIn`, `horaOut`, `dia`) VALUES
(1, '08:00:00', '14:00:00', 'Lunes   '),
(2, '14:00:00', '20:00:00', 'Lunes   '),
(3, '08:00:00', '14:00:00', 'Martes   '),
(4, '14:00:00', '20:00:00', 'Martes   '),
(5, '08:00:00', '14:00:00', 'Miercoles'),
(6, '14:00:00', '20:00:00', 'Miercoles'),
(7, '08:00:00', '14:00:00', 'Jueves  '),
(8, '14:00:00', '20:00:00', 'Jueves  '),
(9, '08:00:00', '14:00:00', 'Viernes  '),
(10, '14:00:00', '20:00:00', 'Viernes  '),
(11, '08:00:00', '14:00:00', 'Sabado  ');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`idmedico`, `nombre`, `apellido`, `nromatricula`, `email`, `telefono`, `fechaNac`, `dni`, `direccion`, `activo`) VALUES
(1, 'Orlando', 'Piazzesi', 123456, 'osvaldo@gmail.com', 123456789, '1992-09-01', 123456789, '123456789', 1),
(2, 'Javier', 'Mascherano', 12345633, '', 4356789, '2013-06-01', 12345678, '60 N 1009', 1);

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
(2, 1);

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
(2, 3),
(2, 6),
(2, 7),
(2, 10);

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
(1, 1),
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obrasociales`
--

CREATE TABLE IF NOT EXISTS `obrasociales` (
  `idobra` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idobra`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `obrasociales`
--

INSERT INTO `obrasociales` (`idobra`, `nombre`, `activo`) VALUES
(1, 'GALEN', 1),
(2, 'OSDE', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=82 ;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`idpaciente`, `dni`, `apellido`, `nombre`, `email`, `telefono`, `fechaNac`, `direccion`, `activo`) VALUES
(73, 10000000, 'Piazzese', 'Esteban', 'giuly.tolosaa@hotmail.com', 4710301, '2013-06-01', '501 y 27', 0),
(74, 36936534, 'Piazzese', 'Estebanquito', 'giuly.tolosaa@hotmail.com', 4710301, '2013-06-01', '501 y 27', 0),
(75, 11221112, 'gonzalez', 'aaaaaaa', 'ezequiel@hotmail.com', 1234565687, '2013-06-01', '521 N 1009', 1),
(76, 35179786, 'gonzalez', 'ezequiel', '', 2147483647, '2013-05-27', '18327824782', 1),
(77, 534543535, 'dfgdgfdfg', 'fgdfgfg', '', 2147483647, '2013-06-01', 'fgdfgdfgdg', 1),
(78, 111222333, 'prueba', 'pruebamodal', '', 111222333, '1939-02-15', 'concha de la lora', 0),
(79, 432154321, 'maradona', 'Radiologia', '', 2147483647, '2013-06-01', '1wrqweqw', 1),
(80, 444444444, 'safsaf', 'Esteban', 'gapiazzese@hotmail.com', 2147483647, '2013-05-29', '521 N 1009', 1),
(81, 34567567, 'Piazzese', 'Luis', '', 123456789, '2013-06-01', 'la plata', 1);

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
(81, 1, '1234a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE IF NOT EXISTS `turnos` (
  `idturno` int(11) NOT NULL AUTO_INCREMENT,
  `idmedico` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `idobra` int(11) DEFAULT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`idturno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
