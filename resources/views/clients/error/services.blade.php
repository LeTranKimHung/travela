@include('clients.blocks.header')
<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">

@php $bannerImg = isset($tours) && $tours->isNotEmpty() ? $tours->first()->images[0] : null; @endphp

{{-- Hero Banner --}}
<div style="background: url('{{ $bannerImg ? asset('clients/img/galery-tour/'.$bannerImg) : asset('clients/img/about-img.jpg') }}') center center/cover no-repeat; padding:130px 0 50px; position:relative;">
    <div style="background:linear-gradient(180deg,rgba(15,23,42,0.7) 0%,rgba(15,23,42,0.45) 100%); position:absolute; inset:0;"></div>
    <div class="container" style="position:relative; z-index:2;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#93c5fd; text-decoration:none;"><i class="fas fa-home me-1"></i>Trang chủ</a></li>
                <li class="breadcrumb-item active" style="color:#fff;">Dịch vụ</li>
            </ol>
        </nav>
        <h1 style="color:#fff; font-weight:700; font-size:2.2rem; margin-bottom:8px;">
            <i class="fas fa-concierge-bell me-2" style="color:#38bdf8;"></i>Dịch Vụ Của Chúng Tôi
        </h1>
        <p style="color:rgba(255,255,255,0.8); font-size:1rem; margin:0;">Trải nghiệm dịch vụ du lịch đẳng cấp, chu đáo từ Travela</p>
    </div>
</div>

{{-- Services Content --}}
<div style="background:#f8fafc;" class="py-5">
    <div class="container py-4">

        <div class="text-center mb-5">
            <div style="display:inline-block; background:#0ea5e920; color:#0ea5e9; font-size:0.78rem; font-weight:700; padding:4px 14px; border-radius:20px; letter-spacing:1px; text-transform:uppercase; margin-bottom:12px;">Dịch vụ</div>
            <h2 style="font-weight:800; color:#0f172a; font-size:1.8rem; margin-bottom:8px;">Những gì chúng tôi cung cấp</h2>
            <p style="color:#64748b; max-width:600px; margin:0 auto;">Từ tour du lịch đến dịch vụ hỗ trợ toàn diện — Travela luôn đồng hành cùng bạn</p>
        </div>

        @php
        $services = [
            ['fas fa-globe','#0ea5e9','Tour Du Lịch Toàn Cầu','Chúng tôi cung cấp các tour du lịch quốc tế chất lượng cao, giúp bạn khám phá thế giới một cách dễ dàng, an toàn và đầy cảm hứng.'],
            ['fas fa-hotel','#10b981','Đặt Phòng Khách Sạn','Dịch vụ đặt phòng tiện lợi, nhanh chóng với đa dạng lựa chọn từ khách sạn bình dân đến 5 sao, phù hợp mọi nhu cầu.'],
            ['fas fa-user-tie','#f59e0b','Hướng Dẫn Viên','Đội ngũ hướng dẫn viên chuyên nghiệp, thân thiện, am hiểu địa phương sẽ đồng hành cùng bạn trên mỗi hành trình.'],
            ['fas fa-calendar-alt','#8b5cf6','Tổ Chức Sự Kiện','Chuyên tổ chức các sự kiện du lịch, hội nghị, tiệc ngoài trời với quy trình chuyên nghiệp và sáng tạo.'],
            ['fas fa-plane','#ef4444','Đặt Vé Máy Bay','Tìm kiếm và đặt vé máy bay giá rẻ, tiện lợi với nhiều hãng bay trong nước và quốc tế.'],
            ['fas fa-headset','#06b6d4','Hỗ Trợ 24/7','Đội ngũ chăm sóc khách hàng sẵn sàng hỗ trợ bạn mọi lúc, mọi nơi, giải đáp mọi thắc mắc.'],
            ['fas fa-camera','#ec4899','Gói Chụp Ảnh','Dịch vụ chụp ảnh chuyên nghiệp trong chuyến đi, lưu giữ những khoảnh khắc đẹp nhất.'],
            ['fas fa-utensils','#84cc16','Ẩm Thực Địa Phương','Trải nghiệm ẩm thực đặc sắc, được hướng dẫn thưởng thức những món ăn ngon nhất địa phương.'],
        ];
        @endphp

        <div class="row g-4 mb-5">
            @foreach($services as [$icon,$color,$title,$desc])
            <div class="col-md-6 col-lg-3">
                <div style="background:#fff; border-radius:16px; padding:28px 22px; height:100%; box-shadow:0 2px 12px rgba(0,0,0,0.06); transition:transform 0.25s, box-shadow 0.25s; text-align:center;"
                     onmouseenter="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 12px 28px rgba(0,0,0,0.12)'"
                     onmouseleave="this.style.transform=''; this.style.boxShadow='0 2px 12px rgba(0,0,0,0.06)'">
                    <div style="width:64px; height:64px; border-radius:18px; background:{{ $color }}18; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                        <i class="{{ $icon }}" style="font-size:1.6rem; color:{{ $color }};"></i>
                    </div>
                    <h6 style="font-weight:700; color:#0f172a; margin-bottom:10px; font-size:0.95rem;">{{ $title }}</h6>
                    <p style="font-size:0.85rem; color:#64748b; line-height:1.7; margin:0;">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- CTA Banner --}}
        <div style="background:linear-gradient(135deg,#0f172a 0%,#1e3a5f 100%); border-radius:20px; padding:48px 40px; text-align:center;">
            <h3 style="color:#fff; font-weight:800; font-size:1.8rem; margin-bottom:12px;">Sẵn sàng lên đường?</h3>
            <p style="color:rgba(255,255,255,0.75); margin-bottom:28px; font-size:1rem;">Hãy để Travela biến chuyến đi mơ ước của bạn thành hiện thực</p>
            <div style="display:flex; gap:12px; justify-content:center; flex-wrap:wrap;">
                <a href="{{ route('packages') }}" style="display:inline-flex; align-items:center; gap:8px; background:linear-gradient(135deg,#0ea5e9,#38bdf8); color:#fff; padding:13px 30px; border-radius:12px; font-weight:600; text-decoration:none; font-size:0.95rem;">
                    <i class="fas fa-map-marked-alt"></i> Xem Tour ngay
                </a>
                <a href="{{ route('contact') }}" style="display:inline-flex; align-items:center; gap:8px; background:rgba(255,255,255,0.15); color:#fff; padding:13px 30px; border-radius:12px; font-weight:600; text-decoration:none; font-size:0.95rem; border:1px solid rgba(255,255,255,0.3);">
                    <i class="fas fa-phone"></i> Liên hệ tư vấn
                </a>
            </div>
        </div>

    </div>
</div>

@include('clients.blocks.footer')
