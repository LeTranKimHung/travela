<div align="center">

# 🌏 Travela

### Travel Tour Booking & Management System

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=flat-square&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![Gemini AI](https://img.shields.io/badge/Gemini_AI-Integrated-4285F4?style=flat-square&logo=google&logoColor=white)](https://ai.google.dev)

*A modern travel tour booking platform built with Laravel, powered by Gemini AI.*

[🚀 Live Demo](http://travela.gt.tc/) · [🐛 Report Bug](https://github.com/LeTranKimHung/travela/issues) · [💡 Request Feature](https://github.com/LeTranKimHung/travela/issues)

</div>

---

## 📋 Table of Contents

- [About The Project](#-about-the-project)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Getting Started](#-getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Project Structure](#-project-structure)
- [Screenshots](#-screenshots)
- [Contact](#-contact)

---

## 🎯 About The Project

**Travela** is a full-featured web application for managing travel tours, built on **Laravel 12**. It serves both customers and administrators, streamlining the booking process and day-to-day operations for travel businesses.

The standout feature is the **Gemini AI** integration — an intelligent chatbot that supports customers around the clock, answering inquiries based on real-time tour data without requiring staff to be online.

---

## ✨ Features

### 🤖 AI Integration — Gemini

| Feature | Description |
|---------|-------------|
| Smart Chatbot | Automatically answers customer questions based on available tour data |
| 24/7 Support | Always available — no staff required to be online |
| Contextual Awareness | Understands current tour data to deliver the most accurate recommendations |

### 👨‍💼 Admin Panel

- **Statistics Dashboard** — Visual charts for revenue tracking and order summaries
- **Tour Management** — Create, edit, and delete tours with detailed itineraries and pricing
- **Order Management** — Monitor booking status; approve or cancel orders with ease
- **Email Notifications** — Automatically sends confirmation emails upon order approval
- **Blog Management** — Publish travel news and articles with custom author names per post
- **Access Control** — Manage user accounts and system permissions

### 👥 Customer Portal

- **Smart Search** — Filter tours by destination, date, and price range
- **Online Booking** — Simple and fast tour reservation flow
- **Account Management** — View booking history and update personal information
- **AI Chat** — Talk directly with the AI assistant for personalized travel advice

---

## 🛠 Tech Stack

| Layer | Technology |
|-------|------------|
| Framework | Laravel 12.x |
| Language | PHP 8.2+, JavaScript ES6+ |
| Templating | Blade (35.8%) |
| Styling | SCSS / Bootstrap 5.3 (22.4% + 12.7%) |
| Database | MySQL 8.0 |
| AI | Google Gemini API |
| Email | Mailtrap / SMTP |
| Icons | FontAwesome 6 |

---

## 🚀 Getting Started

### Prerequisites

Make sure you have the following installed:

| Tool | Version |
|------|---------|
| PHP | ≥ 8.2 |
| Composer | ≥ 2.5 |
| MySQL | ≥ 8.0 |
| Node.js | ≥ 18.x |

### Installation

**1. Clone the repository**

```bash
git clone https://github.com/LeTranKimHung/travela.git
cd travela
```

**2. Install dependencies**

```bash
composer install
npm install
```

**3. Set up environment**

```bash
cp .env.example .env
php artisan key:generate
```

**4. Configure `.env`**

```env
# Database
DB_DATABASE=travel
DB_USERNAME=root
DB_PASSWORD=your_password

# Gemini AI
GEMINI_API_KEY=your_gemini_api_key_here

# Mail
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
```

> 💡 Get your Gemini API Key at [Google AI Studio](https://aistudio.google.com/app/apikey) — it's free.

**5. Run migrations**

```bash
php artisan migrate
```

**6. Start the application**

```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

Visit **[[http://travela.gt.tc/](http://travela.gt.tc/)]** 🎉

---

## 📂 Project Structure

```
travela/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Admin/          # Admin-side controllers
│   │       └── Clients/        # Customer-side controllers (incl. AI ChatController)
│   ├── Mail/                   # Mailable classes for email notifications
│   └── Models/                 # Eloquent models
├── bootstrap/                  # App bootstrap & cached files
├── database/
│   ├── migrations/             # Database schema definitions
│   └── seeders/                # Sample data seeders
├── docs/
│   └── images/                 # Documentation screenshots
├── public/                     # Publicly accessible assets
├── resources/
│   ├── views/                  # Blade templates (Admin & Client)
│   └── lang/                   # Localization files
├── routes/
│   └── web.php                 # Application route definitions
├── storage/                    # Logs, cache, uploaded files
└── .env.example                # Environment variable template
```


## 📬 Contact

**Author:** Le Tran Kim Hung

[![Email](https://img.shields.io/badge/Email-hungltk2004%40gmail.com-EA4335?style=flat-square&logo=gmail&logoColor=white)](mailto:hungltk2004@gmail.com)
[![GitHub](https://img.shields.io/badge/GitHub-LeTranKimHung-181717?style=flat-square&logo=github&logoColor=white)](https://github.com/LeTranKimHung)

---

<div align="center">

If you find this project helpful, please give it a ⭐ — it means a lot!

*Made with ❤️ by [Le Tran Kim Hung](https://github.com/LeTranKimHung)*

</div>
