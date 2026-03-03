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
                    <div class="signin-form" style="width: 100%; max-width: 500px; margin: 0 auto; display: block;">
                        <h2 class="form-title">Tạo Mật Khẩu Mới</h2>
                        <form action="{{ route('password.update') }}" method="POST" class="login-form">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" value="{{ $email ?? old('email') }}" required readonly style="background-color: #f5f5f5;"/>
                            </div>

                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Mật khẩu mới (ít nhất 8 ký tự)" required/>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Nhập lại mật khẩu mới" required/>
                            </div>

                            <div class="form-group form-button">
                                <input type="submit" class="form-submit" value="Lưu mật khẩu mới" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@include('clients.blocks.footer')
