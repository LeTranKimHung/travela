@extends('admin.layouts.app')
@section('title', 'Quản lý Đánh giá')
@section('page-title', 'Quản lý Đánh giá')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Danh sách đánh giá khách hàng</h4>
    <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Thêm đánh giá mới
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Khách hàng</th>
                        <th>Đánh giá</th>
                        <th>Nội dung</th>
                        <th>Trạng thái</th>
                        <th class="pe-4 text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $item)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">{{ $item->reviewId }}</td>
                        <td>
                            <div class="fw-semibold">{{ $item->name }}</div>
                            <small class="text-muted">{{ $item->location }}</small>
                        </td>
                        <td>
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $item->rating ? 'text-warning' : 'text-secondary opacity-25' }} small"></i>
                            @endfor
                        </td>
                        <td><div class="text-truncate" style="max-width:280px;">{{ $item->content }}</div></td>
                        <td>
                            @if($item->status == 1)
                                <span class="badge bg-success">Hiển thị</span>
                            @else
                                <span class="badge bg-danger">Ẩn</span>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.reviews.edit', $item->reviewId) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.reviews.destroy', $item->reviewId) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($reviews->isEmpty())
                    <tr><td colspan="6" class="text-center py-5 text-muted">Chưa có đánh giá nào.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
