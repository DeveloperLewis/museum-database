<?php
/** @var object $router */
/** @var object $middleware */

$router->get('/inventory/new', function () use ($middleware) {
    $middleware->authenticateUser();
    require_once('controllers/admin/transactions.php');
});

$router->post('/inventory/new', function ($params) use ($middleware) {
    $middleware->authenticateUser();
    require_once('controllers/admin/transactions.php');
});

$router->post('/inventory/delete', function ($params) use ($middleware) {
    $middleware->authenticateUser();
    require_once('controllers/inventory/delete.php');
});
