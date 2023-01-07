<?php

namespace migrations;

use classes\server\Database;
use Exception;
use models\AdminModel;
use models\VisitorModel;

class VisitorsMigrations
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
        $stmt = $this->pdo->prepare("CREATE TABLE `visitors` (
  `visitor_id` int(11) NOT NULL,
  `entry_date` varchar(20) NOT NULL,
  `exit_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно создать таблицу посетителей.");
        }
        return "Таблица посетителей успешно создана.";
    }

    public function alterKeys(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `visitors`
  ADD PRIMARY KEY (`visitor_id`);
");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно установить первичный ключ.");
        }

        return "Успешно установлен первичный ключ.";
    }

    public function alterAutoIncrement(): string {
        $stmt = $this->pdo->prepare("ALTER TABLE `visitors`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT;");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно установить автоматическую инкрементацию");
        }

        return "Изменения успешно внесены в таблицу.";
    }

    public function seed($amount): void {
        $visitorModel = new VisitorModel();
        $faker = \Faker\Factory::create('ru_RU');

        for ($i = 0; $i < $amount; $i++) {
            $entryDate = $faker->date();
            $minTime = rand(36000, 57600);
            $entryTime = date('H:i:s', $minTime);
            $exitTime = date('H:i:s', rand($minTime, 61200));

            $visitorModel->create($entryDate . " " . $entryTime, $entryDate . " " . $exitTime);
            $visitorModel->store();
        }
    }
}