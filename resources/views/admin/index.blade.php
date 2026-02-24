<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Travel Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        .sidebar {
            min-height: 100vh;
            background: #0f172a;
            color: white;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                width: 250px;
                height: 100%;
            }
            .sidebar.show {
                left: 0;
            }
            .main-content {
                width: 100% !important;
                margin-left: 0 !important;
            }
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 999;
            }
            .overlay.show { display: block; }
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 10px;
            transition: all 0.3s;
            font-weight: 500;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #1e293b;
            color: #38bdf8;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .stat-card {
            padding: 20px;
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        .navbar-custom {
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
        }
        .sidebar-toggler {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: #0f172a;
        }
        @media (max-width: 768px) {
            .sidebar-toggler {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Overlay -->
            <div id="sidebarOverlay" class="overlay"></div>

            <!-- Sidebar -->
            <div id="sidebar" class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-4 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-plane-departure"></i> Travel Admin
                    </h4>
                    <button class="sidebar-toggler text-white d-md-none" onclick="toggleSidebar()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <nav class="nav flex-column px-3">
                    <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                    <a class="nav-link {{ Request::routeIs('admin.tours.*') ? 'active' : '' }}" href="{{ route('admin.tours.index') }}">
                        <i class="fas fa-map-marked-alt me-2"></i> Quản lý Tour
                    </a>
                    <a class="nav-link {{ Request::routeIs('admin.bookings.*') ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}">
                        <i class="fas fa-calendar-check me-2"></i> Đơn hàng
                    </a>
                    <a class="nav-link {{ Request::routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}"><i class="fas fa-newspaper me-2"></i> Quản lý Bài viết</a>
                    <a class="nav-link {{ Request::routeIs('admin.galleries.*') ? 'active' : '' }}" href="{{ route('admin.galleries.index') }}"><i class="fas fa-images me-2"></i> Quản lý Gallery</a>
                    <a class="nav-link {{ Request::routeIs('admin.reviews.*') ? 'active' : '' }}" href="{{ route('admin.reviews.index') }}"><i class="fas fa-star me-2"></i> Quản lý Review</a>
                    <a class="nav-link {{ Request::routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}"><i class="fas fa-users me-2"></i> Quản lý Tài khoản</a>

                    <a class="nav-link text-white-50" href="{{ route('home') }}">
                        <i class="fas fa-home me-2"></i> Về trang chủ
                    </a>
                    <hr class="text-white-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link border-0 bg-transparent text-start w-100">
                            <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                        </button>
                    </form>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-0 main-content">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand navbar-custom mb-4">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center">
                            <button class="sidebar-toggler me-3" onclick="toggleSidebar()">
                                <i class="fas fa-bars"></i>
                            </button>
                            <h5 class="mb-0 d-none d-sm-block">Dashboard</h5>
                        </div>
                        <div class="ms-auto d-flex align-items-center">
                            <span class="small">
                                <i class="fas fa-user-circle me-1"></i> 
                                <span class="d-none d-sm-inline">Xin chào,</span> <strong>{{ session('username') }}</strong>
                            </span>
                        </div>
                    </div>
                </nav>

                <!-- Content -->
                <div class="container-fluid">
                    <h2 class="mb-4">Tổng quan hệ thống</h2>

                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card stat-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Tổng số Tour</h6>
                                        <h2 class="mb-0">{{ $tourCount }}</h2>
                                    </div>
                                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                                        <i class="fas fa-map-marked-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card stat-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Đơn đặt tour</h6>
                                        <h2 class="mb-0">{{ $bookingCount }}</h2>
                                    </div>
                                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card stat-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-2">Doanh thu tháng</h6>
                                        <h2 class="mb-0">{{ number_format($totalRevenue) }} đ</h2>
                                    </div>
                                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">
                                        <i class="fas fa-bolt text-warning"></i> Thao tác nhanh
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <a href="{{ route('admin.tours.create') }}" class="btn btn-primary w-100 py-3">
                                                <i class="fas fa-plus-circle me-2"></i> Thêm Tour mới
                                            </a>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <a href="{{ route('admin.tours.index') }}" class="btn btn-info w-100 py-3">
                                                <i class="fas fa-list me-2"></i> Xem tất cả Tour
                                            </a>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <a href="{{ route('admin.bookings.index') }}" class="btn btn-success w-100 py-3">
                                                <i class="fas fa-check-circle me-2"></i> Quản lý Booking
                                            </a>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <a href="{{ route('home') }}" class="btn btn-secondary w-100 py-3">
                                                <i class="fas fa-eye me-2"></i> Xem Website
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
        
        document.getElementById('sidebarOverlay').addEventListener('click', toggleSidebar);
    </script>
</body>
</html>