@extends('admin.layouts.app')
@section('title', 'Chỉnh sửa ảnh Gallery')
@section('page-title', 'Chỉnh sửa ảnh Gallery')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Chỉnh sửa ảnh bộ sưu tập</h4>
    <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Quay lại
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('admin.galleries.update', $gallery->galleryId) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Tiêu đề ảnh</label>
                    <input type="text" name="title" class="form-control" value="{{ $gallery->title }}" required>
                    <div class="mt-3">
                        <label class="form-label fw-semibold">Danh mục</label>
                        <input type="text" name="category" class="form-control" value="{{ $gallery->category }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Cập nhật ảnh (Để trống nếu không đổi)</label>
                    <input type="file" name="image" class="form-control" id="imageInput" accept="image/*">
                    <div class="mt-3 text-center border rounded p-2 bg-light">
                        <p class="text-muted small mb-1">Ảnh hiện tại/mới:</p>
                        <img id="imagePreview" src="{{ asset('clients/img/gallery/' . $gallery->image) }}" class="img-fluid rounded" style="max-height:140px;">
                    </div>
                </div>
                <div class="col-12 text-end border-top pt-3">
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-check me-1"></i> Cập nhật ngay
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('imageInput').onchange = function(evt) {
        const [file] = this.files;
        if (file) {
            document.getElementById('imagePreview').src = URL.createObjectURL(file);
        }
    };
</script>
@endsection
