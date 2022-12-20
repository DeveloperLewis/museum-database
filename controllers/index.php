<?php
$controller = new \classes\server\Controller();
$controller->setView("index");
$controller->get(function() use ($controller) {
    if (isset($_SESSION["admin"])) {
        $adminModel = new models\AdminModel();
        $adminModel->admin_id = $_SESSION["admin"]["admin_id"];

        try {
            $adminModel->get();
            $vars["username"] = $adminModel->username;
        } catch (Exception $e) {
            error_log($e);
        }
    }

    $controller->view($vars ?? null, null);
});
