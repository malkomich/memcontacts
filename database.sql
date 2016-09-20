/*
Navicat MySQL Data Transfer

Source Server         : IPC
Source Server Version : 50524
Source Host           : localhost
Source Database       : IPC01

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2013-06-07 10:57:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tabla_contactos`
-- ----------------------------
DROP TABLE IF EXISTS `tabla_contactos`;
CREATE TABLE `tabla_contactos` (
  `idContacto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `telefono` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idContacto`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of tabla_contactos
-- ----------------------------
INSERT INTO `tabla_contactos` VALUES ('1', 'Antonio Recio', '696451202', null);
INSERT INTO `tabla_contactos` VALUES ('2', 'Kim Jong-Un', '676335444', null);
INSERT INTO `tabla_contactos` VALUES ('3', 'Pepe', '676548799', 'pepe.jpg');
INSERT INTO `tabla_contactos` VALUES ('4', 'Burgundofora', '686452135', 'burgundofora.jpg');
INSERT INTO `tabla_contactos` VALUES ('5', 'Roberto', '626078903', null);
INSERT INTO `tabla_contactos` VALUES ('6', 'Julian Muñoz', '696784820', null);
INSERT INTO `tabla_contactos` VALUES ('7', 'Ignacio', '654561789', 'ignacio.jpg');
INSERT INTO `tabla_contactos` VALUES ('8', 'Andrea', '651231654', null);
INSERT INTO `tabla_contactos` VALUES ('9', 'Rafa', '616857129', 'raphael.jpg');
INSERT INTO `tabla_contactos` VALUES ('10', 'Rogelia', '617314050', null);

-- ----------------------------
-- Table structure for `tabla_estadisticas`
-- ----------------------------
DROP TABLE IF EXISTS `tabla_estadisticas`;
CREATE TABLE `tabla_estadisticas` (
  `idPuntuacion` int(11) NOT NULL AUTO_INCREMENT,
  `idContacto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPuntuacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of tabla_estadisticas
-- ----------------------------

-- ----------------------------
-- Table structure for `tabla_preguntas`
-- ----------------------------
DROP TABLE IF EXISTS `tabla_preguntas`;
CREATE TABLE `tabla_preguntas` (
  `idPregunta` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(255) NOT NULL,
  `idEmisor` int(11) NOT NULL,
  `idReceptor` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '0' COMMENT '0=no contestada, 1=contestada',
  `respuesta` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idPregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of tabla_preguntas
-- ----------------------------
INSERT INTO `tabla_preguntas` VALUES ('1', '¿De qué color tengo el pelo?', '4', '1', '1', 'Rojo');
INSERT INTO `tabla_preguntas` VALUES ('2', '¿Dónde vivo?', '6', '1', '0', null);
INSERT INTO `tabla_preguntas` VALUES ('3', '¿Cuál es mi edad?', '2', '1', '0', null);
INSERT INTO `tabla_preguntas` VALUES ('4', '¿En qué mes es mi cumpleaños?', '4', '1', '0', null);
INSERT INTO `tabla_preguntas` VALUES ('6', 'Fecha de nacimiento', '1', '10', '0', null);
INSERT INTO `tabla_preguntas` VALUES ('7', 'donde estoy', '1', '8', '0', null);
INSERT INTO `tabla_preguntas` VALUES ('8', '¿Quién soy?', '1', '1', '0', null);
INSERT INTO `tabla_preguntas` VALUES ('9', '¿Mi teléfono? ', '1', '10', '0', null);

-- ----------------------------
-- Table structure for `tabla_usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `tabla_usuarios`;
CREATE TABLE `tabla_usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of tabla_usuarios
-- ----------------------------
INSERT INTO `tabla_usuarios` VALUES ('1', 'prueba', '12345', null, null);
INSERT INTO `tabla_usuarios` VALUES ('2', 'burgundofora', '12345', null, null);
