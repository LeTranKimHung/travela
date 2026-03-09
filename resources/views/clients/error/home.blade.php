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
        
        <!-- Packages Filter Tabs -->
        <style>
            #packages-filter .nav-item a {
                transition: all 0.3s ease;
            }
            #packages-filter .nav-item a.active {
                background-color: var(--bs-primary) !important;
            }
            #packages-filter .nav-item a.active span {
                color: #fff !important;
                font-weight: 600;
            }
        </style>
        <div class="tab-class text-center">
            <ul class="nav nav-pills d-inline-flex justify-content-center mb-5" id="packages-filter">
                <li class="nav-item">
                    <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active" href="javascript:void(0);">
                        <span class="text-dark" style="width: 150px;">Tất cả</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill" href="javascript:void(0);">
                        <span class="text-dark" style="width: 150px;">Trong nước</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" href="javascript:void(0);">
                        <span class="text-dark" style="width: 150px;">Ngoài nước</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="owl-carousel packages-carousel">
            @foreach ($tours as $tour)
                <div class="packages-item card shadow border-0 mb-4" data-category="all">
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
                        <p class="card-text text-muted mb-2 small" data-destination="{{ $tour->destination }}">
                             <i class="fa fa-map-marker-alt me-2"></i>{{ $tour->destination }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fw-bold text-success">{{ format_currency($tour->priceAdult) }}/người</span>
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
@php
    function isDomesticTour($destination) {
        $vietnamCities = [
            'Hồ Chí Minh', 'Hà Nội', 'Đà Nẵng', 'Hải Phòng', 'Cần Thơ', 'An Giang', 'Bà Rịa - Vũng Tàu',
            'Bắc Giang', 'Bắc Kạn', 'Bạc Liêu', 'Bắc Ninh', 'Bến Tre', 'Bình Định', 'Bình Dương',
            'Bình Phước', 'Bình Thuận', 'Cà Mau', 'Cao Bằng', 'Đắk Lắk', 'Đắk Nông', 'Điện Biên',
            'Đồng Nai', 'Đồng Tháp', 'Gia Lai', 'Hà Giang', 'Hà Nam', 'Hà Tĩnh', 'Hải Dương', 'Hậu Giang',
            'Hòa Bình', 'Hưng Yên', 'Khánh Hòa', 'Kiên Giang', 'Kon Tum', 'Lai Châu', 'Lâm Đồng', 'Lạng Sơn',
            'Lào Cai', 'Long An', 'Nam Định', 'Nghệ An', 'Ninh Bình', 'Ninh Thuận', 'Phú Thọ', 'Quảng Bình',
            'Quảng Nam', 'Quảng Ngãi', 'Quảng Ninh', 'Quảng Trị', 'Sóc Trăng', 'Sơn La', 'Tây Ninh',
            'Thái Bình', 'Thái Nguyên', 'Thanh Hóa', 'Thừa Thiên Huế', 'Tiền Giang', 'Trà Vinh', 'Tuyên Quang',
            'Vĩnh Long', 'Vĩnh Phúc', 'Yên Bái', 'Phú Quốc', 'Sapa', 'Đà Lạt', 'Nha Trang', 'Hạ Long', "TP.HCM"
        ];
        
        foreach ($vietnamCities as $city) {
            if (stripos($destination, $city) !== false) {
                return true;
            }
        }
        return false;
    }
@endphp
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterLinks = document.querySelectorAll('#packages-filter a');
        const owlPackages = $('.packages-carousel');
        
        // Save original items
        let originalItems = [];
        $('.packages-carousel .packages-item').each(function() {
            let itemHtml = $(this).parent().html();
            let dest = $(this).find('[data-destination]').data('destination') || '';
            let isDomestic = false;
            
            // Check logic identical to PHP logic via script
            const vnCities = ['Hồ Chí Minh', 'Hà Nội', 'Đà Nẵng', 'Hải Phòng', 'Cần Thơ', 'An Giang', 'Bà Rịa - Vũng Tàu', 'Bắc Giang', 'Bắc Kạn', 'Bạc Liêu', 'Bắc Ninh', 'Bến Tre', 'Bình Định', 'Bình Dương', 'Bình Phước', 'Bình Thuận', 'Cà Mau', 'Cao Bằng', 'Đắk Lắk', 'Đắk Nông', 'Điện Biên', 'Đồng Nai', 'Đồng Tháp', 'Gia Lai', 'Hà Giang', 'Hà Nam', 'Hà Tĩnh', 'Hải Dương', 'Hậu Giang', 'Hòa Bình', 'Hưng Yên', 'Khánh Hòa', 'Kiên Giang', 'Kon Tum', 'Lai Châu', 'Lâm Đồng', 'Lạng Sơn', 'Lào Cai', 'Long An', 'Nam Định', 'Nghệ An', 'Ninh Bình', 'Ninh Thuận', 'Phú Thọ', 'Quảng Bình', 'Quảng Nam', 'Quảng Ngãi', 'Quảng Ninh', 'Quảng Trị', 'Sóc Trăng', 'Sơn La', 'Tây Ninh', 'Thái Bình', 'Thái Nguyên', 'Thanh Hóa', 'Thừa Thiên Huế', 'Tiền Giang', 'Trà Vinh', 'Tuyên Quang', 'Vĩnh Long', 'Vĩnh Phúc', 'Yên Bái', 'Phú Quốc', 'Sapa', 'Đà Lạt', 'Nha Trang', 'Hạ Long', 'TP.HCM'];
            
            vnCities.forEach(city => {
                if(dest.toLowerCase().includes(city.toLowerCase())) isDomestic = true;
            });
            
            originalItems.push({
                html: itemHtml,
                type: isDomestic ? 'domestic' : 'international'
            });
        });

        filterLinks.forEach((link, idx) => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                filterLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
                
                let filterType = 'all';
                if(idx === 1) filterType = 'domestic';
                else if(idx === 2) filterType = 'international';
                
                // Clear carousel
                let itemsCount = owlPackages.find('.owl-item').length;
                for(let i=0; i<itemsCount; i++) owlPackages.trigger('remove.owl.carousel', [0]);
                
                // Add items based on filter
                originalItems.forEach(item => {
                    if(filterType === 'all' || item.type === filterType) {
                        owlPackages.trigger('add.owl.carousel', [item.html]);
                    }
                });
                
                owlPackages.trigger('refresh.owl.carousel');
            });
        });
    });
