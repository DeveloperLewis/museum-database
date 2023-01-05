<?php

function dateAndTime(): string
{
    try {
        $timezone = 'Europe/Minsk';
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($timezone));
        $dt->setTimestamp($timestamp);
    } catch (Exception $e) {
        error_log($e);
    }
    return $dt->format('d/m/Y H:i:s');
}

function redirect($url, $statusCode = 303): void
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

function showErrors($errors_array): void {
    if (empty($errors_array)) {
        return;
    }

    foreach ($errors_array as $errors) {
        foreach ($errors as $error) {
            echo '<div class="text-center">';
            echo '<small class="text-danger">' . $error . '</small>';
            echo '</div>';
        }
    }
}

function showSuccess($success): void {
    if (empty($success)) {
        return;
    }

    echo '<div class="text-center">';
    echo '<small class="text-success">' . $success . '</small>';
    echo '</div>';
}

function isLoggedIn(): bool {
    if (!isset($_SESSION['admin'])) {
        return false;
    }

    return true;
}

function getList($option): array {
    switch ($option) {
        case "maintenance":
            return ["Отличное", "Хорошее", "Сломан"];
        case "items":
            return ["Горная порода", "Корона", "Окаменелость", "Статуя", "Ожерелье", "Столовое серебро", "Изысканнная посуда", "Наконечник стрелы",
                "Полотно", "Монета", "Традиционная одежда", "Горшок", "Ваза"];
        case "positions":
            return ["Уборщик помещений", "Техник", "Маляр", "Администратор", "Ученый", "Экскурсовод"];
        case "payment_types":
            return ["Оплачено", "Ожидание", "Возврат"];
        case "payment_categories":
            return ["Сувенирный магазин", "Контракты", "Посещение музея"];
        case "payment_methods":
            return ["Карта", "Наличные"];
    }
}

function printArray($array): void {
    echo "<pre>";
        print_r($array);
    echo "</pre>";
}