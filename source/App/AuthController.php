<?php

namespace Source\App;

use Source\Models\User;

class AuthController {
    public function __construct () {

    }

    public function showLoginForm () {
        if (auth()->check())
            return redirect('/home');
        
        echo view()->render('login', [ "title" => "Login" ]);
        return;
    }

    public function showRegisterForm () {
        if (auth()->check())
            return redirect('/home');

        echo view()->render('register', [ "title" => "Register" ]);
        return;
    }

    public function view () {
        if (! auth()->check())
            return redirect('/login');
        
        echo view()->render('view', [ 'title' => auth()->user()->fullName . ' - Perfil' ]);
    }

    public function showEditForm () {
        echo "<h1>Edit User Data</h1>";
    }

    public function login ($data) {
        $email = $data['email'];
        $password = $data['password'];

        if (auth()->attempt($email, $password)) {
            return redirect('/home');
        }

        session()->set('failed_login', 'Email/Password incorrect');
        return redirect('/login');
    }

    public function register ($data) {
        if ($message = User::validate($data)) {
            session()->set('failed_register', $message);
            return redirect('/register');
        }
        
        $newUser = new User();
        $newUser->first_name = $data['first_name'];
        $newUser->last_name = $data['last_name'];
        $newUser->email = $data['email'];
        $newUser->password = $data['password'];
        $newUser->hashPassword();

        try {
            $newUser->save();
            
            if ($newUser->fail())
                throw $newUser->fail();

            session()->put([
                'message' => 'User successfuly registered!',
                'type' => 'success'
            ]);
            return redirect('/login');
        } catch (\Exception $e) {
            session()->set('failed_register', $e->getMessage());
            return redirect('/register');
        }
    }

    public function logout ($data) {
        if (! auth()->check())
            return redirect('/login');

        auth()->logout();
        return redirect('/login');
    }

    public function edit ($data) {
        $user = auth()->user();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];

        try {
            if ($message = $user->validateBeforeSave()) {
                session()->set('failed_edit', $message);
                return redirect('/view');
            }
            $user->save();

            return redirect('/view');
        } catch (\Exception $e) {
            session()->set('message', $e->getMessage());
            session()->set('type', 'error');
            return redirect('/view');
        }
    }
}