</script>

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
                    @foreach($galleries as $index => $item)
                        @php
                            // Tạo layout so le: 2-3-2-3-2
                            $colClass = 'col-sm-6 col-md-6 col-lg-3';
                            if ($index % 5 == 1 || $index % 5 == 3) {
                                $colClass .= ' col-xl-3';
                            } else {
                                $colClass .= ' col-xl-2';
                            }
                        @endphp
                        <div class="{{ $colClass }}">
                            <div class="gallery-item h-100">
                                <img src="{{ asset('clients/img/gallery/' . $item->image) }}" class="img-fluid w-100 h-100 rounded"
                                    alt="{{ $item->title }}">
                                <div class="gallery-content">
                                    <div class="gallery-info">
                                        <h5 class="text-white text-uppercase mb-2">{{ $item->category }}</h5>
                                        <a href="#" class="btn-hover text-white">{{ $item->title }} <i
                                                class="fa fa-arrow-right ms-2"></i></a>
                                    </div>
                                </div>
                                <div class="gallery-plus-icon">
                                    <a href="{{ asset('clients/img/gallery/' . $item->image) }}" data-lightbox="gallery-{{ $item->galleryId }}"
                                        class="my-auto"><i class="fas fa-plus fa-2x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($galleries->isEmpty())
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">Chưa có ảnh nào trong bộ sưu tập. Hãy thêm từ Admin!</p>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Các tab khác có thể lọc theo category nếu cần, tạm thời ẩn hoặc để trống để chờ nâng cấp -->
            <!-- Các tab khác có thể lọc theo category nếu cần, tạm thời ẩn hoặc để trống để chờ nâng cấp -->
        </div>
    </div>
