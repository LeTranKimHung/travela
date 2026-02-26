# 🌏 Travela - Travel Management System

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![Gemini AI](https://img.shields.io/badge/Gemini%20AI-Integration-blue?style=for-the-badge&logo=google-gemini&logoColor=white)

A comprehensive travel tour booking management system built on Laravel Framework, integrated with Artificial Intelligence (AI).

[Features](#-features) •
[Installation](#-installation) •
[Usage](#-usage) •
[Tech Stack](#-tech-stack)

</div>

---

## 📋 Table of Contents

- [Introduction](#-introduction)
- [Key Features](#-key-features)
- [Tech Stack](#-tech-stack)
- [System Requirements](#-system-requirements)
- [Installation](#-installation)
- [Project Structure](#-project-structure)
- [Contact](#-contact)

---

## 🎯 Introduction

**Travela** is a modern web application for managing travel tours, developed using the Laravel Framework. The system provides complete features for both customers and administrators, helping to optimize the tour booking process and business management for travel companies.

Specifically, the system is integrated with **Gemini AI** to support customers by answering tour-related inquiries intelligently and automatically.

---

## 🚀 Key Features

### 🤖 Artificial Intelligence Integration (Gemini AI)
- **Smart Chatbot**: Automatically responds to customer questions based on available tour data.
- **24/7 Support**: Provides immediate assistance to customers without needing staff online.
- **Contextual Awareness**: The AI understands current tour data to provide the most accurate suggestions.

### 👨‍💼 Administrator (Admin Panel)
- **Statistics Dashboard**: Overview of revenue and order counts with intuitive charts.
- **Tour Management**: Add/Edit/Delete tours, manage detailed itineraries, and pricing.
- **Order Management**: Track booking status and approve/cancel orders.
- **Email System**: Automatically sends confirmation emails to customers when orders are approved.
- **Blog Management**: Post travel news with support for custom author names for each post.
- **Access Control**: Manage users and system access permissions.

### 👥 Customer Portal
- **Smart Search**: Find tours by destination, time, and price.
- **Online Booking**: Simple and fast tour booking process.
- **Account Management**: Track booking history and update personal information.
- **Interaction**: Chat directly with the AI assistant for travel advice.

---

## 🛠 Tech Stack

### Backend
```
🔹 Laravel 12.x         - Modern PHP Framework
🔹 MySQL 8.0              - Database Management System
🔹 Google Gemini API      - Next-generation AI
🔹 Mailtrap/SMTP          - Automated email delivery system
```

### Frontend
```
🔹 Blade Template         - PHP Template Engine
🔹 Bootstrap 5.3          - CSS Framework for Responsive Design
🔹 JavaScript (ES6+)      - Interactive feature handling
🔹 FontAwesome 6          - Diverse icon library
```

---

## 💻 System Requirements

| Requirement | Version |
|------------|---------|
| PHP | ≥ 8.2 |
| Composer | ≥ 2.5 |
| MySQL | ≥ 8.0 |
| Node.js | ≥ 18.x |

---

## 📦 Installation

### Step 1: Clone the Repository

```bash
git clone https://github.com/LeTranKimHung/travela.git
cd travela
```

### Step 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### Step 3: Environment Configuration

```bash
# Create .env file from example
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Database & API Configuration

Open the `.env` file and update your database information along with the Gemini API Key:

```env
DB_DATABASE=travel
DB_USERNAME=root
DB_PASSWORD=your_password

# Gemini AI Configuration
GEMINI_API_KEY=your_gemini_api_key_here

# Mail Configuration (for booking notifications)
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
```

### Step 5: Run Migrations

```bash
php artisan migrate
```

### Step 6: Start the Application

```bash
# Start Laravel server
php artisan serve

# Build assets (Vite)
npm run dev
```

🎉 Access the application at: **http://127.0.0.1:8000**

---

## 📂 Project Structure

```
travela/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Admin-side management
│   │   └── Clients/         # Customer-side logic (includes AI ChatController)
│   ├── Mail/               # Email handling classes
│   └── Models/             # Database Models
├── database/               # Migrations and Seeders
├── resources/
│   ├── views/              # Blade Templates (Admin & Client)
│   └── lang/               # Localization (if any)
├── routes/
│   └── web.php             # Application route declarations
└── .env                    # Sensitive configuration storage
```

---

## 📞 Contact

**Author:** Le Tran Kim Hung

- 📧 Email: hungltk2004@gmail.com
- 🐙 GitHub: [LeTranKimHung](https://github.com/LeTranKimHung)

---

<div align="center">

**⭐ If you find this project useful, please give it a star! ⭐**

Made with ❤️ by [Le Tran Kim Hung](https://github.com/LeTranKimHung)

</div>
