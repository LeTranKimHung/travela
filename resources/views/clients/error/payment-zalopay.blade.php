@include('clients.blocks.header')

<div class="container py-5 mt-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Thanh Toán Qua ZaloPay</h2>
        <p class="text-muted">Vui lòng nhập thông tin thẻ ngân hàng của bạn để hoàn tất thanh toán.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow border-0 p-4">
                <div class="text-center mb-4">
                    <img src="https://itop.website/upload/images/zalopay-logo-1.png" width="100" alt="ZaloPay Logo">
                    <h5 class="mt-2 text-muted">Cổng thanh toán thẻ</h5>
                </div>
                
                <form action="{{ route('payment.zalopay.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking->bookingId }}">
                    
                    <div class="bg-light p-3 rounded mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Dịch vụ:</span>
                            <strong>{{ $tour->title }}</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Tổng thanh toán:</span>
                            <strong class="text-danger fs-5">{{ format_currency($booking->totalPrice) }}</strong>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="card_number" class="form-label fw-bold">Số thẻ <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-credit-card text-muted"></i></span>
                            <input type="text" class="form-control form-control-lg border-start-0" id="card_number" name="card_number" 
                                   placeholder="XXXX XXXX XXXX XXXX" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="card_holder" class="form-label fw-bold">Tên chủ thẻ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg text-uppercase" id="card_holder" name="card_holder" 
                               placeholder="NGUYEN VAN A" required>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="expiry_date" class="form-label fw-bold">Ngày hết hạn/phát hành <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" id="expiry_date" name="expiry_date" 
                                   placeholder="MM/YY" required>
                        </div>
                        <div class="col-md-6">
                            <label for="cvv" class="form-label fw-bold">Mã CVV <small class="text-muted">(Nếu có)</small></label>
                            <input type="text" class="form-control form-control-lg" id="cvv" name="cvv" 
                                   placeholder="123">
                        </div>
                    </div>

                    <div class="alert alert-info small border-0 bg-light">
                        <i class="fas fa-shield-alt me-2 text-success"></i> Thông tin thanh toán của bạn được bảo mật theo tiêu chuẩn quốc tế.
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold py-3 shadow-sm">
                            XÁC NHẬN & THANH TOÁN
                        </button>
                        <a href="{{ route('payment.index', ['bookingId' => $booking->bookingId]) }}" class="btn btn-link text-muted text-decoration-none"> 
                            <i class="fas fa-arrow-left me-1"></i> Quay lại phương thức khác
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('clients.blocks.footer')
