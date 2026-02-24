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
