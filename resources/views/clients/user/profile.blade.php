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
        </div>
    </div>
</div>

@include('clients.blocks.footer')