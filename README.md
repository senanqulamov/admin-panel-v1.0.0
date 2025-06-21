# Admin Panel v1.0.0 (Beta)
#### Refactoring and Enhancements from v0.1.0 (php 7.1 , Laravel 8) to v1.0.0 (php 8.4 , Laravel 12)

[![PHP Version](https://img.shields.io/badge/PHP-8.4-blue.svg)](https://php.net)
[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

## 📌 Version History

- **v1.0.0 (Current)**: PHP 8.4 | Laravel 12.x | Refactored structure and enhanced security
- **v0.1.0 (Legacy)**: PHP 7.1 | Laravel 8.x | Initial prototype version

> 🛠️ **Status**: Beta Release

---

## 📖 Introduction

**Admin Panel v1.0.0** is a fully featured, modern administrative dashboard tailored for efficient content, user, and system configuration management. Refactored from the legacy version, this build offers improved code structure, modernized components, and full compatibility with the latest PHP and Laravel versions.

---

## 🚀 Key Features

### 🔐 Access Control
- User & admin login
- Role-based permissions
- Status and activity management

### 🧩 Modular Structure
- Organized namespaces (`Admin`, `User`, `Language`, etc.)
- Custom middleware for cleaner request handling
- CKFinder integration for file management

### 📊 Data Insights
- AJAX-powered search & sorting
- Language group management
- System analytics (planned)

### 🌐 Localization
- Multi-language support
- Dynamic phrase & group editing
- Language-based routing

### ⚙️ Settings Panel
- Icon search
- System-wide configuration options
- Toggle options and real-time updates

---

## 🧰 Tech Stack

- **Framework**: Laravel 12
- **Language**: PHP 8.4
- **Frontend**: Blade, Bootstrap
- **Database**: MySQL
- **Utilities**: CKEditor, CKFinder, jQuery

---

## ⚡ Quick Start

```bash
# 1. Clone the repository
git clone https://github.com/senanqulamov/admin-panel-v1.0.0.git
cd admin-panel-v1.0.0

# 2. Install dependencies
composer install
npm install && npm run dev

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Setup database
php artisan migrate --seed

# 5. Start development server
php artisan serve
```

---

### ✅ Summary of Improvements:
- Better visual hierarchy (emojis + headers)
- Consistent tone and formatting
- Clear roadmap and project scope
- Optional `Project Structure` and `Testing` sections for clarity

Let me know if you'd like a minimal version too, or auto-generate the docs section with code!

---

## Contributing

Contributions are welcome! Fork the repository, create a feature branch, commit your changes, and submit a pull request. Please adhere to our coding standards and include tests when necessary.

---

## License
This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).


> #### `©2025 [Senan Qulamov] All rights reserved.`



