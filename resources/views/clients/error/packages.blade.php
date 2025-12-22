@include('clients.blocks.header')

@php
    $bannerImg = $tours->first()->images[0] ?? 'default.jpg';
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
                    {{ $title ?? 'Tour Packages' }}
                </li>
            </ol>
        </nav>

    </div>
</div>
<!-- Header End -->

<!-- Packages Start -->
<div class="container-fluid packages py-5">
    <div class="container py-5">
        <div class="row g-4">
            <!-- Sidebar Filter -->
            <!-- Sidebar Filter -->
            <!-- Sidebar Filter -->
            <aside class="col-lg-3">
                <form method="GET" action="{{ route('packages') }}" id="filterForm">
                    <div class="filters-card">

                        <!-- Miền (Domain) -->
                        <div class="mb-3">
                            <div class="filter-group-title">Khu vực</div>
                            <select name="domain" class="form-select filter-select mt-2" onchange="this.form.submit()">
                                <option value="">Tất cả khu vực</option>
                                @foreach ($domains as $domain)
                                    <option value="{{ $domain }}"
                                        {{ request('domain') == $domain ? 'selected' : '' }}>
                                        @if ($domain == 'b')
                                            Miền Bắc
                                        @elseif($domain == 't')
                                            Miền Trung
                                        @elseif($domain == 'n')
                                            Miền Nam
                                        @else
                                            {{ $domain }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Điểm đến -->
                        <div class="mt-3">
                            <div class="filter-group-title">Điểm đến</div>
                            <select name="destination" class="form-select filter-select mt-2"
                                onchange="this.form.submit()">
                                <option value="">Tất cả điểm đến</option>
                                @foreach ($destinations as $destination)
                                    <option value="{{ $destination }}"
                                        {{ request('destination') == $destination ? 'selected' : '' }}>
                                        {{ $destination }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Thời gian tour -->
                        <div class="mt-3">
                            <div class="filter-group-title">Số ngày</div>
                            <select name="time" class="form-select filter-select mt-2" onchange="this.form.submit()">
                                <option value="">Chọn số ngày</option>
                                @foreach ($timeOptions as $time)
                                    <option value="{{ $time }}"
                                        {{ request('time') == $time ? 'selected' : '' }}>
                                        {{ $time }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Số người -->
                        <div class="mt-3">
                            <div class="filter-group-title">Số người</div>
                            <select name="quantity" class="form-select filter-select mt-2"
                                onchange="this.form.submit()">
                                <option value="">Chọn số người</option>
                                <option value="1-2" {{ request('quantity') == '1-2' ? 'selected' : '' }}>1-2 người
                                </option>
                                <option value="3-5" {{ request('quantity') == '3-5' ? 'selected' : '' }}>3-5 người
                                </option>
                                <option value="6+" {{ request('quantity') == '6+' ? 'selected' : '' }}>6+ người
                                </option>
                            </select>
                        </div>

                        <!-- Khoảng giá -->
                        <div class="mt-3">
                            <div class="filter-group-title">Khoảng giá (VND/người)</div>
                            <div class="row g-2 mt-1">
                                <div class="col-6">
                                    <input type="number" name="price_min" class="form-control form-control-sm"
                                        placeholder="Từ" value="{{ request('price_min') }}" min="0"
                                        step="100000">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="price_max" class="form-control form-control-sm"
                                        placeholder="Đến" value="{{ request('price_max') }}" min="0"
                                        step="100000">
                                </div>
                            </div>
                        </div>

                        <!-- Trạng thái -->
                        <div class="mt-3">
                            <div class="filter-group-title">Trạng thái</div>
                            <select name="availability" class="form-select filter-select mt-2"
                                onchange="this.form.submit()">
                                <option value="">Tất cả</option>
                                <option value="1" {{ request('availability') == '1' ? 'selected' : '' }}>Còn chỗ
                                </option>
                                <option value="0" {{ request('availability') == '0' ? 'selected' : '' }}>Hết chỗ
                                </option>
                            </select>
                        </div>

                        {{-- <!-- Hiển thị số kết quả -->
                        <div class="mt-3 text-center">
                            <small class="text-muted">
                                <i class="fas fa-check-circle text-success"></i>
                                Tìm thấy {{ count($tours) }} tour
                            </small>
                        </div> --}}
                    </div>
                </form>
            </aside>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="mx-auto text-start mb-4">
                    <div class="eyebrow">Tours</div>
                    <div class="page-title">Awesome Tours</div>
                </div>
                <div class="row g-4">
                    @foreach ($tours as $tour)
                        <div class="col-md-6 col-xl-4">
                            <div class="packages-item h-100">
                                <div class="packages-img">
                                    <img src="{{ isset($tour->images[0]) ? asset('clients/img/galery-tour/' . $tour->images[0]) : asset('clients/img/default.jpg') }}"
                                        class="img-fluid" alt="Image">
                                </div>
                                <div class="packages-content bg-light h-100 d-flex flex-column">
                                    <div class="p-4 pb-0 flex-grow-1">
                                        <h5 class="card-title">{{ $tour->title }}</h5>
                                        <div class="mb-2 mt-2">
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                            <small class="fa fa-star text-primary"></small>
                                        </div>
                                        {{-- <div class="tour-meta mb-2">
                                            {{ \Illuminate\Support\Str::limit($tour->destination, 100) }}</div> --}}
                                        <div class="packages-info d-flex border border-start-0 border-end-0 mb-2"
                                            style="width: 100%;">
                                            <small class="flex-fill text-center border-end py-2">
                                                <i class="fa fa-calendar-alt me-2"></i>{{ $tour->time }}
                                            </small>
                                            <small class="flex-fill text-center py-2">
                                                <i class="fa fa-user me-2"></i>{{ $tour->quantity }} Người
                                            </small>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-2 mb-4">
                                            <span
                                                class="price-text">{{ number_format($tour->priceAdult, 0, ',', '.') }}
                                                VND/người</span>
                                            <a href="{{ route('tour-detail', ['id' => $tour->tourId]) }}"
                                                class="btn btn-outline-primary btn-book">Book now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('clients.blocks.footer')
