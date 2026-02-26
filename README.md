# 🌏 Hệ thống Quản lý Du lịch Travela

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![Gemini AI](https://img.shields.io/badge/Gemini%20AI-Integration-blue?style=for-the-badge&logo=google-gemini&logoColor=white)

Một hệ thống quản lý đặt tour du lịch toàn diện được xây dựng trên nền tảng Laravel Framework, tích hợp trí tuệ nhân tạo (AI).

[Tính năng](#-tính-năng) •
[Cài đặt](#-hướng-dẫn-cài-đặt) •
[Sử dụng](#-hướng-dẫn-sử-dụng) •
[Công nghệ](#-công-nghệ-sử-dụng)

</div>

---

## 📋 Mục lục

- [Giới thiệu](#-giới-thiệu)
- [Tính năng nổi bật](#-tính-năng-nổi-bật)
- [Công nghệ sử dụng](#-công-nghệ-sử-dụng)
- [Yêu cầu hệ thống](#-yêu-cầu-hệ-thống)
- [Hướng dẫn cài đặt](#-hướng-dẫn-cài-đặt)
- [Cấu trúc dự án](#-cấu-trúc-dự-án)
- [Liên hệ](#-liên-hệ)

---

## 🎯 Giới thiệu

**Travela** là một ứng dụng web hiện đại giúp quản lý các tour du lịch, được phát triển bằng Laravel. Hệ thống cung cấp đầy đủ các tính năng cho cả khách hàng và quản trị viên, giúp tối ưu hóa quy trình đặt tour và quản lý kinh doanh công ty du lịch.

Đặc biệt, hệ thống đã được tích hợp **Gemini AI** để hỗ trợ khách hàng trả lời các thắc mắc về tour một cách thông minh và tự động.

---

## 🚀 Tính năng nổi bật

### 🤖 Tích hợp Trí tuệ Nhân tạo (Gemini AI)
- **Chatbot thông minh**: Tự động trả lời câu hỏi của khách hàng dựa trên dữ liệu tour có sẵn.
- **Tư vấn 24/7**: Hỗ trợ khách hàng ngay lập tức mà không cần nhân viên trực tuyến.
- **Ngữ cảnh hóa**: AI hiểu được dữ liệu tour hiện tại để đưa ra gợi ý chính xác nhất.

### 👨‍💼 Quản trị viên (Admin Panel)
- **Dashboard Thống kê**: Tổng quan doanh thu, số lượng đơn hàng theo biểu đồ trực quan.
- **Quản lý Tour**: Thêm/Sửa/Xóa tour, quản lý lịch trình chi tiết và giá cả.
- **Quản lý Đơn hàng**: Theo dõi trạng thái đặt tour, phê duyệt đơn hàng.
- **Hệ thống Email**: Tự động gửi email xác nhận cho khách khi đơn hàng được phê duyệt.
- **Quản lý Blog**: Đăng bài tin tức du lịch, hỗ trợ tùy chỉnh tên tác giả cho từng bài viết.
- **Phân quyền**: Quản lý người dùng và quyền truy cập hệ thống.

### 👥 Khách hàng (User Portal)
- **Tìm kiếm thông minh**: Tìm tour theo điểm đến, thời gian và giá cả.
- **Đặt tour trực tuyến**: Quy trình đặt tour đơn giản, nhanh chóng.
- **Quản lý tài khoản**: Theo dõi lịch sử đặt tour, cập nhật thông tin cá nhân.
- **Tương tác**: Chat trực tiếp với trợ lý AI để nhận tư vấn.

---

## 🛠 Công nghệ sử dụng

### Backend
```
🔹 Laravel 12.x         - PHP Framework mạnh mẽ nhất hiện nay
🔹 MySQL 8.0              - Hệ quản trị cơ sở dữ liệu
🔹 Google Gemini API      - Trí tuệ nhân tạo thế hệ mới
🔹 Mailtrap/SMTP          - Hệ thống gửi email tự động
```

### Frontend
```
🔹 Blade Template         - PHP Template Engine
🔹 Bootstrap 5.3          - Framework CSS hỗ trợ Responsive
🔹 JavaScript (ES6+)      - Xử lý các tính năng tương tác
🔹 FontAwesome 6          - Thư viện icon đa dạng
```

---

## 💻 Yêu cầu hệ thống

| Yêu cầu | Phiên bản |
|------------|---------|
| PHP | ≥ 8.2 |
| Composer | ≥ 2.5 |
| MySQL | ≥ 8.0 |
| Node.js | ≥ 18.x |

---

## 📦 Hướng dẫn cài đặt

### Bước 1: Clone dự án

```bash
git clone https://github.com/LeTranKimHung/travela.git
cd travela
```

### Bước 2: Cài đặt thư viện

```bash
# Cài đặt PHP dependencies
composer install

# Cài đặt Node dependencies
npm install
```

### Bước 3: Cấu hình môi trường

```bash
# Tạo file .env từ file mẫu
cp .env.example .env

# Tạo application key
php artisan key:generate
```

### Bước 4: Cấu hình Database & API

Mở file `.env` và cập nhật thông tin cơ sở dữ liệu cùng với API Key của Gemini:

```env
DB_DATABASE=travel
DB_USERNAME=root
DB_PASSWORD=your_password

# Cấu hình Gemini AI
GEMINI_API_KEY=your_gemini_api_key_here

# Cấu hình Mail (để gửi thông báo đặt tour)
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
```

### Bước 5: Chạy Migration

```bash
php artisan migrate
```

### Bước 6: Khởi chạy ứng dụng

```bash
# Chạy Laravel server
php artisan serve

# Build assets (Vite)
npm run dev
```

🎉 Truy cập ứng dụng tại: **http://127.0.0.1:8000**

---

## 📂 Cấu trúc dự án

```
travela/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Quản lý phía Admin
│   │   └── Clients/         # Xử lý phía khách hàng (có ChatController AI)
│   ├── Mail/               # Các lớp xử lý gửi Email
│   └── Models/             # Các Model Database
├── database/               # Migration và Seeders
├── resources/
│   ├── views/              # Giao diện Blade (Admin & Client)
│   └── lang/               # Đa ngôn ngữ (nếu có)
├── routes/
│   └── web.php             # Khai báo các route của ứng dụng
└── .env                    # Lưu trữ cấu hình nhạy cảm
```

---

## 📞 Liên hệ

**Tác giả:** Lê Trần Kim Hùng

- 📧 Email: hungltk2004@gmail.com
- 🐙 GitHub: [LeTranKimHung](https://github.com/LeTranKimHung)

---

<div align="center">

**⭐ Nếu bạn thấy dự án này hữu ích, hãy tặng tôi 1 sao nhé! ⭐**

Made with ❤️ by [Le Tran Kim Hung](https://github.com/LeTranKimHung)

</div>
