<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    private function ensureTokenTableExists()
    {
        if (!Schema::hasTable('password_reset_tokens')) {
            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }
    }

    public function showLinkRequestForm()
    {
        return view('clients.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:tbl_user,email',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.exists' => 'Email không tồn tại trong hệ thống.',
        ]);

        $this->ensureTokenTableExists();

        $token = Str::random(60);
        $email = $request->email;

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => $token, 'created_at' => now()]
        );

        $reset_link = route('password.reset', ['token' => $token]) . '?email=' . urlencode($email);

        try {
            Mail::send('clients.mail.password_reset', ['link' => $reset_link], function ($message) use ($email) {
                $message->to($email);
                $message->subject('Khôi phục mật khẩu của bạn - Travela');
            });
            return back()->with('message', 'Chúng tôi đã gửi link khôi phục mật khẩu vào email của bạn!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Send reset password email failed: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi gửi email, vui lòng thử lại sau.');
        }
    }

    public function showResetForm(Request $request, $token)
    {
        return view('clients.auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:tbl_user,email',
            'password' => 'required|min:8|max:64|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'password_confirmation' => 'required|same:password',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.exists' => 'Email không tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự.',
            'password.regex' => 'Mật khẩu phải có ít nhất 1 chữ hoa, 1 chữ thường và 1 số.',
            'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu.',
            'password_confirmation.same' => 'Mật khẩu xác nhận không khớp.',
        ]);

        $this->ensureTokenTableExists();

        $tokenRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$tokenRecord) {
            return back()->with('error', 'Token không hợp lệ hoặc đã hết hạn.');
        }

        DB::table('tbl_user')
            ->where('email', $request->email)
            ->update([
                'passWord' => Hash::make($request->password)
            ]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('message', 'Mật khẩu của bạn đã được thay đổi thành công!');
    }
}
