DROP TABLE IF EXISTS Customer;

CREATE TABLE Customer (
    CustomerID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    DateOfBirth DATE NOT NULL,
    SSN CHAR(11) UNIQUE NOT NULL,
    Email VARCHAR(100) UNIQUE,
    PhoneNumber CHAR(10),
    Address VARCHAR(200),
    RoleAccess TINYINT DEFAULT 1,  -- 1 = viewer, 2 = editor, 3 = admin
    LastUpdated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO Customer (
    FirstName, LastName, DateOfBirth, SSN, Email, PhoneNumber, Address, RoleAccess
) VALUES
('Bill', 'Turner', '1980-04-15', '116-82-3563', 'bill.turner@email.com', '3053612233', '101 Ocean Blvd', 2),
('Leo', 'Nguyen', '1992-08-05', '112-39-4451', 'leo.nguyen@email.com', '3052222344', '202 Pine Street', 1),
('Sarah', 'Kim', '1985-01-22', '331-45-9913', 'sarah.kim@email.com', '3053334115', '303 Palm Avenue', 2),
('Nicholas', 'Rivera', '1979-12-11', '421-50-6236', 'nicholas.rivera@email.com', '3054445226', '404 Maple Drive', 3),
('Jessica', 'Lopez', '1990-07-30', '532-66-7759', 'jessica.lopez@email.com', '3055556627', '505 Elm Street', 1);
