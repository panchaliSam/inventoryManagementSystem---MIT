CREATE SCHEMA InventoryMgt;

USE InventoryMgt;

-- TABLES --

CREATE TABLE Category (
	CategoryID INT NOT NULL AUTO_INCREMENT,
	Name VARCHAR(45) NULL DEFAULT NULL,
	Quantity INT NOT NULL,
	IsAvailable TINYINT NULL,
	Description VARCHAR(100) NULL,
	PRIMARY KEY (CategoryID)
);

CREATE TABLE User (
	UserID INT NOT NULL AUTO_INCREMENT,
	FName VARCHAR(45) NULL DEFAULT NULL,
	LName VARCHAR(45) NULL DEFAULT NULL,
	Email VARCHAR(45) NULL DEFAULT NULL,
	Telephone VARCHAR(10) NULL DEFAULT NULL,
	UName VARCHAR(20) NULL DEFAULT NULL,
	PasswordHash VARCHAR(255) NOT NULL,
	IsAdmin TINYINT NULL DEFAULT NULL,
	PRIMARY KEY (UserID)
);

CREATE TABLE Customer (
	CustomerID INT NOT NULL AUTO_INCREMENT,
	Name VARCHAR(45) NULL DEFAULT NULL,
	Email VARCHAR(45) NULL DEFAULT NULL,
	Telephone VARCHAR(10) NULL DEFAULT NULL,
	PRIMARY KEY (CustomerID)
);

CREATE TABLE Supplier (
	SupplierID INT NOT NULL AUTO_INCREMENT,
	Name VARCHAR(45) NULL DEFAULT NULL,
	Telephone VARCHAR(10) NULL DEFAULT NULL,
	PRIMARY KEY (SupplierID)
);

CREATE TABLE Brand (
	BrandID INT NOT NULL AUTO_INCREMENT,
	Name VARCHAR(45) NULL DEFAULT NULL,
	PRIMARY KEY (BrandID)
);

CREATE TABLE Orders (
	OrderID INT NOT NULL AUTO_INCREMENT,
	DateAdded DATETIME NULL DEFAULT NULL,
	Amount DOUBLE NULL DEFAULT NULL,
	CustomerID INT NOT NULL,
	PRIMARY KEY (OrderID),
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID)
);

CREATE TABLE Item (
	ItemID INT NOT NULL AUTO_INCREMENT,
	Name VARCHAR(45) NULL DEFAULT NULL,
	Quantity INT NULL DEFAULT NULL,
	PurchasePrice DOUBLE NULL DEFAULT NULL,
	SellingPrice DOUBLE NULL DEFAULT NULL,
	Status TINYINT NULL DEFAULT NULL,
	Description TEXT NULL DEFAULT NULL,
	CategoryID INT NOT NULL,
	BrandID INT NOT NULL,
	PRIMARY KEY (ItemID),
    FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID),
    FOREIGN KEY (BrandID) REFERENCES Brand (BrandID)
);

CREATE TABLE ItemHasOrder (
	ItemID INT NOT NULL,
	OrderID INT NOT NULL,
	Quantity INT NULL DEFAULT NULL,
	FOREIGN KEY (ItemID) REFERENCES Item(ItemID),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID)
);

CREATE TABLE CategoryHasSupplier (
	CategoryID INT NOT NULL,
	SupplierID INT NOT NULL,
	Quantity INT NULL DEFAULT NULL,
    FOREIGN KEY (CategoryID) REFERENCES Category (CategoryID),
    FOREIGN KEY (SupplierID) REFERENCES Supplier (SupplierID)
);

-- Inserting Categories --
INSERT INTO Category (Name, Quantity, IsAvailable, Description)
VALUES 
('Phone', 100, TRUE, 'Smartphones and accessories'),
('Laptop', 50, TRUE, 'Laptops and accessories'),
('Headphone', 200, TRUE, 'Headphones and earphones');

-- Inserting Users with Password Hashing --
INSERT INTO User (FName, LName, Email, Telephone, UName, PasswordHash, IsAdmin)
VALUES 
('John', 'Doe', 'john.doe@example.com', '1234567890', 'johndoe', SHA2('password123', 256), TRUE),
('Jane', 'Smith', 'jane.smith@example.com', '0987654321', 'janesmith', SHA2('password123', 256), FALSE);

-- Inserting Customers --
INSERT INTO Customer (Name, Email, Telephone)
VALUES 
('Alice Brown', 'alice.brown@example.com', '1231231234'),
('Bob White', 'bob.white@example.com', '4321432143');

-- Inserting Suppliers --
INSERT INTO Supplier (Name, Telephone)
VALUES 
('TechSupplier Co.', '5551234567'),
('Gadgets Inc.', '5559876543'),
('Electronics World', '5557654321');

-- Inserting Brands --
INSERT INTO Brand (Name)
VALUES 
('Apple'),
('Dell'),
('Sony');

-- Inserting Orders --
INSERT INTO Orders (DateAdded, Amount, CustomerID)
VALUES 
('2024-08-19 10:00:00', 1500.00, 1),
('2024-08-19 11:00:00', 800.00, 2);

-- Inserting Items --
INSERT INTO Item (Name, Quantity, PurchasePrice, SellingPrice, Status, Description, CategoryID, BrandID)
VALUES 
('iPhone 12', 10, 700.00, 900.00, TRUE, 'Latest iPhone model', 1, 1),
('Dell XPS 13', 5, 1000.00, 1200.00, TRUE, '13-inch laptop', 2, 2),
('Sony WH-1000XM4', 15, 200.00, 300.00, TRUE, 'Noise-cancelling headphones', 3, 3);

-- Inserting Item-Order Relationships --
INSERT INTO ItemHasOrder (ItemID, OrderID, Quantity)
VALUES 
(1, 1, 2),
(2, 2, 1),
(3, 1, 3);

-- Inserting Category-Supplier Relationships --
INSERT INTO CategoryHasSupplier (CategoryID, SupplierID, Quantity)
VALUES 
(1, 1, 50),
(2, 2, 30),
(3, 3, 70);


ALTER TABLE Item
MODIFY COLUMN Description VARCHAR(500);

-- Update Item table to ensure all price-related columns are of type DOUBLE
ALTER TABLE Item
MODIFY COLUMN PurchasePrice DOUBLE NULL DEFAULT NULL,
MODIFY COLUMN SellingPrice DOUBLE NULL DEFAULT NULL;

-- Update Orders table to ensure Amount column is of type DOUBLE
ALTER TABLE Orders
MODIFY COLUMN Amount DOUBLE NULL DEFAULT NULL;
