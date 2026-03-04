@extends('admin.layouts.app')
@section('title', 'Quản lý Tour')
@section('page-title', 'Quản lý Tour')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Danh sách Tour du lịch</h4>
    <a href="{{ route('admin.tours.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Thêm Tour mới
    </a>
</div>

<!-- Form lọc -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.tours.index') }}" method="GET" class="row g-3">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên tour, ID, điểm đến..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="domain" class="form-select">
                    <option value="">Tất cả khu vực</option>
                    <option value="Trong nước" {{ request('domain') == 'Trong nước' ? 'selected' : '' }}>Trong nước</option>
                    <option value="Ngoài nước" {{ request('domain') == 'Ngoài nước' ? 'selected' : '' }}>Ngoài nước</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search me-1"></i> Tìm kiếm</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.tours.index') }}" class="btn btn-secondary w-100"><i class="fas fa-undo me-1"></i> Đặt lại</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <!-- <th class="ps-4">ID</th> -->
                        <th>Tên Tour</th>
                        <th>Giá người lớn</th>
                        <th class="d-none d-lg-table-cell">Bắt đầu</th>
                        <th class="d-none d-lg-table-cell">Kết thúc</th>
                        <th class="pe-4 text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tours as $tour)
                    @php
                        $isExpiredOrSoldOut = strtotime($tour->startDate) < strtotime(now()->format('Y-m-d')) || $tour->quantity <= 0;
                    @endphp
                    <tr @if($isExpiredOrSoldOut) style="opacity: 0.5;" @endif>
                        <!-- <td class="ps-4 fw-bold text-muted">#{{ $tour->tourId }}</td> -->
                        <td class="text-wrap" style="min-width:180px;">
                            {{ $tour->title }}
                            @if($isExpiredOrSoldOut)
                                <span class="badge bg-secondary ms-1">Đã hết hạn/Hết chỗ</span>
                            @endif
                        </td>
                        <td class="fw-bold text-success">{{ format_currency($tour->priceAdult) }}</td>
                        <td class="d-none d-lg-table-cell text-muted small">{{ $tour->startDate }}</td>
                        <td class="d-none d-lg-table-cell text-muted small">{{ $tour->endDate }}</td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.tours.edit', $tour->tourId) }}" class="btn btn-sm btn-info text-white">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.tours.destroy', $tour->tourId) }}" method="POST"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa tour này?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($tours->isEmpty())
                    <tr><td colspan="6" class="text-center py-5 text-muted">Chưa có tour nào.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
