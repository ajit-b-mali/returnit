# ReturnIt - Personal Lending Manager 💸

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)

**ReturnIt** is a clean, secure, and modern web application to track personal loans and debts. It solves the problem of "Who has my power drill?" or "Who owes me lunch money?" with a minimalist dashboard.

## 🚀 Features

* **Secure Auth**: User registration/login with `password_hash` and Session management.
* **Dual Tracking**: Separate tabs for **Lent Items** 🏠 and **Money Owed** 💰.
* **Interactive UI**: Dark Mode 🌙, Quick Search, and Modal inputs.
* **Notifications**: Visual alerts for app updates.
* **Mobile Ready**: Fully responsive design using Tailwind CSS.

## 🛠️ Tech Stack

* **Frontend**: Tailwind CSS, Vanilla JS, FontAwesome.
* **Backend**: Native PHP 8.2 (No frameworks).
* **Database**: MySQL / MariaDB.
* **DevOps**: Docker & Apache via `.htaccess` routing.

## 📦 Installation (Localhost)

1.  **Clone the repo**
    ```bash
    git clone [https://github.com/yourusername/returnit.git](https://github.com/yourusername/returnit.git)
    cd returnit
    ```

2.  **Start with PHP built-in server**
    ```bash
    php -S localhost:8000 router.php
    ```

3.  **Database Setup**
    * Create a MySQL DB named `returnit_db`.
    * Import `db_schema.sql`.
    * Update `includes/config.php` with your credentials.

## 🐳 Installation (Docker)

```bash
docker build -t returnit-app .
docker run -p 8000:80 --env DB_HOST=host.docker.internal returnit-app
```

## 📸 Screenshots

*(Add a screenshot of your Dashboard here)*

---

<p align="center">Built by Ajit Mali.</p>
