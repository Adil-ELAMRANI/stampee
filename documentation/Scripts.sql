-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema stampee
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema stampee
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `stampee` DEFAULT CHARACTER SET utf8mb4 ;
USE `stampee` ;

-- -----------------------------------------------------
-- Table `stampee`.`certification`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stampee`.`certification` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `statut_certification` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `stampee`.`pays`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stampee`.`pays` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom_pays` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `stampee`.`etat_timbre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stampee`.`etat_timbre` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `etat` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `stampee`.`privilege`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stampee`.`privilege` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `privilege` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `stampee`.`utilisateur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stampee`.`utilisateur` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `mot_de_passe` VARCHAR(255) NULL DEFAULT NULL,
  `nom_utilisateur` VARCHAR(45) NOT NULL,
  `adresse` VARCHAR(100) NULL DEFAULT NULL,
  `privilege_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email` (`email` ASC) VISIBLE,
  INDEX `privilege_id` (`privilege_id` ASC) VISIBLE,
  CONSTRAINT `utilisateur_ibfk_1`
    FOREIGN KEY (`privilege_id`)
    REFERENCES `stampee`.`privilege` (`id`)
    ON DELETE SET NULL)
ENGINE = InnoDB
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `stampee`.`timbre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stampee`.`timbre` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(255) NULL DEFAULT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `annee` VARCHAR(45) NULL DEFAULT NULL,
  `pays_id` INT(11) NULL DEFAULT NULL,
  `certification_id` INT(11) NULL DEFAULT NULL,
  `etat_timbre_id` INT(11) NULL DEFAULT NULL,
  `utilisateur_id` INT(11) NULL DEFAULT NULL,
  `image` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `pays_id` (`pays_id` ASC) VISIBLE,
  INDEX `certification_id` (`certification_id` ASC) VISIBLE,
  INDEX `etat_timbre_id` (`etat_timbre_id` ASC) VISIBLE,
  INDEX `utilisateur_id` (`utilisateur_id` ASC) VISIBLE,
  CONSTRAINT `timbre_ibfk_1`
    FOREIGN KEY (`pays_id`)
    REFERENCES `stampee`.`pays` (`id`),
  CONSTRAINT `timbre_ibfk_2`
    FOREIGN KEY (`certification_id`)
    REFERENCES `stampee`.`certification` (`id`),
  CONSTRAINT `timbre_ibfk_3`
    FOREIGN KEY (`etat_timbre_id`)
    REFERENCES `stampee`.`etat_timbre` (`id`),
  CONSTRAINT `timbre_ibfk_4`
    FOREIGN KEY (`utilisateur_id`)
    REFERENCES `stampee`.`utilisateur` (`id`)
    ON DELETE SET NULL)
ENGINE = InnoDB
AUTO_INCREMENT = 25
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `stampee`.`enchere`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stampee`.`enchere` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `coup_de_coeur` TINYINT(4) NULL DEFAULT 0,
  `date_debut` DATETIME NOT NULL,
  `prix_minimale` DOUBLE NULL DEFAULT 0,
  `timbre_id` INT(11) NOT NULL,
  `date_fin` VARCHAR(45) NOT NULL,
  `statut_enchere` TINYINT(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `timbre_id` (`timbre_id` ASC) VISIBLE,
  CONSTRAINT `enchere_ibfk_1`
    FOREIGN KEY (`timbre_id`)
    REFERENCES `stampee`.`timbre` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `stampee`.`favoris`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stampee`.`favoris` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` INT(11) NOT NULL,
  `enchere_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `utilisateur_id`, `enchere_id`),
  INDEX `utilisateur_id` (`utilisateur_id` ASC) VISIBLE,
  INDEX `enchere_id` (`enchere_id` ASC) VISIBLE,
  CONSTRAINT `favoris_ibfk_1`
    FOREIGN KEY (`utilisateur_id`)
    REFERENCES `stampee`.`utilisateur` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `favoris_ibfk_2`
    FOREIGN KEY (`enchere_id`)
    REFERENCES `stampee`.`enchere` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `stampee`.`image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stampee`.`image` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `image_principale` VARCHAR(45) NOT NULL,
  `timbre_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `timbre_id` (`timbre_id` ASC) VISIBLE,
  CONSTRAINT `image_ibfk_1`
    FOREIGN KEY (`timbre_id`)
    REFERENCES `stampee`.`timbre` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 22
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `stampee`.`mise`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stampee`.`mise` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `montant_mise` DOUBLE NOT NULL,
  `date` DATE NOT NULL,
  `utilisateur_id` INT(11) NOT NULL,
  `enchere_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `utilisateur_id` (`utilisateur_id` ASC) VISIBLE,
  INDEX `enchere_id` (`enchere_id` ASC) VISIBLE,
  CONSTRAINT `mise_ibfk_1`
    FOREIGN KEY (`utilisateur_id`)
    REFERENCES `stampee`.`utilisateur` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `mise_ibfk_2`
    FOREIGN KEY (`enchere_id`)
    REFERENCES `stampee`.`enchere` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
