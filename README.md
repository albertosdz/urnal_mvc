# URNAL_MVC

> **Streamline Your Tasks, Unleash Your Productivity Power**

![Last Commit](https://img.shields.io/github/last-commit/albertosdz/urnal_mvc?style=flat-square)
![Languages](https://img.shields.io/github/languages/count/albertosdz/urnal_mvc?style=flat-square)
![Top Language](https://img.shields.io/github/languages/top/albertosdz/urnal_mvc?style=flat-square)
![PHP](https://img.shields.io/badge/Made%20with-PHP-8892BF?style=flat-square&logo=php)

---

## 🚀 Overview

**Urnal_mvc** is a powerful PHP-based MVC framework designed to simplify the development of task management applications. It provides a structured architecture with custom routing, controllers, views, and models—making your codebase scalable and maintainable.

### 🔥 Why Urnal_mvc?

This project empowers developers to build robust and modern project management tools.

**Core Features:**
- ⚙️ **Routing & MVC Architecture**: Clean separation of concerns with controllers and views.
- 🎯 **Asset Automation**: Gulp tasks for SCSS compilation and JS minification.
- 🔐 **User Authentication**: Secure login, registration, password reset, and profile handling.
- 📋 **Project & Task Management**: Create and manage projects with a modern UI.
- ✉️ **Email Integration**: Notifications for account confirmation and password recovery.
- 📦 **Scalable Codebase**: Modular design with reusable components.

---

## 📚 Table of Contents

- [Overview](#-overview)
- [Getting Started](#-getting-started)
- [Prerequisites](#-prerequisites)
- [Installation](#-installation)
- [Usage](#-usage)
- [Development](#-development)
- [License](#-license)
- [Author](#-author)

---

## 🧰 Getting Started

### ✅ Prerequisites

Make sure you have the following installed:

- **PHP** 7.4 or higher
- **Composer** (PHP package manager)
- **Node.js** (v14 or higher) and **npm**
- A **web server** (Apache/Nginx) with PHP support
- **MySQL** or compatible database

---

## ⚙️ Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/albertosdz/urnal_mvc.git
   cd urnal_mvc
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. **Configure environment variables**:
   Copy the `.env.example` file and rename it to `.env`:
   ```bash
   cp .env.example .env
   ```
   
   Edit the `.env` file and configure your settings:
   ```bash
   # Database configuration
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=urnal_mvc
   DB_USERNAME=root
   DB_PASSWORD=your_password
   
   # Email configuration (for Gmail)
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your_email@gmail.com
   MAIL_PASSWORD=your_app_password
   
   # Application configuration
   APP_NAME=Urnal
   APP_ENV=development
   APP_DEBUG=true
   APP_URL=http://localhost:3000
   APP_TIMEZONE=Europe/Madrid
   ```

4. Install Node.js dependencies:
   ```bash
   npm install
   ```

5. Build frontend assets:
   ```bash
   npm start
   ```
   Or directly with Gulp:
   ```bash
   gulp
   ```

6. Set up your database (create the database specified in `.env`):
   ```sql
   CREATE DATABASE urnal_mvc;
   ```

7. Configure your web server to use the `public` directory as the document root.
   ```bash
   php {entrypoint} 
   ```
   For Example:
   ```bash
   php -S localhost:3000 -t public
   ```

---

## 🚀 Usage

1. Start your web server and make sure PHP is running.

2. For development with asset auto-compilation:
   ```bash
   npm run dev
   ```

3. Open your browser at `http://localhost` or your configured virtual host.

---

## 📋 Environment Variables

### Database Configuration
- `DB_HOST`: Database host (default: localhost)
- `DB_PORT`: Database port (default: 3306)
- `DB_DATABASE`: Database name
- `DB_USERNAME`: Database username
- `DB_PASSWORD`: Database password

### Email Configuration
- `MAIL_HOST`: SMTP server host
- `MAIL_PORT`: SMTP server port
- `MAIL_USERNAME`: Email username
- `MAIL_PASSWORD`: Email password (use app passwords for Gmail)

### Application Configuration
- `APP_NAME`: Application name
- `APP_ENV`: Environment (development, production)
- `APP_DEBUG`: Enable/disable debug mode (true/false)
- `APP_URL`: Base URL of the application
- `APP_TIMEZONE`: Application timezone

**Important**: Never commit your `.env` file to version control. The `.env.example` file should be used as a template.

---

## 🧑‍💻 Development

To watch for changes and rebuild assets automatically:
```bash
gulp watch
```
