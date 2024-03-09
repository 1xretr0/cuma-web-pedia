/*
 Navicat Premium Data Transfer

 Source Server         : api-pruebas
 Source Server Type    : MySQL
 Source Server Version : 80026 (8.0.26)
 Source Host           : localhost:3306
 Source Schema         : test_sebas

 Target Server Type    : MySQL
 Target Server Version : 80026 (8.0.26)
 File Encoding         : 65001

 Date: 09/03/2024 10:09:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cm_anotaciones
-- ----------------------------
DROP TABLE IF EXISTS `cm_anotaciones`;
CREATE TABLE `cm_anotaciones`  (
  `id_anotacion` int NOT NULL COMMENT 'Identificador del registro de la anotacion',
  `id_recurso` int NOT NULL COMMENT 'Identificador del recurso al que pertenece la anotacion',
  `titulo_anotacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Titulo descriptivo de la anotacion',
  `id_usuario_autor` int NOT NULL COMMENT 'Identificador del usuario autor de la anotacion',
  `contenido_anotacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Contenido textual de la anotacion',
  `publicada` bit(1) NOT NULL DEFAULT b'0' COMMENT 'Bandera que indica si la anotación está publicada o no',
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creacion de la anotacion',
  `fecha_ultima_modificacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de ultima modificacion de la anotacion',
  PRIMARY KEY (`id_anotacion`) USING BTREE,
  INDEX `fk_anotaciones_recursos_id`(`id_recurso` ASC) USING BTREE,
  INDEX `fk_anotaciones_usuarios_id`(`id_usuario_autor` ASC) USING BTREE,
  CONSTRAINT `fk_anotaciones_recursos_id` FOREIGN KEY (`id_recurso`) REFERENCES `cm_recursos` (`id_recurso`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_anotaciones_usuarios_id` FOREIGN KEY (`id_usuario_autor`) REFERENCES `cm_usuarios` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = 'Anotaciones (comentarios) de los recursos creadas por usuarios del sistema' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cm_areas_geograficas_ctl
-- ----------------------------
DROP TABLE IF EXISTS `cm_areas_geograficas_ctl`;
CREATE TABLE `cm_areas_geograficas_ctl`  (
  `id_area` int NOT NULL AUTO_INCREMENT COMMENT 'Identificador incrementable del area geografica',
  `nombre_area` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre descriptivo del area geografica',
  PRIMARY KEY (`id_area`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = 'Catalogo de áreas geográficas que se emplean para etiquetar los recursos y uams del sistema.' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cm_estados_migratorios_ctl
-- ----------------------------
DROP TABLE IF EXISTS `cm_estados_migratorios_ctl`;
CREATE TABLE `cm_estados_migratorios_ctl`  (
  `id_estado` int NOT NULL AUTO_INCREMENT COMMENT 'Identificador del tipo de estado migratorio',
  `nombre_estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre descriptivo del tipo de estado migratorio',
  `clave_estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Clave abreviada del tipo de estado migratorio',
  PRIMARY KEY (`id_estado`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = 'Catalogo de los estados migratorios definidos para etiquetar las uams del sistema' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cm_fundamentos_sanitarios
-- ----------------------------
DROP TABLE IF EXISTS `cm_fundamentos_sanitarios`;
CREATE TABLE `cm_fundamentos_sanitarios`  (
  `id_fundamento` int NOT NULL COMMENT 'Identificador incrementable del registro del fundamento',
  `nombre_fundamento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre descriptivo del fundamento sanitario',
  `descripción_fundamento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Descripción breve del fundamento sanitario',
  PRIMARY KEY (`id_fundamento`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = 'Fundamentos sanitarios/medicos que representan conceptos o significados del área médica' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cm_grupos_culturales
-- ----------------------------
DROP TABLE IF EXISTS `cm_grupos_culturales`;
CREATE TABLE `cm_grupos_culturales`  (
  `id_grupo` int NOT NULL AUTO_INCREMENT COMMENT 'Identificador del grupo cultural',
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre descriptivo del grupo cultural',
  PRIMARY KEY (`id_grupo`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = 'Catálogo de grupos culturales para etiquetar recursos, hechos culturales y uams del sistema' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cm_hechos_culturales
-- ----------------------------
DROP TABLE IF EXISTS `cm_hechos_culturales`;
CREATE TABLE `cm_hechos_culturales`  (
  `id_hecho` int NOT NULL COMMENT 'Identificador incrementable del registro del hecho cultural',
  `nombre_hecho` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre descriptivo del hecho cultural',
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Descripcion breve del hecho cultural',
  `id_grupo` int NULL DEFAULT NULL COMMENT 'Identificador del grupo cultural al que pertenece el hecho',
  `id_area` int NULL DEFAULT NULL COMMENT 'Identificador del area geografica a la cual pertenece el hecho',
  PRIMARY KEY (`id_hecho`) USING BTREE,
  INDEX `fk_hechos_grupos_id`(`id_grupo` ASC) USING BTREE,
  INDEX `fk_hechos_areas_id`(`id_area` ASC) USING BTREE,
  CONSTRAINT `fk_hechos_areas_id` FOREIGN KEY (`id_area`) REFERENCES `cm_areas_geograficas_ctl` (`id_area`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_hechos_grupos_id` FOREIGN KEY (`id_grupo`) REFERENCES `cm_grupos_culturales` (`id_grupo`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = 'Catálogo de los fundamentos/hechos culturales' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cm_recurso_fundamentos
-- ----------------------------
DROP TABLE IF EXISTS `cm_recurso_fundamentos`;
CREATE TABLE `cm_recurso_fundamentos`  (
  `id_recurso` int NOT NULL COMMENT 'Identificador del recurso',
  `id_fundamento` int NOT NULL COMMENT 'Identificador del fundamento sanitario',
  PRIMARY KEY (`id_recurso`, `id_fundamento`) USING BTREE,
  INDEX `fk_recurso_fundamentos_fundamento_id`(`id_fundamento` ASC) USING BTREE,
  CONSTRAINT `fk_recurso_fundamentos_fundamento_id` FOREIGN KEY (`id_fundamento`) REFERENCES `cm_fundamentos_sanitarios` (`id_fundamento`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_recurso_fundamentos_recurso_id` FOREIGN KEY (`id_recurso`) REFERENCES `cm_recursos` (`id_recurso`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = 'Union de la relación entre un recurso y uno o mas fundamentos sanitarios a los que refiere.' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cm_recurso_hechos
-- ----------------------------
DROP TABLE IF EXISTS `cm_recurso_hechos`;
CREATE TABLE `cm_recurso_hechos`  (
  `id_recurso` int NOT NULL COMMENT 'Identificador del recurso',
  `id_hecho` int NOT NULL COMMENT 'Identificador del hecho cultural',
  PRIMARY KEY (`id_recurso`, `id_hecho`) USING BTREE,
  INDEX `fk_recurso_hechos_hecho_id`(`id_hecho` ASC) USING BTREE,
  CONSTRAINT `fk_recurso_hechos_hecho_id` FOREIGN KEY (`id_hecho`) REFERENCES `cm_hechos_culturales` (`id_hecho`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_recurso_hechos_recurso_id` FOREIGN KEY (`id_recurso`) REFERENCES `cm_recursos` (`id_recurso`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = 'Unión de la relación entre un recurso y uno o más hechos culturales a los que este refiera.' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cm_recursos
-- ----------------------------
DROP TABLE IF EXISTS `cm_recursos`;
CREATE TABLE `cm_recursos`  (
  `id_recurso` int NOT NULL AUTO_INCREMENT COMMENT 'Identificador incrementable del recurso',
  `titulo_recurso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Titulo descriptivo del recurso',
  `descripcion_recurso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL COMMENT 'Descripcion breve del recurso',
  `contenido_recurso` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL COMMENT 'Contenido del recurso de tipo texto',
  `url_recurso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL COMMENT 'Url del recurso',
  `id_tipo_recurso` int NOT NULL COMMENT 'Identificador del tipo de recurso',
  `idioma` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Identificador del idioma del recurso',
  `fecha_recurso` timestamp NOT NULL COMMENT 'Fecha de la que data el recurso',
  `fecha_publicacion` timestamp NOT NULL COMMENT 'Fecha en la que se publico el recurso dentro del sistema',
  PRIMARY KEY (`id_recurso`) USING BTREE,
  INDEX `fk_recursos_tipos_recurso_id`(`id_tipo_recurso` ASC) USING BTREE,
  INDEX `fk_recursos_idiomas_id`(`idioma` ASC) USING BTREE,
  CONSTRAINT `fk_recursos_tipos_recurso_id` FOREIGN KEY (`id_tipo_recurso`) REFERENCES `cm_tipos_recurso_ctl` (`id_tipo`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = 'Recursos literarios, digitales, entre otros, (páginas web, libros, artículos, ensayos, anécdotas, escritos, reportes)  que forman parte del sistema y pueden estar etiquetados por grupo cultural, época, área geográfica, idioma. También pueden relacionarse con uno o más hechos culturales y/o sanitarios.' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cm_tipos_recurso_ctl
-- ----------------------------
DROP TABLE IF EXISTS `cm_tipos_recurso_ctl`;
CREATE TABLE `cm_tipos_recurso_ctl`  (
  `id_tipo` int NOT NULL AUTO_INCREMENT COMMENT 'Identificador incrementable del tipo de recurso',
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre descriptivo del tipo de recurso',
  PRIMARY KEY (`id_tipo`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = 'Catalogo de los tipos de recurso existentes en el sistema' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cm_uams
-- ----------------------------
DROP TABLE IF EXISTS `cm_uams`;
CREATE TABLE `cm_uams`  (
  `id_uam` int NOT NULL COMMENT 'Identificador incrementable del registro de la unidad médica antropológica',
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre descriptivo de la uam',
  `descripción` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Descripción breve de la uam',
  `id_fundamento` int NOT NULL COMMENT 'Identificador del fundamento sanitario con el cual se relaciona esta uam',
  `id_hecho` int NOT NULL COMMENT 'Identificador del hecho cultural al cual se relaciona esta uam',
  `id_estado` int NULL DEFAULT NULL COMMENT 'Identificador el estado migratorio al cual refiere esta uam',
  PRIMARY KEY (`id_uam`) USING BTREE,
  INDEX `fk_uam_fundamentos`(`id_fundamento` ASC) USING BTREE,
  INDEX `fk_uam_hechos`(`id_hecho` ASC) USING BTREE,
  INDEX `fk_uam_estados`(`id_estado` ASC) USING BTREE,
  CONSTRAINT `fk_uam_estados` FOREIGN KEY (`id_estado`) REFERENCES `cm_estados_migratorios_ctl` (`id_estado`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_uam_fundamentos` FOREIGN KEY (`id_fundamento`) REFERENCES `cm_fundamentos_sanitarios` (`id_fundamento`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_uam_hechos` FOREIGN KEY (`id_hecho`) REFERENCES `cm_hechos_culturales` (`id_hecho`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = 'Unidades médicas antropológicas. Cada registro representa la unión entre un fundamento sanitario y un hecho cultural. Puede estar etiquetado por estado migratorio.' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cm_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `cm_usuarios`;
CREATE TABLE `cm_usuarios`  (
  `id_usuario` int NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro del usuario',
  `nombres_personales_usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nombre o nombres personales del usuario',
  `apellidos_personales_usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Apellidos personales del usuario',
  `correo_usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Correo electronico del usuario',
  `contrasena_usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Hash md5 de la contrasena del usuario',
  `administrador` bit(1) NOT NULL DEFAULT b'0' COMMENT 'Bandera que indica si el usuario es administrador o no',
  PRIMARY KEY (`id_usuario`) USING BTREE,
  UNIQUE INDEX `idx_correo`(`correo_usuario` ASC) USING BTREE COMMENT 'Indice unico del correo de usuario para mantener correo unico por usuario'
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = 'Usuarios registrados con una cuenta personal en la página del sistema.' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
