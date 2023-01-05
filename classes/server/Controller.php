<?php

namespace classes\server;

class Controller
{
    protected string $view;

    //Получение запросов на контроллер
    public function get(callable $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $callback();
        }
    }

    //Отправка запросов для контроллера
    public function post(callable $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $callback();
        }
    }

    //Установка вида контроллера
    public function setView(string $viewLocation): void
    {
        $this->view = $viewLocation;
    }

    //Запрос установленного вида контроллера
    public function view($vars = null, $errors_array = null): void
    {
        require_once('views/' . $this->view . '.php');
    }
}