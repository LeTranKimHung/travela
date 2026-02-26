<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Travela Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f1f5f9; overflow-x: hidden; font-family: 'Segoe UI', sans-serif; }

        /* ===== SIDEBAR ===== */
        .sidebar {
            min-height: 100vh;
            width: 250px;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            color: white;
            position: fixed;
            top: 0; left: 0;
            z-index: 1050;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .sidebar-brand {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .sidebar-brand h5 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .sidebar-brand .brand-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #38bdf8, #0ea5e9);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; margin-right: 10px;
            flex-shrink: 0;
        }
        .sidebar nav { flex: 1; padding: 12px 0; overflow-y: auto; }
        .nav-section-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
            padding: 14px 24px 6px;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.65);
            padding: 10px 16px;
            margin: 2px 12px;
            border-radius: 10px;
            transition: all 0.2s;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar .nav-link i { width: 20px; text-align: center; font-size: 0.9rem; }
        .sidebar .nav-link:hover { background: rgba(255,255,255,0.08); color: #fff; }
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #0ea5e9, #38bdf8);
            color: #fff;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.35);
        }
        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-footer .nav-link { color: rgba(255,255,255,0.5); font-size: 0.85rem; }
        .sidebar-footer .nav-link:hover { color: #fff; background: rgba(255,255,255,0.07); }

        /* ===== MAIN CONTENT ===== */
        .main-wrapper {
            margin-left: 250px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        /* ===== TOP NAVBAR ===== */
        .topbar {
            background: #fff;
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            box-shadow: 0 1px 0 #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 100;
            gap: 16px;
        }
        .topbar .page-title { font-size: 1rem; font-weight: 600; color: #1e293b; margin: 0; }
        .topbar .sidebar-toggle {
            background: none; border: none;
            font-size: 1.2rem; color: #64748b;
            padding: 8px; border-radius: 8px;
            cursor: pointer; display: none;
            transition: background 0.2s;
        }
        .topbar .sidebar-toggle:hover { background: #f1f5f9; }
        .topbar .ms-auto { display: flex; align-items: center; gap: 12px; }
        .topbar .user-badge {
            display: flex; align-items: center; gap: 8px;
            background: #f8fafc; border: 1px solid #e2e8f0;
            padding: 6px 14px; border-radius: 20px;
            font-size: 0.85rem; color: #334155; font-weight: 500;
        }
        .topbar .user-badge i { color: #0ea5e9; }

        /* ===== PAGE CONTENT ===== */
        .page-content { flex: 1; padding: 28px 28px; }

        /* ===== CARDS ===== */
        .card { border: none; border-radius: 14px; box-shadow: 0 1px 4px rgba(0,0,0,0.07); }
        .card-header-custom {
            display: flex; align-items: center; justify-content: space-between;
            padding: 20px 24px; border-bottom: 1px solid #f1f5f9;
        }
        .card-header-custom h5 { margin: 0; font-size: 1rem; font-weight: 600; color: #1e293b; }

        /* ===== TABLE ===== */
        .table thead th {
            background: #f8fafc; font-size: 0.78rem;
            font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.5px; color: #64748b;
            border-bottom: 1px solid #e2e8f0; padding: 12px 16px;
        }
        .table tbody td { padding: 14px 16px; vertical-align: middle; font-size: 0.9rem; }
        .table tbody tr:hover { background: #f8fafc; }

        /* ===== OVERLAY (mobile) ===== */
        .sidebar-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,0.45); z-index: 1040;
        }
        .sidebar-overlay.show { display: block; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
            .topbar .sidebar-toggle { display: block; }
            .page-content { padding: 20px 16px; }
        }

        @yield('styles')
    </style>
    @yield('head')
</head>
<body>
    <!-- Sidebar Overlay (mobile) -->
    <div id="sidebarOverlay" class="sidebar-overlay"></div>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-brand">
            <div class="d-flex align-items-center">
                <div class="brand-icon"><i class="fas fa-plane-departure text-white"></i></div>
                <h5>Travela Admin</h5>
            </div>
            <button class="btn btn-sm d-md-none text-white" onclick="toggleSidebar()" style="background:rgba(255,255,255,0.1);border:none;border-radius:8px;padding:4px 8px;">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <nav class="nav flex-column">
            <span class="nav-section-label">Tổng quan</span>
            <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-chart-pie"></i> Dashboard
            </a>

            <span class="nav-section-label">Quản lý</span>
            <a class="nav-link {{ Request::routeIs('admin.tours.*') ? 'active' : '' }}" href="{{ route('admin.tours.index') }}">
                <i class="fas fa-map-marked-alt"></i> Tour
            </a>
            <a class="nav-link {{ Request::routeIs('admin.bookings.*') ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}">
                <i class="fas fa-calendar-check"></i> Đơn đặt tour
            </a>
            <a class="nav-link {{ Request::routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
                <i class="fas fa-newspaper"></i> Bài viết
            </a>
            <a class="nav-link {{ Request::routeIs('admin.galleries.*') ? 'active' : '' }}" href="{{ route('admin.galleries.index') }}">
                <i class="fas fa-images"></i> Gallery
            </a>
            <a class="nav-link {{ Request::routeIs('admin.reviews.*') ? 'active' : '' }}" href="{{ route('admin.reviews.index') }}">
                <i class="fas fa-star"></i> Review
            </a>
            <a class="nav-link {{ Request::routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users"></i> Tài khoản
            </a>
        </nav>

        <div class="sidebar-footer">
            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                <i class="fas fa-external-link-alt"></i> Xem website
            </a>
            <a class="nav-link" href="{{ route('logout') }}">
                <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </a>
        </div>
    </div>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Topbar -->
        <div class="topbar">
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <h6 class="page-title">@yield('page-title', 'Dashboard')</h6>
            <div class="ms-auto">
                {{-- ===== NOTIFICATION BELL (ADMIN) ===== --}}
                @if(session('username'))
                <div class="dropdown me-3">
                    <button class="btn btn-outline-light border-0 rounded-circle position-relative d-flex align-items-center justify-content-center p-0" 
                            id="notifBell" data-bs-toggle="dropdown" aria-expanded="false" style="width: 40px; height: 40px; background: rgba(0,0,0,0.03);">
                        <i class="fas fa-bell fs-5 text-warning" style="filter: drop-shadow(0 0 2px rgba(0,0,0,0.1));"></i>
                        <span id="notif-badge" class="position-absolute border border-light rounded-circle bg-danger" 
                              style="top: 4px; right: 4px; width: 12px; height: 12px; display: none; box-shadow: 0 0 5px rgba(239, 68, 68, 0.6); z-index: 10;"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2" id="notif-menu" style="width: 350px; border-radius: 12px; padding: 0; overflow: hidden;">
                        <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-light">
                            <h6 class="mb-0 fw-bold">Thông báo</h6>
                            <button onclick="markAllRead()" id="mark-all-btn" class="btn btn-link btn-sm p-0 text-decoration-none small" style="display:none;">Đọc tất cả</button>
                        </div>
                        <div id="notif-list" style="max-height: 350px; overflow-y: auto;">
                            <div class="p-4 text-center text-muted small"><i class="fas fa-spinner fa-spin me-2"></i>Đang tải...</div>
                        </div>
                        <div class="p-2 border-top text-center bg-light bg-opacity-50">
                            <a href="{{ route('admin.bookings.index') }}" class="small text-decoration-none fw-semibold">Quản lý đặt tour</a>
                        </div>
                    </div>
                </div>
                @endif

                <div class="user-badge">
                    <i class="fas fa-user-circle"></i>
                    <span>{{ session('username', 'Admin') }}</span>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="page-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
        if (document.getElementById('sidebarOverlay')) {
            document.getElementById('sidebarOverlay').addEventListener('click', toggleSidebar);
        }

        // ===== Notification JS (Admin) =====
        @if(session('username'))
        const NOTIF_API = '{{ route("notifications.index") }}';
        function pollNotifications() {
            fetch(NOTIF_API, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(r => r.json())
                .then(data => {
                    const badge = document.getElementById('notif-badge');
                    const markAll = document.getElementById('mark-all-btn');
                    if (data.unread > 0) {
                        if (badge) badge.style.display = 'block';
                        if (markAll) markAll.style.display = 'block';
                    } else {
                        if (badge) badge.style.display = 'none';
                        if (markAll) markAll.style.display = 'none';
                    }
                    
                    const list = document.getElementById('notif-list');
                    if (list && data.notifications.length > 0) {
                        list.innerHTML = data.notifications.map(n => `
                            <a href="${n.link || 'javascript:void(0)'}" class="dropdown-item p-3 border-bottom d-flex gap-3 align-items-start ${n.is_read ? '' : 'bg-light'}" onclick="markRead(${n.notifId}, this)">
                                <div class="rounded-circle bg-primary bg-opacity-10 p-2"><i class="${n.icon} text-primary" style="font-size:0.8rem;"></i></div>
                                <div>
                                    <div class="fw-bold small" style="white-space:normal;">${n.title}</div>
                                    <div class="text-muted extra-small" style="font-size:0.75rem; white-space:normal;">${n.message}</div>
                                    <div class="text-primary extra-small mt-1" style="font-size:0.7rem;">${n.time_ago}</div>
                                </div>
                            </a>
                        `).join('');
                    } else if (list) {
                        list.innerHTML = '<div class="p-4 text-center text-muted small">Không có thông báo mới</div>';
                    }
                });
        }
        function markRead(id, el) {
            fetch(`/notifications/${id}/read`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
        }
        function markAllRead() {
            fetch('{{ route("notifications.read-all") }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } }).then(() => pollNotifications());
        }
        // Poll immediately and every 30s
        pollNotifications();
        setInterval(pollNotifications, 30000);
        @endif
    </script>
    @yield('scripts')
</body>
</html>
