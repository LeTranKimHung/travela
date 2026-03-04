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
                    <select name="destination" id="destinationSelect" class="form-select" required>
                        <option value="">Chọn khu vực trước</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Khu vực</label>
                    <select name="domain" id="domainSelect" class="form-select" required>
                        <option value="trong_nuoc">Trong nước</option>
                        <option value="ngoai_nuoc">Ngoài nước</option>
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
                    <label class="form-label fw-semibold">Quy định & Chính sách</label>
                    <textarea name="policy" id="policyEditor" class="form-control" rows="4"></textarea>
                </div>
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label fw-semibold mb-0">Lịch trình Tour</label>
                        <button type="button" class="btn btn-sm btn-success" onclick="addTimeline()"><i class="fas fa-plus"></i> Thêm ngày mới</button>
                    </div>
                    <div id="timelineContainer">
                        <div class="timeline-item border p-3 mb-3 rounded" style="background:#f8fafc;">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong class="text-primary">Lịch trình</strong>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeTimeline(this)"><i class="fas fa-trash"></i></button>
                            </div>
                            <input type="text" name="timeline_title[]" class="form-control mb-2" placeholder="Tiêu đề (VD: Ngày 1: TP.HCM - Đà Lạt)">
                            <textarea name="timeline_desc[]" class="form-control timeline-editor" rows="3" placeholder="Chi tiết các hoạt động..."></textarea>
                        </div>
                    </div>
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
    let editor, policyEditor;
    let timelineEditors = [];

    ClassicEditor.create(document.querySelector('#descriptionEditor'), {
        toolbar: ['heading','|','bold','italic','|','bulletedList','numberedList','|','blockQuote','link','insertTable','|','undo','redo'],
        placeholder: 'Nhập mô tả chi tiết về tour...'
    }).then(newEditor => {
        editor = newEditor;
    }).catch(err => console.error(err));

    ClassicEditor.create(document.querySelector('#policyEditor'), {
        toolbar: ['heading','|','bold','italic','|','bulletedList','numberedList','|','blockQuote','link','insertTable','|','undo','redo'],
        placeholder: 'Nhập quy định, visa, phụ thu...'
    }).then(newEditor => {
        policyEditor = newEditor;
    }).catch(err => console.error(err));

    function initTimelineEditors() {
        document.querySelectorAll('.timeline-editor').forEach(el => {
            if (!el.dataset.initialized) {
                ClassicEditor.create(el, {
                    toolbar: ['heading','|','bold','italic','|','bulletedList','numberedList','|','blockQuote','link','insertTable','|','undo','redo'],
                }).then(newEditor => {
                    timelineEditors.push({ element: el, editor: newEditor });
                    el.dataset.initialized = 'true';
                }).catch(err => console.error(err));
            }
        });
    }

    initTimelineEditors();

    // Đảm bảo dữ liệu được cập nhật từ CKEditor vào textarea trước khi submit
    document.querySelector('form').addEventListener('submit', function(e) {
        if (editor) document.querySelector('#descriptionEditor').value = editor.getData();
        if (policyEditor) document.querySelector('#policyEditor').value = policyEditor.getData();
        
        timelineEditors.forEach(item => {
            item.element.value = item.editor.getData();
        });
    });

    function addTimeline() {
        const html = `
            <div class="timeline-item border p-3 mb-3 rounded" style="background:#f8fafc;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong class="text-primary">Lịch trình mới</strong>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeTimeline(this)"><i class="fas fa-trash"></i></button>
                </div>
                <input type="text" name="timeline_title[]" class="form-control mb-2" placeholder="Tiêu đề (VD: Ngày 2: Tham quan thung lũng tình yêu)">
                <textarea name="timeline_desc[]" class="form-control timeline-editor" rows="3" placeholder="Chi tiết các hoạt động..."></textarea>
            </div>
        `;
        document.getElementById('timelineContainer').insertAdjacentHTML('beforeend', html);
        initTimelineEditors();
    }

    function removeTimeline(btn) {
        const item = btn.closest('.timeline-item');
        const textarea = item.querySelector('.timeline-editor');
        if (textarea) {
            timelineEditors = timelineEditors.filter(t => t.element !== textarea);
        }
        item.remove();
    }

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

    // Handle Dynamic Destinations
    const vnProvinces = [
        "An Giang", "Bà Rịa - Vũng Tàu", "Bắc Giang", "Bắc Kạn", "Bạc Liêu", "Bắc Ninh", "Bến Tre", "Bình Định", "Bình Dương", "Bình Phước", "Bình Thuận", "Cà Mau", "Cần Thơ", "Cao Bằng", "Đà Nẵng", "Đắk Lắk", "Đắk Nông", "Điện Biên", "Đồng Nai", "Đồng Tháp", "Gia Lai", "Hà Giang", "Hà Nam", "Hà Nội", "Hà Tĩnh", "Hải Dương", "Hải Phòng", "Hậu Giang", "Hòa Bình", "Hồ Chí Minh", "Hưng Yên", "Khánh Hòa", "Kiên Giang", "Kon Tum", "Lai Châu", "Lâm Đồng", "Lạng Sơn", "Lào Cai", "Long An", "Nam Định", "Nghệ An", "Ninh Bình", "Ninh Thuận", "Phú Thọ", "Phú Yên", "Quảng Bình", "Quảng Nam", "Quảng Ngãi", "Quảng Ninh", "Quảng Trị", "Sóc Trăng", "Sơn La", "Tây Ninh", "Thái Bình", "Thái Nguyên", "Thanh Hóa", "Thừa Thiên Huế", "Tiền Giang", "Trà Vinh", "Tuyên Quang", "Vĩnh Long", "Vĩnh Phúc", "Yên Bái"
    ];
    const intlCountries = [
        "Ai Cập", "Anh", "Ấn Độ", "Brazil", "Canada", "Đài Loan", "Đức", "Hàn Quốc", "Hà Lan", "Malaysia", "Mỹ", "Nam Phi", "New Zealand", "Nhật Bản", "Pháp", "Singapore", "Tây Ban Nha", "Thái Lan", "Thụy Sĩ", "Trung Quốc", "Úc", "Ý"
    ];

    const domainSelect = document.getElementById('domainSelect');
    const destinationSelect = document.getElementById('destinationSelect');

    function updateDestinations() {
        const domain = domainSelect.value;
        const options = domain === 'trong_nuoc' ? vnProvinces : intlCountries;
        
        destinationSelect.innerHTML = '';
        options.forEach(dest => {
            const opt = document.createElement('option');
            opt.value = dest;
            opt.textContent = dest;
            destinationSelect.appendChild(opt);
        });
    }

    domainSelect.addEventListener('change', updateDestinations);
    // Init on load
    updateDestinations();
</script>
<style>.ck-editor__editable { min-height: 200px; }</style>
@endsection
