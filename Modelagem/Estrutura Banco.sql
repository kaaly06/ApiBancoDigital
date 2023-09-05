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
-- Table `db_bancodigital`.`correntista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_bancodigital`.`correntista` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `CPF` CHAR(11) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `data_nasc` DATE NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `CPF_UNIQUE` (`CPF` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `db_bancodigital`.`conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_bancodigital`.`conta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `saldo` DOUBLE NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `limite` DOUBLE NOT NULL,
  `id_Correntista` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Conta_Correntista1_idx` (`id_Correntista` ASC) VISIBLE,
  CONSTRAINT `fk_Conta_Correntista`
    FOREIGN KEY (`id_Correntista`)
    REFERENCES `db_bancodigital`.`correntista` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `db_bancodigital`.`chave_pix`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_bancodigital`.`chave_pix` (
  `id` INT NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `chave` VARCHAR(150) NOT NULL,
  `id_Conta` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Chave_Pix_Conta_idx` (`id_Conta` ASC) VISIBLE,
  CONSTRAINT `fk_Chave_Pix_Conta`
    FOREIGN KEY (`id_Conta`)
    REFERENCES `db_bancodigital`.`conta` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `db_bancodigital`.`transacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_bancodigital`.`transacao` (
  `id` INT NOT NULL,
  `valor` DOUBLE NOT NULL,
  `data_hora` DATETIME NOT NULL,
  `id_Conta_Enviou` INT NOT NULL,
  `id_Conta_Recebeu` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Transacao_Conta1_idx` (`id_Conta_Recebeu` ASC) VISIBLE,
  INDEX `fk_id_conta_enviou_idx` (`id_Conta_Enviou` ASC) VISIBLE,
  CONSTRAINT `fk_id_conta_recebeu`
    FOREIGN KEY (`id_Conta_Recebeu`)
    REFERENCES `db_bancodigital`.`conta` (`id`),
  CONSTRAINT `fk_id_conta_enviou`
    FOREIGN KEY (`id_Conta_Enviou`)
    REFERENCES `db_bancodigital`.`conta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
