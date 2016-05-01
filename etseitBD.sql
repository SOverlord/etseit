-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-05-2016 a las 09:21:24
-- Versión del servidor: 5.5.49-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `etseit`
--
CREATE DATABASE IF NOT EXISTS `etseit` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `etseit`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Aerolinea`
--

DROP TABLE IF EXISTS `Aerolinea`;
CREATE TABLE IF NOT EXISTS `Aerolinea` (
  `idAerolinea` int(11) NOT NULL AUTO_INCREMENT,
  `NombreAerolinea` varchar(45) NOT NULL,
  PRIMARY KEY (`idAerolinea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Aeropuerto`
--

DROP TABLE IF EXISTS `Aeropuerto`;
CREATE TABLE IF NOT EXISTS `Aeropuerto` (
  `idAeropuerto` int(11) NOT NULL,
  `NombreAeropuerto` varchar(80) DEFAULT NULL,
  `TasaAeropuerto` int(11) DEFAULT NULL,
  `Categoria` varchar(15) DEFAULT NULL,
  `idAerolinea` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAeropuerto`),
  KEY `fk1_idx_idAerolinea` (`idAerolinea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alquiler`
--

DROP TABLE IF EXISTS `Alquiler`;
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
-- Estructura de tabla para la tabla `Automovil`
--

DROP TABLE IF EXISTS `Automovil`;
CREATE TABLE IF NOT EXISTS `Automovil` (
  `idAutomovil` int(11) NOT NULL AUTO_INCREMENT,
  `NombreAutomovil` varchar(45) DEFAULT NULL,
  `Precio` int(11) DEFAULT NULL,
  `Gama` varchar(20) DEFAULT NULL,
  `Clasificacion` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idAutomovil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Barco`
--

DROP TABLE IF EXISTS `Barco`;
CREATE TABLE IF NOT EXISTS `Barco` (
  `idBarco` int(11) NOT NULL AUTO_INCREMENT,
  `NombreBarco` varchar(45) NOT NULL,
  PRIMARY KEY (`idBarco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BarcoPuerto`
--

DROP TABLE IF EXISTS `BarcoPuerto`;
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
-- Estructura de tabla para la tabla `Ciudad`
--

DROP TABLE IF EXISTS `Ciudad`;
CREATE TABLE IF NOT EXISTS `Ciudad` (
  `idCiudad` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCiudad` varchar(45) NOT NULL,
  PRIMARY KEY (`idCiudad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CiudadAero`
--

DROP TABLE IF EXISTS `CiudadAero`;
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
-- Estructura de tabla para la tabla `CiudadHotel`
--

DROP TABLE IF EXISTS `CiudadHotel`;
CREATE TABLE IF NOT EXISTS `CiudadHotel` (
  `idCiudadHotel` int(11) NOT NULL AUTO_INCREMENT,
  `CiudadHotel_idHotel_fk` int(11) DEFAULT NULL,
  `CiudadHotel_idCiudad_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCiudadHotel`),
  KEY `fk1_idx` (`CiudadHotel_idHotel_fk`),
  KEY `fk2_idx` (`CiudadHotel_idCiudad_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Correos`
--

DROP TABLE IF EXISTS `Correos`;
CREATE TABLE IF NOT EXISTS `Correos` (
  `idCorreos` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCorreos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Hotel`
--

DROP TABLE IF EXISTS `Hotel`;
CREATE TABLE IF NOT EXISTS `Hotel` (
  `idHotel` int(11) NOT NULL AUTO_INCREMENT,
  `NombreHotel` varchar(45) NOT NULL,
  `Precio` int(11) DEFAULT NULL,
  `Clasificacion` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idHotel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Perfiles`
--

DROP TABLE IF EXISTS `Perfiles`;
CREATE TABLE IF NOT EXISTS `Perfiles` (
  `idPerfiles` int(11) NOT NULL,
  `TipoPerfil` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPerfiles`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Perfiles`
--

INSERT INTO `Perfiles` (`idPerfiles`, `TipoPerfil`) VALUES
(1, 'Agencia de Viajes'),
(2, 'Particular');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Puerto`
--

DROP TABLE IF EXISTS `Puerto`;
CREATE TABLE IF NOT EXISTS `Puerto` (
  `idPuerto` int(11) NOT NULL AUTO_INCREMENT,
  `NombrePuerto` varchar(45) DEFAULT NULL,
  `tasa` int(11) DEFAULT NULL,
  `Categoria` varchar(15) DEFAULT NULL,
  `Puerto_idCiudad_fk` int(11) NOT NULL,
  PRIMARY KEY (`idPuerto`),
  KEY `fk_Puerto_Ciudad1_idx` (`Puerto_idCiudad_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ReservaAvion`
--

DROP TABLE IF EXISTS `ReservaAvion`;
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
-- Estructura de tabla para la tabla `ReservaBarco`
--

DROP TABLE IF EXISTS `ReservaBarco`;
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
-- Estructura de tabla para la tabla `ReservaHotel`
--

DROP TABLE IF EXISTS `ReservaHotel`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Telefonos`
--

DROP TABLE IF EXISTS `Telefonos`;
CREATE TABLE IF NOT EXISTS `Telefonos` (
  `idTelefonos` int(11) NOT NULL AUTO_INCREMENT,
  `Telefono` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idTelefonos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoVuelo`
--

DROP TABLE IF EXISTS `TipoVuelo`;
CREATE TABLE IF NOT EXISTS `TipoVuelo` (
  `idTipoVuelo` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idTipoVuelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UsuarioCorreo`
--

DROP TABLE IF EXISTS `UsuarioCorreo`;
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
-- Estructura de tabla para la tabla `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
CREATE TABLE IF NOT EXISTS `Usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(45) DEFAULT NULL,
  `NombreCompleto` varchar(65) DEFAULT NULL,
  `Contrasena` varchar(25) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `Perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuarios`),
  KEY `fk1_idx` (`Perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`idUsuarios`, `Usuario`, `NombreCompleto`, `Contrasena`, `Status`, `Perfil`) VALUES
(2, 'Usuario2', 'Fulanito Perez', 'AlgunaContrasenaLarga123789', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UsuarioTel`
--

DROP TABLE IF EXISTS `UsuarioTel`;
CREATE TABLE IF NOT EXISTS `UsuarioTel` (
  `idUsuarioTel` int(11) NOT NULL AUTO_INCREMENT,
  `idTelefono` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuarioTel`),
  KEY `fk1_idx` (`idTelefono`),
  KEY `fk2_idx` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Aeropuerto`
--
ALTER TABLE `Aeropuerto`
  ADD CONSTRAINT `fk1_idx_idAerolinea` FOREIGN KEY (`idAerolinea`) REFERENCES `Aerolinea` (`idAerolinea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Alquiler`
--
ALTER TABLE `Alquiler`
  ADD CONSTRAINT `fk_Alquiler_Automovil1` FOREIGN KEY (`Alquiler_idAutomovil_fk`) REFERENCES `Automovil` (`idAutomovil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idx_idUsuario` FOREIGN KEY (`Alquiler_idUsuario_fk`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `BarcoPuerto`
--
ALTER TABLE `BarcoPuerto`
  ADD CONSTRAINT `fk1_BarcoPuerto` FOREIGN KEY (`idBarco`) REFERENCES `Barco` (`idBarco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk2_BarcoPuerto` FOREIGN KEY (`idPuerto`) REFERENCES `Puerto` (`idPuerto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `CiudadAero`
--
ALTER TABLE `CiudadAero`
  ADD CONSTRAINT `fk1_idx_CiudadAero` FOREIGN KEY (`idAeropuerto`) REFERENCES `Aeropuerto` (`idAeropuerto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CiudadAero_Ciudad1_idx` FOREIGN KEY (`idCiudad`) REFERENCES `Ciudad` (`idCiudad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `CiudadHotel`
--
ALTER TABLE `CiudadHotel`
  ADD CONSTRAINT `fk1_CiudadHotel` FOREIGN KEY (`CiudadHotel_idHotel_fk`) REFERENCES `Hotel` (`idHotel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk2_CiudadHotel` FOREIGN KEY (`CiudadHotel_idCiudad_fk`) REFERENCES `Ciudad` (`idCiudad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Puerto`
--
ALTER TABLE `Puerto`
  ADD CONSTRAINT `fk_Puerto_Ciudad1_idx` FOREIGN KEY (`Puerto_idCiudad_fk`) REFERENCES `Ciudad` (`idCiudad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ReservaAvion`
--
ALTER TABLE `ReservaAvion`
  ADD CONSTRAINT `fk_ReservaAvion_Aerolinea1_idx` FOREIGN KEY (`ReservarAvion_idAerolinea_fk`) REFERENCES `Aerolinea` (`idAerolinea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk1_idx_ReservaAvion` FOREIGN KEY (`ReservarAvion_idTipoVUelo_fk`) REFERENCES `TipoVuelo` (`idTipoVuelo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk2_idx_ReservaAvion` FOREIGN KEY (`ReservarAvion_idUsuario_fk`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ReservaBarco`
--
ALTER TABLE `ReservaBarco`
  ADD CONSTRAINT `fk_ReservaBarco_Barco1` FOREIGN KEY (`ReservaVarco_idBarco_fk`) REFERENCES `Barco` (`idBarco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk1_idx_ReservaBarco` FOREIGN KEY (`ReservaBarco_idUsuario_fk`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ReservaHotel`
--
ALTER TABLE `ReservaHotel`
  ADD CONSTRAINT `fk_ReservaHotel_Hotel` FOREIGN KEY (`Hotel_idHotel`) REFERENCES `Hotel` (`idHotel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `UsuarioCorreo`
--
ALTER TABLE `UsuarioCorreo`
  ADD CONSTRAINT `fk1_UsuarioCorreo` FOREIGN KEY (`idCorreo`) REFERENCES `Correos` (`idCorreos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk2_UsuarioCorreo` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`Perfil`) REFERENCES `Perfiles` (`idPerfiles`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `UsuarioTel`
--
ALTER TABLE `UsuarioTel`
  ADD CONSTRAINT `fk1_UsuarioTel` FOREIGN KEY (`idTelefono`) REFERENCES `Telefonos` (`idTelefonos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk2_UsuarioTel` FOREIGN KEY (`idUsuario`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
