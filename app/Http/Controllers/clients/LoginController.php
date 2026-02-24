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
        // Validation cơ bản
        $request->validate([
            'username_regis' => 'required|min:3',
            'email' => 'required|email',
            'password_regis' => 'required|min:6',
            're_pass' => 'required|same:password_regis'
        ]);

        $username_regis = $request->username_regis;
        $email = $request->email;
        $password_regis = $request->password_regis;

        $checkAccountExist = $this->login->checkUserExist($username_regis, $email);
        if ($checkAccountExist) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Tên người dùng hoặc email đã tồn tại!']);
            }
            return back()->with('error', 'Tên người dùng hoặc email đã tồn tại!')->withInput();
        }

        $activation_token = Str::random(60);
        $dataInsert = [
            'userName'         => $username_regis,
            'email'            => $email,
            'passWord'         => Hash::make($password_regis),
            'activation_token' => $activation_token,
            'isActive'         => 'n'
        ];

        $this->login->registerAcount($dataInsert);
        
        try {
            $this->sendActivationEmail($email, $activation_token);
        } catch (\Exception $e) {
            // Log lỗi nếu không gửi được mail nhưng vẫn cho qua hoặc báo lỗi tùy project
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.'
            ]);
        }
        return redirect()->route('login')->with('message', 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt.');
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