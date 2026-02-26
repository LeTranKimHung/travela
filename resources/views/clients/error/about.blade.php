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
                <li class="breadcrumb-item active" style="color:#fff;">Về chúng tôi</li>
            </ol>
        </nav>
        <h1 style="color:#fff; font-weight:700; font-size:2.2rem; margin-bottom:8px;">
            <i class="fas fa-info-circle me-2" style="color:#38bdf8;"></i>Về Travela
        </h1>
        <p style="color:rgba(255,255,255,0.8); font-size:1rem; margin:0;">Hành trình tuyệt vời bắt đầu từ đây</p>
    </div>
</div>

{{-- About Content --}}
<div style="background:#f8fafc;" class="py-5">
    <div class="container py-4">

        {{-- Stats --}}
        <div class="row g-4 mb-5">
            @foreach([['fas fa-map-marked-alt','#0ea5e9','100+','Tour du lịch'],['fas fa-users','#10b981','5000+','Khách hàng hài lòng'],['fas fa-star','#f59e0b','4.9','Đánh giá trung bình'],['fas fa-headset','#8b5cf6','24/7','Hỗ trợ khách hàng']] as [$icon,$color,$num,$label])
            <div class="col-6 col-md-3">
                <div style="background:#fff; border-radius:16px; padding:28px 20px; text-align:center; box-shadow:0 2px 12px rgba(0,0,0,0.06); transition:transform 0.2s;" onmouseenter="this.style.transform='translateY(-4px)'" onmouseleave="this.style.transform=''">
                    <div style="width:56px; height:56px; border-radius:14px; background:{{ $color }}20; display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
                        <i class="{{ $icon }}" style="font-size:1.4rem; color:{{ $color }};"></i>
                    </div>
                    <div style="font-size:1.8rem; font-weight:800; color:#0f172a; line-height:1;">{{ $num }}</div>
                    <div style="font-size:0.82rem; color:#64748b; margin-top:4px;">{{ $label }}</div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Main About --}}
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-5">
                <div style="border-radius:20px; overflow:hidden; box-shadow:0 8px 32px rgba(0,0,0,0.12); position:relative;">
                    <img src="{{ asset('clients/img/about-img.jpg') }}" class="img-fluid w-100" alt="Về Travela" style="object-fit:cover; height:420px;">
                    <div style="position:absolute; bottom:20px; left:20px; background:rgba(15,23,42,0.85); backdrop-filter:blur(8px); border-radius:12px; padding:16px 20px; color:#fff;">
                        <div style="font-size:1.5rem; font-weight:800; color:#38bdf8;">10+</div>
                        <div style="font-size:0.82rem; color:rgba(255,255,255,0.8);">Năm kinh nghiệm</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div style="display:inline-block; background:#0ea5e920; color:#0ea5e9; font-size:0.78rem; font-weight:700; padding:4px 14px; border-radius:20px; letter-spacing:1px; text-transform:uppercase; margin-bottom:12px;">Về chúng tôi</div>
                <h2 style="font-weight:800; color:#0f172a; font-size:2rem; margin-bottom:16px;">Chào mừng đến với <span style="color:#0ea5e9;">Travela</span></h2>
                <p style="color:#475569; line-height:1.8; margin-bottom:16px;">Chúng tôi tự hào là đơn vị cung cấp dịch vụ du lịch hàng đầu, mang đến cho khách hàng những trải nghiệm tuyệt vời và đáng nhớ. Với đội ngũ chuyên nghiệp và tận tâm, Travela cam kết làm hài lòng mọi nhu cầu du lịch của bạn.</p>
                <p style="color:#475569; line-height:1.8; margin-bottom:24px;">Từ các chuyến bay hạng sang, khách sạn cao cấp đến các tour tham quan độc đáo — chúng tôi luôn chú trọng từng chi tiết để đảm bảo chuyến đi của bạn trở nên hoàn hảo.</p>
                <div class="row g-3 mb-4">
                    @foreach(['Chuyến bay hạng nhất','Khách sạn được chọn lọc','Lưu trú 5 sao','Phương tiện hiện đại','150 tour cao cấp','Hỗ trợ 24/7'] as $item)
                    <div class="col-sm-6">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:24px; height:24px; border-radius:50%; background:#0ea5e920; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                <i class="fas fa-check" style="font-size:0.65rem; color:#0ea5e9;"></i>
                            </div>
                            <span style="font-size:0.9rem; color:#334155; font-weight:500;">{{ $item }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('packages') }}" style="display:inline-flex; align-items:center; gap:8px; background:linear-gradient(135deg,#0ea5e9,#38bdf8); color:#fff; padding:12px 28px; border-radius:12px; font-weight:600; text-decoration:none; transition:opacity 0.2s;" onmouseenter="this.style.opacity='0.88'" onmouseleave="this.style.opacity='1'">
                    <i class="fas fa-map-marked-alt"></i> Khám phá Tour ngay
                </a>
            </div>
        </div>

        {{-- Services highlight --}}
        <div class="row g-4">
            @foreach([['fas fa-shield-alt','#0ea5e9','An toàn tuyệt đối','Mọi tour được kiểm tra kỹ lưỡng, đảm bảo an toàn tuyệt đối cho du khách'],['fas fa-hand-holding-usd','#10b981','Giá tốt nhất','Cam kết giá cạnh tranh, không phát sinh chi phí ẩn'],['fas fa-headset','#f59e0b','Hỗ trợ 24/7','Đội ngũ tư vấn sẵn sàng hỗ trợ bạn mọi lúc mọi nơi'],['fas fa-route','#8b5cf6','Lộ trình tối ưu','Hành trình được thiết kế khoa học, tận hưởng tối đa']] as [$icon,$color,$title,$desc])
            <div class="col-md-6 col-lg-3">
                <div style="background:#fff; border-radius:16px; padding:28px 20px; text-align:center; box-shadow:0 2px 12px rgba(0,0,0,0.06); height:100%; transition:transform 0.2s;" onmouseenter="this.style.transform='translateY(-4px)'" onmouseleave="this.style.transform=''">
                    <div style="width:60px; height:60px; border-radius:16px; background:{{ $color }}15; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                        <i class="{{ $icon }}" style="font-size:1.5rem; color:{{ $color }};"></i>
                    </div>
                    <h6 style="font-weight:700; color:#0f172a; margin-bottom:8px;">{{ $title }}</h6>
                    <p style="font-size:0.85rem; color:#64748b; margin:0; line-height:1.6;">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>

@include('clients.blocks.footer')
