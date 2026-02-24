<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Login extends Model
{
    use HasFactory;

    protected $table = 'tbl_user';
    protected $primaryKey = 'userId';
    public $timestamps = false;

    public function registerAcount($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }

    public function checkUserExist($username, $email)
    {
        return DB::table($this->table)
            ->where('userName', $username)
            ->orWhere('email', $email)
            ->exists();
    }

    public function getUserByToken($token)
    {
        return DB::table($this->table)
            ->where('activation_token', $token)
            ->first();
    }

    public function activateUserAccount($token)
    {
        return DB::table($this->table)
            ->where('activation_token', $token)
            ->update([
                'activation_token' => null, 
                'isActive' => 'y'
            ]);
    }

    public function getUserByUsername($username)
    {
        return DB::table($this->table)
            ->where('userName', $username)
            ->first();
    }
}