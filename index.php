<?php
require_once('vendor/autoload.php');
$router = new \classes\server\Router();
$middleware = new classes\middleware\General();

require_once('init.php');

//Начало глобальной сессии
session_start();

$router->get('/', function () {
    require_once('controllers/index.php');
});

$router->notFound(function () {
    require_once('views/404.php');
});

$router->get('/seed', function () {
    $invMig = new \migrations\InventoryMigrations();
    $staffMig = new \migrations\StaffMigrations();
    $tranMig = new \migrations\TransactionsMigrations();
    $visMig = new \migrations\VisitorsMigrations();
    $mainMig = new \migrations\MaintenanceMigrations();

    $invMig->seed(60);
    $staffMig->seed(20);
    $tranMig->seed(50);
    $visMig->seed(30);
    $mainMig->seed(60);
});

require_once('routes/user.php');
require_once('routes/admin.php');
require_once('routes/inventory.php');
require_once('routes/maintenance.php');
require_once('routes/staff.php');


$router->run();
