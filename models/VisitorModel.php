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
            throw new Exception("Unable to store visitor in the database");
        };

        return "Successfully stored a new visitor in the database";
    }
    
}