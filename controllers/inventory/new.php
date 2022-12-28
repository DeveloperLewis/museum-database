<?php
$controller = new \classes\server\Controller();
$controller->setView("inventory/new");
$controller->get(function() use ($controller) {
    $controller->view($vars ?? null, null);
});

$controller->post(function() use ($controller) {
    print_r($_POST);

    $name = $_POST['name'];
    $origin_country = $_POST['origin_country'];
    $age = $_POST['age'];
    $estimated_value = $_POST['estimated_value'];
    $acquired_date = $_POST['acquired_date'];
    $location_room = $_POST['location_room'];
    $maintenance_status = $_POST['maintenance_status'];
});