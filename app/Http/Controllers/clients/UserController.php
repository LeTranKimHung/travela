<?php
namespace App\Http\Controllers\clients;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Hiển thị trang hồ sơ
    public function profile()
    {
        $user = Auth::user();
        $title = "Thông tin cá nhân";
        return view('clients.user.profile', compact('user', 'title'));
    }

    // Xử lý cập nhật thông tin
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email|unique:tbl_user,email,' . $user->userId . ',userId',
            'phoneNumber' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        // Cập nhật thông tin cơ bản
        $user->email = $request->email;
        $user->phoneNumber = $request->phoneNumber;
        $user->address = $request->address;

        // Xử lý đổi mật khẩu nếu có nhập
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->passWord)) {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác.']);
            }
            $user->passWord = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }
}