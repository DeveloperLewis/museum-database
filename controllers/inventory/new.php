<?php
$controller = new \classes\server\Controller();
$controller->setView("inventory/new");
$controller->get(function() use ($controller) {
    if (isset($_SESSION['name_errors'])) {
        $errors_array['name_errors'] = $_SESSION['name_errors'];
        unset($_SESSION['name_errors']);
    }

    if (isset($_SESSION['origin_country_errors'])) {
        $errors_array['origin_country_errors'] = $_SESSION['origin_country_errors'];
        unset($_SESSION['origin_country_errors']);
    }

    if (isset($_SESSION['age_errors'])) {
        $errors_array['age_errors'] = $_SESSION['age_errors'];
        unset($_SESSION['age_errors']);
    }

    if (isset($_SESSION['estimated_value_errors'])) {
        $errors_array['estimated_value_errors'] = $_SESSION['estimated_value_errors'];
        unset($_SESSION['estimated_value_errors']);
    }

    if (isset($_SESSION['acquired_date_errors'])) {
        $errors_array['acquired_date_errors'] = $_SESSION['acquired_date_errors'];
        unset($_SESSION['acquired_date_errors']);
    }

    if (isset($_SESSION['location_room_errors'])) {
        $errors_array['location_room_errors'] = $_SESSION['location_room_errors'];
        unset($_SESSION['location_room_errors']);
    }

    if (isset($_SESSION['maintenance_status_errors'])) {
        $errors_array['maintenance_status_errors'] = $_SESSION['maintenance_status_errors'];
        unset($_SESSION['maintenance_status_errors']);
    }


    $controller->view($vars ?? null, $errors_array ?? null);
});

$controller->post(function() use ($controller) {
    $name_errors = [];
    $origin_country_errors = [];
    $age_errors = [];
    $estimated_value_errors = [];
    $acquired_date_errors = [];
    $location_room_errors = [];
    $maintenance_status_errors = [];

    //Имя
    if (empty($_POST['name'])) {
        $name_errors['empty'] = "Имя не может быть пустым полем";
    }

    $name = $_POST['name'];

    if (strlen($name) > 100) {
        $name_errors['max_size'] = "Имя не может содержать более 100 знаков";
    }

    if (!preg_match('/[A-z ]/', $name)) {
        $name_errors['characters'] = "Имя может содержать только буквы и пробелы.";
    }


    //Страна
    if (empty($_POST['origin_country'])) {
        $origin_country_errors['empty'] = "Страна не может быть пустым полем";
    }

    $origin_country = $_POST['origin_country'];

    if (strlen($origin_country) > 100) {
        $origin_country_errors['max_size'] = "Страна не может содержать более 100 знаков";
    }

    if (!preg_match('/[A-z ]/', $origin_country)) {
        $origin_country_errors['characters'] = "Страна может содержать только буквы и пробелы.";
    }

    //Возраст
    if (empty($_POST['age'])) {
        $age_errors['empty'] = "Возраст не может быть пустым полем";
    }

    $age = $_POST['age'];

    if (strlen($age) > 30) {
        $age_errors['max_size'] = "Возраст не может содержать более 100 знаков";
    }

    if (!preg_match('/[\d]/', $age)) {
        $age_errors['characters'] = "Возраст может содержать только цифры, / и - .";
    }

    //Стоимость
    if (empty($_POST['estimated_value'])) {
        $estimated_value_errors_errors['empty'] = "Стоимость не может быть пустым полем";
    }

    $estimated_value = $_POST['estimated_value'];

    if (strlen($estimated_value) > 50) {
        $estimated_value_errors['max_size'] = "Стоимость не может содержать более 100 знаков";
    }

    if (!preg_match('/[\d]/', $estimated_value)) {
        $estimated_value_errors['characters'] = "Стоимость может содержать только цифры";
    }

    //Дата получения
    if (empty($_POST['acquired_date'])) {
        $acquired_date_errors['empty'] = "Дата не может быть пустым полем";
    }

    $acquired_date = $_POST['acquired_date'];

    if (strlen($acquired_date) > 20) {
        $acquired_date_errors['max_size'] = "Дата не может содержать более 100 знаков";
    }

    if (!preg_match('/[\d\-\/  ]/', $acquired_date)) {
        $acquired_date_errors['characters'] = "Дата может содержать только цифры, / и - ";
    }

    //Комната местонахождения
    if (empty($_POST['location_room'])) {
        $location_room_errors['empty'] = "Номер комнаты не может быть пустым полем";
    }

    $location_room = $_POST['location_room'];

    if (strlen($location_room) > 10) {
        $location_room_errors['max_size'] = "Номер комнаты не может содержать более 3 знаков";
    }

    if (!preg_match('/[\d]/', $location_room)) {
        $location_room_errors['characters'] = "Номер комнаты может содержать только цифры";
    }

    //Обслуживание
    if (empty($_POST['maintenance_status'])) {
        $maintenance_status_errors['empty'] = "Статус технического обслуживания не может быть пустым полем";
    }

    $maintenance_status = $_POST['maintenance_status'];

    if (strlen($maintenance_status) > 50) {
        $maintenance_status_errors['max_size'] = "Статус технического обслуживания не может содержать более 50 знаков";
    }

    if (!preg_match('/[A-z ]/', $maintenance_status)) {
        $maintenance_status_errors['characters'] = "Статус технического обслуживания может содержать только буквы и пробелы.";
    }

    //Проверка на наличие ошибок
    if (!empty($name_errors)) {
        $_SESSION['name_errors'] = $name_errors;
    }

    if (!empty($origin_country_errors)) {
        $_SESSION['origin_country_errors'] = $origin_country_errors;
    }

    if (!empty($age_errors)) {
        $_SESSION['age_errors'] = $age_errors;
    }

    if (!empty($estimated_value_errors)) {
        $_SESSION['estimated_value_errors'] = $estimated_value_errors;
    }

    if (!empty($acquired_date_errors)) {
        $_SESSION['acquired_date_errors'] = $acquired_date_errors;
    }

    if (!empty($location_room_errors)) {
        $_SESSION['location_room_errors'] = $location_room_errors;
    }

    if (!empty($maintenance_status_errors)) {
        $_SESSION['maintenance_status_errors'] = $maintenance_status_errors;
    }

    if (isset($_SESSION['name_errors']) || isset($_SESSION['origin_country_errors']) || isset($_SESSION['age_errors']) ||
    isset($_SESSION['estimated_value_errors']) || isset($_SESSION['acquired_date_errors']) || isset($_SESSION['location_room_errors'])
    || isset($_SESSION['maintenance_status_errors'])) {
        redirect('/inventory/new');
    }

    $inventoryModel = new \models\InventoryModel();
    $inventoryModel->create($name, $origin_country, (int)$age, (int)$estimated_value, $acquired_date, (int)$location_room, $maintenance_status);
    $inventoryModel->store();

    $_SESSION['success'] = "Новый элемент успешно добавлен в базу данных";

    redirect('/inventory');
});