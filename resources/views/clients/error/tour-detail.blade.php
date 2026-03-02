@include('clients.blocks.header')
<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">

@php
    $bannerImg = $tourDetail->images[0] ?? null;
    $domainLabel = ['b'=>'Miền Bắc','t'=>'Miền Trung','n'=>'Miền Nam'][$tourDetail->domain] ?? ($tourDetail->domain ?? '');
    $domainColor = ['b'=>'#0ea5e9','t'=>'#f59e0b','n'=>'#10b981'][$tourDetail->domain] ?? '#64748b';
@endphp

{{-- Hero Banner --}}
<div style="background: url('{{ $bannerImg ? asset('clients/img/galery-tour/'.$bannerImg) : asset('clients/img/default.jpg') }}') center center/cover no-repeat; padding:130px 0 50px; position:relative;">
    <div style="background:linear-gradient(180deg,rgba(15,23,42,0.75) 0%,rgba(15,23,42,0.55) 100%); position:absolute; inset:0;"></div>
    <div class="container" style="position:relative; z-index:2;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-3" style="background:transparent;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#93c5fd; text-decoration:none;"><i class="fas fa-home me-1"></i>Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('packages') }}" style="color:#93c5fd; text-decoration:none;">Tour du lịch</a></li>
                <li class="breadcrumb-item active" style="color:#fff;">Chi tiết tour</li>
            </ol>
        </nav>
        <div style="display:flex; gap:8px; margin-bottom:12px; flex-wrap:wrap;">
            <span style="background:{{ $domainColor }}; color:#fff; font-size:0.75rem; font-weight:700; padding:4px 12px; border-radius:20px;">{{ $domainLabel }}</span>
            <span style="background:rgba(255,255,255,0.2); color:#fff; font-size:0.75rem; font-weight:600; padding:4px 12px; border-radius:20px; backdrop-filter:blur(4px);">
                <i class="fas fa-clock me-1"></i>{{ $tourDetail->time }}
            </span>
        </div>
        <h1 style="color:#fff; font-weight:800; font-size:2rem; margin-bottom:10px; max-width:800px; line-height:1.3;">
            {{ $tourDetail->title }}
        </h1>
        <div style="display:flex; gap:16px; flex-wrap:wrap;">
            <span style="color:rgba(255,255,255,0.85); font-size:0.88rem;"><i class="fas fa-map-marker-alt me-1" style="color:#f87171;"></i>{{ $tourDetail->destination }}</span>
            <span style="color:rgba(255,255,255,0.85); font-size:0.88rem;"><i class="fas fa-users me-1" style="color:#38bdf8;"></i>{{ $tourDetail->quantity }} người</span>
            <span style="color:rgba(255,255,255,0.85); font-size:0.88rem;"><i class="fas fa-calendar-alt me-1" style="color:#34d399;"></i>{{ \Carbon\Carbon::parse($tourDetail->startDate)->format('d/m/Y') }}</span>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div style="background:#f8fafc;" class="py-5">
    <div class="container py-2">
        <div class="row g-4">

            {{-- Left: Gallery + Details --}}
            <div class="col-lg-8">

                {{-- Gallery --}}
                @php $mainImg = $tourDetail->images[0] ?? null; @endphp
                <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.07); margin-bottom:20px;">
                    <img id="mainTourImg"
                         src="{{ $mainImg ? asset('clients/img/galery-tour/'.$mainImg) : asset('clients/img/default.jpg') }}"
                         alt="{{ $tourDetail->title }}"
                         style="width:100%; height:380px; object-fit:cover; display:block;">
                    @if(count($tourDetail->images) > 1)
                    <div style="display:flex; gap:8px; padding:12px; overflow-x:auto;">
                        @foreach($tourDetail->images as $idx => $img)
                        <img src="{{ asset('clients/img/galery-tour/'.$img) }}"
                             alt="Ảnh {{ $idx+1 }}"
                             onclick="document.getElementById('mainTourImg').src=this.src; document.querySelectorAll('.thumb-active').forEach(e=>e.classList.remove('thumb-active')); this.classList.add('thumb-active');"
                             style="width:80px; height:60px; object-fit:cover; border-radius:8px; cursor:pointer; flex-shrink:0; border:2.5px solid {{ $idx===0 ? '#0ea5e9' : '#e2e8f0' }}; transition:border-color 0.2s;"
                             class="{{ $idx===0 ? 'thumb-active' : '' }}">
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Tabs Context --}}
                <style>
                    .tour-tabs { border-bottom: 2px solid #e2e8f0; margin-bottom: 20px;}
                    .tour-tabs .nav-link { 
                        color: #64748b; font-weight: 600; padding: 12px 24px; border: none; 
                        border-bottom: 3px solid transparent; transition: all 0.3s; background: transparent; cursor: pointer;
                    }
                    .tour-tabs .nav-link:hover { color: #0ea5e9; }
                    .tour-tabs .nav-link.active { 
                        color: #0ea5e9; border-bottom: 3px solid #0ea5e9; background: transparent; 
                    }
                    .policy-section h6 { color: #0f172a; font-weight: 700; margin-top: 24px; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
                    .policy-section ul { padding-left: 20px; color: #475569; font-size: 0.95rem; line-height: 1.8; }
                    .policy-section ul li { margin-bottom: 8px; }
                </style>

                <ul class="nav nav-tabs tour-tabs" id="tourTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">Tổng Quan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="program-tab" data-bs-toggle="tab" data-bs-target="#program" type="button" role="tab">Chương Trình</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="policy-tab" data-bs-toggle="tab" data-bs-target="#policy" type="button" role="tab">Quy Định & Chính Sách</button>
                    </li>
                </ul>

                <div class="tab-content" id="tourTabContent">
                    {{-- Tab Tổng Quan --}}
                    <div class="tab-pane fade show active" id="overview" role="tabpanel">
                        <div style="background:#fff; border-radius:16px; padding:28px; box-shadow:0 2px 12px rgba(0,0,0,0.07); margin-bottom:20px;">
                            <h5 style="font-weight:700; color:#0f172a; margin-bottom:16px; display:flex; align-items:center; gap:10px;">
                                <div style="width:32px; height:32px; border-radius:8px; background:#0ea5e918; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-align-left" style="color:#0ea5e9; font-size:0.85rem;"></i>
                                </div>
                                Mô tả tour
                            </h5>
                            <div style="color:#475569; line-height:1.9; font-size:0.95rem;">
                                {!! $tourDetail->description !!}
                            </div>
                        </div>

                        {{-- Included / Not Included --}}
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <div style="background:#fff; border-radius:16px; padding:24px; box-shadow:0 2px 12px rgba(0,0,0,0.07); height:100%;">
                                    <h6 style="font-weight:700; color:#10b981; margin-bottom:14px;"><i class="fas fa-check-circle me-2"></i>Bao gồm</h6>
                                    @foreach(['Đưa đón sân bay','Hướng dẫn viên chuyên nghiệp','Ăn sáng miễn phí','Vé tham quan','Bảo hiểm du lịch'] as $item)
                                    <div style="display:flex; align-items:center; gap:10px; padding:7px 0; border-bottom:1px solid #f1f5f9; font-size:0.88rem; color:#374151;">
                                        <i class="fas fa-check" style="color:#10b981; width:14px;"></i>{{ $item }}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="background:#fff; border-radius:16px; padding:24px; box-shadow:0 2px 12px rgba(0,0,0,0.07); height:100%;">
                                    <h6 style="font-weight:700; color:#ef4444; margin-bottom:14px;"><i class="fas fa-times-circle me-2"></i>Không bao gồm</h6>
                                    @foreach(['Chi phí cá nhân','Đồ uống ngoài chương trình','Tiền tip hướng dẫn viên','Thuế VAT','Vé máy bay (nếu có)'] as $item)
                                    <div style="display:flex; align-items:center; gap:10px; padding:7px 0; border-bottom:1px solid #f1f5f9; font-size:0.88rem; color:#374151;">
                                        <i class="fas fa-times" style="color:#ef4444; width:14px;"></i>{{ $item }}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tab Chương Trình --}}
                    <div class="tab-pane fade" id="program" role="tabpanel">
                        @if($tourDetail->timeline && count($tourDetail->timeline) > 0)
                        <div style="background:#fff; border-radius:16px; padding:28px; box-shadow:0 2px 12px rgba(0,0,0,0.07); margin-bottom:20px;">
                            <h5 style="font-weight:700; color:#0f172a; margin-bottom:20px; display:flex; align-items:center; gap:10px;">
                                <div style="width:32px; height:32px; border-radius:8px; background:#10b98118; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-route" style="color:#10b981; font-size:0.85rem;"></i>
                                </div>
                                Lịch trình chi tiết
                            </h5>
                            <div class="accordion" id="tourTimeline">
                                @php $day = 1; @endphp
                                @foreach($tourDetail->timeline as $tl)
                                <div style="border:1.5px solid #f1f5f9; border-radius:12px; margin-bottom:10px; overflow:hidden;">
                                    <h6 style="margin:0;">
                                        <button class="accordion-button {{ $day > 1 ? 'collapsed' : '' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#tl{{ $tl->timeLineId }}"
                                                style="font-weight:600; font-size:0.92rem; color:#0f172a; background:#f8fafc; padding:14px 18px;">
                                            <span style="background:#0ea5e9; color:#fff; font-size:0.72rem; font-weight:700; padding:3px 9px; border-radius:20px; margin-right:10px;">Ngày {{ $day++ }}</span>
                                            {{ $tl->title }}
                                        </button>
                                    </h6>
                                    <div id="tl{{ $tl->timeLineId }}" class="accordion-collapse collapse {{ $day <= 2 ? 'show' : '' }}">
                                        <div style="padding:16px 20px; color:#475569; font-size:0.9rem; line-height:1.8;">
                                            {!! $tl->description !!}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <div style="background:#fff; border-radius:16px; padding:40px 20px; box-shadow:0 2px 12px rgba(0,0,0,0.07); margin-bottom:20px; text-align:center; color:#64748b;">
                            <i class="fas fa-calendar-times d-block mb-3" style="font-size:2.5rem; color:#cbd5e1;"></i>
                            Chưa có thông tin lịch trình chi tiết.
                        </div>
                        @endif
                    </div>

                    {{-- Tab Quy Định --}}
                    <div class="tab-pane fade" id="policy" role="tabpanel">
                        <div class="policy-section" style="background:#fff; border-radius:16px; padding:28px; box-shadow:0 2px 12px rgba(0,0,0,0.07); margin-bottom:20px;">
                            <h5 style="font-weight:700; color:#0f172a; margin-bottom:20px; padding-bottom:16px; border-bottom:1px solid #e2e8f0;">Điều khoản & Quy định</h5>
                            
                            @if(!empty($tourDetail->policy))
                                {!! $tourDetail->policy !!}
                            @else
                                <h6><i class="fas fa-check-circle" style="color:#10b981;"></i> Giá Tour Bao Gồm:</h6>
                                <ul>
                                    <li>Vé máy bay khứ hồi (Gồm 20kg ký gửi + 7kg xách tay)</li>
                                    <li>Phí an ninh sân bay, bảo hiểm hàng không thuế phi trường.</li>
                                    <li>Visa nhập cảnh theo đoàn.</li>
                                    <li>Vé tham quan theo chương trình.</li>
                                    <li>Khách sạn tiêu chuẩn 3*: 2-3 người/phòng.</li>
                                    <li>Các bữa ăn theo chương trình. Nước uống, khăn lạnh.</li>
                                    <li>Đội phục vụ theo đoàn (ngôn ngữ: tiếng Việt).</li>
                                    <li>Bảo hiểm du lịch với mức bồi thường tối đa 50,000USD/khách.</li>
                                    <li>Thuế GTGT theo quy định.</li>
                                </ul>

                                <h6><i class="fas fa-times-circle" style="color:#ef4444;"></i> Giá Tour Không Bao Gồm:</h6>
                                <ul>
                                    <li>Hộ chiếu còn hạn trên 06 tháng tính đến ngày về.</li>
                                    <li>Chi phí làm visa diện Dán: 3,600,000 VNĐ/khách (nếu có nhu cầu).</li>
                                    <li>Chi phí Tip cho HDV và tài xế: 25 USD/khách/tour (Ngày lễ/tết: 35 USD).</li>
                                    <li>Visa tái nhập: 2,550,000 VNĐ/khách (áp dụng cho khách quốc tịch cần Visa vào VN).</li>
                                    <li>Chi phí cá nhân: điểm tham quan ngoài chương trình, điện thoại, giặt ủi...</li>
                                    <li>Phụ thu phòng đơn: 4,000,000 VNĐ/khách/tour thường, 6,500,000 VNĐ dịp Lễ Tết.</li>
                                </ul>

                                <h6><i class="fas fa-child" style="color:#f59e0b;"></i> Chi Phí Trẻ Em:</h6>
                                <ul>
                                    <li><strong>Em bé (dưới 2 tuổi):</strong> Được mua bảo hiểm, có chỗ ngồi trên xe, ngủ ghép với gia đình. Chi phí phát sinh gia đình tự chi trả.</li>
                                    <li><strong>Trẻ em (2 - dưới 11 tuổi):</strong> Dịch vụ như người lớn, ngủ ghép với gia đình. Nếu đi 1 kèm 1 cần nâng dịch vụ để lấy suất ngủ.</li>
                                    <li><strong>Trẻ em từ 11 tuổi trở lên:</strong> Dịch vụ và giá cước như người lớn.</li>
                                </ul>

                                <h6><i class="fas fa-ban" style="color:#64748b;"></i> Quy Định Hủy Tour:</h6>
                                <ul>
                                    <li>Ngay sau khi kí hợp đồng: Mất 50% giá tour.</li>
                                    <li>Từ 45 ngày đến 30 ngày: Mất 70% giá tour.</li>
                                    <li>Từ 29 đến 15 ngày: Mất 90% giá tour.</li>
                                    <li>Trong vòng 14 ngày: Mất 100% giá tour.</li>
                                    <li>Thời gian tính theo ngày làm việc, không tính thứ 7, CN và Lễ Tết. Hủy tour hợp lệ chỉ qua email hoặc văn bản có xác nhận.</li>
                                </ul>
                                
                                <h6><i class="fas fa-passport" style="color:#3b82f6;"></i> Quy Định Chính Sách Visa:</h6>
                                <ul>
                                    <li><strong style="color:#ef4444;">HOÀN CỌC 100% NẾU KHÁCH RỚT VISA ĐOÀN.</strong></li>
                                    <li>Hộ chiếu bản gốc còn hạn trên 6 tháng. Hình 3.5 x 4.5 nền trắng chụp mới.</li>
                                    <li>Bản sao CCCD/CMND, Hộ khẩu, Giấy ĐKKH, Giấy khai sinh.</li>
                                    <li>Hồ sơ chứng minh công việc & tài chính theo yêu cầu (Sao kê lương 6 tháng, sổ tiết kiệm tối thiểu 100tr, giấy tờ nhà đất...).</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            {{-- Right: Booking Card --}}
            <div class="col-lg-4">
                <div style="position:sticky; top:80px;">

                    {{-- Price Card --}}
                    <div style="background:#fff; border-radius:16px; box-shadow:0 4px 24px rgba(0,0,0,0.1); overflow:hidden; margin-bottom:16px;">
                        <div style="background:linear-gradient(135deg,#0f172a,#1e3a5f); padding:20px 24px;">
                            <div style="font-size:0.75rem; color:rgba(255,255,255,0.65); text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Giá từ</div>
                            <div style="font-size:2rem; font-weight:800; color:#38bdf8; line-height:1;">
                                {{ format_currency($tourDetail->priceAdult) }}
                            </div>
                            <div style="font-size:0.8rem; color:rgba(255,255,255,0.6); margin-top:2px;">/người lớn</div>
                        </div>
                        <div style="padding:20px 24px;">
                            {{-- Tour Info --}}
                            @foreach([['fas fa-map-marker-alt','#ef4444','Điểm đến',$tourDetail->destination],['fas fa-clock','#f59e0b','Thời gian',$tourDetail->time],['fas fa-users','#0ea5e9','Số chỗ',$tourDetail->quantity . ' người'],['fas fa-calendar-alt','#10b981','Khởi hành',\Carbon\Carbon::parse($tourDetail->startDate)->format('d/m/Y')],['fas fa-calendar-check','#8b5cf6','Kết thúc',\Carbon\Carbon::parse($tourDetail->endDate)->format('d/m/Y')]] as [$icon,$color,$label,$val])
                            <div style="display:flex; align-items:center; justify-content:space-between; padding:10px 0; border-bottom:1px solid #f1f5f9;">
                                <div style="display:flex; align-items:center; gap:8px; font-size:0.85rem; color:#64748b;">
                                    <i class="{{ $icon }}" style="color:{{ $color }}; width:14px; text-align:center;"></i>{{ $label }}
                                </div>
                                <span style="font-size:0.88rem; font-weight:600; color:#334155;">{{ $val }}</span>
                            </div>
                            @endforeach

                            {{-- Child Price --}}
                            @if($tourDetail->priceChild)
                            <div style="background:#f8fafc; border-radius:10px; padding:12px 14px; margin-top:14px; margin-bottom:18px;">
                                <div style="font-size:0.75rem; color:#94a3b8; margin-bottom:4px;">Giá trẻ em</div>
                                <div style="font-size:1.1rem; font-weight:700; color:#334155;">
                                    {{ format_currency($tourDetail->priceChild) }}<span style="font-size:0.8rem; color:#94a3b8;">/người</span>
                                </div>
                            </div>
                            @endif

                            <a href="{{ route('booking', ['tourId' => $tourDetail->tourId]) }}"
                               style="display:flex; align-items:center; justify-content:center; gap:8px; width:100%; background:linear-gradient(135deg,#0ea5e9,#38bdf8); color:#fff; padding:14px; border-radius:12px; font-size:1rem; font-weight:700; text-decoration:none; text-align:center; margin-top:8px; transition:opacity 0.2s;"
                               onmouseenter="this.style.opacity='0.88'" onmouseleave="this.style.opacity='1'">
                                <i class="fas fa-calendar-check"></i> Đặt tour ngay
                            </a>
                        </div>
                    </div>

                    {{-- Contact Box --}}
                    <div style="background:#fff; border-radius:16px; padding:20px 24px; box-shadow:0 2px 12px rgba(0,0,0,0.07);">
                        <h6 style="font-weight:700; color:#0f172a; margin-bottom:14px;"><i class="fas fa-headset me-2" style="color:#0ea5e9;"></i>Cần tư vấn?</h6>
                        <a href="mailto:hungltk2004@gmail.com" style="display:flex; align-items:center; gap:10px; padding:10px 0; border-bottom:1px solid #f1f5f9; text-decoration:none; color:#334155; font-size:0.88rem;">
                            <div style="width:32px; height:32px; border-radius:8px; background:#0ea5e918; display:flex; align-items:center; justify-content:center;"><i class="fas fa-envelope" style="color:#0ea5e9; font-size:0.8rem;"></i></div>
                            hungltk2004@gmail.com
                        </a>
                        <a href="tel:+00012345688" style="display:flex; align-items:center; gap:10px; padding:10px 0; text-decoration:none; color:#334155; font-size:0.88rem;">
                            <div style="width:32px; height:32px; border-radius:8px; background:#10b98118; display:flex; align-items:center; justify-content:center;"><i class="fas fa-phone" style="color:#10b981; font-size:0.8rem;"></i></div>
                            +000 (123) 456 88
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<style>
.thumb-active { border-color: #0ea5e9 !important; }
.accordion-button:not(.collapsed) { background: #f0f9ff !important; color: #0ea5e9 !important; box-shadow: none !important; }
.accordion-button:focus { box-shadow: none !important; }
</style>

@include('clients.blocks.footer')
