<?php

namespace Source\Utils;

use CoffeeCode\Router\Router as RouterInstance;

class Router {
    private static ?RouterInstance $instance = null;

    public static function getInstance(): RouterInstance {
        if (! self::$instance)
            return self::$instance = new RouterInstance(url());
        
        return self::$instance;
    }
}