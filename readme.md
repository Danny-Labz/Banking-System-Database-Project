
# 💸 Transaction Banking System – Group Project

Welcome to the **Banking-System-Database-Project**!  
This repository contains a simple web-based transaction banking system built with HTML, PHP, and MySQL.

---

## 🧠 Tech Stack

- Frontend: HTML, CSS (optional JavaScript)
- Backend: PHP
- Database: MySQL (via phpMyAdmin)
- Server: XAMPP (Windows) / MAMP (Mac)

---

## 🧠 Recommended Code Editors

We recommend using **Visual Studio Code** for this project:

- [Visual Studio Code (Free)](https://code.visualstudio.com/) – Works great for HTML, PHP, and MySQL. Lightweight and easy to use.

### Optional: IntelliJ or PhpStorm

If you already use JetBrains tools, here are options:

- [PhpStorm (Full PHP Support – Paid or Student License)](https://www.jetbrains.com/phpstorm/)  
  Built specifically for PHP development with built-in support for SQL, HTML, CSS, and JavaScript.

- [IntelliJ IDEA Ultimate (PHP Plugin Required)](https://www.jetbrains.com/idea/)  
  Full-featured IDE with PHP support **only** in the **Ultimate Edition**.  
  ⚠️ The free **Community Edition does not support PHP.**

To use PHP in IntelliJ IDEA Ultimate:
1. Go to **Settings → Plugins → Marketplace**
2. Search for **PHP**, click **Install**
3. Restart the IDE

---


## 🍏 Mac Setup Instructions

### ✅ Required Downloads

Install the following tools:

- [Git for Mac](https://git-scm.com/download/mac)
- [MAMP (Apache, PHP, MySQL)](https://www.mamp.info/en/mac/)
- [VS Code (Code Editor)](https://code.visualstudio.com/)
- [Composer (optional – for frameworks like CakePHP)](https://getcomposer.org/download/)

### 🔁 Clone the Project Repo

```bash
cd ~/Documents
git clone https://github.com/danny-labz/Banking-System-Database-Project.git
cd Banking-System-Database-Project
```

### ⚙️ Set Up MAMP & MySQL

1. Launch **MAMP.app**
2. Start the servers (Apache & MySQL)
3. Click "Open WebStart page" → click **phpMyAdmin**
4. Create a new database named: `banking_system`
5. In the SQL tab, run this script:

```sql
CREATE TABLE accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    balance DECIMAL(10,2) DEFAULT 0.00
);

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    from_account INT,
    to_account INT,
    amount DECIMAL(10,2),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (from_account) REFERENCES accounts(id),
    FOREIGN KEY (to_account) REFERENCES accounts(id)
);
```

### 🔑 Configure Database Connection (`config.php`)

```php
<?php
$host = 'localhost';
$user = 'root';
$pass = 'root'; // Default for MAMP
$db = 'banking_system';
$conn = new mysqli($host, $user, $pass, $db);
?>
```

### 🚀 Run the Project

1. Move the project folder to MAMP's root directory:
   `/Applications/MAMP/htdocs/Banking-System-Database-Project/`
2. Visit in browser:
   `http://localhost:8888/Banking-System-Database-Project/index.html`


---


## 🖥 Windows Setup Instructions

### ✅ Required Downloads

Install the following tools:

- [Git for Windows](https://git-scm.com/download/win)
- [XAMPP (Apache, PHP, MySQL)](https://www.apachefriends.org/index.html)
- [VS Code (Code Editor)](https://code.visualstudio.com/)
- [Composer (optional – for CakePHP)](https://getcomposer.org/download/)

### 🔁 Clone the Project Repo

```bash
cd C:\Users\YourName\Documents
git clone https://github.com/danny-labz/Banking-System-Database-Project.git
cd Banking-System-Database-Project
```

### ⚙️ Set Up XAMPP & MySQL

1. Open the **XAMPP Control Panel**
2. Start **Apache** and **MySQL**
3. Click **Admin** next to MySQL → opens **phpMyAdmin**
4. Create a new database named: `banking_system`
5. Run the following SQL in the SQL tab:

```sql
CREATE TABLE accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    balance DECIMAL(10,2) DEFAULT 0.00
);

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    from_account INT,
    to_account INT,
    amount DECIMAL(10,2),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (from_account) REFERENCES accounts(id),
    FOREIGN KEY (to_account) REFERENCES accounts(id)
);
```

### 🔑 Configure Database Connection (`config.php`)

```php
<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // Default for XAMPP is blank
$db = 'banking_system';
$conn = new mysqli($host, $user, $pass, $db);
?>
```

### 🚀 Run the Project

1. Move the project folder into:
   `C:\xampp\htdocs\Banking-System-Database-Project\`
2. Open browser and go to:
   `http://localhost/Banking-System-Database-Project/index.html`


---

## 👥 Collaboration Workflow

### 1. Clone the repository (do this once):
```bash
git clone https://github.com/danny-labz/Banking-System-Database-Project.git
cd Banking-System-Database-Project
```

### 2. Create a new branch (optional but recommended):
```bash
git checkout -b feature/your-feature-name
```

### 3. Make your changes locally

### 4. Stage, commit, and push:
```bash
git add .
git commit -m "Add your changes"
git push origin main
```

### 5. Pull latest updates before each coding session:
```bash
git pull origin main
```

---

Happy coding! 🚀
