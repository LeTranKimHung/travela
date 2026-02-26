@extends('admin.layouts.app')
@section('title', 'Quản lý Bài viết')
@section('page-title', 'Quản lý Bài viết')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Danh sách Bài viết</h4>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Thêm bài viết mới
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Người đăng</th>
                        <th>Ngày tạo</th>
                        <th class="pe-4 text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td class="ps-4">
                            @if($post->image)
                                <img src="{{ asset('clients/img/blog/' . $post->image) }}" class="rounded" style="width:60px;height:40px;object-fit:cover;">
                            @else
                                <div class="bg-secondary bg-opacity-10 rounded d-flex align-items-center justify-content-center" style="width:60px;height:40px;">
                                    <i class="fas fa-image text-secondary"></i>
                                </div>
                            @endif
                        </td>
                        <td><div class="fw-semibold text-truncate" style="max-width:300px;">{{ $post->title }}</div></td>
                        <td class="text-muted">{{ $post->author }}</td>
                        <td class="text-muted small">{{ date('d/m/Y', strtotime($post->created_at)) }}</td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.posts.edit', $post->postId) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.posts.destroy', $post->postId) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($posts->isEmpty())
                    <tr><td colspan="5" class="text-center py-5 text-muted">Chưa có bài viết nào.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
