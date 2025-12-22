# 🌏 Hệ Thống Quản Lý Tour Du Lịch

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

Hệ thống quản lý đặt tour du lịch toàn diện được xây dựng trên Laravel Framework

[Tính Năng](#-tính-năng) •
[Cài Đặt](#-cài-đặt) •
[Sử Dụng](#-sử-dụng) •
[Đóng Góp](#-đóng-góp)

</div>

---

## 📋 Mục Lục

- [Giới Thiệu](#-giới-thiệu)
- [Tính Năng](#-tính-năng)
- [Công Nghệ](#-công-nghệ-sử-dụng)
- [Yêu Cầu Hệ Thống](#-yêu-cầu-hệ-thống)
- [Cài Đặt](#-cài-đặt)
- [Cấu Trúc Dự Án](#-cấu-trúc-dự-án)
- [Sử Dụng](#-sử-dụng)
- [API Documentation](#-api-documentation)
- [Screenshots](#-screenshots)
- [Đóng Góp](#-đóng-góp)
- [License](#-license)
- [Liên Hệ](#-liên-hệ)

---

## 🎯 Giới Thiệu

**Travel Management System** là một ứng dụng web quản lý tour du lịch hiện đại, được phát triển bằng Laravel Framework. Hệ thống cung cấp đầy đủ các tính năng cho cả khách hàng và quản trị viên, từ việc tìm kiếm và đặt tour đến quản lý đơn hàng và thống kê doanh thu.

### 🎨 Đặc Điểm Nổi Bật

- ✅ Giao diện thân thiện, responsive trên mọi thiết bị
- ✅ Hệ thống phân quyền rõ ràng và bảo mật
- ✅ Tích hợp thanh toán trực tuyến
- ✅ Dashboard thống kê trực quan
- ✅ Tìm kiếm và lọc tour thông minh

---

## 🚀 Tính Năng

### 👨‍💼 Phân Hệ Quản Trị (Admin)

<table>
<tr>
<td width="50%">

#### 📊 Dashboard
- Thống kê tổng quan số lượng tour
- Báo cáo doanh thu theo thời gian
- Biểu đồ số lượng đơn hàng
- Danh sách đơn hàng gần đây

</td>
<td width="50%">

#### 🗺️ Quản Lý Tour
- Thêm/Sửa/Xóa tour du lịch
- Upload hình ảnh tour
- Quản lý giá và khuyến mãi
- Cập nhật lịch trình chi tiết

</td>
</tr>
<tr>
<td width="50%">

#### 📦 Quản Lý Đơn Hàng
- Theo dõi trạng thái booking
- Xác nhận/Hủy đơn hàng
- Cập nhật trạng thái thanh toán
- Xuất báo cáo đơn hàng

</td>
<td width="50%">

#### 🔐 Phân Quyền
- Middleware bảo mật
- Quản lý vai trò người dùng
- Kiểm soát truy cập admin
- Log hoạt động hệ thống

</td>
</tr>
</table>

### 👥 Phân Hệ Khách Hàng

<table>
<tr>
<td width="50%">

#### 🔍 Tìm Kiếm & Xem Tour
- Danh sách tour phong phú
- Tìm kiếm theo điểm đến
- Lọc theo giá, thời gian
- Xem chi tiết tour và đánh giá

</td>
<td width="50%">

#### 🎫 Đặt Tour
- Quy trình đặt tour đơn giản
- Thanh toán trực tuyến an toàn
- Xác nhận booking qua email
- Theo dõi trạng thái đơn hàng

</td>
</tr>
<tr>
<td colspan="2">

#### 👤 Tài Khoản Cá Nhân
- Đăng ký/Đăng nhập dễ dàng
- Quản lý thông tin cá nhân
- Lịch sử đặt tour
- Đổi mật khẩu và cài đặt

</td>
</tr>
</table>

---

## 🛠 Công Nghệ Sử Dụng

### Backend
```
🔹 Laravel 10.x / 11.x    - PHP Framework
🔹 MySQL 8.0              - Database Management
🔹 Eloquent ORM           - Database Interaction
🔹 Laravel Auth           - Authentication System
```

### Frontend
```
🔹 Blade Template         - Template Engine
🔹 Bootstrap 5.3          - CSS Framework
🔹 FontAwesome 6          - Icon Library
🔹 JavaScript (ES6+)      - Interactive Features
🔹 jQuery                 - DOM Manipulation
```

### Tools & Libraries
```
🔹 Composer               - PHP Dependency Manager
🔹 NPM                    - Node Package Manager
🔹 Git                    - Version Control
🔹 PHPUnit                - Testing Framework
```

---

## 💻 Yêu Cầu Hệ Thống

Đảm bảo máy tính của bạn đáp ứng các yêu cầu sau:

| Requirement | Version |
|------------|---------|
| PHP | ≥ 8.1 |
| Composer | ≥ 2.5 |
| MySQL | ≥ 8.0 |
| Node.js | ≥ 18.x |
| NPM | ≥ 9.x |

### Extensions PHP Cần Thiết
```
✓ BCMath
✓ Ctype
✓ Fileinfo
✓ JSON
✓ Mbstring
✓ OpenSSL
✓ PDO
✓ Tokenizer
✓ XML
```

---

## 📦 Cài Đặt

### Bước 1: Clone Repository

```bash
git clone https://github.com/username/travel-management-system.git
cd travel-management-system
```

### Bước 2: Cài Đặt Dependencies

```bash
# Cài đặt PHP dependencies
composer install

# Cài đặt Node dependencies
npm install
```

### Bước 3: Cấu Hình Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Bước 4: Cấu Hình Database

Mở file `.env` và cập nhật thông tin database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travel_management
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Bước 5: Chạy Migration & Seeder

```bash
# Tạo database schema
php artisan migrate

# Seed dữ liệu mẫu (optional)
php artisan db:seed
```

### Bước 6: Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### Bước 7: Khởi Động Server

```bash
php artisan serve
```

🎉 Truy cập ứng dụng tại: **http://127.0.0.1:8000**

### 🔑 Tài Khoản Mặc Định

**Admin:**
- Email: `admin@travel.com`
- Password: `admin123`

**User:**
- Email: `user@travel.com`
- Password: `user123`

---

## 📂 Cấu Trúc Dự Án

```
travel-management-system/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin controllers
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── TourController.php
│   │   │   │   └── BookingController.php
│   │   │   ├── AuthController.php
│   │   │   ├── HomeController.php
│   │   │   └── TourController.php
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php  # Admin authorization
│   │   └── Requests/
│   ├── Models/
│   │   ├── User.php            # User model (tbl_user)
│   │   ├── Tour.php
│   │   ├── Booking.php
│   │   └── Payment.php
│   └── Services/               # Business logic
├── config/
│   ├── database.php
│   └── auth.php
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── css/
│   ├── js/
│   └── images/
├── resources/
│   ├── views/
│   │   ├── admin/              # Admin views
│   │   ├── layouts/            # Layout templates
│   │   ├── tours/              # Tour views
│   │   └── auth/               # Authentication views
│   └── js/
├── routes/
│   ├── web.php                 # Web routes
│   └── api.php                 # API routes
├── storage/
├── tests/
├── .env.example
├── composer.json
├── package.json
└── README.md
```

---

## 📖 Sử Dụng

### Khởi Động Development Server

```bash
# Start Laravel server
php artisan serve

# Start Vite dev server (in another terminal)
npm run dev
```

### Chạy Tests

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=TourTest
```

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Database Commands

```bash
# Refresh database
php artisan migrate:fresh

# Seed data
php artisan db:seed

# Rollback migration
php artisan migrate:rollback
```

---

## 🔌 API Documentation

### Authentication Endpoints

```http
POST   /api/register          # Đăng ký tài khoản
POST   /api/login             # Đăng nhập
POST   /api/logout            # Đăng xuất
```

### Tour Endpoints

```http
GET    /api/tours             # Lấy danh sách tour
GET    /api/tours/{id}        # Lấy chi tiết tour
POST   /api/tours             # Tạo tour mới (Admin)
PUT    /api/tours/{id}        # Cập nhật tour (Admin)
DELETE /api/tours/{id}        # Xóa tour (Admin)
```

### Booking Endpoints

```http
POST   /api/bookings          # Đặt tour
GET    /api/bookings          # Lấy danh sách booking
GET    /api/bookings/{id}     # Chi tiết booking
PUT    /api/bookings/{id}     # Cập nhật trạng thái (Admin)
```

---

## 📸 Screenshots

### 🏠 Trang Chủ
![Homepage](docs/images/homepage.png)

### 🗺️ Chi Tiết Tour
![Tour Detail](docs/images/tour-detail.png)

### 🎫 Đặt Tour
![Booking](docs/images/booking.png)

---

## 🤝 Đóng Góp

Chúng tôi hoan nghênh mọi đóng góp! Để đóng góp:

1. **Fork** repository
2. **Clone** fork của bạn về máy
3. Tạo branch mới (`git checkout -b feature/AmazingFeature`)
4. **Commit** thay đổi (`git commit -m 'Add some AmazingFeature'`)
5. **Push** lên branch (`git push origin feature/AmazingFeature`)
6. Mở **Pull Request**

### 📝 Coding Standards

- Tuân thủ [PSR-12](https://www.php-fig.org/psr/psr-12/) coding style
- Viết tests cho các tính năng mới
- Cập nhật documentation khi cần thiết
- Commit messages rõ ràng và có ý nghĩa

---

## 📄 License

Dự án này được phân phối dưới giấy phép **MIT License**. Xem file [LICENSE](LICENSE) để biết thêm chi tiết.

```
MIT License

Copyright (c) 2024 Travel Management System

Permission is hereby granted, free of charge...
```

---

## 📞 Liên Hệ

**Tác Giả:** Your Name

- 📧 Email: hungltk2004@gmail.com
- 💼 LinkedIn: [[Your LinkedIn](https://linkedin.com/in/yourprofile)](https://www.linkedin.com/in/hungltk/)
- 🐙 GitHub: [[@yourusername](https://github.com/yourusername)](https://github.com/LeTranKimHung)

---

## 🙏 Acknowledgments

- [Laravel Framework](https://laravel.com/)
- [Bootstrap](https://getbootstrap.com/)
- [FontAwesome](https://fontawesome.com/)
- Và tất cả các contributors đã đóng góp cho dự án!

---

<div align="center">

**⭐️ Nếu dự án hữu ích, hãy cho một ngôi sao! ⭐️**

Made with ❤️ by [Your Name](https://github.com/yourusername)

</div>
