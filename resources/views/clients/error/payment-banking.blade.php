@include('clients.blocks.header')

<div class="container py-5 mt-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Thông Tin Chuyển Khoản</h2>
        <p class="text-muted">Vui lòng quét mã QR bên dưới hoặc chuyển khoản thủ công để hoàn tất đơn đặt tour.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 p-4 text-center">
                @php
                    $qrUrl = "https://img.vietqr.io/image/" . $bankDetails['bank_name'] . "-" . $bankDetails['account_number'] . "-compact.png?amount=" . $bankDetails['amount'] . "&addInfo=" . urlencode($bankDetails['reference']) . "&accountName=" . urlencode($bankDetails['account_name']);
                @endphp
                
                <img src="{{ $qrUrl }}" class="img-fluid mx-auto mb-4" style="max-width: 280px;" alt="Mã QR Thanh Toán">
                
                <div class="bg-light p-4 rounded text-start">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Ngân hàng:</span>
                        <strong class="text-dark">{{ $bankDetails['bank_name'] }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Số tài khoản:</span>
                        <strong class="text-primary fs-5">{{ $bankDetails['account_number'] }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Chủ tài khoản:</span>
                        <strong class="text-dark">{{ $bankDetails['account_name'] }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Số tiền:</span>
                        <strong class="text-danger fs-5">{{ number_format($bankDetails['amount']) }} VNĐ</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Nội dung chuyển khoản:</span>
                        <span class="badge bg-warning text-dark px-3 py-2 fs-6">{{ $bankDetails['reference'] }}</span>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="alert alert-info small">
                        <i class="fas fa-info-circle me-2"></i> Hệ thống sẽ tự động xác nhận sau khi nhận được tiền. Quá trình này có thể mất vài phút.
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-5 py-2 mt-3">Quay lại Trang Chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('clients.blocks.footer')