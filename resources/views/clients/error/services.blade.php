@include('clients.blocks.header')

@php
    $bannerImg = isset($tours) && $tours->isNotEmpty() ? $tours->first()->images[0] : 'default.jpg';
@endphp
<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">
<div
    style="background: url('{{ asset('clients/img/galery-tour/' . $bannerImg) }}') center center/cover no-repeat; padding: 150px 0 28px 0; position: relative;">
    <div style="background:rgba(155, 155, 158, 0.7); position:absolute; inset:0;"></div>
    <div class="container" style="position:relative; z-index:2;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background:transparent; margin-bottom:0;">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" style="color:#fff; text-decoration:underline;">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color:#fff;">
                    {{ $title ?? 'Service' }}
                </li>
            </ol>
        </nav>

    </div>
</div>
<!-- Header End -->

<!-- Services Start -->
<div class="container-fluid bg-light service py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Dịch Vụ</h5>
            <h1 class="mb-0">Dịch Vụ Của Chúng Tôi</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                            <div class="service-content text-end">
                                <h5 class="mb-4">Tour Du Lịch Toàn Cầu</h5>
                                <p class="mb-0">Chúng tôi cung cấp các tour du lịch quốc tế chất lượng cao, giúp bạn khám phá thế giới một cách dễ dàng, an toàn và đầy cảm hứng.</p>
                            </div>
                            <div class="service-icon p-4">
                                <i class="fa fa-globe fa-4x text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                            <div class="service-content text-end">
                                <h5 class="mb-4">Đặt Phòng Khách Sạn</h5>
                                <p class="mb-0">Dịch vụ đặt phòng tiện lợi, nhanh chóng với đa dạng lựa chọn từ khách sạn bình dân đến 5 sao, phù hợp mọi nhu cầu.</p>
                            </div>
                            <div class="service-icon p-4">
                                <i class="fa fa-hotel fa-4x text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                            <div class="service-content text-end">
                                <h5 class="mb-4">Hướng Dẫn Viên Du Lịch</h5>
                                <p class="mb-0">Đội ngũ hướng dẫn viên chuyên nghiệp, thân thiện, am hiểu địa phương sẽ đồng hành cùng bạn trên mỗi hành trình.</p>
                            </div>
                            <div class="service-icon p-4">
                                <i class="fa fa-user fa-4x text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                            <div class="service-content text-end">
                                <h5 class="mb-4">Tổ Chức Sự Kiện</h5>
                                <p class="mb-0">Chuyên tổ chức các sự kiện du lịch, hội nghị, tiệc ngoài trời... với quy trình chuyên nghiệp và sáng tạo.</p>
                            </div>
                            <div class="service-icon p-4">
                                <i class="fa fa-cog fa-4x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bên phải lặp lại tương tự -->
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                            <div class="service-icon p-4">
                                <i class="fa fa-globe fa-4x text-primary"></i>
                            </div>
                            <div class="service-content">
                                <h5 class="mb-4">Tour Du Lịch Toàn Cầu</h5>
                                <p class="mb-0">Chúng tôi cung cấp các tour du lịch quốc tế chất lượng cao, giúp bạn khám phá thế giới một cách dễ dàng, an toàn và đầy cảm hứng.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                            <div class="service-icon p-4">
                                <i class="fa fa-hotel fa-4x text-primary"></i>
                            </div>
                            <div class="service-content">
                                <h5 class="mb-4">Đặt Phòng Khách Sạn</h5>
                                <p class="mb-0">Dịch vụ đặt phòng tiện lợi, nhanh chóng với đa dạng lựa chọn từ khách sạn bình dân đến 5 sao, phù hợp mọi nhu cầu.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                            <div class="service-icon p-4">
                                <i class="fa fa-user fa-4x text-primary"></i>
                            </div>
                            <div class="service-content">
                                <h5 class="mb-4">Hướng Dẫn Viên Du Lịch</h5>
                                <p class="mb-0">Đội ngũ hướng dẫn viên chuyên nghiệp, thân thiện, am hiểu địa phương sẽ đồng hành cùng bạn trên mỗi hành trình.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                            <div class="service-icon p-4">
                                <i class="fa fa-cog fa-4x text-primary"></i>
                            </div>
                            <div class="service-content">
                                <h5 class="mb-4">Tổ Chức Sự Kiện</h5>
                                <p class="mb-0">Chuyên tổ chức các sự kiện du lịch, hội nghị, tiệc ngoài trời... với quy trình chuyên nghiệp và sáng tạo.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nút -->
            <div class="col-12">
                <div class="text-center">
                    <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="">Xem Thêm Dịch Vụ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('clients.blocks.footer')
