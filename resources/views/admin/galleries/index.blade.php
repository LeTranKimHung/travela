<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Bộ sưu tập - Travel Admin</title>
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
            <div id="sidebarOverlay" class="overlay"></div>
            <div id="sidebar" class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-4 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-plane-departure"></i> Travel Admin</h4>
                    <button class="sidebar-toggler text-white d-md-none" onclick="toggleSidebar()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <nav class="nav flex-column px-3">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                    <a class="nav-link" href="{{ route('admin.tours.index') }}"><i class="fas fa-map-marked-alt me-2"></i> Quản lý Tour</a>
                    <a class="nav-link" href="{{ route('admin.bookings.index') }}"><i class="fas fa-calendar-check me-2"></i> Đơn hàng</a>
                    <a class="nav-link" href="{{ route('admin.posts.index') }}"><i class="fas fa-newspaper me-2"></i> Quản lý Bài viết</a>
                    <a class="nav-link active" href="{{ route('admin.galleries.index') }}"><i class="fas fa-images me-2"></i> Quản lý Gallery</a>
                    <hr class="text-white-50">
                    <a class="nav-link text-white-50" href="{{ route('home') }}"><i class="fas fa-home me-2"></i> Về website</a>
                </nav>
            </div>
            <div class="col-md-9 col-lg-10 p-0 main-content">
                <nav class="navbar navbar-expand navbar-custom mb-4">
                    <div class="container-fluid">
                        <button class="sidebar-toggler me-3" onclick="toggleSidebar()">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h5 class="mb-0">Quản lý Bộ sưu tập ảnh</h5>
                    </div>
                </nav>
                <div class="p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Danh sách ảnh nội bật</h2>
                        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm ảnh mới</a>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">Ảnh</th>
                                            <th>Tiêu đề</th>
                                            <th>Danh mục</th>
                                            <th>Ngày đăng</th>
                                            <th class="pe-4 text-end">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($galleries as $item)
                                        <tr>
                                            <td class="ps-4">
                                                <img src="{{ asset('clients/img/gallery/' . $item->image) }}" class="rounded shadow-sm" style="width: 80px; height: 50px; object-fit: cover;">
                                            </td>
                                            <td>
                                                <div class="fw-bold">{{ $item->title }}</div>
                                            </td>
                                            <td><span class="badge bg-info text-dark">{{ $item->category }}</span></td>
                                            <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                            <td class="pe-4 text-end">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.galleries.edit', $item->galleryId) }}" class="btn btn-sm btn-info text-white" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('admin.galleries.destroy', $item->galleryId) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa ảnh này?')">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Xóa"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if($galleries->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="fas fa-images fa-3x mb-3 d-block"></i>
                                                Chưa có ảnh nào trong bộ sưu tập.
                                            </td>
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
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
        document.getElementById('sidebarOverlay').addEventListener('click', toggleSidebar);
    </script>
</body>
</html>
