DROP TABLE IF EXISTS AccountLedger;
DROP TABLE IF EXISTS BankAccount;
DROP TABLE IF EXISTS SecurityVerification;
DROP TABLE IF EXISTS RoleAccess;
DROP TABLE IF EXISTS Customer;
DROP TABLE IF EXISTS Branch;

-- Customer Table
CREATE TABLE Customer (
    CustomerID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    DateOfBirth DATE NOT NULL,
    SSN CHAR(11) UNIQUE NOT NULL,
    Email VARCHAR(100) UNIQUE,
    PhoneNumber CHAR(10),
    Address VARCHAR(200),
    RoleAccess TINYINT DEFAULT 1,  -- 1 = viewer, 2 = admin
    LastUpdated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO Customer (
    FirstName, LastName, DateOfBirth, SSN, Email, PhoneNumber, Address, RoleAccess
) VALUES
('Bruhdy', 'Bro', '1980-04-15', '116-82-3563', 'Bruhdy.Bro@email.com', '3053612233', '101 Ocean Blvd', 2),
('Danny', 'Labz', '1992-08-05', '112-39-4451', 'Danny.Labz@email.com', '3052222344', '202 Pine Street', 1),
('Mike', 'GitA', '1985-01-22', '331-45-9913', 'Mike.GitA@email.com', '3053334115', '303 Palm Avenue', 2),
('Nicholas', 'Rivera', '1979-12-11', '421-50-6236', 'nicholas.rivera@email.com', '3054445226', '404 Maple Drive', 1),
('Jesse', 'Lopez', '1990-07-30', '532-66-7759', 'jessica.lopez@email.com', '3055556627', '505 Elm Street', 1);

-- RoleAccess Table (required by SecurityVerification)
CREATE TABLE RoleAccess (
    RoleID INT AUTO_INCREMENT PRIMARY KEY,
    RoleName VARCHAR(50),
    RoleDescription TEXT
);

INSERT INTO RoleAccess (RoleName, RoleDescription) VALUES
('Admin', 'Full access'),
('Viewer', 'Read-only access');

-- Security Verification Table
CREATE TABLE SecurityVerification (
    SecurityVerificationID INTEGER AUTO_INCREMENT PRIMARY KEY,
    SSN INTEGER NOT NULL UNIQUE, 
    Username VARCHAR(100) NOT NULL,
    Password VARCHAR(255) NOT NULL, 
    SecurityPin INTEGER NOT NULL,
    AtmPin INTEGER NOT NULL,
    SecurityQuestion VARCHAR(255) NOT NULL,
    SecurityAnswer VARCHAR(255) NOT NULL,
    SecurityQuestion2 VARCHAR(255) NOT NULL,
    SecurityAnswer2 VARCHAR(255) NOT NULL,
    CustomerID INTEGER NOT NULL,
    RoleID INTEGER NOT NULL,
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID),
    FOREIGN KEY (RoleID) REFERENCES RoleAccess(RoleID)
);

INSERT INTO SecurityVerification (
    SSN, Username, Password, SecurityPin, AtmPin, SecurityQuestion, SecurityAnswer, 
    SecurityQuestion2, SecurityAnswer2, CustomerID, RoleID
) VALUES
(123, 'Bruhdy', 'letMeIn', 456, 789, 'School?', 'FIU', 'Favorite Color?', 'Blue', 1, 1),
(246, 'Danny', 'Passing', 357, 101, 'School?', 'FIU', 'Favorite Color?', 'Red', 2, 2),
(987, 'Mikky', 'Codez', 654, 321, 'School?', 'FIU', 'Favorite Color?', 'Green', 3, 2);

-- Bank Account Table
CREATE TABLE BankAccount (
    AccountID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Balance DECIMAL (12, 2) NOT NULL,
    AverageBalance DECIMAL (12, 2),
    OpeningBalance DECIMAL (12, 2),
    AccountType VARCHAR (15) NOT NULL CHECK (AccountType IN ('Savings', 'Checkings', 'Money Market', 'CD')),
    CustomerID INT NOT NULL,
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID)
);

