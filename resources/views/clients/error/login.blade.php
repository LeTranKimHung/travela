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
        <section class="signup" id="signup-section" style="{{ ($errors->any() || isset($showRegister) && $showRegister) ? '' : 'display: none;' }}">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Đăng ký</h2>
                        <form action="{{ route('register') }}" method="POST" class="register-form" id="register-form" novalidate>
                            @csrf

                            {{-- Họ và tên --}}
                            <div class="form-group {{ $errors->has('fullName') ? 'has-error' : '' }}">
                                <label for="fullName"><i class="zmdi zmdi-face material-icons-name"></i></label>
                                <input type="text" name="fullName" id="fullName"
                                    placeholder="Họ và tên"
                                    value="{{ old('fullName') }}"
                                    autocomplete="name">
                                @error('fullName')
                                    <span class="field-error"><i class="zmdi zmdi-alert-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Tên đăng nhập --}}
                            <div class="form-group {{ $errors->has('username_regis') ? 'has-error' : '' }}">
                                <label for="username_regis"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username_regis" id="username_regis"
                                    placeholder="Tên đăng nhập (không dấu, không khoảng trắng)"
                                    value="{{ old('username_regis') }}"
                                    autocomplete="username">
                                @error('username_regis')
                                    <span class="field-error"><i class="zmdi zmdi-alert-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email_regis"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email_regis"
                                    placeholder="Email"
                                    value="{{ old('email') }}"
                                    autocomplete="email">
                                @error('email')
                                    <span class="field-error"><i class="zmdi zmdi-alert-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Mật khẩu --}}
                            <div class="form-group {{ $errors->has('password_regis') ? 'has-error' : '' }}">
                                <label for="password_regis"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password_regis" id="password_regis"
                                    placeholder="Mật khẩu (ít nhất 8 ký tự)"
                                    autocomplete="new-password">
                                @error('password_regis')
                                    <span class="field-error"><i class="zmdi zmdi-alert-circle"></i> {{ $message }}</span>
                                @enderror
                                {{-- Strength Meter --}}
                                <div id="strength-bar-wrap" style="display:none; margin-top:6px;">
                                    <div style="height:4px; border-radius:4px; background:#e2e8f0; overflow:hidden;">
                                        <div id="strength-bar" style="height:100%; width:0; border-radius:4px; transition:all 0.3s;"></div>
                                    </div>
                                    <small id="strength-label" style="font-size:0.75rem; color:#64748b;"></small>
                                </div>
                                <small style="font-size:0.72rem; color:#94a3b8; margin-top:4px; display:block;">
                                    Gợi ý: ít nhất 8 ký tự, gồm chữ hoa, chữ thường và số
                                </small>
                            </div>

                            {{-- Xác nhận mật khẩu --}}
                            <div class="form-group {{ $errors->has('re_pass') ? 'has-error' : '' }}">
                                <label for="re_pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass"
                                    placeholder="Nhập lại mật khẩu"
                                    autocomplete="new-password">
                                @error('re_pass')
                                    <span class="field-error"><i class="zmdi zmdi-alert-circle"></i> {{ $message }}</span>
                                @enderror
                                <span id="match-msg" style="font-size:0.75rem; display:none; margin-top:4px;"></span>
                            </div>

                            {{-- Đồng ý điều khoản --}}
                            <div class="form-group {{ $errors->has('agree') ? 'has-error' : '' }}" style="display:flex; align-items:flex-start; gap:8px; padding:4px 0;">
                                <input type="checkbox" name="agree" id="agree" value="1" {{ old('agree') ? 'checked' : '' }}
                                    style="margin-top:3px; width:16px; height:16px; accent-color:#13357b; flex-shrink:0;">
                                <label for="agree" style="font-size:0.82rem; color:#475569; cursor:pointer; line-height:1.5; margin:0;">
                                    Tôi đã đọc và đồng ý với
                                    <a href="#" style="color:#13357b; font-weight:600; text-decoration:none;">Điều khoản sử dụng</a>
                                    và
                                    <a href="#" style="color:#13357b; font-weight:600; text-decoration:none;">Chính sách bảo mật</a>
                                    của Travela.
                                </label>
                                @error('agree')
                                    <span class="field-error" style="display:block; width:100%;"><i class="zmdi zmdi-alert-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group form-button" style="margin-top:12px;">
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
// ===== Toggle signin / signup =====
function toggleAuth(type) {
    const signIn = document.getElementById('signin-section');
    const signUp = document.getElementById('signup-section');
    if (type === 'signup') {
        signIn.style.opacity = '0';
        setTimeout(() => { signIn.style.display = 'none'; signUp.style.display = 'block'; signUp.style.opacity = '1'; }, 300);
    } else {
        signUp.style.opacity = '0';
        setTimeout(() => { signUp.style.display = 'none'; signIn.style.display = 'block'; signIn.style.opacity = '1'; }, 300);
    }
}

// ===== Password strength meter =====
const passInput   = document.getElementById('password_regis');
const strengthBar = document.getElementById('strength-bar');
const strengthLbl = document.getElementById('strength-label');
const barWrap     = document.getElementById('strength-bar-wrap');

