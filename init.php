<?php

$env = new \classes\server\Env();

//Create initial Database
$host = $env->server;
$username = $env->database_username;
$password = $env->database_password;

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
} catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}

//Create Database
try {
    $stmt = $pdo->prepare("CREATE DATABASE IF NOT EXISTS " . $env->db);
    if (!$stmt->execute()) {
        throw new \Exception("Failed to create the database.");
    }
} catch (Exception $e) {
    error_log($e);
}

//Admins Table
$admins_migrations = new migrations\AdminsMigrations();

try {
    $admins_migrations->createTable();
    $admins_migrations->alterKeys();
    $admins_migrations->alterAutoIncrement();
} catch (Exception $e) {
    error_log($e);
}

//Admin Starter Account
$adminModel = new \models\AdminModel();
$adminModel->create($env->admin_username, $env->admin_password, dateAndTime());

try {
    $adminModel->store();
} catch (Exception $e) {
    error_log($e);
}

//Inventory Table
$inventory_migrations = new \migrations\InventoryMigrations();

try {
    $inventory_migrations->createTable();
    $inventory_migrations->alterKeys();
    $inventory_migrations->alterAutoIncrement();
} catch (Exception $e) {
    error_log($e);
}

//Maintenance Table
$maintenance_migrations = new \migrations\MaintenanceMigrations();

try {
    $maintenance_migrations->createTable();
    $maintenance_migrations->alterKeys();
    $maintenance_migrations->alterAutoIncrement();
} catch (Exception $e) {
    error_log($e);
}

//Staff Table
$staff_migrations = new \migrations\StaffMigrations();

try {
    $staff_migrations->createTable();
    $staff_migrations->alterKeys();
    $staff_migrations->alterAutoIncrement();
} catch (Exception $e) {
    error_log($e);
}

//Transactions Table
$transactions_migrations = new \migrations\TransactionsMigrations();

try {
    $transactions_migrations->createTable();
    $transactions_migrations->alterKeys();
    $transactions_migrations->alterAutoIncrement();
} catch (Exception $e) {
    error_log($e);
}

//Visitors Table
$visitors_table = new \migrations\VisitorsMigrations();

try {
    $visitors_table->createTable();
    $visitors_table->alterKeys();
    $visitors_table->alterAutoIncrement();
} catch (Exception $e) {
    error_log($e);
}
