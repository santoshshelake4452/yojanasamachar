# Yojana Samachar - Government Scheme Finder Web App

**Yojana Samachar** is a web application that helps users discover Indian government schemes based on their category (e.g., Student, Farmer, Worker, Women, Senior Citizen). The app provides detailed scheme information, application steps, required documents, and features like saving schemes, recent views, user profiles, and an admin panel for scheme management.

[![PHP](https://img.shields.io/badge/PHP-7.4+-green.svg)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-blue.svg)](https://www.mysql.com/)
[![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)

---

## 🌟 Features

### For Users
- **Scheme Finder**: Browse government schemes filtered by category (Student, Farmer, Worker, Women, Senior Citizen, etc.)
- **Scheme Details**: View complete information about each scheme including benefits, eligibility, and application process
- **Step-by-Step Guide**: Clear application steps for each scheme
- **Documents Checklist**: Required documents list for applications
- **Save Schemes**: Bookmark favorite schemes for later reference
- **Recent Views**: Automatically tracks recently viewed schemes
- **User Profile**: Manage personal information and saved schemes

### For Admins
- **Admin Panel**: Secure dashboard for scheme management
- **Add New Schemes**: Create and publish new government schemes
- **Edit/Delete Schemes**: Update or remove existing schemes
- **Category Management**: Add or modify scheme categories
- **User Management**: View and manage user accounts

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|------------|
| **Frontend** | HTML5, CSS3, JavaScript |
| **Backend** | PHP 7.4+ |
| **Database** | MySQL 5.7+ |
| **Server** | XAMPP (Apache + MySQL) |
| **Local Development** | Windows (XAMPP) |

---

## 📋 Prerequisites

- [XAMPP](https://www.apachefriends.org/) installed (includes Apache, MySQL, PHP)
- PHP 7.4 or higher
- MySQL 5.7 or higher
- A modern web browser (Chrome, Firefox, Edge, Safari)

---

## 🚀 Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/santoshshelake4452/yojanasamachar.git
cd yojanasamachar
```

### 2. Set Up XAMPP

1. Start **XAMPP Control Panel**
2. Start **Apache** and **MySQL** modules
3. Place the project folder in: `C:\xampp\htdocs\yojanasamachar`

### 3. Configure Database

1. Open **phpMyAdmin**: `http://localhost/phpmyadmin`
2. Create a new database named `yojanasamachar`
3. Import the SQL file:
   ```bash
   # Or via phpMyAdmin > Import > Choose setup.sql
   ```
4. Alternatively, run the SQL file directly:
   ```bash
   mysql -u root -p yojanasamachar < setup.sql
   ```

### 4. Configure Database Connection

Edit `config/database.php` (if exists) or update the database credentials in your PHP files:

```php
<?php
$host = 'localhost';
$username = 'root';
$password = ''; // Default XAMPP password is empty
$database = 'yojanasamachar';
?>
```

### 5. Access the Application

Open your browser and navigate to:

