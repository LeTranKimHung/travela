@include('clients.blocks.header')
<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">

@php
    $bannerImg = $tours->first()->images[0] ?? null;
@endphp

{{-- ===== HERO BANNER ===== --}}
<div style="
    background: url('{{ $bannerImg ? asset('clients/img/galery-tour/' . $bannerImg) : asset('clients/img/default.jpg') }}') center center/cover no-repeat;
    padding: 130px 0 50px;
    position: relative;
">
    <div style="background: linear-gradient(180deg, rgba(15,23,42,0.65) 0%, rgba(15,23,42,0.45) 100%); position:absolute; inset:0;"></div>
    <div class="container" style="position:relative; z-index:2;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" style="color:#93c5fd; text-decoration:none;">
                        <i class="fas fa-home me-1"></i>Trang chủ
                    </a>
                </li>
                <li class="breadcrumb-item active" style="color:#fff;">Tour du lịch</li>
            </ol>
        </nav>
        <h1 style="color:#fff; font-weight:700; font-size:2.2rem; margin-bottom:8px;">
            <i class="fas fa-map-marked-alt me-2" style="color:#38bdf8;"></i>Khám phá Tour du lịch
        </h1>
        <p style="color:rgba(255,255,255,0.8); font-size:1rem; margin:0;">
            Tìm kiếm và đặt ngay những hành trình tuyệt vời nhất dành cho bạn
        </p>
    </div>
</div>

{{-- ===== MAIN CONTENT ===== --}}
<div class="container-fluid py-5" style="background:#f8fafc;">
    <div class="container">
        <div class="row g-4">

            {{-- ===== SIDEBAR FILTER ===== --}}
            <aside class="col-lg-3">
                <div style="background:#fff; border-radius:16px; box-shadow:0 2px 12px rgba(0,0,0,0.07); overflow:hidden; position:sticky; top:80px;">
                    {{-- Header --}}
                    <div style="background:linear-gradient(135deg,#0f172a,#1e3a5f); padding:18px 20px; display:flex; align-items:center; justify-content:space-between;">
                        <h6 style="color:#fff; margin:0; font-weight:600; font-size:0.95rem;">
                            <i class="fas fa-filter me-2" style="color:#38bdf8;"></i>Lọc Tour
                        </h6>
                        @if(request()->anyFilled(['domain','destination','time','quantity','price_min','price_max','availability']))
                            <a href="{{ route('packages') }}" style="color:#f87171; font-size:0.78rem; text-decoration:none;">
                                <i class="fas fa-times me-1"></i>Xóa lọc
                            </a>
                        @endif
                    </div>

                    <form method="GET" action="{{ route('packages') }}" id="filterForm">
                        <div style="padding:20px;">

                            {{-- Khu vực --}}
                            <div class="mb-4">
                                <label style="font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#64748b; display:block; margin-bottom:8px;">
                                    <i class="fas fa-globe-asia me-1 text-primary"></i>Khu vực
                                </label>
                                <div class="d-flex flex-column gap-1">
                                    @php
                                        $domainMap = ['b' => ['label'=>'Miền Bắc','icon'=>'fas fa-mountain','color'=>'#0ea5e9'],
                                                       't' => ['label'=>'Miền Trung','icon'=>'fas fa-sun','color'=>'#f59e0b'],
                                                       'n' => ['label'=>'Miền Nam','icon'=>'fas fa-umbrella-beach','color'=>'#10b981']];
                                    @endphp
                                    @foreach($domains as $domain)
                                    @php $dm = $domainMap[$domain] ?? ['label'=>$domain,'icon'=>'fas fa-map-pin','color'=>'#64748b']; @endphp
                                    <label style="cursor:pointer; padding:8px 12px; border-radius:8px; border:1.5px solid {{ request('domain')==$domain ? $dm['color'] : '#e2e8f0' }}; background:{{ request('domain')==$domain ? 'rgba(14,165,233,0.06)' : '#fff' }}; display:flex; align-items:center; gap:8px; transition:all 0.2s;" onclick="this.querySelector('input').click(); document.getElementById('filterForm').submit();">
                                        <input type="radio" name="domain" value="{{ $domain }}" {{ request('domain')==$domain ? 'checked' : '' }} style="display:none;">
                                        <i class="{{ $dm['icon'] }}" style="color:{{ $dm['color'] }}; width:16px; text-align:center;"></i>
                                        <span style="font-size:0.88rem; font-weight:500; color:#334155;">{{ $dm['label'] }}</span>
                                    </label>
                                    @endforeach
                                    @if(request('domain'))
                                    <label style="cursor:pointer; padding:8px 12px; border-radius:8px; border:1.5px solid #e2e8f0; background:#fff; display:flex; align-items:center; gap:8px;" onclick="document.querySelector('[name=domain]:checked').checked=false; document.getElementById('filterForm').submit();">
                                        <i class="fas fa-list" style="color:#94a3b8; width:16px; text-align:center;"></i>
                                        <span style="font-size:0.88rem; color:#94a3b8;">Tất cả khu vực</span>
                                    </label>
                                    @endif
                                </div>
                            </div>

                            {{-- Điểm đến --}}
                            <div class="mb-4">
                                <label style="font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#64748b; display:block; margin-bottom:8px;">
                                    <i class="fas fa-map-marker-alt me-1 text-danger"></i>Điểm đến
                                </label>
                                <select name="destination" class="form-select form-select-sm" onchange="this.form.submit()" style="border-radius:8px; border:1.5px solid #e2e8f0; font-size:0.88rem;">
                                    <option value="">Tất cả điểm đến</option>
                                    @foreach($destinations as $dest)
                                        <option value="{{ $dest }}" {{ request('destination')==$dest ? 'selected' : '' }}>
                                            {{ $dest }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Thời gian --}}
                            <div class="mb-4">
                                <label style="font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#64748b; display:block; margin-bottom:8px;">
                                    <i class="fas fa-clock me-1 text-warning"></i>Thời gian
                                </label>
                                <select name="time" class="form-select form-select-sm" onchange="this.form.submit()" style="border-radius:8px; border:1.5px solid #e2e8f0; font-size:0.88rem;">
                                    <option value="">Tất cả thời gian</option>
                                    @foreach($timeOptions as $time)
                                        <option value="{{ $time }}" {{ request('time')==$time ? 'selected' : '' }}>
                                            {{ $time }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Khoảng giá --}}
                            <div class="mb-4">
                                <label style="font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#64748b; display:block; margin-bottom:8px;">
                                    <i class="fas fa-tag me-1 text-success"></i>Khoảng giá (VND)
                                </label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="number" name="price_min" class="form-control form-control-sm"
                                            placeholder="Từ" value="{{ request('price_min') }}"
                                            min="0" step="500000"
                                            style="border-radius:8px; border:1.5px solid #e2e8f0; font-size:0.85rem;">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="price_max" class="form-control form-control-sm"
                                            placeholder="Đến" value="{{ request('price_max') }}"
                                            min="0" step="500000"
                                            style="border-radius:8px; border:1.5px solid #e2e8f0; font-size:0.85rem;">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm w-100 mt-2"
                                    style="background:#0f172a; color:#fff; border-radius:8px; font-size:0.82rem; padding:7px;">
                                    <i class="fas fa-search me-1"></i>Áp dụng
                                </button>
                            </div>

                            {{-- Trạng thái --}}
                            <div>
                                <label style="font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#64748b; display:block; margin-bottom:8px;">
                                    <i class="fas fa-check-circle me-1 text-info"></i>Tình trạng chỗ
                                </label>
                                <div class="d-flex gap-2">
                                    <label style="flex:1; cursor:pointer; padding:7px; border-radius:8px; border:1.5px solid {{ !request('availability') ? '#0ea5e9' : '#e2e8f0' }}; text-align:center; font-size:0.82rem; font-weight:500; color:{{ !request('availability') ? '#0ea5e9' : '#94a3b8' }};" onclick="document.querySelector('[name=availability]').value=''; filterForm.submit();">
                                        Tất cả
                                    </label>
                                    <label style="flex:1; cursor:pointer; padding:7px; border-radius:8px; border:1.5px solid {{ request('availability')=='1' ? '#10b981' : '#e2e8f0' }}; text-align:center; font-size:0.82rem; font-weight:500; color:{{ request('availability')=='1' ? '#10b981' : '#94a3b8' }};" onclick="document.querySelector('[name=availability]').value='1'; filterForm.submit();">
                                        Còn chỗ
                                    </label>
                                </div>
                                <input type="hidden" name="availability" value="{{ request('availability') }}">
                            </div>

                        </div>
                    </form>
                </div>
            </aside>

            {{-- ===== MAIN CONTENT ===== --}}
            <div class="col-lg-9">
                {{-- Result Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 style="font-weight:700; color:#0f172a; margin:0;">
                            Danh sách Tour du lịch
                        </h4>
                        <p style="color:#64748b; font-size:0.9rem; margin:4px 0 0;">
                            Tìm thấy <strong style="color:#0ea5e9;">{{ $tours->count() }}</strong> tour phù hợp
                            @if(request()->anyFilled(['domain','destination','time']))
                                với bộ lọc đã chọn
                            @endif
                        </p>
                    </div>
                    @if(request()->anyFilled(['domain','destination','time','price_min','price_max']))
                    <a href="{{ route('packages') }}" class="btn btn-outline-secondary btn-sm" style="border-radius:8px;">
                        <i class="fas fa-undo me-1"></i>Xem tất cả
                    </a>
                    @endif
                </div>

                {{-- Tour Grid --}}
                @if($tours->isEmpty())
                <div style="background:#fff; border-radius:16px; padding:60px 20px; text-align:center; box-shadow:0 2px 12px rgba(0,0,0,0.06);">
                    <i class="fas fa-search" style="font-size:3rem; color:#cbd5e1; margin-bottom:16px; display:block;"></i>
                    <h5 style="color:#334155; margin-bottom:8px;">Không tìm thấy tour nào</h5>
                    <p style="color:#94a3b8; margin-bottom:20px;">Thử thay đổi bộ lọc để tìm kiếm tour phù hợp hơn.</p>
                    <a href="{{ route('packages') }}" class="btn btn-primary" style="border-radius:10px; padding:10px 28px;">
                        <i class="fas fa-arrow-left me-2"></i>Xem tất cả tour
                    </a>
                </div>
                @else
                <div class="row g-4">
                    @foreach($tours as $tour)
                    @php
                        $img = $tour->images[0] ?? null;
                        $domainLabel = ['b'=>'Miền Bắc','t'=>'Miền Trung','n'=>'Miền Nam'][$tour->domain] ?? $tour->domain;
                        $domainColor = ['b'=>'#0ea5e9','t'=>'#f59e0b','n'=>'#10b981'][$tour->domain] ?? '#64748b';
                    @endphp
                    <div class="col-md-6 col-xl-4">
                        <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.07); display:flex; flex-direction:column; height:100%; transition:transform 0.25s, box-shadow 0.25s;"
                             onmouseenter="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 12px 28px rgba(0,0,0,0.13)';"
                             onmouseleave="this.style.transform=''; this.style.boxShadow='0 2px 12px rgba(0,0,0,0.07)';">

                            {{-- Tour Image --}}
                            <div style="position:relative; overflow:hidden; height:200px;">
                                <img src="{{ $img ? asset('clients/img/galery-tour/'.$img) : asset('clients/img/default.jpg') }}"
                                     alt="{{ $tour->title }}"
                                     style="width:100%; height:100%; object-fit:cover; transition:transform 0.4s;"
                                     onmouseenter="this.style.transform='scale(1.06)';"
                                     onmouseleave="this.style.transform='';">
                                {{-- Domain Badge --}}
                                <span style="position:absolute; top:12px; left:12px; background:{{ $domainColor }}; color:#fff; font-size:0.72rem; font-weight:700; padding:4px 10px; border-radius:20px; letter-spacing:0.3px;">
                                    {{ $domainLabel }}
                                </span>
                                {{-- Price Badge --}}
                                <span style="position:absolute; bottom:12px; right:12px; background:rgba(15,23,42,0.85); color:#fff; font-size:0.78rem; font-weight:700; padding:5px 12px; border-radius:20px; backdrop-filter:blur(4px);">
                                    {{ format_currency($tour->priceAdult) }}
                                </span>
                            </div>

                            {{-- Tour Body --}}
                            <div style="padding:18px 20px; flex:1; display:flex; flex-direction:column;">
                                {{-- Title --}}
                                <h6 style="font-weight:700; color:#0f172a; font-size:0.97rem; margin-bottom:10px; line-height:1.4; min-height:2.7em;">
                                    {{ Str::limit($tour->title, 60) }}
                                </h6>

                                {{-- Info Row --}}
                                <div style="display:flex; gap:12px; margin-bottom:12px; flex-wrap:wrap;">
                                    <span style="display:flex; align-items:center; gap:5px; font-size:0.82rem; color:#475569;">
                                        <i class="fas fa-map-marker-alt" style="color:#ef4444; width:14px;"></i>
                                        {{ $tour->destination }}
                                    </span>
                                    <span style="display:flex; align-items:center; gap:5px; font-size:0.82rem; color:#475569;">
                                        <i class="fas fa-clock" style="color:#f59e0b; width:14px;"></i>
                                        {{ $tour->time }}
                                    </span>
                                </div>

                                {{-- Stats Row --}}
                                <div style="display:grid; grid-template-columns:1fr 1fr; gap:8px; margin-bottom:14px;">
                                    <div style="background:#f8fafc; border-radius:8px; padding:8px 10px; text-align:center;">
                                        <div style="font-size:0.7rem; color:#94a3b8; margin-bottom:2px; text-transform:uppercase; letter-spacing:0.5px;">Khởi hành</div>
                                        <div style="font-size:0.82rem; font-weight:600; color:#334155;">
                                            {{ \Carbon\Carbon::parse($tour->startDate)->format('d/m/Y') }}
                                        </div>
                                    </div>
                                    <div style="background:#f8fafc; border-radius:8px; padding:8px 10px; text-align:center;">
                                        <div style="font-size:0.7rem; color:#94a3b8; margin-bottom:2px; text-transform:uppercase; letter-spacing:0.5px;">Số chỗ</div>
                                        <div style="font-size:0.82rem; font-weight:600; color:#334155;">
                                            {{ $tour->quantity }} người
                                        </div>
                                    </div>
                                </div>

                                {{-- Price & Button --}}
                                <div style="margin-top:auto; padding-top:12px; border-top:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between;">
                                    <div>
                                        <div style="font-size:0.7rem; color:#94a3b8; margin-bottom:2px;">Giá từ</div>
                                        <div style="font-size:1.05rem; font-weight:700; color:#0ea5e9;">
                                            {{ format_currency($tour->priceAdult) }}<span style="font-size:0.72rem; font-weight:500; color:#64748b;">/người</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('tour-detail', ['id' => $tour->tourId]) }}"
                                       style="background:linear-gradient(135deg,#0ea5e9,#38bdf8); color:#fff; border:none; padding:9px 18px; border-radius:10px; font-size:0.85rem; font-weight:600; text-decoration:none; display:flex; align-items:center; gap:6px; transition:opacity 0.2s;"
                                       onmouseenter="this.style.opacity='0.88';"
                                       onmouseleave="this.style.opacity='1';">
                                        <i class="fas fa-calendar-check"></i> Đặt ngay
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

@include('clients.blocks.footer')