INSERT INTO BankAccount (Balance, AverageBalance, OpeningBalance, AccountType, CustomerID)
VALUES
(90, 110.20, 120.96, 'Checkings', 1), 
(5240, 4800, 5100, 'Savings', 1),
(250, 200.20, 135, 'Checkings', 2),
(450, 1650, 2100, 'Savings', 3);

-- Account Ledger Table
CREATE TABLE AccountLedger (
    TransactionID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    TransactionAmount DECIMAL(8, 2) NOT NULL DEFAULT 0.0,
    TransactionType VARCHAR(10) NOT NULL CHECK (TransactionType IN ('Deposit', 'Withdrawal', 'Transfer')),
    TransactionTime DATETIME,
    RunningBalance DECIMAL (12, 2) NOT NULL,
    AccountID INT UNSIGNED NOT NULL,
    FOREIGN KEY (AccountID) REFERENCES BankAccount(AccountID)
);

INSERT INTO AccountLedger (TransactionAmount, TransactionType, TransactionTime, RunningBalance, AccountID)
VALUES
(10, 'Withdrawal', '2025-07-03 12:50:48', 110.96, 1),
(5.96, 'Withdrawal', '2025-07-03 13:26:12', 105, 1),
(5, 'Deposit', '2025-07-03 13:28:50', 110, 1),
(20, 'Withdrawal', '2025-07-03 14:52:28', 90, 1),

(20, 'Deposit', '2025-07-02 08:46:29', 5120, 2),
(30, 'Deposit', '2025-07-03 09:37:14', 5150, 2),
(40, 'Deposit', '2025-07-03 11:04:36', 5190, 2),
(50, 'Deposit', '2025-07-03 14:47:28', 5240, 2),

(60, 'Deposit', '2025-07-03 08:26:19', 195, 3),
(25, 'Withdrawal', '2025-07-03 10:08:42', 170, 3),
(100, 'Deposit', '2025-07-03 10:09:17', 270, 3),
(20, 'Withdrawal', '2025-07-03 12:14:28', 250, 3),

(700, 'Deposit', '2025-07-03 08:26:19', 1150, 4),
(400, 'Deposit', '2025-07-03 10:08:42', 1550, 4),
(200, 'Withdrawal', '2025-07-03 10:09:17', 1350, 4),
(750, 'Deposit', '2025-07-03 12:14:28', 2100, 4);

-- Branch Table
CREATE TABLE Branch (
    BranchID INT PRIMARY KEY,
    AssignedBankerID INT,
    Address VARCHAR(255),
    PhoneNumber VARCHAR(20)
);

INSERT INTO Branch (BranchID, AssignedBankerID, Address, PhoneNumber) VALUES
(1, 101, '123 Elm Street, Miami, FL 33101', '(305) 555-1234'),
(2, 102, '456 Oak Avenue, Orlando, FL 32801', '(407) 555-5678'),
(3, 103, '789 Pine Road, Tampa, FL 33602', '(813) 555-9012'),
(4, 104, '321 Maple Blvd, Jacksonville, FL 32202', '(904) 555-3456'),
(5, 105, '654 Cedar Lane, Fort Lauderdale, FL 33301', '(954) 555-7890'),
(6, 106, '147 Palm Ave, Hialeah, FL 33010', '(786) 555-1122'),
(7, 107, '258 Beach St, St. Petersburg, FL 33701', '(727) 555-3344'),
(8, 108, '369 Coral Way, Naples, FL 34102', '(239) 555-5566'),
(9, 109, '951 Sunset Dr, Tallahassee, FL 32301', '(850) 555-7788'),
(10, 110, '753 Ocean Blvd, Sarasota, FL 34236', '(941) 555-9900');
