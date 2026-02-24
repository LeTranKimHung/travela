<!DOCTYPE html>
<html>
<head>
    <style>
        .container {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #13357b;
        }
        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #333333;
        }
        .button-container {
            text-align: center;
            margin-top: 30px;
        }
        .button {
            background-color: #6dabe4;
            color: white !important;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #999999;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Chào mừng bạn đến với TRAVELA!</h1>
        </div>
        <div class="content">
            <p>Xin chào,</p>
            <p>Cảm ơn bạn đã đăng ký tài khoản tại TRAVELA. Để hoàn tất việc đăng ký và có thể đặt tour du lịch, vui lòng kích hoạt tài khoản của bạn bằng cách nhấn vào nút bên dưới:</p>
            <div class="button-container">
                <a href="{{ $link }}" class="button">Kích hoạt tài khoản</a>
            </div>
            <p>Nếu nút trên không hoạt động, bạn có thể sao chép và dán liên kết sau vào trình duyệt:</p>
            <p>{{ $link }}</p>
            <p>Liên kết này sẽ có hiệu lực trong vòng 24 giờ.</p>
        </div>
        <div class="footer">
            <p>&copy; 2026 TRAVELA. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
