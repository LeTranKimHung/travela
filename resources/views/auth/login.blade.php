<form action="{{ route('login') }}" method="POST">
    @csrf
    <input type="text" name="userName" placeholder="Tên đăng nhập" required>
    <input type="password" name="passWord" placeholder="Mật khẩu" required>
    <button type="submit">Đăng nhập</button>
</form>