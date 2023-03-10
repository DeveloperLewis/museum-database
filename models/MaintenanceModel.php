<?php

namespace models;

use classes\server\Database;
use Exception;

class MaintenanceModel
{
    public int $maintenance_id;
    public int $staff_id;
    public int $item_id;
    public string $description;
    public string $date;

    public function create($staff_id, $item_id, $description, $date, $maintenance_id = 0): void
    {
        $this->maintenance_id = $maintenance_id;
        $this->staff_id = $staff_id;
        $this->item_id = $item_id;
        $this->description = $description;
        $this->date = $date;
    }

    public function store(): string
    {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("INSERT INTO maintenance (staff_id, item_id, description, date) VALUES (?,?,?,?);");

        if (!$stmt->execute([$this->staff_id, $this->item_id, $this->description, $this->date])) {
            throw new Exception("Unable to store maintenance log in the database");
        };

        return "Successfully stored a maintenance log in the database";
    }

    public function getByItemIdDsc($item_id): array|string {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT * FROM maintenance WHERE item_id = ? ORDER BY maintenance_id DESC");

        if (!$stmt->execute([$item_id])) {
            throw new Exception("Failed to execute statement");
        }

        if (!$maintenance_array = $stmt->fetchAll()) {
            return  "No maintenance logs were found for this item.";
        }

        return $maintenance_array;
    }
    
}