@php
    $username = session('username');
    $avatar = session('avatar');
    $isAdmin = session('admin');
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Travela' }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('clients/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('clients/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('clients/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('clients/css/style.css') }}" rel="stylesheet">

    <style>
        .user-dropdown-toggle {
            display: flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 50px;
            background: #fff;
            border: 1px solid #e9ecef;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .user-dropdown-toggle:hover {
            background: #f8f9fa;
            border-color: #dee2e6;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transform: translateY(-1px);
        }
        .user-avatar-top {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .dropdown-menu-user {
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.12);
            border-radius: 16px;
            padding: 8px;
            margin-top: 12px !important;
            min-width: 220px;
            border: 1px solid rgba(0,0,0,0.05);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        .dropdown-menu-user .dropdown-item {
            padding: 10px 16px;
            border-radius: 12px;
            font-weight: 500;
            color: #495057;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }
        .dropdown-menu-user .dropdown-item:hover {
            background: rgba(19, 53, 123, 0.05);
            color: #13357b;
            transform: translateX(4px);
        }
        .dropdown-menu-user .dropdown-item i {
            width: 24px;
            font-size: 1.1rem;
            color: #13357b;
            margin-right: 8px;
        }

        /* Search Bar Styles - Premium Look */
        .header-search {
            position: relative;
            margin-right: 24px;
            width: 280px;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .header-search:focus-within {
            width: 380px;
        }
        .header-search .form-control {
            border-radius: 50px;
            padding: 0 90px 0 20px;
            border: 1.5px solid #e9ecef;
            height: 48px;
            background: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
            transition: all 0.3s ease;
        }
        .header-search .form-control:focus {
            border-color: #13357b;
            box-shadow: 0 8px 20px rgba(19, 53, 123, 0.08);
            outline: none;
        }
        .header-search .search-btn {
            position: absolute;
            right: 4px;
            top: 4px;
            border-radius: 50px;
            padding: 0;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #13357b 0%, #2c52a1 100%);
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(19, 53, 123, 0.2);
        }
        .header-search .search-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(19, 53, 123, 0.3);
        }
        .header-search .mic-btn {
            position: absolute;
            right: 52px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            cursor: pointer;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .header-search .mic-btn:hover {
            color: #13357b;
            background: rgba(19, 53, 123, 0.05);
        }
        .header-search .mic-btn.active {
            color: #fff;
            background: #ff4757;
            animation: pulse-mic 1.2s infinite ease-in-out;
            box-shadow: 0 0 15px rgba(255, 71, 87, 0.4);
        }
        @keyframes pulse-mic {
            0% { transform: translateY(-50%) scale(1); }
            50% { transform: translateY(-50%) scale(1.2); }
            100% { transform: translateY(-50%) scale(1); }
        }

        /* Voice Status Overlay */
        .voice-overlay {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.85);
            color: #fff;
            padding: 30px 50px;
            border-radius: 24px;
            z-index: 9999;
            display: none;
            flex-direction: column;
            align-items: center;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .voice-overlay.show { display: flex; animation: fadeIn 0.3s ease; }
        .voice-waves {
            display: flex;
            align-items: center;
            height: 40px;
            gap: 4px;
            margin-bottom: 20px;
        }
        .voice-wave {
            width: 4px;
            background: #13357b;
            border-radius: 4px;
            animation: wave 1s infinite ease-in-out;
        }
        @keyframes wave {
            0%, 100% { height: 10px; }
            50% { height: 35px; }
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>

<body class="login-page-body">
    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0 login-navbar-wrap">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="{{ route('home') }}" class="navbar-brand p-0">
                <img style="border-radius: 50px;" src="{{ asset('clients/img/logo.jpg') }} " alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="{{ route('home') }}"
                        class="nav-item nav-link {{ Request::routeIs('home') ? 'active' : '' }}">Trang chủ</a>
                    <a href="{{ route('about') }}"
                        class="nav-item nav-link {{ Request::routeIs('about') ? 'active' : '' }}">Giới thiệu</a>
                    <a href="{{ route('services') }}"
                        class="nav-item nav-link {{ Request::routeIs('services') ? 'active' : '' }}">Dịch vụ</a>
                    <a href="{{ route('packages') }}"
                        class="nav-item nav-link {{ Request::routeIs('packages') ? 'active' : '' }}">Gói du lịch</a>
                    <a href="{{ route('blog') }}"
                        class="nav-item nav-link {{ Request::routeIs('blog') ? 'active' : '' }}">Tin tức</a>
                    <a href="{{ route('contact') }}"
                        class="nav-item nav-link {{ Request::routeIs('contact') ? 'active' : '' }}">Liên hệ</a>
                </div>
                <div class="d-flex align-items-center">
                    <!-- Search Bar -->
                    <form action="{{ route('packages') }}" method="GET" class="header-search d-none d-lg-block" id="voice-search-form">
                        <input type="text" name="destination" id="search-input" class="form-control" placeholder="Tìm điểm đến...">
                        <i class="fas fa-microphone mic-btn" id="mic-btn" title="Tìm bằng giọng nói"></i>
                        <button type="submit" class="btn btn-primary search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    @if($username)
                    {{-- ===== NOTIFICATION BELL ===== --}}
                    <div class="dropdown me-2" id="notif-dropdown-wrap">
                        <button class="btn position-relative notif-bell-btn" id="notifBell"
                                data-bs-toggle="dropdown" aria-expanded="false"
                                title="Thông báo"
                                style="width:42px; height:42px; border-radius:50%; background:#fff; border:1.5px solid #e9ecef; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(0,0,0,0.06); transition:all 0.2s; padding:0;"
                                onmouseenter="this.style.background='#f1f5f9'; this.style.transform='translateY(-1px)'"
                                onmouseleave="this.style.background='#fff'; this.style.transform=''">
                            <i class="fas fa-bell" style="font-size:1rem; color:#475569;"></i>
                            <span id="notif-badge" style="position:absolute; top:4px; right:4px; background:#ef4444; color:#fff; font-size:0.6rem; font-weight:700; min-width:16px; height:16px; border-radius:8px; display:none; align-items:center; justify-content:center; padding:0 3px; line-height:16px; border:2px solid #fff;"></span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end" id="notif-menu"
                             style="width:360px; border:none; box-shadow:0 12px 40px rgba(0,0,0,0.14); border-radius:16px; padding:0; overflow:hidden; margin-top:10px !important;">

                            {{-- Header --}}
                            <div style="background:linear-gradient(135deg,#0f172a,#1e3a5f); padding:14px 18px; display:flex; align-items:center; justify-content:space-between;">
                                <span style="color:#fff; font-weight:700; font-size:0.92rem;">
                                    <i class="fas fa-bell me-2" style="color:#38bdf8;"></i>Thông báo
                                    <span id="notif-count-label" style="background:rgba(255,255,255,0.2); color:#fff; font-size:0.7rem; padding:2px 8px; border-radius:20px; margin-left:6px; display:none;"></span>
                                </span>
                                <button onclick="markAllRead()" id="mark-all-btn" style="display:none; background:rgba(255,255,255,0.15); border:none; color:#93c5fd; font-size:0.75rem; padding:4px 10px; border-radius:8px; cursor:pointer; transition:background 0.2s;" onmouseenter="this.style.background='rgba(255,255,255,0.25)'" onmouseleave="this.style.background='rgba(255,255,255,0.15)'">
                                    Đọc tất cả
                                </button>
                            </div>

                            {{-- List --}}
                            <div id="notif-list" style="max-height:380px; overflow-y:auto; padding:8px;">
                                <div id="notif-loading" style="text-align:center; padding:30px; color:#94a3b8; font-size:0.88rem;">
                                    <i class="fas fa-spinner fa-spin me-2"></i>Đang tải...
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div style="border-top:1px solid #f1f5f9; padding:10px 14px; text-align:center;">
                                <a href="{{ route('profile') }}#pills-history" style="font-size:0.82rem; color:#0ea5e9; text-decoration:none; font-weight:600;">
                                    <i class="fas fa-history me-1"></i>Xem lịch sử đặt tour
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="dropdown me-3">
                        @if($username)
                            <a class="dropdown-toggle user-dropdown-toggle text-dark text-decoration-none" href="#" role="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                @if($avatar)
                                    <img src="{{ asset($avatar) }}" class="user-avatar-top me-2" alt="avatar">
                                @else
                                    <div class="user-avatar-top me-2 bg-primary d-flex align-items-center justify-content-center text-white">
                                        <i class="fa fa-user"></i>
                                    </div>
                                @endif
                                <span class="d-none d-lg-inline fw-bold">{{ $username }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-user" aria-labelledby="userMenu">
                                <li>
                                    <div class="px-3 py-2 border-bottom mb-2">
                                        <span class="d-block small text-muted">Xin chào,</span>
                                        <span class="fw-bold">{{ $username }}</span>
                                    </div>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fa fa-id-card me-2"></i> Hồ sơ cá nhân</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile') }}#pills-history"><i class="fa fa-history me-2"></i> Lịch sử đặt tour</a></li>
                                @if($isAdmin)
                                    <li><a class="dropdown-item text-primary" href="{{ route('admin.dashboard') }}"><i class="fa fa-user-shield me-2"></i> Trang Quản trị</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fa fa-sign-out-alt me-2"></i> Đăng xuất</a></li>
                            </ul>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary rounded-pill py-2 px-4 shadow-sm">
                                <i class="fa fa-sign-in-alt me-2"></i>Đăng nhập
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- Toast Container for Notifications -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 10000;">
        <div id="notif-toast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15); overflow: hidden;">
            <div class="toast-header" style="background: #13357b; color: #fff; border: none;">
                <i class="fas fa-bell me-2"></i>
                <strong class="me-auto">Thông báo mới</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" style="background: #fff; padding: 15px;">
                <div id="toast-title" style="font-weight: 700; color: #0f172a; margin-bottom: 5px; font-size: 0.9rem;"></div>
                <div id="toast-message" style="font-size: 0.82rem; color: #64748b; line-height: 1.4;"></div>
                <div class="mt-2 pt-2 border-top">
                    <a id="toast-link" href="#" class="btn btn-primary btn-sm rounded-pill" style="font-size: 0.75rem; padding: 4px 12px;">Xem chi tiết</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Voice Status Overlay UI -->
    <div id="voice-overlay" class="voice-overlay">
        <div class="voice-waves">
            <div class="voice-wave" style="animation-delay: 0.1s"></div>
            <div class="voice-wave" style="animation-delay: 0.2s"></div>
            <div class="voice-wave" style="animation-delay: 0.3s"></div>
            <div class="voice-wave" style="animation-delay: 0.4s"></div>
            <div class="voice-wave" style="animation-delay: 0.5s"></div>
        </div>
        <h4 class="mb-2">Đang lắng nghe...</h4>
        <p class="text-white-50 small mb-0">Nói từ khóa bạn muốn tìm kiếm</p>
    </div>

    <!-- Voice Search JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const micBtn = document.getElementById('mic-btn');
            const searchInput = document.getElementById('search-input');
            const searchForm = document.getElementById('voice-search-form');
            const voiceOverlay = document.getElementById('voice-overlay');

            if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
                const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                const recognition = new SpeechRecognition();

                recognition.lang = 'vi-VN';
                recognition.interimResults = false;
                recognition.maxAlternatives = 1;

                micBtn.addEventListener('click', function() {
                    if (micBtn.classList.contains('active')) {
                        recognition.stop();
                    } else {
                        recognition.start();
                    }
                });

                recognition.onstart = function() {
                    micBtn.classList.add('active');
                    voiceOverlay.classList.add('show');
                    searchInput.placeholder = "Đang nhận diện...";
                };

                recognition.onresult = function(event) {
                    const transcript = event.results[0][0].transcript;
                    searchInput.value = transcript;
                    micBtn.classList.remove('active');
                    voiceOverlay.classList.remove('show');
                    // Gửi form tự động khi có kết quả
                    searchForm.submit();
                };

                recognition.onspeechend = function() {
                    recognition.stop();
                    micBtn.classList.remove('active');
                    voiceOverlay.classList.remove('show');
                };

                recognition.onerror = function(event) {
                    micBtn.classList.remove('active');
                    voiceOverlay.classList.remove('show');
                    searchInput.placeholder = "Lỗi giọng nói...";
                    console.error('Speech recognition error:', event.error);
                };

                recognition.onend = function() {
                    micBtn.classList.remove('active');
                    voiceOverlay.classList.remove('show');
                    searchInput.placeholder = "Tìm điểm đến...";
                };
            } else {
                micBtn.style.display = 'none';
                console.warn('Trình duyệt không hỗ trợ tìm kiếm bằng giọng nói.');
            }
        });
    </script>

@if(session('userId'))
<script>
// ===== Notification System =====
const NOTIF_API  = '{{ route("notifications.index") }}';
const CSRF_TOKEN = '{{ csrf_token() }}';

let notifLoaded  = false;

function updateBadge(count) {
    const badge = document.getElementById('notif-badge');
    const countLbl = document.getElementById('notif-count-label');
    const markAllBtn = document.getElementById('mark-all-btn');
    if (!badge) return;
    if (count > 0) {
        badge.style.display    = 'flex';
        badge.textContent      = count > 99 ? '99+' : count;
        if (countLbl) { countLbl.style.display = 'inline'; countLbl.textContent = count + ' chưa đọc'; }
        if (markAllBtn) markAllBtn.style.display = 'block';
        // Shake animation khi có thông báo mới
        const bell = document.getElementById('notifBell');
        if (bell) { bell.style.animation = 'notif-shake 0.4s ease'; setTimeout(() => bell.style.animation = '', 400); }
    } else {
        badge.style.display = 'none';
        if (countLbl) countLbl.style.display = 'none';
        if (markAllBtn) markAllBtn.style.display = 'none';
    }
}

function renderNotifications(notifications, unread) {
    const list = document.getElementById('notif-list');
    if (!list) return;
    updateBadge(unread);

    if (!notifications || notifications.length === 0) {
        list.innerHTML = `
            <div style="text-align:center; padding:40px 20px; color:#94a3b8;">
                <i class="fas fa-bell-slash" style="font-size:2.5rem; margin-bottom:12px; display:block; opacity:0.4;"></i>
                <p style="margin:0; font-size:0.88rem;">Bạn chưa có thông báo nào</p>
            </div>`;
        return;
    }

    list.innerHTML = notifications.map(n => {
        const isUnread = !n.is_read;
        return `
        <div class="notif-item" data-id="${n.notifId}" data-link="${n.link || ''}"
             onclick="handleNotifClick(this)"
             style="display:flex; gap:12px; padding:10px 12px; border-radius:12px; cursor:pointer; transition:background 0.15s; ${isUnread ? 'background:#f0f9ff;' : ''}; margin-bottom:2px;"
             onmouseenter="this.style.background='#f8fafc'"
             onmouseleave="this.style.background='${isUnread ? '#f0f9ff' : 'transparent'}'">
            <div style="width:38px; height:38px; border-radius:50%; background:${n.color}20; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:2px;">
                <i class="${n.icon}" style="color:${n.color}; font-size:0.9rem;"></i>
            </div>
            <div style="flex:1; min-width:0;">
                <div style="font-weight:${isUnread ? '700' : '500'}; font-size:0.82rem; color:#0f172a; margin-bottom:2px; line-height:1.3;">${n.title}</div>
                <div style="font-size:0.78rem; color:#64748b; line-height:1.4; margin-bottom:4px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">${n.message}</div>
                <div style="font-size:0.7rem; color:#94a3b8;">${n.time_ago}</div>
            </div>
            ${isUnread ? '<div style="width:8px; height:8px; background:#0ea5e9; border-radius:50%; flex-shrink:0; margin-top:6px; box-shadow:0 0 6px rgba(14,165,233,0.5);"></div>' : ''}
        </div>`;
    }).join('');
}

function handleNotifClick(el) {
    const id   = el.dataset.id;
    const link = el.dataset.link;

    // Mark as read
    fetch(`/notifications/${id}/read`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Content-Type': 'application/json' }
    }).then(() => {
        el.style.background = 'transparent';
        const dot = el.querySelector('div[style*="0ea5e9"]');
        if (dot) dot.remove();
        // Cập nhật badge
        const badge = document.getElementById('notif-badge');
        if (badge && badge.style.display !== 'none') {
            let count = parseInt(badge.textContent) - 1;
            updateBadge(count > 0 ? count : 0);
        }
    });

    // Navigate nếu có link
    if (link) {
        setTimeout(() => { window.location.href = link; }, 150);
    }
}

function markAllRead() {
    fetch('/notifications/read-all', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Content-Type': 'application/json' }
    }).then(() => {
        updateBadge(0);
        // Xóa dấu chấm xanh và highlight
        document.querySelectorAll('.notif-item').forEach(el => {
            el.style.background = 'transparent';
            const dot = el.querySelector('div[style*="0ea5e9"]');
            if (dot) dot.remove();
        });
        notifLoaded = false; // Force reload next open
    });
}

