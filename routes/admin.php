<?php
/** @var object $router */
/** @var object $middleware */

$router->get('/transactions', function () use ($middleware) {
    $middleware->authenticateUser();
    require_once('controllers/admin/transactions.php');
});

$router->get('/inventory', function () use ($middleware) {
    $middleware->authenticateUser();
    require_once('controllers/admin/inventory.php');
});

$router->get('/staff', function () use ($middleware) {
    $middleware->authenticateUser();
    require_once('controllers/admin/staff.php');
});

$router->get('/visitors', function () use ($middleware) {
    $middleware->authenticateUser();
    require_once('controllers/admin/visitors.php');
});