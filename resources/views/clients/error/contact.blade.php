@include('clients.blocks.header')
<link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">

@php $bannerImg = isset($tours) && $tours->isNotEmpty() ? $tours->first()->images[0] : null; @endphp

{{-- Hero Banner --}}
<div style="background: url('{{ $bannerImg ? asset('clients/img/galery-tour/'.$bannerImg) : asset('clients/img/about-img.jpg') }}') center center/cover no-repeat; padding:130px 0 50px; position:relative;">
    <div style="background:linear-gradient(180deg,rgba(15,23,42,0.7) 0%,rgba(15,23,42,0.45) 100%); position:absolute; inset:0;"></div>
    <div class="container" style="position:relative; z-index:2;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:#93c5fd; text-decoration:none;"><i class="fas fa-home me-1"></i>Trang chủ</a></li>
                <li class="breadcrumb-item active" style="color:#fff;">Liên hệ</li>
            </ol>
        </nav>
        <h1 style="color:#fff; font-weight:700; font-size:2.2rem; margin-bottom:8px;">
            <i class="fas fa-envelope me-2" style="color:#38bdf8;"></i>Liên Hệ Với Chúng Tôi
        </h1>
        <p style="color:rgba(255,255,255,0.8); font-size:1rem; margin:0;">Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn</p>
    </div>
</div>

{{-- Contact Content --}}
<div style="background:#f8fafc;" class="py-5">
    <div class="container py-4">

        {{-- Info Cards --}}
        <div class="row g-4 mb-5">
            @foreach([['fas fa-map-marker-alt','#ef4444','Địa chỉ','10/80c Song Hành Xa Lộ Hà Nội, Phường Tân Phú, Thủ Đức, Hồ Chí Minh'],['fas fa-phone-alt','#0ea5e9','Điện thoại','+84 123 456 789'],['fas fa-envelope','#10b981','Email','hungltk2004@gmail.com'],['fas fa-clock','#f59e0b','Giờ làm việc','Thứ 2 - Thứ 7: 8:00 - 18:00']] as [$icon,$color,$label,$val])
            <div class="col-md-6 col-lg-3">
                <div style="background:#fff; border-radius:16px; padding:28px 20px; text-align:center; box-shadow:0 2px 12px rgba(0,0,0,0.06); height:100%; transition:transform 0.2s;" onmouseenter="this.style.transform='translateY(-4px)'" onmouseleave="this.style.transform=''">
                    <div style="width:56px; height:56px; border-radius:16px; background:{{ $color }}18; display:flex; align-items:center; justify-content:center; margin:0 auto 14px;">
                        <i class="{{ $icon }}" style="font-size:1.4rem; color:{{ $color }};"></i>
                    </div>
                    <div style="font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#94a3b8; margin-bottom:6px;">{{ $label }}</div>
                    <div style="font-size:0.9rem; font-weight:600; color:#334155; line-height:1.5;">{{ $val }}</div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row g-4">
            {{-- Contact Form --}}
            <div class="col-lg-7">
                <div style="background:#fff; border-radius:16px; padding:36px; box-shadow:0 2px 12px rgba(0,0,0,0.07);">
                    <h4 style="font-weight:700; color:#0f172a; margin-bottom:6px;">Gửi tin nhắn cho chúng tôi</h4>
                    <p style="color:#64748b; font-size:0.9rem; margin-bottom:28px;">Điền vào form bên dưới, chúng tôi sẽ phản hồi trong vòng 24 giờ</p>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label style="font-size:0.82rem; font-weight:600; color:#374151; display:block; margin-bottom:6px;">Họ và tên *</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập họ tên của bạn" required style="border-radius:10px; border:1.5px solid #e2e8f0; padding:10px 14px; font-size:0.9rem;">
                            </div>
                            <div class="col-md-6">
                                <label style="font-size:0.82rem; font-weight:600; color:#374151; display:block; margin-bottom:6px;">Email *</label>
                                <input type="email" name="email" class="form-control" placeholder="email@gmail.com" required style="border-radius:10px; border:1.5px solid #e2e8f0; padding:10px 14px; font-size:0.9rem;">
                            </div>
                            <div class="col-12">
                                <label style="font-size:0.82rem; font-weight:600; color:#374151; display:block; margin-bottom:6px;">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" placeholder="+84 xxx xxx xxx" style="border-radius:10px; border:1.5px solid #e2e8f0; padding:10px 14px; font-size:0.9rem;">
                            </div>
                            <div class="col-12">
                                <label style="font-size:0.82rem; font-weight:600; color:#374151; display:block; margin-bottom:6px;">Chủ đề</label>
                                <input type="text" name="subject" class="form-control" placeholder="Bạn muốn hỏi về điều gì?" style="border-radius:10px; border:1.5px solid #e2e8f0; padding:10px 14px; font-size:0.9rem;">
                            </div>
                            <div class="col-12">
                                <label style="font-size:0.82rem; font-weight:600; color:#374151; display:block; margin-bottom:6px;">Nội dung tin nhắn *</label>
                                <textarea name="message" class="form-control" rows="5" placeholder="Nhập nội dung tin nhắn của bạn..." required style="border-radius:10px; border:1.5px solid #e2e8f0; padding:10px 14px; font-size:0.9rem; resize:vertical;"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" style="width:100%; background:linear-gradient(135deg,#0ea5e9,#38bdf8); color:#fff; border:none; padding:13px; border-radius:12px; font-size:1rem; font-weight:700; cursor:pointer; transition:opacity 0.2s; display:flex; align-items:center; justify-content:center; gap:8px;" onmouseenter="this.style.opacity='0.88'" onmouseleave="this.style.opacity='1'">
                                    <i class="fas fa-paper-plane"></i> Gửi tin nhắn
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Map --}}
            <div class="col-lg-5">
                <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.07); height:100%; display:flex; flex-direction:column;">
                    <div style="padding:20px 24px; border-bottom:1px solid #f1f5f9;">
                        <h6 style="font-weight:700; color:#0f172a; margin:0;">
                            <i class="fas fa-map-pin me-2" style="color:#ef4444;"></i>Vị trí của chúng tôi
                        </h6>
                    </div>
                    <div style="flex:1; min-height:350px;">
                        <iframe class="w-100 h-100" style="min-height:350px; border:0; display:block;"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.5469984176198!2d106.78279807480604!3d10.855042689298537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527c3debb5aad%3A0x5fb58956eb4194d0!2zxJDhuqFpIEjhu41jIEh1dGVjaCBLaHUgRQ!5e1!3m2!1sen!2s!4v1759540416698!5m2!1sen!2s"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <div style="padding:16px 24px; background:#f8fafc;">
                        <div style="display:flex; gap:8px; align-items:flex-start;">
                            <i class="fas fa-map-marker-alt" style="color:#ef4444; margin-top:2px; flex-shrink:0;"></i>
                            <span style="font-size:0.85rem; color:#475569; line-height:1.5;">10/80c Song Hành Xa Lộ Hà Nội, Phường Tân Phú, Thủ Đức, Hồ Chí Minh</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('clients.blocks.footer')
