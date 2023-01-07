<?php
$controller = new \classes\server\Controller();
$controller->post(function() {
    if (isset($_POST['id'])) {
        $inventoryModel = new \models\InventoryModel();
        if ($success = $inventoryModel->delete($_POST['id'])) {
            $_SESSION['success'] = $success;
        } else {
            $_SESSION['errors'] = ["Unable to delete item " . $_POST['id'] . ". Please try again."];
        }
        redirect("/inventory");
    }
});