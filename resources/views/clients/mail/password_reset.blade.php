<!DOCTYPE html>
<html>
<head>
    <title>Khôi phục mật khẩu</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h2 { color: #13357b; }
        p { color: #555; line-height: 1.6; }
        .btn { display: inline-block; padding: 12px 24px; color: #ffffff !important; background-color: #13357b; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 15px; }
        .footer { margin-top: 30px; font-size: 12px; color: #999; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Yêu cầu khôi phục mật khẩu</h2>
        <p>Xin chào,</p>
        <p>Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu khôi phục mật khẩu cho tài khoản của bạn tại Travela.</p>
        <p>Vui lòng click vào nút bên dưới để tạo mật khẩu mới:</p>
        <a href="{{ $link }}" class="btn">Khôi phục mật khẩu</a>
        <p style="margin-top: 25px;">Nếu bạn không yêu cầu khôi phục mật khẩu, vui lòng bỏ qua email này.</p>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Travela. Bảo lưu mọi quyền.</p>
        </div>
    </div>
</body>
</html>
