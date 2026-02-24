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
