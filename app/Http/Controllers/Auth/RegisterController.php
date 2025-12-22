<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'userName' => 'required|string|max:50|unique:tbl_user,userName',
            'email' => 'required|string|email|max:255|unique:tbl_user,email',
            'passWord' => 'required|string|min:6|confirmed',
            'phoneNumber' => 'nullable|string|max:15',
        ]);

        User::create([
            'userName' => $request->userName,
            'email' => $request->email,
            'passWord' => Hash::make($request->passWord), // Mã hóa mật khẩu
            'phoneNumber' => $request->phoneNumber,
            'address' => $request->address,
            'ipAdress' => $request->ip(),
            'isActive' => 'y', // Mặc định kích hoạt
            'isStatus' => null,
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công. Mời bạn đăng nhập!');
    }
}