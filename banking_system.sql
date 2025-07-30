
DROP TABLE IF EXISTS AccountLedger;
DROP TABLE IF EXISTS BankAccount;
DROP TABLE IF EXISTS SecurityVerfication;
DROP TABLE IF EXISTS RoleAccess;

DROP TABLE IF EXISTS customer;


-- Customer Table - Danny 

CREATE TABLE Customer(
    CustomerID INTEGER AUTO_IgitNCREMENT PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
);

INSERT INTO Customer (CustomerID, username, password) VALUES
(1, 'bruhdy', 'test123'),
(2, 'Alux', 'pass456'),
(3, 'Donnyy', 'Word789');


-- Role Access Table - Alex 

CREATE TABLE RoleAccess(
    RoleID INTEGER AUTO_INCREMENT PRIMARY KEY,
    Rolename TEXT NOT NULL,
    RoleDescription TEXT NOT NULL,
    SecurityLevel INTEGER NOT NULL,
    RoleDepartment TEXT NOT NULL,
    RoleStatus TEXT NOT NULL CHECK (RoleStatus IN ('Active', 'Inactive'))
);

-- Security Verification Table - Alex 

CREATE TABLE SecurityVerfication(
    SecurityVerificationID INTEGER AUTO_INCREMENT PRIMARY KEY,
    SSN INTEGER NOT NULL UNIQUE, 
    Password TEXT NOT NULL, 
    SecurityPin INTEGER NOT NULL,
    AtmPin INTEGER NOT NULL,
    SecurityQuestion TEXT NOT NULL,
    SecurityAnswer TEXT NOT NULL,
    SecurityQuestion2 TEXT NOT NULL,
    SecurityAnswer2 TEXT NOT NULL,
    CustomerID INTEGER NOT NULL,
    RoleID INTEGER NOT NULL,

    FOREIGN KEY (CustomerID) REFERENCES customer(CustomerID),
    FOREIGN KEY (RoleID) REFERENCES RoleAccess(RoleID)
    );

-- Bank Account Table - Broudy 

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
    (5240, 4800, 5100, 'Savings', 1), -- 2 accounts for 1 user
    (250, 200.20, 135, 'Checkings', 2),
    (450, 1650, 2100, 'Savings', 3); 

-- Account Ledger Table - Broudy

CREATE TABLE AccountLedger (
    TransactionID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    TransactionAmount DECIMAL(8, 2) NOT NULL DEFAULT 0.0,
    TransactionType VARCHAR (10) CHECK (TransactionType IN ('Deposit', 'Withdrawal', 'Transfer')),
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
    
    (20, 'Deposit', '2025-07-02 8:46:29', 5120, 2),
    (30, 'Deposit', '2025-07-03 9:37:14', 5150, 2),
    (40, 'Deposit', '2025-07-03 11:04:36', 5190, 2),
    (50, 'Deposit', '2025-07-03 14:47:28', 5240, 2),
    
    (60, 'Deposit', '2025-07-03 8:26:19', 195, 3),
    (25, 'withdrawal', '2025-07-03 10:08:42', 170, 3),
    (100, 'deposit', '2025-07-03 10:09:17', 270, 3),
    (20, 'withdrawal', '2025-07-03 12:14:28', 250, 3),
    
    (700, 'Deposit', '2025-07-03 8:26:19', 1150, 4),
    (400, 'Deposit', '2025-07-03 10:08:42', 1550, 4),
    (200, 'Withdrawal', '2025-07-03 10:09:17', 1350, 4),
    (750, 'Deposit', '2025-07-03 12:14:28', 2100, 4);