<?php

namespace classes\middleware;

class General
{
    //Останавливает захват сеанса
    private function verifySession(): void {
        if (isset($_SESSION["admin"])) {
            if ($_SERVER['REMOTE_ADDR'] != $_SESSION["admin"]["ip"]) {
                unset($_SESSION["admin"]);
            }

            if ($_SERVER['HTTP_USER_AGENT'] != $_SESSION["admin"]["agent"]) {
                unset($_SESSION["admin"]);
            }

            if (time() > ($_SESSION["admin"]["last_access"] + 3600)) {
                unset($_SESSION["admin"]);
            }
            else {
                $_SESSION["admin"]["last_access"] = time();
            }
        }
    }

    //Проверяет, вошел ли пользователь
    public function authenticateUser(): void {
        $this->verifySession();
        if (!isLoggedIn()) {
            redirect("/");
        }
    }
}