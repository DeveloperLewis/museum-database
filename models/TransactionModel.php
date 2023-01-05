<?php

namespace models;

use classes\server\Database;
use Exception;

class TransactionModel
{
    public int $transaction_id;
    public string $type;
    public string $category;
    public string $payment_method;
    public int $amount;
    public string $date;


    public function create($type, $category, $payment_method, $amount, $date, $transaction_id = 0): void
    {
        $this->transaction_id = $transaction_id;
        $this->type = $type;
        $this->category = $category;
        $this->payment_method = $payment_method;
        $this->amount = $amount;
        $this->date = $date;
    }

    public function store(): string
    {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("INSERT INTO transactions (type, category, payment_method, amount, date) VALUES (?,?,?,?,?);");

        if (!$stmt->execute([$this->type, $this->category, $this->payment_method, $this->amount, $this->date])) {
            throw new Exception("Невозможно сохрание транзакции в базе данных");
        };

        return "Транзакция успешно сохранена в базе данных";
    }

    public function getAllDsc(): array {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT * FROM transactions ORDER BY transaction_id DESC");

        if (!$stmt->execute()) {
            throw new Exception("Невозможно выполнение команды");
        }

        if (!$transaction_array = $stmt->fetchAll()) {
            throw new Exception(("Невозможно получить массив данных"));
        }

        return $transaction_array;
    }
    
}