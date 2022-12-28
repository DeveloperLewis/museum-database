<?php
$controller = new \classes\server\Controller();
$controller->setView("admin/staff");
$controller->get(function() use ($controller) {
    $controller->view($vars ?? null, $errors_array ?? null);
});