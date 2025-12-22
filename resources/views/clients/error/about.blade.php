@include('clients.blocks.header')

@php
    $bannerImg = isset($tours) && $tours->isNotEmpty() ? $tours->first()->images[0] : 'default.jpg';
@endphp
<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">
<div
    style="background: url('{{ asset('clients/img/galery-tour/' . $bannerImg) }}') center center/cover no-repeat; padding: 150px 0 28px 0; position: relative;">
    <div style="background:rgba(59, 59, 76, 0.7); position:absolute; inset:0;"></div>
    <div class="container" style="position:relative; z-index:2;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background:transparent; margin-bottom:0;">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" style="color:#fff; text-decoration:underline;">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color:#fff;">
                    {{ $title ?? 'About' }}
                </li>
            </ol>
        </nav>

    </div>
</div>
<div class="container-fluid about py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                    <img src="clients/img/about-img.jpg" class="img-fluid w-100 h-100" alt="">
                </div>
            </div>
            <div class="col-lg-7"
                style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(clients/img/about-img-1.png);">
                <h5 class="section-about-title pe-3">Về Chúng Tôi</h5>
                <h1 class="mb-4">Chào mừng đến với <span class="text-primary">Travela</span></h1>
                <p class="mb-4">Chúng tôi tự hào là đơn vị cung cấp dịch vụ du lịch hàng đầu, mang đến cho khách hàng những trải nghiệm tuyệt vời và đáng nhớ. Với đội ngũ chuyên nghiệp và tận tâm, Travela cam kết làm hài lòng mọi nhu cầu du lịch của bạn.</p>
                <p class="mb-4">Từ các chuyến bay hạng sang, khách sạn cao cấp, đến các tour tham quan độc đáo, chúng tôi luôn chú trọng đến từng chi tiết để đảm bảo chuyến đi của bạn trở nên hoàn hảo.</p>
                <div class="row gy-2 gx-4 mb-4">
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Chuyến bay hạng nhất</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Khách sạn được chọn lọc kỹ lưỡng</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Lưu trú 5 sao</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Phương tiện hiện đại</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>150 tour tham quan thành phố cao cấp</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Hỗ trợ 24/7</p>
                    </div>
                </div>
                <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="">Xem Thêm</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

@include('clients.blocks.footer')
