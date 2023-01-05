<?php
$controller = new \classes\server\Controller();
$controller->setView("staff/new");
$controller->get(function() use ($controller) {
    if (isset($_SESSION['first_name_errors'])) {
        $errors_array['first_name_errors'] = $_SESSION['first_name_errors'];
        unset($_SESSION['first_name_errors']);
    }

    if (isset($_SESSION['last_name_errors'])) {
        $errors_array['last_name_errors'] = $_SESSION['last_name_errors'];
        unset($_SESSION['last_name_errors']);
    }

    if (isset($_SESSION['address_errors'])) {
        $errors_array['address_errors'] = $_SESSION['address_errors'];
        unset($_SESSION['address_errors']);
    }

    if (isset($_SESSION['contact_number_errors'])) {
        $errors_array['contact_number_errors'] = $_SESSION['contact_number_errors'];
        unset($_SESSION['contact_number_errors']);
    }

    if (isset($_SESSION['position_errors'])) {
        $errors_array['position_errors'] = $_SESSION['position_errors'];
        unset($_SESSION['position_errors']);
    }

    if (isset($_SESSION['salary_errors'])) {
        $errors_array['salary_errors'] = $_SESSION['salary_errors'];
        unset($_SESSION['salary_errors']);
    }

    if (isset($_SESSION['employment_date_errors'])) {
        $errors_array['employment_date_errors'] = $_SESSION['employment_date_errors'];
        unset($_SESSION['employment_date_errors']);
    }

    $controller->view($vars ?? null, $errors_array ?? null);
});

$controller->post(function() use ($controller) {
    $first_name_errors = [];
    $last_name_errors = [];
    $address_errors = [];
    $contact_number_errors = [];
    $position_errors = [];
    $salary_errors = [];
    $employment_date_errors = [];

    //Имя
    if (empty($_POST['first_name'])) {
        $first_name_errors['empty'] = "Имя не может быть пустым полем";
    }

    $first_name = $_POST['first_name'];

    if (!preg_match('/[A-z]/', $first_name)) {
        $first_name_errors['special_chars'] = "Имя может содержать только буквы";
    }

    if (strlen($first_name) > 50) {
        $first_name_errors['max_length'] = "Имя должно быть короче 50 знаков";
    }



    //Фамилия
    if (empty($_POST['last_name'])) {
        $last_name_errors['empty'] = "Фамилия не может быть пустым полем";
    }

    $last_name = $_POST['last_name'];

    if (!preg_match('/[A-z]/', $last_name)) {
        $last_name_errors['special_chars'] = "Фамилия может содержать только буквы";
    }

    if (strlen($last_name) > 50) {
        $last_name_errors['max_length'] = "Фамилия должна быть короче 50 знаков";
    }



    //Адрес
    if (empty($_POST['address'])) {
        $address_errors['empty'] = "Адрес не может быть пустым полем";
    }

    $address = $_POST['address'];

    if (!preg_match('/[A-z\d ]/', $address)) {
        $address_errors['special_chars'] = "Адрес может содержать только буквы, цифры и пробелы";
    }

    if (strlen($address) > 300) {
        $address_errors['max_length'] = "Адрес должен быть короче 50 знаков";
    }



    //Телефон
    if (empty($_POST['contact_number'])) {
        $contact_number_errors['empty'] = "Номер телефона не может быть пустым полем";
    }

    $contact_number = $_POST['contact_number'];

    if (!preg_match('/[\d]/', $contact_number)) {
        $contact_number_errors['special_chars'] = "Номер телефона может содержать только цифры";
    }

    if (strlen($contact_number) > 50) {
        $contact_number_errors['max_length'] = "Номер телефона должен быть короче 50 знаков";
    }


    //Должность
    if (empty($_POST['position'])) {
        $position_errors['empty'] = "Должность не может быть пустым полем";
    }

    $position = $_POST['position'];

    if (!preg_match('/[A-z]/', $position)) {
        $position_errors['special_chars'] = "Должность может содержать только буквы";
    }

    if (strlen($position) > 50) {
        $position_errors['max_length'] = "Должность должна быть короче 50 знаков";
    }


    //Зарплата
    if (empty($_POST['salary'])) {
        $salary_errors['empty'] = "Зарплата не может быть пустым полем";
    }

    $salary = $_POST['salary'];

    if (!preg_match('/[\d]/', $salary)) {
        $salary_errors['special_chars'] = "Зарплата может содержать только цифры";
    }

    if (strlen($salary) > 30) {
        $salary_errors['max_length'] = "ИЗарплата должна быть короче 30 знаков";
    }


    //Дата найма

    if (empty($_POST['employment_date'])) {
        $employment_date_errors['empty'] = "Дата найма не может быть пустым полем";
    }

    $employment_date = $_POST['employment_date'];

    if (!preg_match('/[\d\-\/ ]/', $employment_date)) {
        $employment_date_errors['special_chars'] = "Дата найма может содержать только цифры";
    }

    if (strlen($employment_date) > 20) {
        $employment_date_errors['max_length'] = "Дата найма должна быть короче 20 знаков";
    }

    //Создание сессий
    if (!empty($first_name_errors)) {
        $_SESSION['first_name_errors'] = $first_name_errors;
    }

    if (!empty($last_name_errors)) {
        $_SESSION['last_name_errors'] = $last_name_errors;
    }

    if (!empty($address_errors)) {
        $_SESSION['address_errors'] = $address_errors;
    }

    if (!empty($contact_number_errors)) {
        $_SESSION['contact_number_errors'] = $contact_number_errors;
    }

    if (!empty($position_errors)) {
        $_SESSION['position_errors'] = $position_errors;
    }

    if (!empty($salary_errors)) {
        $_SESSION['salary_errors'] = $salary_errors;
    }

    if (!empty($employment_date_errors)) {
        $_SESSION['employment_date_errors'] = $employment_date_errors;
    }

    if (isset($_SESSION['first_name_errors']) || isset($_SESSION['last_name_errors']) || isset($_SESSION['address_errors'])
    || isset($_SESSION['contact_number_errors']) || isset($_SESSION['position_errors']) || isset($_SESSION['salary_errors'])
    || isset($_SESSION['employment_date_errors'])) {
        redirect('/staff/new');
    }

    $staffModel = new \models\StaffModel();
    $staffModel->create($first_name, $last_name, $address, $contact_number, $position, $salary, $employment_date);
    $staffModel->store();

    $_SESSION['success'] = "Новый член персонала успешно добавлен в базу данных";

    redirect('/staff');
});