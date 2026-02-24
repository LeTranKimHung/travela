@include('clients.blocks.header')

<!-- Font Icon -->
<link rel="stylesheet" href="{{ asset('clients/css/css-login/fonts/material-icon/css/material-design-iconic-font.min.css') }}">
<!-- Main css -->
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

        <!-- Sign In Form -->
        <section class="sign-in" id="signin-section" style="{{ isset($showRegister) && $showRegister ? 'display: none;' : '' }}">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure>
                            <img src="{{ asset('clients/img/login/signin-image.jpg') }}" alt="sign in image">
                        </figure>
                        <a href="javascript:void(0)" class="signup-image-link" onclick="toggleAuth('signup')">Chưa có tài khoản? <span style="color: #13357b; font-weight: 700;">Đăng ký ngay</span></a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Đăng nhập</h2>
                        <form action="{{ route('user-login') }}" method="POST" class="login-form" id="login-form">
                            @csrf
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="username" placeholder="Tên đăng nhập" value="{{ old('username') }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Mật khẩu" required/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Đăng nhập" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sign Up Form -->
        <section class="signup" id="signup-section" style="{{ isset($showRegister) && $showRegister ? '' : 'display: none;' }}">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Đăng ký</h2>
                        <form action="{{ route('register') }}" method="POST" class="register-form" id="register-form">
                            @csrf
                            <div class="form-group">
                                <label for="username_regis"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username_regis" id="username_regis" placeholder="Tên tài khoản" value="{{ old('username_regis') }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="password_regis"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password_regis" id="password_regis" placeholder="Mật khẩu" required/>
                            </div>
                            <div class="form-group">
                                <label for="re_pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Nhập lại mật khẩu" required/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Đăng ký" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure>
                            <img src="{{ asset('clients/img/login/signup-image.jpg') }}" alt="sign up image">
                        </figure>
                        <a href="javascript:void(0)" class="signup-image-link" onclick="toggleAuth('signin')">Đã có tài khoản? <span style="color: #13357b; font-weight: 700;">Đăng nhập</span></a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
function toggleAuth(type) {
    const signIn = document.getElementById('signin-section');
    const signUp = document.getElementById('signup-section');
    
    if(type === 'signup') {
        signIn.style.opacity = '0';
        setTimeout(() => {
            signIn.style.display = 'none';
            signUp.style.display = 'block';
            signUp.style.opacity = '1';
        }, 300);
    } else {
        signUp.style.opacity = '0';
        setTimeout(() => {
            signUp.style.display = 'none';
            signIn.style.display = 'block';
            signIn.style.opacity = '1';
        }, 300);
    }
}
</script>

<style>
#signin-section, #signup-section {
    transition: opacity 0.3s ease;
}
.main-content {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>

@include('clients.blocks.footer')