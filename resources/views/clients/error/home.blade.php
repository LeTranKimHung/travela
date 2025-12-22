@include('clients.blocks.header')
<!-- Carousel Start -->
@include('clients.blocks.banner')
<!-- Carousel End -->
<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">
</div>
<div class="container-fluid search-bar position-relative" style="top: -50%; transform: translateY(-50%);">
    <div class="container">
        <div class="position-relative rounded-pill w-100 mx-auto p-5" style="background: rgba(19, 53, 123, 0.8);">
            <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                placeholder="Eg: Thailand">
            <button type="button" class="btn btn-primary rounded-pill py-2 px-4 position-absolute me-2"
                style="top: 50%; right: 46px; transform: translateY(-50%);">Search</button>
        </div>
    </div>
</div>
<!-- Navbar & Hero End -->

<!-- About Start -->
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
                <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="{{ route('about') }}">Xem Thêm</a>
            </div>
        </div>
    </div>
</div>

<!-- About End -->

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

<!-- Services End -->
<!-- Packages Start -->
<div class="container-fluid packages py-5" id="packages">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Packages</h5>
            <h1 class="mb-0">Awesome Packages</h1>
        </div>
        <div class="owl-carousel packages-carousel">
            @foreach ($tours as $tour)
                <div class="packages-item card shadow border-0 mb-4">
                    <div class="packages-img position-relative">
                        <img src="{{ isset($tour->images[0]) ? asset('clients/img/galery-tour/' . $tour->images[0]) : asset('clients/img/packages-1.jpg') }}"
                            class="img-fluid w-100 rounded-top" alt="Image">
                        @if (isset($tour->discount) && $tour->discount > 0)
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">-{{ $tour->discount }}%</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $tour->title }}</h5>
                        <p class="card-text text-muted mb-2">
                            <i class="fa fa-calendar-alt me-2"></i>{{ $tour->time }}
                            <i class="fa fa-user ms-3 me-2"></i>{{ $tour->quantity }} Người
                        </p>
                        {{-- <p class="card-text">{{ $tour->destination }}</p> --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-success">{{ number_format($tour->priceAdult, 0, ',', '.') }}
                                VND/người</span>
                            <a href="{{route ('tour-detail', ['id' => $tour->tourId])}}" class="btn btn-outline-primary btn-sm rounded-pill">Book now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('packages') }}">Xem Thêm</a>
        </div>
    </div>
</div>
<!-- Packages End -->

<!-- Gallery Start -->
<div class="container-fluid gallery py-5 my-5">
    <div class="mx-auto text-center mb-5" style="max-width: 900px;">
        <h5 class="section-title px-3">Our Gallery</h5>
        <h1 class="mb-4">Tourism & Traveling Gallery.</h1>
        <p class="mb-0">Hãy đăng ký ngay để không bỏ lỡ những tin tức mới nhất, ưu đãi hấp dẫn và thông tin đặc biệt từ chúng tôi. Chúng tôi luôn mang đến cho bạn những trải nghiệm tuyệt vời và cơ hội khám phá nhiều điều thú vị.
        </p>
    </div>
    <div class="tab-class text-center">
        <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
            <li class="nav-item">
                <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active" data-bs-toggle="pill"
                    href="#GalleryTab-1">
                    <span class="text-dark" style="width: 150px;">All</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill" data-bs-toggle="pill"
                    href="#GalleryTab-2">
                    <span class="text-dark" style="width: 150px;">World tour</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill"
                    href="#GalleryTab-3">
                    <span class="text-dark" style="width: 150px;">Ocean Tour</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill"
                    href="#GalleryTab-4">
                    <span class="text-dark" style="width: 150px;">Summer Tour</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill"
                    href="#GalleryTab-5">
                    <span class="text-dark" style="width: 150px;">Sport Tour</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="GalleryTab-1" class="tab-pane fade show p-0 active">
                <div class="row g-2">
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-1.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-1.jpg') }}" data-lightbox="gallery-1"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-2.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-2.jpg') }}" data-lightbox="gallery-2"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-3.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-3.jpg') }}" data-lightbox="gallery-3"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-4.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-4.jpg') }}" data-lightbox="gallery-4"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-5.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-5.jpg') }}" data-lightbox="gallery-5"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-6.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-6.jpg') }}" data-lightbox="gallery-6"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-7.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-7.jpg') }}" data-lightbox="gallery-7"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-2">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-8.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-8.jpg') }}" data-lightbox="gallery-8"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-9.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-9.jpg') }}" data-lightbox="gallery-9"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-2">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-10.jpg') }}"
                                class="img-fluid w-100 h-100 rounded" alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-10.jpg') }}" data-lightbox="gallery-10"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="GalleryTab-2" class="tab-pane fade show p-0">
                <div class="row g-2">
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-2.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-2.jpg') }}" data-lightbox="gallery-2"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-3.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-3.jpg') }}" data-lightbox="gallery-3"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="GalleryTab-3" class="tab-pane fade show p-0">
                <div class="row g-2">
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-2.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-2.jpg') }}" data-lightbox="gallery-2"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-3.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-3.jpg') }}" data-lightbox="gallery-3"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="GalleryTab-4" class="tab-pane fade show p-0">
                <div class="row g-2">
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-2.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-2.jpg') }}" data-lightbox="gallery-2"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-3.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-3.jpg') }}" data-lightbox="gallery-3"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="GalleryTab-5" class="tab-pane fade show p-0">
                <div class="row g-2">
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-2.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-2.jpg') }}" data-lightbox="gallery-2"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                        <div class="gallery-item h-100">
                            <img src="{{ asset('clients/img/gallery-3.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                alt="Image">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">World Tour</h5>
                                    <a href="#" class="btn-hover text-white">View All Place <i
                                            class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ asset('clients/img/gallery-3.jpg') }}" data-lightbox="gallery-3"
                                    class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Gallery End -->



