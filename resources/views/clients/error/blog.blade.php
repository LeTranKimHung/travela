@include('clients.blocks.header')

@php
    $bannerImg = isset($tours) && $tours->isNotEmpty() ? $tours->first()->images[0] : 'default.jpg';
@endphp
<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">
<div
    style="background: url('{{ asset('clients/img/galery-tour/' . $bannerImg) }}') center center/cover no-repeat; padding: 150px 0 28px 0; position: relative;">
    <div style="background:rgba(155, 155, 158, 0.7); position:absolute; inset:0;"></div>
    <div class="container" style="position:relative; z-index:2;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background:transparent; margin-bottom:0;">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" style="color:#fff; text-decoration:underline;">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color:#fff;">
                    {{ $title ?? 'Blog' }}
                </li>
            </ol>
        </nav>

    </div>
</div>
<!-- Header End -->

<!-- Blog Start -->
<div class="container-fluid blog py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Blog Của Chúng Tôi</h5>
            <h1 class="mb-4">Các Bài Viết Du Lịch Phổ Biến</h1>
            <p class="mb-0">
                Hãy cùng khám phá những câu chuyện du lịch thú vị, kinh nghiệm hữu ích và địa điểm tuyệt vời
                qua các bài viết mà chúng tôi chia sẻ. Mỗi chuyến đi là một hành trình đầy trải nghiệm và
                kỷ niệm đáng nhớ.
            </p>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <div class="blog-img">
                        <div class="blog-img-inner">
                            @if($post->image)
                                <img class="img-fluid w-100 rounded-top" src="{{ asset('clients/img/blog/' . $post->image) }}" alt="{{ $post->title }}">
                            @else
                                <img class="img-fluid w-100 rounded-top" src="{{ asset('clients/img/blog-1.jpg') }}" alt="Default">
                            @endif
                            <div class="blog-icon">
                                <a href="{{ route('blog-detail', $post->postId) }}" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>
                            </div>
                        </div>
                        <div class="blog-info d-flex align-items-center border border-start-0 border-end-0">
                            <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-calendar-alt text-primary me-2"></i>{{ date('d/m/Y', strtotime($post->created_at)) }}</small>
                            <a href="{{ route('blog-detail', $post->postId) }}" class="btn-hover flex-fill text-center text-white border-end py-2"><i
                                    class="fa fa-thumbs-up text-primary me-2"></i>1.7K</a>
                            <a href="{{ route('blog-detail', $post->postId) }}" class="btn-hover flex-fill text-center text-white py-2"><i
                                    class="fa fa-comments text-primary me-2"></i>1K</a>
                        </div>
                    </div>
                    <div class="blog-content border border-top-0 rounded-bottom p-4">
                        <p class="mb-3">Đăng bởi: {{ $post->author }} </p>
                        <a href="{{ route('blog-detail', $post->postId) }}" class="h4">{{ $post->title }}</a>
                        <p class="my-3 text-truncate-2">{{ $post->summary }}</p>
                        <a href="{{ route('blog-detail', $post->postId) }}" class="btn btn-primary rounded-pill py-2 px-4">Đọc Thêm</a>
                    </div>
                </div>
            </div>
            @endforeach
            @if($posts->isEmpty())
                <div class="text-center col-12">Chưa có bài viết nào.</div>
            @endif
        </div>
    </div>
</div>
<!-- Blog End -->
@include('clients.blocks.footer')
