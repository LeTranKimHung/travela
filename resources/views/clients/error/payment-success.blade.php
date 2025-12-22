@include('clients.blocks.header')

<div class="container-fluid py-5 mt-5">
    <div class="container py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="mb-4">
                    <i class="fas fa-check-circle text-success" style="font-size: 100px;"></i>
                </div>
                
                <h1 class="display-4 fw-bold mb-3">Thanh Toán Thành Công!</h1>
                <p class="fs-5 text-muted mb-5">
                    Cảm ơn bạn đã tin tưởng Travela. Đơn hàng của bạn đã được hệ thống ghi nhận thành công. 
                    Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận hành trình.
                </p>

                <div class="card border-0 shadow-sm p-4 mb-4 bg-light">
                    <h5 class="text-start mb-3">Bạn có thể làm gì tiếp theo?</h5>
                    <ul class="text-start mb-0">
                        <li>Kiểm tra email để nhận hóa đơn điện tử.</li>
                        <li>Xem lại lịch sử đặt tour trong phần <strong>Hồ sơ cá nhân</strong>.</li>
                        <li>Liên hệ hotline <strong>1900 xxxx</strong> nếu cần hỗ trợ gấp.</li>
                    </ul>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-5 py-3">
                        <i class="fas fa-home me-2"></i>Về trang chủ
                    </a>
                    <a href="{{ route('profile') }}" class="btn btn-outline-secondary rounded-pill px-5 py-3">
                        Xem đơn hàng
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('clients.blocks.footer')