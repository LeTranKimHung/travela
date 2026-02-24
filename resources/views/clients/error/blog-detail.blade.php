@include('clients.blocks.header')

@php
    $bannerImg = isset($tours) && $tours->isNotEmpty() ? $tours->first()->images[0] : 'default.jpg';
@endphp

<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">

<div style="background: url('{{ asset('clients/img/galery-tour/' . $bannerImg) }}') center center/cover no-repeat; padding: 150px 0 28px 0; position: relative;">
    <div style="background:rgba(155, 155, 158, 0.7); position:absolute; inset:0;"></div>
    <div class="container" style="position:relative; z-index:2;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background:transparent; margin-bottom:0;">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" style="color:#fff; text-decoration:underline;">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('blog') }}" style="color:#fff; text-decoration:underline;">
                        Blog
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color:#fff;">
                    Chi tiết bài viết
                </li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Post Content -->
                <div class="blog-detail-content">
                    @if($post->image)
                        <img src="{{ asset('clients/img/blog/' . $post->image) }}" class="img-fluid w-100 rounded mb-4" alt="{{ $post->title }}">
                    @endif
                    
                    <div class="d-flex align-items-center mb-3">
                        <small class="text-muted me-3"><i class="fa fa-calendar-alt text-primary me-2"></i>{{ date('d/m/Y', strtotime($post->created_at)) }}</small>
                        <small class="text-muted"><i class="fa fa-user text-primary me-2"></i>Đăng bởi: {{ $post->author }}</small>
                    </div>
                    
                    <h1 class="mb-4">{{ $post->title }}</h1>
                    
                    <div class="summary-box p-3 bg-light rounded mb-4 border-start border-primary border-4">
                        <p class="mb-0 fw-bold italic">{{ $post->summary }}</p>
                    </div>
                    
                    <div class="content body-text" style="line-height: 1.8; font-size: 1.1rem; color: #444;">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                    
                    <div class="mt-5 pt-4 border-top">
                        <a href="{{ route('blog') }}" class="btn btn-primary rounded-pill py-2 px-4">
                            <i class="fas fa-arrow-left me-2"></i> Quay lại danh sách Blog
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Sidebar -->
                <div class="sidebar bg-light p-4 rounded shadow-sm">
                    <h4 class="mb-4">Bài viết khác</h4>
                    @foreach($relatedPosts as $related)
                    <div class="related-post-item mb-4 d-flex align-items-center gap-3">
                        <div style="flex-shrink: 0;">
                            @if($related->image)
                                <img src="{{ asset('clients/img/blog/' . $related->image) }}" class="rounded" style="width: 80px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-secondary rounded" style="width: 80px; height: 60px;"></div>
                            @endif
                        </div>
                        <div>
                            <h6 class="mb-1"><a href="{{ route('blog-detail', $related->postId) }}" class="text-dark text-decoration-none">{{ $related->title }}</a></h6>
                            <small class="text-muted">{{ date('d/m/Y', strtotime($related->created_at)) }}</small>
                        </div>
                    </div>
                    @endforeach
                    
                    <hr>
                    
                    <h4 class="mb-4 mt-4">Tìm kiếm</h4>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Nhập từ khóa...">
                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('clients.blocks.footer')

<style>
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .body-text {
        white-space: pre-wrap;
    }
</style>
