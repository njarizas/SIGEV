-- MySQL Workbench Forward Engineering

/* SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0; */
/* SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0; */
/* SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES'; */
-- -----------------------------------------------------
-- Schema db_sigev
-- -----------------------------------------------------
--DROP SCHEMA IF EXISTS db_sigev ;
-- -----------------------------------------------------
-- Schema db_sigev
-- -----------------------------------------------------
--CREATE SCHEMA IF NOT EXISTS db_sigev DEFAULT CHARACTER SET utf8 ;
--USE db_sigev ;
-- -----------------------------------------------------
-- Table `db_sigev`.`TiposDocumentos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS TiposDocumentos ;
CREATE SEQUENCE TiposDocumentos_seq;

CREATE TABLE IF NOT EXISTS TiposDocumentos (
  idTipoDocumento INT NOT NULL DEFAULT NEXTVAL ('TiposDocumentos_seq'),
  nombreDocumento VARCHAR(45) NOT NULL,
  PRIMARY KEY (idTipoDocumento))
 ;
 -- -----------------------------------------------------
-- Table `db_sigev`.`Usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS Usuarios ;
CREATE SEQUENCE Usuarios_seq;

CREATE TABLE IF NOT EXISTS Usuarios (
  idUsuario INT NOT NULL DEFAULT NEXTVAL ('Usuarios_seq'),
  idTipoDocumento INT NOT NULL,
  documento VARCHAR(15) NOT NULL,
  nombres VARCHAR(35) NOT NULL,
  apellido1 VARCHAR(35) NOT NULL,
  apellido2 VARCHAR(35) NULL,
  correo VARCHAR(45) NOT NULL,
  constrasena VARCHAR(32) NOT NULL,
  PRIMARY KEY (idUsuario),
  CONSTRAINT fk_Usuarios_TiposDoc
    FOREIGN KEY (idTipoDocumento)
    REFERENCES TiposDocumentos (idTipoDocumento)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;
CREATE INDEX fk_Usuarios_TiposDoc_idx ON Usuarios (idTipoDocumento ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`Roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS Roles ;
CREATE SEQUENCE Roles_seq;

CREATE TABLE IF NOT EXISTS Roles (
  idRol INT NOT NULL DEFAULT NEXTVAL ('Roles_seq'),
  nombreRol VARCHAR(20) NOT NULL,
  PRIMARY KEY (idRol))
 ;
 -- -----------------------------------------------------
-- Table `db_sigev`.`Usuarios_Roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS Usuarios_Roles ;
CREATE TABLE IF NOT EXISTS Usuarios_Roles (
  idUsuario INT NOT NULL,
  idRol INT NOT NULL,
  PRIMARY KEY (idUsuario, idRol),
  CONSTRAINT fk_Usuarios_Roles_Usuarios
    FOREIGN KEY (idUsuario)
    REFERENCES Usuarios (idUsuario)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Usuarios_Roles_Roles1
    FOREIGN KEY (idRol)
    REFERENCES Roles (idRol)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;
CREATE INDEX fk_Usuarios_Roles_Usuarios_idx ON Usuarios_Roles (idUsuario ASC);
CREATE INDEX fk_Usuarios_Roles_Roles1_idx ON Usuarios_Roles (idRol ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`Permisos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS Permisos ;

CREATE SEQUENCE Permisos_seq;

CREATE TABLE IF NOT EXISTS Permisos (
  idPermiso INT NOT NULL DEFAULT NEXTVAL ('Permisos_seq'),
  nombrePermiso VARCHAR(45) NOT NULL,
  PRIMARY KEY (idPermiso))
;
-- -----------------------------------------------------
-- Table `db_sigev`.`Roles_Permisos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS Roles_Permisos ;
CREATE TABLE IF NOT EXISTS Roles_Permisos (
  idPermiso INT NOT NULL,
  idRol INT NOT NULL,
  PRIMARY KEY (idPermiso, idRol),
  CONSTRAINT fk_Roles_Permisos_Permisos1
    FOREIGN KEY (idPermiso)
    REFERENCES Permisos (idPermiso)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Roles_Permisos_Roles1
    FOREIGN KEY (idRol)
    REFERENCES Roles (idRol)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;
CREATE INDEX fk_Roles_Permisos_Permisos1_idx ON Roles_Permisos (idPermiso ASC);
CREATE INDEX fk_Roles_Permisos_Roles1_idx ON Roles_Permisos (idRol ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`Cursos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS Cursos ;
CREATE SEQUENCE Cursos_seq;

CREATE TABLE IF NOT EXISTS Cursos (
  idCurso INT NOT NULL DEFAULT NEXTVAL ('Cursos_seq'),
  nombreCurso VARCHAR(45) NOT NULL,
  PRIMARY KEY (idCurso))
;
-- -----------------------------------------------------
-- Table `db_sigev`.`EstadosExamenes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS EstadosExamenes ;
CREATE SEQUENCE EstadosExamenes_seq;

CREATE TABLE IF NOT EXISTS EstadosExamenes (
  idEstadosExamen INT NOT NULL DEFAULT NEXTVAL ('EstadosExamenes_seq'),
  nombreEstadoExamen VARCHAR(25) NOT NULL,
  PRIMARY KEY (idEstadosExamen))
 ;
 -- -----------------------------------------------------
-- Table `db_sigev`.`Examenes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS Examenes ;
CREATE SEQUENCE Examenes_seq;

CREATE TABLE IF NOT EXISTS Examenes (
  idExamen INT NOT NULL DEFAULT NEXTVAL ('Examenes_seq'),
  idCurso INT NOT NULL,
  idProfesor INT NOT NULL,
  fechaInicio DATE NOT NULL,
  horaInicio DATE NOT NULL,
  fechaFin DATE NOT NULL,
  horaFin DATE NOT NULL,
  idEstadoExamen INT NOT NULL,
  PRIMARY KEY (idExamen),
  CONSTRAINT fk_Examenes_Cursos1
    FOREIGN KEY (idCurso)
    REFERENCES Cursos (idCurso)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Examenes_EstadosExamenes1
    FOREIGN KEY (idEstadoExamen)
    REFERENCES EstadosExamenes (idEstadosExamen)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Examenes_Cursos
    FOREIGN KEY (idProfesor)
    REFERENCES Usuarios (idUsuario)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;
CREATE INDEX fk_Examenes_Cursos1_idx ON Examenes (idCurso ASC);
CREATE INDEX fk_Examenes_EstadosExamenes1_idx ON Examenes (idEstadoExamen ASC);
CREATE INDEX fk_Examenes_Cursos_idx ON Examenes (idProfesor ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`Preguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS Preguntas ;
CREATE SEQUENCE Preguntas_seq;

CREATE TABLE IF NOT EXISTS Preguntas (
  idPregunta INT NOT NULL DEFAULT NEXTVAL ('Preguntas_seq'),
  enunciado TEXT NOT NULL,
  valorPregunta INT NOT NULL,
  idCurso INT NOT NULL,
  PRIMARY KEY (idPregunta),
  CONSTRAINT preguntas_cursos
    FOREIGN KEY (idCurso)
    REFERENCES Cursos (idCurso)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;
CREATE INDEX preguntas_cursos_idx ON Preguntas (idCurso ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`Respuestas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS Respuestas ;
CREATE SEQUENCE Respuestas_seq;

CREATE TABLE IF NOT EXISTS Respuestas (
  idRespuesta INT NOT NULL DEFAULT NEXTVAL ('Respuestas_seq'),
  idPregunta INT NOT NULL,
  respuesta VARCHAR(100) NOT NULL,
  PRIMARY KEY (idRespuesta),
  CONSTRAINT fk_Respuestas_Preguntas1
    FOREIGN KEY (idPregunta)
    REFERENCES Preguntas (idPregunta)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;
CREATE INDEX fk_Respuestas_Preguntas1_idx ON Respuestas (idPregunta ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`ExamenesPreguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS ExamenesPreguntas ;
CREATE TABLE IF NOT EXISTS ExamenesPreguntas (
  idExamen INT NOT NULL,
  idPregunta INT NOT NULL,
  PRIMARY KEY (idExamen, idPregunta),
  CONSTRAINT fk_ExamenesPreguntas_Examenes1
    FOREIGN KEY (idExamen)
    REFERENCES Examenes (idExamen)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_ExamenesPreguntas_Preguntas1
    FOREIGN KEY (idPregunta)
    REFERENCES Preguntas (idPregunta)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;
CREATE INDEX fk_ExamenesPreguntas_Examenes1_idx ON ExamenesPreguntas (idExamen ASC);
CREATE INDEX fk_ExamenesPreguntas_Preguntas1_idx ON ExamenesPreguntas (idPregunta ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`ResultadosExamenes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS ResultadosExamenes ;
CREATE SEQUENCE ResultadosExamenes_seq;

CREATE TABLE IF NOT EXISTS ResultadosExamenes (
  idResultadosExamenes INT NOT NULL DEFAULT NEXTVAL ('ResultadosExamenes_seq'),
  idEstudiante INT NOT NULL,
  idExamen INT NOT NULL,
  nota INT NOT NULL,
  PRIMARY KEY (idResultadosExamenes),
  CONSTRAINT fk_Resultados_Usuarios
    FOREIGN KEY (idEstudiante)
    REFERENCES Usuarios (idUsuario)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Resultados_Examenes
    FOREIGN KEY (idExamen)
    REFERENCES Examenes (idExamen)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;
CREATE INDEX fk_Resultados_Usuarios_idx ON ResultadosExamenes (idEstudiante ASC);
CREATE INDEX fk_Resultados_Examenes_idx ON ResultadosExamenes (idExamen ASC);
-- -----------------------------------------------------
-- Table `db_sigev`.`ResultadosPreguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS ResultadosPreguntas ;
CREATE SEQUENCE ResultadosPreguntas_seq;

CREATE TABLE IF NOT EXISTS ResultadosPreguntas (
  idResultadosPreguntas INT NOT NULL DEFAULT NEXTVAL ('ResultadosPreguntas_seq'),
  idResultadosExamenes INT NOT NULL,
  idRespuesta INT NULL,
  idPregunta INT NOT NULL,
  PRIMARY KEY (idResultadosPreguntas),
  CONSTRAINT fk_RP_RE
    FOREIGN KEY (idResultadosExamenes)
    REFERENCES ResultadosExamenes (idResultadosExamenes)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Resul_Resp
    FOREIGN KEY (idRespuesta)
    REFERENCES Respuestas (idRespuesta)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Resul_Pregun
    FOREIGN KEY (idPregunta)
    REFERENCES Preguntas (idPregunta)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;
CREATE INDEX fk_RP_RE_idx ON ResultadosPreguntas (idResultadosExamenes ASC);
CREATE INDEX fk_Resul_Resp_idx ON ResultadosPreguntas (idRespuesta ASC);
CREATE INDEX fk_Resul_Pregun_idx ON ResultadosPreguntas (idPregunta ASC);
/* SET SQL_MODE=@OLD_SQL_MODE; */
/* SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS; */
/* SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS; */