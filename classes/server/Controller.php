<?php

namespace classes\server;

class Controller
{
    protected string $view;

    //Get requests for controller
    public function get(callable $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $callback();
        }
    }

    //post requests for controller
    public function post(callable $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $callback();
        }
    }

    //Set the view of the controller
    public function setView(string $viewLocation): void
    {
        $this->view = $viewLocation;
    }

    //require the view of the controller that has been set
    public function view($vars = null, $errors_array = null): void
    {
        require_once('views/' . $this->view . '.php');
    }
}