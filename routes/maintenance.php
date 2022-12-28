<?php
/** @var object $router */
/** @var object $middleware */

$router->get('/maintenance/new', function () use ($middleware) {
    $middleware->authenticateUser();
    require_once('controllers/maintenance/new.php');
});

$router->post('/maintenance/new', function ($params) use ($middleware) {
    $middleware->authenticateUser();
    require_once('controllers/maintenance/new.php');
});
