<?php

namespace migrations;

use classes\server\Database;
use Exception;
use models\AdminModel;
use models\StaffModel;

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
  `contact_number` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `salary` int(30) NOT NULL,
  `employment_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно создать таблицу персонала.");
        }
        return "Таблица персонала успешно создана.";
    }

    public function alterKeys(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно установить первичный ключ");
        }

        return "Успешно установлен первичный ключ";
    }

    public function alterAutoIncrement(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT;");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно установить автоматическую инкрементацию");
        }

        return "Изменения успешно внесены в таблицу.";
    }

    public function seed($amount): void {
        $staffModel = new StaffModel();
        $faker = \Faker\Factory::create();

        $positions = getList("positions");

        for ($i = 0; $i < $amount; $i++) {
            $staffModel->create($faker->firstName(), $faker->lastName(), $faker->address(), $faker->phoneNumber(),
                $positions[$faker->randomKey($positions)], rand(18000,40000), $faker->date());
            $staffModel->store();
        }
    }
}