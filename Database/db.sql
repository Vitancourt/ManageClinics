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
