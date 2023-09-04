-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_bancodigital
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_bancodigital
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_bancodigital` DEFAULT CHARACTER SET utf8 ;
USE `db_bancodigital` ;

-- -----------------------------------------------------
-- Table `db_bancodigital`.`Correntista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_bancodigital`.`Correntista` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `CPF` CHAR(13) NOT NULL,
  `senha` INT NOT NULL,
  `data_nasc` DATE NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_bancodigital`.`Conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_bancodigital`.`Conta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `saldo` INT NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `limite` VARCHAR(16) NOT NULL,
  `id_Correntista` INT NOT NULL,
  PRIMARY KEY (`id`, `id_Correntista`),
  INDEX `fk_Conta_Correntista1_idx` (`id_Correntista` ASC) VISIBLE,
  CONSTRAINT `fk_Conta_Correntista1`
    FOREIGN KEY (`id_Correntista`)
    REFERENCES `db_bancodigital`.`Correntista` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_bancodigital`.`Chave_Pix`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_bancodigital`.`Chave_Pix` (
  `id` INT NOT NULL,
  `Tipo` VARCHAR(45) NOT NULL,
  `Chave` VARCHAR(150) NOT NULL,
  `Conta_id` INT NOT NULL,
  PRIMARY KEY (`id`, `Conta_id`),
  INDEX `fk_Chave_Pix_Conta_idx` (`Conta_id` ASC) VISIBLE,
  CONSTRAINT `fk_Chave_Pix_Conta`
    FOREIGN KEY (`Conta_id`)
    REFERENCES `db_bancodigital`.`Conta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_bancodigital`.`Transacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_bancodigital`.`Transacao` (
  `id` INT NOT NULL,
  `valor` VARCHAR(45) NULL,
  `id_Conta` INT NOT NULL,
  `id_Correntista` INT NOT NULL,
  `id_ContaRecebeu` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Transacao_Conta1_idx` (`id_Conta` ASC, `id_Correntista` ASC) VISIBLE,
  CONSTRAINT `fk_Transacao_Conta1`
    FOREIGN KEY (`id_Conta` , `id_Correntista`)
    REFERENCES `db_bancodigital`.`Conta` (`id` , `id_Correntista`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
