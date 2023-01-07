<?php
$controller = new \classes\server\Controller();
$controller->post(function() {
    if (isset($_POST['id'])) {
        $staffModel = new \models\StaffModel();
        if ($success = $staffModel->delete($_POST['id'])) {
            $_SESSION['success'] = $success;
        } else {
            $_SESSION['errors'] = ["Unable to delete item " . $_POST['id'] . ". Please try again."];
        }
    }
    redirect("/staff");
});
