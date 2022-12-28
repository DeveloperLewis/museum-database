<?php
$controller = new \classes\server\Controller();
$controller->setView("admin/visitors");
$controller->get(function() use ($controller) {
    $controller->view($vars ?? null, $errors_array ?? null);
});
