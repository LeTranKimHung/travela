@extends('admin.layouts.app')
@section('title', 'Thêm ảnh mới')
@section('page-title', 'Thêm ảnh Gallery')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Thêm ảnh mới vào bộ sưu tập</h4>
    <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Quay lại
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Tiêu đề ảnh</label>
                    <input type="text" name="title" class="form-control" placeholder="Ví dụ: Hoàng hôn Phú Quốc" required>
                    <div class="mt-3">
                        <label class="form-label fw-semibold">Danh mục</label>
                        <input type="text" name="category" class="form-control" placeholder="Ví dụ: Biển đảo, Núi rừng..." required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Chọn ảnh</label>
                    <input type="file" name="image" class="form-control" id="imageInput" accept="image/*" required>
                    <div class="mt-3 text-center border rounded p-2 bg-light" style="min-height:150px;">
                        <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded d-none" style="max-height:140px;">
                        <div id="previewText" class="text-muted pt-5 small">Xem trước ảnh ở đây</div>
                    </div>
                </div>
                <div class="col-12 text-end border-top pt-3">
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Lưu ảnh
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
            const preview = document.getElementById('imagePreview');
            const text = document.getElementById('previewText');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
            text.classList.add('d-none');
        }
    };
</script>
@endsection
