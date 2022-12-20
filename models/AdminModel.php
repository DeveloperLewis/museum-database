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
            throw new Exception("Unable to store admin in the database");
        };

        return "Successfully stored admin in the database";
    }

    public function authenticate(): string {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT * FROM admins WHERE username = ?");

        if (!$stmt->execute([$this->username])) {
            throw new Exception("SQL statement could not be executed");
        }

        if (!$admin = $stmt->fetch()) {
            throw new Exception("User could not be fetched from the database.");
        }

        if (!password_verify($this->password, $admin["password"])) {
            throw new Exception("Password did not match hashed password in database.");
        }

        $this->admin_id = $admin["admin_id"];

        return "Successfully authenticated the admin and set the admin_id property";
    }

    public function get(): string {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT * FROM admins WHERE admin_id = ?");

        if (!$stmt->execute([$this->admin_id])) {
            throw new Exception("Failed to execute the get by user_id statement.");
        }

        if (!$admin = $stmt->fetch()) {
            throw new Exception("Failed to fetch the user from the database");
        }

        $this->create($admin["username"], $admin["password"], $admin["account_creation_date"], $admin["admin_id"]);

        return "Successfully created the userModel and filled properties.";
    }
}