<?php

namespace migrations;

use classes\server\Database;
use Exception;
use models\AdminModel;

class StaffMigrations
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
        $stmt = $this->pdo->prepare("CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(300) NOT NULL,
  `contact_number` int(20) NOT NULL,
  `position` varchar(50) NOT NULL,
  `salary` int(30) NOT NULL,
  `employment_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

        if (!$stmt->execute()) {
            throw new Exception("Failed to create staff table.");
        }
        return "Successfully created staff table.";
    }

    public function alterKeys(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);");

        if (!$stmt->execute()) {
            throw new Exception("Failed to alter the staff table and update primary key");
        }

        return "Successfully altered the primary key";
    }

    public function alterAutoIncrement(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT;");

        if (!$stmt->execute()) {
            throw new Exception("Failed to alter the staff table and make the staff_id auto incrementing");
        }

        return "Successfully altered the staff table.";
    }
}