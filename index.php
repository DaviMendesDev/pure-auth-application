<?php

use CoffeeCode\DataLayer\Connect;
use League\Plates\Engine;

require __DIR__ . '/vendor/autoload.php';

$router = router();
$conn = Connect::getInstance();
$error = Connect::getError();

if ($error) {
    dump($error);
    die();
}

$router->group(null);
$router->namespace("Source\App");

$router->get('/', function ($data) use ($router) {
    return $router->redirect('/home');
});
$router->get('/home', 'WebController:home');
$router->get('/login', 'AuthController:showLoginForm');
$router->get('/register', 'AuthController:showRegisterForm');
$router->get('/view', 'AuthController:view');
$router->get('/edit', 'AuthController:showEditForm');

$router->post('/login', 'AuthController:login');
$router->post('/register', 'AuthController:register');
$router->post('/logout', 'AuthController:logout');
$router->post('/edit', 'AuthController:edit');


$router->get('/ooops/{error_code}', 'WebController:error');

$router->dispatch();

if ($router->error()) {
    return $router->redirect("/ooops/{$router->error()}");
}