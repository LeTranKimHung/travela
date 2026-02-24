<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm ảnh mới - Travel Admin</title>
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
                    <a class="nav-link" href="{{ route('admin.tours.index') }}"><i class="fas fa-map-marked-alt me-2"></i> Quản lý Tour</a>
                    <a class="nav-link" href="{{ route('admin.galleries.index') }}"><i class="fas fa-images me-2"></i> Quản lý Gallery</a>
                </nav>
            </div>
            <div class="col-md-9 col-lg-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Thêm ảnh vào bộ sưu tập</h2>
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary text-white"><i class="fas fa-arrow-left"></i> Quay lại</a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Tiêu đề ảnh</label>
                                        <input type="text" name="title" class="form-control" placeholder="Ví dụ: Hoàng hôn Phú Quốc" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Danh mục</label>
                                        <input type="text" name="category" class="form-control" placeholder="Ví dụ: Biển đảo, Núi rừng..." required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Chọn ảnh</label>
                                        <input type="file" name="image" class="form-control" id="imageInput" accept="image/*" required>
                                        <div class="mt-3 text-center border rounded p-2 bg-light" style="min-height: 150px;">
                                            <img id="imagePreview" src="#" alt="Xem trước ảnh" class="img-fluid rounded d-none" style="max-height: 140px;">
                                            <div id="previewText" class="text-muted pt-5">Xem trước ảnh sẽ hiển thị tại đây</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary px-5 py-2"><i class="fas fa-save me-2"></i> Lưu ảnh</button>
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
                const text = document.getElementById('previewText');
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('d-none');
                text.classList.add('d-none');
            }
        };
    </script>
</body>
</html>
