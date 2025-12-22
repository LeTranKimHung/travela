@include('clients.blocks.header')
@php
    $bannerImg = $tourDetail->images[0] ?? 'default.jpg';
@endphp
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
                    Chi tiết tour
                </li>
            </ol>
        </nav>
        <h1 style="color:#fff; font-size:2rem ; font-weight:700; margin-top:10px;">
            {{ $tourDetail->title }}
        </h1>
    </div>
</div>
<!-- Banner Breadcrumb End -->
<div class="tour-detail-container">
    <div class="row" style="display: flex; flex-wrap: wrap; gap: 32px;">
        <div class="col-lg-7" style="flex: 1 1 400px; min-width: 320px;">
            {{-- Gallery --}}
            @php $mainImg = $tourDetail->images[0] ?? 'default.jpg'; @endphp
            <img id="mainTourImg" src="{{ asset('clients/img/galery-tour/' . $mainImg) }}" alt="Tour image"
                class="tour-gallery-main">
            <div class="tour-gallery-thumbs">
                @foreach ($tourDetail->images as $idx => $img)
                    <img src="{{ asset('clients/img/galery-tour/' . $img) }}" alt="Gallery thumb"
                        class="tour-gallery-thumb{{ $idx === 0 ? ' active' : '' }}"
                        onclick="document.getElementById('mainTourImg').src=this.src; document.querySelectorAll('.tour-gallery-thumb').forEach(e=>e.classList.remove('active')); this.classList.add('active');">
                @endforeach
            </div>
            <div class="tour-desc">
                <div class="tour-section-title">Mô tả tour</div>
                <div>{!! $tourDetail->description !!}</div>
            </div>
            <div class="tour-section-title">Lịch trình chi tiết</div>
            @php
                $day = 1;
            @endphp
            <div class="tour-timeline">
                @foreach ($tourDetail->timeline as $timeline)
                    <div class="accordion-item">
                        <h5 class="accordion-header">
                            <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo{{ $timeline->timeLineId }}">
                                Ngày {{ $day++ }} - {{ $timeline->title }}
                            </button>
                        </h5>
                        <div id="collapseTwo{{ $timeline->timeLineId }}" class="accordion-collapse collapse"
                            data-bs-parent="#faq-accordion-two">
                            <div class="accordion-body">
                                <p>{!! $timeline->description !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row" style="display: flex; gap: 24px;">
                <div class="col-md-6" style="flex:1;">
                    <div class="tour-section-title">Bao gồm</div>
                    <ul class="tour-include-list">
                        <li><i class="fas fa-check"></i> Đưa đón sân bay</li>
                        <li><i class="fas fa-check"></i> Hướng dẫn viên chuyên nghiệp</li>
                        <li><i class="fas fa-check"></i> Ăn sáng miễn phí</li>
                        <li><i class="fas fa-check"></i> Vé tham quan</li>
                        <li><i class="fas fa-check"></i> Bảo hiểm du lịch</li>
                    </ul>
                </div>
                <div class="col-md-6" style="flex:1;">
                    <div class="tour-section-title">Không bao gồm</div>
                    <ul class="tour-exclude-list">
                        <li><i class="fas fa-times"></i> Chi phí cá nhân</li>
                        <li><i class="fas fa-times"></i> Đồ uống ngoài chương trình</li>
                        <li><i class="fas fa-times"></i> Tiền tip hướng dẫn viên</li>
                        <li><i class="fas fa-times"></i> Thuế VAT</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-5" style="flex: 1 1 300px; min-width: 280px;">
            <div>
                <div class="tour-title">{{ $tourDetail->title }}</div>
                <div class="tour-meta">
                    <span><i class="fas fa-map-marker-alt"></i> {{ $tourDetail->destination }}</span> |
                    <span><i class="fas fa-clock"></i> {{ $tourDetail->time ?? 'N/A' }}</span>
                </div>
                <div class="tour-price">
                    <div class="tour-price-adult">
                        Người lớn: {{ number_format($tourDetail->priceAdult, 0, ',', '.') }} VND/người
                    </div>
                    <div class="tour-price-child">
                        Trẻ em: {{ number_format($tourDetail->priceChild, 0, ',', '.') }} VND/người
                    </div>
                    <div class="tour-dates">
                        <span><i class="fas fa-calendar-alt"></i> Ngày khởi hành: {{ \Carbon\Carbon::parse($tourDetail->startDate)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y') }}</span>
                        <span><i class="fas fa-calendar-check"></i> Ngày kết thúc: {{ \Carbon\Carbon::parse($tourDetail->endDate)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y') }}</span>
                    </div>
                    <a href="{{ route('booking') }}" class="tour-book-btn">Đặt tour ngay</a>
                </div>
            </div>
            <div class="tour-contact-box">
                <div style="font-weight:600; color:#1a237e; margin-bottom:8px;">Cần tư vấn? Liên hệ:</div>
                <div><i class="fas fa-envelope"></i> <a href="mailto:hungltk2004@gmail.com">hungltk2004@gmail.com</a>
                </div>
                <div><i class="fas fa-phone"></i> <a href="tel:+00012345688">+000 (123) 456 88</a></div>
            </div>
        </div>
    </div>
</div>

@include('clients.blocks.footer')
