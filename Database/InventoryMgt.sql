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

USE InventoryMgt;

-- Inserting Categories --
INSERT INTO category (Name, Quantity, IsAvailable, Description)
VALUES 
('Phone', 100, TRUE, 'Smartphones and accessories'),
('Laptop', 50, TRUE, 'Laptops and accessories'),
('Headphone', 200, TRUE, 'Headphones and earphones');

-- Inserting Users --
-- Note: Passwords should be hashed using a secure method before insertion
INSERT INTO user (Name, Email, Telephone, Username, PasswordHash, IsAdmin)
VALUES 
('Alice Johnson', 'alice@example.com', '1234567890', 'alicej', SHA2('password123', 256), TRUE),
('Bob Smith', 'bob@example.com', '0987654321', 'bobsmith', SHA2('password456', 256), FALSE);

-- Inserting Items --
INSERT INTO item (Name, Brand, Price, Quantity, IsAvailable, Description, CategoryID)
VALUES 
('iPhone 14', 'Apple', 999.99, 30, TRUE, 'Latest model smartphone', 1),
('Galaxy S21', 'Samsung', 799.99, 50, TRUE, 'High-end Android smartphone', 1),
('MacBook Pro', 'Apple', 1299.99, 20, TRUE, 'High-performance laptop', 2),
('Dell XPS 13', 'Dell', 999.99, 30, TRUE, 'Compact and powerful laptop', 2),
('AirPods Pro', 'Apple', 199.99, 100, TRUE, 'Wireless noise-canceling earbuds', 3),
('Sony WH-1000XM4', 'Sony', 299.99, 50, TRUE, 'Noise-canceling headphones', 3);

-- Inserting Orders --
INSERT INTO orders (ClientName, Date, Quantity, Amount)
VALUES 
('Charlie Brown', '2024-08-01', 2, 1999.98),
('David Wilson', '2024-08-02', 1, 999.99);

-- Inserting Order Items --
INSERT INTO OrderItem (OrderID, ItemID, Quantity)
VALUES 
(1, 3, 1), -- 1 MacBook Pro
(1, 1, 1), -- 1 iPhone 14
(2, 4, 1); -- 1 Dell XPS 13

-- Inserting UserCategory Relations --
INSERT INTO UserCategory (UserID, CategoryID)
VALUES 
(1, 1), -- Alice Johnson with Phones
(1, 2), -- Alice Johnson with Laptops
(2, 3); -- Bob Smith with Headphones

-- Inserting UserItem Relations --
INSERT INTO UserItem (UserID, ItemID)
VALUES 
(1, 1), -- Alice Johnson with iPhone 14
(1, 3), -- Alice Johnson with MacBook Pro
(2, 6); -- Bob Smith with Sony WH-1000XM4

-- Inserting UserOrders Relations --
INSERT INTO UserOrders (UserID, OrderID)
VALUES 
(1, 1), -- Alice Johnson with Order 1
(2, 2); -- Bob Smith with Order 2


ALTER TABLE User MODIFY PasswordHash VARCHAR(255) NOT NULL;
