@include('clients.blocks.header')

@php
    $bannerImg = isset($tours) && $tours->isNotEmpty() ? $tours->first()->images[0] : 'default.jpg';
@endphp
<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">
<div
    style="background: url('{{ asset('clients/img/galery-tour/' . $bannerImg) }}') center center/cover no-repeat; padding: 150px 0 28px 0; position: relative;">
    <div style="background:rgba(155, 155, 158, 0.7); position:absolute; inset:0;"></div>
    <div class="container" style="position:relative; z-index:2;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background:transparent; margin-bottom:0;">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" style="color:#fff; text-decoration:underline;">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color:#fff;">
                    {{ $title ?? 'Profile' }}
                </li>
            </ol>
        </nav>

    </div>
</div>

<!-- Profile Section -->
<div class="container-fluid about py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-start">
            <!-- Left Column - User Info Card -->
            <div class="col-lg-4">
                <div class="card shadow-sm" style="border: 3px solid #13357B;">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-user-circle" style="font-size: 80px; color: #13357B;"></i>
                        </div>
                        <h4 class="mb-2">{{ $user->userName }}</h4>
                        <p class="text-muted mb-3">
                            <i class="fas fa-envelope me-2"></i>{{ $user->email }}
                        </p>
                        @if($user->phoneNumber)
                        <p class="text-muted mb-3">
                            <i class="fas fa-phone me-2"></i>{{ $user->phoneNumber }}
                        </p>
                        @endif
                        @if($user->address)
                        <p class="text-muted">
                            <i class="fas fa-map-marker-alt me-2"></i>{{ $user->address }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column - Update Form -->
            <div class="col-lg-8" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url({{ asset('clients/img/about-img-1.png') }});">
                <h5 class="section-about-title pe-3">Tài Khoản</h5>
                
                <!-- Nav Tabs - Premium Styled -->
                <ul class="nav nav-pills mb-4 p-1 bg-light rounded-pill d-inline-flex" id="pills-tab" role="tablist" style="border: 1px solid #e9ecef;">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-pill px-4 py-2 fw-bold" id="pills-profile-tab" 
                                data-bs-toggle="pill" data-bs-target="#pills-profile" 
                                data-toggle="pill" data-target="#pills-profile"
                                type="button" role="tab"><i class="fas fa-user-circle me-2"></i>Thông tin</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-4 py-2 fw-bold" id="pills-history-tab" 
                                data-bs-toggle="pill" data-bs-target="#pills-history" 
                                data-toggle="pill" data-target="#pills-history"
                                type="button" role="tab"><i class="fas fa-receipt me-2"></i>Lịch sử giao dịch</button>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <!-- Profile Tab -->
                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel">
                        <h1 class="mb-4">Cập nhật <span class="text-primary">Thông tin</span></h1>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    
                    <!-- Basic Information -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header" style="background-color: #13357B; color: white;">
                            <h5 class="mb-0"><i class="fas fa-user me-2"></i>Thông tin cơ bản</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Tên đăng nhập</label>
                                    <input type="text" class="form-control" value="{{ $user->userName }}" disabled style="background-color: #f0f0f0;">
                                    <small class="text-muted">Tên đăng nhập không thể thay đổi</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                    @error('email') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Số điện thoại</label>
                                    <input type="text" name="phoneNumber" class="form-control" value="{{ old('phoneNumber', $user->phoneNumber) }}" placeholder="Nhập số điện thoại">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Địa chỉ</label>
                                    <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}" placeholder="Nhập địa chỉ">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Change Password Section -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header" style="background-color: #13357B; color: white;">
                            <h5 class="mb-0"><i class="fas fa-lock me-2"></i>Đổi mật khẩu</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Chỉ điền các trường bên dưới nếu bạn muốn thay đổi mật khẩu
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Mật khẩu hiện tại</label>
                                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Nhập mật khẩu hiện tại">
                                @error('current_password') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Mật khẩu mới</label>
                                    <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="Nhập mật khẩu mới (tối thiểu 6 ký tự)">
                                    @error('new_password') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Xác nhận mật khẩu mới</label>
                                    <input type="password" name="new_password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu mới">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="text-end">
                        <a href="{{ route('home') }}" class="btn btn-secondary rounded-pill py-3 px-5 me-2">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill py-3 px-5">
                            <i class="fas fa-save me-2"></i>Lưu thay đổi
                        </button>
                    </div>
                </form>
                    </div>

                    <!-- History Tab -->
                    <div class="tab-pane fade" id="pills-history" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-end mb-4">
                            <div>
                                <h1 class="mb-1">Lịch sử <span class="text-primary">Giao dịch</span></h1>
                                <p class="text-muted mb-0">Quản lý các chuyến đi và trạng thái thanh toán của bạn</p>
                            </div>
                        </div>
                        
                        @if(count($myTours) > 0)
                            <div class="table-responsive bg-white rounded-3 shadow-sm border overflow-hidden">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">Tour dã đặt</th>
                                            <th class="py-3 text-uppercase small fw-bold text-muted"><i class="far fa-calendar-alt me-1"></i> Ngày đặt</th>
                                            <th class="py-3 text-uppercase small fw-bold text-muted"><i class="fas fa-users me-1"></i> Số người</th>
                                            <th class="py-3 text-uppercase small fw-bold text-muted"><i class="fas fa-wallet me-1"></i> Tổng tiền</th>
                                            <th class="py-3 text-uppercase small fw-bold text-muted">Trạng thái</th>
                                            <th class="pe-4 py-3 text-end text-uppercase small fw-bold text-muted">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($myTours as $tour)
                                            <tr>
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <div class="position-relative me-3">
                                                            <img src="{{ isset($tour->images[0]) ? asset('clients/img/galery-tour/' . $tour->images[0]) : asset('clients/img/packages-1.jpg') }}" 
                                                                 class="rounded-3 shadow-sm" style="width: 60px; height: 60px; object-fit: cover; border: 2px solid #fff;">
                                                        </div>
                                                        <div>
                                                            <div class="fw-bold text-dark mb-0">{{ $tour->title }}</div>
                                                            <small class="text-muted">Mã: #BT-{{ $tour->bookingId }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><span class="text-dark">{{ \Carbon\Carbon::parse($tour->bookingDate)->format('d/m/Y') }}</span></td>
                                                <td>
                                                    <div class="small">
                                                        <span class="badge bg-light text-dark border"><i class="fas fa-user me-1"></i>{{ $tour->numAdults }} lớn</span><br>
                                                        <span class="badge bg-light text-dark border mt-1"><i class="fas fa-child me-1"></i>{{ $tour->numChild }} trẻ em</span>
                                                    </div>
                                                </td>
                                                <td><span class="text-primary fw-bold fs-6">{{ number_format($tour->totalPrice) }} đ</span></td>
                                                <td>
                                                    @if($tour->bookingStatus == 'canceled')
                                                        <span class="badge rounded-pill bg-danger-soft text-danger px-3 py-2 border border-danger">
                                                            <i class="fas fa-times-circle me-1"></i> Đã hủy
                                                        </span>
                                                    @elseif($tour->paymentStatus == 'success')
                                                        <span class="badge rounded-pill bg-success-soft text-success px-3 py-2 border border-success">
                                                            <i class="fas fa-check-circle me-1"></i> Đã thanh toán
                                                        </span>
                                                    @elseif($tour->bookingStatus == 'pending')
                                                        <span class="badge rounded-pill bg-warning-soft text-warning px-3 py-2 border border-warning">
                                                            <i class="fas fa-clock me-1"></i> Chờ xác nhận
                                                        </span>
                                                    @else
                                                        <span class="badge rounded-pill bg-info-soft text-info px-3 py-2 border border-info">
                                                            <i class="fas fa-sync-alt me-1"></i> Đang xử lý
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="pe-4 text-end">
                                                    @if($tour->bookingStatus != 'canceled')
                                                        <button class="btn btn-sm btn-outline-danger rounded-pill px-3 py-2 transition-all" 
                                                                onclick="confirmCancel('{{ $tour->bookingId }}', '{{ $tour->totalPrice }}')">
                                                            <i class="fas fa-ban me-1"></i> Hủy
                                                        </button>
                                                    @else
                                                        <div class="bg-light p-2 rounded-3 text-start d-inline-block border shadow-sm" style="min-width: 150px;">
                                                            <div class="text-danger x-small mb-1">
                                                                <i class="fas fa-minus-circle me-1"></i>Phí hủy: {{ number_format($tour->totalPrice * 0.1) }} đ
                                                            </div>
                                                            <div class="text-success fw-bold x-small">
                                                                <i class="fas fa-undo me-1"></i>Hoàn: {{ number_format($tour->totalPrice * 0.9) }} đ
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5 bg-white rounded-3 shadow-sm border">
                                <div class="mb-4">
                                    <i class="fas fa-map-marked-alt fa-4x text-light"></i>
                                </div>
                                <h4 class="text-dark">Chưa có chuyến hành trình nào</h4>
                                <p class="text-muted mb-4 px-5">Bắt đầu khám phá thế giới ngay hôm nay với những gói tour hấp dẫn từ Travela.</p>
                                <a href="{{ route('packages') }}" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                                    <i class="fas fa-search me-2"></i>Khám phá Tour
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <style>
                    .bg-success-soft { background: rgba(25, 135, 84, 0.1); }
                    .bg-danger-soft { background: rgba(220, 53, 69, 0.1); }
                    .bg-warning-soft { background: rgba(255, 193, 7, 0.1); }
                    .bg-info-soft { background: rgba(13, 110, 253, 0.1); }
                    .x-small { font-size: 0.75rem; }
                    .transition-all { transition: all 0.3s ease; }
                    .transition-all:hover { transform: scale(1.05); }
                </style>

                <!-- Cancel Modal/Script -->
                <script>
                // Xử lý tự động chuyển tab từ link anchor (#pills-history)
                document.addEventListener('DOMContentLoaded', function() {
                    const hash = window.location.hash;
                    if (hash) {
                        const targetTab = document.querySelector(`button[data-bs-target="${hash}"], button[data-toggle="pill"][data-target="${hash}"]`);
                        if (targetTab) {
                            // Kích hoạt tab bằng JS của Bootstrap
                            const tabTrigger = new bootstrap.Tab(targetTab);
                            tabTrigger.show();
                        }
                    }
                });

                function confirmCancel(bookingId, total) {
                    const penalty = total * 0.1;
                    const confirmMsg = `Bạn có chắc chắn muốn hủy tour này?\n\n- Theo quy định, bạn sẽ bị khấu trừ 10% phí hủy (tương đương ${new Intl.NumberFormat('vi-VN').format(penalty)} đ).\n- Hành động này không thể hoàn tác.`;
                    
                    if (confirm(confirmMsg)) {
                        window.location.href = `/profile/cancel-tour/${bookingId}`;
                    }
                }
                </script>
        </div>
    </div>
</div>

@include('clients.blocks.footer')