</div>
<!-- Gallery End -->
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
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="blog-item h-100 d-flex flex-column">
                    <div class="blog-img">
                        <div class="blog-img-inner">
                            @if($post->image)
                                <img class="img-fluid w-100 rounded-top" src="{{ asset('clients/img/blog/' . $post->image) }}" alt="{{ $post->title }}" style="height: 250px; object-fit: cover;">
                            @else
                                <img class="img-fluid w-100 rounded-top" src="{{ asset('clients/img/blog-1.jpg') }}" alt="Default" style="height: 250px; object-fit: cover;">
                            @endif
                            <div class="blog-icon">
                                <a href="{{ route('blog-detail', $post->postId) }}" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>
                            </div>
                        </div>
                        <div class="blog-info d-flex align-items-center border border-start-0 border-end-0">
                            <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-calendar-alt text-primary me-2"></i>{{ date('d/m/Y', strtotime($post->created_at)) }}</small>
                            <a href="{{ route('blog-detail', $post->postId) }}" class="btn-hover flex-fill text-center text-white border-end py-2"><i
                                    class="fa fa-thumbs-up text-primary me-2"></i>1.7K</a>
                            <a href="{{ route('blog-detail', $post->postId) }}" class="btn-hover flex-fill text-center text-white py-2"><i
                                    class="fa fa-comments text-primary me-2"></i>1K</a>
                        </div>
                    </div>
                    <div class="blog-content border border-top-0 rounded-bottom p-4 d-flex flex-column flex-grow-1">
                        <p class="mb-3">Đăng bởi: {{ $post->author }} </p>
                        <a href="{{ route('blog-detail', $post->postId) }}" class="h4 text-truncate-2" style="display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; min-height: 3rem;">{{ $post->title }}</a>
                        <p class="my-3 text-truncate-3" style="display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden; flex-grow:1;">{{ $post->summary }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('blog-detail', $post->postId) }}" class="btn btn-primary rounded-pill py-2 px-4">Đọc Thêm</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @if($posts->isEmpty())
                <div class="text-center col-12">
                    <p class="text-muted">Chưa có bài viết nào dư kiến hiển thị ở đây. Hãy thêm bài viết từ Admin!</p>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Blog End -->

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


<!-- Testimonial Start -->
<style>
    .testimonial .testimonial-carousel .owl-nav {
        position: absolute;
        top: 50%;
        width: 100%;
        transform: translateY(-50%);
        display: flex;
        justify-content: space-between;
        pointer-events: none;
        margin-top: 0 !important;
    }
    .testimonial .testimonial-carousel .owl-nav .owl-prev,
    .testimonial .testimonial-carousel .owl-nav .owl-next {
        pointer-events: auto;
        width: 45px;
        height: 45px;
        background: var(--bs-primary, #13357B) !important;
        color: #fff !important;
        border-radius: 50% !important;
        font-size: 20px !important;
        display: flex !important;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        transition: all 0.3s;
    }
    .testimonial .testimonial-carousel .owl-nav .owl-prev:hover,
    .testimonial .testimonial-carousel .owl-nav .owl-next:hover {
        background: var(--bs-primary, #0d2b66) !important;
        transform: scale(1.1);
    }
    .testimonial .testimonial-carousel .owl-nav .owl-prev {
        margin-left: -22px;
    }
    .testimonial .testimonial-carousel .owl-nav .owl-next {
        margin-right: -22px;
    }
    .testimonial .testimonial-carousel {
        position: relative;
    }
    .testimonial .testimonial-carousel .owl-dots {
        margin-top: 25px !important;
    }
    .testimonial .testimonial-comment {
        min-height: 280px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
</style>
<div class="container-fluid testimonial py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Đánh Giá</h5>
            <h1 class="mb-0">Khách Hàng Nói Gì Về Chúng Tôi!</h1>
        </div>
        <div class="testimonial-carousel owl-carousel">
            @foreach($reviews as $review)
            <div class="testimonial-item text-center rounded pb-4">
                <div class="testimonial-comment bg-light rounded p-4">
                    <p class="text-center mb-3">{{ $review->content }}</p>
                    <hr class="mx-auto" style="width: 60px; border-color: var(--bs-primary, #13357B); opacity: 0.5;">
                    <h5 class="mb-1">{{ $review->name }}</h5>
                    <p class="text-muted mb-2" style="font-size: 14px;">{{ $review->location }}</p>
                    <div class="d-flex justify-content-center">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $review->rating ? 'text-primary' : 'text-secondary opacity-25' }}"></i>
                        @endfor
                    </div>
                </div>
            </div>
            @endforeach
            @if($reviews->isEmpty())
            <div class="testimonial-item text-center rounded pb-4">
                <div class="testimonial-comment bg-light rounded p-4">
                    <p class="text-center mb-3">Chưa có đánh giá nào. Hãy thêm đánh giá từ trang Admin!</p>
                    <hr class="mx-auto" style="width: 60px; border-color: var(--bs-primary, #13357B); opacity: 0.5;">
                    <h5 class="mb-1">Travela</h5>
                    <p class="text-muted mb-2" style="font-size: 14px;">Việt Nam</p>
                    <div class="d-flex justify-content-center">
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Testimonial End -->

<!-- Subscribe Start -->
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
</div>
<!-- Subscribe End -->
@include('clients.blocks.footer')
