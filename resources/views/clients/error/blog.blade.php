@include('clients.blocks.header')
<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">

@php $bannerImg = isset($tours) && $tours->isNotEmpty() ? $tours->first()->images[0] : null; @endphp

{{-- Hero Banner --}}
<div style="background: url('{{ $bannerImg ? asset('clients/img/galery-tour/'.$bannerImg) : asset('clients/img/blog-1.jpg') }}') center center/cover no-repeat; padding:130px 0 50px; position:relative;">
    <div style="background:linear-gradient(180deg,rgba(15,23,42,0.7) 0%,rgba(15,23,42,0.45) 100%); position:absolute; inset:0;"></div>
    <div class="container" style="position:relative; z-index:2;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#93c5fd; text-decoration:none;"><i class="fas fa-home me-1"></i>Trang chủ</a></li>
                <li class="breadcrumb-item active" style="color:#fff;">Blog</li>
            </ol>
        </nav>
        <h1 style="color:#fff; font-weight:700; font-size:2.2rem; margin-bottom:8px;">
            <i class="fas fa-newspaper me-2" style="color:#38bdf8;"></i>Blog Du Lịch
        </h1>
        <p style="color:rgba(255,255,255,0.8); font-size:1rem; margin:0;">Khám phá những câu chuyện, kinh nghiệm và địa điểm tuyệt vời từ Travela</p>
    </div>
</div>

{{-- Blog Content --}}
<div style="background:#f8fafc;" class="py-5">
    <div class="container py-4">

        <div class="text-center mb-5">
            <div style="display:inline-block; background:#0ea5e920; color:#0ea5e9; font-size:0.78rem; font-weight:700; padding:4px 14px; border-radius:20px; letter-spacing:1px; text-transform:uppercase; margin-bottom:12px;">Bài viết</div>
            <h2 style="font-weight:800; color:#0f172a; font-size:1.8rem; margin-bottom:8px;">Các Bài Viết Mới Nhất</h2>
            <p style="color:#64748b; max-width:600px; margin:0 auto;">Hãy cùng khám phá những câu chuyện du lịch thú vị, kinh nghiệm hữu ích và địa điểm tuyệt vời</p>
        </div>

        @if($posts->isEmpty())
        <div style="background:#fff; border-radius:16px; padding:60px 20px; text-align:center; box-shadow:0 2px 12px rgba(0,0,0,0.06);">
            <i class="fas fa-newspaper" style="font-size:3rem; color:#cbd5e1; margin-bottom:16px; display:block;"></i>
            <h5 style="color:#334155;">Chưa có bài viết nào</h5>
            <p style="color:#94a3b8;">Hãy quay lại sau nhé!</p>
        </div>
        @else
        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.07); display:flex; flex-direction:column; height:100%; transition:transform 0.25s, box-shadow 0.25s;" onmouseenter="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 12px 28px rgba(0,0,0,0.13)'" onmouseleave="this.style.transform=''; this.style.boxShadow='0 2px 12px rgba(0,0,0,0.07)'">
                    {{-- Image --}}
                    <div style="height:210px; overflow:hidden; position:relative;">
                        <img src="{{ $post->image ? asset('clients/img/blog/'.$post->image) : asset('clients/img/blog-1.jpg') }}"
                             alt="{{ $post->title }}"
                             style="width:100%; height:100%; object-fit:cover; transition:transform 0.4s;"
                             onmouseenter="this.style.transform='scale(1.06)'" onmouseleave="this.style.transform=''">
                        <div style="position:absolute; top:12px; left:12px; background:rgba(15,23,42,0.75); color:#fff; font-size:0.72rem; padding:4px 10px; border-radius:20px; backdrop-filter:blur(4px);">
                            <i class="fas fa-calendar-alt me-1" style="color:#38bdf8;"></i>{{ date('d/m/Y', strtotime($post->created_at)) }}
                        </div>
                    </div>
                    {{-- Content --}}
                    <div style="padding:20px; flex:1; display:flex; flex-direction:column;">
                        <div style="font-size:0.8rem; color:#64748b; margin-bottom:8px;">
                            <i class="fas fa-user me-1" style="color:#0ea5e9;"></i>{{ $post->author }}
                        </div>
                        <h6 style="font-weight:700; color:#0f172a; font-size:1rem; margin-bottom:10px; line-height:1.4; min-height:2.8em;">
                            <a href="{{ route('blog-detail', $post->postId) }}" style="color:inherit; text-decoration:none; transition:color 0.2s;" onmouseenter="this.style.color='#0ea5e9'" onmouseleave="this.style.color='#0f172a'">
                                {{ Str::limit($post->title, 70) }}
                            </a>
                        </h6>
                        <p style="font-size:0.87rem; color:#64748b; line-height:1.6; margin-bottom:16px; flex:1;">
                            {{ Str::limit($post->summary, 110) }}
                        </p>
                        <a href="{{ route('blog-detail', $post->postId) }}"
                           style="display:inline-flex; align-items:center; gap:6px; background:linear-gradient(135deg,#0ea5e9,#38bdf8); color:#fff; padding:9px 18px; border-radius:10px; font-size:0.85rem; font-weight:600; text-decoration:none; align-self:flex-start; transition:opacity 0.2s;"
                           onmouseenter="this.style.opacity='0.88'" onmouseleave="this.style.opacity='1'">
                            <i class="fas fa-book-open"></i> Đọc thêm
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@include('clients.blocks.footer')
