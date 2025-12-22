@include('clients.blocks.header')
@php
    $bannerImg = $tours->first()->images[0] ?? 'default.jpg';
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
                    {{ $title ?? 'Liên hệ' }}
                </li>
            </ol>
        </nav>

    </div>
</div>
<!-- Header End -->

<!-- Contact Start -->
<div class="container-fluid contact bg-light py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Liên hệ với chúng tôi</h5>
            <h1 class="mb-0">Liên hệ để được hỗ trợ</h1>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-lg-4">
                <div class="bg-white rounded p-4">
                    <div class="text-center mb-4">
                        <i class="fa fa-map-marker-alt fa-3x text-primary"></i>
                        <h4 class="text-primary">
                            Địa chỉ
                        </h4>
                        <p class="mb-0">10/80c Song Hành Xa Lộ Hà Nội, Phường Tân Phú, Thủ Đức, <br> Hồ Chí Minh, Vietnam</p>
                    </div>
                    <div class="text-center mb-4">
                        <i class="fa fa-phone-alt fa-3x text-primary mb-3"></i>
                        <h4 class="text-primary">Điện thoại</h4>
                        <p class="mb-0">+012 345 67890</p>
                        <p class="mb-0">+012 345 67890</p>
                    </div>

                    <div class="text-center">
                        <i class="fa fa-envelope-open fa-3x text-primary mb-3"></i>
                        <h4 class="text-primary">Email</h4>
                        <p class="mb-0">hungltk2004@gmail.com</p>
                        {{-- <p class="mb-0">info@example.com</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <h3 class="mb-2">Gửi cho chúng tôi tin nhắn</h3>
                {{-- <p class="mb-4">Mẫu liên hệ hiện chưa hoạt động. Bạn có thể tải về một mẫu liên hệ đầy đủ chức năng với Ajax & PHP chỉ trong vài phút. Chỉ cần sao chép và dán các tệp, thêm một chút mã và hoàn tất. <a
                        href="https://htmlcodex.com/contact-form">Tải xuống ngay</a>.</p> --}}
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0" id="name"
                                    placeholder="Tên của bạn">
                                <label for="name">Tên của bạn</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control border-0" id="email"
                                    placeholder="Email của bạn">
                                <label for="email">Email của bạn</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0" id="subject"
                                    placeholder="Chủ đề">
                                <label for="subject">Chủ đề</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control border-0" placeholder="Nhập tin nhắn ở đây" id="message" style="height: 160px"></textarea>
                                <label for="message">Tin nhắn</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Gửi tin nhắn</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12">
                <div class="rounded">
                    <iframe class="rounded w-100" style="height: 450px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.5469984176198!2d106.78279807480604!3d10.855042689298537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527c3debb5aad%3A0x5fb58956eb4194d0!2zxJDhuqFpIEjhu41jIEh1dGVjaCBLaHUgRQ!5e1!3m2!1sen!2s!4v1759540416698!5m2!1sen!2s"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact End -->
@include('clients.blocks.footer')
