<?php
/** @var object $router */
/** @var object $middleware */

$router->get('/user/login', function (){
    if (isLoggedIn()) {
        redirect("/");
    }
    require_once('controllers/user/login.php');
});

$router->post('/user/login', function () {
    if (isLoggedIn()) {
        redirect("/");
    }
    require_once('controllers/user/login.php');
});

$router->get('/user/logout', function () use ($middleware) {
    $middleware->authenticateUser();
    require_once('controllers/user/logout.php');
});
