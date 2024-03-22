-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema fjell
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema fjell
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `fjell` DEFAULT CHARACTER SET utf8 ;
USE `fjell` ;

-- -----------------------------------------------------
-- Table `fjell`.`bruker`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fjell`.`bruker` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `brukernavn` VARCHAR(45) NOT NULL,
  `passord` LONGTEXT NOT NULL,
  `epost` VARCHAR(45) NOT NULL,
  `admin` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fjell`.`problem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fjell`.`problem` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tittel` VARCHAR(45) NOT NULL,
  `problem` LONGTEXT NOT NULL,
  `status` VARCHAR(45) NOT NULL DEFAULT 0,
  `losning` VARCHAR(220) NULL,
  `tid` TIMESTAMP NOT NULL,
  `bruker_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_problem_bruker_idx` (`bruker_id` ASC),
  CONSTRAINT `fk_problem_bruker`
    FOREIGN KEY (`bruker_id`)
    REFERENCES `fjell`.`bruker` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