<!-- Blog Start -->
<div class="container-fluid blog py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Blog Của Chúng Tôi</h5>
            <h1 class="mb-4">Các Bài Viết Du Lịch Phổ Biến</h1>
            <p class="mb-0">
                Hãy cùng khám phá những câu chuyện du lịch thú vị, kinh nghiệm hữu ích và địa điểm tuyệt vời
                qua các bài viết mà chúng tôi chia sẻ. Mỗi chuyến đi là một hành trình đầy trải nghiệm và
                kỷ niệm đáng nhớ.
            </p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <div class="blog-img">
                        <div class="blog-img-inner">
                            <img class="img-fluid w-100 rounded-top" src="{{ asset('clients/img/blog-1.jpg') }}" alt="Hình ảnh">
                            <div class="blog-icon">
                                <a href="#" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>
                            </div>
                        </div>
                        <div class="blog-info d-flex align-items-center border border-start-0 border-end-0">
                            <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-calendar-alt text-primary me-2"></i>28 Tháng 1, 2050</small>
                            <a href="#" class="btn-hover flex-fill text-center text-white border-end py-2"><i
                                    class="fa fa-thumbs-up text-primary me-2"></i>1.7K</a>
                            <a href="#" class="btn-hover flex-fill text-center text-white py-2"><i
                                    class="fa fa-comments text-primary me-2"></i>1K</a>
                        </div>
                    </div>
                    <div class="blog-content border border-top-0 rounded-bottom p-4">
                        <p class="mb-3">Đăng bởi: Royal Hamblin </p>
                        <a href="#" class="h4">Chuyến Phiêu Lưu</a>
                        <p class="my-3">Một hành trình tuyệt vời qua những vùng đất mới, nơi cảnh sắc thiên nhiên hòa quyện cùng văn hóa đặc trưng.</p>
                        <a href="#" class="btn btn-primary rounded-pill py-2 px-4">Đọc Thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <div class="blog-img">
                        <div class="blog-img-inner">
                            <img class="img-fluid w-100 rounded-top" src="{{ asset('clients/img/blog-2.jpg') }}" alt="Hình ảnh">
                            <div class="blog-icon">
                                <a href="#" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>
                            </div>
                        </div>
                        <div class="blog-info d-flex align-items-center border border-start-0 border-end-0">
                            <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-calendar-alt text-primary me-2"></i>28 Tháng 1, 2050</small>
                            <a href="#" class="btn-hover flex-fill text-center text-white border-end py-2"><i
                                    class="fa fa-thumbs-up text-primary me-2"></i>1.7K</a>
                            <a href="#" class="btn-hover flex-fill text-center text-white py-2"><i
                                    class="fa fa-comments text-primary me-2"></i>1K</a>
                        </div>
                    </div>
                    <div class="blog-content border border-top-0 rounded-bottom p-4">
                        <p class="mb-3">Đăng bởi: Royal Hamblin </p>
                        <a href="#" class="h4">Khám Phá Văn Hóa</a>
                        <p class="my-3">Trải nghiệm nét văn hóa độc đáo, ẩm thực đặc sản và những phong tục tập quán thú vị của địa phương.</p>
                        <a href="#" class="btn btn-primary rounded-pill py-2 px-4">Đọc Thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <div class="blog-img">
                        <div class="blog-img-inner">
                            <img class="img-fluid w-100 rounded-top" src="{{ asset('clients/img/blog-3.jpg') }}" alt="Hình ảnh">
                            <div class="blog-icon">
                                <a href="#" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>
                            </div>
                        </div>
                        <div class="blog-info d-flex align-items-center border border-start-0 border-end-0">
                            <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-calendar-alt text-primary me-2"></i>28 Tháng 1, 2050</small>
                            <a href="#" class="btn-hover flex-fill text-center text-white border-end py-2"><i
                                    class="fa fa-thumbs-up text-primary me-2"></i>1.7K</a>
                            <a href="#" class="btn-hover flex-fill text-center text-white py-2"><i
                                    class="fa fa-comments text-primary me-2"></i>1K</a>
                        </div>
                    </div>
                    <div class="blog-content border border-top-0 rounded-bottom p-4">
                        <p class="mb-3">Đăng bởi: Royal Hamblin </p>
                        <a href="#" class="h4">Hành Trình Thiên Nhiên</a>
                        <p class="my-3">Khám phá vẻ đẹp hùng vĩ của núi rừng, biển cả và những kỳ quan thiên nhiên tuyệt diệu.</p>
                        <a href="#" class="btn btn-primary rounded-pill py-2 px-4">Đọc Thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tour Booking Start -->
