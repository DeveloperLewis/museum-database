<?php

namespace models;

use classes\server\Database;
use Exception;

class InventoryModel
{
    public int $item_id;
    public string $name;
    public string $origin_country;
    public int $age;
    public int $estimated_value;
    public string $acquired_date;
    public int $location_room;
    public string $maintenance_status;

    public function create($name, $origin_country, $age, $estimated_value, $acquired_date, $location_room, $maintenance_status, $item_id = 0): void
    {
        $this->item_id = $item_id;
        $this->name = $name;
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
        $stmt = $database->getPdo()->prepare("INSERT INTO inventory (name, origin_country, age, estimated_value, acquired_date, location_room, maintenance_status) VALUES (?,?,?,?,?,?,?);");

        if (!$stmt->execute([$this->name, $this->origin_country, $this->age, $this->estimated_value, $this->acquired_date, $this->location_room, $this->maintenance_status])) {
            throw new Exception("Unable to store item in the database");
        };

        return "Successfully stored item in the database";
    }

    public function total(): int {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT COUNT(item_id) FROM inventory");

        if (!$stmt->execute()) {
            throw new Exception("Unable to get count of rows for items in inventory table");
        }

        $amount = $stmt->fetch();

        return $amount["COUNT(item_id)"];
    }

    public function getAllDsc(): array {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT * FROM inventory ORDER BY item_id DESC");

        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement");
        }

        if (!$inventory_array = $stmt->fetchAll()) {
            throw new Exception(("Failed to fetch inventory array"));
        }

        return $inventory_array;
    }

    public function delete($item_id): string {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("DELETE FROM inventory WHERE item_id = ?");

        if (!$stmt->execute([$item_id])) {
            throw new Exception("Failed to delete item");
        }

        return "Successfully deleted the item";
    }

    public function getById($id): array|string {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT * FROM inventory WHERE item_id = ?");

        if (!$stmt->execute([$id])) {
            throw new Exception("Failed to execute statement");
        }

        if (!$item_array = $stmt->fetch()) {
            return "Item not found";
        }

        return $item_array;

    }

}