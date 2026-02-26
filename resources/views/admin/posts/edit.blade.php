@extends('admin.layouts.app')
@section('title', 'Sửa Bài viết')
@section('page-title', 'Chỉnh sửa Bài viết')

@section('head')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Sửa bài viết: {{ $post->title }}</h4>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Quay lại
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('admin.posts.update', $post->postId) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Tiêu đề bài viết</label>
                    <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tác giả</label>
                    <input type="text" name="author" class="form-control" value="{{ $post->author }}" placeholder="Tên tác giả">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Tóm tắt (Mô tả ngắn)</label>
                    <textarea name="summary" id="summaryEditor" class="form-control" rows="3">{{ $post->summary }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Nội dung chi tiết</label>
                    <textarea name="content" id="contentEditor" class="form-control" rows="10">{{ $post->content }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Hình ảnh đại diện</label>
                    @if($post->image)
                        <div class="mb-2">
                            <img src="{{ asset('clients/img/blog/' . $post->image) }}" id="currentImage" style="max-width:200px;border-radius:8px;">
                        </div>
                    @endif
                    <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                    <div id="imagePreview" class="mt-2"></div>
                </div>
                <div class="col-12 text-end border-top pt-3">
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Cập nhật bài viết
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let summaryEditor, contentEditor;
    ClassicEditor.create(document.querySelector('#summaryEditor'), {
        toolbar: ['heading','|','bold','italic','|','bulletedList','numberedList','|','undo','redo'],
    }).then(editor => {
        summaryEditor = editor;
    }).catch(err => console.error(err));
    ClassicEditor.create(document.querySelector('#contentEditor'), {
        toolbar: ['heading','|','bold','italic','|','bulletedList','numberedList','|','blockQuote','link','insertTable','|','undo','redo'],
    }).then(editor => {
        contentEditor = editor;
    }).catch(err => console.error(err));

    document.querySelector('form').addEventListener('submit', function(e) {
        if (summaryEditor) document.querySelector('#summaryEditor').value = summaryEditor.getData();
        if (contentEditor) document.querySelector('#contentEditor').value = contentEditor.getData();
    });

    document.getElementById('imageInput').addEventListener('change', function(event) {
        const preview = document.getElementById('imagePreview');
        const currentImg = document.getElementById('currentImage');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (currentImg) currentImg.style.display = 'none';
                preview.innerHTML = `<img src="${e.target.result}" style="max-width:300px;border-radius:8px;border:1px solid #e2e8f0;">`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
<style>.ck-editor__editable { min-height: 150px; }</style>
@endsection
