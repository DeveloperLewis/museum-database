<?php

namespace migrations;

use classes\server\Database;
use Exception;
use models\AdminModel;

class AdminsMigrations
{
    private object $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getPdo();
    }

    /**
     * @throws Exception
     */
    public function createTable(): string
    {
        $stmt = $this->pdo->prepare("CREATE TABLE admins (
            admin_id int not null,
            username varchar(35) not null, 
            password varchar(150) not null,
            account_creation_date varchar(20) not null
        )");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно создать таблицу админа.");
        }
        return "Таблица админа успешно создана.";
    }

    public function alterKeys(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `admins`
            ADD PRIMARY KEY (`admin_id`);");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно установить первичный ключ.");
        }

        return "Успешно установлен первичный ключ.";
    }

    public function alterAutoIncrement(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно установить автоматическую инкрементацию");
        }

        return "Изменения успешно внесены в таблицу.";
    }
}