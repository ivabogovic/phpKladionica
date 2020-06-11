-- MySQL Script generated by MySQL Workbench
-- Thu May 16 11:50:07 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema iwa_2018_vz_projekt
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema iwa_2018_vz_projekt
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `iwa_2018_vz_projekt` DEFAULT CHARACTER SET utf8 ;
USE `iwa_2018_vz_projekt` ;

-- -----------------------------------------------------
-- Table `iwa_2018_vz_projekt`.`tip_korisnika`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2018_vz_projekt`.`tip_korisnika` (
  `tip_korisnika_id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`tip_korisnika_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2018_vz_projekt`.`korisnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2018_vz_projekt`.`korisnik` (
  `korisnik_id` INT NOT NULL AUTO_INCREMENT,
  `tip_korisnika_id` INT NOT NULL,
  `korisnicko_ime` VARCHAR(50) NOT NULL,
  `lozinka` VARCHAR(50) NOT NULL,
  `ime` VARCHAR(50) NOT NULL,
  `prezime` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `slika` TEXT NOT NULL,
  PRIMARY KEY (`korisnik_id`),
  INDEX `fk_korisnik_tip_korisnika_idx` (`tip_korisnika_id` ASC),
  CONSTRAINT `fk_korisnik_tip_korisnika`
    FOREIGN KEY (`tip_korisnika_id`)
    REFERENCES `iwa_2018_vz_projekt`.`tip_korisnika` (`tip_korisnika_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2018_vz_projekt`.`liga`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2018_vz_projekt`.`liga` (
  `liga_id` INT NOT NULL AUTO_INCREMENT,
  `moderator_id` INT NOT NULL,
  `naziv` VARCHAR(50) NOT NULL,
  `slika` TEXT NOT NULL,
  `video` TEXT NULL COMMENT '	',
  `opis` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`liga_id`),
  INDEX `fk_liga_korisnik1_idx` (`moderator_id` ASC),
  CONSTRAINT `fk_liga_korisnik1`
    FOREIGN KEY (`moderator_id`)
    REFERENCES `iwa_2018_vz_projekt`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2018_vz_projekt`.`momcad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2018_vz_projekt`.`momcad` (
  `momcad_id` INT NOT NULL AUTO_INCREMENT,
  `liga_id` INT NOT NULL,
  `naziv` VARCHAR(50) NOT NULL,
  `opis` VARCHAR(50) NULL,
  PRIMARY KEY (`momcad_id`),
  INDEX `fk_momcad_liga1_idx` (`liga_id` ASC),
  CONSTRAINT `fk_momcad_liga1`
    FOREIGN KEY (`liga_id`)
    REFERENCES `iwa_2018_vz_projekt`.`liga` (`liga_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2018_vz_projekt`.`utakmica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2018_vz_projekt`.`utakmica` (
  `utakmica_id` INT NOT NULL AUTO_INCREMENT,
  `momcad_1` INT NOT NULL,
  `momcad_2` INT NOT NULL,
  `datum_vrijeme_pocetka` DATETIME NOT NULL,
  `datum_vrijeme_zavrsetka` DATETIME NOT NULL,
  `rezultat_1` INT NOT NULL,
  `rezultat_2` INT NOT NULL,
  `opis` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`utakmica_id`),
  INDEX `fk_utakmica_momcad1_idx` (`momcad_1` ASC),
  INDEX `fk_utakmica_momcad2_idx` (`momcad_2` ASC),
  CONSTRAINT `fk_utakmica_momcad1`
    FOREIGN KEY (`momcad_1`)
    REFERENCES `iwa_2018_vz_projekt`.`momcad` (`momcad_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utakmica_momcad2`
    FOREIGN KEY (`momcad_2`)
    REFERENCES `iwa_2018_vz_projekt`.`momcad` (`momcad_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2018_vz_projekt`.`listic`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2018_vz_projekt`.`listic` (
  `listic_id` INT NOT NULL AUTO_INCREMENT,
  `korisnik_id` INT NOT NULL,
  `utakmica_id` INT NOT NULL,
  `ocekivani_rezultat` INT NOT NULL,
  `status` CHAR(1) NOT NULL,
  INDEX `fk_korisnik_has_utakmica_utakmica1_idx` (`utakmica_id` ASC),
  INDEX `fk_korisnik_has_utakmica_korisnik1_idx` (`korisnik_id` ASC),
  PRIMARY KEY (`listic_id`),
  CONSTRAINT `fk_korisnik_has_utakmica_korisnik1`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `iwa_2018_vz_projekt`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_korisnik_has_utakmica_utakmica1`
    FOREIGN KEY (`utakmica_id`)
    REFERENCES `iwa_2018_vz_projekt`.`utakmica` (`utakmica_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE USER 'iwa_2018'@'localhost' IDENTIFIED BY 'foi2018';

GRANT SELECT, INSERT, TRIGGER, UPDATE, DELETE ON TABLE `iwa_2018_vz_projekt`.* TO 'iwa_2018'@'localhost';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
