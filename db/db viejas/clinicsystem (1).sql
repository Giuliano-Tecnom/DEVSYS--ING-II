-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2013 at 09:10 PM
-- Server version: 5.6.11-log
-- PHP Version: 5.4.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clinicsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `especialidades`
--

CREATE TABLE IF NOT EXISTS `especialidades` (
  `idespecialidad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idespecialidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `especialidades`
--

INSERT INTO `especialidades` (`idespecialidad`, `nombre`, `activo`) VALUES
(1, 'Pediatria', 1),
(2, 'Odontologia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hora`
--

CREATE TABLE IF NOT EXISTS `hora` (
  `idhora` int(11) NOT NULL AUTO_INCREMENT,
  `hora` time NOT NULL,
  PRIMARY KEY (`idhora`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `hora`
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
-- Table structure for table `horarios`
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
-- Dumping data for table `horarios`
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
(9, '08:00:00', '14:00:00', 'Viernes', 5, '2013-07-26'),
(10, '14:00:00', '20:00:00', 'Viernes', 5, '2013-07-26'),
(11, '08:00:00', '14:00:00', 'Sabado', 6, '2013-07-27');

-- --------------------------------------------------------

--
-- Table structure for table `licencias`
--

CREATE TABLE IF NOT EXISTS `licencias` (
  `idlicencia` int(11) NOT NULL AUTO_INCREMENT,
  `idmedico` int(11) NOT NULL,
  `fechaDesde` date NOT NULL,
  `fechaHasta` date NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idlicencia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `licencias`
--

INSERT INTO `licencias` (`idlicencia`, `idmedico`, `fechaDesde`, `fechaHasta`, `estado`) VALUES
(1, 1, '2013-06-27', '2013-07-04', 0),
(3, 4, '2013-06-27', '2013-06-28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `medicos`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `medicos`
--

INSERT INTO `medicos` (`idmedico`, `nombre`, `apellido`, `nromatricula`, `email`, `telefono`, `fechaNac`, `dni`, `direccion`, `activo`) VALUES
(1, 'Orlando', 'Piazzesi', 123456645, 'osvaldo@gmail.com', 123456789, '1992-09-01', 123456789, '123456789', 1),
(2, 'Javier', 'Mascherano', 12345633, '', 4356789, '2013-06-01', 12345678, '60 N 1009', 0),
(3, 'esteban', 'salinas', 1324342, '', 4847273, '2013-06-01', 364355435, '3434 nÂ° 343', 1),
(4, 'pep', 'lalal', 1234568, '', 4838131, '2013-06-01', 345242342, '50 127', 1);

-- --------------------------------------------------------

--
-- Table structure for table `med_esp`
--

CREATE TABLE IF NOT EXISTS `med_esp` (
  `idmedico` int(11) NOT NULL,
  `idespecialidad` int(11) NOT NULL,
  PRIMARY KEY (`idmedico`,`idespecialidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `med_esp`
--

INSERT INTO `med_esp` (`idmedico`, `idespecialidad`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 2),
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `med_hor`
--

CREATE TABLE IF NOT EXISTS `med_hor` (
  `idmedico` int(11) NOT NULL,
  `idhorario` int(11) NOT NULL,
  PRIMARY KEY (`idmedico`,`idhorario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `med_hor`
--

INSERT INTO `med_hor` (`idmedico`, `idhorario`) VALUES
(1, 1),
(3, 1),
(3, 3),
(3, 5),
(3, 11),
(4, 1),
(4, 4),
(4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `med_obrasocial`
--

CREATE TABLE IF NOT EXISTS `med_obrasocial` (
  `idmedico` int(11) NOT NULL,
  `idobra` int(11) NOT NULL,
  PRIMARY KEY (`idmedico`,`idobra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `med_obrasocial`
--

INSERT INTO `med_obrasocial` (`idmedico`, `idobra`) VALUES
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `obrasociales`
--

CREATE TABLE IF NOT EXISTS `obrasociales` (
  `idobra` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idobra`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `obrasociales`
--

INSERT INTO `obrasociales` (`idobra`, `nombre`, `activo`) VALUES
(1, 'GALEN', 1),
(2, 'OSDE', 1),
(3, 'IOMA', 1),
(4, 'OSCPU', 1),
(5, 'prueba obraa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pacientes`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=79 ;

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` (`idpaciente`, `dni`, `apellido`, `nombre`, `email`, `telefono`, `fechaNac`, `direccion`, `activo`) VALUES
(73, 10000000, 'Piazzese', 'Esteban', 'giuly.tolosaa@hotmail.com', 4710301, '2013-06-01', '501 y 27', 1),
(74, 36936534, 'Piazzese', 'Estebanquito', 'giuly.tolosaa@hotmail.com', 4710301, '2013-06-01', '501 y 27', 1),
(75, 11221112, 'gonzalez', 'aaaaaaa', 'ezequiel@hotmail.com', 1234565687, '2013-06-01', '521 N 1009', 1),
(76, 35179786, 'gonzalez', 'ezequiel', '', 2147483647, '2013-05-27', '18327824782', 1),
(77, 534543535, 'dfgdgfdfg', 'fgdfgfg', '', 2147483647, '2013-06-01', 'fgdfgdfgdg', 1),
(78, 111222333, 'prueba', 'pruebamodal', '', 111222333, '1939-02-15', 'concha de la lora', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pac_obrasocial`
--

CREATE TABLE IF NOT EXISTS `pac_obrasocial` (
  `idpaciente` int(11) NOT NULL,
  `idobra` int(11) NOT NULL,
  `nroAfiliado` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idpaciente`,`idobra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pac_obrasocial`
--

INSERT INTO `pac_obrasocial` (`idpaciente`, `idobra`, `nroAfiliado`) VALUES
(73, 2, '1245'),
(74, 3, '1234'),
(81, 1, '1234a');

-- --------------------------------------------------------

--
-- Table structure for table `turnos`
--

CREATE TABLE IF NOT EXISTS `turnos` (
  `idturno` int(11) NOT NULL AUTO_INCREMENT,
  `idmedico` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `idobra` int(11) DEFAULT NULL,
  `idhora` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`idturno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `turnos`
--

INSERT INTO `turnos` (`idturno`, `idmedico`, `idpaciente`, `idobra`, `idhora`, `fecha`) VALUES
(1, 1, 73, 2, 4, '2013-06-27'),
(2, 3, 77, 1, 8, '2013-06-26'),
(3, 1, 74, 2, 5, '2013-06-27'),
(4, 0, 0, 0, 0, '0000-00-00'),
(5, 3, 73, 1, 1, '2013-06-22'),
(7, 4, 73, 2, 1, '2013-06-24'),
(8, 1, 73, 2, 3, '2013-06-24'),
(9, 4, 73, 1, 2, '2013-06-24'),
(10, 4, 73, 2, 4, '2013-06-24'),
(11, 3, 76, 1, 1, '2013-06-25'),
(12, 3, 0, 1, 3, '2013-06-25'),
(13, 3, 0, 1, 4, '2013-06-25'),
(14, 4, 77, 1, 19, '2013-06-25'),
(16, 4, 77, 1, 19, '2013-06-25'),
(17, 0, 0, 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
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
