@extends('admin.layouts.app')
@section('title', 'Thêm Tour mới')
@section('page-title', 'Thêm Tour mới')

@section('head')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Thêm mới Tour du lịch</h4>
    <a href="{{ route('admin.tours.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Quay lại
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Tên Tour</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Giá người lớn</label>
                    <input type="number" name="priceAdult" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Giá trẻ em</label>
                    <input type="number" name="priceChild" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Ngày bắt đầu</label>
                    <input type="date" name="startDate" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Ngày kết thúc</label>
                    <input type="date" name="endDate" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Số lượng người</label>
                    <input type="number" name="quantity" class="form-control" placeholder="VD: 30" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Điểm đến</label>
                    <input type="text" name="destination" class="form-control" placeholder="VD: Đà Lạt" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Khu vực</label>
                    <select name="domain" class="form-select" required>
                        <option value="b">Miền Bắc</option>
                        <option value="t">Miền Trung</option>
                        <option value="n">Miền Nam</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Thời gian (VD: 3 ngày 2 đêm)</label>
                    <input type="text" name="time" class="form-control" placeholder="VD: 4 ngày 3 đêm" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Mô tả Tour</label>
                    <textarea name="description" id="descriptionEditor" class="form-control" rows="4"></textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Hình ảnh Tour (Tối đa 10 ảnh)</label>
                    <input type="file" name="images[]" id="imageInput" class="form-control" multiple accept="image/*">
                    <small class="text-muted">Nhấn giữ Ctrl để chọn nhiều ảnh.</small>
                    <div id="imagePreview" class="d-flex flex-wrap mt-2 gap-2"></div>
                </div>
                <div class="col-12 text-end border-top pt-3">
                    <a href="{{ route('admin.tours.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Lưu Tour
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
    ClassicEditor.create(document.querySelector('#descriptionEditor'), {
        toolbar: ['heading','|','bold','italic','|','bulletedList','numberedList','|','blockQuote','link','insertTable','|','undo','redo'],
        placeholder: 'Nhập mô tả chi tiết về tour...'
    }).then(newEditor => {
        editor = newEditor;
    }).catch(err => console.error(err));

    // Đảm bảo dữ liệu được cập nhật từ CKEditor vào textarea trước khi submit
    document.querySelector('form').addEventListener('submit', function(e) {
        if (editor) {
            const data = editor.getData();
            document.querySelector('#descriptionEditor').value = data;
        }
    });

    document.getElementById('imageInput').addEventListener('change', function(event) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';
        const files = event.target.files;
        if (files.length > 10) { alert('Chỉ được chọn tối đa 10 ảnh.'); }
        const limit = Math.min(files.length, 10);
        for (let i = 0; i < limit; i++) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.innerHTML = `<img src="${e.target.result}" style="width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid #ddd;">`;
                preview.appendChild(div);
            };
            reader.readAsDataURL(files[i]);
        }
    });
</script>
<style>.ck-editor__editable { min-height: 200px; }</style>
@endsection
