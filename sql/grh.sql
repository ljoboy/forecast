-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema forcast_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema forcast_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `forcast_db` DEFAULT CHARACTER SET utf8 ;
USE `forcast_db` ;

-- -----------------------------------------------------
-- Table `forcast_db`.`departement`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`departement` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`departement` (
  `id_departement` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_departement` VARCHAR(50) NOT NULL,
  `description` VARCHAR(255) NULL,
  PRIMARY KEY (`id_departement`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`agent`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`agent` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`agent` (
  `id_agent` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(50) NOT NULL,
  `postnom` VARCHAR(50) NULL,
  `prenom` VARCHAR(50) NOT NULL,
  `etat_civil` VARCHAR(12) NOT NULL,
  `matricule` VARCHAR(15) NOT NULL,
  `adresse` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `date_de_naissance` DATE NOT NULL,
  `lieu_de_naissance` VARCHAR(50) NOT NULL,
  `telephone` DOUBLE UNSIGNED NULL,
  `genre` ENUM('m', 'f') NOT NULL,
  `date_entree` DATE NOT NULL,
  `date_confirmation` DATE NOT NULL,
  `date_fin` DATE NULL,
  `ville` VARCHAR(50) NULL,
  `province` VARCHAR(50) NULL,
  `pays` VARCHAR(50) NOT NULL,
  `departement_id_departement` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_agent`),
  UNIQUE INDEX `matricule_UNIQUE` (`matricule` ASC),
  INDEX `fk_agent_departement1_idx` (`departement_id_departement` ASC),
  CONSTRAINT `fk_agent_departement1`
    FOREIGN KEY (`departement_id_departement`)
    REFERENCES `forcast_db`.`departement` (`id_departement`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`user` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`user` (
  `id_user` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(20) NOT NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(255) NOT NULL,
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `agent_id_agent` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_user`),
  INDEX `fk_user_agent1_idx` (`agent_id_agent` ASC),
  CONSTRAINT `fk_user_agent1`
    FOREIGN KEY (`agent_id_agent`)
    REFERENCES `forcast_db`.`agent` (`id_agent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `forcast_db`.`poste`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`poste` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`poste` (
  `id_poste` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_poste` VARCHAR(50) NOT NULL,
  `description` VARCHAR(255) NULL,
  `type` VARCHAR(50) NULL,
  PRIMARY KEY (`id_poste`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`connaissances_linguistiques`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`connaissances_linguistiques` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`connaissances_linguistiques` (
  `id_langue_parler` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lecture` INT(2) UNSIGNED ZEROFILL NOT NULL,
  `ecriture` INT(2) UNSIGNED ZEROFILL NOT NULL,
  `parler` INT(2) UNSIGNED ZEROFILL NOT NULL,
  `comprendre` INT(2) UNSIGNED ZEROFILL NOT NULL,
  `agent_id_agent` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_langue_parler`),
  INDEX `fk_connaissances_linguistiques_agent1_idx` (`agent_id_agent` ASC),
  CONSTRAINT `fk_connaissances_linguistiques_agent1`
    FOREIGN KEY (`agent_id_agent`)
    REFERENCES `forcast_db`.`agent` (`id_agent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`langage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`langage` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`langage` (
  `id_langage` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_langage` VARCHAR(50) NOT NULL,
  `description` VARCHAR(255) NULL,
  `connaissances_linguistiques_id_langue_parler` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_langage`),
  INDEX `fk_langage_connaissances_linguistiques1_idx` (`connaissances_linguistiques_id_langue_parler` ASC),
  CONSTRAINT `fk_langage_connaissances_linguistiques1`
    FOREIGN KEY (`connaissances_linguistiques_id_langue_parler`)
    REFERENCES `forcast_db`.`connaissances_linguistiques` (`id_langue_parler`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`affectation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`affectation` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`affectation` (
  `id_affectation` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_affectation` DATE NOT NULL,
  `is_actif` TINYINT(1) NOT NULL,
  `agent_id_agent` INT UNSIGNED NOT NULL,
  `poste_id_poste` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_affectation`),
  INDEX `fk_affectation_agent1_idx` (`agent_id_agent` ASC),
  INDEX `fk_affectation_poste1_idx` (`poste_id_poste` ASC),
  CONSTRAINT `fk_affectation_agent1`
    FOREIGN KEY (`agent_id_agent`)
    REFERENCES `forcast_db`.`agent` (`id_agent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_affectation_poste1`
    FOREIGN KEY (`poste_id_poste`)
    REFERENCES `forcast_db`.`poste` (`id_poste`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`conge`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`conge` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`conge` (
  `id_conge` INT UNSIGNED NOT NULL,
  `type` VARCHAR(50) NULL,
  `date_debut` DATE NOT NULL,
  `date_fin` DATE NOT NULL,
  `details` VARCHAR(255) NULL,
  `agent_id_agent` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_conge`),
  INDEX `fk_conge_agent1_idx` (`agent_id_agent` ASC),
  CONSTRAINT `fk_conge_agent1`
    FOREIGN KEY (`agent_id_agent`)
    REFERENCES `forcast_db`.`agent` (`id_agent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`personne_a_contactee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`personne_a_contactee` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`personne_a_contactee` (
  `id_personne_a_contactee` INT UNSIGNED NOT NULL,
  `nom_complet` VARCHAR(100) NOT NULL,
  `telephone` DOUBLE UNSIGNED NOT NULL,
  `email` VARCHAR(255) NULL,
  `relation` VARCHAR(50) NOT NULL,
  `agent_id_agent` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_personne_a_contactee`, `agent_id_agent`),
  INDEX `fk_personne_a_contactee_agent1_idx` (`agent_id_agent` ASC),
  CONSTRAINT `fk_personne_a_contactee_agent1`
    FOREIGN KEY (`agent_id_agent`)
    REFERENCES `forcast_db`.`agent` (`id_agent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`tache`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`tache` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`tache` (
  `id_tache` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tache` VARCHAR(255) NOT NULL,
  `date_debut` DATE NOT NULL,
  `date_fin` DATE NOT NULL,
  `date_assignement` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etat` TINYINT(1) UNSIGNED ZEROFILL NOT NULL,
  `details` TEXT NULL,
  PRIMARY KEY (`id_tache`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`agent_has_tache`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`agent_has_tache` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`agent_has_tache` (
  `agent_id_agent` INT UNSIGNED NOT NULL,
  `tache_id_tache` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`agent_id_agent`, `tache_id_tache`),
  INDEX `fk_agent_has_tache_tache1_idx` (`tache_id_tache` ASC),
  INDEX `fk_agent_has_tache_agent1_idx` (`agent_id_agent` ASC),
  CONSTRAINT `fk_agent_has_tache_agent1`
    FOREIGN KEY (`agent_id_agent`)
    REFERENCES `forcast_db`.`agent` (`id_agent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_agent_has_tache_tache1`
    FOREIGN KEY (`tache_id_tache`)
    REFERENCES `forcast_db`.`tache` (`id_tache`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
