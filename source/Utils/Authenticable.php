<?php

namespace Source\Utils;

use Source\Models\Model;
use Source\Models\User;

class Authenticable {
    private ?Model $currentUser = null;
    private static ?self $instance = null;

    public static function getInstance(): self {
        if (! self::$instance)
            return self::$instance = new self;
        
        return self::$instance;
    }

    public function user (): ?User {
        return (new User())->findById(session()->get('user_id'));
    }

    public function check () {
        return session()->get('user_id') && $this->user();
    }

    public function logout () {
        session_unset();
        $this->currentUser = null;
    }

    public function attempt (string $email, string $password): bool {
        if ($this->check())
            return false;
        
        $user = (new User())->find("email = :e", "e=$email")->fetch();

        if (! $user)
            return false;
        
        if (! password_verify($password, $user->password))
            return false;

        return $this->saveUserOnSession($user);
    }

    public function saveUserOnSession(User $currentUser): bool {
        $this->currentUser = $currentUser;
        session()->set('user_id', $this->currentUser->id);
        return true;
    }

    public function __get($name)
    {
        if ($this->check())
            return $this->user()[$name];
        
        return null;
    }
}