<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginAction()
    {
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->login($username, $password);

        if ($user) {
            session()->set('loggedIn', true);
            return redirect()->to('/admin');
        } else {
            return redirect()->to('/login')->with('error', 'Username or password incorrect');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
