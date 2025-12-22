<form action="{{ route('register') }}" method="POST">
    @csrf
    <input type="text" name="userName" placeholder="Tên đăng nhập" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="phoneNumber" placeholder="Số điện thoại">
    <input type="password" name="passWord" placeholder="Mật khẩu" required>
    <input type="password" name="passWord_confirmation" placeholder="Xác nhận mật khẩu" required>
    <button type="submit">Đăng ký</button>
</form>