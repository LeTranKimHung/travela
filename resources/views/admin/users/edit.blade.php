@extends('admin.layouts.app')
@section('title', 'Sửa tài khoản')
@section('page-title', 'Chỉnh sửa tài khoản')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Chỉnh sửa tài khoản: <span class="text-primary">{{ $user->userName }}</span></h4>
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
        <form action="{{ route('admin.users.update', $user->userId) }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tên đăng nhập</label>
                    <input type="text" class="form-control bg-light" value="{{ $user->userName }}" disabled>
                    <small class="text-muted">Không thể thay đổi tên đăng nhập</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Họ và tên <span class="text-danger">*</span></label>
                    <input type="text" name="fullName" class="form-control" value="{{ $user->fullName }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Mật khẩu mới</label>
                    <input type="password" name="passWord" class="form-control" placeholder="Để trống nếu không đổi">
                    <small class="text-muted">Chỉ nhập nếu muốn đổi mật khẩu</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Vai trò</label>
                    <select name="role" class="form-select">
                        <option value="c" {{ $user->role === 'c' ? 'selected' : '' }}>Người dùng</option>
                        <option value="a" {{ $user->role === 'a' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Trạng thái</label>
                    <select name="isActive" class="form-select">
                        <option value="y" {{ $user->isActive === 'y' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="n" {{ $user->isActive === 'n' ? 'selected' : '' }}>Bị khóa</option>
                    </select>
                </div>
                <div class="col-12 text-end border-top pt-3">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-check me-1"></i> Cập nhật tài khoản
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
