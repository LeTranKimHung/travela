@include('clients.blocks.header')
<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">

{{-- Hero Banner --}}
<div style="background: url('{{ asset('clients/img/about-img.jpg') }}') center center/cover no-repeat; padding:130px 0 50px; position:relative;">
    <div style="background:linear-gradient(180deg,rgba(15,23,42,0.7) 0%,rgba(15,23,42,0.45) 100%); position:absolute; inset:0;"></div>
    <div class="container" style="position:relative; z-index:2;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#93c5fd; text-decoration:none;"><i class="fas fa-home me-1"></i>Trang chủ</a></li>
                <li class="breadcrumb-item active" style="color:#fff;">Chính sách bảo mật</li>
            </ol>
        </nav>
        <h1 style="color:#fff; font-weight:700; font-size:2.2rem; margin-bottom:8px;">
            <i class="fas fa-user-shield me-2" style="color:#38bdf8;"></i>Chính Sách Bảo Mật
        </h1>
        <p style="color:rgba(255,255,255,0.8); font-size:1rem; margin:0;">Cam kết bảo vệ thông tin cá nhân của bạn tại Travela</p>
    </div>
</div>

{{-- Content --}}
<div style="background:#f8fafc;" class="py-5">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div style="background:#fff; border-radius:20px; box-shadow:0 8px 32px rgba(0,0,0,0.06); padding:40px; color:#475569; line-height:1.8;">
                    
                    <h3 style="color:#0f172a; font-weight:700; margin-bottom:20px; font-size:1.5rem;">1. Thu thập thông tin</h3>
                    <p class="mb-4">Chúng tôi thu thập các thông tin cá nhân cốt lõi bao gồm Họ tên, Số điện thoại, Địa chỉ Email, Địa chỉ liên hệ và một số thông tin chứng minh để hỗ trợ cho việc đặt tour, hoàn thiện hồ sơ xin visa (nếu có). Ngoài ra, chúng tôi có thể thu thập thông tin về thiết bị, trình duyệt và địa chỉ IP nhằm cải thiện trải nghiệm người dùng trên website.</p>

                    <h3 style="color:#0f172a; font-weight:700; margin-bottom:20px; font-size:1.5rem;">2. Mục đích sử dụng thông tin</h3>
                    <ul class="mb-4" style="padding-left:20px;">
                        <li style="margin-bottom:8px;">Xử lý và xác nhận các khoảng đặt chỗ tour du lịch.</li>
                        <li style="margin-bottom:8px;">Liện hệ với bạn để cung cấp các thay đổi về lịch trình, hỗ trợ dịch vụ khách hàng hoặc hướng dẫn thanh toán.</li>
                        <li style="margin-bottom:8px;">Cá nhân hóa trải nghiệm của bạn trên ứng dụng hoặc trang web.</li>
                        <li style="margin-bottom:8px;">Gửi các thông báo quan trọng, ưu đãi hấp dẫn, các bản tin nội bộ (chỉ khi bạn đăng ký nhận).</li>
                    </ul>

                    <h3 style="color:#0f172a; font-weight:700; margin-bottom:20px; font-size:1.5rem;">3. Bảo mật thông tin</h3>
                    <p class="mb-4">Mọi thông tin cá nhân cung cấp đều được mã hóa bằng giao thức quốc tế và lưu trữ an toàn trong hệ thống máy chủ bảo mật của Travela. Chỉ những nhân viên được ủy quyền mới có quyền truy cập vào các dữ liệu này đễ xử lý dịch vụ theo quy chuẩn của công ty.</p>

                    <h3 style="color:#0f172a; font-weight:700; margin-bottom:20px; font-size:1.5rem;">4. Chia sẻ thông tin với bên thứ ba</h3>
                    <p class="mb-2">Chúng tôi không bán, trao đổi hoặc sử dụng thông tin cá nhân của bạn vào mục đích thương mại với bên thức ba. Tuy nhiên, thông tin có thể được chia sẻ cho:</p>
                    <ul class="mb-4" style="padding-left:20px;">
                        <li style="margin-bottom:8px;">Hãng hàng không, dịch vụ lưu trú, đối tác vận chuyển để thực hiện nghĩa vụ cung cấp tour cho bạn.</li>
                        <li style="margin-bottom:8px;">Cơ quan thẩm quyền có chức năng quản lý pháp lý khi có yêu cầu bằng văn bản đúng luật định.</li>
                        <li style="margin-bottom:8px;">Các đối tác cổng thanh toán được chứng nhận nhằm đảm bảo luân chuyển và bảo mật dòng tiền.</li>
                    </ul>

                    <h3 style="color:#0f172a; font-weight:700; margin-bottom:20px; font-size:1.5rem;">5. Quyền lợi của bạn</h3>
                    <p class="mb-4">Bạn có quyền truy cập, chỉnh sửa, yêu cầu xóa dữ liệu cá nhân trên hệ thống của chúng tôi bất cứ thời điểm nào (trong giới hạn không làm ảnh hưởng đến các đặt chỗ đang xử lý hoặc quy định lưu trữ của pháp luật). Xin vui lòng gửi yêu cầu đến trung tâm hỗ trợ khách hàng của chúng tôi.</p>

                    <h3 style="color:#0f172a; font-weight:700; margin-bottom:20px; font-size:1.5rem;">6. Cookie và các công nghệ theo dõi</h3>
                    <p class="mb-4">Trang web Travela sử dụng các tập tin nhỏ cookie để ghi nhớ cài đặt, phân tích lượng truy cập cũng như hỗ trợ cá nhân hoá các quảng cáo (nếu có). Bạn có thể tự mình thiết lập hạn chế hoặc không chấp nhận cookie trong cấu hình của trình duyệt.</p>

                    <h3 style="color:#0f172a; font-weight:700; margin-bottom:20px; font-size:1.5rem;">7. Cập nhật chính sách</h3>
                    <p class="mb-0">Chính sách bảo mật có thể được đánh giá và điều chỉnh định kỳ để phản ánh khách quan hơn các thay đổi về phát luật hoặc nghiệp vụ của công ty. Travela khuyến khích bạn nên thường xuyên truy cập trang này để cập nhật nhưng điều khoản bảo mật mới nhất.</p>

                </div>
            </div>
        </div>
    </div>
</div>

@include('clients.blocks.footer')
