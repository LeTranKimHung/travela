@extends('admin.layouts.app')
@section('title', 'Quản lý Banner')
@section('page-title', 'Danh sách Banner')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Danh sách Banner</h4>
    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Thêm Banner mới
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Hình ảnh</th>
                        <th>Tiêu đề / Caption</th>
                        <th>Liên kết</th>
                        <th>Trạng thái</th>
                        <th class="pe-4 text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $banner)
                    <tr>
                        <td class="ps-4">
                            <img src="{{ asset($banner->imageURL) }}" alt="Banner" class="rounded" style="width: 150px; height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            @if($banner->title)
                                <div class="fw-bold">{{ $banner->title }}</div>
                            @endif
                            <div class="small text-muted text-truncate" style="max-width: 200px;">
                                {{ $banner->description }}
                            </div>
                        </td>
                        <td>
                            @if($banner->link)
                                <a href="{{ $banner->link }}" target="_blank" class="text-primary small">Xem link <i class="fas fa-external-link-alt ms-1"></i></a>
                            @else
                                <span class="text-muted small">Không có</span>
                            @endif
                        </td>
                        <td>
                            @if($banner->status == 1)
                                <span class="badge bg-success">Hiển thị</span>
                            @else
                                <span class="badge bg-secondary">Ẩn</span>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.banners.edit', $banner->bannerId) }}" class="btn btn-sm btn-info text-white" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.banners.destroy', $banner->bannerId) }}" method="POST"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa banner này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Xóa"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($banners->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Chưa có banner nào được thêm.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
