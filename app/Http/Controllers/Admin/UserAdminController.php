<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = DB::table('tbl_user')->orderBy('userId', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'userName' => 'required|unique:tbl_user,userName',
            'email' => 'required|email',
            'passWord' => 'required|min:6',
            'fullName' => 'required',
        ]);

        DB::table('tbl_user')->insert([
            'userName' => $request->userName,
            'email' => $request->email,
            'passWord' => Hash::make($request->passWord),
            'fullName' => $request->fullName,
            'role' => $request->role ?? 'c',
            'isActive' => $request->isActive ?? 'y',
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Thêm tài khoản thành công!');
    }

    public function edit($id)
    {
        $user = DB::table('tbl_user')->where('userId', $id)->first();
        if (!$user) return abort(404);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'fullName' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'fullName' => $request->fullName,
            'role' => $request->role ?? 'c',
            'isActive' => $request->isActive ?? 'y',
        ];

        // Chỉ cập nhật mật khẩu nếu nhập mới
        if ($request->filled('passWord')) {
            $data['passWord'] = Hash::make($request->passWord);
        }

        DB::table('tbl_user')->where('userId', $id)->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật tài khoản thành công!');
    }

    public function destroy($id)
    {
        // Không cho xóa chính mình (admin đang đăng nhập)
        $user = DB::table('tbl_user')->where('userId', $id)->first();
        if ($user && $user->role === 'a') {
            $adminCount = DB::table('tbl_user')->where('role', 'a')->count();
            if ($adminCount <= 1) {
                return redirect()->route('admin.users.index')->with('error', 'Không thể xóa tài khoản Admin duy nhất!');
            }
        }

        DB::table('tbl_user')->where('userId', $id)->delete();
        return redirect()->route('admin.users.index')->with('success', 'Xóa tài khoản thành công!');
    }
}
