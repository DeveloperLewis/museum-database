<?php
$controller = new \classes\server\Controller();
$controller->setView("staff/new");
$controller->get(function() use ($controller) {
    $controller->view($vars ?? null, $errors_array ?? null);
});

$controller->post(function() use ($controller) {