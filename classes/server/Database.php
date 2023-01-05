<?php

namespace classes\server;

class Database
{


    //PDO настройка
    private array $options = [

        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES => false

    ];

    private $pdo = null;

    //При создании элемента базы данных, он прикрепляется к базе данных.
    public function __construct()
    {
        $env = new Env();
        $dsn = "$env->type:host=$env->server;dbname=$env->db;port=$env->port;charset=$env->charset";

        try {
            $this->pdo = new \PDO($dsn, $env->database_username, $env->database_password, $this->options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
    }

    //PDO элемент для взаимодействия с базой данных
    public function getPdo()
    {
        return $this->pdo;
    }
}