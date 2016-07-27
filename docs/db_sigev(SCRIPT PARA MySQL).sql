-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
-- -----------------------------------------------------
-- Schema db_sigev
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `db_sigev` ;
-- -----------------------------------------------------
-- Schema db_sigev
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_sigev` DEFAULT CHARACTER SET utf8 ;
USE `db_sigev` ;
-- -----------------------------------------------------
-- Table `db_sigev`.`TiposDocumentos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_sigev`.`TiposDocumentos` ;
CREATE TABLE IF NOT EXISTS `db_sigev`.`TiposDocumentos` (
  `idTipoDocumento` INT NOT NULL AUTO_INCREMENT,
  `nombreDocumento` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTipoDocumento`))
ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `db_sigev`.`Usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_sigev`.`Usuarios` ;
CREATE TABLE IF NOT EXISTS `db_sigev`.`Usuarios` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `idTipoDocumento` INT NOT NULL,
  `documento` VARCHAR(15) NOT NULL,
  `nombres` VARCHAR(35) NOT NULL,
  `apellido1` VARCHAR(35) NOT NULL,
  `apellido2` VARCHAR(35) NULL,
  `correo` VARCHAR(45) NOT NULL,
  `constrasena` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  CONSTRAINT `fk_Usuarios_TiposDoc`
    FOREIGN KEY (`idTipoDocumento`)
    REFERENCES `db_sigev`.`TiposDocumentos` (`idTipoDocumento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
CREATE INDEX `fk_Usuarios_TiposDoc_idx` ON `db_sigev`.`Usuarios` (`idTipoDocumento` ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`Roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_sigev`.`Roles` ;
CREATE TABLE IF NOT EXISTS `db_sigev`.`Roles` (
  `idRol` INT NOT NULL AUTO_INCREMENT,
  `nombreRol` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`idRol`))
ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `db_sigev`.`Usuarios_Roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_sigev`.`Usuarios_Roles` ;
CREATE TABLE IF NOT EXISTS `db_sigev`.`Usuarios_Roles` (
  `idUsuario` INT NOT NULL,
  `idRol` INT NOT NULL,
  PRIMARY KEY (`idUsuario`, `idRol`),
  CONSTRAINT `fk_Usuarios_Roles_Usuarios`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `db_sigev`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuarios_Roles_Roles1`
    FOREIGN KEY (`idRol`)
    REFERENCES `db_sigev`.`Roles` (`idRol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
CREATE INDEX `fk_Usuarios_Roles_Usuarios_idx` ON `db_sigev`.`Usuarios_Roles` (`idUsuario` ASC);
CREATE INDEX `fk_Usuarios_Roles_Roles1_idx` ON `db_sigev`.`Usuarios_Roles` (`idRol` ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`Permisos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_sigev`.`Permisos` ;

CREATE TABLE IF NOT EXISTS `db_sigev`.`Permisos` (
  `idPermiso` INT NOT NULL AUTO_INCREMENT,
  `nombrePermiso` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPermiso`))
ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `db_sigev`.`Roles_Permisos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_sigev`.`Roles_Permisos` ;
CREATE TABLE IF NOT EXISTS `db_sigev`.`Roles_Permisos` (
  `idPermiso` INT NOT NULL,
  `idRol` INT NOT NULL,
  PRIMARY KEY (`idPermiso`, `idRol`),
  CONSTRAINT `fk_Roles_Permisos_Permisos1`
    FOREIGN KEY (`idPermiso`)
    REFERENCES `db_sigev`.`Permisos` (`idPermiso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Roles_Permisos_Roles1`
    FOREIGN KEY (`idRol`)
    REFERENCES `db_sigev`.`Roles` (`idRol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
CREATE INDEX `fk_Roles_Permisos_Permisos1_idx` ON `db_sigev`.`Roles_Permisos` (`idPermiso` ASC);
CREATE INDEX `fk_Roles_Permisos_Roles1_idx` ON `db_sigev`.`Roles_Permisos` (`idRol` ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`Cursos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_sigev`.`Cursos` ;
CREATE TABLE IF NOT EXISTS `db_sigev`.`Cursos` (
  `idCurso` INT NOT NULL AUTO_INCREMENT,
  `nombreCurso` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCurso`))
ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `db_sigev`.`EstadosExamenes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_sigev`.`EstadosExamenes` ;
CREATE TABLE IF NOT EXISTS `db_sigev`.`EstadosExamenes` (
  `idEstadosExamen` INT NOT NULL AUTO_INCREMENT,
  `nombreEstadoExamen` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`idEstadosExamen`))
ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `db_sigev`.`Examenes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_sigev`.`Examenes` ;
CREATE TABLE IF NOT EXISTS `db_sigev`.`Examenes` (
  `idExamen` INT NOT NULL AUTO_INCREMENT,
  `idCurso` INT NOT NULL,
  `idProfesor` INT NOT NULL,
  `fechaInicio` DATE NOT NULL,
  `horaInicio` DATE NOT NULL,
  `fechaFin` DATE NOT NULL,
  `horaFin` DATE NOT NULL,
  `idEstadoExamen` INT NOT NULL,
  PRIMARY KEY (`idExamen`),
  CONSTRAINT `fk_Examenes_Cursos1`
    FOREIGN KEY (`idCurso`)
    REFERENCES `db_sigev`.`Cursos` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Examenes_EstadosExamenes1`
    FOREIGN KEY (`idEstadoExamen`)
    REFERENCES `db_sigev`.`EstadosExamenes` (`idEstadosExamen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Examenes_Cursos`
    FOREIGN KEY (`idProfesor`)
    REFERENCES `db_sigev`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
CREATE INDEX `fk_Examenes_Cursos1_idx` ON `db_sigev`.`Examenes` (`idCurso` ASC);
CREATE INDEX `fk_Examenes_EstadosExamenes1_idx` ON `db_sigev`.`Examenes` (`idEstadoExamen` ASC);
CREATE INDEX `fk_Examenes_Cursos_idx` ON `db_sigev`.`Examenes` (`idProfesor` ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`Preguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_sigev`.`Preguntas` ;
CREATE TABLE IF NOT EXISTS `db_sigev`.`Preguntas` (
  `idPregunta` INT NOT NULL AUTO_INCREMENT,
  `enunciado` TEXT(250) NOT NULL,
  `valorPregunta` INT NOT NULL,
  `idCurso` INT NOT NULL,
  PRIMARY KEY (`idPregunta`),
  CONSTRAINT `preguntas_cursos`
    FOREIGN KEY (`idCurso`)
    REFERENCES `db_sigev`.`Cursos` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
CREATE INDEX `preguntas_cursos_idx` ON `db_sigev`.`Preguntas` (`idCurso` ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`Respuestas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_sigev`.`Respuestas` ;
CREATE TABLE IF NOT EXISTS `db_sigev`.`Respuestas` (
  `idRespuesta` INT NOT NULL AUTO_INCREMENT,
  `idPregunta` INT NOT NULL,
  `respuesta` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idRespuesta`),
  CONSTRAINT `fk_Respuestas_Preguntas1`
    FOREIGN KEY (`idPregunta`)
    REFERENCES `db_sigev`.`Preguntas` (`idPregunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
CREATE INDEX `fk_Respuestas_Preguntas1_idx` ON `db_sigev`.`Respuestas` (`idPregunta` ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`ExamenesPreguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_sigev`.`ExamenesPreguntas` ;
CREATE TABLE IF NOT EXISTS `db_sigev`.`ExamenesPreguntas` (
  `idExamen` INT NOT NULL,
  `idPregunta` INT NOT NULL,
  PRIMARY KEY (`idExamen`, `idPregunta`),
  CONSTRAINT `fk_ExamenesPreguntas_Examenes1`
    FOREIGN KEY (`idExamen`)
    REFERENCES `db_sigev`.`Examenes` (`idExamen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ExamenesPreguntas_Preguntas1`
    FOREIGN KEY (`idPregunta`)
    REFERENCES `db_sigev`.`Preguntas` (`idPregunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
CREATE INDEX `fk_ExamenesPreguntas_Examenes1_idx` ON `db_sigev`.`ExamenesPreguntas` (`idExamen` ASC);
CREATE INDEX `fk_ExamenesPreguntas_Preguntas1_idx` ON `db_sigev`.`ExamenesPreguntas` (`idPregunta` ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`ResultadosExamenes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_sigev`.`ResultadosExamenes` ;
CREATE TABLE IF NOT EXISTS `db_sigev`.`ResultadosExamenes` (
  `idResultadosExamenes` INT NOT NULL AUTO_INCREMENT,
  `idEstudiante` INT NOT NULL,
  `idExamen` INT NOT NULL,
  `nota` INT NOT NULL,
  PRIMARY KEY (`idResultadosExamenes`),
  CONSTRAINT `fk_Resultados_Usuarios`
    FOREIGN KEY (`idEstudiante`)
    REFERENCES `db_sigev`.`Usuarios` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Resultados_Examenes`
    FOREIGN KEY (`idExamen`)
    REFERENCES `db_sigev`.`Examenes` (`idExamen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
CREATE INDEX `fk_Resultados_Usuarios_idx` ON `db_sigev`.`ResultadosExamenes` (`idEstudiante` ASC);
CREATE INDEX `fk_Resultados_Examenes_idx` ON `db_sigev`.`ResultadosExamenes` (`idExamen` ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`ResultadosPreguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_sigev`.`ResultadosPreguntas` ;
CREATE TABLE IF NOT EXISTS `db_sigev`.`ResultadosPreguntas` (
  `idResultadosPreguntas` INT NOT NULL AUTO_INCREMENT,
  `idResultadosExamenes` INT NOT NULL,
  `idRespuesta` INT NULL,
  `idPregunta` INT NOT NULL,
  PRIMARY KEY (`idResultadosPreguntas`),
  CONSTRAINT `fk_RP_RE`
    FOREIGN KEY (`idResultadosExamenes`)
    REFERENCES `db_sigev`.`ResultadosExamenes` (`idResultadosExamenes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Resul_Resp`
    FOREIGN KEY (`idRespuesta`)
    REFERENCES `db_sigev`.`Respuestas` (`idRespuesta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Resul_Pregun`
    FOREIGN KEY (`idPregunta`)
    REFERENCES `db_sigev`.`Preguntas` (`idPregunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
CREATE INDEX `fk_RP_RE_idx` ON `db_sigev`.`ResultadosPreguntas` (`idResultadosExamenes` ASC);
CREATE INDEX `fk_Resul_Resp_idx` ON `db_sigev`.`ResultadosPreguntas` (`idRespuesta` ASC);
CREATE INDEX `fk_Resul_Pregun_idx` ON `db_sigev`.`ResultadosPreguntas` (`idPregunta` ASC);
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;