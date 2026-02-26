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

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Tên Tour</th>
                        <th>Giá người lớn</th>
                        <th class="d-none d-lg-table-cell">Bắt đầu</th>
                        <th class="d-none d-lg-table-cell">Kết thúc</th>
                        <th class="pe-4 text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tours as $tour)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">#{{ $tour->tourId }}</td>
                        <td class="text-wrap" style="min-width:180px;">{{ $tour->title }}</td>
                        <td class="fw-bold text-success">{{ number_format($tour->priceAdult) }} đ</td>
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
