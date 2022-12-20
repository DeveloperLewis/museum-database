<?php

namespace classes\server;
class Env
{
    //Database variables
    public string $type = 'mysql';
    public string $server = 'localhost';
    public string $db = 'museum';
    public string $port = '3306';
    public string $charset = 'utf8mb4';

    public string $database_username = 'root';
    public string $database_password = '';

    //Starter Admin Account Variables
    public string $admin_username = 'Admin1';
    public string $admin_password = 'SuperAdmin50;';
}