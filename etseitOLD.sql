-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2016 at 06:30 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `etseit`
--

-- --------------------------------------------------------

--
-- Table structure for table `Aerolinea`
--

CREATE TABLE IF NOT EXISTS `Aerolinea` (
  `idAerolinea` int(11) NOT NULL AUTO_INCREMENT,
  `NombreAerolinea` varchar(45) NOT NULL,
  PRIMARY KEY (`idAerolinea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=952 ;

--
-- Dumping data for table `Aerolinea`
--

INSERT INTO `Aerolinea` (`idAerolinea`, `NombreAerolinea`) VALUES
(1, 'VivAerobus'),
(2, 'Volare'),
(3, 'Canda'),
(4, 'Estados Unidos'),
(145, 'American Airlines'),
(156, 'Emirates'),
(157, 'Aeromexico'),
(165, 'Volaris'),
(170, 'Interjet'),
(477, 'Mexicana'),
(641, 'Air France'),
(712, 'Avianca'),
(753, 'Peruvian Airlines'),
(951, 'Aerolíneas Argentinas');

-- --------------------------------------------------------

--
-- Table structure for table `Aeropuerto`
--

CREATE TABLE IF NOT EXISTS `Aeropuerto` (
  `idAeropuerto` int(11) NOT NULL,
  `NombreAeropuerto` varchar(80) DEFAULT NULL,
  `TasaAeropuerto` int(11) DEFAULT NULL,
  `Categoria` varchar(15) DEFAULT NULL,
  `idAerolinea` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAeropuerto`),
  KEY `fk1_idx_idAerolinea` (`idAerolinea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Aeropuerto`
--

INSERT INTO `Aeropuerto` (`idAeropuerto`, `NombreAeropuerto`, `TasaAeropuerto`, `Categoria`, `idAerolinea`) VALUES
(333, 'Aeropuerto Internacional de Cancún', 5, '1', 157),
(444, 'Aeropuerto Internacional de la Ciudad de México', 5, '1', 165),
(555, 'Aeropuerto Internacional de Ciudad del Carmen', 3, '1', 170),
(667, 'Aeropuerto Internacional de Ciudad Juárez', 5, '1', 170),
(777, 'Aeropuerto Internacional de Guadalajara', 5, '1', 641),
(888, 'Aeropuerto Internacional de La Paz', 5, '1', 712),
(987, 'Aeropuerto Internacional de Torreón', 3, '1', 951),
(999, 'Aeropuerto Internacional de Monterrey', 7, '1', 753);

-- --------------------------------------------------------

--
-- Table structure for table `Alquiler`
--

CREATE TABLE IF NOT EXISTS `Alquiler` (
  `idAlquiler` int(11) NOT NULL AUTO_INCREMENT,
  `Alquiler_idAutomovil_fk` int(11) NOT NULL,
  `FechaInicioAlquiler` date DEFAULT NULL,
  `FechaFinalAlquiler` date DEFAULT NULL,
  `Ciudad` varchar(45) DEFAULT NULL,
  `Alquiler_idUsuario_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAlquiler`),
  KEY `fk_Alquiler_Automovil1_idx` (`Alquiler_idAutomovil_fk`),
  KEY `fk_idx_idUsuario` (`Alquiler_idUsuario_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Automovil`
--

CREATE TABLE IF NOT EXISTS `Automovil` (
  `idAutomovil` int(11) NOT NULL AUTO_INCREMENT,
  `NombreAutomovil` varchar(45) DEFAULT NULL,
  `Precio` int(11) DEFAULT NULL,
  `Gama` varchar(20) DEFAULT NULL,
  `Clasificacion` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idAutomovil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Automovil`
--

INSERT INTO `Automovil` (`idAutomovil`, `NombreAutomovil`, `Precio`, `Gama`, `Clasificacion`) VALUES
(1, 'Atos', 50000, 'Alta', 'A'),
(2, 'Sonic', 100000, 'Alta', 'B'),
(3, 'Lobo', 70000, 'media', 'B'),
(4, 'Audi', 200000, 'Alta', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `Barco`
--

CREATE TABLE IF NOT EXISTS `Barco` (
  `idBarco` int(11) NOT NULL AUTO_INCREMENT,
  `NombreBarco` varchar(45) NOT NULL,
  PRIMARY KEY (`idBarco`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Barco`
--

INSERT INTO `Barco` (`idBarco`, `NombreBarco`) VALUES
(1, 'Marinerito'),
(2, 'Popeye'),
(3, 'AaronMarinero'),
(4, 'JassoMarinerito');

-- --------------------------------------------------------

--
-- Table structure for table `BarcoPuerto`
--

CREATE TABLE IF NOT EXISTS `BarcoPuerto` (
  `idCiudadPuerto` int(11) NOT NULL AUTO_INCREMENT,
  `idBarco` int(11) DEFAULT NULL,
  `idPuerto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCiudadPuerto`),
  KEY `fk1_idx` (`idBarco`),
  KEY `fk2_idx` (`idPuerto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Ciudad`
--

CREATE TABLE IF NOT EXISTS `Ciudad` (
  `idCiudad` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCiudad` varchar(45) NOT NULL,
  PRIMARY KEY (`idCiudad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `Ciudad`
--

INSERT INTO `Ciudad` (`idCiudad`, `NombreCiudad`) VALUES
(1, 'Acapulco'),
(2, 'Aguascalientes'),
(3, 'Cancún'),
(4, 'Ciudad de México'),
(5, 'Ciudad del Carmen'),
(6, 'Ciudad Juárez'),
(7, 'Guadalajara'),
(8, 'La Paz'),
(9, 'Monterrey'),
(10, 'Torreón'),
(30, 'Tabasco'),
(40, 'Guerrero'),
(100, 'Veracuz');

-- --------------------------------------------------------

--
-- Table structure for table `CiudadAero`
--

CREATE TABLE IF NOT EXISTS `CiudadAero` (
  `idCiudadAero` int(11) NOT NULL AUTO_INCREMENT,
  `idAeropuerto` int(11) NOT NULL,
  `idCiudad` int(11) NOT NULL,
  PRIMARY KEY (`idCiudadAero`),
  KEY `fk1_idx_CiudadAero` (`idAeropuerto`),
  KEY `fk_CiudadAero_Ciudad1_idx` (`idCiudad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `CiudadHotel`
--

CREATE TABLE IF NOT EXISTS `CiudadHotel` (
  `idCiudadHotel` int(11) NOT NULL AUTO_INCREMENT,
  `CiudadHotel_idHotel_fk` int(11) DEFAULT NULL,
  `CiudadHotel_idCiudad_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCiudadHotel`),
  KEY `fk1_idx` (`CiudadHotel_idHotel_fk`),
  KEY `fk2_idx` (`CiudadHotel_idCiudad_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `CiudadHotel`
--

INSERT INTO `CiudadHotel` (`idCiudadHotel`, `CiudadHotel_idHotel_fk`, `CiudadHotel_idCiudad_fk`) VALUES
(1, 1, 4),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `Correos`
--

CREATE TABLE IF NOT EXISTS `Correos` (
  `idCorreos` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCorreos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Hotel`
--

CREATE TABLE IF NOT EXISTS `Hotel` (
  `idHotel` int(11) NOT NULL AUTO_INCREMENT,
  `NombreHotel` varchar(45) NOT NULL,
  `Precio` int(11) DEFAULT NULL,
  `Clasificacion` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idHotel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `Hotel`
--

INSERT INTO `Hotel` (`idHotel`, `NombreHotel`, `Precio`, `Clasificacion`) VALUES
(1, 'Hotel 1', 550, 'Oro'),
(2, 'Papanoa', 50, 'Piedra'),
(3, 'Piedra 1', 120, 'Piedra'),
(4, 'Piedra 2', 120, 'Piedra'),
(5, 'Piedra 3', 150, 'Piedra'),
(6, 'Bronce 1', 150, 'Bronce'),
(7, 'Bronce 2', 550, 'Bronce'),
(8, 'Bronce 3', 550, 'Bronce'),
(9, 'Bronce 4', 550, 'Bronce'),
(10, 'HB', 600, 'Plata'),
(11, 'One', 750, 'Plata'),
(12, 'Playa Bruja', 750, 'Plata'),
(13, 'Rio', 750, 'Plata'),
(14, 'Bello', 900, 'Oro'),
(15, 'Las Flores', 950, 'Oro'),
(16, 'Comfort Inn', 1350, 'Oro'),
(17, 'Los Rosales', 1250, 'Oro');

-- --------------------------------------------------------

--
-- Table structure for table `Perfiles`
--

CREATE TABLE IF NOT EXISTS `Perfiles` (
  `idPerfiles` int(11) NOT NULL,
  `TipoPerfil` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPerfiles`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Perfiles`
--

INSERT INTO `Perfiles` (`idPerfiles`, `TipoPerfil`) VALUES
(1, 'Agencia de Viajes'),
(2, 'Particular');

-- --------------------------------------------------------

--
-- Table structure for table `Puerto`
--

CREATE TABLE IF NOT EXISTS `Puerto` (
  `idPuerto` int(11) NOT NULL AUTO_INCREMENT,
  `NombrePuerto` varchar(45) DEFAULT NULL,
  `tasa` int(11) DEFAULT NULL,
  `Categoria` varchar(15) DEFAULT NULL,
  `Puerto_idCiudad_fk` int(11) NOT NULL,
  PRIMARY KEY (`idPuerto`),
  KEY `fk_Puerto_Ciudad1_idx` (`Puerto_idCiudad_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `Puerto`
--

INSERT INTO `Puerto` (`idPuerto`, `NombrePuerto`, `tasa`, `Categoria`, `Puerto_idCiudad_fk`) VALUES
(1, 'Puerto 1', 5, '5', 1),
(2, 'Puerto 2', 5, '5', 2),
(3, 'Puerto 3', 5, '3', 3),
(4, 'Puerto 4', 5, '3', 4),
(10, 'Puerto 1', 5, '5', 1),
(20, 'Puerto 2', 5, '5', 2),
(30, 'Puerto 3', 5, '3', 3),
(40, 'Puerto 4', 5, '3', 4),
(50, 'Puerto 5', 5, '3', 5),
(60, 'Puerto 6', 5, '3', 6),
(70, 'Puerto 7', 5, '3', 7),
(80, 'Puerto 8', 5, '3', 8),
(90, 'Puerto 9', 5, '3', 9),
(100, 'Puerto 10', 5, '3', 10),
(110, 'Puerto 11', 5, '3', 100);

-- --------------------------------------------------------

--
-- Table structure for table `ReservaAvion`
--

CREATE TABLE IF NOT EXISTS `ReservaAvion` (
  `idReservaAvion` int(11) NOT NULL AUTO_INCREMENT,
  `ReservarAvion_idAerolinea_fk` int(11) NOT NULL,
  `NoBoletos` int(11) DEFAULT NULL,
  `FechaVuelo` date DEFAULT NULL,
  `PagoAnticipado` int(11) DEFAULT NULL,
  `CosteAsociado` int(11) DEFAULT NULL,
  `Azafatas` int(11) DEFAULT NULL,
  `ReservarAvion_idTipoVUelo_fk` int(11) DEFAULT NULL,
  `ReservarAvion_idUsuario_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReservaAvion`),
  KEY `fk_ReservaAvion_Aerolinea1_idx` (`ReservarAvion_idAerolinea_fk`),
  KEY `fk1_idx_ReservaAvion` (`ReservarAvion_idTipoVUelo_fk`),
  KEY `fk2_idx_ReservaAvion` (`ReservarAvion_idUsuario_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ReservaBarco`
--

CREATE TABLE IF NOT EXISTS `ReservaBarco` (
  `idReservaBarco` int(11) NOT NULL AUTO_INCREMENT,
  `ReservaVarco_idBarco_fk` int(11) NOT NULL,
  `BoletosBarco` int(11) DEFAULT NULL,
  `FechaBarco` date DEFAULT NULL,
  `PagoAnticipado` int(11) DEFAULT NULL,
  `CosteAsociado` int(11) DEFAULT NULL,
  `ReservaBarco_idUsuario_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReservaBarco`),
  KEY `fk_ReservaBarco_Barco1_idx` (`ReservaVarco_idBarco_fk`),
  KEY `fk1_idx_ReservaBarco` (`ReservaBarco_idUsuario_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ReservaHotel`
--

CREATE TABLE IF NOT EXISTS `ReservaHotel` (
  `idReserva` int(11) NOT NULL AUTO_INCREMENT,
  `Hotel_idHotel` int(11) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFinal` date NOT NULL,
  `PagoAnticipado` int(11) DEFAULT NULL,
  `CosteAsociado` int(11) DEFAULT NULL,
  `NoHabitaciones` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReserva`),
  KEY `fk_ReservaHotel_Hotel_idx` (`Hotel_idHotel`),
  KEY `fk_idx` (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=236 ;

-- --------------------------------------------------------

--
-- Table structure for table `Telefonos`
--

CREATE TABLE IF NOT EXISTS `Telefonos` (
  `idTelefonos` int(11) NOT NULL AUTO_INCREMENT,
  `Telefono` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idTelefonos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `TipoVuelo`
--

CREATE TABLE IF NOT EXISTS `TipoVuelo` (
  `idTipoVuelo` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idTipoVuelo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `TipoVuelo`
--

INSERT INTO `TipoVuelo` (`idTipoVuelo`, `Tipo`) VALUES
(1, 'Bajo'),
(2, 'Regular'),
(3, 'Alto');

-- --------------------------------------------------------

--
-- Table structure for table `UsuarioCorreo`
--

CREATE TABLE IF NOT EXISTS `UsuarioCorreo` (
  `idUsuarioCorreo` int(11) NOT NULL AUTO_INCREMENT,
  `idCorreo` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuarioCorreo`),
  KEY `fk1_idx` (`idCorreo`),
  KEY `fk2_idx` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Usuarios`
--

CREATE TABLE IF NOT EXISTS `Usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `NombreCompleto` varchar(65) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Contrasena` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `Perfil` int(11) DEFAULT NULL,
  `cookie` varchar(255) DEFAULT NULL,
  `validez` datetime DEFAULT NULL,
  PRIMARY KEY (`idUsuarios`),
  KEY `fk1_idx` (`Perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `Usuarios`
--

INSERT INTO `Usuarios` (`idUsuarios`, `Usuario`, `NombreCompleto`, `Contrasena`, `Status`, `Perfil`, `cookie`, `validez`) VALUES
(36, 'SpeedStream', 'Aarón Santos Canela', 'Niño123', 1, 1, NULL, NULL),
(37, 'SpeedStream', 'Fulano 2 Armando', 'Niño123', 1, 1, NULL, NULL),
(38, 'SpeedStream', 'Fulano 3 Martinez', 'Niño123', 1, 1, NULL, NULL),
(39, 'Heron', 'Herón Zurita', 'SoyHeron', 1, 2, NULL, NULL),
(40, 'cortana123', 'Karen Pintos', 'unacontraseñakilometrica', 1, 2, NULL, NULL),
(100, 'karen123', 'asdasd', '2bd0207a5cdd4819fdec1373b3174c3fb11425b6', 1, 1, NULL, NULL),
(101, '', '', '', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `UsuarioTel`
--

CREATE TABLE IF NOT EXISTS `UsuarioTel` (
  `idUsuarioTel` int(11) NOT NULL AUTO_INCREMENT,
  `idTelefono` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuarioTel`),
  KEY `fk1_idx` (`idTelefono`),
  KEY `fk2_idx` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Aeropuerto`
--
ALTER TABLE `Aeropuerto`
  ADD CONSTRAINT `fk1_idx_idAerolinea` FOREIGN KEY (`idAerolinea`) REFERENCES `Aerolinea` (`idAerolinea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Alquiler`
--
ALTER TABLE `Alquiler`
  ADD CONSTRAINT `fk_Alquiler_Automovil1` FOREIGN KEY (`Alquiler_idAutomovil_fk`) REFERENCES `Automovil` (`idAutomovil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idx_idUsuario` FOREIGN KEY (`Alquiler_idUsuario_fk`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `BarcoPuerto`
--
ALTER TABLE `BarcoPuerto`
  ADD CONSTRAINT `fk1_BarcoPuerto` FOREIGN KEY (`idBarco`) REFERENCES `Barco` (`idBarco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk2_BarcoPuerto` FOREIGN KEY (`idPuerto`) REFERENCES `Puerto` (`idPuerto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `CiudadAero`
--
ALTER TABLE `CiudadAero`
  ADD CONSTRAINT `fk1_idx_CiudadAero` FOREIGN KEY (`idAeropuerto`) REFERENCES `Aeropuerto` (`idAeropuerto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CiudadAero_Ciudad1_idx` FOREIGN KEY (`idCiudad`) REFERENCES `Ciudad` (`idCiudad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `CiudadHotel`
--
ALTER TABLE `CiudadHotel`
  ADD CONSTRAINT `fk1_CiudadHotel` FOREIGN KEY (`CiudadHotel_idHotel_fk`) REFERENCES `Hotel` (`idHotel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk2_CiudadHotel` FOREIGN KEY (`CiudadHotel_idCiudad_fk`) REFERENCES `Ciudad` (`idCiudad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Puerto`
--
ALTER TABLE `Puerto`
  ADD CONSTRAINT `fk_Puerto_Ciudad1_idx` FOREIGN KEY (`Puerto_idCiudad_fk`) REFERENCES `Ciudad` (`idCiudad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ReservaAvion`
--
ALTER TABLE `ReservaAvion`
  ADD CONSTRAINT `fk_ReservaAvion_Aerolinea1_idx` FOREIGN KEY (`ReservarAvion_idAerolinea_fk`) REFERENCES `Aerolinea` (`idAerolinea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk1_idx_ReservaAvion` FOREIGN KEY (`ReservarAvion_idTipoVUelo_fk`) REFERENCES `TipoVuelo` (`idTipoVuelo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk2_idx_ReservaAvion` FOREIGN KEY (`ReservarAvion_idUsuario_fk`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ReservaBarco`
--
ALTER TABLE `ReservaBarco`
  ADD CONSTRAINT `fk_ReservaBarco_Barco1` FOREIGN KEY (`ReservaVarco_idBarco_fk`) REFERENCES `Barco` (`idBarco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk1_idx_ReservaBarco` FOREIGN KEY (`ReservaBarco_idUsuario_fk`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ReservaHotel`
--
ALTER TABLE `ReservaHotel`
  ADD CONSTRAINT `fk_ReservaHotel_Hotel` FOREIGN KEY (`Hotel_idHotel`) REFERENCES `Hotel` (`idHotel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `UsuarioCorreo`
--
ALTER TABLE `UsuarioCorreo`
  ADD CONSTRAINT `fk1_UsuarioCorreo` FOREIGN KEY (`idCorreo`) REFERENCES `Correos` (`idCorreos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk2_UsuarioCorreo` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`Perfil`) REFERENCES `Perfiles` (`idPerfiles`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `UsuarioTel`
--
ALTER TABLE `UsuarioTel`
  ADD CONSTRAINT `fk1_UsuarioTel` FOREIGN KEY (`idTelefono`) REFERENCES `Telefonos` (`idTelefonos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk2_UsuarioTel` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
