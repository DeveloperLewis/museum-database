<?php

namespace classes\authentication;

use classes\server\Database;
use Exception;

class User
{
    //Проверка правильности данных вводимых пользователем
    public function validateUsername($username): array
    {
        $username_errors = [];

        if (strlen($username) < 3) {
            $username_errors['min_size'] = "Имя должно быть длиннее 3 знаков.";
        };

        if (strlen($username) > 30) {
            $username_errors['max_size'] = "Имя не должно превышать 30 знаков.";
        };

        if (preg_match('/[^A-Za-z\d]/', $username)) {
            $username_errors['special_characters'] = "Имя не должно содержать специальных знаков, цифр или пробелов.";
        };

        return $username_errors;
    }

    //Проверка правильности пароля
    public function validatePassword($password, $repeat_password): array
    {
        $password_errors = [];

        if ($password != $repeat_password) {
            $password_errors['match'] = "Пароли не совпадают";
        }

        if (strlen($_POST['password']) < 8) {
            $password_errors['min_size'] = "Пароль должен быть длиннее 8 знаков";
        };

        if (strlen($_POST['password']) > 128) {
            $password_errors['min_size'] = "Пароль не должен превышать 128 знаков";
        };

        if (preg_match('/[^A-Za-z\d@$!%*?&;:^#]/', $_POST['password'])) {
            $password_errors['invalid_characters'] = "Пароль может содержать только буквы, цифры и следующие специальные знаки: @$!%*?&;:&%^#";
        };

        if (!preg_match('/\d+/', $_POST['password'])) {
            $password_errors['number'] = "Пароль должен содержать хотя бы одну цифру";
        };

        if (!preg_match('/[A-Z]+/', $_POST['password'])) {
            $password_errors['uppercase'] = "Пароль должен содержать хотя бы 1 заглавную букву";
        };

        if (!preg_match('/[a-z]+/', $_POST['password'])) {
            $password_errors['lowercase'] = "Пароль должен содержать хотя бы одну строчную букву";
        };

        if (!preg_match('/[@$!%*?&;:^#]/', $_POST['password'])) {
            $password_errors['special_characters'] = "Пароль должен содержать хотя бы один специальный знак: @$!%*?&;:&%^#";
        };

        return $password_errors;
    }

    //Проверка оригинальности имени пользователя
    public function isUsernameUnique($username): bool {
        $database = new Database();
        $stmt = $database->getPdo()->prepare("SELECT username FROM admins WHERE username = ?");;

        if (!$stmt->execute([$username])) {
            throw new Exception("Невозможно проверить оригинальность имени пользователя.");
        }

        if (empty($stmt->fetch())) {
            return true;
        }

        return false;
    }
}