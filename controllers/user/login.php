<?php
$controller = new \classes\server\Controller();
$controller->setView("user/login");
$controller->get(function() use ($controller) {
    if (isset($_SESSION['errors'])) {
        $errors_array = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }

    if (isset($_SESSION['success'])) {
        $vars['success'] = $_SESSION['success'];
        unset($_SESSION['success']);
    }

    $controller->view($vars ?? null, $errors_array ?? null);
});

$controller->post(function() {
    $adminModel = new models\AdminModel();
    $adminModel->username = $_POST["username"];
    $adminModel->password =  $_POST["password"];

    try {
        $success = $adminModel->authenticate();
    } catch (Exception $e) {
        error_log($e);
        $_SESSION["errors"]["login"] = ["The password or email is incorrect, please try again."];
        redirect("/user/login");
    }

    try {
        $adminModel->get();
    } catch (Exception $e) {
        error_log($e);
        $_SESSION["errors"]["login"] = ["There was an internal error. Please contact site administrator"];
        redirect("/user/login");
    }

    $_SESSION["admin"]["admin_id"] = $adminModel->admin_id;
    $_SESSION["admin"]["ip"] = $_SERVER['REMOTE_ADDR'];
    $_SESSION["admin"]["agent"] = $_SERVER['HTTP_USER_AGENT'];
    $_SESSION["admin"]["last_access"] = time();
    redirect("/");
});