<?php
$controller = new \classes\server\Controller();
$controller->setView("admin/inventory");
$controller->get(function() use ($controller) {
    if (isset($_SESSION['success'])) {
        $vars['success'] = $_SESSION['success'];
        unset($_SESSION['success']);
    }

    $controller->view($vars ?? null, $errors_array ?? null);
});