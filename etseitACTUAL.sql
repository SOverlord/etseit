-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `etseitSystem` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `etseitSystem`;


-- Estructura de pabla para la tabla Servicios
DROP TABLE IF EXISTS `Servicios`;
CREATE TABLE IF NOT EXISTS `Servicios`(
	`idServicio` int(10) NOT NULL AUTO_INCREMENT,
	`TipoServicio` varchar(40) NOT NULL,
	`NombreServicio` varchar(100) NOT NULL,
	`Precio` int(20) NOT NULL,
	`Gamma` int(5) NOT NULL,
	`Disponibles` int(10) NOT NULL,
	PRIMARY KEY (`idServicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Estructura para la tabla Ciudad
DROP TABLE IF EXISTS `Ciudad`;
CREATE TABLE IF NOT EXISTS `Ciudad`(
	`idCiudad` int(10) NOT NULL AUTO_INCREMENT,
	`NombreCiudad` varchar(40) NOT NULL,
	PRIMARY KEY (`idCiudad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Estructura para la tabla Puerto
DROP TABLE IF EXISTS `Puerto`;
CREATE TABLE IF NOT EXISTS `Puerto`(
	`idPuerto`				int(10) NOT NULL AUTO_INCREMENT,
	`NombrePuerto` 			varchar(40) NOT NULL,
	`fk_idCiudad_Puerto`	int(10) NOT NULL,
	`fk_idServicio_Puerto`	int(10) NOT NULL,
	PRIMARY KEY (`idPuerto`),
	KEY `fk_idCiudad_Puerto_idx` (`fk_idCiudad_Puerto`),
	KEY `fk_idServicio_Puerto_idx` (`fk_idServicio_Puerto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Estructura para la tabla Aeropuerto
DROP TABLE IF EXISTS `Aeropuerto`;
CREATE TABLE IF NOT EXISTS `Aeropuerto`(
	`idAeropuerto`				int(10) NOT NULL AUTO_INCREMENT,
	`NombreAeropuerto` 			varchar(40) NOT NULL,
	`fk_idCiudad_Aeropuerto`	int(10) NOT NULL,
	`fk_idServicio_Aeropuerto`	int(10) NOT NULL,
	PRIMARY KEY (`idAeropuerto`),
	KEY `fk_idCiudad_Aeropuerto_idx` (`fk_idCiudad_Aeropuerto`),
	KEY `fk_idServicio_Aeropuerto_idx` (`fk_idServicio_Aeropuerto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Estructura para la tabla Hotel
DROP TABLE IF EXISTS `Hotel`;
CREATE TABLE IF NOT EXISTS `Hotel`(
	`idHotel`				int(10) NOT NULL AUTO_INCREMENT,
	`fk_idCiudad_Hotel`	int(10) NOT NULL,
	`fk_idServicio_Hotel`	int(10) NOT NULL,
	PRIMARY KEY (`idHotel`),
	KEY `fk_idCiudad_Hotel_idx` (`fk_idCiudad_Hotel`),
	KEY `fk_idServicio_Hotel_idx` (`fk_idServicio_Hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Estructura para la tabla AgenciaAuto
DROP TABLE IF EXISTS `AgenciaAuto`;
CREATE TABLE IF NOT EXISTS `AgenciaAuto`(
	`idAgenciaAuto`				int(10) NOT NULL AUTO_INCREMENT,
	`NombreAgenciaAuto` 			varchar(40) NOT NULL,
	`fk_idCiudad_AgenciaAuto`	int(10) NOT NULL,
	`fk_idServicio_AgenciaAuto`	int(10) NOT NULL,
	PRIMARY KEY (`idAgenciaAuto`),
	KEY `fk_idCiudad_AgenciaAuto_idx` (`fk_idCiudad_AgenciaAuto`),
	KEY `fk_idServicio_AgenciaAuto_idx` (`fk_idServicio_AgenciaAuto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



-- Estructura para la tabla Perfil
DROP TABLE IF EXISTS `Perfil`;
CREATE TABLE IF NOT EXISTS `Perfil`(
	`idPerfil` int(10) NOT NULL AUTO_INCREMENT,
	`TipoPerfil` varchar(40) NOT NULL,
	PRIMARY KEY (`idPerfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Estructura para la tabla Usuario
DROP TABLE IF EXISTS `Usuario`;
CREATE TABLE IF NOT EXISTS `Usuario`(
	`idUsuario` 			int(10) NOT NULL AUTO_INCREMENT,
	`Alias` 				varchar(50) NOT NULL,
	`NombreCompleto` 		varchar(100) NOT NULL,
	`Password`				varchar(255) NOT NULL,
	`Cookie`				varchar(255) DEFAULT NULL,
	`Validez`				datetime DEFAULT NULL,
	`Status`				int(5) NOT NULL,
	`NumViajes`				int(10) NOT NULL,
	`fk_idPerfil_Usuario`	int(10) NOT NULL,
	PRIMARY KEY (`idUsuario`),
	KEY `fk_idPerfil_Usuario_idx` (`fk_idPerfil_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Estructura para la tabla TelDeUsuario
DROP TABLE IF EXISTS `TeldeUsuario`;
CREATE TABLE IF NOT EXISTS `TeldeUsuario`(
	`idTeldeUsuario` int(10) NOT NULL AUTO_INCREMENT,
	`Telefono`		 int(40) NOT NULL,
	`fk_idUsuario_TeldeUsuario`	int(10) NOT NULL,
	PRIMARY KEY (`idTeldeUsuario`),
	KEY `fk_idUsuario_TeldeUsuario_idx` (`fk_idUsuario_TeldeUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Estructura para tabla de CorreodeUsuario
DROP TABLE IF EXISTS `CorreodeUsuario`;
CREATE TABLE IF NOT EXISTS `CorreodeUsuario`(
	`idCorreodeUsuario` int(10) NOT NULL AUTO_INCREMENT,
	`Correo`		 int(40) NOT NULL,
	`fk_idUsuario_CorreodeUsuario`	int(10) NOT NULL,
	PRIMARY KEY (`idCorreodeUsuario`),
	KEY `fk_idUsuario_CorreodeUsuario_idx` (`fk_idUsuario_CorreodeUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;




-- Estructura para la tabla de ReservaHotel
DROP TABLE IF EXISTS `ReservaHotel`;
CREATE TABLE IF NOT EXISTS `ReservaHotel` (
  `idReservaHotel` int(11) NOT NULL AUTO_INCREMENT,
  `FechaInicio` date NOT NULL,
  `FechaFinal` date NOT NULL,
  `PagoAnticipado` int(11) DEFAULT NULL,
  `fk_idHotel_ReservaHotel` int(11) NOT NULL,
  `fk_idUsuario_ReservaHotel` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReservaHotel`),
  KEY `fk_idHotel_ReservaHotel_idx` (`fk_idHotel_ReservaHotel`),
  KEY `fk_idUsuario_ReservaHotel_idx` (`fk_idUsuario_ReservaHotel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Estructura para la tabla de ReservaBarco
DROP TABLE IF EXISTS `ReservaBarco`;
CREATE TABLE IF NOT EXISTS `ReservaBarco` (
  `idReservaBarco` int(11) NOT NULL AUTO_INCREMENT,
  `FechaInicio` date NOT NULL,
  `FechaFinal` date NOT NULL,
  `PagoAnticipado` int(11) DEFAULT NULL,
  `fk_idPuerto_ReservaBarco` int(11) NOT NULL,
  `fk_idUsuario_ReservaBarco` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReservaBarco`),
  KEY `fk_idPuerto_ReservaBarco_idx` (`fk_idPuerto_ReservaBarco`),
  KEY `fk_idUsuario_ReservaBarco_idx` (`fk_idUsuario_ReservaBarco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Estructura para la tabla de ReservaAvion
DROP TABLE IF EXISTS `ReservaAvion`;
CREATE TABLE IF NOT EXISTS `ReservaAvion` (
  `idReservaAvion` int(11) NOT NULL AUTO_INCREMENT,
  `FechaInicio` date NOT NULL,
  `FechaFinal` date NOT NULL,
  `PagoAnticipado` int(11) DEFAULT NULL,
  `fk_idAeropuerto_ReservaAvion` int(11) NOT NULL,
  `fk_idUsuario_ReservaAvion` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReservaAvion`),
  KEY `fk_idAeropuerto_ReservaAvion` (`fk_idAeropuerto_ReservaAvion`),
  KEY `fk_idUsuario_ReservaAvion_idx` (`fk_idUsuario_ReservaAvion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Estructura para la tabla de ReservaAuto
DROP TABLE IF EXISTS `ReservaAuto`;
CREATE TABLE IF NOT EXISTS `ReservaAuto` (
  `idReservaAuto` int(11) NOT NULL AUTO_INCREMENT,
  `FechaInicio` date NOT NULL,
  `FechaFinal` date NOT NULL,
  `PagoAnticipado` int(11) DEFAULT NULL,
  `fk_idAgenciaAuto_ReservaAuto` int(11) NOT NULL,
  `fk_idUsuario_ReservaAuto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReservaAuto`),
  KEY `fk_idAgenciaAuto_ReservaAuto_idx` (`fk_idAgenciaAuto_ReservaAuto`),
  KEY `fk_idUsuario_ReservaAuto_idx` (`fk_idUsuario_ReservaAuto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- FOREING KEYS

-- Estructura para la tabla Puerto
ALTER TABLE `Puerto`
	ADD CONSTRAINT `fk_idCiudad_Puerto_idx`
	FOREIGN KEY (`fk_idCiudad_Puerto`)
	REFERENCES `Ciudad` (`idCiudad`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION,
	
	ADD CONSTRAINT `fk_idServicio_Puerto_idx`
	FOREIGN KEY (`fk_idServicio_Puerto`)
	REFERENCES `Servicios` (`idServicio`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION;


-- Estructura para la tabla Aeropuerto
ALTER TABLE `Aeropuerto`
	ADD CONSTRAINT `fk_idCiudad_Aeropuerto_idx`
	FOREIGN KEY (`fk_idCiudad_Aeropuerto`)
	REFERENCES `Ciudad` (`idCiudad`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION,

	ADD CONSTRAINT `fk_idServicio_Aeropuerto_idx`
	FOREIGN KEY (`fk_idServicio_Aeropuerto`)
	REFERENCES `Servicios` (`idServicio`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION;

-- Estructura para la tabla Hotel
ALTER TABLE `Hotel`
	ADD CONSTRAINT `fk_idCiudad_Hotel_idx`
	FOREIGN KEY (`fk_idCiudad_Hotel`)
	REFERENCES `Ciudad`(`idCiudad`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION,

	ADD CONSTRAINT `fk_idServicio_Hotel_idx`
	FOREIGN KEY (`fk_idServicio_Hotel`)
	REFERENCES `Servicios` (`idServicio`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION;

-- Estructura para la tabla AgenciaAuto
ALTER TABLE `AgenciaAuto`
	ADD CONSTRAINT `fk_idCiudad_AgenciaAuto_idx`
	FOREIGN KEY (`fk_idCiudad_AgenciaAuto`)
	REFERENCES `Ciudad`(`idCiudad`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION,

	ADD CONSTRAINT `fk_idServicio_AgenciaAuto_idx`
	FOREIGN KEY (`fk_idServicio_AgenciaAuto`)
	REFERENCES `Servicios` (`idServicio`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION;

-- Estructura para la tabla Usuario
ALTER TABLE `Usuario`
	ADD CONSTRAINT `fk_idPerfil_Usuario_idx`
	FOREIGN KEY (`fk_idPerfil_Usuario`)
	REFERENCES `Perfil`(`idPerfil`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION;

-- Estructura para la tabla TeldeUsuario
ALTER TABLE `TeldeUsuario`
	ADD CONSTRAINT `fk_idUsuario_TeldeUsuario_idx`
	FOREIGN KEY (`fk_idUsuario_TeldeUsuario`)
	REFERENCES `Usuario`(`idUsuario`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION;

-- Estructura para la tabla CorreodeUsuario
ALTER TABLE `CorreodeUsuario`
	ADD CONSTRAINT `fk_idUsuario_CorreodeUsuario_idx`
	FOREIGN KEY (`fk_idUsuario_CorreodeUsuario`)
	REFERENCES `Usuario`(`idUsuario`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION;

-- Estructura para la tabla ReservaHotel
ALTER TABLE `ReservaHotel`
	ADD CONSTRAINT `fk_idHotel_ReservaHotel_idx`
	FOREIGN KEY (`fk_idHotel_ReservaHotel`)
	REFERENCES `Hotel`(`idHotel`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION,

	ADD CONSTRAINT `fk_idUsuario_ReservaHotel_idx`
	FOREIGN KEY (`fk_idUsuario_ReservaHotel`)
	REFERENCES `Usuario`(`idUsuario`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION;

-- Estructura para la tabla ReservaBarco
ALTER TABLE `ReservaBarco`
	ADD CONSTRAINT `fk_idPuerto_ReservaBarco_idx`
	FOREIGN KEY (`fk_idPuerto_ReservaBarco`)
	REFERENCES `Puerto`(`idPuerto`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION,

	ADD CONSTRAINT `fk_idUsuario_ReservaBarco_idx`
	FOREIGN KEY (`fk_idUsuario_ReservaBarco`)
	REFERENCES `Usuario`(`idUsuario`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION;

-- Estructura para la tabla ReservaAvion
ALTER TABLE `ReservaAvion`
	ADD CONSTRAINT `fk_idAeropuerto_ReservaAvion_idx`
	FOREIGN KEY (`fk_idAeropuerto_ReservaAvion`)
	REFERENCES `Aeropuerto`(`idAeropuerto`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION,

	ADD CONSTRAINT `fk_idUsuario_ReservaAvion_idx`
	FOREIGN KEY (`fk_idUsuario_ReservaAvion`)
	REFERENCES `Usuario`(`idUsuario`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION;

-- Estructura para la tabla ReservaAuto
ALTER TABLE `ReservaAuto`
	ADD CONSTRAINT `fk_idAgenciaAuto_ReservaAuto_idx`
	FOREIGN KEY (`fk_idAgenciaAuto_ReservaAuto`)
	REFERENCES `AgenciaAuto`(`idAgenciaAuto`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION,

	ADD CONSTRAINT `fk_idUsuario_ReservaAuto_idx`
	FOREIGN KEY (`fk_idUsuario_ReservaAuto`)
	REFERENCES `Usuario`(`idUsuario`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION;

-- /////////////////////////////////////////
-- INSERTS
	-- Servicios
	-- Perfil
	-- Ciudad

	-- Puerto
	-- Aeropuerto
	-- AgenciaAuto
	-- Hotel
-- /////////////////////////////////////////
