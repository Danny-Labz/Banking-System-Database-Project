
# 💸 Transaction Banking System – Group Project

Welcome to the **Banking-System-Database-Project**!  
This repository contains a simple web-based transaction banking system built with HTML, PHP, and MySQL.

---

## 🧠 Tech Stack

- Frontend: HTML, CSS (optional JavaScript)
- Backend: PHP
- Database: MySQL (via phpMyAdmin)
- Server: XAMPP (Windows or Mac) / MAMP (Mac only)

---

## 🧠 Recommended Code Editors

We recommend using **Visual Studio Code** for this project:

- [Visual Studio Code (Free)](https://code.visualstudio.com/) – Works great for HTML, PHP, and MySQL. Lightweight and easy to use.

### Optional: IntelliJ or PhpStorm

If you already use JetBrains tools, here are options:

- [PhpStorm (Full PHP Support – Paid or Student License)](https://www.jetbrains.com/phpstorm/)
- [IntelliJ IDEA Ultimate (PHP Plugin Required)](https://www.jetbrains.com/idea/)  
  ⚠️ The free **Community Edition does not support PHP.

To use PHP in IntelliJ IDEA Ultimate:
1. Go to **Settings → Plugins → Marketplace**
2. Search for **PHP**, click **Install**
3. Restart the IDE

---

## 🍏 Mac Setup Instructions

You can use either **MAMP** or **XAMPP** on Mac. MAMP is simpler; XAMPP offers more flexibility.

- [MAMP for Mac](https://www.mamp.info/en/mac/)
- [XAMPP for Mac](https://www.apachefriends.org/index.html)

---

## 🖥 Windows Setup Instructions

Use [XAMPP for Windows](https://www.apachefriends.org/index.html) to run Apache, PHP, and MySQL locally.

1. Install XAMPP and open the Control Panel
2. Start **Apache** and **MySQL**
3. Move your project to `C:\xampp\htdocs\Banking-System-Database-Project\`
4. Visit `http://localhost/Banking-System-Database-Project/index.html`
5. Open `http://localhost/phpmyadmin`
6. Create the `banking_system` DB and run the SQL schema
7. Use this in `config.php`:

```php
<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // XAMPP default
$db = 'banking_system';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

---

## 🍏 Mac Users – Using XAMPP Instead of MAMP (Alternative Setup)

If you prefer XAMPP instead of MAMP on macOS, follow these steps:

### ✅ Required Downloads

- [XAMPP for macOS](https://www.apachefriends.org/index.html)

### 🛠 Setup Instructions

1. Install XAMPP and open the XAMPP Control Panel
2. Start **Apache** and **MySQL**
3. Move your project folder to:
   ```
   /Applications/XAMPP/xamppfiles/htdocs/
   ```
   You can do this using:
   ```bash
   mv ~/Documents/Banking-System-Database-Project /Applications/XAMPP/xamppfiles/htdocs/
   ```

4. Visit your project in the browser:
   ```
   http://localhost/Banking-System-Database-Project/index.html
   ```

5. Open **phpMyAdmin** via:
   ```
   http://localhost/phpmyadmin
   ```
   - Create the `banking_system` database
   - Run the SQL schema just like with MAMP

6. Update your `config.php` like this:

```php
<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // XAMPP default
$db = 'banking_system';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

XAMPP and MAMP offer the same core functionality. Just don’t run both at once since they share ports.

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
