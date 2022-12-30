<?php
/** @var object $router */
/** @var object $middleware */

$router->get('/staff/new', function () use ($middleware) {
    $middleware->authenticateUser();
    require_once('controllers/staff/new.php');
});

$router->post('/staff/new', function ($params) use ($middleware) {
    $middleware->authenticateUser();
    require_once('controllers/staff/new.php');
});

$router->post('/staff/delete', function ($params) use ($middleware) {
    $middleware->authenticateUser();
    require_once('controllers/staff/delete.php');
});