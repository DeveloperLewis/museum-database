<?php

namespace models;

use classes\server\Database;
use Exception;

class VisitorModel
{
    public int $visitor_id;
    public string $entry_date;
    public string $exit_date;


    public function create($entry_date, $exit_date, $visitor_id = 0): void
    {
        $this->visitor_id = $visitor_id;
        $this->entry_date = $entry_date;
        $this->exit_date = $exit_date;
    }

    public function store(): string
    {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("INSERT INTO visitors (entry_date, exit_date) VALUES (?,?);");

        if (!$stmt->execute([$this->entry_date, $this->exit_date])) {
            throw new Exception("Невозможно сохранить посетителя в базе данных");
        };

        return "Посетитель успешно сохранен в базе данных";
    }

    public function getAllDsc(): array {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT * FROM visitors ORDER BY visitor_id DESC");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно выполнение команды");
        }

        if (!$visitors_array = $stmt->fetchAll()) {
            throw new Exception(("Невозможно получить массив данных"));
        }

        return $visitors_array;
    }
    
}