<div class="container-fluid booking py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h5 class="section-booking-title pe-3">Đặt Tour</h5>
                <h1 class="text-white mb-4">Đặt Tour Trực Tuyến</h1>
                <p class="text-white mb-4">
                    Trải nghiệm sự tiện lợi khi đặt tour du lịch trực tuyến. Chúng tôi mang đến cho bạn những lựa chọn tốt nhất với quy trình nhanh chóng, đơn giản và an toàn.
                </p>
                <p class="text-white mb-4">
                    Đặt tour ngay hôm nay để nhận nhiều ưu đãi hấp dẫn và tận hưởng những chuyến đi đáng nhớ cùng bạn bè và gia đình.
                </p>
                <a href="#" class="btn btn-light text-primary rounded-pill py-3 px-5 mt-2">Xem Thêm</a>
            </div>
            <div class="col-lg-6">
                <h1 class="text-white mb-3">Đặt Tour Khuyến Mãi</h1>
                <p class="text-white mb-4">
                    Nhận ngay <span class="text-warning">giảm 50%</span> cho chuyến phiêu lưu đầu tiên cùng Travela. Xem thêm nhiều ưu đãi hấp dẫn tại đây.
                </p>
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control bg-white border-0" id="name"
                                    placeholder="Họ và tên">
                                <label for="name">Họ và tên</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control bg-white border-0" id="email"
                                    placeholder="Email của bạn">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating date" id="date3" data-target-input="nearest">
                                <input type="text" class="form-control bg-white border-0" id="datetime"
                                    placeholder="Ngày & Giờ" data-target="#date3" data-toggle="datetimepicker" />
                                <label for="datetime">Ngày & Giờ</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="select1">
                                    <option value="1">Điểm đến 1</option>
                                    <option value="2">Điểm đến 2</option>
                                    <option value="3">Điểm đến 3</option>
                                </select>
                                <label for="select1">Điểm đến</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="SelectPerson">
                                    <option value="1">1 Người</option>
                                    <option value="2">2 Người</option>
                                    <option value="3">3 Người</option>
                                </select>
                                <label for="SelectPerson">Số lượng người</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="CategoriesSelect">
                                    <option value="1">Trẻ em</option>
                                    <option value="2">1</option>
                                    <option value="3">2</option>
                                    <option value="4">3</option>
                                </select>
                                <label for="CategoriesSelect">Danh mục</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control bg-white border-0" placeholder="Yêu cầu đặc biệt" id="message" style="height: 100px"></textarea>
                                <label for="message">Yêu cầu đặc biệt</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary text-white w-100 py-3" type="submit">Đặt Ngay</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tour Booking End -->
