SET storage_engine = InnoDB;

drop database IF EXISTS projectDB;
create database projectDB character set utf8;
use projectDB;

DROP TABLE IF EXISTS Admin;

CREATE TABLE Admin (
  AdminId int(11) unsigned NOT NULL AUTO_INCREMENT,
  Name varchar(255) NOT NULL DEFAULT '',
  Password varchar(255) NOT NULL DEFAULT '',
  Email varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (AdminId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Admin`(`AdminId`, `Name`, `Password`, `Email`) 
VALUES (10001,'admin01','csci3100', 'admin.1@gmail.com');

DROP TABLE IF EXISTS NormalUser;

CREATE TABLE NormalUser (
  NormalUserId int(11) unsigned NOT NULL AUTO_INCREMENT,
  Name varchar(255) NOT NULL DEFAULT 'New User',
  Password varchar(255) NOT NULL DEFAULT '',
  Email varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (NormalUserId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `NormalUser`(`NormalUserId`, `Name`, `Password`, `Email`) 
VALUES (20001,'user01','csci3100', 'csci3100.1@gmail.com'),
(20002,'user02','csci3100', 'csci3100.1@gmail.com');

DROP TABLE IF EXISTS Item;

CREATE TABLE Item (
  ItemId int(11) unsigned NOT NULL AUTO_INCREMENT,
  Name varchar(255) DEFAULT NULL,
  Type int(11) DEFAULT NULL,
  Recommend int(11) DEFAULT NULL,
  Quantity int(11) DEFAULT NULL,
  Price int(11) DEFAULT NULL,
  Path varchar(255) DEFAULT '../image/question.jpg',
  PRIMARY KEY (ItemId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Item`(`ItemId`, `Name`, `Type`, `Recommend`, `Quantity`, `Price`,`Path`) VALUES 
(30001,'Sirloin Steak', 1, 1, 999, 30, '../image/steak.jpg'),
(30002,'Beer', 5, 1, 100, 25, '../image/beer.jpg'),
(30003,'Fish', 1, 1, 200, 20, '../image/fish.jpg'),
(30004,'Apple', 3, 1, 300, 10, '../image/apple.jpg'),
(30005,'T-Bone', 1, 1, 200, 50, '../image/t-bone.jpg'),
(30006,'Eggplant', 2, 1, 100, 20, '../image/eggplant.jpg'),
(30007,'Pineapple', 3, 0, 50, 15, '../image/pineapple.jpg'),
(30008,'Lettuce', 2, 0, 500, 5, '../image/lettuce.jpg'),
(30009,'Pork belly', 1, 1, 200, 40, '../image/pork_belly.jpg'),
(30010,'Tortilla chip', 4, 0, 80, 5, '../image/tortilla_chip.jpg'),
(30011,'Chocolate', 4, 1, 300, 3, '../image/chocolate.jpg'),
(30012,'Wine', 5, 0, 100, 30, '../image/wine.jpg'),
(30013,'Tequila', 5, 1, 300, 60, '../image/tequila.jpg'),
(30014,'Cherry', 3, 1, 800, 15, '../image/cherry.jpg'),
(30015,'Salmon', 1, 0, 250, 40, '../image/salmon.jpg'),
(30016,'Garlic', 2, 0, 100, 2, '../image/garlic.jpg');


DROP TABLE IF EXISTS Orders;

CREATE TABLE Orders (
  OrderId int(11) unsigned NOT NULL AUTO_INCREMENT,
  NormalUserId int(11) unsigned DEFAULT NULL,
  Approved tinyint(1) DEFAULT '0',
  PurchaseDate date DEFAULT NULL,
  TotalPrice int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (OrderId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `orders`(`OrderId`, `NormalUserId`, `Approved`, `PurchaseDate`, `TotalPrice`) VALUES 
(40001,20001,0,'2021-04-12',360);

DROP TABLE IF EXISTS OrdersItem;

CREATE TABLE OrdersItem (
  OrdersItemId int(11) unsigned NOT NULL AUTO_INCREMENT,
  ItemId int(11) unsigned DEFAULT NULL,
  OrderId int(11) unsigned DEFAULT NULL,
  Quantity int(11) DEFAULT NULL,
  PRIMARY KEY (OrdersItemId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `OrdersItem`(`OrdersItemId`, `ItemId`, `OrderId`, `Quantity`) VALUES 
(50002,30001,40001,3),
(50003,30001,40001,4),
(50004,30001,40001,5);
    
ALTER TABLE Orders ADD CONSTRAINT fk_Orders_NormalUserId 
    FOREIGN KEY (NormalUserId) REFERENCES NormalUser(NormalUserId); 
    
ALTER TABLE OrdersItem ADD CONSTRAINT fk_OrdersItem_ItemId 
    FOREIGN KEY (ItemId) REFERENCES Item(ItemId); 
ALTER TABLE OrdersItem ADD CONSTRAINT fk_OrdersItem_OrderId 
    FOREIGN KEY (OrderId) REFERENCES Orders(OrderId); 


