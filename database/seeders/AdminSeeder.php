<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kiểm tra xem đã có admin chưa
        $adminExist = DB::table('tbl_user')->where('role', 'a')->exists();

        if (!$adminExist) {
            DB::table('tbl_user')->insert([
                'userName' => 'admin',
                'passWord' => Hash::make('admin123'),
                'email' => 'admin@travela.com',
                'isActive' => 'y',
                'role' => 'a',
                'fullName' => 'System Administrator'
            ]);
        }
    }
}