<!-- Blog End -->

{{-- <!-- Testimonial Start -->
<div class="container-fluid testimonial py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Testimonial</h5>
            <h1 class="mb-0">Our Clients Say!!!</h1>
        </div>
        <div class="testimonial-carousel owl-carousel">
            <div class="testimonial-item text-center rounded pb-4">
                <div class="testimonial-comment bg-light rounded p-4">
                    <p class="text-center mb-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis
                        nostrum cupiditate, eligendi repellendus saepe illum earum architecto dicta quisquam quasi
                        porro officiis. Vero reiciendis,
                    </p>
                </div>
                <div class="testimonial-img p-1">
                    <img src="clients/img/testimonial-1.jpg" class="img-fluid rounded-circle" alt="Image">
                </div>
                <div style="margin-top: -35px;">
                    <h5 class="mb-0">John Abraham</h5>
                    <p class="mb-0">New York, USA</p>
                    <div class="d-flex justify-content-center">
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                    </div>
                </div>
            </div>
            <div class="testimonial-item text-center rounded pb-4">
                <div class="testimonial-comment bg-light rounded p-4">
                    <p class="text-center mb-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis
                        nostrum cupiditate, eligendi repellendus saepe illum earum architecto dicta quisquam quasi
                        porro officiis. Vero reiciendis,
                    </p>
                </div>
                <div class="testimonial-img p-1">
                    <img src="clients/img/testimonial-2.jpg" class="img-fluid rounded-circle" alt="Image">
                </div>
                <div style="margin-top: -35px;">
                    <h5 class="mb-0">John Abraham</h5>
                    <p class="mb-0">New York, USA</p>
                    <div class="d-flex justify-content-center">
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                    </div>
                </div>
            </div>
            <div class="testimonial-item text-center rounded pb-4">
                <div class="testimonial-comment bg-light rounded p-4">
                    <p class="text-center mb-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis
                        nostrum cupiditate, eligendi repellendus saepe illum earum architecto dicta quisquam quasi
                        porro officiis. Vero reiciendis,
                    </p>
                </div>
                <div class="testimonial-img p-1">
                    <img src="clients/img/testimonial-3.jpg" class="img-fluid rounded-circle" alt="Image">
                </div>
                <div style="margin-top: -35px;">
                    <h5 class="mb-0">John Abraham</h5>
                    <p class="mb-0">New York, USA</p>
                    <div class="d-flex justify-content-center">
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                    </div>
                </div>
            </div>
            <div class="testimonial-item text-center rounded pb-4">
                <div class="testimonial-comment bg-light rounded p-4">
                    <p class="text-center mb-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis
                        nostrum cupiditate, eligendi repellendus saepe illum earum architecto dicta quisquam quasi
                        porro officiis. Vero reiciendis,
                    </p>
                </div>
                <div class="testimonial-img p-1">
                    <img src="clients/img/testimonial-4.jpg" class="img-fluid rounded-circle" alt="Image">
                </div>
                <div style="margin-top: -35px;">
                    <h5 class="mb-0">John Abraham</h5>
                    <p class="mb-0">New York, USA</p>
                    <div class="d-flex justify-content-center">
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- Testimonial End -->

{{-- <!-- Subscribe Start -->
<div class="container-fluid subscribe py-5">
    <div class="container text-center py-5">
        <div class="mx-auto text-center" style="max-width: 900px;">
            <h5 class="subscribe-title px-3">Đăng ký</h5>
            <h1 class="text-white mb-4">Bản Tin Của Chúng Tôi</h1>
            <p class="text-white mb-5">
                Hãy đăng ký ngay để nhận những thông tin mới nhất, ưu đãi đặc biệt và các tin tức thú vị từ chúng tôi.
                Đừng bỏ lỡ cơ hội trải nghiệm những hành trình tuyệt vời cùng nhiều ưu đãi hấp dẫn.
            </p>
            <div class="position-relative mx-auto">
                <input class="form-control border-primary rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                    placeholder="Nhập email của bạn">
                <button type="button"
                    class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 px-4 mt-2 me-2">Đăng ký</button>
            </div>
        </div>
    </div>
</div> --}}

<!-- Subscribe End -->
@include('clients.blocks.footer')
