-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema manageclinic
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema manageclinic
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `manageclinic` DEFAULT CHARACTER SET utf8 ;
USE `manageclinic` ;

-- -----------------------------------------------------
-- Table `manageclinic`.`tbUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `manageclinic`.`tbUsuario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `cargo` VARCHAR(50) NOT NULL,
  `usuario` VARCHAR(50) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  `ativo` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `manageclinic`.`tbPaciente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `manageclinic`.`tbPaciente` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `CPF` VARCHAR(13) NULL,
  `dataNasc` DATE NULL,
  `inicioTrat` DATE NULL,
  `telCelular` VARCHAR(45) NULL,
  `telResidencial` VARCHAR(45) NULL,
  `telComercial` VARCHAR(45) NULL,
  `ativo` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `manageclinic`.`tbAgenda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `manageclinic`.`tbAgenda` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `data` DATE NOT NULL,
  `horario` TIME NOT NULL,
  `tbUsuario_id` INT UNSIGNED NOT NULL,
  `tbPaciente_id` INT UNSIGNED NOT NULL,
  `valor` DECIMAL NULL,
  `baixa` INT NOT NULL,
  `ativo` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tbAgenda_tbUsuario_idx` (`tbUsuario_id` ASC),
  INDEX `fk_tbAgenda_tbPaciente1_idx` (`tbPaciente_id` ASC),
  CONSTRAINT `fk_tbAgenda_tbUsuario`
    FOREIGN KEY (`tbUsuario_id`)
    REFERENCES `manageclinic`.`tbUsuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tbAgenda_tbPaciente1`
    FOREIGN KEY (`tbPaciente_id`)
    REFERENCES `manageclinic`.`tbPaciente` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `manageclinic`.`tbContas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `manageclinic`.`tbContas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(150) NOT NULL,
  `data` DATE NULL,
  `valor` DECIMAL(10,2)  NULL,
  `dataefetiva` DATE NULL,
  `baixa` INT NOT NULL,
  `tipo` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
