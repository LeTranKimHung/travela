@extends('admin.layouts.app')
@section('title', 'Sửa Banner')
@section('page-title', 'Chỉnh sửa banner')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <h5 class="fw-bold mb-0">Cập nhật Banner</h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('admin.banners.update', $banner->bannerId) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Hình ảnh hiện tại</label>
                    <div class="mb-3">
                        <img src="{{ asset($banner->imageURL) }}" alt="Banner Current" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                    </div>
                    <label class="form-label fw-semibold">Thay đổi hình ảnh</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div class="form-text">Bỏ trống nếu không muốn đổi ảnh mới.</div>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Trạng thái hiện <span class="text-danger">*</span></label>
                    <select class="form-select" name="status" required>
                        <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Tiêu đề (Tùy chọn)</label>
                <input type="text" name="title" class="form-control" placeholder="Ví dụ: Tour & Travel" value="{{ $banner->title }}">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Mô tả ngắn (Tùy chọn)</label>
                <textarea name="description" class="form-control" rows="3">{{ $banner->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Đường dẫn liên kết (Tùy chọn)</label>
                <input type="url" name="link" class="form-control" placeholder="https://..." value="{{ $banner->link }}">
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary px-4">Hủy</a>
                <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i> Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>
@endsection
