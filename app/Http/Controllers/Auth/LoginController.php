<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'userName' => 'required',
            'passWord' => 'required',
        ]);

        $credentials = [
            'userName' => $request->userName,
            'password' => $request->passWord, // Laravel Auth tự hiểu 'password' là giá trị để check
        ];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->isStatus == 'b') {
                Auth::logout();
                return back()->withErrors(['userName' => 'Tài khoản đang bị khóa.']);
            }

            return (Auth::user()->role == 'a') 
                ? redirect()->route('admin.dashboard') 
                : redirect()->route('home');
        }

        return back()->withErrors(['userName' => 'Sai tên đăng nhập hoặc mật khẩu.'])->withInput();
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}