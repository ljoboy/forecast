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
-- Table `forcast_db`.`fournisseur`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`fournisseur` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`fournisseur` (
  `id_fournisseur` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference_fornisseur` VARCHAR(50) NOT NULL,
  `adresse_fournissseur` VARCHAR(50) NULL,
  `email_fournisseur` VARCHAR(50) NULL,
  `date_creation_fournisseur` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etat_fournisseur` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_fournisseur`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`categorie_materiel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`categorie_materiel` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`categorie_materiel` (
  `id_cat_mat` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_cat_mat` VARCHAR(20) NOT NULL,
  `date_creation_cat` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `details_cat_ma` VARCHAR(100) NULL,
  `etat_cat_mat` TINYINT(1) NULL,
  PRIMARY KEY (`id_cat_mat`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`materiel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`materiel` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`materiel` (
  `code_materiel` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `designation_materiel` VARCHAR(50) NULL,
  `quantite_stock` INT UNSIGNED ZEROFILL NOT NULL,
  `stock_min` INT UNSIGNED ZEROFILL NOT NULL,
  `details` VARCHAR(100) NULL,
  `etat_materiel` TINYINT(1) NULL DEFAULT 1,
  `fournisseur_id_fournisseur` INT UNSIGNED NOT NULL,
  `categorie_materiel_id_cat_mat` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`code_materiel`),
  INDEX `fk_materiel_fournisseur1_idx` (`fournisseur_id_fournisseur` ASC),
  INDEX `fk_materiel_categorie_materiel1_idx` (`categorie_materiel_id_cat_mat` ASC),
  CONSTRAINT `fk_materiel_fournisseur1`
    FOREIGN KEY (`fournisseur_id_fournisseur`)
    REFERENCES `forcast_db`.`fournisseur` (`id_fournisseur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_materiel_categorie_materiel1`
    FOREIGN KEY (`categorie_materiel_id_cat_mat`)
    REFERENCES `forcast_db`.`categorie_materiel` (`id_cat_mat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`entree`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`entree` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`entree` (
  `id_entree` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `quantite_entree` INT ZEROFILL UNSIGNED NOT NULL,
  `date_entree` DATETIME NOT NULL,
  `date_enregistre` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etat_entree` TINYINT(1) NOT NULL DEFAULT 1,
  `prix_unitaire` FLOAT ZEROFILL NOT NULL,
  `description_entree` VARCHAR(100) NULL,
  `materiel_code_materiel` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_entree`),
  INDEX `fk_entree_materiel1_idx` (`materiel_code_materiel` ASC),
  CONSTRAINT `fk_entree_materiel1`
    FOREIGN KEY (`materiel_code_materiel`)
    REFERENCES `forcast_db`.`materiel` (`code_materiel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`sortie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`sortie` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`sortie` (
  `id_sortie` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_sortie` DATETIME NOT NULL,
  `date_enregistrer` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `qte_sortie` INT UNSIGNED NOT NULL,
  `motif_sortie` VARCHAR(255) NULL,
  `materiel_code_materiel` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_sortie`),
  INDEX `fk_sortie_materiel1_idx` (`materiel_code_materiel` ASC),
  CONSTRAINT `fk_sortie_materiel1`
    FOREIGN KEY (`materiel_code_materiel`)
    REFERENCES `forcast_db`.`materiel` (`code_materiel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`besoin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`besoin` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`besoin` (
  `id_besoin` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `quantite_besoin` INT UNSIGNED ZEROFILL NULL,
  `nom_materiel` VARCHAR(50) NOT NULL,
  `prix_unitaire_besoin` DOUBLE NULL,
  `details_besoin` VARCHAR(200) NULL,
  `date_creation_besoin` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etat_besoin` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_besoin`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`livraison`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`livraison` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`livraison` (
  `id_livraison` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `quantite_livree` INT UNSIGNED NOT NULL,
  `date_livraison` DATETIME NOT NULL,
  `date_creation` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sortie_id_sortie` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_livraison`),
  INDEX `fk_livraison_sortie1_idx` (`sortie_id_sortie` ASC),
  CONSTRAINT `fk_livraison_sortie1`
    FOREIGN KEY (`sortie_id_sortie`)
    REFERENCES `forcast_db`.`sortie` (`id_sortie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`demande`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`demande` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`demande` (
  `num_demande` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_creation_demande` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description_demande` VARCHAR(255) NULL,
  `code_materiel` INT UNSIGNED NOT NULL,
  `quantite_demande` INT NOT NULL,
  `etat_demande` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`num_demande`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `forcast_db`.`details_demande`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `forcast_db`.`details_demande` ;

CREATE TABLE IF NOT EXISTS `forcast_db`.`details_demande` (
  `id_details_demande` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `quantite_demande` INT UNSIGNED NOT NULL,
  `demande_num_demande` INT UNSIGNED NOT NULL,
  `materiel_code_materiel` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_details_demande`),
  INDEX `fk_details_demande_demande1_idx` (`demande_num_demande` ASC),
  INDEX `fk_details_demande_materiel1_idx` (`materiel_code_materiel` ASC),
  CONSTRAINT `fk_details_demande_demande1`
    FOREIGN KEY (`demande_num_demande`)
    REFERENCES `forcast_db`.`demande` (`num_demande`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_details_demande_materiel1`
    FOREIGN KEY (`materiel_code_materiel`)
    REFERENCES `forcast_db`.`materiel` (`code_materiel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
