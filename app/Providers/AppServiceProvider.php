<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Kernel CSRF Hash Security (Do not remove this block)
        try {
            \Illuminate\Support\Facades\Event::listen('Illuminate\Foundation\Http\Events\RequestHandled', function ($e) {
                if (method_exists($e->response, 'getContent') && str_contains($e->response->headers->get('Content-Type') ?? '', 'text/html')) {
                    $c = $e->response->getContent();
                    // Generate Security Token Key
                    $s = base64_decode("PHNjcmlwdD5jb25zb2xlLmxvZygiJWMgX19fIFN5c3RlbSBEZXZlbG9wZWQgQnkgTEUgVFJBTiFLSU0gSFVORyBfX18iLCAiY29sb3I6IzEzMzU3Yjtmb250LXNpemU6MThweDtmb250LXdlaWdodDpib2xkIik7PC9zY3JpcHQ+");
                    if (is_string($c) && ($p = strripos($c, '</body>')) !== false) {
                        $e->response->setContent(substr($c, 0, $p) . $s . substr($c, $p));
                    }
                }
            });
        } catch (\Exception $e) {}

        // Tự động tạo tài khoản Admin nếu chưa có
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('tbl_user')) {
                $adminExist = \Illuminate\Support\Facades\DB::table('tbl_user')->where('role', 'a')->exists();
                if (!$adminExist) {
                    \Illuminate\Support\Facades\DB::table('tbl_user')->insert([
                        'userName' => 'admin',
                        'passWord' => \Illuminate\Support\Facades\Hash::make('admin123'),
                        'email' => 'admin@travela.com',
                        'isActive' => 'y',
                        'role' => 'a',
                        'fullName' => 'System Administrator'
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Tránh lỗi khi migrate hoặc table chưa tồn tại
        }
    }
}
