<?php

namespace models;

use classes\server\Database;
use Exception;

class AdminModel
{
    public int $admin_id;
    public string $username;
    public string $password;
    public string $account_creation_date;

    public function create($username, $password, $account_creation_date, $admin_id = 0): void
    {
        $this->admin_id = $admin_id;
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->account_creation_date = $account_creation_date;
    }

    public function store(): string
    {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("INSERT INTO admins (username, password, account_creation_date) VALUES (?,?,?);");

        if (!$stmt->execute([$this->username, $this->password, $this->account_creation_date])) {
            throw new Exception("Невозможно сохранить данные админа");
        };

        return "Данные админа успешно сохранены";
    }

    public function authenticate(): string {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT * FROM admins WHERE username = ?");

        if (!$stmt->execute([$this->username])) {
            throw new Exception("Невозможно выполнение SQL-команды");
        }

        if (!$admin = $stmt->fetch()) {
            throw new Exception("Невозможно получить пользовательские данные из базы данных.");
        }

        if (!password_verify($this->password, $admin["password"])) {
            throw new Exception("Пароль не совпадает с сохраненным паролем.");
        }

        $this->admin_id = $admin["admin_id"];

        return "Успешная авторизация админа";
    }

    public function get(): string {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT * FROM admins WHERE admin_id = ?");

        if (!$stmt->execute([$this->admin_id])) {
            throw new Exception("Невозможно выполнение команды.");
        }

        if (!$admin = $stmt->fetch()) {
            throw new Exception("Невозможно получить пользовательские данные из базы данных");
        }

        $this->create($admin["username"], $admin["password"], $admin["account_creation_date"], $admin["admin_id"]);

        return "Пользовательские данные успешно получены.";
    }
}