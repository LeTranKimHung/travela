<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa ảnh - Travel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #0f172a; color: white; }
        .sidebar .nav-link { color: rgba(255, 255, 255, 0.7); padding: 12px 20px; margin: 5px 15px; border-radius: 10px; }
        .sidebar .nav-link.active { background-color: #1e293b; color: #38bdf8; }
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
                    <a class="nav-link" href="{{ route('admin.galleries.index') }}"><i class="fas fa-images me-2"></i> Quản lý Gallery</a>
                </nav>
            </div>
            <div class="col-md-9 col-lg-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Chỉnh sửa ảnh bộ sưu tập</h2>
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary text-white"><i class="fas fa-arrow-left"></i> Quay lại</a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.galleries.update', $gallery->galleryId) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Tiêu đề ảnh</label>
                                        <input type="text" name="title" class="form-control" value="{{ $gallery->title }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Danh mục</label>
                                        <input type="text" name="category" class="form-control" value="{{ $gallery->category }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Cập nhật ảnh (Để trống nếu không đổi)</label>
                                        <input type="file" name="image" class="form-control" id="imageInput" accept="image/*">
                                        <div class="mt-3 text-center border rounded p-2 bg-light">
                                            <p class="text-muted small mb-1">Ảnh hiện tại/mới:</p>
                                            <img id="imagePreview" src="{{ asset('clients/img/gallery/' . $gallery->image) }}" class="img-fluid rounded" style="max-height: 140px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4 text-end">
                                    <button type="submit" class="btn btn-success px-5 py-2"><i class="fas fa-check me-2"></i> Cập nhật ngay</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('imageInput').onchange = function (evt) {
            const [file] = this.files;
            if (file) {
                const preview = document.getElementById('imagePreview');
                preview.src = URL.createObjectURL(file);
            }
        };
    </script>
</body>
</html>
