<?php

namespace migrations;

use classes\server\Database;
use Exception;
use models\AdminModel;
use models\InventoryModel;
use models\MaintenanceModel;
use models\StaffModel;

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
            throw new Exception("Невозможно создать таблицу технического обслуживания.");
        }
        return "Таблица технического обслуживания успешно создана.";
    }

    public function alterKeys(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`maintenance_id`);");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно изменить таблицу технического обслуживания");
        }

        return "Изменения успешно внесены в таблицу";
    }

    public function alterAutoIncrement(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `maintenance`
  MODIFY `maintenance_id` int(11) NOT NULL AUTO_INCREMENT;");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно установить автоматическую инкрементацию");
        }

        return "Изменения успешно внесены в таблицу.";
    }

    public function seed($amount): void {
        $maintenanceModel = new MaintenanceModel();
        $staffModel = new StaffModel();
        $inventoryModel = new InventoryModel();
        $faker = \Faker\Factory::create('ru_RU');

        $maintenance = getList("maintenance");
        $maintainers = $staffModel->getMaintainersById();
        for ($i = 0; $i < $amount; $i++) {
            $maintenanceModel->create($maintainers[$faker->randomKey($maintainers)]["staff_id"], rand(0, $inventoryModel->total()), $maintenance[$faker->randomKey($maintenance)], $faker->date());
            $maintenanceModel->store();
        }
    }
}