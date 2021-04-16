<?php

session_start();

use CoffeeCode\Router\Router as RouterInstance;
use League\Plates\Engine;
use Source\Utils\Authenticable;
use Source\Utils\Router;
use Source\Utils\Session;
use Source\Utils\View;

define('DATA_LAYER_CONFIG', [
    'driver' => 'pgsql',
    'host' => 'localhost',
    'port' => '5432',
    'dbname' => 'auth_app',
    'username' => 'postgres',
    'passwd' => 'admin123',
    'options' => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

define('APP', [
    'url_base' => 'http://localhost/pure-auth-application',
    'port' => '80',
    'name' => 'Auth Application'
]);

function app (string $app_property) {
    return APP[$app_property];
}

function url (string $uri = null): string {
    if ($uri) {
        return app('url_base') . $uri;
    }

    return app('url_base');
}

function router (): RouterInstance {
    return Router::getInstance();
}

function redirect (string $uri, array $data = null) {
    return router()->redirect($uri, $data);
}

function view (): Engine {
    return View::getInstance();
}

function auth (): Authenticable {
    return Authenticable::getInstance();
}

function session () {
    session_start();
    return Session::getInstance();
}