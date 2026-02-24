<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm tài khoản - Travel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #0f172a; color: white; }
        .sidebar .nav-link { color: rgba(255,255,255,0.7); padding: 12px 20px; margin: 5px 15px; border-radius: 10px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background-color: #1e293b; color: #38bdf8; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-4">
                    <h4><i class="fas fa-plane-departure"></i> Travel Admin</h4>
                </div>
                <nav class="nav flex-column px-3">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                    <a class="nav-link" href="{{ route('admin.tours.index') }}"><i class="fas fa-map-marked-alt me-2"></i> Quản lý Tour</a>
                    <a class="nav-link" href="{{ route('admin.bookings.index') }}"><i class="fas fa-calendar-check me-2"></i> Đơn hàng</a>
                    <a class="nav-link" href="{{ route('admin.posts.index') }}"><i class="fas fa-newspaper me-2"></i> Quản lý Bài viết</a>
                    <a class="nav-link" href="{{ route('admin.galleries.index') }}"><i class="fas fa-images me-2"></i> Quản lý Gallery</a>
                    <a class="nav-link" href="{{ route('admin.reviews.index') }}"><i class="fas fa-star me-2"></i> Quản lý Review</a>
                    <a class="nav-link active" href="{{ route('admin.users.index') }}"><i class="fas fa-users me-2"></i> Quản lý Tài khoản</a>
                </nav>
            </div>
            <div class="col-md-9 col-lg-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Thêm tài khoản mới</h2>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary text-white"><i class="fas fa-arrow-left"></i> Quay lại</a>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.users.store') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Tên đăng nhập <span class="text-danger">*</span></label>
                                    <input type="text" name="userName" class="form-control" placeholder="Ví dụ: nguyenvana" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Họ và tên <span class="text-danger">*</span></label>
                                    <input type="text" name="fullName" class="form-control" placeholder="Ví dụ: Nguyễn Văn A" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="Ví dụ: email@gmail.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Mật khẩu <span class="text-danger">*</span></label>
                                    <input type="password" name="passWord" class="form-control" placeholder="Tối thiểu 6 ký tự" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Vai trò</label>
                                    <select name="role" class="form-select">
                                        <option value="u">Người dùng</option>
                                        <option value="a">Admin</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Trạng thái</label>
                                    <select name="isActive" class="form-select">
                                        <option value="y">Hoạt động</option>
                                        <option value="n">Bị khóa</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary px-5 py-2"><i class="fas fa-save me-2"></i> Tạo tài khoản</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
