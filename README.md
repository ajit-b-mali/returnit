# ReturnIt – Personal Lending Manager

![PHP](https://img.shields.io/badge/PHP-7.4-blue?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-blue?logo=mysql&logoColor=white)
![Sessions](https://img.shields.io/badge/Authentication-Sessions-green)

**ReturnIt** is a simple, secure web application to manage personal lending. It allows users to track **items lent** 🏠 and **money owed** 💰 in one dashboard. Built with **pure PHP, MySQL, and PHP sessions**, ReturnIt focuses on simplicity, security, and ease of use.

---

## Features (MVP)

- 🔐 **User Authentication:** Registration and login with secure password hashing
- 📦 **Item Tracking:** Add, edit, delete, and mark lent items as returned
- 💵 **Debt Tracking:** Add, edit, delete, and mark debts owed as paid
- 📊 **Dashboard Summary:** View total items lent and total money owed
- 👤 **User-Specific Data:** Each user only sees their own items and debts
- ✅ **Session-Based Authentication:** Simple and secure, no complex tokens needed

---

## Tech Stack

- 🖥 **Backend:** PHP + PDO + MySQL  
- 🌐 **Frontend:** Server-rendered HTML with minimal JS/AJAX  
- 🔑 **Authentication:** PHP sessions  
- 🗄 **Database:** MySQL / MariaDB  

---

## Project Structure (MVP)

- `index.php` – Login / Dashboard  
- `register.php` – User registration  
- `logout.php` – End session  
- `items/` – Add/Edit/Delete lent items  
- `debts/` – Add/Edit/Delete debts owed  
- `includes/` – Database connection, session handling  
- `assets/` – CSS & JS files  

---

## Installation

1. Clone the repository:  
   ```bash
   git clone https://github.com/<your-username>/returnit.git
