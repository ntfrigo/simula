-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


CREATE DATABASE `invest` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

-- -----------------------------------------------------
-- Schema invest
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `invest` DEFAULT CHARACTER SET utf8mb4 ;
USE `invest` ;

-- -----------------------------------------------------
-- Table `invest`.`modelos`
-- -----------------------------------------------------
SELECT * FROM invest.selic;CREATE TABLE `modelos` (
  `idmodelo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(145) DEFAULT NULL,
  `percent_cdi` decimal(8,2) DEFAULT NULL,
  `taxa_aa` decimal(8,2) DEFAULT NULL,
  `prefixado` enum('S','N') DEFAULT 'N',
  `ativo` enum('S','N') DEFAULT 'S',
  `isento_ir` enum('S','N') DEFAULT 'N',
  PRIMARY KEY (`idmodelo`),
  KEY `idx_mod_tx` (`descricao`,`percent_cdi`,`taxa_aa`,`prefixado`,`ativo`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `selic` (
  `taxa` decimal(8,2) DEFAULT 10.50
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `invest`.`selic` (`taxa`) VALUES (10.75);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
