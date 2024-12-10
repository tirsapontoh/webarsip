<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password'];

    public function login($username, $password)
    {
        return $this->where('username', $username)
            ->where('password', md5($password)) // pastikan password dienkripsi dengan aman
            ->first();
    }
}
