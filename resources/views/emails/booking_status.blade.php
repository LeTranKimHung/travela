<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cập nhật trạng thái đặt tour</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { width: 80%; margin: 20px auto; border: 1px solid #eee; padding: 20px; border-radius: 10px; }
        .header { background: #0ea5e9; color: #fff; padding: 10px 20px; border-radius: 10px 10px 0 0; text-align: center; }
        .content { padding: 20px; }
        .footer { font-size: 0.8em; color: #777; text-align: center; margin-top: 20px; }
        .status-confirmed { color: #10b981; font-weight: bold; }
        .status-cancelled { color: #ef4444; font-weight: bold; }
        .status-pending { color: #f59e0b; font-weight: bold; }
        .details { background: #f9fafb; padding: 15px; border-radius: 5px; margin-top: 10px; }
        .btn { display: inline-block; background: #0ea5e9; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Travela Notifications</h2>
        </div>
        <div class="content">
            <p>Xin chào <strong>{{ $booking->fullName ?? $booking->userName }}</strong>,</p>
            <p>Chúng tôi xin thông báo về trạng thái đơn đặt tour của bạn tại <strong>Travela</strong>.</p>
            
            <div class="details">
                <p><strong>Tour:</strong> {{ $booking->tourTitle }}</p>
                <p><strong>Trạng thái mới:</strong> 
                    <span class="status-{{ $status }}">
                        @if($status == 'confirmed') Đã xác nhận ✅
                        @elseif($status == 'cancelled') Đã bị hủy ❌
                        @elseif($status == 'completed') Đã hoàn thành 🎉
                        @else {{ $status }}
                        @endif
                    </span>
                </p>
            </div>

            @if($status == 'confirmed')
                <p>Đơn hàng của bạn đã được xác nhận. Chúng tôi sẽ liên hệ với bạn sớm nhất để trao đổi thêm chi tiết về chuyến đi.</p>
            @elseif($status == 'cancelled')
                <p>Rất tiếc, đơn đặt tour của bạn đã bị hủy. Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi qua số điện thoại hỗ trợ.</p>
            @endif

            <p>Bạn có thể vào trang cá nhân để theo dõi lịch sử đặt tour.</p>
            
            <a href="{{ url('/profile#pills-history') }}" class="btn">Xem lịch sử đặt tour</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Travela. Tất cả các quyền được bảo lưu.</p>
            <p>Hotline: 1900 xxxx | Email: support@travela.com</p>
        </div>
    </div>
</body>
</html>
