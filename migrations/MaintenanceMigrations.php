<?php

namespace migrations;

use classes\server\Database;
use Exception;
use models\AdminModel;

class MaintenanceMigrations
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
        $stmt = $this->pdo->prepare("CREATE TABLE `maintenance` (
  `maintenance_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

        if (!$stmt->execute()) {
            throw new Exception("Failed to create maintenance table.");
        }
        return "Successfully created maintenance table.";
    }

    public function alterKeys(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`maintenance_id`);");

        if (!$stmt->execute()) {
            throw new Exception("Failed to alter the maintenance table and update keys");
        }

        return "Successfully altered the keys";
    }

    public function alterAutoIncrement(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `maintenance`
  MODIFY `maintenance_id` int(11) NOT NULL AUTO_INCREMENT;");

        if (!$stmt->execute()) {
            throw new Exception("Failed to alter the maintenance table and make the maintenance_id auto incrementing");
        }

        return "Successfully altered the maintenance table.";
    }
}