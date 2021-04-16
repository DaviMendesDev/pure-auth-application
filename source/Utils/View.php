<?php

namespace Source\Utils;

use League\Plates\Engine;

class View {
    private static ?Engine $instance = null;

    public static function getInstance(): Engine {
        if (! self::$instance)
            return self::$instance = Engine::create(__DIR__ . "/../../resources/views", "php");
        
        return self::$instance;
    }
}