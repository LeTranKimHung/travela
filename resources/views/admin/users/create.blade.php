@extends('admin.layouts.app')
@section('title', 'Thêm tài khoản')
@section('page-title', 'Thêm tài khoản mới')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Tạo tài khoản mới</h4>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Quay lại
    </a>
</div>

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tên đăng nhập <span class="text-danger">*</span></label>
                    <input type="text" name="userName" class="form-control" placeholder="Ví dụ: nguyenvana" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Họ và tên <span class="text-danger">*</span></label>
                    <input type="text" name="fullName" class="form-control" placeholder="Ví dụ: Nguyễn Văn A" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="email@gmail.com" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" name="passWord" class="form-control" placeholder="Tối thiểu 6 ký tự" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Vai trò</label>
                    <select name="role" class="form-select">
                        <option value="c">Người dùng</option>
                        <option value="a">Admin</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Trạng thái</label>
                    <select name="isActive" class="form-select">
                        <option value="y">Hoạt động</option>
                        <option value="n">Bị khóa</option>
                    </select>
                </div>
                <div class="col-12 text-end border-top pt-3">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Tạo tài khoản
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
