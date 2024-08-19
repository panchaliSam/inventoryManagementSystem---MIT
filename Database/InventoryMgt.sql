CREATE SCHEMA InventoryMgt;

USE InventoryMgt;

-- TABLES --

CREATE TABLE category (
	CategoryID INT NOT NULL,
	name VARCHAR(45) NULL DEFAULT NULL,
	quantity INT NOT NULL,
	IsAvailable TINYINT NULL,
	Description VARCHAR(100) NULL,
	PRIMARY KEY (CategoryID)
);

CREATE TABLE user (
	UserID INT NOT NULL,
	fName VARCHAR(45) NULL DEFAULT NULL,
	lname VARCHAR(45) NULL DEFAULT NULL,
	email VARCHAR(45) NULL DEFAULT NULL,
	telephone VARCHAR(10) NULL DEFAULT NULL,
	uname VARCHAR(20) NULL DEFAULT NULL,
	password VARCHAR(45) NULL DEFAULT NULL,
	isAdmin TINYINT NULL DEFAULT NULL,
	PRIMARY KEY (UserID)
);

CREATE TABLE orders (
	OrderID INT NOT NULL,
	dateAdded DATETIME NULL DEFAULT NULL,
	Amount DOUBLE NULL DEFAULT NULL,
	CustomerID INT NOT NULL,
	PRIMARY KEY (OrderID),
    FOREIGN KEY (CustomerID) REFERENCES customer(CustomerID)
);

CREATE TABLE item (
	ItemID INT NOT NULL,
	name VARCHAR(45) NULL DEFAULT NULL,
	quantity INT NULL DEFAULT NULL,
	purchasePrice DOUBLE NULL DEFAULT NULL,
	sellingPrice DOUBLE NULL DEFAULT NULL,
	status TINYINT NULL DEFAULT NULL,
	description TEXT NULL DEFAULT NULL,
	CategoryID INT NOT NULL,
	BrandID INT NOT NULL,
	PRIMARY KEY (ItemID),
    FOREIGN KEY (CategoryID) REFERENCES category(CategoryID),
    FOREIGN KEY (BrandID) REFERENCES brand (BrandID)
);

CREATE TABLE item_has_order (
	ItemID INT NOT NULL,
	OrderID INT NOT NULL,
	quantity INT NULL DEFAULT NULL,
	FOREIGN KEY (ItemID) REFERENCES item(ItemID),
    FOREIGN KEY (OrderID) REFERENCES orders(OrderID)
);

CREATE TABLE customer (
	CustomerID INT NOT NULL,
	name VARCHAR(45) NULL DEFAULT NULL,
	email VARCHAR(45) NULL DEFAULT NULL,
	telephone VARCHAR(10) NULL DEFAULT NULL,
	PRIMARY KEY (CustomerID)
);

CREATE TABLE category_has_supplier (
	CategoryID INT NOT NULL,
	SupplierID INT NOT NULL,
	quantity INT NULL DEFAULT NULL,
    FOREIGN KEY (CategoryID) REFERENCES category (CategoryID),
    FOREIGN KEY (SupplierID) REFERENCES supplier (SupplierID)
);

CREATE TABLE supplier (
	SupplierID INT NOT NULL,
	name VARCHAR(45) NULL DEFAULT NULL,
	telephone VARCHAR(10) NULL DEFAULT NULL,
	PRIMARY KEY (SupplierID)
);

CREATE TABLE brand (
	BrandID INT NOT NULL,
	name VARCHAR(45) NULL DEFAULT NULL,
	PRIMARY KEY (BrandID)
);

-- Inserting Categories --
INSERT INTO category (CategoryID, Name, Quantity, IsAvailable, Description)
VALUES 
(1, 'Phone', 100, TRUE, 'Smartphones and accessories'),
(2, 'Laptop', 50, TRUE, 'Laptops and accessories'),
(3, 'Headphone', 200, TRUE, 'Headphones and earphones');

-- Inserting Users --
INSERT INTO user (UserID, fName, lname, email, telephone, uname, password, isAdmin)
VALUES 
(1, 'John', 'Doe', 'john.doe@example.com', '1234567890', 'johndoe', 'password123', TRUE),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '0987654321', 'janesmith', 'password123', FALSE);

-- Inserting Orders --
INSERT INTO orders (OrderID, dateAdded, Amount, CustomerID)
VALUES 
(1, '2024-08-19 10:00:00', 1500.00, 1),
(2, '2024-08-19 11:00:00', 800.00, 2);

-- Inserting Items --
INSERT INTO item (ItemID, name, quantity, purchasePrice, sellingPrice, status, description, CategoryID, BrandID)
VALUES 
(1, 'iPhone 12', 10, 700.00, 900.00, TRUE, 'Latest iPhone model', 1, 1),
(2, 'Dell XPS 13', 5, 1000.00, 1200.00, TRUE, '13-inch laptop', 2, 2),
(3, 'Sony WH-1000XM4', 15, 200.00, 300.00, TRUE, 'Noise-cancelling headphones', 3, 3);

-- Inserting Item-Order Relationships --
INSERT INTO item_has_order (ItemID, OrderID, quantity)
VALUES 
(1, 1, 2),
(2, 2, 1),
(3, 1, 3);

-- Inserting Customers --
INSERT INTO customer (CustomerID, name, email, telephone)
VALUES 
(1, 'Alice Brown', 'alice.brown@example.com', '1231231234'),
(2, 'Bob White', 'bob.white@example.com', '4321432143');

-- Inserting Category-Supplier Relationships --
INSERT INTO category_has_supplier (CategoryID, SupplierID, quantity)
VALUES 
(1, 1, 50),
(2, 2, 30),
(3, 3, 70);

-- Inserting Suppliers --
INSERT INTO supplier (SupplierID, name, telephone)
VALUES 
(1, 'TechSupplier Co.', '5551234567'),
(2, 'Gadgets Inc.', '5559876543'),
(3, 'Electronics World', '5557654321');

-- Inserting Brands --
INSERT INTO brand (BrandID, name)
VALUES 
(1, 'Apple'),
(2, 'Dell'),
(3, 'Sony');



ALTER TABLE User MODIFY PasswordHash VARCHAR(255) NOT NULL;