function loadNotifications() {
    fetch(NOTIF_API, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(r => r.json())
        .then(data => {
            notifLoaded = true;
            renderNotifications(data.notifications, data.unread);
        })
        .catch(() => {
            const list = document.getElementById('notif-list');
            if (list) list.innerHTML = '<div style="text-align:center;padding:20px;color:#94a3b8;font-size:0.85rem;">Không thể tải thông báo</div>';
        });
}

// Load khi mở dropdown
const notifBell = document.getElementById('notifBell');
if (notifBell) {
    notifBell.addEventListener('click', function () {
        if (!notifLoaded) loadNotifications();
    });
}

// Poll: kiểm tra badge mỗi 30s (background, nhẹ)
let lastPollUnread = -1;
let highestNotifId = parseInt(localStorage.getItem('highestNotifId') || '0');

function showToast(notif) {
    const toastEl = document.getElementById('notif-toast');
    if (!toastEl) return;
    
    document.getElementById('toast-title').textContent = notif.title;
    document.getElementById('toast-message').textContent = notif.message;
    const link = document.getElementById('toast-link');
    if (notif.link) {
        link.style.display = 'inline-block';
        link.href = notif.link;
    } else {
        link.style.display = 'none';
    }
    
    const toast = new bootstrap.Toast(toastEl, { delay: 10000 });
    toast.show();
}

function pollBadge() {
    fetch(NOTIF_API, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(r => r.json())
        .then(d => { 
            const currentUnread = d.unread;
            
            // Nếu có thông báo mới (unread count tăng lên)
            if (lastPollUnread !== -1 && currentUnread > lastPollUnread) {
                // Lấy thông báo mới nhất để hiện toast
                if (d.notifications && d.notifications.length > 0) {
                    const latest = d.notifications[0];
                    if (latest.notifId > highestNotifId) {
                        showToast(latest);
                        highestNotifId = latest.notifId;
                        localStorage.setItem('highestNotifId', highestNotifId);
                    }
                }
            }
            
            // Cập nhật mốc ID cao nhất nếu lần đầu load
            if (highestNotifId === 0 && d.notifications && d.notifications.length > 0) {
                highestNotifId = d.notifications[0].notifId;
                localStorage.setItem('highestNotifId', highestNotifId);
            }

            updateBadge(currentUnread); 
            lastPollUnread = currentUnread;
            notifLoaded = false; // invalidate cache
        })
        .catch(() => {});
}
// Lần đầu load badge ngay
pollBadge();
// Sau đó mỗi 30 giây
setInterval(pollBadge, 30000);
</script>

<style>
@keyframes notif-shake {
    0%, 100% { transform: rotate(0); }
    20%       { transform: rotate(-12deg); }
    40%       { transform: rotate(12deg); }
    60%       { transform: rotate(-8deg); }
    80%       { transform: rotate(8deg); }
}
/* Custom scrollbar cho danh sách thông báo */
#notif-list::-webkit-scrollbar { width: 4px; }
#notif-list::-webkit-scrollbar-track { background: #f8fafc; }
#notif-list::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
</style>
@endif
