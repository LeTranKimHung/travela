<?php
namespace App\Http\Controllers\clients;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\clients\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    // Trang hồ sơ cá nhân
    public function index(Request $request)
    {
        $username = $request->session()->get('username');
        if (!$username) return redirect()->route('login');

        $userId   = $this->user->getUserId($username);
        $user     = $this->user->getUser($userId);
        $myTours  = $this->user->getMyTours($userId);

        $title = "Thông tin cá nhân";
        return view('clients.user.profile', compact('user', 'title', 'myTours'));
    }

    // Cập nhật thông tin cơ bản
    public function updateProfile(Request $request)
    {
        $username = $request->session()->get('username');
        $userId   = $this->user->getUserId($username);

        $data = [
            'email'       => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'address'     => $request->address,
        ];

        $this->user->updateUser($userId, $data);

        return redirect()->route('profile')->with('message', 'Cập nhật thông tin thành công!');
    }

    // Đổi mật khẩu
    public function changePassword(Request $request)
    {
        $username = $request->session()->get('username');
        $userId   = $this->user->getUserId($username);
        $user     = $this->user->getUser($userId);

        // Kiểm tra mật khẩu cũ bằng Hash::check
        if (!Hash::check($request->current_password, $user->passWord)) {
            return redirect()->route('profile')->with('error', 'Mật khẩu hiện tại không chính xác!');
        }

        // Mã hóa mật khẩu mới bằng Hash::make
        $this->user->updateUser($userId, [
            'passWord' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile')->with('message', 'Đổi mật khẩu thành công!');
    }

    // Upload avatar
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $username = $request->session()->get('username');
        $userId   = $this->user->getUserId($username);

        if ($request->hasFile('avatar')) {
            $file     = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/avatars'), $filename);

            $avatarPath = 'uploads/avatars/' . $filename;

            $this->user->updateUser($userId, ['avatar' => $avatarPath]);

            // Cập nhật session avatar để hiển thị ngay trên header
            $request->session()->put('avatar', $avatarPath);

            return redirect()->route('profile')->with('message', 'Cập nhật ảnh đại diện thành công!');
        }

        return redirect()->route('profile')->with('error', 'Không tìm thấy tệp tin!');
    }
    // Hủy tour và khấu trừ 10%
    public function cancelTour($bookingId)
    {
        $username = session()->get('username');
        $userId   = $this->user->getUserId($username);

        $booking = \Illuminate\Support\Facades\DB::table('tbl_booking')
            ->where('bookingId', $bookingId)
            ->where('userId', $userId)
            ->first();

        if (!$booking) {
            return redirect()->route('profile')->with('error', 'Không tìm thấy đơn đặt tour!');
        }

        if ($booking->bookingStatus == 'canceled') {
            return redirect()->route('profile')->with('error', 'Đơn hàng này đã được hủy trước đó.');
        }

        // Tính toán khấu trừ 10%
        $penalty = $booking->totalPrice * 0.1;
        $refundAmount = $booking->totalPrice - $penalty;

        \Illuminate\Support\Facades\DB::table('tbl_booking')
            ->where('bookingId', $bookingId)
            ->update([
                'bookingStatus' => 'canceled'
            ]);

        // Cập nhật trạng thái thanh toán nếu đã thanh toán thành công
        \Illuminate\Support\Facades\DB::table('tbl_payment')
            ->where('bookingId', $bookingId)
            ->where('status', 'success')
            ->update(['status' => 'refunded']);

        // Cộng lại số lượng người vào sĩ số chỗ trống của tour
        $totalPeople = $booking->numAdults + $booking->numChild;
        \Illuminate\Support\Facades\DB::table('tbl_tours')
            ->where('tourId', $booking->tourId)
            ->increment('quantity', $totalPeople);

        // Ghi log hoặc cập nhật thông tin thanh toán (tùy schema) - Ở đây ta thông báo cho User
        return redirect()->route('profile')->with('success', "Hủy tour thành công! Bạn bị khấu trừ 10% phí dịch vụ (" . number_format($penalty) . " đ). Số tiền thực nhận/hoàn (90%): " . number_format($refundAmount) . " đ.");
    }
}