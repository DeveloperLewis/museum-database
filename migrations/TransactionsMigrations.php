<?php

namespace migrations;

use classes\server\Database;
use Exception;
use models\AdminModel;

class TransactionsMigrations
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
        $stmt = $this->pdo->prepare("CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `amount` int(50) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

        if (!$stmt->execute()) {
            throw new Exception("Failed to create transactions table.");
        }
        return "Successfully created transactions table.";
    }

    public function alterKeys(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);");

        if (!$stmt->execute()) {
            throw new Exception("Failed to alter the transactions table and make the transaction_id the primary key.");
        }

        return "Successfully altered the primary key.";
    }

    public function alterAutoIncrement(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;");

        if (!$stmt->execute()) {
            throw new Exception("Failed to alter the transactions table and make the transaction_id auto incrementing");
        }

        return "Successfully altered the transaction table.";
    }
}