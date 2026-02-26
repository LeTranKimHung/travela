<?php

namespace App\Http\Controllers\clients;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\clients\Login;
use App\Models\clients\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    private $login;
    protected $user;

    public function __construct()
    {
        $this->login = new Login();
        $this->user = new User();
    }
    
    public function index()
    {
        $title = 'Đăng nhập';
        return view('clients.error.login', compact('title'));
    }

    public function showRegisterForm()
    {
        $title = 'Đăng ký';
        $showRegister = true;
        return view('clients.error.login', compact('title', 'showRegister'));
    }

    public function register(Request $request)
    {
        // Validation đầy đủ với thông báo tiếng Việt
        $request->validate([
            'username_regis' => [
                'required',
                'min:3',
                'max:30',
                'alpha_num',
                'unique:tbl_user,userName',
            ],
            'fullName' => [
                'required',
                'min:2',
                'max:100',
                'regex:/^[\p{L}\s]+$/u',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:tbl_user,email',
            ],
            'password_regis' => [
                'required',
                'min:8',
                'max:64',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            're_pass' => [
                'required',
                'same:password_regis',
            ],
            'agree' => ['accepted'],
        ], [
            'username_regis.required'   => 'Vui lòng nhập tên đăng nhập.',
            'username_regis.min'        => 'Tên đăng nhập tối thiểu 3 ký tự.',
            'username_regis.max'        => 'Tên đăng nhập tối đa 30 ký tự.',
            'username_regis.alpha_num'  => 'Tên đăng nhập chỉ được chứa chữ cái và số (không có dấu, khoảng trắng).',
            'username_regis.unique'     => 'Tên đăng nhập này đã được sử dụng.',
            'fullName.required'         => 'Vui lòng nhập họ và tên.',
            'fullName.min'              => 'Họ và tên tối thiểu 2 ký tự.',
            'fullName.regex'            => 'Họ và tên chỉ được chứa chữ cái và khoảng trắng.',
            'email.required'            => 'Vui lòng nhập email.',
            'email.email'               => 'Email không đúng định dạng.',
            'email.unique'              => 'Email này đã được đăng ký.',
            'password_regis.required'   => 'Vui lòng nhập mật khẩu.',
            'password_regis.min'        => 'Mật khẩu tối thiểu 8 ký tự.',
            'password_regis.max'        => 'Mật khẩu tối đa 64 ký tự.',
            'password_regis.regex'      => 'Mật khẩu phải có ít nhất 1 chữ hoa, 1 chữ thường và 1 số.',
            're_pass.required'          => 'Vui lòng xác nhận mật khẩu.',
            're_pass.same'              => 'Xác nhận mật khẩu không khớp.',
            'agree.accepted'            => 'Bạn phải đồng ý với điều khoản sử dụng.',
        ]);

        $username_regis = $request->username_regis;
        $email          = $request->email;
        $fullName       = $request->fullName;
        $password_regis = $request->password_regis;

        $activation_token = Str::random(60);
        $dataInsert = [
            'userName'         => $username_regis,
            'fullName'         => $fullName,
            'email'            => $email,
            'passWord'         => Hash::make($password_regis),
            'activation_token' => $activation_token,
            'isActive'         => 'n',
        ];

        $this->login->registerAcount($dataInsert);

        try {
            $this->sendActivationEmail($email, $activation_token);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gửi email kích hoạt thất bại: ' . $e->getMessage());
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.',
            ]);
        }
        return redirect()->route('login')
            ->with('message', 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.');
    }

    public function sendActivationEmail($email, $token)
    {
        $activation_link = route('activate.account', ['token' => $token]);
        Mail::send('clients.mail.emails_activation', ['link' => $activation_link], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Kích hoạt tài khoản của bạn');
        });
    }

    public function activateAccount($token)
    {
        $user = $this->login->getUserByToken($token);
        if ($user) {
            $this->login->activateUserAccount($token);
            return redirect()->route('login')->with('message', 'Tài khoản của bạn đã được kích hoạt!');
        } else {
            return redirect()->route('login')->with('error', 'Mã kích hoạt không hợp lệ!');
        }
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $user = $this->login->getUserByUsername($username);

        if ($user && Hash::check($password, $user->passWord)) {
            if ($user->isActive !== 'y') {
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => 'Tài khoản chưa được kích hoạt!']);
                }
                return back()->with('error', 'Tài khoản chưa được kích hoạt!')->withInput();
            }

            $request->session()->put('username', $user->userName);
            $request->session()->put('avatar', $user->avatar);
            $request->session()->put('userId', $user->userId);
            
            // Thiết lập session admin nếu role là 'a'
            if ($user->role === 'a') {
                $request->session()->put('admin', true);
            }
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Đăng nhập thành công!',
                    'redirectUrl' => route('home'),
                ]);
            }
            return redirect()->route('home');
        } else {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Thông tin tài khoản hoặc mật khẩu không chính xác!']);
            }
            return back()->with('error', 'Thông tin tài khoản hoặc mật khẩu không chính xác!')->withInput();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush(); 
        return redirect()->route('home');
    }
}