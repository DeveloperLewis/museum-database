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

    //name
    if (empty($_POST['name'])) {
        $name_errors['empty'] = "The name cannot be empty";
    }

    $name = $_POST['name'];

    if (strlen($name) > 100) {
        $name_errors['max_size'] = "The name cannot be more than 100 characters";
    }

    if (!preg_match('/[A-z ]/', $name)) {
        $name_errors['characters'] = "The name can only contain letters and spaces.";
    }


    //country
    if (empty($_POST['origin_country'])) {
        $origin_country_errors['empty'] = "Country cannot be empty";
    }

    $origin_country = $_POST['origin_country'];

    if (strlen($origin_country) > 100) {
        $origin_country_errors['max_size'] = "The country cannot be more than 100 characters";
    }

    if (!preg_match('/[A-z ]/', $origin_country)) {
        $origin_country_errors['characters'] = "The country can only contain letters and spaces.";
    }

    //age
    if (empty($_POST['age'])) {
        $age_errors['empty'] = "The age cannot be empty";
    }

    $age = $_POST['age'];

    if (strlen($age) > 30) {
        $age_errors['max_size'] = "The age cannot be more than 100 characters";
    }

    if (!preg_match('/[\d]/', $age)) {
        $age_errors['characters'] = "The age can only contain digits, / and - .";
    }

    //est value
    if (empty($_POST['estimated_value'])) {
        $estimated_value_errors_errors['empty'] = "The value cannot be empty";
    }

    $estimated_value = $_POST['estimated_value'];

    if (strlen($estimated_value) > 50) {
        $estimated_value_errors['max_size'] = "The value cannot be more than 100 characters";
    }

    if (!preg_match('/[\d]/', $estimated_value)) {
        $estimated_value_errors['characters'] = "The value can only contain numbers";
    }

    //acquired date
    if (empty($_POST['acquired_date'])) {
        $acquired_date_errors['empty'] = "The date cannot be empty";
    }

    $acquired_date = $_POST['acquired_date'];

    if (strlen($acquired_date) > 20) {
        $acquired_date_errors['max_size'] = "The date cannot be more than 100 characters";
    }

    if (!preg_match('/[\d\-\/  ]/', $acquired_date)) {
        $acquired_date_errors['characters'] = "The date can only contain digits, / and - ";
    }

    //room
    if (empty($_POST['location_room'])) {
        $location_room_errors['empty'] = "The room cannot be empty";
    }

    $location_room = $_POST['location_room'];

    if (strlen($location_room) > 10) {
        $location_room_errors['max_size'] = "The room cannot be more than 3 characters";
    }

    if (!preg_match('/[\d]/', $location_room)) {
        $location_room_errors['characters'] = "The room can only contain digits";
    }

    //maintain
    if (empty($_POST['maintenance_status'])) {
        $maintenance_status_errors['empty'] = "The maintenance status cannot be empty";
    }

    $maintenance_status = $_POST['maintenance_status'];

    if (strlen($maintenance_status) > 50) {
        $maintenance_status_errors['max_size'] = "The maintenance status cannot be more than 50 characters";
    }

    if (!preg_match('/[A-z ]/', $maintenance_status)) {
        $maintenance_status_errors['characters'] = "The maintenance status can only contain letters and spaces.";
    }

    //Check if any errors are present
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

    $_SESSION['success'] = "Successfully added a new item to the database";

    redirect('/inventory');
});