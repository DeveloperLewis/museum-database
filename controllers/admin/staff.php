<?php
$controller = new \classes\server\Controller();
$controller->setView("admin/staff");
$controller->get(function() use ($controller) {
    if (isset($_SESSION['success'])) {
        $vars['success'] = $_SESSION['success'];
        unset($_SESSION['success']);
    }

    if (isset($_SESSION['errors'])) {
        $errors_array['errors'] = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }

    $controller->view($vars ?? null, $errors_array ?? null);
});