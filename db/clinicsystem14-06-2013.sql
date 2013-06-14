-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2013 at 05:35 AM
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
-- Table structure for table `horarios`
--

CREATE TABLE IF NOT EXISTS `horarios` (
  `idhorario` int(11) NOT NULL AUTO_INCREMENT,
  `horaIn` time NOT NULL,
  `horaOut` time NOT NULL,
  `dia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idhorario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `medicos`
--

INSERT INTO `medicos` (`idmedico`, `nombre`, `apellido`, `nromatricula`, `email`, `telefono`, `fechaNac`, `dni`, `direccion`, `activo`) VALUES
(1, 'Orlando', 'Piazzesi', 123456, 'osvaldo@gmail.com', 123456789, '1992-09-01', 123456789, '123456789', 1);

-- --------------------------------------------------------

--
-- Table structure for table `med_esp`
--

CREATE TABLE IF NOT EXISTS `med_esp` (
  `idmedico` int(11) NOT NULL,
  `idespecialidad` int(11) NOT NULL,
  PRIMARY KEY (`idmedico`,`idespecialidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `med_hor`
--

CREATE TABLE IF NOT EXISTS `med_hor` (
  `idmedico` int(11) NOT NULL,
  `idhorario` int(11) NOT NULL,
  PRIMARY KEY (`idmedico`,`idhorario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `obrasociales`
--

CREATE TABLE IF NOT EXISTS `obrasociales` (
  `idobra` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idobra`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `obrasociales`
--

INSERT INTO `obrasociales` (`idobra`, `nombre`, `activo`) VALUES
(1, 'GALEN', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=82 ;

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` (`idpaciente`, `dni`, `apellido`, `nombre`, `email`, `telefono`, `fechaNac`, `direccion`, `activo`) VALUES
(72, 0, '', '', '', 0, '0000-00-00', '', 0),
(73, 10000000, 'Piazzese', 'Esteban', 'giuly.tolosaa@hotmail.com', 4710301, '2013-06-01', '501 y 27', 1),
(74, 36936534, 'Piazzese', 'Estebanquito', 'giuly.tolosaa@hotmail.com', 4710301, '2013-06-01', '501 y 27', 0),
(75, 11221112, 'gonzalez', 'aaaaaaa', 'ezequiel@hotmail.com', 1234565687, '2013-06-01', '521 N 1009', 0),
(76, 35179786, 'gonzalez', 'ezequiel', '', 2147483647, '2013-05-27', '18327824782', 1),
(77, 534543535, 'dfgdgfdfg', 'fgdfgfg', '', 2147483647, '2013-06-01', 'fgdfgdfgdg', 1),
(78, 111222333, 'prueba', 'pruebamodal', '', 111222333, '1939-02-15', 'concha de la lora', 1),
(79, 432154321, 'maradona', 'Radiologia', '', 2147483647, '2013-06-01', '1wrqweqw', 1),
(80, 444444444, 'safsaf', 'Esteban', 'gapiazzese@hotmail.com', 2147483647, '2013-05-29', '521 N 1009', 1),
(81, 34567567, 'Piazzese', 'Luis', '', 123456789, '2013-06-01', 'la plata', 1);

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
(81, 1, '1234a');

-- --------------------------------------------------------

--
-- Table structure for table `turnos`
--

CREATE TABLE IF NOT EXISTS `turnos` (
  `idturno` int(11) NOT NULL AUTO_INCREMENT,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`idturno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
