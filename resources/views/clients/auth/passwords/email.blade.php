@include('clients.blocks.header')
<link rel="stylesheet" href="{{ asset('clients/css/css-login/fonts/material-icon/css/material-design-iconic-font.min.css') }}">
<link rel="stylesheet" href="{{ asset('clients/css/css-login/style.css') }}">

<div class="login-template">
    <div class="main-content">
        <!-- Notification Area -->
        <div style="margin-bottom: 20px;">
            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="zmdi zmdi-alert-circle me-2"></i> {{ session('error') }}
                </div>
            @endif
            @if(session('message'))
                <div class="alert alert-success">
                    <i class="zmdi zmdi-check-circle me-2"></i> {{ session('message') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ asset('clients/img/login/signin-image.jpg') }}" alt="sign in image"></figure>
                        <a href="{{ route('login') }}" class="signup-image-link" style="color: #13357b; font-weight: 700;">Đã nhớ mật khẩu? Đăng nhập ngay</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Quên Mật Khẩu</h2>
                        <form action="{{ route('password.email') }}" method="POST" class="login-form">
                            @csrf
                            <p style="margin-bottom: 20px; font-size: 0.9rem; color: #555;">Vui lòng nhập địa chỉ email của bạn. Chúng tôi sẽ gửi một liên kết để tạo lại mật khẩu.</p>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Email của bạn" value="{{ old('email') }}" required/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" class="form-submit" value="Gửi liên kết" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@include('clients.blocks.footer')
