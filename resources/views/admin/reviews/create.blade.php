@extends('admin.layouts.app')
@section('title', 'Thêm đánh giá mới')
@section('page-title', 'Thêm đánh giá mới')

@section('head')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Thêm đánh giá khách hàng</h4>
    <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Quay lại
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('admin.reviews.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tên khách hàng <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Ví dụ: Nguyễn Văn A" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Địa chỉ/Vị trí</label>
                    <input type="text" name="location" class="form-control" placeholder="Ví dụ: TP. Hồ Chí Minh">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Đánh giá (1-5 sao)</label>
                    <select name="rating" class="form-select">
                        <option value="5">⭐⭐⭐⭐⭐ 5 Sao</option>
                        <option value="4">⭐⭐⭐⭐ 4 Sao</option>
                        <option value="3">⭐⭐⭐ 3 Sao</option>
                        <option value="2">⭐⭐ 2 Sao</option>
                        <option value="1">⭐ 1 Sao</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Trạng thái</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="status" value="1" checked id="statusSwitch">
                        <label class="form-check-label" for="statusSwitch">Hiển thị trên trang chủ</label>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Nội dung đánh giá <span class="text-danger">*</span></label>
                    <textarea name="content" id="contentEditor" class="form-control" rows="4" placeholder="Nhập cảm nhận của khách hàng..."></textarea>
                </div>
                <div class="col-12 text-end border-top pt-3">
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Lưu đánh giá
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let editor;
    ClassicEditor.create(document.querySelector('#contentEditor'), {
        toolbar: ['bold','italic','|','bulletedList','numberedList','|','undo','redo'],
    }).then(newEditor => {
        editor = newEditor;
    }).catch(err => console.error(err));

    document.querySelector('form').addEventListener('submit', function(e) {
        if (editor) document.querySelector('#contentEditor').value = editor.getData();
    });
</script>
<style>.ck-editor__editable { min-height: 150px; }</style>
@endsection
