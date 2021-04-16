<?php

namespace Source\App;

use Source\Models\User;

class WebController {
    public function __construct() {
        
    }
    
    public function home() {
        if (! auth()->check())
            return redirect('/login');
        
        echo view()->render("home", [
            "title" => "Home",
            "users" => (new User())->find()->fetch(true) ?? []
        ]);
    }

    public function error($data) {
        $error_code = $data["error_code"];
        
        echo view()->render("error", [
            "title" => "Error $error_code",
            "error_code" => $error_code
        ]);
    }
}