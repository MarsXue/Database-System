-- -----------------------------------------------------
-- Table `Platform`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Platform` ;

CREATE TABLE IF NOT EXISTS `Platform` (
  `idPlatform` INT NOT NULL,
  `Name` VARCHAR(45) NULL,
  PRIMARY KEY (`idPlatform`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Software`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Software` ;

CREATE TABLE IF NOT EXISTS `Software` (
  `SoftwareId` INT NOT NULL,
  `Name` VARCHAR(200) NULL,
  `CurrentVersion` INT NOT NULL,
  `Price` DECIMAL(6,2) NULL,
  `DistributionCost` DECIMAL(6,2) NULL,
  `idPlatform` INT NULL,
  `Description` BLOB NULL,
  `YearOfRelease` YEAR NULL,
  `Website` VARCHAR(300) NULL,
  PRIMARY KEY (`SoftwareId`),
    FOREIGN KEY (`idPlatform`)
    REFERENCES `Platform` (`idPlatform`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `Staff`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Staff` ;

CREATE TABLE IF NOT EXISTS `Staff` (
  `idStaff` INT NOT NULL,
  `FirstName` VARCHAR(50) NULL,
  `LastName` VARCHAR(50) NULL,
  PRIMARY KEY (`idStaff`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `JobTitle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `JobTitle` ;

CREATE TABLE IF NOT EXISTS `JobTitle` (
  `idJobTitle` INT NOT NULL,
  `OfficialJobTitle` VARCHAR(50) NOT NULL,
  `PayRatePerHour` DECIMAL(6,2) NOT NULL,
  PRIMARY KEY (`idJobTitle`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Development`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Development` ;

CREATE TABLE IF NOT EXISTS `Development` (
  `SoftwareId` INT NOT NULL,
  `idStaff` INT NOT NULL,
  `idJobTitle` INT NOT NULL,
  PRIMARY KEY (`SoftwareId`, `idStaff`, `idJobTitle`),
    FOREIGN KEY (`SoftwareId`)
    REFERENCES `Software` (`SoftwareId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`idStaff`)
    REFERENCES `Staff` (`idStaff`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`idJobTitle`)
    REFERENCES `JobTitle` (`idJobTitle`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
