CREATE SCHEMA InventoryMgt;

USE InventoryMgt;

-- TABLES --

CREATE TABLE Category(
    CategoryID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(30) NOT NULL,
    Quantity INT NOT NULL,
    IsAvailable BOOL NOT NULL,
    Description VARCHAR(100)
);

CREATE TABLE User(
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(30) NOT NULL,
    Email VARCHAR(30) NOT NULL UNIQUE,
    Telephone VARCHAR(15) NOT NULL,
    Username VARCHAR(30) NOT NULL UNIQUE,
    PasswordHash CHAR(64) NOT NULL,
    IsAdmin BOOL NOT NULL
);

CREATE TABLE Orders(
    OrderID INT AUTO_INCREMENT PRIMARY KEY,
    ClientName VARCHAR(30) NOT NULL,
    Date DATE NOT NULL,
    Quantity INT NOT NULL,
    Amount FLOAT NOT NULL
);

CREATE TABLE Item(
    ItemID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(30) NOT NULL,
    Brand VARCHAR(30) NOT NULL,
    Price FLOAT NOT NULL,
    Quantity INT NOT NULL,
    IsAvailable BOOL NOT NULL,
    Description VARCHAR(100),
    CategoryID INT,
    FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID)
);

CREATE TABLE OrderItem (
    OrderID INT,
    ItemID INT,
    Quantity INT NOT NULL,
    PRIMARY KEY (OrderID, ItemID),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
    FOREIGN KEY (ItemID) REFERENCES Item(ItemID)
);

CREATE TABLE UserCategory (
    UserID INT,
    CategoryID INT,
    PRIMARY KEY (UserID, CategoryID),
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID)
);

CREATE TABLE UserItem (
    UserID INT,
    ItemID INT,
    PRIMARY KEY (UserID, ItemID),
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (ItemID) REFERENCES Item(ItemID)
);

CREATE TABLE UserOrders (
    UserID INT,
    OrderID INT,
    PRIMARY KEY (UserID, OrderID),
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID)
);

-- SECURING PASSWORDS --
-- Ensure to use a secure method to hash passwords before inserting into the database.
-- Example using MySQL functions to simulate password hashing (but use a secure server-side hash in practice):

DELIMITER $$
CREATE TRIGGER before_insert_user
BEFORE INSERT ON User
FOR EACH ROW
BEGIN
    SET NEW.PasswordHash = SHA2(NEW.PasswordHash, 256);
END$$
DELIMITER ;

-- Note: In practice, use a server-side programming language to hash passwords before storing them in the database.


USE InventoryMgt;

-- Inserting Categories --
INSERT INTO Category (Name, Quantity, IsAvailable, Description)
VALUES 
('Phone', 100, TRUE, 'Smartphones and accessories'),
('Laptop', 50, TRUE, 'Laptops and accessories'),
('Headphone', 200, TRUE, 'Headphones and earphones');

-- Inserting Users --
-- Note: Passwords should be hashed using a secure method before insertion
INSERT INTO User (Name, Email, Telephone, Username, PasswordHash, IsAdmin)
VALUES 
('Alice Johnson', 'alice@example.com', '1234567890', 'alicej', SHA2('password123', 256), TRUE),
('Bob Smith', 'bob@example.com', '0987654321', 'bobsmith', SHA2('password456', 256), FALSE);

-- Inserting Items --
INSERT INTO Item (Name, Brand, Price, Quantity, IsAvailable, Description, CategoryID)
VALUES 
('iPhone 14', 'Apple', 999.99, 30, TRUE, 'Latest model smartphone', 1),
('Galaxy S21', 'Samsung', 799.99, 50, TRUE, 'High-end Android smartphone', 1),
('MacBook Pro', 'Apple', 1299.99, 20, TRUE, 'High-performance laptop', 2),
('Dell XPS 13', 'Dell', 999.99, 30, TRUE, 'Compact and powerful laptop', 2),
('AirPods Pro', 'Apple', 199.99, 100, TRUE, 'Wireless noise-canceling earbuds', 3),
('Sony WH-1000XM4', 'Sony', 299.99, 50, TRUE, 'Noise-canceling headphones', 3);

-- Inserting Orders --
INSERT INTO Orders (ClientName, Date, Quantity, Amount)
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
