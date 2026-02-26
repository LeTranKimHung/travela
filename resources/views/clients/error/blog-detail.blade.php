@include('clients.blocks.header')
<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">

@php $bannerImg = $post->image ?? null; @endphp

{{-- Hero Banner --}}
<div style="background: url('{{ $bannerImg ? asset('clients/img/blog/'.$bannerImg) : asset('clients/img/blog-1.jpg') }}') center center/cover no-repeat; padding:130px 0 50px; position:relative;">
    <div style="background:linear-gradient(180deg,rgba(15,23,42,0.75) 0%,rgba(15,23,42,0.55) 100%); position:absolute; inset:0;"></div>
    <div class="container" style="position:relative; z-index:2;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#93c5fd; text-decoration:none;"><i class="fas fa-home me-1"></i>Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog') }}" style="color:#93c5fd; text-decoration:none;">Blog</a></li>
                <li class="breadcrumb-item active" style="color:#fff;">Chi tiết bài viết</li>
            </ol>
        </nav>
        <h1 style="color:#fff; font-weight:700; font-size:1.9rem; margin-bottom:8px; max-width:800px; line-height:1.3;">
            {{ $post->title }}
        </h1>
        <div style="display:flex; gap:16px; flex-wrap:wrap; margin-top:10px;">
            <span style="color:rgba(255,255,255,0.8); font-size:0.85rem;"><i class="fas fa-user me-1" style="color:#38bdf8;"></i>{{ $post->author }}</span>
            <span style="color:rgba(255,255,255,0.8); font-size:0.85rem;"><i class="fas fa-calendar-alt me-1" style="color:#38bdf8;"></i>{{ date('d/m/Y', strtotime($post->created_at)) }}</span>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div style="background:#f8fafc;" class="py-5">
    <div class="container py-4">
        <div class="row g-4">
            {{-- Article --}}
            <div class="col-lg-8">
                <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.07);">
                    {{-- Summary --}}
                    <div style="background:linear-gradient(135deg,#0ea5e910,#38bdf810); border-left:4px solid #0ea5e9; padding:20px 28px; margin:0;">
                        <p style="margin:0; font-size:1rem; color:#334155; font-weight:500; line-height:1.7; font-style:italic;">{{ $post->summary }}</p>
                    </div>
                    {{-- Content --}}
                    <div style="padding:32px 28px; font-size:1rem; color:#374151; line-height:1.9;">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                    {{-- Footer --}}
                    <div style="padding:20px 28px; border-top:1px solid #f1f5f9; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
                        <a href="{{ route('blog') }}" style="display:inline-flex; align-items:center; gap:8px; background:#f1f5f9; color:#334155; padding:10px 20px; border-radius:10px; font-size:0.88rem; font-weight:600; text-decoration:none; transition:background 0.2s;" onmouseenter="this.style.background='#e2e8f0'" onmouseleave="this.style.background='#f1f5f9'">
                            <i class="fas fa-arrow-left"></i> Quay lại Blog
                        </a>
                        <div style="font-size:0.82rem; color:#94a3b8;">
                            <i class="fas fa-calendar-alt me-1"></i>Đăng ngày {{ date('d/m/Y', strtotime($post->created_at)) }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div style="position:sticky; top:80px;">
                    {{-- Related Posts --}}
                    <div style="background:#fff; border-radius:16px; padding:24px; box-shadow:0 2px 12px rgba(0,0,0,0.07); margin-bottom:20px;">
                        <h6 style="font-weight:700; color:#0f172a; margin-bottom:16px; padding-bottom:12px; border-bottom:1px solid #f1f5f9;">
                            <i class="fas fa-list me-2" style="color:#0ea5e9;"></i>Bài viết khác
                        </h6>
                        @forelse($relatedPosts as $related)
                        <a href="{{ route('blog-detail', $related->postId) }}" style="display:flex; gap:12px; align-items:center; padding:10px 0; border-bottom:1px solid #f8fafc; text-decoration:none; transition:background 0.2s;" onmouseenter="this.style.background='#f8fafc'" onmouseleave="this.style.background=''">
                            @if($related->image)
                                <img src="{{ asset('clients/img/blog/'.$related->image) }}" style="width:70px; height:52px; object-fit:cover; border-radius:8px; flex-shrink:0;">
                            @else
                                <div style="width:70px; height:52px; background:#e2e8f0; border-radius:8px; flex-shrink:0; display:flex; align-items:center; justify-content:center;"><i class="fas fa-image" style="color:#94a3b8;"></i></div>
                            @endif
                            <div>
                                <div style="font-size:0.85rem; font-weight:600; color:#0f172a; line-height:1.3; margin-bottom:4px;">{{ Str::limit($related->title, 50) }}</div>
                                <div style="font-size:0.75rem; color:#94a3b8;"><i class="fas fa-calendar-alt me-1"></i>{{ date('d/m/Y', strtotime($related->created_at)) }}</div>
                            </div>
                        </a>
                        @empty
                        <p style="color:#94a3b8; font-size:0.85rem; margin:0;">Chưa có bài viết liên quan.</p>
                        @endforelse
                    </div>

                    {{-- CTA --}}
                    <div style="background:linear-gradient(135deg,#0f172a,#1e3a5f); border-radius:16px; padding:24px; text-align:center;">
                        <i class="fas fa-map-marked-alt" style="font-size:2rem; color:#38bdf8; margin-bottom:12px; display:block;"></i>
                        <h6 style="color:#fff; font-weight:700; margin-bottom:8px;">Sẵn sàng phiêu lưu?</h6>
                        <p style="color:rgba(255,255,255,0.7); font-size:0.82rem; margin-bottom:16px;">Khám phá các tour du lịch tuyệt vời từ Travela</p>
                        <a href="{{ route('packages') }}" style="display:inline-block; background:linear-gradient(135deg,#0ea5e9,#38bdf8); color:#fff; padding:10px 22px; border-radius:10px; font-size:0.88rem; font-weight:600; text-decoration:none;">Xem Tour ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('clients.blocks.footer')
