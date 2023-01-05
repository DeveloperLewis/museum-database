<?php

namespace models;

use classes\server\Database;
use Exception;

class StaffModel
{
    public int $staff_id;
    public string $first_name;
    public string $last_name;
    public string $address;
    public string $contact_number;
    public string $position;
    public int $salary;
    public string $employment_date;


    public function create($first_name, $last_name, $address, $contact_number, $position, $salary, $employment_date, $staff_id = 0): void
    {
        $this->staff_id = $staff_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->address = $address;
        $this->contact_number = $contact_number;
        $this->position = $position;
        $this->salary = $salary;
        $this->employment_date = $employment_date;
    }

    public function store(): string
    {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("INSERT INTO staff (first_name, last_name, address, contact_number, position, salary, employment_date) VALUES (?,?,?,?,?,?,?);");

        if (!$stmt->execute([$this->first_name, $this->last_name, $this->address, $this->contact_number, $this->position, $this->salary, $this->employment_date])) {
            throw new Exception("Невозможно сохранить данные в базе данных");
        };

        return "Данные успешно сохранены в базе данных";
    }

    public function getMaintainersById(): array {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT staff_id FROM staff WHERE position = 'maintainer'");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно найти персонал по запросу");
        }

        return $stmt->fetchAll();
    }

    public function getAllDsc(): array {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT * FROM staff ORDER BY staff_id DESC");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно выполнение команды");
        }

        if (!$staff_array = $stmt->fetchAll()) {
            throw new Exception(("Невозможно получить массив данных"));
        }

        return $staff_array;
    }

    public function delete($staff_id): string {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("DELETE FROM staff WHERE staff_id = ?");

        if (!$stmt->execute([$staff_id])) {
            throw new Exception("Невозможно удалить предмет");
        }

        return "Член персонала успешно удален";
    }

    public function getById($id): array|string {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT * FROM staff WHERE staff_id = ?");

        if (!$stmt->execute([$id])) {
            throw new Exception("Невозможно выполнение команды");
        }

        if (!$staff_array = $stmt->fetch()) {
            return "Член персонала не найден";
        }

        return $staff_array;

    }
    
}