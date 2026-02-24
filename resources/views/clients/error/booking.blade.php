@include('clients.blocks.header')

@php
    // Lấy ảnh banner từ tour đầu tiên hoặc ảnh mặc định
    $bannerImg = $tours->first()->images[0] ?? 'default.jpg';
@endphp

<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">

<div style="background: url('{{ asset('clients/img/galery-tour/' . $bannerImg) }}') center center/cover no-repeat; padding: 150px 0 28px 0; position: relative;">
    <div style="background:rgba(0, 0, 0, 0.5); position:absolute; inset:0;"></div>
    <div class="container" style="position:relative; z-index:2;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background:transparent; margin-bottom:0;">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" style="color:#fff; text-decoration:none;">
                        <i class="fas fa-home"></i> Trang chủ
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color:#fff;">
                    {{ $title ?? 'Đặt Tour' }}
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-fluid booking py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h5 class="section-booking-title pe-3">Đặt Tour</h5>
                <h1 class="text-white mb-4">Trải Nghiệm Kỳ Nghỉ Hoàn Hảo</h1>
                <p class="text-white mb-4">
                    Chào mừng <strong>{{ $user->userName ?? 'Quý khách' }}</strong> quay trở lại! Hệ thống đã tự động điền thông tin của bạn để quá trình đặt tour nhanh chóng hơn.
                </p>
                <ul class="text-white">
                    <li>Hỗ trợ trực tuyến 24/7</li>
                    <li>Cam kết giá tốt nhất</li>
                    <li>Thanh toán an toàn, bảo mật</li>
                </ul>
            </div>
            
            <div class="col-lg-6">
                <div class="bg-light shadow rounded p-4">
                    <h3 class="mb-4">Thông Tin Đặt Tour</h3>
                    <form action="{{ route('booking.submit') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name" 
                                        value="{{ old('name', $user->userName ?? '') }}" placeholder="Họ tên" required>
                                    <label for="name">Họ và tên</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" 
                                        value="{{ old('email', $user->email ?? '') }}" placeholder="Email" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="phone" name="phone" 
                                        value="{{ old('phone', $user->phoneNumber ?? '') }}" placeholder="Số điện thoại" required>
                                    <label for="phone">Số điện thoại</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="tourId" name="tourId" required>
                                        <option value="">-- Chọn Tour --</option>
                                        @foreach($tours as $tour)
                                            <option value="{{ $tour->tourId }}" {{ (isset($tourDetail) && $tourDetail->tourId == $tour->tourId) ? 'selected' : '' }}>
                                                {{ $tour->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="tourId">Điểm đến hấp dẫn</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="bookingDate" name="bookingDate" 
                                        value="{{ isset($tourDetail) ? \Carbon\Carbon::parse($tourDetail->startDate)->format('Y-m-d') : '' }}" required>
                                    <label for="bookingDate">Ngày khởi hành</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="numAdults" name="numAdults" min="1" value="1" required>
                                    <label for="numAdults">Người lớn</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="numChild" name="numChild" min="0" value="0">
                                    <label for="numChild">Trẻ em</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Yêu cầu đặc biệt" id="specialRequests" name="specialRequests" style="height: 100px"></textarea>
                                    <label for="specialRequests">Yêu cầu đặc biệt (Ghi chú)</label>
                                </div>
                            </div>

                            <input type="hidden" name="userId" value="{{ $user->userId ?? '' }}">

                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3 rounded-pill" type="submit">
                                    TIẾP TỤC THANH TOÁN <i class="fas fa-chevron-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('clients.blocks.footer')