<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa bài viết - Travel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; overflow-x: hidden; }
        .sidebar {
            min-height: 100vh;
            background: #0f172a;
            color: white;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        @media (max-width: 768px) {
            .sidebar { position: fixed; left: -100%; width: 250px; height: 100%; }
            .sidebar.show { left: 0; }
            .main-content { width: 100% !important; margin-left: 0 !important; }
            .overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999; }
            .overlay.show { display: block; }
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 10px;
            transition: all 0.3s;
            font-weight: 500;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #1e293b;
            color: #38bdf8;
        }
        .navbar-custom { background: white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 10px 20px; }
        .sidebar-toggler { background: none; border: none; font-size: 24px; color: #0f172a; display: none; }
        @media (max-width: 768px) { .sidebar-toggler { display: block; } }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div id="sidebarOverlay" class="overlay"></div>
            <div id="sidebar" class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-4 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-plane-departure"></i> Travel Admin</h4>
                    <button class="sidebar-toggler text-white d-md-none" onclick="toggleSidebar()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <nav class="nav flex-column px-3">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                    <a class="nav-link" href="{{ route('admin.tours.index') }}"><i class="fas fa-map-marked-alt me-2"></i> Quản lý Tour</a>
                    <a class="nav-link" href="{{ route('admin.bookings.index') }}"><i class="fas fa-calendar-check me-2"></i> Đơn hàng</a>
                    <a class="nav-link active" href="{{ route('admin.posts.index') }}"><i class="fas fa-newspaper me-2"></i> Quản lý Bài viết</a>
                    <hr class="text-white-50">
                    <a class="nav-link text-white-50" href="{{ route('home') }}"><i class="fas fa-home me-2"></i> Về website</a>
                </nav>
            </div>
            <div class="col-md-9 col-lg-10 p-0 main-content">
                <nav class="navbar navbar-expand navbar-custom mb-4">
                    <div class="container-fluid">
                        <button class="sidebar-toggler me-3" onclick="toggleSidebar()">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h5 class="mb-0">Chỉnh sửa bài viết</h5>
                    </div>
                </nav>
                <div class="p-4">
                    <h2 class="mb-4">Sửa bài viết: {{ $post->title }}</h2>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="{{ route('admin.posts.update', $post->postId) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Tiêu đề bài viết</label>
                                    <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tóm tắt (Mô tả ngắn)</label>
                                    <textarea name="summary" id="summaryEditor" class="form-control" rows="3" required>{{ $post->summary }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nội dung chi tiết</label>
                                    <textarea name="content" id="contentEditor" class="form-control" rows="10" required>{{ $post->content }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hình ảnh đại diện</label>
                                    <div class="mb-2">
                                        @if($post->image)
                                            <img src="{{ asset('clients/img/blog/' . $post->image) }}" id="currentImage" style="max-width: 200px; border-radius: 8px;">
                                        @endif
                                    </div>
                                    <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                                    <div id="imagePreview" class="mt-3"></div>
                                </div>
                                <div class="text-end">
                                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Hủy</a>
                                    <button type="submit" class="btn btn-primary px-4">Cập nhật bài viết</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
        document.getElementById('sidebarOverlay').addEventListener('click', toggleSidebar);

        document.getElementById('imageInput').addEventListener('change', function(event) {
            const preview = document.getElementById('imagePreview');
            const currentImg = document.getElementById('currentImage');
            preview.innerHTML = '';
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (currentImg) currentImg.style.display = 'none';
                    preview.innerHTML = `<img src="${e.target.result}" style="max-width: 300px; border-radius: 8px; border: 1px solid #ddd;">`;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#summaryEditor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'undo', 'redo'],
            placeholder: 'Nhập tóm tắt bài viết...'
        }).catch(err => console.error(err));
        ClassicEditor.create(document.querySelector('#contentEditor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'underline', 'strikethrough', '|', 'bulletedList', 'numberedList', '|', 'blockQuote', 'link', 'insertTable', '|', 'undo', 'redo'],
            placeholder: 'Nhập nội dung bài viết...'
        }).catch(err => console.error(err));
    </script>
    <style>
        .ck-editor__editable { min-height: 150px; }
        .ck-editor__editable[role="textbox"]:last-of-type { min-height: 300px; }
    </style>
</body>
</html>
