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

    //Номер элемента
    if (empty($_POST['item_id'])) {
        $item_errors['empty'] = "Это поле не может быть пустым";
    }

    $item_id = $_POST['item_id'];
    $invModel = new \models\InventoryModel();
    $item = $invModel->getById($item_id);

    if (is_string($item)) {
        $item_errors['missing'] = "Элемент не найден";
    }

    if (!preg_match('/[\d]/', $item_id)) {
        $item_errors['invalid_characters'] = "Номер может содержать только цифры";
    }

    if (strlen($item_id) > 11) {
        $item_errors['max_length'] = "Номер не может быть длиннее 11 знаков.";
    }

    //Номер члена персонала
    if (empty($_POST['staff_id'])) {
        $staff_errors['empty'] = "Член персонала должен быть выбран";
    }

    $staff_id = $_POST['staff_id'];
    $staffModel = new \models\StaffModel();
    $staff = $staffModel->getById($staff_id);


    if (is_string($staff)) {
        $staff_errors['missing'] = "Член персонала не найден";
    }

    if (!preg_match('/[\d]/', $staff_id)) {
        $staff_errors['invalid_characters'] = "Номер может содержать только цифры";
    }

    if (strlen($staff_id) > 11) {
        $staff_errors['max_length'] = "Номер не может быть длиннее 11 знаков.";
    }

    //Описание
    if (empty($_POST['description'])) {
        $description_errors['empty'] = "Описание не должно быть пустым полем";
    }

    $description = $_POST['description'];

    if (strlen($description) > 2000) {
        $description_errors['max_length'] = "Описание не может быть длиннее 200 знаков";
    }

    if (!preg_match('/[A-z\d.,+ ]/', $description)) {
        $description_errors['special_chars'] = "Описание может содержать только буквы, цифры, пробелы и знаки .,+.";
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

    $_SESSION['success'] = "Успешно добавлена новая запись в журнал технического обслуживания.";

    redirect('/maintenance?id=' . $item_id);
});