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
            throw new Exception("Unable to store staff member in the database");
        };

        return "Successfully stored a staff member in the database";
    }

    public function getMaintainersById(): array {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT staff_id FROM staff WHERE position = 'maintainer'");

        if (!$stmt->execute()) {
            throw new Exception("Unable to return maintainers in the staff table");
        }

        return $stmt->fetchAll();
    }

    public function getAllDsc(): array {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT * FROM staff ORDER BY staff_id DESC");

        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement");
        }

        if (!$staff_array = $stmt->fetchAll()) {
            throw new Exception(("Failed to fetch inventory array"));
        }

        return $staff_array;
    }
    
}