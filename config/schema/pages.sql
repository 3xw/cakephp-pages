-- MySQL Script generated by MySQL Workbench
-- Wed Apr  8 11:01:46 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema www_client_ch
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `attachments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `attachments` (
  `id` CHAR(36) CHARACTER SET 'utf8' NOT NULL,
  `profile` VARCHAR(45) NOT NULL DEFAULT 'default',
  `type` VARCHAR(45) NOT NULL,
  `subtype` VARCHAR(45) NOT NULL,
  `created` DATETIME NOT NULL,
  `modified` DATETIME NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `size` BIGINT(19) UNSIGNED NOT NULL,
  `md5` VARCHAR(32) NOT NULL,
  `path` VARCHAR(255) NULL DEFAULT NULL,
  `embed` TEXT NULL DEFAULT NULL,
  `title` VARCHAR(255) NULL DEFAULT NULL,
  `date` DATETIME NULL DEFAULT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `author` VARCHAR(255) NULL DEFAULT NULL,
  `copyright` VARCHAR(255) NULL DEFAULT NULL,
  `width` INT(10) UNSIGNED NULL DEFAULT '0',
  `height` INT(10) UNSIGNED NULL DEFAULT '0',
  `duration` INT(10) UNSIGNED NULL DEFAULT NULL,
  `meta` TEXT NULL DEFAULT NULL,
  `user_id` CHAR(36) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `article_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `article_types` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `pages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pages` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `meta` VARCHAR(255) NULL DEFAULT NULL,
  `header` TEXT NULL DEFAULT NULL,
  `page_type` VARCHAR(255) NOT NULL DEFAULT 'default',
  `parent_id` INT(10) UNSIGNED NULL DEFAULT '0',
  `lft` INT(11) NOT NULL,
  `rght` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `section_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `section_types` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sections`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sections` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_type_id` INT(11) NOT NULL,
  `page_id` INT(10) UNSIGNED NOT NULL,
  `order` INT(10) UNSIGNED NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `fk_sections_section_types1_idx` (`section_type_id` ASC),
  INDEX `fk_sections_pages1_idx` (`page_id` ASC),
  CONSTRAINT `fk_sections_pages1`
    FOREIGN KEY (`page_id`)
    REFERENCES `pages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sections_section_types1`
    FOREIGN KEY (`section_type_id`)
    REFERENCES `section_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `section_types_article_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `section_types_article_types` (
  `section_type_id` INT(11) NOT NULL,
  `article_type_id` INT(11) NOT NULL,
  PRIMARY KEY (`section_type_id`, `article_type_id`),
  INDEX `fk_section_types_has_article_types_article_types1_idx` (`article_type_id` ASC),
  INDEX `fk_section_types_has_article_types_section_types1_idx` (`section_type_id` ASC),
  CONSTRAINT `fk_section_types_has_article_types_article_types1`
    FOREIGN KEY (`article_type_id`)
    REFERENCES `article_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_section_types_has_article_types_section_types1`
    FOREIGN KEY (`section_type_id`)
    REFERENCES `section_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `attachments_pages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `attachments_pages` (
  `attachment_id` CHAR(36) CHARACTER SET 'utf8' NOT NULL,
  `page_id` INT(10) UNSIGNED NOT NULL,
  `order` INT NULL DEFAULT 0,
  PRIMARY KEY (`attachment_id`, `page_id`),
  INDEX `fk_attachments_has_pages_pages1_idx` (`page_id` ASC),
  INDEX `fk_attachments_has_pages_attachments1_idx` (`attachment_id` ASC),
  CONSTRAINT `fk_attachments_has_pages_attachments1`
    FOREIGN KEY (`attachment_id`)
    REFERENCES `attachments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_attachments_has_pages_pages1`
    FOREIGN KEY (`page_id`)
    REFERENCES `pages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `articles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `meta` VARCHAR(255) NULL,
  `header` TEXT NULL,
  `body` TEXT NULL,
  `classes` VARCHAR(255) NULL,
  `order` INT(11) NULL,
  `section_id` INT(10) UNSIGNED NOT NULL,
  `article_type_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Articles_sections1_idx` (`section_id` ASC),
  INDEX `fk_Articles_article_types1_idx` (`article_type_id` ASC),
  CONSTRAINT `fk_Articles_sections1`
    FOREIGN KEY (`section_id`)
    REFERENCES `sections` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Articles_article_types1`
    FOREIGN KEY (`article_type_id`)
    REFERENCES `article_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `attachments_articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `attachments_articles` (
  `attachment_id` CHAR(36) CHARACTER SET 'utf8' NOT NULL,
  `article_id` INT NOT NULL,
  `order` INT NULL,
  PRIMARY KEY (`attachment_id`, `article_id`),
  INDEX `fk_attachments_has_articles_articles1_idx` (`article_id` ASC),
  INDEX `fk_attachments_has_articles_attachments1_idx` (`attachment_id` ASC),
  CONSTRAINT `fk_attachments_has_articles_attachments1`
    FOREIGN KEY (`attachment_id`)
    REFERENCES `attachments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_attachments_has_articles_articles1`
    FOREIGN KEY (`article_id`)
    REFERENCES `articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
