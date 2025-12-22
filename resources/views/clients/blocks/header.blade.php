<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Travela</title>
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
</head>

<body>
    <!-- Spinner Start -->
    {{-- <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> --}}
    <!-- Spinner End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="{{ route('home') }}" class="navbar-brand p-0">
                {{-- <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>Travela</h1> --}}
                <img style="border-radius: 50px;" src="{{ asset('clients/img/logo.jpg') }} " alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
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
                <ul class="navbar-nav ms-auto flex-row align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user me-1"></i>
                            @auth
                                {{-- Hiển thị userName từ bảng tbl_user khi đã đăng nhập --}}
                                {{ Auth::user()->userName }}
                            @else
                                {{-- Hiển thị icon user mặc định khi chưa đăng nhập --}}
                            @endauth
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            @guest
                                {{-- Hiển thị khi chưa đăng nhập --}}
                                <li><a class="dropdown-item" href="{{ route('login') }}">Đăng nhập</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Đăng ký</a></li>
                            @else
                                
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Thông tin cá nhân</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    {{-- Form đăng xuất (bắt buộc dùng POST để bảo mật trong Laravel) --}}
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Đăng xuất</button>
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </li>
                    <li class="nav-item ms-3">
                        <a href="#" class="btn btn-primary rounded-pill py-2 px-4">Đặt ngay</a>
                    </li>
                </ul>
            </div>
        </nav>
