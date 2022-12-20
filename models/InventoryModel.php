<?php

namespace models;

use classes\server\Database;
use Exception;

class InventoryModel
{
    public int $item_id;
    public string $origin_country;
    public int $age;
    public int $estimated_value;
    public string $acquired_date;
    public int $location_room;
    public string $maintenance_status;

    public function create($origin_country, $age, $estimated_value, $acquired_date, $location_room, $maintenance_status, $item_id = 0): void
    {
        $this->item_id = $item_id;
        $this->origin_country = $origin_country;
        $this->age = $age;
        $this->estimated_value = $estimated_value;
        $this->acquired_date = $acquired_date;
        $this->location_room = $location_room;
        $this->maintenance_status = $maintenance_status;
    }

    public function store(): string
    {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("INSERT INTO inventory (origin_country, age, estimated_value, acquired_date, location_room, maintenance_status) VALUES (?,?,?,?,?,?);");

        if (!$stmt->execute([$this->origin_country, $this->age, $this->estimated_value, $this->acquired_date, $this->location_room, $this->maintenance_status])) {
            throw new Exception("Unable to store item in the database");
        };

        return "Successfully stored item in the database";
    }

}