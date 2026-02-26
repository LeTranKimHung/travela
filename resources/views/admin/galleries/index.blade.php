@extends('admin.layouts.app')
@section('title', 'Quản lý Gallery')
@section('page-title', 'Quản lý Gallery')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Danh sách ảnh nổi bật</h4>
    <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Thêm ảnh mới
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Danh mục</th>
                        <th>Ngày đăng</th>
                        <th class="pe-4 text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($galleries as $item)
                    <tr>
                        <td class="ps-4">
                            <img src="{{ asset('clients/img/gallery/' . $item->image) }}" class="rounded" style="width:80px;height:50px;object-fit:cover;">
                        </td>
                        <td class="fw-semibold">{{ $item->title }}</td>
                        <td><span class="badge bg-info text-dark">{{ $item->category }}</span></td>
                        <td class="text-muted small">{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.galleries.edit', $item->galleryId) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.galleries.destroy', $item->galleryId) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa ảnh này?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($galleries->isEmpty())
                    <tr><td colspan="5" class="text-center py-5 text-muted">Chưa có ảnh nào trong bộ sưu tập.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
