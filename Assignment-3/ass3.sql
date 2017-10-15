SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `Spatula`;
CREATE TABLE IF NOT EXISTS `Spatula` (
  `idSpatula` INT NOT NULL,
  `ProductName` VARCHAR(50) NOT NULL,
  `Type` ENUM('Food', 'Drugs', 'Paints', 'Plaster') NOT NULL,
  `Size` VARCHAR(50) NOT NULL,
  `Colour` VARCHAR(50) NOT NULL,
  `Price` DECIMAL(10, 2) NOT NULL,
  `QuantityInStock` INT NOT NULL,
  PRIMARY KEY (`idSpatula`)
) ENGINE=INNODB;

DROP TABLE IF EXISTS `Order`;
CREATE TABLE IF NOT EXISTS `Order` (
`idOrder` INT NOT NULL AUTO_INCREMENT,
`RequestedTime` DATETIME NOT NULL,
`ResponsibleStaffMember` VARCHAR(100) NOT NULL,
`CustomerDetails` VARCHAR(300) NOT NULL,
PRIMARY KEY(`idOrder`)
) ENGINE=INNODB;

DROP TABLE IF EXISTS `OrderLineItem`;
CREATE TABLE IF NOT EXISTS `OrderLineItem` (
`idSpatula` INT NOT NULL,
`idOrder` INT NOT NULL,
`Quantity` INT NOT NULL,
PRIMARY KEY(`idSpatula`, `idOrder`),
FOREIGN KEY (`idSpatula`)
REFERENCES `Spatula` (`idSpatula`)
ON DELETE CASCADE
ON UPDATE RESTRICT,
FOREIGN KEY (`idOrder`)
REFERENCES `Order` (`idOrder`)
ON DELETE CASCADE
ON UPDATE RESTRICT
) ENGINE=INNODB;

INSERT INTO Spatula VALUES
(1, "S1", "Plaster", "10", "Black", 1.00, 0),
(2, "S2", "Drugs", "20", "Green", 2.00, 10),
(3, "S3", "Food", "30", "Blue", 3.00, 0),
(4, "S4", "Plaster", "10", "Green", 4.00, 5),
(5, "S5", "Paints", "20", "Black", 5.00, 0),
(6, "S6", "Drugs", "30", "Red", 6.00, 20),
(7, "S7", "Food", "10", "Blue", 7.00, 0),
(8, "S8", "Plaster", "20", "Red", 1.00, 30),
(9, "S9", "Paints", "20", "Purple", 9.00, 0),
(10, "S10", "Drugs", "10", "Purple", 3.00, 100),
(11, "S11", "Food", "15", "Black", 11.00, 178),
(12, "S12", "Drugs", "10", "Purple", 8.00, 1),
(13, "S13", "Plaster", "12", "Green", 12.00, 0);

