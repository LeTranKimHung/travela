<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_user';
    protected $primaryKey = 'userId';
    public $timestamps = false;

    protected $fillable = [
        'userName', 'passWord', 'email', 'phoneNumber', 'address', 'isStatus', 'role'
    ];

    protected $hidden = [
        'passWord', 'remember_token',
    ];

    // Bắt buộc: Laravel cần biết cột mật khẩu tên là gì trong DB
    public function getAuthPassword()
    {
        return $this->passWord;
    }
}