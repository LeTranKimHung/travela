<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Đánh giá - Travel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #0f172a; color: white; }
        .sidebar .nav-link { color: rgba(255, 255, 255, 0.7); padding: 12px 20px; margin: 5px 15px; border-radius: 10px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background-color: #1e293b; color: #38bdf8; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-4">
                    <h4><i class="fas fa-plane-departure"></i> Travel Admin</h4>
                </div>
                <nav class="nav flex-column px-3">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                    <a class="nav-link" href="{{ route('admin.tours.index') }}"><i class="fas fa-map-marked-alt me-2"></i> Quản lý Tour</a>
                    <a class="nav-link" href="{{ route('admin.bookings.index') }}"><i class="fas fa-calendar-check me-2"></i> Đơn hàng</a>
                    <a class="nav-link" href="{{ route('admin.posts.index') }}"><i class="fas fa-newspaper me-2"></i> Quản lý Bài viết</a>
                    <a class="nav-link" href="{{ route('admin.galleries.index') }}"><i class="fas fa-images me-2"></i> Quản lý Gallery</a>
                    <a class="nav-link active" href="{{ route('admin.reviews.index') }}"><i class="fas fa-star me-2"></i> Quản lý Review</a>
                </nav>
            </div>
            <div class="col-md-9 col-lg-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Chỉnh sửa đánh giá</h2>
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary text-white"><i class="fas fa-arrow-left"></i> Quay lại</a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.reviews.update', $review->reviewId) }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Tên khách hàng <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ $review->name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Địa chỉ/Vị trí</label>
                                        <input type="text" name="location" class="form-control" value="{{ $review->location }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Đánh giá (1-5 sao)</label>
                                        <select name="rating" class="form-select">
                                            @for($i = 5; $i >= 1; $i--)
                                                <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                                                    @for($s = 0; $s < $i; $s++)⭐@endfor {{ $i }} Sao
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Trạng thái</label>
                                        <div class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" name="status" value="1" {{ $review->status == 1 ? 'checked' : '' }} id="statusSwitch">
                                            <label class="form-check-label" for="statusSwitch">Hiển thị trên trang chủ</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nội dung đánh giá <span class="text-danger">*</span></label>
                                        <textarea name="content" id="contentEditor" class="form-control" rows="4" required>{{ $review->content }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success px-5 py-2"><i class="fas fa-check me-2"></i> Cập nhật đánh giá</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#contentEditor'), {
            toolbar: ['bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'undo', 'redo'],
            placeholder: 'Nhập cảm nhận của khách hàng...'
        }).catch(err => console.error(err));
    </script>
    <style>.ck-editor__editable { min-height: 150px; }</style>
</body>
</html>
