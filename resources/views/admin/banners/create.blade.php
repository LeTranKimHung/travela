@extends('admin.layouts.app')
@section('title', 'Thêm Banner')
@section('page-title', 'Thêm banner mới')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <h5 class="fw-bold mb-0">Thông tin Banner</h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Hình ảnh <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control" required accept="image/*">
                    <div class="form-text">Định dạng hỗ trợ: jpg, jpeg, png, gif. Kích thước khuyến nghị: 1920x1080px.</div>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Trạng thái hiện <span class="text-danger">*</span></label>
                    <select class="form-select" name="status" required>
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Tiêu đề (Tùy chọn)</label>
                <input type="text" name="title" class="form-control" placeholder="Ví dụ: Tour & Travel">
                <div class="form-text">Tiêu đề sẽ hiển thị ở giữa banner bằng chữ lớn, có thể để trống nếu chỉ muốn xem ảnh.</div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Mô tả ngắn (Tùy chọn)</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Ví dụ: Khám phá những điểm đến tuyệt đẹp..."></textarea>
                <div class="form-text">Đoạn text nhỏ hiện dưới tiêu đề.</div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Đường dẫn liên kết (Tùy chọn)</label>
                <input type="url" name="link" class="form-control" placeholder="https://...">
                <div class="form-text">Link khi người dùng bấm vào nút "Khám phá ngay" (nếu có để link). Nếu để trống thẻ nút này sẽ trỏ về phần #packages.</div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary px-4">Hủy</a>
                <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i> Lưu banner</button>
            </div>
        </form>
    </div>
</div>
@endsection
