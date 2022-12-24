<?php

function dateAndTime(): string
{
    try {
        $timezone = 'Europe/London';
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
            return ["Great", "Ok", "Broken"];
        case "items":
            return ["Granite", "Crown", "Bones", "Statue", "Jeweled Necklace", "Silverware", "Fancy Plate", "Arrow Head",
                "Fabric", "Coin", "Old Coin", "Pot", "Tea Pot"];
        case "positions":
            return ["Janitor", "Maintainer", "Painter", "Receptionist", "Scientist", "Tour Guide"];
        case "payment_types":
            return ["Paid", "Pending", "Refund"];
        case "payment_categories":
            return ["Gift Shop", "Contracts", "Assets"];
        case "payment_methods":
            return ["Card", "Cash", "Cheque"];
    }
}