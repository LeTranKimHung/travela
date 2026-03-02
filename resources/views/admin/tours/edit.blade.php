@extends('admin.layouts.app')
@section('title', 'Sửa Tour')
@section('page-title', 'Chỉnh sửa Tour')

@section('head')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Chỉnh sửa: {{ $tour->title }}</h4>
    <a href="{{ route('admin.tours.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Quay lại
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('admin.tours.update', $tour->tourId) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Tên Tour</label>
                    <input type="text" name="title" class="form-control" value="{{ $tour->title }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Giá người lớn</label>
                    <input type="number" name="priceAdult" class="form-control" value="{{ $tour->priceAdult }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Giá trẻ em</label>
                    <input type="number" name="priceChild" class="form-control" value="{{ $tour->priceChild }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Ngày bắt đầu</label>
                    <input type="date" name="startDate" class="form-control" value="{{ $tour->startDate }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Ngày kết thúc</label>
                    <input type="date" name="endDate" class="form-control" value="{{ $tour->endDate }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Số lượng người</label>
                    <input type="number" name="quantity" class="form-control" value="{{ $tour->quantity }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Điểm đến</label>
                    <input type="text" name="destination" class="form-control" value="{{ $tour->destination }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Khu vực</label>
                    <select name="domain" class="form-select" required>
                        <option value="b" {{ $tour->domain == 'b' ? 'selected' : '' }}>Miền Bắc</option>
                        <option value="t" {{ $tour->domain == 't' ? 'selected' : '' }}>Miền Trung</option>
                        <option value="n" {{ $tour->domain == 'n' ? 'selected' : '' }}>Miền Nam</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Thời gian (VD: 3 ngày 2 đêm)</label>
                    <input type="text" name="time" class="form-control" value="{{ $tour->time }}" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Mô tả Tour</label>
                    <textarea name="description" id="descriptionEditor" class="form-control" rows="4">{{ $tour->description }}</textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Quy định & Chính sách</label>
                    <textarea name="policy" id="policyEditor" class="form-control" rows="4">{{ $tour->policy ?? '' }}</textarea>
                </div>
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label fw-semibold mb-0">Lịch trình Tour</label>
                        <button type="button" class="btn btn-sm btn-success" onclick="addTimeline()"><i class="fas fa-plus"></i> Thêm ngày mới</button>
                    </div>
                    <div id="timelineContainer">
                        @if(isset($timelines) && count($timelines) > 0)
                            @foreach($timelines as $index => $tl)
                            <div class="timeline-item border p-3 mb-3 rounded" style="background:#f8fafc;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong class="text-primary">Lịch trình</strong>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.timeline-item').remove()"><i class="fas fa-trash"></i></button>
                                </div>
                                <input type="text" name="timeline_title[]" class="form-control mb-2" value="{{ $tl->title }}" placeholder="Tiêu đề (VD: Ngày 1: TP.HCM - Đà Lạt)">
                                <textarea name="timeline_desc[]" class="form-control" rows="3" placeholder="Chi tiết các hoạt động...">{{ $tl->description }}</textarea>
                            </div>
                            @endforeach
                        @else
                            <div class="timeline-item border p-3 mb-3 rounded" style="background:#f8fafc;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong class="text-primary">Lịch trình</strong>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.timeline-item').remove()"><i class="fas fa-trash"></i></button>
                                </div>
                                <input type="text" name="timeline_title[]" class="form-control mb-2" placeholder="Tiêu đề (VD: Ngày 1: TP.HCM - Đà Lạt)">
                                <textarea name="timeline_desc[]" class="form-control" rows="3" placeholder="Chi tiết các hoạt động..."></textarea>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Ảnh hiện tại</label>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @foreach($images as $img)
                        <img src="{{ asset('clients/img/galery-tour/' . $img->imageURL) }}" alt="tour"
                            style="width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;">
                        @endforeach
                    </div>
                    <label class="form-label fw-semibold">Thêm ảnh mới (Tối đa 10 ảnh)</label>
                    <input type="file" name="images[]" id="imageInput" class="form-control" multiple accept="image/*">
                    <div id="imagePreview" class="d-flex flex-wrap mt-2 gap-2"></div>
                </div>
                <div class="col-12 text-end border-top pt-3">
                    <a href="{{ route('admin.tours.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Cập nhật Tour
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let editor, policyEditor;
    ClassicEditor.create(document.querySelector('#descriptionEditor'), {
        toolbar: ['heading','|','bold','italic','|','bulletedList','numberedList','|','blockQuote','link','insertTable','|','undo','redo'],
    }).then(newEditor => {
        editor = newEditor;
    }).catch(err => console.error(err));

    ClassicEditor.create(document.querySelector('#policyEditor'), {
        toolbar: ['heading','|','bold','italic','|','bulletedList','numberedList','|','blockQuote','link','insertTable','|','undo','redo'],
    }).then(newEditor => {
        policyEditor = newEditor;
    }).catch(err => console.error(err));

    // Đảm bảo dữ liệu được cập nhật từ CKEditor vào textarea trước khi submit
    document.querySelector('form').addEventListener('submit', function(e) {
        if (editor) document.querySelector('#descriptionEditor').value = editor.getData();
        if (policyEditor) document.querySelector('#policyEditor').value = policyEditor.getData();
    });

    function addTimeline() {
        const html = `
            <div class="timeline-item border p-3 mb-3 rounded" style="background:#f8fafc;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong class="text-primary">Lịch trình mới</strong>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.timeline-item').remove()"><i class="fas fa-trash"></i></button>
                </div>
                <input type="text" name="timeline_title[]" class="form-control mb-2" placeholder="Tiêu đề (VD: Ngày 2: Tham quan thung lũng tình yêu)">
                <textarea name="timeline_desc[]" class="form-control" rows="3" placeholder="Chi tiết các hoạt động..."></textarea>
            </div>
        `;
        document.getElementById('timelineContainer').insertAdjacentHTML('beforeend', html);
    }

    document.getElementById('imageInput').addEventListener('change', function(event) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';
        const files = event.target.files;
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
