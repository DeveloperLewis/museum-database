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
            throw new Exception("Failed to create admins table.");
        }
        return "Successfully created admins table.";
    }

    public function alterKeys(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `admins`
            ADD PRIMARY KEY (`admin_id`);");

        if (!$stmt->execute()) {
            throw new Exception("Failed to alter the admins table and make the admin_id the primary key.");
        }

        return "Successfully altered the primary key.";
    }

    public function alterAutoIncrement(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;");

        if (!$stmt->execute()) {
            throw new Exception("Failed to alter the admins table and make the admin_id auto incrementing");
        }

        return "Successfully altered the admins table.";
    }
}