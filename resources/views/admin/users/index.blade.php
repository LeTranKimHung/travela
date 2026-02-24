<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Tài khoản - Travel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #0f172a; color: white; }
        .sidebar .nav-link { color: rgba(255,255,255,0.7); padding: 12px 20px; margin: 5px 15px; border-radius: 10px; font-weight: 500; transition: all 0.3s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background-color: #1e293b; color: #38bdf8; }
        .navbar-custom { background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 10px 20px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-4">
                    <h4 class="mb-0"><i class="fas fa-plane-departure"></i> Travel Admin</h4>
                </div>
                <nav class="nav flex-column px-3">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                    <a class="nav-link" href="{{ route('admin.tours.index') }}"><i class="fas fa-map-marked-alt me-2"></i> Quản lý Tour</a>
                    <a class="nav-link" href="{{ route('admin.bookings.index') }}"><i class="fas fa-calendar-check me-2"></i> Đơn hàng</a>
                    <a class="nav-link" href="{{ route('admin.posts.index') }}"><i class="fas fa-newspaper me-2"></i> Quản lý Bài viết</a>
                    <a class="nav-link" href="{{ route('admin.galleries.index') }}"><i class="fas fa-images me-2"></i> Quản lý Gallery</a>
                    <a class="nav-link" href="{{ route('admin.reviews.index') }}"><i class="fas fa-star me-2"></i> Quản lý Review</a>
                    <a class="nav-link active" href="{{ route('admin.users.index') }}"><i class="fas fa-users me-2"></i> Quản lý Tài khoản</a>
                    <hr class="text-white-50">
                    <a class="nav-link text-white-50" href="{{ route('home') }}"><i class="fas fa-home me-2"></i> Về website</a>
                </nav>
            </div>
            <div class="col-md-9 col-lg-10 p-0">
                <nav class="navbar navbar-expand navbar-custom mb-4">
                    <div class="container-fluid">
                        <h5 class="mb-0">Quản lý Tài khoản</h5>
                    </div>
                </nav>
                <div class="p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Danh sách tài khoản</h2>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm tài khoản</a>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    <div class="card shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">ID</th>
                                            <th>Tên đăng nhập</th>
                                            <th>Họ tên</th>
                                            <th>Email</th>
                                            <th>Vai trò</th>
                                            <th>Trạng thái</th>
                                            <th class="pe-4 text-end">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td class="ps-4 fw-bold">{{ $user->userId }}</td>
                                            <td>
                                                <i class="fas fa-user-circle text-secondary me-1"></i>
                                                {{ $user->userName }}
                                            </td>
                                            <td>{{ $user->fullName }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->role === 'a')
                                                    <span class="badge bg-danger"><i class="fas fa-shield-alt me-1"></i>Admin</span>
                                                @else
                                                    <span class="badge bg-info"><i class="fas fa-user me-1"></i>Người dùng</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->isActive === 'y')
                                                    <span class="badge bg-success">Hoạt động</span>
                                                @else
                                                    <span class="badge bg-secondary">Bị khóa</span>
                                                @endif
                                            </td>
                                            <td class="pe-4 text-end">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.users.edit', $user->userId) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('admin.users.destroy', $user->userId) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if($users->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-center py-5 text-muted">Chưa có tài khoản nào.</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
