--
-- Table structure for table `Bill`
--

DROP TABLE IF EXISTS `Bill`;
CREATE TABLE `Bill` (
  `billID` int(11) NOT NULL AUTO_INCREMENT,
  `total` decimal(4,2) DEFAULT NULL,
  `staffID` int(11) DEFAULT NULL,
  `tableID` int(11) DEFAULT NULL,
  PRIMARY KEY (`billID`),
  KEY `tableID_idx` (`tableID`),
  KEY `staffID_idx` (`staffID`),
  CONSTRAINT `staffID` FOREIGN KEY (`staffID`) REFERENCES `Staff` (`staffID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tableID` FOREIGN KEY (`tableID`) REFERENCES `Table` (`tableID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) 

--
-- Table structure for table `FoodItem`
--

DROP TABLE IF EXISTS `FoodItem`;
CREATE TABLE `FoodItem` (
  `fname` varchar(10) NOT NULL,
  `price` decimal(3,2) DEFAULT NULL,
  PRIMARY KEY (`fname`)
) 

--
-- Table structure for table `OrderRecord`
--

DROP TABLE IF EXISTS `OrderRecord`;
CREATE TABLE `OrderRecord` (
  `or_orderNumber` int(11) NOT NULL,
  `or_billID` int(11) NOT NULL,
  `or_staffID` int(11) DEFAULT NULL,
  PRIMARY KEY (`or_orderNumber`,`or_billID`),
  KEY `billID_idx` (`or_billID`),
  KEY `staffID_idx` (`or_staffID`),
  CONSTRAINT `or_billID` FOREIGN KEY (`or_billID`) REFERENCES `Bill` (`billID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `or_staffID` FOREIGN KEY (`or_staffID`) REFERENCES `Staff` (`staffID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) 

--
-- Table structure for table `ProcessOrder`
--

DROP TABLE IF EXISTS `ProcessOrder`;
CREATE TABLE `ProcessOrder` (
  `fname` varchar(20) NOT NULL,
  `orderNumber` int(11) NOT NULL,
  `numberFood` int(11) DEFAULT NULL,
  `isCompleted` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`fname`,`orderNumber`),
  KEY `orderNumber_idx` (`orderNumber`),
  CONSTRAINT `fname` FOREIGN KEY (`fname`) REFERENCES `FoodItem` (`fname`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `orderNumber` FOREIGN KEY (`orderNumber`) REFERENCES `OrderRecord` (`or_orderNumber`) ON DELETE NO ACTION ON UPDATE NO ACTION
) 

--
-- Table structure for table `Staff`
--

DROP TABLE IF EXISTS `Staff`;
CREATE TABLE `Staff` (
  `staffID` int(11) NOT NULL AUTO_INCREMENT,
  `staffName` varchar(45) DEFAULT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`staffID`)
) 


--
-- Table structure for table `Table`
--

DROP TABLE IF EXISTS `Table`;
CREATE TABLE `Table` (
  `tableID` int(11) NOT NULL,
  PRIMARY KEY (`tableID`)
) 

insert into Table
values(1);

insert into Table
values(2);

insert into Table
values(3);

insert into Table
values(4);

insert into Table
values(5);

insert into Table
values(6);

insert into Table
values(7);

insert into Table
values(8);

insert into Table
values(9);

insert into Table
values(10);

insert into Staff
values(101, 'Harry');

insert into Staff
values(102, 'Hermoine');

insert into Staff
values(103, 'Ron');

insert into Staff
values(104, 'Hagrid');

insert into Staff
values(105, 'Voldemort');

insert into Staff
values(106, 'Dumbledore');

insert into FoodItem
values ('Butterbeer', '5.00');

insert into FoodItem
values ('Firewhiskey', '7.00');

insert into FoodItem
values ('Pumpkin Juice', '3.00');

insert into FoodItem
values ('Water', '1.50');

insert into FoodItem
values ('Latte', '3.50');

insert into FoodItem
values ('Coffee', '2.00');

insert into FoodItem
values ('Tea', '2.00');

insert into FoodItem
values ('Pumpkin Pie', '6.00');

insert into FoodItem
values ('Cauldron Cake', '6.00');

insert into FoodItem
values ('Rock Cake', '4.00');

insert into FoodItem
values ('Lemon Drizzle Cake', '6.00');

insert into FoodItem
values ('Treacle Tart', '5.50');

insert into FoodItem
values ('Trifle', '5.00');

insert into FoodItem
values ('Corned Beef Sandwich', '8.50');

insert into FoodItem
values ('Hamburger', '8.00');

insert into FoodItem
values ('Chicken and Ham Sandwich', '8.50');

insert into FoodItem
values ('Veggie Burger', '7.70');

insert into FoodItem
values ('Steak and Kidney Pie', '10.00');

insert into FoodItem
values ('Vegetable Panini', '7.50');

insert into FoodItem
values ('Butter Chicken', '9.00');

insert into FoodItem
values ('Tomato Soup', '6.00');

insert into FoodItem
values ('Mushroom Soup', '6.00');

insert into FoodItem
values ('Nettle Soup', '6.50');

insert into FoodItem
values ('French Onion Soup', '6.50');

insert into FoodItem
values ('Fish and Chips', '7.00');

insert into FoodItem
values ('Chips', '5.00');

insert into FoodItem
values ('Bertie Botts Every Flavour Beans bowl', '5.00');

INSERT INTO `Bill`
VALUES(1, 240.30, 101, 1);

INSERT INTO `Bill`
VALUES(2, 23.12, 101, 2);

INSERT INTO `Bill`
VALUES(3, 49.33, 102, 3);

INSERT INTO `Bill`
VALUES(4, 94.76, 103, 4);

INSERT INTO `ProcessOrder`
VALUES(`Butterbeer`, 1, 4, 0);

INSERT INTO `ProcessOrder`
VALUES(`Coffee`, 2, 4, 0);

INSERT INTO `ProcessOrder`
VALUES(`Cauldron`, 3, 1, 1);

--
-- Tuples for OrderRecord
--

INSERT INTO `OrderRecord` 
VALUES(1, 1, 101);

INSERT INTO `OrderRecord` 
VALUES(2, 2, 102);

INSERT INTO `OrderRecord` 
VALUES(3, 3, 103);

INSERT INTO `OrderRecord` 
VALUES(4, 4, 104);

