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
        'userName', 
        'passWord', 
        'email', 
        'phoneNumber', 
        'address', 
        'isStatus', 
        'role'
    ];

    protected $hidden = [
        'passWord', 
        'remember_token',
    ];

    // Laravel cần biết cột password
    public function getAuthPassword()
    {
        return $this->passWord;
    }

    // Tự động hash password khi set (tùy chọn)
    public function setPassWordAttribute($value)
    {
        // Chỉ hash nếu chưa được hash
        if (!password_get_info($value)['algo']) {
            $this->attributes['passWord'] = bcrypt($value);
        } else {
            $this->attributes['passWord'] = $value;
        }
    }
}