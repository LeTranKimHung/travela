<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Booking - Travel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; overflow-x: hidden; }
        .sidebar {
            min-height: 100vh;
            background: #0f172a;
            color: white;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        @media (max-width: 768px) {
            .sidebar { position: fixed; left: -100%; width: 250px; height: 100%; }
            .sidebar.show { left: 0; }
            .main-content { width: 100% !important; margin-left: 0 !important; }
            .overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999; }
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
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #1e293b;
            color: #38bdf8;
        }
        .navbar-custom { background: white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 10px 20px; }
        .sidebar-toggler { background: none; border: none; font-size: 24px; color: #0f172a; display: none; }
        @media (max-width: 768px) { .sidebar-toggler { display: block; } }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Overlay -->
            <div id="sidebarOverlay" class="overlay"></div>

            <div id="sidebar" class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-4 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-plane-departure"></i> Travel Admin</h4>
                    <button class="sidebar-toggler text-white d-md-none" onclick="toggleSidebar()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <nav class="nav flex-column px-3">
                    <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                    <a class="nav-link {{ Request::routeIs('admin.tours.*') ? 'active' : '' }}" href="{{ route('admin.tours.index') }}"><i class="fas fa-map-marked-alt me-2"></i> Quản lý Tour</a>
                    <a class="nav-link {{ Request::routeIs('admin.bookings.*') ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}"><i class="fas fa-calendar-check me-2"></i> Đơn hàng</a>
                    <a class="nav-link {{ Request::routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}"><i class="fas fa-newspaper me-2"></i> Quản lý Bài viết</a>
                    <a class="nav-link {{ Request::routeIs('admin.galleries.*') ? 'active' : '' }}" href="{{ route('admin.galleries.index') }}"><i class="fas fa-images me-2"></i> Quản lý Gallery</a>
                    <a class="nav-link {{ Request::routeIs('admin.reviews.*') ? 'active' : '' }}" href="{{ route('admin.reviews.index') }}"><i class="fas fa-star me-2"></i> Quản lý Review</a>
                    <a class="nav-link {{ Request::routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}"><i class="fas fa-users me-2"></i> Quản lý Tài khoản</a>

                    <hr class="text-white-50">
                    <a class="nav-link text-white-50" href="{{ route('home') }}"><i class="fas fa-home me-2"></i> Về website</a>
                </nav>
            </div>
            <div class="col-md-9 col-lg-10 p-0 main-content">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand navbar-custom mb-4">
                    <div class="container-fluid">
                        <button class="sidebar-toggler me-3" onclick="toggleSidebar()">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h5 class="mb-0">Quản lý Booking</h5>
                    </div>
                </nav>
                <div class="p-4">
                <h2 class="mb-4">Danh sách Đơn đặt tour</h2>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Khách</th>
                                        <th>Tour</th>
                                        <th class="d-none d-md-table-cell">Ngày đặt</th>
                                        <th>Giá</th>
                                        <th>Lệnh</th>
                                        <th>Sửa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td>#{{ $booking->bookingId }}</td>
                                        <td>{{ $booking->userName }}</td>
                                        <td class="text-truncate" style="max-width: 150px;">{{ $booking->tourTitle }}</td>
                                        <td class="d-none d-md-table-cell small">{{ $booking->bookingDate }}</td>
                                        <td class="fw-bold">{{ number_format($booking->totalPrice) }} đ</td>
                                        <td>
                                            <span class="badge @if($booking->bookingStatus == 'canceled') bg-danger @elseif($booking->bookingStatus == 'confirmed') bg-success @else bg-warning @endif">
                                                {{ $booking->bookingStatus }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <form action="{{ route('admin.bookings.update-status', [$booking->bookingId, 'confirmed']) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm btn-success py-1 px-2" title="Xác nhận"><i class="fas fa-check"></i></button>
                                                </form>
                                                <form action="{{ route('admin.bookings.update-status', [$booking->bookingId, 'canceled']) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger py-1 px-2" title="Hủy"><i class="fas fa-times"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
