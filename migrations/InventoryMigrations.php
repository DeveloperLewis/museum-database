<?php

namespace migrations;

use classes\server\Database;
use Exception;
use models\AdminModel;
use models\InventoryModel;

class InventoryMigrations
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
        $stmt = $this->pdo->prepare("CREATE TABLE `inventory` (
  `item_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL, 
  `origin_country` varchar(100) NOT NULL,
  `age` int(30) NOT NULL,
  `estimated_value` int(50) NOT NULL,
  `acquired_date` varchar(20) NOT NULL,
  `location_room` int(10) NOT NULL,
  `maintenance_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно создать таблицу инвентаря.");
        }
        return "Таблица инвентаря успешно создана.";
    }

    public function alterKeys(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `inventory`
  ADD PRIMARY KEY (`item_id`);");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно установить первичный ключ.");
        }

        return "Успешно установлен первичный ключ.";
    }

    public function alterAutoIncrement(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `inventory`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно установить автоматическую инкрементацию");
        }

        return "Изменения успешно внесены в таблицу.";
    }

    public function seed($amount): void {
        $invModel = new InventoryModel();
        $faker = \Faker\Factory::create();

        $items = getList("items");
        $maintenance = getList("maintenance");

        for ($i = 0; $i < $amount; $i++) {
            $invModel->create($items[$faker->randomKey($items)], $faker->country(), rand(18, 60),
                rand(50,5000),$faker->date(),rand(1,10), $maintenance[$faker->randomKey($maintenance)]);
            $invModel->store();
        }
    }
}