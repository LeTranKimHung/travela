@include('clients.blocks.header')
<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">

{{-- Hero Banner --}}
<div style="background: url('{{ asset('clients/img/about-img.jpg') }}') center center/cover no-repeat; padding:130px 0 50px; position:relative;">
    <div style="background:linear-gradient(180deg,rgba(15,23,42,0.7) 0%,rgba(15,23,42,0.45) 100%); position:absolute; inset:0;"></div>
    <div class="container" style="position:relative; z-index:2;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#93c5fd; text-decoration:none;"><i class="fas fa-home me-1"></i>Trang chủ</a></li>
                <li class="breadcrumb-item active" style="color:#fff;">Điều khoản sử dụng</li>
            </ol>
        </nav>
        <h1 style="color:#fff; font-weight:700; font-size:2.2rem; margin-bottom:8px;">
            <i class="fas fa-file-contract me-2" style="color:#38bdf8;"></i>Điều Khoản Sử Dụng
        </h1>
        <p style="color:rgba(255,255,255,0.8); font-size:1rem; margin:0;">Vui lòng đọc kỹ các điều khoản trước khi sử dụng dịch vụ của Travela</p>
    </div>
</div>

{{-- Content --}}
<div style="background:#f8fafc;" class="py-5">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div style="background:#fff; border-radius:20px; box-shadow:0 8px 32px rgba(0,0,0,0.06); padding:40px; color:#475569; line-height:1.8;">
                    
                    <h3 style="color:#0f172a; font-weight:700; margin-bottom:20px; font-size:1.5rem;">1. Chấp nhận các điều khoản</h3>
                    <p class="mb-4">Bằng việc truy cập và sử dụng trang web của Travela để tìm kiếm thông tin hoặc đặt tour, bạn đồng ý tuân thủ các điều khoản và điều kiện được nêu dưới đây. Nếu bạn không đồng ý với bất kỳ phần nào của các điều khoản này, vui lòng không sử dụng dịch vụ của chúng tôi.</p>

                    <h3 style="color:#0f172a; font-weight:700; margin-bottom:20px; font-size:1.5rem;">2. Dịch vụ cung cấp</h3>
                    <p class="mb-4">Travela cung cấp nền tảng trực tuyến để đặt tour du lịch, tìm hiểu thông tin điểm đến và các dịch vụ du lịch liên quan. Chúng tôi nỗ lực đảm bảo thông tin mô tả về tour, giá cả và lịch trình chính xác tại thời điểm đăng tải.</p>

                    <h3 style="color:#0f172a; font-weight:700; margin-bottom:20px; font-size:1.5rem;">3. Quy định về đặt chỗ và thanh toán</h3>
                    <ul class="mb-4" style="padding-left:20px;">
                        <li style="margin-bottom:8px;">Khi đặt tour, khách hàng phải cung cấp thông tin chính xác và đầy đủ.</li>
                        <li style="margin-bottom:8px;">Để xác nhận đặt chỗ, bạn có thể cần thanh toán một phần (đặt cọc) hoặc toàn bộ giá trị chuyến đi.</li>
                        <li style="margin-bottom:8px;">Travela có quyền hủy bỏ đơn đặt chỗ nếu không nhận được thanh toán theo hạn định.</li>
                        <li style="margin-bottom:8px;">Chi phí thanh toán trực tuyến (nếu có) sẽ tuần thủ các chính sách của cổng thanh toán.</li>
                    </ul>

                    <h3 style="color:#0f172a; font-weight:700; margin-bottom:20px; font-size:1.5rem;">4. Trách nhiệm của khách hàng</h3>
                    <p class="mb-2">Khách hàng chịu trách nhiệm:</p>
                    <ul class="mb-4" style="padding-left:20px;">
                        <li style="margin-bottom:8px;">Bảo mật thông tin tài khoản đăng nhập trên website Travela.</li>
                        <li style="margin-bottom:8px;">Chuẩn bị các giấy tờ tuỳ thân cần thiết (CMND, CCCD, Hộ chiếu, Visa...) còn hạn mức phù hợp với quy định.</li>
                        <li style="margin-bottom:8px;">Tuân thủ quy định và nội quy tại các điểm tham quan cũng như của các đối tác lữ hành.</li>
                        <li style="margin-bottom:8px;">Không sử dụng nền tảng của Travela vào những mục đích bất hợp pháp, phá hoại hoặc ảnh hưởng đến trải nghiệm của người khác.</li>
                    </ul>

                    <h3 style="color:#0f172a; font-weight:700; margin-bottom:20px; font-size:1.5rem;">5. Chính sách hủy phạt và hoàn tiền</h3>
                    <p class="mb-4">Tùy vào từng loại tour và thời gian hủy trước ngày khởi hành mà sẽ áp dụng mức phí phạt khác nhau. Số tiền hoàn lại (nếu có) sẽ được chuyển về phương thức thanh toán ban đầu theo thời gian làm việc quy định. Chi tiết mức phạt được đính kèm theo mô tả của từng tour khi đặt chỗ.</p>

                    <h3 style="color:#0f172a; font-weight:700; margin-bottom:20px; font-size:1.5rem;">6. Bản quyền và Sở hữu trí tuệ</h3>
                    <p class="mb-4">Toàn bộ nội dung, hình ảnh, thiết kế, và thương hiệu hiển thị trên website này đều thuộc quyền sở hữu của Travela hoặc được cấp phép sử dụng. Không ai được quyền sao chép, phân phối hoặc sử dụng cho mục đích thương mại riêng mà không có sự đồng ý bằng văn bản từ chúng tôi.</p>

                    <h3 style="color:#0f172a; font-weight:700; margin-bottom:20px; font-size:1.5rem;">7. Thay đổi Điều khoản</h3>
                    <p class="mb-0">Travela có quyền sửa đổi và cập nhật Điều khoản sử dụng này vào bất kỳ lúc nào mà không cần báo trước. Những thay đổi sẽ có hiệu lực ngay khi được đăng tải trên website. Bạn có trách nhiệm theo dõi và cập nhật những sửa đổi mới nhất.</p>

                </div>
            </div>
        </div>
    </div>
</div>

@include('clients.blocks.footer')
