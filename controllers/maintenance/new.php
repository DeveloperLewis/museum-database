<?php
$controller = new \classes\server\Controller();
$controller->setView("maintenance/new");
$controller->get(function() use ($controller) {
    if (isset($_SESSION['item_errors'])) {
        $errors_array['item_errors'] = $_SESSION['item_errors'];
        unset($_SESSION['item_errors']);
    }

    if (isset($_SESSION['staff_errors'])) {
        $errors_array['staff_errors'] = $_SESSION['staff_errors'];
        unset($_SESSION['staff_errors']);
    }

    if (isset($_SESSION['description_errors'])) {
        $errors_array['description_errors'] = $_SESSION['description_errors'];
        unset($_SESSION['description_errors']);
    }

    $controller->view($vars ?? null, $errors_array ?? null);
});

$controller->post(function() use ($controller) {



    $item_errors = [];
    $staff_errors = [];
    $description_errors = [];

    //item id
    if (empty($_POST['item_id'])) {
        $item_errors['empty'] = "The item_id cannot be empty";
    }

    $item_id = $_POST['item_id'];
    $invModel = new \models\InventoryModel();
    $item = $invModel->getById($item_id);

    if (is_string($item)) {
        $item_errors['missing'] = "The item was not found";
    }

    if (!preg_match('/[\d]/', $item_id)) {
        $item_errors['invalid_characters'] = "Item id must only contain numbers";
    }

    if (strlen($item_id) > 11) {
        $item_errors['max_length'] = "Item id cannot be more than 11 characters long.";
    }

    //staff id
    if (empty($_POST['staff_id'])) {
        $staff_errors['empty'] = "The staff member must be selected";
    }

    $staff_id = $_POST['staff_id'];
    $staffModel = new \models\StaffModel();
    $staff = $staffModel->getById($staff_id);


    if (is_string($staff)) {
        $staff_errors['missing'] = "The staff member was not found";
    }

    if (!preg_match('/[\d]/', $staff_id)) {
        $staff_errors['invalid_characters'] = "Staff id must only contain numbers";
    }

    if (strlen($staff_id) > 11) {
        $staff_errors['max_length'] = "Staff id cannot be more than 11 characters long.";
    }

    //description
    if (empty($_POST['description'])) {
        $description_errors['empty'] = "The description must not be empty";
    }

    $description = $_POST['description'];

    if (strlen($description) > 2000) {
        $description_errors['max_length'] = "The description cannot be more than 2000 characters long";
    }

    if (!preg_match('/[A-z\d.,+ ]/', $description)) {
        $description_errors['special_chars'] = "The description can only contain letters, numbers, spaces and .,+ characters.";
    }

    if (!empty($item_errors)) {
        $_SESSION['item_errors'] = $item_errors;
    }

    if (!empty($staff_errors)) {
        $_SESSION['staff_errors'] = $staff_errors;
    }

    if (!empty($description_errors)) {
        $_SESSION['description_errors'] = $description_errors;
    }

    if (isset($_SESSION['item_errors']) || isset($_SESSION['staff_errors']) || isset($_SESSION['description_errors'])) {
        redirect('/maintenance/new?id=' . $item_id);
    }

    $maintenanceModel = new \models\MaintenanceModel();
    $maintenanceModel->create($staff_id, $item_id, $description, dateAndTime());
    $maintenanceModel->store();

    $_SESSION['success'] = "Successfully added a new maintenance log to the database.";

    redirect('/maintenance?id=' . $item_id);
});