@include('clients.blocks.header')

@php
    $bannerImg = isset($tour) && !empty($tour->images) ? $tour->images[0] : 'default.jpg';
@endphp
<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">
<div
    style="background: url('{{ asset('clients/img/galery-tour/' . $bannerImg) }}') center center/cover no-repeat; padding: 150px 0 28px 0; position: relative;">
    <div style="background:rgba(59, 59, 76, 0.7); position:absolute; inset:0;"></div>
    <div class="container" style="position:relative; z-index:2;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background:transparent; margin-bottom:0;">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" style="color:#fff; text-decoration:underline;">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color:#fff;">
                    {{ $title ?? 'Payment' }}
                </li>
            </ol>
        </nav>

    </div>
</div>

<div class="container py-5 mt-5">
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">Tóm tắt đơn hàng</h5>
                </div>
                <div class="card-body p-4">
                    <h5>{{ $tour->title }}</h5>
                    <p class="text-muted"><i class="fas fa-calendar-alt me-2"></i>Ngày khởi hành:
                        {{ $booking->bookingDate }}</p>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Người lớn: {{ $booking->numAdults }} x {{ number_format($tour->priceAdult) }} VNĐ</span>
                        <span>{{ number_format($booking->numAdults * $tour->priceAdult) }} VNĐ</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Trẻ em: {{ $booking->numChild }} x {{ number_format($tour->priceChild) }} VNĐ</span>
                        <span>{{ number_format($booking->numChild * $tour->priceChild) }} VNĐ</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold text-danger fs-5">
                        <span>TỔNG CỘNG:</span>
                        <span>{{ number_format($totalPrice) }} VNĐ</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0">Chọn phương thức thanh toán</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('payment.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->bookingId }}">

                        <div class="form-check border rounded p-3 mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="banking"
                                value="banking" checked>
                            <label class="form-check-label d-flex align-items-center" for="banking">
                                <i class="fas fa-university me-3 text-primary fs-4"></i>
                                <span>Chuyển khoản Ngân hàng</span>
                            </label>
                        </div>

                        <div class="form-check border rounded p-3 mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="vnpay"
                                value="vnpay">
                            <label class="form-check-label d-flex align-items-center" for="vnpay">
                                <i class="fas fa-wallet me-3 text-success fs-4"></i>
                                <span>Ví điện tử VNPAY</span>
                            </label>
                        </div>
                        <div class="form-check border rounded p-3 mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="zalopay"
                                value="zalopay">
                            <label class="form-check-label d-flex align-items-center" for="zalopay">
                                <img src="https://itop.website/upload/images/zalopay-logo-1.png" width="30"
                                    class="me-3">
                                <span>Ví điện tử ZaloPay</span>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">
                            XÁC NHẬN & THANH TOÁN
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('clients.blocks.footer')