function calcStrength(pass) {
    let score = 0;
    if (pass.length >= 8)  score++;
    if (pass.length >= 12) score++;
    if (/[A-Z]/.test(pass)) score++;
    if (/[a-z]/.test(pass)) score++;
    if (/[0-9]/.test(pass)) score++;
    if (/[^A-Za-z0-9]/.test(pass)) score++;
    return score;
}

if (passInput) {
    passInput.addEventListener('input', function () {
        const val = this.value;
        if (!val) { barWrap.style.display = 'none'; return; }
        barWrap.style.display = 'block';
        const score = calcStrength(val);
        const levels = [
            { pct: '20%',  color: '#ef4444', label: '⚠ Rất yếu'  },
            { pct: '35%',  color: '#f97316', label: '⚠ Yếu'      },
            { pct: '55%',  color: '#eab308', label: '◑ Trung bình'},
            { pct: '75%',  color: '#22c55e', label: '✓ Mạnh'      },
            { pct: '90%',  color: '#10b981', label: '✓ Rất mạnh'  },
            { pct: '100%', color: '#0ea5e9', label: '✓✓ Tuyệt vời'},
        ];
        const lvl = levels[Math.min(score, 5)];
        strengthBar.style.width      = lvl.pct;
        strengthBar.style.background = lvl.color;
        strengthLbl.textContent      = lvl.label;
        strengthLbl.style.color      = lvl.color;
        checkMatch();
    });
}

// ===== Confirm password live check =====
const rePassInput = document.getElementById('re_pass');
const matchMsg    = document.getElementById('match-msg');
function checkMatch() {
    if (!rePassInput || !matchMsg || !rePassInput.value) return;
    if (rePassInput.value === passInput.value) {
        matchMsg.style.display = 'block'; matchMsg.style.color = '#10b981'; matchMsg.textContent = '✓ Mật khẩu khớp';
    } else {
        matchMsg.style.display = 'block'; matchMsg.style.color = '#ef4444'; matchMsg.textContent = '✗ Mật khẩu không khớp';
    }
}
if (rePassInput) { rePassInput.addEventListener('input', checkMatch); }

// ===== Username: chỉ cho phép [A-Za-z0-9] =====
const userInput = document.getElementById('username_regis');
if (userInput) {
    userInput.addEventListener('input', function () {
        this.value = this.value.replace(/[^A-Za-z0-9]/g, '');
    });
}

// ===== Client-side validation before submit =====
const registerForm = document.getElementById('register-form');
if (registerForm) {
    registerForm.addEventListener('submit', function (e) {
        let valid = true;
        const errors = [];
        const fullName = document.getElementById('fullName');
        const username = document.getElementById('username_regis');
        const email    = document.getElementById('email_regis');
        const pass     = document.getElementById('password_regis');
        const rpass    = document.getElementById('re_pass');
        const agree    = document.getElementById('agree');

        if (!fullName.value.trim() || fullName.value.trim().length < 2) {
            errors.push('Vui lòng nhập họ và tên (tối thiểu 2 ký tự).'); valid = false;
        }
        if (!username.value.trim() || username.value.trim().length < 3) {
            errors.push('Tên đăng nhập tối thiểu 3 ký tự.'); valid = false;
        }
        if (!email.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            errors.push('Email không đúng định dạng.'); valid = false;
        }
        if (!pass.value || pass.value.length < 8) {
            errors.push('Mật khẩu tối thiểu 8 ký tự.'); valid = false;
        } else if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(pass.value)) {
            errors.push('Mật khẩu phải có ít nhất 1 chữ hoa, 1 chữ thường và 1 số.'); valid = false;
        }
        if (rpass.value !== pass.value) {
            errors.push('Xác nhận mật khẩu không khớp.'); valid = false;
        }
        if (!agree.checked) {
            errors.push('Bạn phải đồng ý với điều khoản sử dụng.'); valid = false;
        }

        if (!valid) {
            e.preventDefault();
            const existing = document.getElementById('client-error-box');
            if (existing) existing.remove();
            const box = document.createElement('div');
            box.id = 'client-error-box';
            box.style.cssText = 'background:#fef2f2; border:1px solid #fca5a5; border-radius:10px; padding:12px 16px; margin-bottom:16px; font-size:0.85rem;';
            box.innerHTML = '<ul style="margin:0; padding-left:18px; color:#b91c1c;">' + errors.map(err => `<li>${err}</li>`).join('') + '</ul>';
            registerForm.prepend(box);
            registerForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
}
</script>

<style>
#signin-section, #signup-section { transition: opacity 0.3s ease; }
.main-content { width: 100%; display: flex; flex-direction: column; align-items: center; }

.field-error {
    display: block;
    font-size: 0.78rem;
    color: #dc2626;
    margin-top: 5px;
    padding-left: 2px;
    animation: slideIn 0.2s ease;
}
@keyframes slideIn { from { opacity:0; transform:translateY(-4px); } to { opacity:1; transform:translateY(0); } }

.has-error input[type="text"],
.has-error input[type="email"],
.has-error input[type="password"] {
    border-bottom: 2px solid #ef4444 !important;
}
.has-error label i { color: #ef4444 !important; }
</style>

@include('clients.blocks.footer')